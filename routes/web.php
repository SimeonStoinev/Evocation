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
Route::post('/', 'WelcomeController@sendContactMail')->name('welcome.sendContactMail');

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
    'subjects' => 'SubjectController',
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

// Admin routes
Route::middleware('admin')->group(function () {
    Route::get('/admin/home', 'Admin\AdminHomeController@index')->name('admin.home');


    // Admin School routes
    Route::resource('admin/schools', 'Admin\AdminSchoolController')->except([
        'update', 'destroy', 'show'
    ])->names([
        'index' => 'adminSchools.index',
        'store' => 'adminSchools.store',
        'create' => 'adminSchools.create',
        'edit' => 'adminSchools.edit'
    ]);

    Route::post('/admin/schools/update', 'Admin\AdminSchoolController@update')->name('adminSchools.update');
    Route::post('/admin/schools/destroy', 'Admin\AdminSchoolController@destroy')->name('adminSchools.destroy');
    // End of Admin School routes


    // Admin Grade routes
    Route::resource('admin/grades', 'Admin\AdminGradeController')->except([
        'index', 'show'
    ])->names([
        'index' => 'adminGrades.index',
        'store' => 'adminGrades.store',
        'create' => 'adminGrades.create',
        'update' => 'adminGrades.update',
        'destroy' => 'adminGrades.destroy',
        'edit' => 'adminGrades.edit'
    ]);

    Route::get('/admin/grades/{perPage?}', 'Admin\AdminHomeController@grades')->name('admin.grades');
    Route::get('/admin/grade/{id?}', 'Admin\AdminGradeController@display')->name('adminGrades.display');
    Route::post('/admin/getGradesBySchool', 'Admin\AdminGradeController@getGradesBySchool')->name('adminGrades.getGrades');
    // End of Admin Grade routes


    // Admin User routes
    Route::resource('admin/users', 'Admin\AdminUserController')->except([
        'index', 'show'
    ])->names([
        'index' => 'adminUsers.index',
        'store' => 'adminUsers.store',
        'create' => 'adminUsers.create',
        'update' => 'adminUsers.update',
        'destroy' => 'adminUsers.destroy',
        'edit' => 'adminUsers.edit'
    ]);

    Route::get('/admin/users/{perPage?}', 'Admin\AdminHomeController@users')->name('admin.users');
    Route::get('/admin/user/{id?}', 'Admin\AdminUserController@display')->name('adminUsers.display');
    // End of Admin User routes


    // Admin Curriculum routes
    Route::resource('admin/curricula', 'Admin\AdminCurriculumController')->except([
        'index', 'show'
    ])->names([
        'index' => 'adminCurricula.index',
        'store' => 'adminCurricula.store',
        'create' => 'adminCurricula.create',
        'update' => 'adminCurricula.update',
        'destroy' => 'adminCurricula.destroy',
        'edit' => 'adminCurricula.edit'
    ]);

    Route::get('/admin/curricula/{perPage?}', 'Admin\AdminHomeController@curricula')->name('admin.curricula');
    Route::get('/admin/curriculum/{id?}', 'Admin\AdminCurriculumController@display')->name('adminCurricula.display');
    Route::post('/admin/getGradesAndTeachers', 'Admin\AdminCurriculumController@getGradesAndTeachers')->name('adminCurricula.getGradesAndTeachers');
    // End of Admin Curriculum routes


    // Admin Subject routes
    Route::resource('admin/subjects', 'Admin\AdminSubjectController')->except([
        'index', 'update', 'destroy', 'show'
    ])->names([
        'index' => 'adminSubjects.index',
        'store' => 'adminSubjects.store',
        'create' => 'adminSubjects.create',
        'edit' => 'adminSubjects.edit'
    ]);

    Route::get('/admin/subjects/{perPage?}', 'Admin\AdminHomeController@subjects')->name('admin.subjects');
    Route::post('/admin/subjects/update', 'Admin\AdminSubjectController@update')->name('adminSubjects.update');
    Route::post('/admin/subjects/destroy', 'Admin\AdminSubjectController@destroy')->name('adminSubjects.destroy');
    // End of Admin Subject routes
});