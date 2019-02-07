<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Overwriting the default register index route
//Route::get('/register', 'Auth\RegisterController@index')->name('register');

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'absences' => 'AbsenceController',
    'cirricula' => 'CurriculumController',
    'classbooks' => 'ClassbookController',
    'entries' => 'EntryController',
    'exams' => 'ExamController',
    'grades' => 'GradeController',
    'leaves' => 'LeaveController',
    'polls' => 'PollController',
    'presentations' => 'PresentationController',
    'schools' => 'SchoolController'
]);