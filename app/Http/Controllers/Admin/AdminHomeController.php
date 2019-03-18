<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;
use App\Grade;
use App\User;
use App\Curriculum;
use App\Subject;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * Displays all schools in the Admin home page.
     *
     * @return \Illuminate\Http\Response | Redirector
     */
    public function index ()
    {
        $data = School::getAllSchools()->get()->toArray();

        return view('admin.home', ['data' => $data]);
    }

    /**
     *
     *
     * @param int $perPage
     * @return \Illuminate\Http\Response | Redirector
     */
    public function grades ($perPage = 25) {
        $data = Grade::getAllGrades()->paginate($perPage);

        foreach ($data as &$row) {
            $row['schoolTitle'] = School::getSchoolTitle($row['school_id'])->first()['title'];

        }

        //dd($data);

        return view('admin.grades', ['data' => $data]);
    }

    /**
     *
     *
     * @param int $perPage
     * @return \Illuminate\Http\Response | Redirector
     */
    public function users ($perPage = 25) {
        $data = User::getAllUsers()->paginate($perPage); // Paging!

        return view('admin.users', ['data' => $data]);
    }

    /**
     *
     *
     * @param int $perPage
     * @return \Illuminate\Http\Response | Redirector
     */
    public function curricula ($perPage = 25) {
        $curricula = Curriculum::getAllCurricula()->paginate($perPage);

        foreach ($curricula as &$curriculum) {
            $curriculum['gradeTitle'] = Grade::getGradeTitleAndStudents($curriculum['grade_id'])->first()['title'];
        }

        $data = $curricula;

        return view('admin.curricula', ['data' => $data]);
    }

    /**
     *
     * @param int $perPage
     * @return \Illuminate\Http\Response | Redirector
     */
    public function subjects ($perPage = 50) {
        $data = Subject::getAllSubjects()->paginate($perPage);

        return view('admin.subjects', ['data' => $data]);
    }
}
