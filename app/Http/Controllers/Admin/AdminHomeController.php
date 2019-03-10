<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;
use App\Grade;
use App\User;
use App\Curriculum;
use App\Subject;

class AdminHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->adminHomeData();

        return view('admin.home', ['data' => $data]);
    }

    /**
     * Gathers all the data needed to display the admin account.
     * Should only be used for home page on an admin login.
     *
     * @return array
     */
    protected function adminHomeData () {
        $adminData = [];

        $adminData['schools'] = School::getAllSchools()->get()->toArray();
        $adminData['grades'] = Grade::getAllGrades()->get()->toArray();
        $adminData['users'] = User::getAllUsers()->take(100)->get()->toArray(); // Paging!
        $curricula = Curriculum::getAllCurricula()->get()->toArray();

        foreach ($curricula as &$curriculum) {
            $curriculum['gradeTitle'] = Grade::getGradeTitleAndStudents($curriculum['grade_id'])->first()['title'];
        }

        $adminData['curricula'] = $curricula;

        $adminData['subjects'] = Subject::getAllSubjects()->get()->toArray();

        //dd($adminData);

        return $adminData;
    }
}
