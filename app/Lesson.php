<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * Gets all teacher's lessons for today by teacher id.
     *
     * @param $query
     * @param $teacherID
     * @return mixed
     */
    public function scopeGetTeacherLessonsToday ($query, $teacherID) {
        $today = date('D');
        return $query->where(['teacher_id' => $teacherID, 'day' => $today]);
    }
}
