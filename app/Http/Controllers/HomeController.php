<?php

namespace App\Http\Controllers;

use App\CheckinListener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Grade;
use App\School;
use App\Curriculum;
use App\Subject;
use App\Lesson;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currUserRank = User::getCurrUserRank(Auth::id())->first()['rank'];

        if ($currUserRank == 'admin') {
            $data = $this->adminHome();

            return view('home.adminHome', ['data' => $data]);
        } elseif ($currUserRank == 'headmaster') {
            $data = $this->headmasterHome();

            return view('home.headmasterHome', ['data' => $data]);
        } elseif ($currUserRank == 'subheadmaster') {
            $data = $this->subheadmasterHome();

            return view('home.subheadmasterHome', ['data' => $data]);
        } elseif ($currUserRank == 'teacher') {
            $data = $this->teacherHome();

            return view('home.teacherHome', ['data' => $data]);
        } elseif ($currUserRank == 'student') {
            $data = $this->studentHome();

            return view('home.studentHome', ['data' => $data]);
        } elseif ($currUserRank == 'parent') {
            $data = $this->parentHome();

            return view('home.parentHome', ['data' => $data]);
        } else {
            Auth::logout();
            return redirect()->back();
        }
    }

    protected function adminHome () {
        return [];
    }

    protected function headmasterHome () {
        return [];
    }

    protected function subheadmasterHome () {
        return [];
    }

    /**
     * Gathers all the data needed to display the current schedule for the teacher.
     * Should only be used for home page on a teacher login.
     *
     * @return array
     */
    protected function teacherHome () {
        $teacherLessons = Lesson::getTeacherLessonsToday(Auth::id())->get()->toArray();

        $teacherLessonsData = [];
        //$currentTime = date('H:i');
        $currentTime = '09:10';
        //dd($teacherLessons);
        $lessonCount = 1;
        foreach ($teacherLessons as $row) {
            $gradeInfo = Grade::getGradeTitleAndStudents($row['grade_id'])->first();

            $listener = CheckinListener::getCheckinListenerByLessonID($row['id'])->first();

            $isLessonOpenedToday = false;
            if ($listener != null) {
                $isLessonOpenedToday = true;
            }

            $teacherLessonsData[$lessonCount]['lessonNumber'] = $lessonCount;
            $teacherLessonsData[$lessonCount]['lessonID'] = $row['id'];
            $teacherLessonsData[$lessonCount]['isLessonOpenedToday'] = $isLessonOpenedToday;
            $teacherLessonsData[$lessonCount]['gradeID'] = $row['grade_id'];
            $teacherLessonsData[$lessonCount]['gradeTitle'] = $gradeInfo['title'];
            $teacherLessonsData[$lessonCount]['gradeStudentIDs'] = $gradeInfo['student_ids'];
            $teacherLessonsData[$lessonCount]['subjectTitle'] = $row['title'];
            $teacherLessonsData[$lessonCount]['timeRangeFrom'] = $row['time_range_from'];
            $teacherLessonsData[$lessonCount]['timeRangeTo'] = $row['time_range_to'];

            if ($row['time_range_from'] <= $currentTime && $row['time_range_to'] >= $currentTime) {
                $teacherLessonsData[$lessonCount]['lessonSchedule'] = 'Текущ';
            } elseif ($row['time_range_from'] < $currentTime) {
                $teacherLessonsData[$lessonCount]['lessonSchedule'] = 'Минал';
            } elseif ($row['time_range_from'] > $currentTime) {
                $teacherLessonsData[$lessonCount]['lessonSchedule'] = 'Предстоящ';
            } else {
                $teacherLessonsData[$lessonCount]['lessonSchedule'] = 'Неизвестен';
            }

            $lessonCount++;
        }

        //dd($teacherLessonsData); Add days of the week.

        return $teacherLessonsData;
    }

    /**
     * Gathers all the data needed to display a classbook, based on the grade data.
     * Should only be used for home page on a student login.
     *
     * @return array
     */
    protected function studentHome () {
        $grade = Grade::gradeByStudentID(Auth::id())->first();

        $gradeData = [
            'title' => $grade['title']
        ];

        // Fills the $gradeData array with all the students' names from this grade
        foreach (json_decode($grade['student_ids']) as $row) {
            $nameAndFamily = User::getUserFullName($row)->first();
            $gradeData['students'][] = $nameAndFamily['name'] . ' ' . $nameAndFamily['family'];
        }

        $classteacher = User::getUserFullName($grade['classteacher_id'])->first();
        $gradeData['classteacher'] = $classteacher['name'] . ' ' . $classteacher['family'];

        $gradeData['school'] = School::getSchoolTitle($grade['school_id'])->first()['title'];

        $curriculum = Curriculum::getCurriculum($grade['curriculum_id'])->first();

        $gradeData['curriculumTimeRanges'] = json_decode($curriculum['lesson_timeRanges']);

        // Fills the $gradeData array with all the subjects' names from this grade curriculum
        foreach (json_decode($curriculum['lesson_subject_ids']) as $row) {
            $gradeData['curriculumSubjects'][] = Subject::getSubjectTitle($row)->first()['title'];
        }

        // Fills the $gradeData array with all the teachers' names from this grade curriculum
        foreach (json_decode($curriculum['lesson_teacher_ids']) as $row) {
            $teacherFullName = User::getUserFullName($row)->first();
            $gradeData['curriculumTeachers'][] = $teacherFullName['name'] . ' ' . $teacherFullName['family'];
        }

        // Maybe add the Absences of the current student?
        //dd($gradeData);

        return $gradeData;
    }

    protected function parentHome () {
        return [];
    }
}