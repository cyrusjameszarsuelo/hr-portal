<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use App\Models\Timeline_Comments;
use App\Models\Timeline_History;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dcblogdev\MsGraph\Facades\MsGraph;


class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = MsGraph::get('me');

        $timeline = Timeline::orderBy('created_at', 'DESC')->paginate(5);
        $timelineHistory = Timeline_History::with(['timeline'])->orderBy('created_at', 'DESC')->take(10)->get();
        $forumName = Timeline::where('name', $user['displayName'])->first();


        return view('pages.all_forums')
            ->withTimeline($timeline)
            ->withForumName($forumName)
            ->withTimelineHistory($timelineHistory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = MsGraph::get('me');

        $timeline_comments = new Timeline_Comments;

        $timeline_comments->timeline_id = $request->timeline_id;
        $timeline_comments->name = $user['displayName'];
        $timeline_comments->image = 'https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png';
        $timeline_comments->post = $request->post;
        $timeline_comments->post_type_id = 2;

        $timeline_comments->save();

        // Timeline History

        $timeline_history = new Timeline_History;

        $timeline_history->name  =  $user['displayName'];
        $timeline_history->image  =  'https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png';
        $timeline_history->action  =  'Comment Added';
        $timeline_history->timeline_id  =  $request->timeline_id;

        $timeline_history->save();



        return redirect()->back();
        // return redirect('/#survey');
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

        $timeline = new Timeline;

        $timeline->title = $request->title;
        $timeline->name = $user['displayName'];
        $timeline->image = 'https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png';
        $timeline->post = $request->post;
        $timeline->post_type_id = $request->post_type_id;

        $timeline->save();

        $id = $timeline->id;


        // Timeline History

        $timeline_history = new Timeline_History;

        $timeline_history->name  =  $user['displayName'];
        $timeline_history->image  =  'https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png';
        $timeline_history->action  =  'Added Post';
        $timeline_history->timeline_id  =  $id;

        $timeline_history->save();



        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function show(Timeline $timeline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Timeline $timeline)
    {
        $timeline = Timeline::find($id);

        return view('pages.edit_forum')->withTimeline($timeline);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Timeline $timeline)
    {
        $timeline = Timeline::find($id);

        $timeline->title = $request->title;
        $timeline->post = $request->post;

        $timeline->save();

        return redirect('/view-all-forum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Timeline $timeline)
    {
        $timeline = Timeline::find($id)->delete();

        $timeline_history = Timeline_History::where('timeline_id', $id)->delete();

        return redirect()->back();
    }
}
