<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    /**
     * @param $query
     * @param $curriculumID
     *
     * Gets curriculum by id.
     *
     * @return mixed
     */
    public function scopeGetCurriculum ($query, $curriculumID) {
        return $query->where('id', $curriculumID);
    }

    /**
     * @param $query
     * @param $teacherID
     *
     * Gets all teacher lessons by teacher id.
     *
     * @return mixed
     */
    public function scopeGetTeacherCurriculum ($query, $teacherID) {
        $day = date('D');
        return $query->whereJsonContains('lesson_teacher_ids', $teacherID)->select('grade_id', 'lesson_timeRanges', 'lesson_subject_ids', 'lesson_teacher_ids');
    }
}
