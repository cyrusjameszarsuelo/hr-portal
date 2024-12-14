<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo_Gallery;
use MsGraph;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo_Gallery::all();
        $user = MsGraph::contacts()->get();


        return view('pages.photo_gallery')
            ->withPhotos($photos)
            ->withUser($user);
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
        

        if ($request->hasFile('image')) {

            foreach (request()->image as $key => $image) {

                $filename = cloudinary()->upload($image->getRealPath())->getSecurePath();

                $photo_gallery = new Photo_Gallery;

                $photo_gallery->name =  $request->name;

                $photo_gallery->image = $filename;

                $photo_gallery->save();
            }
            
        }

        return redirect()->back();
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
        Photo_Gallery::find($id)->delete();

        return redirect()->back();
    }
}
