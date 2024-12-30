<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Choices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dcblogdev\MsGraph\Facades\MsGraph;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $survey = Survey::all();

        $user = MsGraph::get('me');

        $counter = 0;
        $countAll = 0;
        $resultChoices = array();
        foreach ($survey as $key => $surveyData) {
            foreach ($surveyData->choices as $key1 => $choices) {
                $resultChoices[$key]['title'] = '"'.$surveyData->name.'"';
                $resultChoices[$key][$choices->choice] = 0;
                // $resultChoices[$key]['totalCounts'] = 0;

                foreach ($surveyData->survey_answer as $answerKey => $answer) {
                    if ($choices->id == $answer->choices_id) {

                        $counter++;
                        // $countAll++;

                        $resultChoices[$key][$choices->choice] = $counter;
                        // $resultChoices[$key]['totalCounts'] = $countAll;
                    }
                }$counter = 0;
            }
        }

        return view('pages.all_survey')
        ->withSurvey($survey)
        ->withUser($user)
        ->withResultChoices($resultChoices);
    }

    public function view()
    {
        $survey = Survey::all();

        return view('pages.admin.all_survey')->withSurvey($survey);
    }

    public function addSurvey()
    {
        return view('pages.admin.add_survey');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.add_survey');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $survey_active = Survey::where('active', 1)->get();

        foreach ($survey_active as $key => $active) {

            $active->active = 0;

            $active->save();
        }


        $survey = new Survey;

        $survey->name = $request->name;
        $survey->question = $request->question;
        $survey->end_date = $request->end_date;
        $survey->active = ($request->active == 'on') ? 1 : 0;
        $survey->created_by = 1;

        $survey->save();



        foreach ($request->answers as $key => $answer) {

            $choices = new Choices;

            $choices->survey_id = $survey->id;
            $choices->choice = $answer;

            $choices->save();
        } 

        return redirect('/view-all-surveys');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Survey $survey)
    {
        
        $survey = Survey::with(['choices'])->find($id);

        return view('pages.add_survey')->withSurvey($survey);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Survey $survey)
    {
        $survey_active = Survey::where('active', 1)->get();

        foreach ($survey_active as $key => $active) {

            $active->active = 0;

            $active->save();
        }

        $survey = Survey::find($id);

        $survey->name = $request->name;
        $survey->question = $request->question;
        $survey->end_date = $request->end_date;
        $survey->active = ($request->active == 'on') ? 1 : 0;

        $survey->save();

        for ($count=0; $count < count($request->answers); $count++) { 

            if (empty($request->survey_answer_id[$count])) {

                if (empty($request->answers[$count])) {

                   
                } else {

                    $choices = new Choices;

                    $choices->survey_id = $survey->id;
                    $choices->choice = $request->answers[$count];

                    $choices->save();
                }

                

            } else {

                $choices = Choices::find($request->survey_answer_id[$count]);

                $choices->choice = $request->answers[$count];

                $choices->save();

            }

            
        }


        // Choices::where('survey_id', $id)->get();

        // foreach ($request->answers as $key => $answer) {

        //     if ($answer != null) {
        //         $choices = new Choices;

        //         $choices->survey_id = $survey->id;
        //         $choices->choice = $answer;

        //         $choices->save();
        //     }

        // }
        return redirect('/view-all-surveys');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Survey $survey)
    {
        Survey::find($id)->delete();

        Choices::where('survey_id', $id)->delete();

        return redirect()->back();
    }
}
