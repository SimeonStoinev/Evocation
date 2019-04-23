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
                                <label for="gradeFormTitle">Заглавие:</label>
                                <br>
                                <input id="gradeFormTitle" class="form-control col-md-12" type="text" name="title" placeholder="Заглавие">
                            </div>

                            <div class="form-group">
                                <label for="schoolSelect">Училище:</label>
                                <br>
                                <select name="school_id" class="form-control col-md-12" id="schoolSelect">
                                    <option value="0">{{('Изберете училище:')}}</option>
                                    @foreach($schools as $row)
                                        <option value="{{ $row['id'] }}">{{ $row['title'] }}</option>
                                    @endforeach
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