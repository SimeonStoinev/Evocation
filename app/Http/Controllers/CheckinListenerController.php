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
        $checkinListener->grade_id = $request->gradeID;
        $checkinListener->lesson_id = $request->lessonID;
        $checkinListener->student_ids = str_replace('"', '', json_encode($request->studentIDs));
        $checkinListener->not_checked = str_replace('"', '', json_encode($request->studentIDs));
        $checkinListener->opened = true;
        $checkinListener->time = date('H:i');

        $checkinListener->save();

        // Setting up an array to decide whether and which student was in the lesson and which wasn't.
        $listenerInfo = CheckinListener::where('id', $checkinListener->id)->first();
        $lessonStudentsData = [
            'listenerID' => $checkinListener->id,
            'lessonID' => $request->lessonID
        ];

        if ($listenerInfo != null) {
            // Foreaches every student in the class to add info and decide whether he was in the lesson or not.
            foreach (json_decode($listenerInfo['student_ids']) as $studentID) {
                $studentName = User::getUserFullName($studentID)->first();
                $lessonStudentsData['studentsData'][$studentID]['studentID'] = $studentID;
                $lessonStudentsData['studentsData'][$studentID]['studentName'] = $studentName['name'] . ' ' . $studentName['family'];
                if (in_array($studentID, json_decode($listenerInfo['not_checked']))) {
                    $lessonStudentsData['studentsData'][$studentID]['checked'] = false; // The student is absent
                } else {
                    $lessonStudentsData['studentsData'][$studentID]['checked'] = true; // The student is in the lesson
                }
            }
        }

        $request->session()->put('listenerID', $checkinListener->id);
        return $lessonStudentsData;
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
     * @return \Illuminate\Http\Response | void
     */
    public function closeCheckin (Request $request)
    {
        $listener = CheckinListener::find($request->listenerID);

        if ($listener->opened == true) {
            foreach (json_decode($listener->not_checked) as $row) {
                $userData = User::getUserGradeAndSchool($row)->first();
                $absence = new Absence();
                $absence->user_id = $userData['id'];
                $absence->listener_id = $request->listenerID;
                $absence->grade_id = $userData['grade_id'];
                $absence->school_id = $userData['school_id'];

                $absence->save();
            }
        }

        $listener->opened = false;
        $listener->save();

        $request->session()->forget('listenerID');
        $request->session()->put('lessonID', $request->lessonID);
    }

    /**
     * Request comes from AJAX. Refreshes the students data in an opened checkin listener.
     *
     * @param Request $request
     * @return array
     */
    public function refreshCheckedUsers (Request $request) {
        // Setting up an array to decide whether and which student was in the lesson and which wasn't.
        $listenerInfo = CheckinListener::where('id', $request->listenerID)->first();
        $lessonStudentsData = [
            'listenerID' => $request->listenerID
        ];

        if ($listenerInfo != null) {
            // Foreaches every student in the class to add info and decide whether he was in the lesson or not.
            foreach (json_decode($listenerInfo['student_ids']) as $studentID) {
                $studentName = User::getUserFullName($studentID)->first();
                $lessonStudentsData['studentsData'][$studentID]['studentID'] = $studentID;
                $lessonStudentsData['studentsData'][$studentID]['studentName'] = $studentName['name'] . ' ' . $studentName['family'];
                if (in_array($studentID, json_decode($listenerInfo['not_checked']))) {
                    $lessonStudentsData['studentsData'][$studentID]['checked'] = false; // The student is absent
                } else {
                    $lessonStudentsData['studentsData'][$studentID]['checked'] = true; // The student is in the lesson
                }
            }
        }

        return $lessonStudentsData;
    }
}
