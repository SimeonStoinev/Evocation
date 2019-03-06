@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        {{--Lessons and schedules--}}
                        <li class="nav-item @if(!Session::has('cardHeader')) open @endif @if(session('cardHeader') == 'Програма') open @endif">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-calendar"></i>
                                <span class="title">Програма</span>
                                <span class="arrow @if(!Session::has('cardHeader')) open @endif @if(session('cardHeader') == 'Програма') open @endif"></span>
                            </a>
                            <ul class="sub-menu" @if(!Session::has('cardHeader')) style="display: block;" @endif @if(session('cardHeader') == 'Програма') style="display: block;" @endif>
                                <li class="nav-item @if(!Session::has('cardHeader')) active @endif @if(session('home') == 'todayLessons') active @endif">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="todayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Днешна</span>
                                        <span class="badge badge-success"></span>
                                    </a>
                                </li>
                                <li class="nav-item @if(session('home') == 'mondayLessons') active @endif">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="mondayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Понеделник</span>
                                        <span class="badge badge-default"></span>
                                    </a>
                                </li>
                                <li class="nav-item @if(session('home') == 'tuesdayLessons') active @endif">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="tuesdayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Вторник</span>
                                        <span class="badge badge-danger"></span>
                                    </a>
                                </li>
                                <li class="nav-item @if(session('home') == 'wednesdayLessons') active @endif">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="wednesdayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Сряда</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                                <li class="nav-item @if(session('home') == 'thursdayLessons') active @endif">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="thursdayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Четвъртък</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                                <li class="nav-item @if(session('home') == 'fridayLessons') active @endif">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="fridayLessons">
                                        <i class="icon-info"></i>
                                        <span class="title">Петък</span>
                                        <span class="badge badge-info"></span>
                                    </a>
                                </li>
                                <li class="nav-item @if(session('home') == 'weeklyCurriculum') active @endif">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="weeklyCurriculum">
                                        <i class="icon-list"></i>
                                        <span class="title">Седмична</span>
                                        <span class="badge badge-primary"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{--My grade--}}
                        @if (isset($data['teacherInfo']) && $data['teacherInfo']['is_classteacher'])
                            <li class="nav-item @if(Session::has('cardHeader') && session('cardHeader') != 'Програма') open @endif">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-book-open"></i>
                                    <span class="title">Моят клас - {{ $data['teacherInfo']['gradeTitle'] }}</span>
                                    <span class="arrow @if(Session::has('cardHeader') && session('cardHeader') != 'Програма') open @endif"></span>
                                </a>
                                <ul class="sub-menu" @if(Session::has('cardHeader') && session('cardHeader') != 'Програма') style="display: block;" @endif>
                                    <li class="nav-item @if(session('home') == 'gradeStudentsList') active @endif">
                                        <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="gradeStudentsList">
                                            <i class="icon-list"></i>
                                            <span class="title">Списък</span>
                                            <span class="badge badge-success"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item @if(session('home') == 'gradeCurriculum') active @endif">
                                        <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="gradeCurriculum">
                                            <i class="icon-calendar"></i>
                                            <span class="title">Програма</span>
                                            <span class="badge badge-success"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item @if(session('home') == 'gradeStudentsAbsences') active @endif">
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
                    <div class="card-header">
                        @if (Session::has('cardHeader'))
                            {{ session('cardHeader') }}
                        @else
                            Програма
                        @endif
                    </div>

                    <div class="card-body">
                        <div @if(!Session::has('home')) style="display: block;" @endif @if(session('home') == 'todayLessons') style="display: block;" @endif content="todayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['todayLessons'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['subjectTitle'] }}</div>
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
                                                            <button style="@if ($student['checked']) color: red; @else color: green; @endif" type="button" onclick="writeAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})"><i class="icon-close"></i></button>
                                                        @else
                                                            <button style="@if ($student['checked']) color: red; @else color: green; @endif" type="button" onclick="excuseAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})"><i class="icon-check"></i></button>
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
                                                                <button type="button" style="@if ($student['checked']) color: red; @else color: green; @endif" onclick="writeAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})"><i class="icon-close"></i></button>
                                                            @else
                                                                <button type="button" style="@if ($student['checked']) color: red; @else color: green; @endif" onclick="excuseAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})"><i class="icon-check"></i></button>
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
                                                                    <button style="@if ($student['checked']) color: red; @else color: green; @endif" type="button" onclick="writeAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})"><i class="icon-close"></i></button>
                                                                @else
                                                                    <button style="@if ($student['checked']) color: red; @else color: green; @endif" type="button" onclick="excuseAbsence({{ $row['lessonID'] }}, {{ $student['studentID'] }})"><i class="icon-check"></i></button>
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

                        <div @if(session('home') == 'mondayLessons') style="display: block;" @endif content="mondayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['weeklyLessons']['monday'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        </div>

                        <div @if(session('home') == 'tuesdayLessons') style="display: block;" @endif content="tuesdayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['weeklyLessons']['tuesday'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        </div>

                        <div @if(session('home') == 'wednesdayLessons') style="display: block;" @endif content="wednesdayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['weeklyLessons']['wednesday'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        </div>

                        <div @if(session('home') == 'thursdayLessons') style="display: block;" @endif content="thursdayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['weeklyLessons']['thursday'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        </div>

                        <div @if(session('home') == 'fridayLessons') style="display: block;" @endif content="fridayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['weeklyLessons']['friday'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        </div>

                        <div @if(session('home') == 'weeklyCurriculum') style="display: block;" @endif content="weeklyCurriculum">
                            <div class="dayOfWeek">
                                <h3>Понеделник</h3>
                            </div>
                            @php $count = 1; @endphp
                            @foreach ($data['weeklyLessons']['monday'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach

                            <div class="dayOfWeek">
                                <h3>Вторник</h3>
                            </div>
                            @php $count = 1; @endphp
                            @foreach ($data['weeklyLessons']['tuesday'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach

                            <div class="dayOfWeek">
                                <h3>Сряда</h3>
                            </div>
                            @php $count = 1; @endphp
                            @foreach ($data['weeklyLessons']['wednesday'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach

                            <div class="dayOfWeek">
                                <h3>Четвъртък</h3>
                            </div>
                            @php $count = 1; @endphp
                            @foreach ($data['weeklyLessons']['thursday'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach

                            <div class="dayOfWeek">
                                <h3>Петък</h3>
                            </div>
                            @php $count = 1; @endphp
                            @foreach ($data['weeklyLessons']['friday'] as $row)
                                <div class="lesson">
                                    <section class="lessonInfo">
                                        <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                        <div>{{ $row['gradeTitle'] }} Клас <br> {{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        </div>

                        @if (isset($data['teacherInfo']) && $data['teacherInfo']['is_classteacher'])
                            <div @if(session('home') == 'gradeStudentsList') style="display: block;" @endif content="gradeStudentsList">
                                <ul class="gradeStudents">
                                    @php $studentCount = 1; @endphp
                                    @foreach ($data['teacherInfo']['gradeData']['students'] as $student)
                                        <li>{{ $studentCount }}. {{ $student['name'] }}</li>
                                        @php $studentCount++; @endphp
                                    @endforeach
                                </ul>
                            </div>

                            <div @if(session('home') == 'gradeCurriculum') style="display: block;" @endif content="gradeCurriculum">
                                <div class="dayOfWeek">
                                    <h3>Понеделник</h3>
                                </div>
                                @php $count = 1; @endphp
                                @foreach ($data['teacherInfo']['gradeData']['mondayLessons'] as $row)
                                    <div class="lesson">
                                        <section class="lessonInfo">
                                            <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                            <div>{{ $row['title'] }}</div>
                                            <div>Час №{{ $count }}</div>
                                        </section>
                                    </div>
                                    @php $count++; @endphp
                                @endforeach

                                <div class="dayOfWeek">
                                    <h3>Вторник</h3>
                                </div>
                                @php $count = 1; @endphp
                                @foreach ($data['teacherInfo']['gradeData']['tuesdayLessons'] as $row)
                                    <div class="lesson">
                                        <section class="lessonInfo">
                                            <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                            <div>{{ $row['title'] }}</div>
                                            <div>Час №{{ $count }}</div>
                                        </section>
                                    </div>
                                    @php $count++; @endphp
                                @endforeach

                                <div class="dayOfWeek">
                                    <h3>Сряда</h3>
                                </div>
                                @php $count = 1; @endphp
                                @foreach ($data['teacherInfo']['gradeData']['wednesdayLessons'] as $row)
                                    <div class="lesson">
                                        <section class="lessonInfo">
                                            <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                            <div>{{ $row['title'] }}</div>
                                            <div>Час №{{ $count }}</div>
                                        </section>
                                    </div>
                                    @php $count++; @endphp
                                @endforeach

                                <div class="dayOfWeek">
                                    <h3>Четвъртък</h3>
                                </div>
                                @php $count = 1; @endphp
                                @foreach ($data['teacherInfo']['gradeData']['thursdayLessons'] as $row)
                                    <div class="lesson">
                                        <section class="lessonInfo">
                                            <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                            <div>{{ $row['title'] }}</div>
                                            <div>Час №{{ $count }}</div>
                                        </section>
                                    </div>
                                    @php $count++; @endphp
                                @endforeach

                                <div class="dayOfWeek">
                                    <h3>Петък</h3>
                                </div>
                                @php $count = 1; @endphp
                                @foreach ($data['teacherInfo']['gradeData']['fridayLessons'] as $row)
                                    <div class="lesson">
                                        <section class="lessonInfo">
                                            <div>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</div>
                                            <div>{{ $row['title'] }}</div>
                                            <div>Час №{{ $count }}</div>
                                        </section>
                                    </div>
                                    @php $count++; @endphp
                                @endforeach
                            </div>

                            <div @if(session('home') == 'gradeStudentsAbsences') style="display: block;" @endif content="gradeStudentsAbsences">
                                <ul class="gradeAbsences">
                                    @php $studentCount = 1; @endphp
                                    @foreach ($data['teacherInfo']['gradeData']['students'] as $student)
                                        <li class="studentAbsenceInfo">
                                            <div style="text-align: left;">{{ $studentCount }}. {{ $student['name'] }}</div>
                                            <div style="text-align: center;">
                                                <a class="displayAbsences" href="javascript:;" style="border-bottom: 1px solid #000;">Неизвинени</a>
                                            </div>
                                            <div style="text-align: right;">
                                                <a class="displayExcusedAbsences" href="javascript:;" style="border-bottom: 1px solid #000;">Извинени</a>
                                            </div>
                                        </li>

                                        <li class="absencesDetails">
                                            @if (($student['absencesCount'] / .5) % 2 == 1)
                                                <span class="totalAbsences">{{ intval($student['absencesCount']) }}½ общо</span>
                                            @else
                                                <span class="totalAbsences">{{ intval($student['absencesCount']) }} общо</span>
                                            @endif
                                            <h5>Неизвинени отсъствия за месеца:</h5>

                                            @if (empty($student['monthlyAbsences']))
                                                <p>Ученикът няма неизвинени отсъствия.</p>
                                            @else
                                                @foreach ($student['monthlyAbsences'] as $row)
                                                    <p>{{ $row['lessonDay'] }}({{ $row['date'] }}) в час по {{ $row['lessonTitle'] }} в {{ $row['time'] }} часа
                                                        <button type="button" style="color: green;" onclick="excuseAbsenceByClassteacher({{ $row['id'] }})"><i class="icon-check"></i></button>
                                                    </p>
                                                @endforeach
                                            @endif

                                            <div class="absenceStatistics">
                                                <div>За деня: {{ count($student['dailyAbsences']) }} @if (count($student['dailyAbsences']) == 1)отсъствие@elseотсъствия@endif</div>
                                                <div>За седмицата: {{ count($student['weeklyAbsences']) }} @if (count($student['weeklyAbsences']) == 1)отсъствие@elseотсъствия@endif</div>
                                                <div>За месеца: {{ count($student['monthlyAbsences']) }} @if (count($student['monthlyAbsences']) == 1)отсъствие@elseотсъствия@endif</div>
                                            </div>
                                        </li>

                                        <li class="excusedAbsencesDetails">
                                            <span class="totalAbsences">{{ intval($student['excusedAbsencesCount']) }} общо</span>
                                            <h5>Извинени отсъствия:</h5>

                                            @if (empty($student['excusedAbsences']))
                                                <p>Ученикът няма извинени отсъствия.</p>
                                            @else
                                                @foreach ($student['excusedAbsences'] as $row)
                                                    <p><i class="icon-check" style="color: green;font-weight: 600;"></i> {{ $row['lessonDay'] }}({{ $row['date'] }}) в час по {{ $row['lessonTitle'] }} в {{ $row['time'] }} часа</p>
                                                @endforeach
                                            @endif
                                        </li>
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