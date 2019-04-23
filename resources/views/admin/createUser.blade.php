@extends('layouts.app')

@section('content')
    <div class="container adminContainer">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-8">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <h3>Добави потребител</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('admin/users') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="userFormName">{{ 'Име:' }}</label>
                                <br>
                                <input id="userFormName" class="form-control col-md-12" type="text" name="name" placeholder="Име">
                            </div>

                            <div class="form-group">
                                <label for="userFormFamily">{{ 'Фамилия:' }}</label>
                                <br>
                                <input id="userFormFamily" class="form-control col-md-12" type="text" name="family" placeholder="Фамилия">
                            </div>

                            <div class="form-group">
                                <label for="userFormEmail">{{ 'Емайл:' }}</label>
                                <br>
                                <input id="userFormEmail" class="form-control col-md-12" type="text" name="email" placeholder="Емайл">
                            </div>

                            <div class="form-group">
                                <label for="userFormPassword">{{ 'Парола:' }}</label>
                                <br>
                                <input id="userFormPassword" class="form-control col-md-12" type="password" name="password" placeholder="Парола">
                            </div>

                            <div class="form-group">
                                <label for="userFormRank">{{ 'Ниво на достъп:' }}</label>
                                <br>
                                <select id="userFormRank" name="rank" class="form-control{{ $errors->has('rank') ? ' is-invalid' : '' }}">
                                    <option value="0">{{'Ниво на достъп:'}}</option>
                                    <option value="headmaster">Директор</option>
                                    <option value="subheadmaster">Зам. директор</option>
                                    <option value="teacher">Учител</option>
                                    <option value="student">Ученик</option>
                                    <option value="parent">Родител</option>
                                </select>
                            </div>

                            <div class="form-group classteacher" style="display: none;">
                                <label for="userFormClassteacher">{{ 'Класен ръководител:' }}</label>
                                <br>
                                <select id="userFormClassteacher" name="is_classteacher" class="form-control">
                                    <option value="0">Не</option>
                                    <option value="1">Да</option>
                                </select>
                            </div>

                            <div class="form-group school">
                                <label for="userFormSchool">{{ 'Училище:' }}</label>
                                <br>
                                <select name="school_id" class="form-control col-md-12" id="userFormSchool">
                                    <option value="0">{{('Изберете училище:')}}</option>
                                    @foreach($schools as $row)
                                        <option value="{{ $row['id'] }}">{{ $row['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group grade" style="display: none;">
                                <label for="userFormGrade">{{ 'Клас:' }}</label>
                                <br>
                                <select id="userFormGrade" name="grade" class="form-control{{ $errors->has('grade') ? ' is-invalid' : '' }}" required>
                                    <option value="0">{{'Изберете клас:'}}</option>
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