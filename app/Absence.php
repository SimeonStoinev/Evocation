<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Absence extends Model
{
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
}
