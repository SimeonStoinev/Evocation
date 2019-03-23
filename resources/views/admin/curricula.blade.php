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
                                <li class="nav-item active">
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
                        <span class="upperLeft">
                            <label for="perPageSel">На страница по:</label>
                            <select id="perPageSel" onchange="applyPerPage(this, 'curricula')">
                                <option value="5" @if($perPage == 5) selected @endif>5</option>
                                <option value="10" @if($perPage == 10) selected @endif>10</option>
                                <option value="25" @if($perPage == 25) selected @endif>25</option>
                                <option value="50" @if($perPage == 50) selected @endif>50</option>
                                <option value="100" @if($perPage == 100) selected @endif>100</option>
                            </select>
                        </span>

                        <span class="upperRight">
                            <button onclick="location.href = '/admin/curricula/create';" type="button" class="btn btn-success">Добави <i class="icon-plus"></i></button>
                        </span>
                        <h3>Програми:</h3>

                        <ul class="adminList">
                            @php $count = 1; @endphp
                            @foreach($data as $row)
                                <li>
                                    {{ $count }}. <span>Програма на <b>{{ $row['gradeTitle'] }} клас</b>, {{ $row['schoolTitle'] }}</span>
                                    <button onclick="location.href = '/admin/curriculum/'+{{ $row['id'] }};"><i class="icon-pencil"></i></button>
                                    <button onclick="deleteRecord({{ $row['id'] }})"><i class="icon-close" style="color: red;"></i></button>
                                </li>
                                @php $count++; @endphp
                            @endforeach
                        </ul>

                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
