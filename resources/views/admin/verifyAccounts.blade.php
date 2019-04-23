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
                                <span class="tableTitle">Непотвърдени потребители:</span>
                            </caption>
                            <thead>
                            <tr>
                                @foreach ($columns as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($unverifiedUsers as $user)
                                <tr>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['family'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['rankName'] }}</td>
                                    <td>{{ $user['schoolTitle'] }}</td>
                                    <td>
                                        <button onclick="verifyUser({{ $user['id'] }})"><i class="icon-check" style="color: green;"></i></button>
                                        <button onclick="modalDelete({{ $user['id'] }})"><i class="icon-close" style="color: red;"></i></button>
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
