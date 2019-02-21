<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CheckinListener extends Model
{
    /**
     * @param $query
     * @param $studentID
     *
     * Gets the opened checkin listener (By studentID) that has been created from the teacher and allows you to check your card.
     *
     * @return mixed
     */
    public function scopeGetOpenedCheckinListener ($query, $studentID) {
        return $query->whereJsonContains('student_ids', $studentID)->where('opened', true)->where('created_at', '>=', Carbon::now()->subMinutes(20)->toDateTimeString())->select('id', 'not_checked');
    }

    /**
     * @param $query
     * @param $studentID
     *
     * Gets the closed checkin listener (By studentID) that has been created from the teacher.
     *
     * @return mixed
     */
    public function scopeGetClosedCheckinListener ($query, $studentID) {
        return $query->whereJsonContains('not_checked', $studentID)->where('opened', false)->where('created_at', '>=', Carbon::now()->subMinutes(20)->toDateTimeString())->select('id', 'created_at');
    }

    /**
     * Gets only the lesson_id field from a checkin listener row that has been fetched by lesson id.
     * Lesson must be finished today. Used for comparison in HomeController.
     *
     * @param $query
     * @param $lessonID
     * @return mixed
     */
    public function scopeGetCheckinListenerByLessonID ($query, $lessonID) {
        return $query->where('lesson_id', $lessonID)->where('created_at', '>=', Carbon::today())->select('lesson_id');
    }
}
