@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-8">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <h3>Добави програма</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('admin/curricula') }}" method="post">
                            @csrf

                            <div class="form-group school">
                                <label for="curriculumFormSchool">{{ 'Училище:' }}</label>
                                <br>
                                <select name="school_id" class="form-control col-md-12" id="curriculumFormSchool">
                                    <option value="0">{{('Изберете училище:')}}</option>
                                    @foreach($schools as $row)
                                        <option value="{{ $row['id'] }}">{{ $row['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group grade" style="display: none;">
                                <label for="curriculumFormGrade">{{ 'Клас:' }}</label>
                                <br>
                                <select id="curriculumFormGrade" name="grade" class="form-control{{ $errors->has('grade') ? ' is-invalid' : '' }}" required>
                                    <option value="0">{{'Изберете клас:'}}</option>
                                </select>
                            </div>

                            <div id="lessons" style="display: none;">
                                @php $count = 0; @endphp
                                @foreach ($daysOfWeek as $day)
                                    <div class="form-group dayLessonsWrapper">
                                        <h3 style="text-align: center;">{{ $daysOfWeekBg[$count] }}</h3>

                                        <div class="singleFormLesson">
                                            <button onclick="deleteFormLesson(this)" type="button" class="btn-outline-danger deleteLessonBtn" disabled><i class="icon-close"></i></button>
                                            <p style="text-align: center;">Час номер 1</p>
                                            <input type="hidden" name="days[]" value="{{ $day }}">
                                            <input type="hidden" name="lessons[]" value="1">

                                            <label>{{ 'Предмет:' }}</label>
                                            <br>
                                            <select name="subjects[]" class="form-control">
                                                <option value="0">{{ 'Изберете предмет:' }}</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject['title'] }}">{{ $subject['title'] }}</option>
                                                @endforeach
                                            </select>

                                            <label>{{ 'Преподавател:' }}</label>
                                            <br>
                                            <select name="teachers[]" class="form-control teachers">
                                                <option value="0">{{ 'Изберете преподавател:' }}</option>
                                            </select>

                                            <label>{{ 'Часови диапазон:' }}</label>
                                            <br>
                                            <label>{{ 'От:' }}</label>
                                            <input type="number" max="23" name="fromHrs[]" class="curriculumFormTime" placeholder="Час: 00">
                                            :
                                            <input type="number" max="59" name="fromMins[]" class="curriculumFormTime" placeholder="Минути: 40">

                                            <label>{{ 'До:' }}</label>
                                            <input type="number" max="23" name="toHrs[]" class="curriculumFormTime" placeholder="Час: 00">
                                            :
                                            <input type="number" max="59" name="toMins[]" class="curriculumFormTime" placeholder="Минути: 40">
                                        </div>

                                        <button onclick="addFormLesson(this)" class="btn btn-outline-success" type="button">Добави час <i class="icon-plus"></i></button>
                                    </div>
                                    @php $count++; @endphp
                                @endforeach
                            </div>

                            <button class="btn btn-success">Създай</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection