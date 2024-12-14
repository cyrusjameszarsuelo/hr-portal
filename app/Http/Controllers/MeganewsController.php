<?php

namespace App\Http\Controllers;

use App\Models\Meganews;
use App\Models\Meganews_Image;
use App\Models\Megatrivia;
use Illuminate\Http\Request;
use MsGraph;

ini_set('max_execution_time', 999);
ini_set('upload_max_filesize', 999);
ini_set('post_max_size', 999);

class MeganewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $meganews = Meganews::all();
        // $meganewsDateGroup = Meganews::selectRaw('year(created_at) year, monthname(created_at) month, count(*) data, created_at')
        //         ->groupBy('year', 'month')
        //         ->orderBy('year', 'desc')
        //         ->get();


        // return view('new_main.pages.meganews')
        //     ->withMeganewsDateGroup($meganewsDateGroup)
        //     ->withMeganews($meganews);
    }

    public function meganews(Request $request)
    {
        if ($request->isMethod('post')) {

            $meganews = Meganews::where('created_at', 'LIKE', $request->date_submit.'%')
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $meganews = Meganews::where('created_at', '>=', date('Y-m-').'01 00:00:00')
                ->where('created_at', '<=', date('Y-m-').'31 23:59:59')
                ->orderBy('created_at', 'DESC')
                ->get();
        }


        $meganewsDateGroup = Meganews::selectRaw('year(created_at) year, monthname(created_at) month, count(*) data, created_at')
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->get();


        return view('new_main.pages.meganews')
            ->withMeganewsDateGroup($meganewsDateGroup)
            ->withMeganews($meganews);
    }

    public function viewMeganewsDetails($id)
    {
        $meganews = Meganews::find($id);

        return view('new_main.pages.meganewsDetails')
            ->withMeganews($meganews);
    }

    public function ourcompany()
    {
        return view('new_main.pages.our-company');
    }

    public function ourcompanydetails()
    {
        return view('new_main.pages.our-company-details');
    }

    public function whoweare()
    {
        return view('new_main.pages.who-we-are');
    }

    public function allmeganews() 
    {
        $meganews = Meganews::with(['meganews_image'])->get();


        return view('pages.admin.view-all-meganews')
            ->withMeganews($meganews);
    }

    public function managemeganews($id = null) 
    {

        $id = $id ? $id : '';

        $meganewsDataId = Meganews::find($id);

        return view('pages.admin.manageMeganews')
            ->withMeganewsDataId($meganewsDataId);
    }

    // public function index()
    // {
    //     // $meganews = Meganews::where('is_deleted', 0)->get();

    //     // return redirect()->route('pages.main')->with([ 'id' => $id ]);

    //     $user = MsGraph::contacts()->get();

    //     $meganews = Meganews::orderBy('created_at', 'DESC')->get();

    //     return view('pages.all_meganews')
    //         ->withMeganews($meganews)
    //         ->withUser($user);
    // }

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
        $meganews = new Meganews;

        $meganews->title = $request->title;
        $meganews->content = $request->content;
        $meganews->content_type_id = 1;

        $meganews->save();

        if ($request->hasFile('image')) {

            foreach (request()->image as $key => $image) {

                $filename = cloudinary()->upload($image->getRealPath())->getSecurePath();

                $meganews_image = new Meganews_Image;

                $meganews_image->meganews_id = $meganews->id;
                $meganews_image->image = $filename;

                $meganews_image->save();
            }
            
        } else {
            $filename = '';
        }


        // if ($request->hasFile('image')) {
        //     foreach (request()->image as $key => $image) {

        //         $filename = time().$image->getClientOriginalName();
        //         $image->move(public_path('img/meganews/'), $filename);

        //         $meganews_image = new Meganews_Image;

        //         $meganews_image->meganews_id = $meganews->id;
        //         $meganews_image->image = 'img/meganews/'.$filename;

        //         $meganews_image->save();
        //     }
            
        // } else {
        //     $filename = '';
        // }


        return redirect('/main/view-all-meganews');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\meganews  $meganews
     * @return \Illuminate\Http\Response
     */
    public function show(meganews $meganews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\meganews  $meganews
     * @return \Illuminate\Http\Response
     */
    public function edit($id, meganews $meganews)
    {
        $meganews = Meganews::find($id);

        return view('pages.manage_meganews')->withMeganews($meganews);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\meganews  $meganews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, meganews $meganews, $id)
    {
        $meganews = Meganews::find($id);

        $meganews->title = $request->title;
        $meganews->content = $request->content;
        $meganews->content_type_id = 1;

        $meganews->save();

        if ($request->hasFile('image')) {

            $deleteMeganewsImages = Meganews_Image::where('meganews_id', $id);

            $deleteMeganewsImages->delete();

            foreach (request()->image as $key => $image) {

                $filename = cloudinary()->upload($image->getRealPath())->getSecurePath();

                $meganews_image = new Meganews_Image;

                $meganews_image->meganews_id = $meganews->id;
                $meganews_image->image = $filename;

                $meganews_image->save();
            }
            
        } else {
            $filename = '';
        }

        return redirect('/main/view-all-meganews');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\meganews  $meganews
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meganews = Meganews::find($id);

        $meganews->delete();

        return redirect()->back();
    }
}
