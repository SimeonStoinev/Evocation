<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Decides if the user is admin and redirects him to the admin control panel (url) if so.
     * Checks if the account is verified and if user credentials match.
     * Returns session with errors for the user login attempt if user credentials are incorrect.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password'), 'rank' => 'admin', 'verified' => '1'])) {
            return redirect('/admin/home');
        } elseif (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password'), 'verified' => '1'])) {
            return redirect('/home');
        }
        elseif (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]) == false) {
            return redirect('/login')->with('wrongAuthData', 'Не съществува потребител с такъв е-майл или парола.');
        }
        else {
            return redirect('/verify');
        }
    }
}
