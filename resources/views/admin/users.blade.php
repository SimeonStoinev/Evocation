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
                                <span class="tableTitle">Потребители:</span>
                                <span class="upperLeft tableActionButtons">
                                    <label for="rankSelect"></label>
                                    <select id="rankSelect" onchange="applyRank($(this), 'users')">
                                        <option value="student" @if($rank === 'student') selected @endif>Ученици</option>
                                        <option value="teacher" @if($rank === 'teacher') selected @endif>Учители</option>
                                        <option value="parent" @if($rank === 'parent') selected @endif>Родители</option>
                                        <option value="subheadmaster" @if($rank === 'subheadmaster') selected @endif>Зам. директори</option>
                                        <option value="headmaster" @if($rank === 'headmaster') selected @endif>Директори</option>
                                    </select>
                                </span>
                                <span class="upperRight">
                                    <button onclick="location.href = '/admin/users/create';" type="button" class="btn btn-success">Добави <i class="icon-plus"></i></button>
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
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['family'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['schoolTitle'] }}</td>
                                    <td>
                                        <button onclick="location.href = '/admin/user/'+{{ $user['id'] }};"><i class="icon-pencil"></i></button>
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
