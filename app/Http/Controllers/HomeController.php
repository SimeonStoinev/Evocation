<?php

namespace App\Http\Controllers;

use App\Curriculum;
use App\Subject;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Absence;
use App\CheckinListener;
use App\User;
use App\Grade;
use App\School;
use App\Lesson;
use App\Entry;

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
     * @return \Illuminate\Http\Response | Logout
     */
    public function index()
    {
        $currUserRank = User::getCurrUserRank(Auth::id())->first()['rank'];

        if ($currUserRank == 'headmaster') {
            $data = $this->headmasterHome();

            return view('home.headmasterHome', ['data' => $data]);
        } elseif ($currUserRank == 'subheadmaster') {
            $data = $this->subHeadmasterHome();

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

    /**
     * Gathers all the data needed to display the school's Headmaster panel.
     * Should only be used for home page on a headmaster login.
     *
     * @return array
     */
    protected function headmasterHome () {
        return [];
    }

    /**
     * Gathers all the data needed to display the school's SubHeadmaster panel.
     * Should only be used for home page on a subheadmaster login.
     *
     * @return array
     */
    protected function subHeadmasterHome () {
        return [];
    }

    /**
     * Gathers all the data needed to display the current schedule for the teacher.
     * Should only be used for home page on a teacher login.
     *
     * @return array
     */
    protected function teacherHome () {
        $teacherInfo = User::where('id', Auth::id())->first()->toArray();

        if ($teacherInfo != null) {
            $teacherInfo['school'] = School::getSchoolTitle($teacherInfo['school_id'])->first()['title'];
            if ($teacherInfo['is_classteacher']) {
                $teacherInfo['gradeTitle'] = Grade::gradeByClassTeacherID($teacherInfo['id'])->first()['title'];

                $grade = Grade::gradeByClassTeacherID(Auth::id())->first();

                $gradeData = [];

                // Fills the $gradeData array with all the students' names from this grade
                foreach (json_decode($grade['student_ids']) as $row) {
                    $nameAndFamily = User::getUserFullName($row)->first();

                    $gradeData['students'][] = [
                        'name' => $nameAndFamily['name'] . ' ' . $nameAndFamily['family'],
                        'absencesCount' => Absence::countAbsences($row),
                        'dailyAbsences' => Absence::getDailyAbsences($row),
                        'weeklyAbsences' => Absence::getWeeklyAbsences($row),
                        'monthlyAbsences' => Absence::getMonthlyAbsences($row),
                        'excusedAbsencesCount' => Absence::countExcusedAbsences($row),
                        'excusedAbsences' => Absence::getExcusedAbsences($row)
                    ];
                }

                $gradeLessons = Lesson::gradeLessonsCurriculum($grade['id']);

                $gradeData['mondayLessons'] = $gradeLessons['Mon'];
                $gradeData['tuesdayLessons'] = $gradeLessons['Tue'];
                $gradeData['wednesdayLessons'] = $gradeLessons['Wed'];
                $gradeData['thursdayLessons'] = $gradeLessons['Thu'];
                $gradeData['fridayLessons'] = $gradeLessons['Fri'];
                $gradeData['saturdayLessons'] = $gradeLessons['Sat'];
                $gradeData['sundayLessons'] = $gradeLessons['Sun'];
                $gradeData['todayLessons'] = $gradeLessons[date('D')];

                $teacherInfo['gradeData'] = $gradeData;
            }
        }

        $teacherLessons = Lesson::getTeacherLessonsToday(Auth::id())->get()->toArray();

        $teacherLessonsData = []; $teacherData = ['teacherInfo' => $teacherInfo];
        //$currentTime = date('H:i');
        $currentTime = '18:10';

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

        // Loops through every student in the class to add info and decide whether he was in the lesson or not.
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

        $studentData = [
            'title' => $grade['title']
        ];

        // Fills the $studentData array with all the students' names from this grade
        foreach (json_decode($grade['student_ids']) as $row) {
            $nameAndFamily = User::getUserFullName($row)->first();
            $studentData['students'][] = $nameAndFamily['name'] . ' ' . $nameAndFamily['family'];
        }

        $classteacher = User::getUserFullName($grade['classteacher_id'])->first();
        $studentData['classteacher'] = $classteacher['name'] . ' ' . $classteacher['family'];

        $studentData['school'] = School::getSchoolTitle($grade['school_id'])->first()['title'];

        $gradeLessons = Lesson::gradeLessonsCurriculum($grade['id']);

        $studentData['mondayLessons'] = $gradeLessons['Mon'];
        $studentData['tuesdayLessons'] = $gradeLessons['Tue'];
        $studentData['wednesdayLessons'] = $gradeLessons['Wed'];
        $studentData['thursdayLessons'] = $gradeLessons['Thu'];
        $studentData['fridayLessons'] = $gradeLessons['Fri'];
        $studentData['saturdayLessons'] = $gradeLessons['Sat'];
        $studentData['sundayLessons'] = $gradeLessons['Sun'];
        $studentData['todayLessons'] = $gradeLessons[date('D')];

        $studentData['currentStudent']['absencesCount'] = Absence::countAbsences(Auth::id());
        $studentData['currentStudent']['dailyAbsences'] = Absence::getDailyAbsences(Auth::id());
        $studentData['currentStudent']['weeklyAbsences'] = Absence::getWeeklyAbsences(Auth::id());
        $studentData['currentStudent']['monthlyAbsences'] = Absence::getMonthlyAbsences(Auth::id());
        $studentData['currentStudent']['excusedAbsencesCount'] = Absence::countExcusedAbsences(Auth::id());
        $studentData['currentStudent']['excusedAbsences'] = Absence::getExcusedAbsences(Auth::id());

        //dd($studentData);

        return $studentData;
    }

    /**
     * Gathers all the data needed to display a parent profile info.
     * Should only be used for home page on a parent login.
     *
     * @return array
     */
    protected function parentHome () {
        $parentData = [];

        $children = User::getLinkedChildren(Auth::id())->get()->toArray();

        // Fills the $parentData with the necessary data about their children.
        foreach ($children as $child) {
            $parentData[$child['id']]['childData'] = $child;

            $grade = Grade::gradeByStudentID($child['id'])->first();

            $parentData[$child['id']]['childData']['gradeTitle'] = $grade['title'];
            $parentData[$child['id']]['childData']['schoolTitle'] = School::getSchoolTitle($grade['school_id'])->first()['title'];

            $entry = Entry::getUserEntries($child['id'])->get()->last();

            if ($entry == null) {
                $entry['status'] = '1';
                $entry['created_at'] = '2019-03-10 20:10:34';
                $entry['entered'] = false;
            } else {
                $entry['entered'] = true;
            }

            $parentData[$child['id']]['lastEntry'] = $entry;

            // Decides if the children is in the school or not
            if ($entry['status'] == '0') {
                $parentData[$child['id']]['lastEntry']['isInSchool'] = true;
            } else {
                $parentData[$child['id']]['lastEntry']['isInSchool'] = false;
            }

            $timestamp = explode(' ', $entry['created_at']);
            $date = explode('-', $timestamp[0]);
            $parentData[$child['id']]['lastEntry']['time'] = $timestamp[1];
            $parentData[$child['id']]['lastEntry']['date'] = $date[2] . '.' . $date[1] . '.' . $date[0];
            $parentData[$child['id']]['lastEntry']['entered'] = $entry['entered'];

            $parentData[$child['id']]['absences']['absencesCount'] = Absence::countAbsences($child['id']);
            $parentData[$child['id']]['absences']['dailyAbsences'] = Absence::getDailyAbsences($child['id']);
            $parentData[$child['id']]['absences']['weeklyAbsences'] = Absence::getWeeklyAbsences($child['id']);
            $parentData[$child['id']]['absences']['monthlyAbsences'] = Absence::getMonthlyAbsences($child['id']);
            $parentData[$child['id']]['absences']['excusedAbsencesCount'] = Absence::countExcusedAbsences($child['id']);
            $parentData[$child['id']]['absences']['excusedAbsences'] = Absence::getExcusedAbsences($child['id']);

            $gradeLessons = Lesson::gradeLessonsCurriculum($child['grade_id']);

            $parentData[$child['id']]['lessons']['mondayLessons'] = $gradeLessons['Mon'];
            $parentData[$child['id']]['lessons']['tuesdayLessons'] = $gradeLessons['Tue'];
            $parentData[$child['id']]['lessons']['wednesdayLessons'] = $gradeLessons['Wed'];
            $parentData[$child['id']]['lessons']['thursdayLessons'] = $gradeLessons['Thu'];
            $parentData[$child['id']]['lessons']['fridayLessons'] = $gradeLessons['Fri'];
            $parentData[$child['id']]['lessons']['saturdayLessons'] = $gradeLessons['Sat'];
            $parentData[$child['id']]['lessons']['sundayLessons'] = $gradeLessons['Sun'];
        }

        return array_reverse($parentData);
    }

    /**
     * Request comes from AJAX.
     *
     * @param Request $request
     */
    public function putHomeSession (Request $request) {
        Session::put('home', $request->sessionValue);
        Session::put('cardHeader', $request->cardHeader);
    }
}