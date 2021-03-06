@extends('layouts.app')

@section('content')
    <div class="container adminContainer">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-8">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <div class="form-group">
                            <label>Заглавие:</label> {{ $data['title'] }} клас
                            <br>
                            <label>Училище:</label> {{ $data['schoolTitle'] }}
                            <br>
                            <label>Класен ръководител:</label> {{ $data['classteacher']['name'] . ' ' . $data['classteacher']['family'] }}
                            <br>
                            <label>Смяна:</label> {{ $data['shift'] }}
                            <br>
                            @if ($data['student_ids'] == null && !isset($data['students']))
                                <label>Ученици:</label> Няма ученици в този клас.
                            @else
                                <ul class="gradeStudents">
                                    @php $studentCount = 1; @endphp
                                    @foreach ($data['students'] as $student)
                                        <li>{{ $studentCount }}. {{ $student }}</li>
                                        @php $studentCount++; @endphp
                                    @endforeach
                                </ul>
                            @endif

                            <div class="buttonActions" style="text-align: center;margin-top: 20px;">
                                <button onclick="location.href = '/admin/grade/edit/'+'{{ $data['id'] }}';" class="btn btn-primary">Редактирай</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection