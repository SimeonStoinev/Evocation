<?php

namespace App\Http\Controllers\Admin;

use App\Absence;
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

        $data['schools'] = School::getAllSchools()->get()->toArray();

        // Loops through all schools to match their headmaster's id to the user's name and family (ORM functions)
        foreach ($data['schools'] as &$school) {
            $headmasterName = School::find($school['id'])->headmaster;

            $school['headmasterName'] = $headmasterName['name'] . ' ' . $headmasterName['family'];
        }

        $data['dataTableColumns'] = [
            'Училище', 'Директор', 'Бр. класове', 'Бр. ученици', 'Бр. учители', 'Опции'
        ];

        return view('admin.home', [
            'schools' => $data['schools'],
            'columns' => $data['dataTableColumns'],
            'module' => 'schools'
        ]);
    }

    /**
     * Displays all grades in the Admin home page.
     *
     * @return \Illuminate\Http\Response | Redirector
     */
    public function grades () {
        session()->put('menuModule', 'grades');

        $data['grades'] = Grade::getAllGrades()->get()->toArray();

        // Loops through all grades to collect the necessary data (ORM functions)
        foreach ($data['grades'] as &$grade) {
            $grade['schoolTitle'] = Grade::find($grade['id'])->school['title'];
            $classteacher = Grade::find($grade['id'])->classteacher;
            $grade['classteacherName'] = $classteacher['name'] . ' ' . $classteacher['family'];
            $grade['studentsCount'] = count(json_decode($grade['student_ids']));
        }

        $data['dataTableColumns'] = [
            'Клас', 'Класен ръководител', 'Бр. ученици', 'Смяна', 'Училище', 'Опции'
        ];

        return view('admin.grades', [
            'grades' => $data['grades'],
            'columns' => $data['dataTableColumns'],
            'module' => 'grades'
        ]);
    }

    /**
     * Displays all users in the Admin home page.
     *
     * @param string $rank
     * @return \Illuminate\Http\Response | Redirector
     */
    public function users ($rank = 'student') {
        session()->put('menuModule', 'users');

        $data['users'] = User::getAllUsers($rank)->get()->toArray();

        // Loops through all users to collect the necessary data (ORM functions)
        foreach ($data['users'] as &$user) {
            $user['schoolTitle'] = User::find($user['id'])->school['title'];

            switch ($user['rank']) {
                case 'admin':
                    $user['rankName'] = 'Админ';
                    break;
                case 'headmaster':
                    $user['rankName'] = 'Директор';
                    break;
                case 'subheadmaster':
                    $user['rankName'] = 'Зам. директор';
                    break;
                case 'teacher':
                    $user['rankName'] = 'Учител';
                    break;
                case 'student':
                    $user['rankName'] = 'Ученик';
                    break;
                case 'parent':
                    $user['rankName'] = 'Родител';
                    break;
            }
        }

        $data['dataTableColumns'] = [
            'Име', 'Фамилия', 'Емейл', 'Училище', 'Опции'
        ];

        return view('admin.users', [
            'users' => $data['users'],
            'columns' => $data['dataTableColumns'],
            'module' => 'users',
            'rank' => $rank
        ]);
    }

    /**
     * Displays all curricula in the Admin home page.
     *
     * @param int $perPage
     * @return \Illuminate\Http\Response | Redirector
     */
    public function curricula () {
        session()->put('menuModule', 'curricula');

        $data['curricula'] = Curriculum::getAllCurricula()->get()->toArray();

        // Loops through all curricula to collect the necessary data (ORM functions)
        foreach ($data['curricula'] as &$curriculum) {
            $grade = Curriculum::find($curriculum['id'])->grade;
            $curriculum['gradeTitle'] = $grade['title'] . ' клас';
            $curriculum['gradeShift'] = $grade['shift'];
            $curriculum['schoolTitle'] = Grade::find($grade['id'])->school['title'];
        }

        $data['dataTableColumns'] = [
            'Програма на:', 'Смяна', 'Училище', 'Опции'
        ];

        return view('admin.curricula', [
            'curricula' => $data['curricula'],
            'columns' => $data['dataTableColumns'],
            'module' => 'curricula'
        ]);
    }

    /**
     * Displays all subjects in the Admin home page.
     *
     * @return \Illuminate\Http\Response | Redirector
     */
    public function subjects () {
        session()->put('menuModule', 'subjects');

        $data['subjects'] = Subject::getAllSubjects()->get()->toArray();
        $data['dataTableColumns'] = [
            'Предмет:', 'Опции'
        ];

        return view('admin.subjects', [
            'subjects' => $data['subjects'],
            'columns' => $data['dataTableColumns'],
            'module' => 'subjects'
        ]);
    }

    /**
     * Displays all absences in the Admin home page.
     *
     * @return \Illuminate\Http\Response | Redirector
     */
    public function absences () {
        session()->put('menuModule', 'absences');

        $data['absences'] = Absence::all()->toArray();

        // Loops through all absences to collect the necessary data (ORM functions)
        foreach ($data['absences'] as &$absence) {
            $id = $absence['id'];

            $timestamp = explode(' ', $absence['created_at']);
            $userName = Absence::find($id)->user;
            $absence['userName'] = $userName['name'] . ' ' . $userName['family'];
            $absence['lessonTitle'] = Absence::find($id)->lesson['title'];
            $absence['gradeTitle'] = Absence::find($id)->grade['title'];
            $absence['schoolTitle'] = Absence::find($id)->school['title'];
            $absence['date'] = $timestamp[0];
            $absence['time'] = $timestamp[1];

            if ($absence['excused']) {
                $absence['excused'] = 'ДА';
            } else {
                $absence['excused'] = 'НЕ';
            }

            if ($absence['late']) {
                $absence['late'] = 'ДА';
            } else {
                $absence['late'] = 'НЕ';
            }
        }

        $data['dataTableColumns'] = [
            'Име', 'Учебен час', 'Клас', 'Училище', 'Дата', 'Час', 'Извинено', 'Закъснение', 'Опции'
        ];

        return view('admin.absences', [
            'absences' => $data['absences'],
            'columns' => $data['dataTableColumns'],
            'module' => 'absences'
        ]);
    }

    /**
     * Displays all accounts which await verification in the Admin home page.
     *
     * @return \Illuminate\Http\Response | Redirector
     */
    public function verifyAccounts () {
        session()->put('menuModule', 'verify');

        $data['unverifiedUsers'] = User::getAllUnverifiedUsers()->get()->toArray();

        // Loops through all unverified users to collect the necessary data (ORM functions)
        foreach ($data['unverifiedUsers'] as &$unverifiedUser) {
            $unverifiedUser['schoolTitle'] = User::find($unverifiedUser['id'])->school['title'];

            switch ($unverifiedUser['rank']) {
                case 'admin':
                    $unverifiedUser['rankName'] = 'Админ';
                    break;
                case 'headmaster':
                    $unverifiedUser['rankName'] = 'Директор';
                    break;
                case 'subheadmaster':
                    $unverifiedUser['rankName'] = 'Зам. директор';
                    break;
                case 'teacher':
                    $unverifiedUser['rankName'] = 'Учител';
                    break;
                case 'student':
                    $unverifiedUser['rankName'] = 'Ученик';
                    break;
                case 'parent':
                    $unverifiedUser['rankName'] = 'Родител';
                    break;
            }
        }

        //dd($data);

        $data['dataTableColumns'] = [
            'Име', 'Фамилия', 'Емейл', 'Ниво на достъп', 'Училище', 'Потвърди'
        ];

        return view('admin.verifyAccounts', [
            'unverifiedUsers' => $data['unverifiedUsers'],
            'columns' => $data['dataTableColumns'],
            'module' => 'verify'
        ]);
    }
}
