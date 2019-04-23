@extends('layouts.app')

@section('content')
    <div class="container adminContainer">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-8">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <label>Клас:</label> {{ $data['grade'] }}
                        <br>
                        <label>Училище:</label> {{ $data['schoolTitle'] }}

                        <div id="lessons">
                            @php $count = 0; @endphp
                            @foreach ($data['lessons'] as $lessonDays)
                                <div class="form-group dayLessonsWrapper">
                                    <h3 style="text-align: center;position: relative;">{{ $data['daysOfWeekBg'][$count] }}
                                        <a onclick="$(this).parent().next().slideToggle(600);$(this).fadeOut(0);$(this).next().fadeIn(0);" style="cursor: pointer;color: #000;">
                                            <i class="icon-arrow-down" style="position: absolute;right: 0;"></i>
                                        </a>
                                        <a onclick="$(this).parent().next().slideToggle(600);$(this).fadeOut(0);$(this).prev().fadeIn(0);" style="cursor: pointer;color: #000;display: none;">
                                            <i class="icon-arrow-up" style="position: absolute;right: 0;"></i>
                                        </a>
                                    </h3>

                                    <div class="curriculumLessonsWrapper" style="display: none;">
                                        @php $i = 1; @endphp
                                        @foreach ($lessonDays as $lesson)
                                            <div class="singleFormLesson" style="text-align: center;">
                                                <p style="text-align: center;">Час номер {{ $i }}</p>

                                                <label>{{ 'Предмет: ' . $lesson['title'] }}</label>
                                                <br>
                                                <label>{{ 'Преподавател: ' . $lesson['teacherName'] }}</label>
                                                <br>

                                                <label>{{ 'Часови диапазон:' }}</label>

                                                <label>{{ 'От: ' }}</label> {{ $lesson['time_range_from'] }}

                                                <label>{{ 'До: ' }}</label> {{ $lesson['time_range_to'] }}
                                            </div>

                                            @php $i++; @endphp
                                        @endforeach
                                    </div>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        </div>

                        <div class="buttonActions" style="text-align: center;margin-top: 20px;">
                            <button onclick="location.href = '/admin/curriculum/edit/'+{{ $data['id'] }};" class="btn btn-primary">Редактирай</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection