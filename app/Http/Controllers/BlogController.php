<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Blog_Images;
use App\Models\Blog_Comments;
use MsGraph;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = MsGraph::contacts()->get();

        $blog = Blog::orderBy('created_at', 'DESC')->get();
        $blogName = Blog::where('blog_name', $user['contacts']['displayName'])->first();

        return view('pages.all_blogs')
            ->withBlog($blog)
            ->withBlogName($blogName);
    }

    public function adminIndex()
    {
        $blog = Blog::all();

        return view('pages.admin.blog')
            ->withBlog($blog);
    }

    public function view($id)
    {
        $blog = Blog::find($id);
        $listOfBlogs = Blog::orderBy('created_at', 'DESC')->take(5)->get();

        return view('pages.blog_details')
            ->withBlog($blog)
            ->withListOfBlogs($listOfBlogs);
    }

    public function blogFilter(Request $request)
    {

        $blog = Blog::select('blog.*', 'blog_images.*')
                ->leftJoin("blog_images", "blog_images.blog_id", "=", "blog.id")
                ->where('blog_title', 'LIKE', '%'.$request->search.'%')
                ->get();

        // $blog = Blog::where('blog_title', 'LIKE', '%'.$request->search.'%')
        //     ->get();

        // $blog = json_encode(array_merge(json_decode($blog, true),json_decode($blogImage, true)));

        return response()->json($blog);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = MsGraph::contacts()->get();

        $blog = new Blog;

        $blog->blog_title = $request->blog_title;
        $blog->content_type_id = 5;
        $blog->content = $request->content;
        $blog->subject = $request->subject;
        $blog->blog_name = $user['contacts']['displayName'];

        $blog->save();

        $id = $blog->id;

        if ($request->hasFile('image')) {

            foreach (request()->image as $key => $imageData) {

                $filename = cloudinary()->upload($imageData->getRealPath())->getSecurePath();

                // $filename = time().$imageData->getClientOriginalName();
                // $imageData->move(public_path('img/blogs/'), $filename);


                $blog_images = new Blog_Images;

                $blog_images->image = $filename;
                $blog_images->blog_id = $id;

                $blog_images->save();
            }
            
        }

        return redirect()->back();
    }

    public function addComment(Request $request) 
    {

        $blog_comments = new Blog_Comments;

        $blog_comments->blog_id =  $request->blog_id;
        $blog_comments->comment =  $request->comment;
        $blog_comments->name =  $request->name;

        $blog_comments->save();

        return response()->json($blog_comments);

    }

    public function getComments($id) 
    {
        $blog_comments = Blog_Comments::where('blog_id', $id)->get();

        return response()->json($blog_comments);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $blog = Blog::find($id);

        // return view('pages.admin.add_blog')->withBlog($blog);

        $blog = Blog::find($id);

        return view('pages.edit_blog')->withBlog($blog);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $blog = Blog::find($id);

        $blog->blog_title = $request->blog_title;
        $blog->content = $request->content;
        $blog->subject = $request->subject;

        $blog->save();

        // $remove_blog_images = Blog_Images::where('blog_id', $id)->get();

        // foreach ($remove_blog_images as $key => $blog_images_data) {
        //     $blog_images_data->delete();
        // }

        // if ($request->hasFile('image')) {

        //     foreach (request()->image as $key => $imageData) {

        //         $filename = time().$imageData->getClientOriginalName();
        //         $imageData->move(public_path('img/blogs/'), $filename);


        //         $blog_images = new Blog_Images;

        //         $blog_images->image = $filename;
        //         $blog_images->blog_id = $id;

        //         $blog_images->save();
        //     }
            
        // }

        return redirect('/view-all-blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::find($id)->delete();

        Blog_Comments::where('blog_id', $id)->delete();

        return redirect()->back();
    }
}
