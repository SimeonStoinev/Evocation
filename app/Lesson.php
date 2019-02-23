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

    /**
     * Gives an array of arrays. Each array key is a day of the week and this way it returns the weekly lessons per day.
     *
     * @param $query
     * @param $gradeID
     * @return array
     */
    public function scopeGradeLessonsCurriculum ($query, $gradeID) {
        $weekDays = [
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat',
            'Sun'
        ];

        $gradeLessons = [
            'Mon' => [],
            'Tue' => [],
            'Wed' => [],
            'Thu' => [],
            'Fri' => [],
            'Sat' => [],
            'Sun' => []
        ];

        $lessons = $query->where('grade_id', $gradeID)->whereIn('day', $weekDays)->orderBy('time_range_from')->get()->toArray();

        foreach ($lessons as $lesson) {
            if ($lesson['day'] == 'Mon') {
                $gradeLessons['Mon'][] = $lesson;
            } elseif ($lesson['day'] == 'Tue') {
                $gradeLessons['Tue'][] = $lesson;
            } elseif ($lesson['day'] == 'Wed') {
                $gradeLessons['Wed'][] = $lesson;
            } elseif ($lesson['day'] == 'Thu') {
                $gradeLessons['Thu'][] = $lesson;
            } elseif ($lesson['day'] == 'Fri') {
                $gradeLessons['Fri'][] = $lesson;
            } elseif ($lesson['day'] == 'Sat') {
                $gradeLessons['Sat'][] = $lesson;
            } elseif ($lesson['day'] == 'Sun') {
                $gradeLessons['Sun'][] = $lesson;
            }
        }

        return $gradeLessons;
    }

    /**
     * Gives an array of arrays. Each array key is a day of the week and this way it returns the weekly lessons per day.
     *
     * @param $query
     * @param $teacherID
     * @return array
     */
    public function scopeTeacherLessonsCurriculum ($query, $teacherID) {
        $weekDays = [
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat',
            'Sun'
        ];

        $teacherLessons = [
            'Mon' => [],
            'Tue' => [],
            'Wed' => [],
            'Thu' => [],
            'Fri' => [],
            'Sat' => [],
            'Sun' => []
        ];

        $lessons = $query->where('teacher_id', $teacherID)->whereIn('day', $weekDays)->orderBy('time_range_from')->get()->toArray();

        foreach ($lessons as $lesson) {
            if ($lesson['day'] == 'Mon') {
                $teacherLessons['Mon'][] = $lesson;
            } elseif ($lesson['day'] == 'Tue') {
                $teacherLessons['Tue'][] = $lesson;
            } elseif ($lesson['day'] == 'Wed') {
                $teacherLessons['Wed'][] = $lesson;
            } elseif ($lesson['day'] == 'Thu') {
                $teacherLessons['Thu'][] = $lesson;
            } elseif ($lesson['day'] == 'Fri') {
                $teacherLessons['Fri'][] = $lesson;
            } elseif ($lesson['day'] == 'Sat') {
                $teacherLessons['Sat'][] = $lesson;
            } elseif ($lesson['day'] == 'Sun') {
                $teacherLessons['Sun'][] = $lesson;
            }
        }

        return $teacherLessons;
    }
}
