<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\HandlesFileUploads;
use Illuminate\Http\Request;
use App\Models\Community_Board;
use Dcblogdev\MsGraph\Facades\MsGraph;

class CommunityController extends Controller
{
    use HandlesFileUploads;

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


        $filename = $request->hasFile('image')
            ? $this->storeUpload($request->file('image'), 'community_board')
            : '';

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
