<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetAllGrades ($query) {
        return $query->where('id', '>', '0');
    }

    /**
     * Gets all grades by a given school id.
     *
     * @param $query
     * @param $schoolID
     * @return mixed
     */
    public function scopeGetGradesBySchoolID ($query, $schoolID) {
        return $query->where('school_id', $schoolID);
    }

    /**
     * Gets a grade by a given student id, through searching in the JSON field of student ids in the grade.
     *
     * @param $query
     * @param $studentID
     * @return mixed
     */
    public function scopeGradeByStudentID ($query, $studentID) {
        return $query->whereJsonContains('student_ids', $studentID);
    }

    /**
     * Gets a grade by a given classteacher id.
     *
     * @param $query
     * @param $teacherID
     * @return mixed
     */
    public function scopeGradeByClassTeacherID ($query, $teacherID) {
        return $query->where('classteacher_id', $teacherID);
    }

    /**
     * Gets the grade title by grade id.
     *
     * @param $query
     * @param $gradeID
     * @return mixed
     */
    public function scopeGetGradeTitleAndStudents ($query, $gradeID) {
        return $query->where('id', $gradeID)->select('title', 'student_ids');
    }
}
