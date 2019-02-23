@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
