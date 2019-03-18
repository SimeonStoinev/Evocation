@extends('layouts.app')

@section('content')
    <div id="editRecord" style="display:none;">
        <h3 style="text-align: center;">Редактирайте</h3>

        <hr>

        <label for="inputTitle">Заглавие:</label>
        <input class="input-lg" id="inputTitle" type="text" name="title">

        <br>

        <button type="button" onclick="editRecord($(this), 'schools')">Редактирай</button>
    </div>

    <div id="createRecord" style="display:none;">
        <h3 style="text-align: center;">Добави</h3>

        <hr>

        <label for="inputTitle">Заглавие:</label>
        <input class="input-lg" id="inputTitle" type="text" name="title">

        <br>

        <button type="button" onclick="createRecord($(this), 'schools')">Създай</button>
    </div>

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
                                <li class="nav-item active">
                                    <a href="{{ url('/admin/home') }}" onclick="displayHomeContent($(this))" class="nav-link " data-content="schools">
                                        <i class="icon-graduation"></i>
                                        <span class="title">Училища</span>
                                        <span class="badge badge-success"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/grades') }}" onclick="displayHomeContent($(this))" class="nav-link " data-content="grades">
                                        <i class="icon-book-open"></i>
                                        <span class="title">Класове</span>
                                        <span class="badge badge-default"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/users') }}" onclick="displayHomeContent($(this))" class="nav-link " data-content="users">
                                        <i class="icon-user"></i>
                                        <span class="title">Потребители</span>
                                        <span class="badge badge-danger"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/curricula') }}" onclick="displayHomeContent($(this))" class="nav-link " data-content="curricula">
                                        <i class="icon-calendar"></i>
                                        <span class="title">Програми</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/subjects') }}" onclick="displayHomeContent($(this))" class="nav-link " data-content="subjects">
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
                    <div class="adminContent" content="schools" style="display: block;">
                        <span class="upperRight">
                            <button onclick="modalCreate()" type="button" class="btn btn-success">Добави <i class="icon-plus"></i></button>
                        </span>
                        <h3>Училища:</h3>

                        <ul class="adminList">
                            @php $count = 1; @endphp
                            @foreach($data as $row)
                                <li>
                                    {{ $count }}. <span>{{ $row['title'] }}</span>
                                    <button onclick="modalEdit($(this), {{ $row['id'] }})"><i class="icon-pencil"></i></button>
                                    <button onclick="deleteRecord({{ $row['id'] }}, 'schools')"><i class="icon-close" style="color: red;"></i></button>
                                </li>
                                @php $count++; @endphp
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
