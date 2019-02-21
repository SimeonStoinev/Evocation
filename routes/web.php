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

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'checkins' => 'CheckinListenerController',
    'classbooks' => 'ClassbookController',
    'curricula' => 'CurriculumController',
    'entries' => 'EntryController',
    'exams' => 'ExamController',
    'grades' => 'GradeController',
    'leaves' => 'LeaveController',
    'polls' => 'PollController',
    'presentations' => 'PresentationController',
    'schools' => 'SchoolController',
    'verify' => 'VerifyController'
]);

Route::get('/absence/{cardID?}', 'API\AbsenceController@index')->name('absences.index');
Route::post('/checkins/close/', 'CheckinListenerController@closeCheckin')->name('checkins.close');

Route::apiResource('absence', 'API\AbsenceController')->except([
    'index'
]);