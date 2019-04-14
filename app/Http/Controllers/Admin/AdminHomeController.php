<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\School;
use App\Grade;
use App\User;
use App\Curriculum;
use App\Subject;
use Illuminate\Routing\Redirector;

class AdminHomeController extends Controller
{
    /**
     * Displays all schools in the Admin home page.
     *
     * @return \Illuminate\Http\Response | Redirector
     */
    public function index () {
        session()->put('menuModule', 'home');

        $data = School::getAllSchools()->get()->toArray();

        return view('admin.home', ['data' => $data, 'module' => 'schools']);
    }

    /**
     * Displays all grades in the Admin home page.
     *
     * @param int $perPage
     * @return \Illuminate\Http\Response | Redirector
     */
    public function grades ($perPage = 25) {
        session()->put('menuModule', 'grades');

        $data = Grade::getAllGrades()->paginate($perPage);

        foreach ($data as &$row) {
            $row['schoolTitle'] = School::getSchoolTitle($row['school_id'])->first()['title'];

        }

        return view('admin.grades', ['data' => $data, 'perPage' => $perPage, 'module' => 'grades']);
    }

    /**
     * Displays all users in the Admin home page.
     *
     * @param int $perPage
     * @return \Illuminate\Http\Response | Redirector
     */
    public function users ($perPage = 25) {
        session()->put('menuModule', 'users');

        $data = User::getAllUsers()->paginate($perPage);

        return view('admin.users', ['data' => $data, 'perPage' => $perPage, 'module' => 'users']);
    }

    /**
     * Displays all curricula in the Admin home page.
     *
     * @param int $perPage
     * @return \Illuminate\Http\Response | Redirector
     */
    public function curricula ($perPage = 25) {
        session()->put('menuModule', 'curricula');

        $curricula = Curriculum::getAllCurricula()->paginate($perPage);

        foreach ($curricula as &$curriculum) {
            $curriculum['gradeTitle'] = Grade::getGradeTitleAndStudents($curriculum['grade_id'])->first()['title'];
            $grade = Grade::find($curriculum['grade_id']);
            $curriculum['schoolTitle'] = School::getSchoolTitle($grade['school_id'])->first()['title'];
        }

        $data = $curricula;

        return view('admin.curricula', ['data' => $data, 'perPage' => $perPage, 'module' => 'curricula']);
    }

    /**
     * Displays all subjects in the Admin home page.
     *
     * @param int $perPage
     * @return \Illuminate\Http\Response | Redirector
     */
    public function subjects ($perPage = 50) {
        session()->put('menuModule', 'subjects');

        $data = Subject::getAllSubjects()->paginate($perPage);

        return view('admin.subjects', ['data' => $data, 'module' => 'subjects']);
    }
}
