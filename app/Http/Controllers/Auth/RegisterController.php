<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Grade;
use App\School;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Takes care of displaying the register page and the passing down of the proper data to the view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm () {
        $schools = School::all()->toArray();
        $gradesBySchool = [];

        foreach ($schools as $row) {
            $gradesBySchool[$row['id']] = Grade::gradesBySchoolID($row['id'])->get()->toArray();
        }

        $data = [
            'schools' => $schools,
            'grades' => $gradesBySchool
        ];

        return view('auth.register', $data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'family' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'rank' => [
                'required',
                Rule::in(['subheadmaster', 'teacher', 'student', 'parent'])
            ],
            'school' => 'required|string|max:10',
            'grade' => 'string|max:10',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //dd($data);
        return User::create([
            'card_id' => str_random(16),
            'name' => $data['name'],
            'family' => $data['family'],
            'email' => $data['email'],
            'rank' => $data['rank'],
            'school_id' => $data['school'],
            'grade_id' => $data['grade'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
