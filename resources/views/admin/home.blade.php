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
                                <span class="tableTitle">Училища:</span>
                                <span class="upperRight">
                                    <button onclick="modalCreate()" type="button" class="btn btn-success">Добави <i class="icon-plus"></i></button>
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
                            @foreach ($schools as $school)
                                <tr>
                                    <td class="modalTarget">{{ $school['title'] }}</td>
                                    <td>{{ $school['headmasterName'] }}</td>
                                    <td>{{ $school['grades_number'] }}</td>
                                    <td>{{ $school['students_number'] }}</td>
                                    <td>{{ $school['teachers_number'] }}</td>
                                    <td>
                                        <button onclick="modalEdit($(this), {{ $school['id'] }})"><i class="icon-pencil"></i></button>
                                        <button onclick="modalDelete({{ $school['id'] }})"><i class="icon-close" style="color: red;"></i></button>
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