<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Lesson;

class Absence extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'excused', 'kicked'
    ];

    /**
     * Function used to get the last absence of the user by his id. Used to mark the absence as late, not full one.

     * @param $query
     * @param $userID
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
     * Function used to get the last absence of the user by his id. Used to mark the absence as late, not full one.
     *
     * @param $query
     * @param $userID
     * @param $listenerID
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
     * Count student's absences.
     *
     * @param $query
     * @param $userID
     * @return mixed
     */
    public function scopeCountAbsences ($query, $userID) {
        $absences = $query->where('user_id', $userID)->where('excused', false)->select('late')->get()->toArray();

        if ($absences == null) {
            return 0;
        } else {
            $count = 0;
            foreach ($absences as $absence) {
                if ($absence['late']) {
                    $count += 0.5;
                } else {
                    $count++;
                }
            }

            return $count;
        }
    }

    /**
     * Count student's excused absences.
     *
     * @param $query
     * @param $userID
     * @return mixed
     */
    public function scopeCountExcusedAbsences ($query, $userID) {
        $absences = $query->where('user_id', $userID)->where('excused', true)->select('id')->get()->toArray();

        return count($absences);
    }

    /**
     * Student absences from today.
     *
     * @param $query
     * @param $userID
     * @return mixed
     */
    public function scopeGetDailyAbsences ($query, $userID) {
        $result = $query->where('user_id', $userID)->where('excused', false)->where('created_at', '>=', Carbon::today())
                ->select('id', 'lesson_id', 'user_id', 'late', 'kicked', 'created_at')->get()->toArray();

        if (!empty($result)) {
            foreach ($result as &$row) {
                $lessonData = Lesson::getLessonTitleAndDay($row['lesson_id']);
                $row['lessonTitle'] = $lessonData[0];
                $row['lessonDay'] = $lessonData[1];
                $timestamp = explode(' ', $row['created_at']);
                $date = explode('-', $timestamp[0]);
                $row['time'] = $timestamp[1];
                $row['date'] = $date[2] . '.' . $date[1] . '.' . $date[0];
                unset($row['created_at']);
            }
        }

        return $result;
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

        $result = $query->where('user_id', $userID)->where('excused', false)->whereBetween('created_at', [
            $carbon->startOfWeek()->format('Y-m-d H:i'),
            $carbon->endOfWeek()->format('Y-m-d H:i')
        ])->select('id', 'lesson_id', 'user_id', 'late', 'kicked', 'created_at')->get()->toArray();

        if (!empty($result)) {
            foreach ($result as &$row) {
                $lessonData = Lesson::getLessonTitleAndDay($row['lesson_id']);
                $row['lessonTitle'] = $lessonData[0];
                $row['lessonDay'] = $lessonData[1];
                $timestamp = explode(' ', $row['created_at']);
                $date = explode('-', $timestamp[0]);
                $row['time'] = $timestamp[1];
                $row['date'] = $date[2] . '.' . $date[1] . '.' . $date[0];
                unset($row['created_at']);
            }
        }

        return $result;
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

        $result = $query->where('user_id', $userID)->where('excused', false)->whereBetween('created_at', [
            $carbon->startOfMonth()->format('Y-m-d H:i'),
            $carbon->endOfMonth()->format('Y-m-d H:i')
        ])->select('id', 'lesson_id', 'user_id', 'late', 'kicked', 'created_at')->get()->toArray();

        if (!empty($result)) {
            foreach ($result as &$row) {
                $lessonData = Lesson::getLessonTitleAndDay($row['lesson_id']);
                $row['lessonTitle'] = $lessonData[0];
                $row['lessonDay'] = $lessonData[1];
                $timestamp = explode(' ', $row['created_at']);
                $date = explode('-', $timestamp[0]);
                $row['time'] = $timestamp[1];
                $row['date'] = $date[2] . '.' . $date[1] . '.' . $date[0];
                unset($row['created_at']);
            }
        }

        return $result;
    }

    /**
     * All student's excused absences.
     *
     * @param $query
     * @param $userID
     * @return mixed
     */
    public function scopeGetExcusedAbsences ($query, $userID) {
        $result = $query->where('user_id', $userID)->where('excused', true)
            ->select('id', 'lesson_id', 'user_id', 'created_at')->get()->toArray();

        if (!empty($result)) {
            foreach ($result as &$row) {
                $lessonData = Lesson::getLessonTitleAndDay($row['lesson_id']);
                $row['lessonTitle'] = $lessonData[0];
                $row['lessonDay'] = $lessonData[1];
                $timestamp = explode(' ', $row['created_at']);
                $date = explode('-', $timestamp[0]);
                $row['time'] = $timestamp[1];
                $row['date'] = $date[2] . '.' . $date[1] . '.' . $date[0];
                unset($row['created_at']);
            }
        }

        return $result;
    }

    /**
     * Gets an existing absence today by user and listener id. Used to kick a student from a lesson.
     *
     * @param $query
     * @param $userID
     * @param $listenerID
     * @return mixed
     */
    public function scopeGetExistingAbsence ($query, $userID, $listenerID) {
        return $query->where([
            'user_id' => $userID,
            'listener_id' => $listenerID
        ])->where('created_at', '>=', Carbon::today());
    }
}
