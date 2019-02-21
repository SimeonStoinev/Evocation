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
        $userData = User::getUserByCardID($cardID)->first();

        if ($userData == null) {
            // Go fuck yourself
            return 'false';
        }

        if ($userData['rank'] == 'student') {
            $openedListener = CheckinListener::getOpenedCheckinListener($userData['id'])->get()->last();
            echo 'opened';

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
}
