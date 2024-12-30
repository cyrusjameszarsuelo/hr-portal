<?php

namespace App\Http\Controllers;

use App\Models\Meganews;
use App\Models\MegaGoodVibes;
use App\Models\MegaTrivia;
use Dcblogdev\MsGraph\Facades\MsGraph;


class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = MsGraph::get('me');
        $meganews = Meganews::orderBy('created_at', 'DESC')->first();
        $megaGoodVibes = MegaGoodVibes::orderBy('created_at', 'DESC')->first();
        $megaTrivia = MegaTrivia::orderBy('created_at', 'DESC')->first();

        return view('pages.main')
        ->withMegaGoodVibes($megaGoodVibes)
        ->withMeganews($meganews)
        ->withMegaTrivia($megaTrivia)
        ->withUser($user);
    }

    public function contentIndex($id)
    {

        $meganewsSingleContent = Meganews::find($id);
        $meganews = Meganews::all();

        return view('pages.content')
        ->withMeganewsSingleContent($meganewsSingleContent)
        ->withMeganews($meganews);
    }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
