<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Community_Board;
use Dcblogdev\MsGraph\Facades\MsGraph;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('new_main.pages.community-board');
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

        $user = MsGraph::get('me');

        $community = new Community_Board;


        if ($request->hasFile('image')) {
            if($request->file('image')->getMimeType() == 'video/mp4') {

                $filename = cloudinary()->uploadVideo($request->file('image')->getRealPath())->getSecurePath();
                
            } else {

                $filename = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            }

            // $filename = time().request()->image->getClientOriginalName();
            // request()->image->move(public_path('img/community_board/'), $filename);

            
        } else {
            $filename = '';
        }

        $community->title = $request->title;
        $community->content = $request->content;
        $community->link = $request->link;
        $community->image = $filename;
        $community->user_name = $user['displayName'];
        $community->created_by = 1;
        $community->updated_by = 1;

        $community->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $community = Community_Board::find($id);

        $community->title = $request->title;
        $community->content = $request->content;
        $community->link = $request->link;

        $community->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Community_Board::find($id)->delete();

        return redirect('/human-resources');
    }
}
