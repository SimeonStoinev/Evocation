<?php

namespace App\Http\Controllers;

use App\CheckinListener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Absence;
use App\User;
use Illuminate\Support\Facades\Session;

class CheckinListenerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Opens the checkin listener and card swipes are possible. Request comes from AJAX!
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response | array
     */
    public function store(Request $request)
    {
        $checkinListener = new CheckinListener();

        $checkinListener->teacher_id = Auth::id();
        $checkinListener->grade_id = $request->all()['gradeID'];
        $checkinListener->lesson_id = $request->all()['lessonID'];
        $checkinListener->student_ids = str_replace('"', '', json_encode($request->all()['studentIDs']));
        $checkinListener->not_checked = str_replace('"', '', json_encode($request->all()['studentIDs']));
        $checkinListener->opened = true;
        $checkinListener->time = date('H:i');

        $checkinListener->save();

        $request->session()->put('listenerID', $checkinListener->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckinListener  $checkinListener
     * @return \Illuminate\Http\Response
     */
    public function show(CheckinListener $checkinListener)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CheckinListener  $checkinListener
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckinListener $checkinListener)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CheckinListener  $checkinListener
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckinListener $checkinListener)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckinListener  $checkinListener
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckinListener $checkinListener)
    {
        //
    }

    /**
     * Request comes from AJAX!
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function closeCheckin (Request $request)
    {
        $listener = CheckinListener::find($request->all()['listenerID']);

        if ($listener->opened == true) {
            foreach (json_decode($listener->not_checked) as $row) {
                $userData = User::getUserGradeAndSchool($row)->first();
                $absence = new Absence();
                $absence->user_id = $userData['id'];
                $absence->listener_id = $request->all()['listenerID'];
                $absence->grade_id = $userData['grade_id'];
                $absence->school_id = $userData['school_id'];

                $absence->save();
            }
        }

        $listener->opened = false;
        $listener->save();

        $request->session()->forget('listenerID');
        $request->session()->put('lessonID', $request->all()['lessonID']);
    }
}
