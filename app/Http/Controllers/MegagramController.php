<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Megagram;
use App\Models\Megagram_Likes;
use App\Models\Megagram_Comment;
use MsGraph;

class MegagramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $megagram = Megagram::all();

        return view('pages.admin.view-all-megagram')
            ->withMegagram($megagram);
    }

    public function megagram()
    {
        $user = MsGraph::contacts()->get();

        $like = Megagram_Likes::where('user', $user['contacts']['mail'])->first();
        $megagram = Megagram::where('active', 1)->first();
        $likeCount = Megagram_Likes::where('megagram_id', $megagram->id)->count();
        $megagramComments = Megagram_Comment::where('megagram_id', $megagram->id)
            ->orderBy('created_at', 'desc')
            ->get(); 


        return view('new_main.pages.megagram')
            ->withMegagram($megagram)
            ->withUser($user)
            ->withLikeCount($likeCount)
            ->withMegagramComments($megagramComments)
            ->withLike($like);
    }

    public function like(Request $request) 
    {
        $user = MsGraph::contacts()->get();

        $like = new Megagram_Likes;

        $like->user = $user['contacts']['mail'];
        $like->megagram_id = $request->megagram_id;

        $like->save();

        return redirect()->back();


    }

    public function dislike()
    {
        $user = MsGraph::contacts()->get();

        $like = Megagram_Likes::where('user', $user['contacts']['mail'])
            ->where('megagram_id', '1');

        $like->delete();

        return redirect()->back();
    }

    public function addComment(Request $request)
    {

        $user = MsGraph::contacts()->get();

        $megagram_comment = new Megagram_Comment;

        $megagram_comment->user = $user['contacts']['mail'];
        $megagram_comment->comment = $request->comment;
        $megagram_comment->megagram_id = $request->megagram_id;

        $megagram_comment->save();

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = '')
    {
        $megagram = Megagram::find($id);

        return view('pages.admin.manageMegagram')
            ->withMegagram($megagram);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $megagram = new Megagram;

        $image = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

        $megagram->title = $request->title;
        $megagram->content = $request->content;
        $megagram->image = $image;
        $megatrivia->active = ($request->active == 'on') ? 1 : 0;

        $megagram->save();

        return redirect('/main/view-all-megagram');
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
        //
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
        $megagram_active = Megagram::where('active', 1)->get();

        foreach ($megagram_active as $key => $active) {

            $active->active = 0;

            $active->save();
        }

        $megagram = Megagram::find($id);

        if($request->file('image')) {
            $image = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            $megagram->image = $image;
        }

        $megagram->title = $request->title;
        $megagram->content = $request->content;
        $megagram->active = ($request->active == 'on') ? 1 : 0;

        $megagram->save();

        return redirect('/main/view-all-megagram');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $megagram = Megagram::find($id);

        $megagram->delete();

        return redirect()->back();
    }
}
