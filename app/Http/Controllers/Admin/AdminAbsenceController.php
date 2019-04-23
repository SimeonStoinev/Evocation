<?php

namespace App\Http\Controllers\Admin;

use App\Absence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response | void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response | void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response | void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response | void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response |void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Request comes from AJAX!
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response | void
     */
    public function update(Request $request)
    {
        $absenceAction = explode('~', $request->absenceAction);
        $data = [$absenceAction[0] => $absenceAction[1], $absenceAction[2] => $absenceAction[3]];

        Absence::where('id', $request->recordID)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response | void
     */
    public function destroy(Request $request)
    {
        $user = Absence::find($request->recordID);

        $user->delete();
    }
}
