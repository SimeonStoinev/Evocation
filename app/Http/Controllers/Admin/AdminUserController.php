<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\School;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response | void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all()->toArray();

        $data = [
            'schools' => $schools,
        ];

        return view('admin.createUser', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserRequest  $request
     * @return \Illuminate\Http\Response | Redirect
     */
    public function store(CreateUserRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->card_id = str_random(6);
        $user->name = $validated['name'];
        $user->family = $validated['family'];
        $user->email = $validated['email'];
        $user->password = Hash::make( $validated['password'] );
        $user->rank = $validated['rank'];
        $user->is_classteacher = $validated['is_classteacher'];
        $user->school_id = $validated['school_id'];
        $user->grade_id = $validated['grade'];

        $user->save();

        if ($validated['rank'] === 'student') {
            $school = School::find($validated['school_id']);
            $school->students_number = intval($school['students_number']) + 1;
            $school->save();
        } elseif ($validated['rank'] === 'teacher') {
            $school = School::find($validated['school_id']);
            $school->teachers_number = intval($school['teachers_number']) + 1;
            $school->save();
        }

        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response | void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response | void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response | void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response | void
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function display($id) {
        $data = User::where('id', $id)->first()->toArray();

        if (!$data['grade_id']) {
            $data['grade'] = 'Няма';
        } else {
            $data['grade'] = Grade::where('id', $data['grade_id'])->first()['title'];
        }

        if (!$data['school_id']) {
            $data['schoolTitle'] = 'Няма';
        } else {
            $data['schoolTitle'] = School::getSchoolTitle($data['school_id'])->first()['title'];
        }

        if (!$data['verified']) {
            $data['isVerified'] = 'НЕ';
        } else {
            $data['isVerified'] = 'ДА';
        }

        return view('admin.showUser', ['data' => $data]);
    }
}
