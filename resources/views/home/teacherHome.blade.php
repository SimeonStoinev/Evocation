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

                        @foreach ($data as $row)
                            <p>Час номер {{ $row['lessonNumber'] }}</p>
                            <p>{{ $row['gradeTitle'] }} Клас</p>
                            <p>{{ $row['timeRangeFrom'] }} - {{ $row['timeRangeTo'] }}</p>
                            <p>Предмет - {{ $row['subjectTitle'] }}</p>
                            @if ($row['lessonSchedule'] === 'Текущ')
                                @if (Session::has('lessonID') && session('lessonID') == $row['lessonID'])
                                    Чекирането беше затворено.
                                @else
                                    @if (!$row['isLessonOpenedToday'])
                                        @if (Session::has('listenerID'))
                                            <button id="closeListener" onclick="closeCheckinListener({{ session('listenerID') }}, {{ $row['lessonID'] }})">Затвори чекиране</button>
                                        @else
                                            <button id="openListener" onclick="openCheckinListener({{ $row['gradeID'] }}, {{ $row['gradeStudentIDs'] }}, {{ $row['lessonID'] }})">Отвори чекиране</button>
                                        @endif
                                    @else
                                        Чекирането за този час беше приключено.
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
