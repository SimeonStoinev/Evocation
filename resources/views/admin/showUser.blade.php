@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Меню</span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu" style="display: block;">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/home') }}">
                                        <i class="icon-graduation"></i>
                                        <span class="title">Училища</span>
                                        <span class="badge badge-success"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/grades') }}">
                                        <i class="icon-book-open"></i>
                                        <span class="title">Класове</span>
                                        <span class="badge badge-default"></span>
                                    </a>
                                </li>
                                <li class="nav-item active">
                                    <a href="{{ url('/admin/users') }}">
                                        <i class="icon-user"></i>
                                        <span class="title">Потребители</span>
                                        <span class="badge badge-danger"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/curricula') }}">
                                        <i class="icon-calendar"></i>
                                        <span class="title">Програми</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/subjects') }}">
                                        <i class="icon-list"></i>
                                        <span class="title">Предмети</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <label>Име:</label> {{ $data['name'] }}
                        <br>
                        <label>Фамилия:</label> {{ $data['family'] }}
                        <br>
                        <label>Емайл:</label> {{ $data['email'] }}
                        <br>
                        <label>Ниво на достъп:</label> {{ $data['rank'] }}
                        <br>
                        @if ($data['rank'] === 'teacher')
                            <label>Класен ръководител:</label> @if ($data['is_classteacher']) ДА @else НЕ @endif
                            <br>
                        @endif
                        <label>Клас:</label> {{ $data['grade'] }}
                        <br>
                        <label>Училище:</label> {{ $data['schoolTitle'] }}
                        <br>
                        <label>Потвърден:</label> {{ $data['isVerified'] }}
                        <br>
                        <label>Създаден на:</label> {{ $data['created_at'] }}

                        <div class="buttonActions" style="text-align: center;margin-top: 20px;">
                            <button class="btn btn-primary">Редактирай</button>
                            <button class="btn btn-danger">Изтрий</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection