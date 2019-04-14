<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateGradeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grade;
use App\School;
use App\User;
use Illuminate\Support\Facades\Redirect;

class AdminGradeController extends Controller
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

        $data = [
            'schools' => $schools,
        ];

        return view('admin.createGrade', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateGradeRequest $request
     * @return \Illuminate\Http\Response | Redirect
     */
    public function store(CreateGradeRequest $request)
    {
        $validated = $request->validated();

        $grade = new Grade();
        $grade->title = $validated['title'];
        $grade->school_id = $validated['school_id'];

        $grade->save();

        $school = School::find($validated['school_id']);
        $school->grades_number = intval($school['grades_number']) + 1;
        $school->save();

        return redirect('admin/grades');
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

        return view('admin.editGrade', $data);
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
        $grade = Grade::find($id)->first()->toArray();

        foreach (json_decode($grade['student_ids']) as $row) {
            $nameAndFamily = User::getUserFullName($row)->first();
            $grade['students'][] = $nameAndFamily['name'] . ' ' . $nameAndFamily['family'];
        }

        $grade['schoolTitle'] = School::getSchoolTitle($grade['school_id'])->first()['title'];
        $grade['classteacher'] = User::getUserFullName($grade['classteacher_id'])->first();

        $data = $grade;

        //dd($data);

        return view('admin.showGrade', ['data' => $data]);
    }

    /**
     * Retrieves the id and title of all grades, matched to the given school id. Request comes from AJAX.
     *
     * @param Request $request
     * @return string
     */
    public function getGradesBySchool (Request $request) {
        $grades = Grade::getGradesInfoBySchoolID($request->schoolID)->get()->toArray();

        return $grades;
    }
}
