@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="page-sidebar-wrapper" style="margin-top: -10px;">
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-list"></i>
                                <span class="title">Програма</span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu" style="display: block;">
                                <li class="nav-item">
                                    <a href="" class="nav-link ">
                                        <i class="icon-plus"></i>
                                        <span class="title">Днешна</span>
                                        <span class="badge badge-success"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link ">
                                        <i class="icon-clock"></i>
                                        <span class="title">Седмична</span>
                                        <span class="badge badge-primary"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link ">
                                        <i class="icon-check"></i>
                                        <span class="title">Понеделник</span>
                                        <span class="badge badge-default"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link ">
                                        <i class="icon-close"></i>
                                        <span class="title">Вторник</span>
                                        <span class="badge badge-danger"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link ">
                                        <i class="icon-calendar"></i>
                                        <span class="title">Сряда</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link ">
                                        <i class="icon-calendar"></i>
                                        <span class="title">Четвъртък</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link ">
                                        <i class="icon-calendar"></i>
                                        <span class="title">Петък</span>
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
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @php $count = 1; @endphp
                        @foreach ($data['todayLessons'] as $row)
                            <p>Час номер {{ $count }} - {{ $row['lessonSchedule'] }}</p>
                            <p>{{ $row['gradeTitle'] }} Клас</p>
                            <p>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</p>
                            <p>Предмет - {{ $row['subjectTitle'] }}</p>
                            @if ($row['lessonSchedule'] === 'Минал' && !empty($row['studentsData']))
                                <ul class="lessonStudents">
                                    @foreach ($row['studentsData'] as $student)
                                        <li style="@if ($student['checked']) color: green; @else color: red; @endif">
                                            {{ $student['studentName'] }} -
                                            @if ($student['checked'])
                                                <button type="button" onclick="writeAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">X</button>
                                            @else
                                                <button type="button" onclick="excuseAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">✓</button>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            @if ($row['lessonSchedule'] === 'Текущ')
                                @if (Session::has('lessonID') && session('lessonID') == $row['lessonID'])
                                    Чекирането беше затворено.

                                    <ul class="lessonStudents">
                                        @foreach ($row['studentsData'] as $student)
                                            <li style="@if ($student['checked']) color: green; @else color: red; @endif">
                                                {{ $student['studentName'] }} -
                                                @if ($student['checked'])
                                                    <button type="button" onclick="writeAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">X</button>
                                                @else
                                                    <button type="button" onclick="excuseAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">✓</button>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    @if (!$row['isLessonOpenedToday'])
                                        @if (Session::has('listenerID'))
                                            <button id="closeListener" onclick="closeCheckinListener({{ session('listenerID') }}, {{ $row['lessonID'] }})">Затвори чекиране</button>

                                            <ul class="lessonStudents">
                                                @foreach ($row['studentsData'] as $student)
                                                    <li style="@if ($student['checked']) color: green; @else color: red; @endif">
                                                        {{ $student['studentName'] }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <button id="openListener" onclick="openCheckinListener({{ $row['gradeID'] }}, {{ $row['gradeStudentIDs'] }}, {{ $row['lessonID'] }})">Отвори чекиране</button>
                                        @endif
                                    @else
                                        Чекирането за този час беше приключено.
                                        <ul class="lessonStudents">
                                            @foreach ($row['studentsData'] as $student)
                                                <li style="@if ($student['checked']) color: green; @else color: red; @endif">
                                                    {{ $student['studentName'] }} -
                                                    @if ($student['checked'])
                                                        <button type="button" onclick="writeAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">X</button>
                                                    @else
                                                        <button type="button" onclick="excuseAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">✓</button>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            @endif

                        @php $count++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection