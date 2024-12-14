<?php

namespace App\Http\Controllers;

use App\Models\Corporate_Office;
use Illuminate\Http\Request;

class CorporateOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corporateOffice = Corporate_Office::all();

        return view('pages.admin.view-all-corporateoffice')
            ->withCorporateOffice($corporateOffice);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {   
        $corporateOffice = Corporate_Office::find($id);

        return view('pages.admin.manageCorporateOffice')
            ->withCorporateOffice($corporateOffice);
    }

    public function viewCorpoffice($val){

        $corporateOffice = Corporate_Office::where('department', $val)
            ->orderBy('created_at', 'DESC')
            ->first();

        return view('new_main.pages.meganet-corporateoffice')
            ->withCorporateOffice($corporateOffice);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $corporate_office = new Corporate_Office;

        if ($request->hasFile('organizational_structure')) {
            $filename = cloudinary()->upload(request()->organizational_structure->getRealPath())->getSecurePath();
        } else {
            $filename = '';
        }

        $corporate_office->department = $request->department;
        $corporate_office->organizational_structure = $filename;
        $corporate_office->manuals_link = $request->manuals_link;
        $corporate_office->policies_link = $request->policies_link;

        $corporate_office->save();

        return redirect('/main/view-all-corporateoffice');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Corporate_Office  $corporate_Office
     * @return \Illuminate\Http\Response
     */
    public function show(Corporate_Office $corporate_Office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Corporate_Office  $corporate_Office
     * @return \Illuminate\Http\Response
     */
    public function edit(Corporate_Office $corporate_Office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Corporate_Office  $corporate_Office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corporate_Office $corporate_Office, $id)
    {
        $corporate_office = Corporate_Office::find($id);

        if ($request->hasFile('organizational_structure')) {
            $filename = cloudinary()->upload(request()->organizational_structure->getRealPath())->getSecurePath();
            $corporate_office->organizational_structure = $filename;
        }

        $corporate_office->department = $request->department;
        $corporate_office->manuals_link = $request->manuals_link;
        $corporate_office->policies_link = $request->policies_link;

        $corporate_office->save();

        return redirect('/main/view-all-corporateoffice');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Corporate_Office  $corporate_Office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corporate_Office $corporate_Office, $id)
    {
        $corporateOffice = Corporate_Office::find($id);

        $corporateOffice->delete();

        return redirect()->back();
    }
}
