<?php

namespace App\Http\Controllers;

use App\Absence;
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

        $teacherLessonsData = []; $teacherData = [];
        //$currentTime = date('H:i');
        $currentTime = '10:40';

        $lessonCount = 1;
        foreach ($teacherLessons as $row) {
            $gradeInfo = Grade::getGradeTitleAndStudents($row['grade_id'])->first();

            $listener = CheckinListener::getCheckinListenerByLessonID($row['id'])->first();

            $isLessonOpenedToday = false;
            if ($listener != null) {
                $isLessonOpenedToday = true;
            }

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

                $notChecked = CheckinListener::notCheckedStudentsByLessonID($row['id'])->first()['not_checked'];

                if ($notChecked != null) {
                    $teacherLessonsData[$lessonCount]['studentsData'] = $this->lessonStudentsArray($gradeInfo, $notChecked);
                }
            } elseif ($row['time_range_from'] < $currentTime) {
                $teacherLessonsData[$lessonCount]['lessonSchedule'] = 'Минал';

                $notChecked = CheckinListener::notCheckedStudentsByLessonID($row['id'])->first()['not_checked'];

                if ($notChecked != null) {
                    $teacherLessonsData[$lessonCount]['studentsData'] = $this->lessonStudentsArray($gradeInfo, $notChecked);
                }
                //dd($teacherLessonsData, 'Not Checked: ' . $notChecked, 'Grade Students: ' . $gradeInfo['student_ids']);
            } elseif ($row['time_range_from'] > $currentTime) {
                $teacherLessonsData[$lessonCount]['lessonSchedule'] = 'Предстоящ';
            } else {
                $teacherLessonsData[$lessonCount]['lessonSchedule'] = 'Неизвестен';
            }

            $lessonCount++;
        }

        // Reorders the array so lessons can be in a consecutive order by time
        usort($teacherLessonsData, function($a, $b) {
            $a = strtotime($a['timeRangeFrom']);
            $b = strtotime($b['timeRangeFrom']);
            return $a - $b;
        });

        $teacherWeeklyLessons = Lesson::teacherLessonsCurriculum(Auth::id());

        $teacherData['weeklyLessons']['monday'] = $teacherWeeklyLessons['Mon'];
        $teacherData['weeklyLessons']['tuesday'] = $teacherWeeklyLessons['Tue'];
        $teacherData['weeklyLessons']['wednesday'] = $teacherWeeklyLessons['Wed'];
        $teacherData['weeklyLessons']['thursday'] = $teacherWeeklyLessons['Thu'];
        $teacherData['weeklyLessons']['friday'] = $teacherWeeklyLessons['Fri'];
        $teacherData['weeklyLessons']['saturday'] = $teacherWeeklyLessons['Sat'];
        $teacherData['weeklyLessons']['sunday'] = $teacherWeeklyLessons['Sun'];
        $teacherData['todayLessons'] = $teacherLessonsData;

        //dd($teacherData);

        return $teacherData;
    }

    /**
     * Helper function for teacherHome()
     *
     * @param $gradeInfo
     * @param $notChecked
     * @return array
     */
    protected function lessonStudentsArray ($gradeInfo, $notChecked) {
        $lessonStudentsData = [];

        // Foreaches every student in the class to add info and decide whether he was in the lesson or not.
        foreach (json_decode($gradeInfo['student_ids']) as $studentID) {
            $studentName = User::getUserFullName($studentID)->first();
            $lessonStudentsData[$studentID]['studentID'] = $studentID;
            $lessonStudentsData[$studentID]['studentName'] = $studentName['name'] . ' ' . $studentName['family'];
            if (in_array($studentID, json_decode($notChecked))) {
                $lessonStudentsData[$studentID]['checked'] = false; // The student is absent
            } else {
                $lessonStudentsData[$studentID]['checked'] = true; // The student is in the lesson
            }
        }

        return $lessonStudentsData;
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

        $gradeLessons = Lesson::gradeLessonsCurriculum($grade['id']);

        $gradeData['mondayLessons'] = $gradeLessons['Mon'];
        $gradeData['tuesdayLessons'] = $gradeLessons['Tue'];
        $gradeData['wednesdayLessons'] = $gradeLessons['Wed'];
        $gradeData['thursdayLessons'] = $gradeLessons['Thu'];
        $gradeData['fridayLessons'] = $gradeLessons['Fri'];
        $gradeData['saturdayLessons'] = $gradeLessons['Sat'];
        $gradeData['sundayLessons'] = $gradeLessons['Sun'];
        $gradeData['todayLessons'] = $gradeLessons[date('D')];

        $dailyAbsences = Absence::getDailyAbsences(Auth::id())->get()->toArray();
        $weeklyAbsences = Absence::getWeeklyAbsences(Auth::id())->get()->toArray();
        $monthlyAbsences = Absence::getMonthlyAbsences(Auth::id())->get()->toArray();

        $gradeData['currentStudent']['dailyAbsences'] = $dailyAbsences;
        $gradeData['currentStudent']['weeklyAbsences'] = $weeklyAbsences;
        $gradeData['currentStudent']['monthlyAbsences'] = $monthlyAbsences;

        //dd($gradeData);

        return $gradeData;
    }

    protected function parentHome () {
        return [];
    }
}