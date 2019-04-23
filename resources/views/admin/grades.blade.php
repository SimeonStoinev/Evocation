@extends('layouts.app')

@section('content')
    @include('admin.modals')

    <div class="container adminContainer">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-10">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <table id="adminDataTable" class="display" style="width:100%">
                            <caption>
                                <span class="tableTitle">Класове:</span>
                                <span class="upperRight">
                                    <button onclick="location.href = '/admin/grades/create';" type="button" class="btn btn-success">Добави <i class="icon-plus"></i></button>
                                </span>
                            </caption>
                            <thead>
                            <tr>
                                @foreach ($columns as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td>{{ $grade['title'] }}</td>
                                    <td>{{ $grade['classteacherName'] }}</td>
                                    <td>{{ $grade['studentsCount'] }}</td>
                                    <td>{{ $grade['shift'] }}</td>
                                    <td>{{ $grade['schoolTitle'] }}</td>
                                    <td>
                                        <button onclick="location.href = '/admin/grade/'+{{ $grade['id'] }};"><i class="icon-pencil"></i></button>
                                        <button onclick="modalDelete({{ $grade['id'] }})"><i class="icon-close" style="color: red;"></i></button>
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
