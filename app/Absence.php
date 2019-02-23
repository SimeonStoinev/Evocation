<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Absence extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'excused'
    ];

    /**
     * @param $query
     * @param $userID
     *
     * Function used to get the last absence of the user by his id. Used to mark the absence as late, not full one.
     *
     * @return mixed
     */
    public function scopeGetAbsenceByUserID ($query, $userID) {
        return $query->where([
            'user_id' => $userID,
            'late' => false,
            'excused' => false
        ])  ->where('created_at', '>=', Carbon::now()->subMinutes(20)->toDateTimeString())
            ->select('id', 'late');
    }

    /**
     * @param $query
     * @param $userID
     * @param $listenerID
     *
     * Function used to get the last absence of the user by his id. Used to mark the absence as late, not full one.
     *
     * @return mixed
     */
    public function scopeGetUnexcusedAbsenceByUserID ($query, $userID, $listenerID) {
        return $query->where([
            'user_id' => $userID,
            'listener_id' => $listenerID,
            'late' => false,
            'excused' => false
        ])  ->where('created_at', '>=', Carbon::today())
            ->select('id', 'excused');
    }

    /**
     * Student absences from today.
     *
     * @param $query
     * @param $userID
     * @return mixed
     */
    public function scopeGetDailyAbsences ($query, $userID) {
        return $query->where('user_id', $userID)->where('created_at', '>=', Carbon::today());
    }

    /**
     * Student absences from this week.
     *
     * @param $query
     * @param $userID
     * @return mixed
     */
    public function scopeGetWeeklyAbsences ($query, $userID) {
        $carbon = new Carbon();

        return $query->where('user_id', $userID)->whereBetween('created_at', [
            $carbon->startOfWeek()->format('Y-m-d H:i'),
            $carbon->endOfWeek()->format('Y-m-d H:i')
        ]);
    }

    /**
     * Student absences from this month.
     *
     * @param $query
     * @param $userID
     * @return mixed
     */
    public function scopeGetMonthlyAbsences ($query, $userID) {
        $carbon = new Carbon();

        return $query->where('user_id', $userID)->whereBetween('created_at', [
            $carbon->startOfMonth()->format('Y-m-d H:i'),
            $carbon->endOfMonth()->format('Y-m-d H:i')
        ]);
    }
}
