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
Route::post('/', 'WelcomeController@sendMail')->name('welcome.sendMail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/putSession', 'HomeController@putHomeSession')->name('home.putSession');

Route::resources([
    'checkins' => 'CheckinListenerController',
    'classbooks' => 'ClassbookController',
    'curricula' => 'CurriculumController',
    'entries' => 'EntryController',
    'exams' => 'ExamController',
    'grade' => 'GradeController',
    'polls' => 'PollController',
    'presentations' => 'PresentationController',
    'schools' => 'SchoolController',
    'verify' => 'VerifyController'
]);

// Absences
Route::post('/absence/excuse', 'API\AbsenceController@excuseAbsence')->name('absences.excuse');
Route::post('/absence/excuseByClassteacher', 'API\AbsenceController@excuseAbsenceByClassteacher')->name('absences.excuseByClassteacher');
Route::post('/absence/write', 'API\AbsenceController@writeAbsence')->name('absences.write');
Route::post('/absence', 'API\AbsenceController@store')->name('absence.store');

// Checkins
Route::post('/checkins/refreshCheckedUsers', 'CheckinListenerController@refreshCheckedUsers')->name('checkins.refresh');
Route::post('/checkins/close/', 'CheckinListenerController@closeCheckin')->name('checkins.close');

// Schools
Route::post('/schools/update/', 'SchoolController@update')->name('schools.update');
Route::post('/schools/destroy/', 'SchoolController@destroy')->name('schools.destroy');

// Admin routes
Route::get('/admin/home', 'Admin\AdminHomeController@index')->name('adminHome');