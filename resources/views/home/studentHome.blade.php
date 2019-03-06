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
                        <li class="nav-item @if(Session::has('cardHeader') && session('cardHeader') != 'Програма') open @endif">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-book-open"></i>
                                <span class="title">Моят клас - {{ $data['title'] }}</span>
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
                                <li class="nav-item @if(session('home') == 'gradeStudentsAbsences') active @endif">
                                    <a href="javascript:;" onclick="displayHomeContent($(this))" class="nav-link " data-content="gradeStudentsAbsences">
                                        <i class="icon-question"></i>
                                        <span class="title">Отсъствия</span>
                                        <span class="badge badge-default"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
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
                                        <div>{{ $row['title'] }}</div>
                                        <div>Час №{{ $count }}</div>
                                    </section>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        </div>

                        <div @if(session('home') == 'mondayLessons') style="display: block;" @endif content="mondayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['mondayLessons'] as $row)
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

                        <div @if(session('home') == 'tuesdayLessons') style="display: block;" @endif content="tuesdayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['tuesdayLessons'] as $row)
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

                        <div @if(session('home') == 'wednesdayLessons') style="display: block;" @endif content="wednesdayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['wednesdayLessons'] as $row)
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

                        <div @if(session('home') == 'thursdayLessons') style="display: block;" @endif content="thursdayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['thursdayLessons'] as $row)
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

                        <div @if(session('home') == 'fridayLessons') style="display: block;" @endif content="fridayLessons">
                            @php $count = 1; @endphp
                            @foreach ($data['fridayLessons'] as $row)
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

                        <div @if(session('home') == 'weeklyCurriculum') style="display: block;" @endif content="weeklyCurriculum">
                            <div class="dayOfWeek">
                                <h3>Понеделник</h3>
                            </div>
                            @php $count = 1; @endphp
                            @foreach ($data['mondayLessons'] as $row)
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
                            @foreach ($data['tuesdayLessons'] as $row)
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
                            @foreach ($data['wednesdayLessons'] as $row)
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
                            @foreach ($data['thursdayLessons'] as $row)
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
                            @foreach ($data['fridayLessons'] as $row)
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

                        <div @if(session('home') == 'gradeStudentsList') style="display: block;" @endif content="gradeStudentsList">
                            <span style="display: block;text-align: right;">Класен ръководител: <b style="color: #111111;">{{ $data['classteacher'] }}</b></span>
                            <ul class="gradeStudents">
                                @php $studentCount = 1; @endphp
                                @foreach ($data['students'] as $student)
                                    <li>{{ $studentCount }}. {{ $student }}</li>
                                    @php $studentCount++; @endphp
                                @endforeach
                            </ul>
                        </div>

                        <div @if(session('home') == 'gradeStudentsAbsences') style="display: block;" @endif content="gradeStudentsAbsences">
                            <ul class="childAbsences">
                                <li class="absencesDetails animated fadeInUp">
                                    @if (($data['currentStudent']['absencesCount'] / .5) % 2 == 1)
                                        <span class="totalAbsences">{{ intval($data['currentStudent']['absencesCount']) }}½ общо</span>
                                    @else
                                        <span class="totalAbsences">{{ intval($data['currentStudent']['absencesCount']) }} общо</span>
                                    @endif
                                    <h5>Неизвинени отсъствия за месеца:</h5>

                                    @if (empty($data['currentStudent']['monthlyAbsences']))
                                        <p>Вие нямате неизвинени отсъствия.</p>
                                    @else
                                        <div class="parentAbsenceWrapper" style="display: flex;flex-wrap: wrap;">
                                            @foreach ($data['currentStudent']['monthlyAbsences'] as $monthlyAbsence)
                                                <p>{{ $monthlyAbsence['lessonDay'] }}({{ $monthlyAbsence['date'] }}) в час по {{ $monthlyAbsence['lessonTitle'] }} в {{ $monthlyAbsence['time'] }} часа</p>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="absenceStatistics">
                                        <div>За деня: {{ count($data['currentStudent']['dailyAbsences']) }} @if (count($data['currentStudent']['dailyAbsences']) == 1)отсъствие@elseотсъствия@endif</div>
                                        <div>За седмицата: {{ count($data['currentStudent']['weeklyAbsences']) }} @if (count($data['currentStudent']['weeklyAbsences']) == 1)отсъствие@elseотсъствия@endif</div>
                                        <div>За месеца: {{ count($data['currentStudent']['monthlyAbsences']) }} @if (count($data['currentStudent']['monthlyAbsences']) == 1)отсъствие@elseотсъствия@endif</div>
                                    </div>
                                </li>

                                <li class="excusedAbsencesDetails animated fadeInUp">
                                    <span class="totalAbsences">{{ intval($data['currentStudent']['excusedAbsencesCount']) }} общо</span>
                                    <h5>Извинени отсъствия:</h5>

                                    @if (empty($data['currentStudent']['excusedAbsences']))
                                        <p>Вие нямате извинени отсъствия.</p>
                                    @else
                                        <div class="parentAbsenceWrapper" style="display: flex;flex-wrap: wrap;">
                                            @foreach ($data['currentStudent']['excusedAbsences'] as $row)
                                                <p><i class="icon-check" style="color: green;font-weight: 600;"></i> {{ $row['lessonDay'] }}({{ $row['date'] }}) в час по {{ $row['lessonTitle'] }} в {{ $row['time'] }} часа</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection