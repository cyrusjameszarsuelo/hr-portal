<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MegaGoodVibes;
use App\Models\Megagoodvibes_Likes;
use App\Models\Megagoodvibes_Comments;
use MsGraph;

ini_set('max_execution_time', 9999);
ini_set('upload_max_filesize', 9999);
ini_set('post_max_size', 9999);



class MegaGoodVibesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $megaGoodVibes = MegaGoodVibes::all();

        return view('pages.admin.view-all-megagoodvibes')
            ->withMegaGoodVibes($megaGoodVibes);
    }

    public function megagoodvibesprimary() {

        $megagoodvibesAll = MegaGoodVibes::all();
        
        return view('new_main.pages.megagoodvibes-primary')
            ->withMegagoodvibesAll($megagoodvibesAll);
    }

    public function megagoodvibes($id = null) 
    {
        if($id != null) {

            $megagoodvibes = MegaGoodVibes::find($id);

        } else {

            $megagoodvibes = MegaGoodVibes::orderBy('created_at', 'DESC')->first();
        }

        $megagoodvibesAll = MegaGoodVibes::all();
        $megagoodvibesComments = Megagoodvibes_Comments::where('megagoodvibes_id', $megagoodvibes->id)->get();
        $megagoodvibesLike = Megagoodvibes_Comments::where('megagoodvibes_id', $megagoodvibes->id)->first();

        return view('new_main.pages.megagoodvibes')
            ->withMegagoodvibes($megagoodvibes)
            ->withMegagoodvibesAll($megagoodvibesAll)
            ->withMegagoodvibesComments($megagoodvibesComments)
            ->withMegagoodvibesLike($megagoodvibesLike);
    }

    public function addComment(Request $request)
    {
        $user = MsGraph::contacts()->get();

        $megagoodvibes_comments = new Megagoodvibes_Comments;

        $megagoodvibes_comments->user =  $user['contacts']['mail'];
        $megagoodvibes_comments->megagoodvibes_id =  $request->megagoodvibes_id;
        $megagoodvibes_comments->comment =  $request->comment;

        $megagoodvibes_comments->save();

        return response()->json($megagoodvibes_comments);
    }

    public function like(Request $request)
    {
        $user = MsGraph::contacts()->get();

        $megagoodvibes_likes = new Megagoodvibes_Likes;

        $megagoodvibes_likes->user =  $user['contacts']['mail'];
        $megagoodvibes_likes->megagoodvibes_id =  $request->megagoodvibes_id;

        $megagoodvibes_likes->save();

        return response()->json($megagoodvibes_likes);
    }

    public function dislike(Request $request)
    {
        $user = MsGraph::contacts()->get();

        $megagoodvibes_likes = Megagoodvibes_Likes::where('user', $user['contacts']['mail'])
            ->where('megagoodvibes_id', $request->megagoodvibes_id);

        $megagoodvibes_likes->delete();

        return response()->json($megagoodvibes_likes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $megaGoodVibes = MegaGoodVibes::find($id);

        return view('pages.admin.manageMegagoodvibes')
            ->withMegaGoodVibes($megaGoodVibes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $megaGoodVibes = new MegaGoodvibes;

        $megaGoodVibes->content = $request->content;

        if ($request->hasFile('file')) {

            $filename = cloudinary()->uploadVideo($request->file('file')->getRealPath(), [
            'folder' => 'videos'
            ])->getSecurePath();

        } else {
            $filename = '';
        }

        $thumbnail = cloudinary()->upload($request->file('thumbnail')->getRealPath())->getSecurePath();


        $megaGoodVibes->file = $filename;
        $megaGoodVibes->thumbnail = $thumbnail;

        $megaGoodVibes->save();
        

        return redirect('/main/view-all-megagoodvibes');
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
        $megaGoodVibes = MegaGoodvibes::find($id);

        $megaGoodVibes->content = $request->content;

        if ($request->hasFile('file')) {

            $filename = cloudinary()->uploadVideo($request->file('file')->getRealPath(), [
            'folder' => 'videos'
            ])->getSecurePath();


            $megaGoodVibes->file = $filename;

        }

        if ($request->hasFile('thumbnail')) {

            $thumbnail = cloudinary()->upload($request->file('thumbnail')->getRealPath())->getSecurePath();

            $megaGoodVibes->thumbnail = $thumbnail;

        }


        $megaGoodVibes->save();
        

        return redirect('/main/view-all-megagoodvibes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $megaGoodVibes = MegaGoodvibes::find($id);

        $megaGoodVibes->delete();

        return redirect()->back();
    }
}
