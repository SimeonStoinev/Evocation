@extends('layouts.app')

@section('content')
    <div class="container adminContainer">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-8">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <h3>Добави клас</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('admin/grades') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="gradeFormTitle">{{ 'Заглавие:' }}</label>
                                <br>
                                <input id="gradeFormTitle" class="form-control col-md-12" type="text" name="title" placeholder="Заглавие">
                            </div>

                            <div class="form-group">
                                <label for="gradeFormSchoolSelect">{{ 'Училище:' }}</label>
                                <br>
                                <select name="school_id" class="form-control col-md-12" id="gradeFormSchoolSelect">
                                    <option value="0">{{('Изберете училище:')}}</option>
                                    @foreach($schools as $row)
                                        <option value="{{ $row['id'] }}">{{ $row['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group teachers" style="display: none;">
                                <label for="gradeFormClassteacherSelect">{{ 'Класен ръководител:' }}</label>
                                <br>
                                <select name="classteacher_id" class="form-control col-md-12" id="gradeFormClassteacherSelect">
                                    <option value="0">{{ 'Изберете класен ръководител:' }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gradeFormShiftSelect">{{ 'Смяна:' }}</label>
                                <br>
                                <select name="shift" class="form-control col-md-12" id="gradeFormShiftSelect">
                                    <option value="0">{{ 'Изберете смяна:' }}</option>
                                    <option value="1">{{ 'Първа смяна' }}</option>
                                    <option value="2">{{ 'Втора смяна' }}</option>
                                </select>
                            </div>

                            <button class="btn btn-success">Създай</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection