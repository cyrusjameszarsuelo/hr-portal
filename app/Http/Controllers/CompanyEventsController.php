<?php

namespace App\Http\Controllers;

use App\Models\CompanyEvents;
use Illuminate\Http\Request;

class CompanyEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = now()->year;
        $companyEvents = CompanyEvents::where('event_date', '>=', $year.'-01-01 00:00:00')
            ->where('event_date', '<=', $year.'-12-31 23:59:59')
            ->orderBy('event_date', 'ASC')->get();

        return view('pages.company_events')->withCompanyEvents($companyEvents);
    }

    public function holidays()
    {
        return view('pages.meganet-holidays');
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

            $filename = time().request()->image->getClientOriginalName();
            request()->image->move(public_path('img/events/'), $filename);
            
        } else {
            $filename = '';
        }

        $companyEvents = new CompanyEvents;

        $companyEvents->events = $request->events;
        $companyEvents->event_date = $request->event_date;
        $companyEvents->image = $filename;
        $companyEvents->description = $request->description;

        $companyEvents->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyEvents  $companyEvents
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyEvents $companyEvents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyEvents  $companyEvents
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyEvents $companyEvents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyEvents  $companyEvents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyEvents $companyEvents, $id)
    {
        $companyEvents = CompanyEvents::find($id);

        $companyEvents->events = $request->events;
        $companyEvents->event_date = $request->event_date;
        $companyEvents->description = $request->description;

        $companyEvents->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyEvents  $companyEvents
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CompanyEvents $companyEvents)
    {
        CompanyEvents::find($id)->delete();

        return redirect()->back();
    }
}
