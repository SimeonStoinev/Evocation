@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        {{--Lessons and schedules--}}
                        <li class="nav-item open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-list"></i>
                                <span class="title">Програма</span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu" style="display: block;">
                                <li class="nav-item active">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="todayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Днешна</span>
                                        <span class="badge badge-success"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="mondayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Понеделник</span>
                                        <span class="badge badge-default"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="tuesdayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Вторник</span>
                                        <span class="badge badge-danger"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="wednesdayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Сряда</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="thursdayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Четвъртък</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="fridayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Петък</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="weeklyCurriculum">
                                        <i class="icon-calendar"></i>
                                        <span class="title">Седмична</span>
                                        <span class="badge badge-primary"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{--My grade--}}
                        @if (isset($data['teacherInfo']) && $data['teacherInfo']['is_classteacher'])
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-book-open"></i>
                                    <span class="title">Моят клас - {{ $data['teacherInfo']['gradeTitle'] }}</span>
                                    <span class="arrow open"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="gradeStudentsList">
                                            <i class="icon-list"></i>
                                            <span class="title">Списък</span>
                                            <span class="badge badge-success"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="gradeStudentsAbsences">
                                            <i class="icon-question"></i>
                                            <span class="title">Отсъствия</span>
                                            <span class="badge badge-default"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Програма</div>

                    <div class="card-body">
                        <div content="todayLessons">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @php $count = 1; @endphp
                            @foreach ($data['todayLessons'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас</div>
                                        <div>Час №{{ $count }} - {{ $row['lessonSchedule'] }}</div>
                                    </section>
                                    <section class="studentsWrapper">
                                        @if ($row['lessonSchedule'] === 'Минал' && !empty($row['studentsData']))
                                            <ul class="lessonStudents">
                                                @php $studentCount = 1; @endphp
                                                @foreach ($row['studentsData'] as $student)
                                                    <li style="@if ($student['checked']) color: green; @else color: red; @endif">
                                                        {{ $studentCount }}. {{ $student['studentName'] }} -
                                                        @if ($student['checked'])
                                                            <button style="@if ($student['checked']) color: red; @else color: green; @endif" type="button" onclick="writeAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">X</button>
                                                        @else
                                                            <button style="@if ($student['checked']) color: red; @else color: green; @endif" type="button" onclick="excuseAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">✓</button>
                                                        @endif
                                                    </li>
                                                    @php $studentCount++; @endphp
                                                @endforeach
                                            </ul>
                                        @endif
                                        @if ($row['lessonSchedule'] === 'Текущ')
                                            @if (Session::has('lessonID') && session('lessonID') == $row['lessonID'])
                                                <span>Чекирането беше затворено.</span>

                                                <ul class="lessonStudents">
                                                    @php $studentCount = 1; @endphp
                                                    @foreach ($row['studentsData'] as $student)
                                                        <li style="@if ($student['checked']) color: green; @else color: red; @endif">
                                                            {{ $studentCount }}. {{ $student['studentName'] }}
                                                            @if ($student['checked'])
                                                                <button type="button" style="@if ($student['checked']) color: red; @else color: green; @endif" onclick="writeAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">X</button>
                                                            @else
                                                                <button type="button" style="@if ($student['checked']) color: red; @else color: green; @endif" onclick="excuseAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">✓</button>
                                                            @endif
                                                        </li>
                                                        @php $studentCount++; @endphp
                                                    @endforeach
                                                </ul>
                                            @else
                                                @if (!$row['isLessonOpenedToday'])
                                                    @if (Session::has('listenerID'))
                                                        <button id="closeListener" class="btn btn-outline-primary small-btn" onclick="closeCheckinListener({{ session('listenerID') }}, {{ $row['lessonID'] }})">Затвори чекиране</button>

                                                        <ul class="lessonStudents">
                                                            @php $studentCount = 1; @endphp
                                                            @foreach ($row['studentsData'] as $student)
                                                                <li style="@if ($student['checked']) color: green; @else color: red; @endif">
                                                                    {{ $studentCount }}. {{ $student['studentName'] }}
                                                                </li>
                                                                @php $studentCount++; @endphp
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <button id="openListener" class="btn btn-outline-primary small-btn" onclick="openCheckinListener({{ $row['gradeID'] }}, {{ $row['gradeStudentIDs'] }}, {{ $row['lessonID'] }})">Отвори чекиране</button>
                                                    @endif
                                                @else
                                                    <span>Чекирането за този час беше приключено.</span>
                                                    <ul class="lessonStudents">
                                                        @php $studentCount = 1; @endphp
                                                        @foreach ($row['studentsData'] as $student)
                                                            <li style="@if ($student['checked']) color: green; @else color: red; @endif">
                                                                {{ $studentCount }}. {{ $student['studentName'] }}
                                                                @if ($student['checked'])
                                                                    <button style="@if ($student['checked']) color: red; @else color: green; @endif" type="button" onclick="writeAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">X</button>
                                                                @else
                                                                    <button style="@if ($student['checked']) color: red; @else color: green; @endif" type="button" onclick="excuseAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})">✓</button>
                                                                @endif
                                                            </li>
                                                            @php $studentCount++; @endphp
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endif
                                        @endif
                                    </section>
                                </div>
                            @php $count++; @endphp
                            @endforeach
                        </div>

                        <div content="mondayLessons">

                        </div>

                        <div content="tuesdayLessons">

                        </div>

                        <div content="wednesdayLessons">

                        </div>

                        <div content="thursdayLessons">

                        </div>

                        <div content="fridayLessons">

                        </div>

                        <div content="weeklyCurriculum">

                        </div>

                        @if (isset($data['teacherInfo']) && $data['teacherInfo']['is_classteacher'])
                            <div content="gradeStudentsList">
                                <ul class="gradeStudents">
                                    @php $studentCount = 1; @endphp
                                    @foreach ($data['teacherInfo']['gradeData']['students'] as $student)
                                        <li>{{ $studentCount }}. {{ $student['name'] }}</li>
                                        @php $studentCount++; @endphp
                                    @endforeach
                                </ul>
                            </div>

                            <div content="gradeStudentsAbsences">
                                <ul class="gradeStudents">
                                    @php $studentCount = 1; @endphp
                                    @foreach ($data['teacherInfo']['gradeData']['students'] as $student)
                                        <li>{{ $studentCount }}. {{ $student['name'] }}:</li>
                                        @foreach ($student['dailyAbsences'] as $dailyAbsence)
                                            <li>{{ $dailyAbsence['created_at'] }}</li>
                                        @endforeach
                                        @php $studentCount++; @endphp
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection