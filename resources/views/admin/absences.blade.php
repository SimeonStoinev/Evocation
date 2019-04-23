@extends('layouts.app')

@section('content')

    <div id="absencesOptions" style="display:none;">
        <h3 style="text-align: center;">Опции за отсъствието</h3>

        <hr>

        <select name="absenceSelect" class="form-control col-md-10" id="absenceSelectActions" onchange="absenceSelectActions($(this))">
            <option value="excused~1~late~0">Извини отсъствието</option>
            <option value="excused~0~late~0">Остави неизвинено отсъствие</option>
            <option value="excused~0~late~1">Промени на закъснение</option>
        </select>

        <br>

        <button class="btn-success" type="button" onclick="editAbsence(this)" data-absence-action="excused~1~late~0">Обнови</button>
        <button class="btn-danger" type="button" onclick="closeModal()">Откажи</button>
    </div>

    @include('admin.modals')

    <div class="container adminContainer">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-10">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <table id="adminDataTable" class="display" style="width:100%">
                            <caption>
                                <span class="tableTitle">Отсъствия:</span>
                            </caption>
                            <thead>
                            <tr>
                                @foreach ($columns as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($absences as $absence)
                                    <tr>
                                        <td>{{ $absence['userName'] }}</td>
                                        <td>{{ $absence['lessonTitle'] }}</td>
                                        <td>{{ $absence['gradeTitle'] }}</td>
                                        <td>{{ $absence['schoolTitle'] }}</td>
                                        <td>{{ $absence['date'] }}</td>
                                        <td>{{ $absence['time'] }}</td>
                                        <td>{{ $absence['excused'] }}</td>
                                        <td>{{ $absence['late'] }}</td>
                                        <td>
                                            <button onclick="modalAbsences({{ $absence['id'] }})"><i class="icon-settings"></i></button>
                                            <button onclick="modalDelete({{ $absence['id'] }})"><i class="icon-close" style="color: red;"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                @foreach ($columns as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection