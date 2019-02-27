<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CheckinListener;
use App\Absence;
use App\User;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $cardID
     * @return \Illuminate\Http\Response | string
     */
    public function index($cardID)
    {
        /*$userData = User::getUserByCardID($cardID)->first();

        if ($userData == null) {
            return 'false';
        }

        if ($userData['rank'] == 'student') {
            $openedListener = CheckinListener::getOpenedCheckinListener($userData['id'])->get()->last();

            if ($openedListener == null) {
                $closedListener = CheckinListener::getClosedCheckinListener($userData['id'])->get()->last();

                if ($closedListener == null) {
                    return 'false';
                } else {
                    $absence = Absence::getAbsenceByUserID($userData['id'])->get()->last();
                    if ($absence != null) {
                        Absence::where('id', $absence->id)->update(['late' => 1]);
                    }
                }

                return 'false';
            }

            $studentIDs = json_decode($openedListener['not_checked']);
            $studentIDKey = array_search($userData['id'], $studentIDs);

            if ($studentIDKey !== false) {
                unset($studentIDs[$studentIDKey]);

                // Updates the checkin_listener record
                $listener = CheckinListener::find($openedListener['id']);
                $listener->not_checked = json_encode(array_values($studentIDs));
                $listener->save();

                return 'success';
            } else {
                return 'false';
            }
        } else {
            return 'Not a student.';
        }*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response | string
     */
    public function store(Request $request)
    {
        //return $request->tagId;
        $userData = User::getUserByCardID($request->tagId)->first();

        if ($userData == null) {
            return 'false';
        }

        if ($userData['rank'] == 'student') {
            $openedListener = CheckinListener::getOpenedCheckinListener($userData['id'])->get()->last();

            if ($openedListener == null) {
                $closedListener = CheckinListener::getClosedCheckinListener($userData['id'])->get()->last();

                if ($closedListener == null) {
                    return 'false';
                } else {
                    $absence = Absence::getAbsenceByUserID($userData['id'])->get()->last();
                    if ($absence != null) {
                        Absence::where('id', $absence->id)->update(['late' => 1]);
                    }
                }

                return 'false';
            }

            $studentIDs = json_decode($openedListener['not_checked']);
            $studentIDKey = array_search($userData['id'], $studentIDs);

            if ($studentIDKey !== false) {
                unset($studentIDs[$studentIDKey]);

                // Updates the checkin_listener record
                $listener = CheckinListener::find($openedListener['id']);
                $listener->not_checked = json_encode(array_values($studentIDs));
                $listener->save();

                return 'success';
            } else {
                return 'false';
            }
        } else {
            return 'Not a student.';
        }
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
        //
    }

    /**
     * Request comes from AJAX. Updates the not_checked field in CheckinListeners (removes student's id) and excuses the absence.
     *
     * @param Request $request
     */
    public function excuseAbsence (Request $request) {
        $listener = CheckinListener::getListenerIDByLessonID($request->lessonID)->first();

        $studentIDs = json_decode($listener['not_checked']);
        $studentIDKey = array_search($request->studentID, $studentIDs);

        if ($studentIDKey !== false) {
            unset($studentIDs[$studentIDKey]);

            // Updates the checkin_listener record
            $listener = CheckinListener::find($listener['id']);
            $listener->not_checked = json_encode(array_values($studentIDs));
            $listener->save();
        }

        $absence = Absence::getUnexcusedAbsenceByUserID($request->studentID, $listener['id'])->first();

        Absence::find($absence['id'])->update(['excused' => true]);
    }

    /**
     * Request comes from AJAX. Updates the not_checked field in CheckinListeners (adds student's id) and writes him an absence.
     *
     * @param Request $request
     */
    public function writeAbsence (Request $request) {
        $listener = CheckinListener::getListenerIDByLessonID($request->lessonID)->first();

        $studentIDs = json_decode($listener['not_checked']);
        $studentIDs[] = intval($request->studentID);

        // Updating listener
        $listener = CheckinListener::find($listener['id']);
        $listener->not_checked = json_encode(array_values($studentIDs));
        $listener->save();

        $existingAbsence = Absence::getExistingAbsence($request->studentID, $listener['id'])->first();

        if ($existingAbsence != null) {
            Absence::find($existingAbsence['id'])->update(['excused' => false, 'kicked' => true]);
        } else {
            // Creating a new absence
            $userData = User::getUserGradeAndSchool($request->studentID)->first();

            $absence = new Absence();
            $absence->user_id = $userData['id'];
            $absence->listener_id = $listener['id'];
            $absence->grade_id = $userData['grade_id'];
            $absence->school_id = $userData['school_id'];
            $absence->kicked = true;

            $absence->save();
        }
    }
}
