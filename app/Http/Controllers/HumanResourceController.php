<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcements;
use App\Models\Content_Type;
use App\Models\Hr_Website;
use App\Models\New_Hires;
use App\Models\Announcements_Images;
use App\Models\Job_Vacancies;
use App\Models\Community_Board;
use App\Models\Timeline;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\Blog;
use App\Models\User;
use DB;
use MsGraph;
use Auth;

class HumanResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memorandum = Announcements::with(['Announcements_Images'])
            ->where('content_type_id', 3)
            ->orderBy('created_at', 'DESC')
            ->first();

        $hmoAnnouncement = Announcements::with(['Announcements_Images'])
            ->where('content_type_id', 4)
            ->orderBy('created_at', 'DESC')
            ->first();
        $generalAnnouncement = Announcements::with(['Announcements_Images'])
            ->where('content_type_id', 2)
            ->orderBy('created_at', 'DESC')->first();

        $generalAnnouncementAll = Announcements::with(['Announcements_Images'])
            ->where('content_type_id', 2)
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        $howTo = Hr_Website::with(['Content_Type'])
            ->where('content_type_id', 6)
            ->orderBy('created_at', 'DESC')
            ->take(10)
            ->get();

        $didYouKnow = Hr_Website::where('content_type_id', 7)
            ->orderBy('created_at', 'DESC')
            ->get();

        $megawideUniversity = Hr_Website::where('content_type_id', 8)
            ->orderBy('created_at', 'DESC')
            ->get();

        $newHires = New_Hires::where('content_type_id', 9)
            ->where('created_at', DB::raw('(SELECT MAX(created_at) 
                    FROM new_hires)'))
            ->orderBy('created_at', 'DESC')
            ->get();

        $demographics = Hr_Website::with(['Content_Type'])
            ->where('content_type_id', 10)
            ->orderBy('created_at', 'DESC')
            ->first();


        $listOfUsers = User::orderBy('id', 'DESC')
            ->get();

        // $listOfUsers = User::where('created_at', 'LIKE', '%'.date('Y-m-d').'%')
        //     ->groupBy('name')
        //     ->get();


        $user = MsGraph::contacts()->get();

        $timeline = Timeline::orderBy('created_at', 'DESC')->take(10)->get();
        $blog = Blog::orderBy('created_at', 'DESC')->take(4)->get();
        $survey = Survey::where('active', 1)->first();
        $community = Community_Board::orderBy('created_at', 'DESC')->get();
        $surveyName = SurveyAnswer::
            where('survey_name', $user['contacts']['displayName'])
            ->where('survey_id', $survey->id)
            ->first();
        $commName = Community_Board::where('user_name', $user['contacts']['displayName'])->first();
        $forumName = Timeline::where('name', $user['contacts']['displayName'])->first();

        $jsImplode = '';
        $result_choices = array();

        $counter = 1;
        if (isset($survey->choices)) {
            foreach ($survey->choices as $key => $choices) {
                $result_choices['title'] = '"'.$survey->name.'"';
                $result_choices[$choices->choice] = 0;

                foreach ($survey->survey_answer as $key => $answer) {
                    if ($choices->id == $answer->choices_id) {

                        $result_choices[$choices->choice] = $counter;
                        $counter++;

                        
                    }
                }$counter = 1;
            }

            $jsImplode .= '[';
            if ($result_choices != '') {
                foreach ($result_choices as $key => $result) {
                    $jsImplode .= '["'.$key.'", '.$result.'],';
                }
            }
            
            $jsImplode = substr($jsImplode, 0, -1);
            $jsImplode .= ']';
        }


        return view('pages.human_resources')
            ->withMemorandum($memorandum)
            ->withGeneralAnnouncement($generalAnnouncement)
            ->withGeneralAnnouncementAll($generalAnnouncementAll)
            ->withHmoAnnouncement($hmoAnnouncement)
            ->withhowTo($howTo)
            ->withDidYouKnow($didYouKnow)
            ->withNewHires($newHires)
            ->withDemographics($demographics)
            ->withMegawideUniversity($megawideUniversity)
            ->withTimeline($timeline)
            ->withSurvey($survey)
            ->withBlog($blog)
            ->withCommunity($community)
            ->withCommName($commName)
            ->withSurveyName($surveyName)
            ->withForumName($forumName)
            ->withJsImplode($jsImplode)
            ->withUser($user)
            ->withListOfUsers($listOfUsers);

        
    }

    public function view($id = null)
    {
        $user = MsGraph::contacts()->get();

        $announcements = Announcements::query()
            ->with(['Content_Type'])
            ->with(['Announcements_Images'])
            ->when($id != null, function ($query) use ($id){
                $query->where('content_type_id', $id);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        $contentType = Content_Type::whereNotIn('id', [1, 5, 6, 7, 8, 9, 10])
            ->get();

        $allAnnouncements = Announcements::query()
            ->with(['Content_Type'])
            ->with(['Announcements_Images'])
            ->when($id != null, function ($query) use ($id){
                $query->where('content_type_id', $id);
            })
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();


        return view('pages.all_announcements')
            ->withAnnouncements($announcements)
            ->withAllAnnouncements($allAnnouncements)
            ->withUser($user)
            ->withContentType($contentType);
    }

    public function getNewEmployee()
    {

        $newHires = New_Hires::orderBy('created_at', 'DESC')
            ->get();

        $user = MsGraph::contacts()->get();


        return view('pages.all_hires')
            ->withUser($user)
            ->withNewHires($newHires);
    }

    public function storeNewHire(Request $request)
    {
        $newHire = new New_Hires;

        if ($request->hasFile('image')) {

            $filename = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

            // $filename = time().request()->image->getClientOriginalName();
            // request()->image->move(public_path('img/New Employee/'), $filename);
            
        } else {
            $filename = '';
        }

        $newHire->name = $request->name;
        $newHire->position = $request->position;
        $newHire->image = $filename;
        $newHire->content_type_id = 9;

        $newHire->save();

        return redirect()->back();
    }

    public function getJobVacancies()
    {
        $jobVacancies = Job_Vacancies::orderBy('created_at', 'DESC')
            ->get();

        $user = MsGraph::contacts()->get();

        return view('pages.job_vacancies')
            ->withUser($user)
            ->withJobVacancies($jobVacancies);
    }

    public function storeNewJob(Request $request)
    {
        $job_vacancies = new Job_Vacancies;

        if ($request->hasFile('image')) {

            $filename = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

            // $filename = time().request()->image->getClientOriginalName();
            // request()->image->move(public_path('img/Job Vacancies/'), $filename);
            
        } else {
            $filename = '';
        }

        $job_vacancies->title = $request->title;
        $job_vacancies->image = $filename;
        // $job_vacancies->content_type_id = 9;

        $job_vacancies->save();

        return redirect()->back();
    }

    public function getHrWebsite($id, Request $request)
    {
        $user = MsGraph::contacts()->get();
        $title = ucfirst($request->segment(1));
        $hrWebsite = Hr_Website::query()
            ->when($id != null, function ($query) use ($id){
                $query->where('content_type_id', $id);
            })
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);


        $contentType = Content_Type::whereNotIn('id', [1, 2, 3, 4, 5, 9])
            ->get();

        return view('pages.view_hr_website_lists')
            ->withHrWebsite($hrWebsite)
            ->withTitle($title)
            ->withUser($user)
            ->withContentType($contentType);
    }

    public function storeHrWebsite(Request $request)
    {

        $hr_website = new Hr_Website;

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

        $hr_website->name = $request->name;
        $hr_website->image = $filename;
        $hr_website->content_type_id = $request->content_type_id;

        $hr_website->save();

        return redirect()->back();
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
        $announcement = new Announcements;

        $announcement->title =  $request->title;
        $announcement->content =  $request->content;
        $announcement->content_type_id =  $request->content_type_id;

        $announcement->save();

        if ($request->hasFile('image')) {

            foreach (request()->image as $key => $image) {

                $filename = cloudinary()->upload($image->getRealPath())->getSecurePath();


                // $filename = time().$image->getClientOriginalName();
                // $image->move(public_path('img/announcements/'), $filename);

                $announcements_images = new Announcements_Images;

                $announcements_images->announcements_id = $announcement->id;
                $announcements_images->image = $filename;

                $announcements_images->save();
            }
            
        } else {
            $filename = '';
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
        $announcement = Announcements::find($id);

        $announcements_images_delete = Announcements_Images::where('announcements_id', $id);

        $announcements_images_delete->delete();

        $announcements_images_store = new Announcements_Images;

        if ($request->hasFile('image')) {

            foreach (request()->image as $key => $image) {

                $filename = cloudinary()->upload($image->getRealPath())->getSecurePath();

                $announcements_images = new Announcements_Images;

                $announcements_images->announcements_id = $id;
                $announcements_images->image = $filename;

                $announcements_images->save();
            }
            
        } else {
            $filename = '';
        }

        $announcement->title =  $request->title;
        $announcement->content =  $request->content;
        $announcement->content_type_id =  $request->content_type_id;

        $announcement->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcement = Announcements::find($id);

        $announcement->delete();

        return redirect()->back();
    }

    public function DestroyHire($id)
    {
        $newHire = New_Hires::find($id);

        $newHire->delete();

        return redirect()->back();
    }

    public function destroyHrWebsite($id)
    {
        $hr_website = Hr_Website::find($id);

        $hr_website->delete();

        return redirect()->back();
    }

    public function destroyJobVacancies($id) {

        $job_vacancies = Job_Vacancies::find($id);

        $job_vacancies->delete();

        return redirect()->back();

    }
}
