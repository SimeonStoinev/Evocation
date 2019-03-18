<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Grade;
use App\School;
use App\Lesson;
use App\Absence;

class GradeController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isClassTeacher = User::isUserAClassTeacher(Auth::id());

        if ($isClassTeacher) {
            $grade = Grade::gradeByClassTeacherID(Auth::id())->first();

            $gradeData = [
                'title' => $grade['title']
            ];

            // Fills the $gradeData array with all the students' names from this grade
            foreach (json_decode($grade['student_ids']) as $row) {
                $nameAndFamily = User::getUserFullName($row)->first();
                $dailyAbsences = Absence::getDailyAbsences($row)->get()->toArray();
                $weeklyAbsences = Absence::getWeeklyAbsences($row)->get()->toArray();
                $monthlyAbsences = Absence::getMonthlyAbsences($row)->get()->toArray();
                $gradeData['students'][] = [
                    'name' => $nameAndFamily['name'] . ' ' . $nameAndFamily['family'],
                    'dailyAbsences' => $dailyAbsences,
                    'weeklyAbsences' => $weeklyAbsences,
                    'monthlyAbsences' => $monthlyAbsences
                ];
            }

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

            //dd($gradeData);

            return view('grade', ['data' => $gradeData]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response | void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response | void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response | void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response | void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response | void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response | void
     */
    public function destroy($id)
    {
        //
    }
}
