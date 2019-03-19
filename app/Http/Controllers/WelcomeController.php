<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

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

    /**
     * Sends an email from the welcome page contact form.
     *
     * @param Request $request
     * @return ContactMail | string
     */
    public function sendContactMail (Request $request) {
        $contactMail = [];
        $contactMail['name'] = trim($request->name);
        $contactMail['email'] = trim($request->email);
        $contactMail['subject'] = trim($request->subject);
        $contactMail['message'] = trim($request->message);

        Mail::to(['seternals8@gmail.com'])->send(new ContactMail($contactMail));

        return 'OK';
    }
}
