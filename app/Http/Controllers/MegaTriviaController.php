<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MegaTrivia;
use App\Models\MegaTrivia_Answer;
use Dcblogdev\MsGraph\Facades\MsGraph;

ini_set('max_execution_time', 999);
ini_set('upload_max_filesize', 999);
ini_set('post_max_size', 999);

class MegaTriviaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $megatrivia = Megatrivia::all();

        return view('pages.admin.view-all-megatrivia')
            ->withMegatrivia($megatrivia);
    }

    public function megatrivia()
    {
        $user = MsGraph::get('me');

        $megatrivia = Megatrivia::where('active', 1)->first();

        if($megatrivia) {
            $megatriviaAnswerUser = MegaTrivia_Answer::where('user_answer', $user['mail'])
                ->where('megatrivia_id', $megatrivia->id)
                ->first();

            $megatriviaAnswer = MegaTrivia_Answer::where('megatrivia_answer', $megatrivia->answer)
                ->where('megatrivia_id', $megatrivia->id)
                ->first();
        } else {
            $megatriviaAnswerUser = '';
            $megatriviaAnswer = '';
        }


        return view('new_main.pages.megatrivia')
            ->withMegatriviaAnswerUser($megatriviaAnswerUser)
            ->withMegatriviaAnswer($megatriviaAnswer)
            ->withUser($user)
            ->withMegatrivia($megatrivia);
    }

    public function allmegatrivia()
    {
        $megatrivia = Megatrivia::all();
        $megatriviaAnswerUser = Megatrivia_Answer::all();

        return view('new_main.pages.all-megatrivia')
            ->withMegatriviaAnswerUser($megatriviaAnswerUser)
            ->withMegatrivia($megatrivia);
    }

    public function submitAnswer(Request $request)
    {   
        $megatrivia_answer = new MegaTrivia_Answer;

        $megatrivia_answer->megatrivia_answer = $request->megatrivia_answer;
        $megatrivia_answer->user_answer = $request->user_answer;
        $megatrivia_answer->megatrivia_id = $request->megatrivia_id;

        $megatrivia_answer->save();

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $megatrivia = Megatrivia::find($id);

        return view('pages.admin.manageMegatrivia')
            ->withMegatrivia($megatrivia);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $megatrivia_active = MegaTrivia::where('active', 1)->get();

        foreach ($megatrivia_active as $key => $active) {

            $active->active = 0;

            $active->save();
        }


        $megatrivia = new MegaTrivia;

        $image = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

        $megatrivia->title = $request->title;
        $megatrivia->image = $image;
        $megatrivia->answer = $request->answer;
        $megatrivia->content = $request->content;
        $megatrivia->active = ($request->active == 'on') ? 1 : 0;

        $megatrivia->save();

        return redirect('/main/view-all-megatrivia');
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
        $megatrivia_active = MegaTrivia::where('active', 1)->get();

        foreach ($megatrivia_active as $key => $active) {

            $active->active = 0;

            $active->save();
        }

        $megatrivia = MegaTrivia::find($id);

        if($request->file('image')) {
            $image = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            $megatrivia->image = $image;
        }

        $megatrivia->title = $request->title;
        $megatrivia->answer = $request->answer;
        $megatrivia->content = $request->content;
        $megatrivia->active = ($request->active == 'on') ? 1 : 0;

        $megatrivia->save();

        return redirect('/main/view-all-megatrivia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $megaTrivia = MegaTrivia::find($id);

        $megaTrivia->delete();

        return redirect()->back();
    }
}
