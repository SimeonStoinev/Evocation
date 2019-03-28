@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (!empty($data))
                @foreach($data as $row)
                    <div class="col-md-10" style="margin-bottom: 30px;">
                        <div class="card">
                            <div class="card-header" style="color: #2b95e0;">{{ $row['childData']['name'] . ' ' . $row['childData']['family'] }}</div>

                            <div class="card-body parentHomeBody">
                                <span class="upperLeft">{{ $row['childData']['gradeTitle'] }}</span>
                                <span class="upperRight">{{ $row['childData']['schoolTitle'] }}</span>

                                <div class="parentMainInfo" style="display: block;">
                                    @if (!$row['lastEntry']['entered'])
                                        <h4 class="isInSchool">
                                            Детето Ви не е било отчетено в училище от системата.
                                        </h4>
                                    @else
                                        <h3 class="isInSchool">
                                            @if ($row['lastEntry']['isInSchool']) Детето Ви се намира в училище.
                                            @else Детето Ви не е в училище.
                                            @endif
                                        </h3>

                                        <h4 class="entryTimestamp">
                                            @if ($row['lastEntry']['isInSchool']) Последен вход в {{ $row['lastEntry']['time'] }} часа на {{ $row['lastEntry']['date'] }}
                                            @else Последен изход в {{ $row['lastEntry']['time'] }} часа на {{ $row['lastEntry']['date'] }}
                                            @endif
                                        </h4>
                                    @endif
                                </div>

                                <ul class="childAbsences">
                                    <li class="absencesDetails animated fadeInUp">
                                        @if (($row['absences']['absencesCount'] / .5) % 2 == 1)
                                            <span class="totalAbsences">{{ intval($row['absences']['absencesCount']) }}½ общо</span>
                                        @else
                                            <span class="totalAbsences">{{ intval($row['absences']['absencesCount']) }} общо</span>
                                        @endif
                                        <h5>Неизвинени отсъствия за месеца:</h5>

                                        @if (empty($row['absences']['monthlyAbsences']))
                                            <p>Ученикът няма неизвинени отсъствия.</p>
                                        @else
                                            <div class="parentAbsenceWrapper" style="display: flex;flex-wrap: wrap;">
                                                @foreach ($row['absences']['monthlyAbsences'] as $monthlyAbsence)
                                                    <p>{{ $monthlyAbsence['lessonDay'] }}({{ $monthlyAbsence['date'] }}) в час по {{ $monthlyAbsence['lessonTitle'] }} в {{ $monthlyAbsence['time'] }} часа</p>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="absenceStatistics">
                                            <div>За деня: {{ count($row['absences']['dailyAbsences']) }} @if (count($row['absences']['dailyAbsences']) == 1)отсъствие@elseотсъствия@endif</div>
                                            <div>За седмицата: {{ count($row['absences']['weeklyAbsences']) }} @if (count($row['absences']['weeklyAbsences']) == 1)отсъствие@elseотсъствия@endif</div>
                                            <div>За месеца: {{ count($row['absences']['monthlyAbsences']) }} @if (count($row['absences']['monthlyAbsences']) == 1)отсъствие@elseотсъствия@endif</div>
                                        </div>
                                    </li>

                                    <li class="excusedAbsencesDetails animated fadeInUp">
                                        <span class="totalAbsences">{{ intval($row['absences']['excusedAbsencesCount']) }} общо</span>
                                        <h5>Извинени отсъствия:</h5>

                                        @if (empty($row['absences']['excusedAbsences']))
                                            <p>Ученикът няма извинени отсъствия.</p>
                                        @else
                                            <div class="parentAbsenceWrapper" style="display: flex;flex-wrap: wrap;">
                                                @foreach ($row['absences']['excusedAbsences'] as $excusedAbsence)
                                                    <p><i class="icon-check" style="color: green;font-weight: 600;"></i> {{ $excusedAbsence['lessonDay'] }}({{ $excusedAbsence['date'] }}) в час по {{ $excusedAbsence['lessonTitle'] }} в {{ $excusedAbsence['time'] }} часа</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </li>
                                </ul>

                                <div class="animated fadeInUp" style="display: block;">
                                    <div class="dayOfWeek">
                                        <h3>Понеделник</h3>
                                    </div>
                                    @php $count = 1; @endphp
                                    @foreach ($row['lessons']['mondayLessons'] as $lesson)
                                        <div class="lesson">
                                            <section class="lessonInfo">
                                                <div>{{ $lesson['timeRangeFrom'] }} - {{ $lesson['timeRangeTo'] }}</div>
                                                <div>{{ $lesson['title'] }}</div>
                                                <div>Час №{{ $count }}</div>
                                            </section>
                                        </div>
                                        @php $count++; @endphp
                                    @endforeach

                                    <div class="dayOfWeek">
                                        <h3>Вторник</h3>
                                    </div>
                                    @php $count = 1; @endphp
                                    @foreach ($row['lessons']['tuesdayLessons'] as $lesson)
                                        <div class="lesson">
                                            <section class="lessonInfo">
                                                <div>{{ $lesson['timeRangeFrom'] }} - {{ $lesson['timeRangeTo'] }}</div>
                                                <div>{{ $lesson['title'] }}</div>
                                                <div>Час №{{ $count }}</div>
                                            </section>
                                        </div>
                                        @php $count++; @endphp
                                    @endforeach

                                    <div class="dayOfWeek">
                                        <h3>Сряда</h3>
                                    </div>
                                    @php $count = 1; @endphp
                                    @foreach ($row['lessons']['wednesdayLessons'] as $lesson)
                                        <div class="lesson">
                                            <section class="lessonInfo">
                                                <div>{{ $lesson['timeRangeFrom'] }} - {{ $lesson['timeRangeTo'] }}</div>
                                                <div>{{ $lesson['title'] }}</div>
                                                <div>Час №{{ $count }}</div>
                                            </section>
                                        </div>
                                        @php $count++; @endphp
                                    @endforeach

                                    <div class="dayOfWeek">
                                        <h3>Четвъртък</h3>
                                    </div>
                                    @php $count = 1; @endphp
                                    @foreach ($row['lessons']['thursdayLessons'] as $lesson)
                                        <div class="lesson">
                                            <section class="lessonInfo">
                                                <div>{{ $lesson['timeRangeFrom'] }} - {{ $lesson['timeRangeTo'] }}</div>
                                                <div>{{ $lesson['title'] }}</div>
                                                <div>Час №{{ $count }}</div>
                                            </section>
                                        </div>
                                        @php $count++; @endphp
                                    @endforeach

                                    <div class="dayOfWeek">
                                        <h3>Петък</h3>
                                    </div>
                                    @php $count = 1; @endphp
                                    @foreach ($row['lessons']['fridayLessons'] as $lesson)
                                        <div class="lesson">
                                            <section class="lessonInfo">
                                                <div>{{ $lesson['timeRangeFrom'] }} - {{ $lesson['timeRangeTo'] }}</div>
                                                <div>{{ $lesson['title'] }}</div>
                                                <div>Час №{{ $count }}</div>
                                            </section>
                                        </div>
                                        @php $count++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else

            @endif
        </div>
    </div>
@endsection
