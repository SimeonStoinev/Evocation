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

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'checkins' => 'CheckinListenerController',
    'classbooks' => 'ClassbookController',
    'curricula' => 'CurriculumController',
    'entries' => 'EntryController',
    'exams' => 'ExamController',
    'grade' => 'GradeController',
    'leaves' => 'LeaveController',
    'polls' => 'PollController',
    'presentations' => 'PresentationController',
    'schools' => 'SchoolController',
    'verify' => 'VerifyController'
]);

//Route::get('/absence/{cardID?}', 'API\AbsenceController@index')->name('absences.index');
Route::post('/absence/excuse', 'API\AbsenceController@excuseAbsence')->name('absences.excuse');
Route::post('/absence/write', 'API\AbsenceController@writeAbsence')->name('absences.write');
Route::post('/checkins/refreshCheckedUsers', 'CheckinListenerController@refreshCheckedUsers')->name('checkins.refresh');
Route::post('/checkins/close/', 'CheckinListenerController@closeCheckin')->name('checkins.close');

Route::post('/absence', 'API\AbsenceController@store')->name('absence.store');

/*Route::apiResource('absence', 'API\AbsenceController')->except([
    'index'
]);*/