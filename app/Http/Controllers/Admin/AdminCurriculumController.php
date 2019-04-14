<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCurriculumRequest;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Curriculum;
use App\Lesson;
use App\School;
use App\Grade;
use Illuminate\Support\Facades\Redirect;

class AdminCurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response | void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all()->toArray();
        $subjects = Subject::all()->toArray();

        $data = [
            'schools' => $schools,
            'subjects' => $subjects,
            'daysOfWeek' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            'daysOfWeekBg' => ['Понеделник', 'Вторник', 'Сряда', 'Четвъртък', 'Петък']
        ];

        return view('admin.createCurriculum', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCurriculumRequest  $request
     * @return \Illuminate\Http\Response | Redirect
     */
    public function store(CreateCurriculumRequest $request)
    {
        $lessonsIDs = [
            'Mon' => [],
            'Tue' => [],
            'Wed' => [],
            'Thu' => [],
            'Fri' => []
        ];

        for ($i = 0; $i < count($request->lessons); $i++) {
            $newLesson = new Lesson();

            $newLesson->title = trim($request->subjects[$i]);
            $newLesson->grade_id = $request->grade;
            $newLesson->teacher_id = $request->teachers[$i];
            $newLesson->time_range_from = $this->fixHrsAndMins($request->fromHrs[$i]) . ':' . $this->fixHrsAndMins($request->fromMins[$i]);
            $newLesson->time_range_to = $this->fixHrsAndMins($request->toHrs[$i]) . ':' . $this->fixHrsAndMins($request->toMins[$i]);
            $newLesson->day = $request->days[$i];

            $newLesson->save();

            if ($request->days[$i] === 'Mon') {
                $lessonsIDs['Mon'][] = $newLesson->id;
            } elseif ($request->days[$i] === 'Tue') {
                $lessonsIDs['Tue'][] = $newLesson->id;
            } elseif ($request->days[$i] === 'Wed') {
                $lessonsIDs['Wed'][] = $newLesson->id;
            } elseif ($request->days[$i] === 'Thu') {
                $lessonsIDs['Thu'][] = $newLesson->id;
            } else {
                $lessonsIDs['Fri'][] = $newLesson->id;
            }
        }

        $curriculum = new Curriculum();
        $curriculum->grade_id = $request->grade;
        $curriculum->lessons_data = json_encode($lessonsIDs);

        $curriculum->save();

        return redirect('admin/curricula');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];

        return view('admin.editCurriculum', $data);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function display($id) {
        $data = Curriculum::find($id)->first()->toArray();

        $grade = Grade::where('id', $data['grade_id'])->first();
        $data['grade'] = $grade['title'];
        $data['schoolTitle'] = School::where('id', $grade['id'])->first()['title'];

        $data['lessons'] = ['Mon' => [], 'Tue' => [], 'Wed' => [], 'Thu' => [], 'Fri' => []];

        foreach (json_decode($data['lessons_data']) as $key => $row) {
            foreach ($row as $lesson) {
                $lessonInfo = Lesson::where('id', $lesson)->first()->toArray();
                $teacherFullName = User::getUserFullName($lessonInfo['teacher_id'])->first();
                $lessonInfo['teacherName'] = $teacherFullName['name'] . ' ' . $teacherFullName['family'];

                $data['lessons'][$key][] = $lessonInfo;
            }
        }

        if (array_key_exists('Sat', $data['lessons'])) {
            unset($data['lessons']['Sat']);
        }

        if (array_key_exists('Sun', $data['lessons'])) {
            unset($data['lessons']['Sun']);
        }

        $data['daysOfWeekBg'] = ['Понеделник', 'Вторник', 'Сряда', 'Четвъртък', 'Петък'];

        //dd($data);

        return view('admin.showCurriculum', ['data' => $data]);
    }

    /**
     * Request comes from AJAX.
     *
     * @param Request $request
     * @return array
     */
    public function getGradesAndTeachers (Request $request) {
        $grades = Grade::getGradesInfoBySchoolID($request->schoolID)->get()->toArray();
        $teachers = User::getTeachersBySchoolID($request->schoolID)->get()->toArray();

        return [$grades, $teachers];
    }

    /**
     * Adds a starting zero.
     *
     * @param $time
     * @return string
     */
    protected function fixHrsAndMins ($time) {
        if (strval(strlen(trim($time))) === '1') {
            $retVal = '0' . strval(trim($time));
        } elseif (strval(strlen(trim($time))) === '0') {
            $retVal = '00';
        } elseif ($time === null) {
            $retVal = '00';
        } else {
            $retVal = trim($time);
        }

        return $retVal;
    }
}
