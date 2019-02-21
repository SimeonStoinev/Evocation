<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;

class WelcomeController extends Controller
{
    /**
     * Handles the welcome (landing) page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index () {
        $schools = School::getAllSchools()->get();
        $appNumbers = [
            'students' => 0,
            'grades' => 0,
            'schools' => 0
        ];

        foreach ($schools as $school) {
            $appNumbers['schools']++;
            $appNumbers['students'] += $school['students_number'];
            $appNumbers['grades'] += $school['grades_number'];
        }

        return view('welcome', ['numbers' => $appNumbers]);
    }
}
