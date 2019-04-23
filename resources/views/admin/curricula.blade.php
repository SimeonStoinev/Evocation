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
                                <span class="tableTitle">Програми:</span>
                                <span class="upperRight">
                                    <button onclick="location.href = '/admin/curricula/create';" type="button" class="btn btn-success">Добави <i class="icon-plus"></i></button>
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
                            @foreach ($curricula as $curriculum)
                                <tr>
                                    <td>{{ $curriculum['gradeTitle'] }}</td>
                                    <td>{{ $curriculum['gradeShift'] }}</td>
                                    <td>{{ $curriculum['schoolTitle'] }}</td>
                                    <td>
                                        <button onclick="location.href = '/admin/curriculum/'+{{ $curriculum['id'] }};"><i class="icon-pencil"></i></button>
                                        <button onclick="modalDelete({{ $curriculum['id'] }})"><i class="icon-close" style="color: red;"></i></button>
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
