@extends('layouts.app')

@section('content')
    <div class="container adminContainer">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-8">
                <div class="card">
                    <div class="adminContent" style="display: block;">
                        <label>Име:</label> {{ $data['name'] }}
                        <br>
                        <label>Фамилия:</label> {{ $data['family'] }}
                        <br>
                        <label>Емайл:</label> {{ $data['email'] }}
                        <br>
                        <label>Ниво на достъп:</label> {{ $data['rank'] }}
                        <br>
                        @if ($data['rank'] === 'teacher')
                            <label>Класен ръководител:</label> @if ($data['is_classteacher']) ДА @else НЕ @endif
                            <br>
                        @endif
                        <label>Клас:</label> {{ $data['grade'] }}
                        <br>
                        <label>Училище:</label> {{ $data['schoolTitle'] }}
                        <br>
                        <label>Потвърден:</label> {{ $data['isVerified'] }}
                        <br>
                        <label>Създаден на:</label> {{ $data['created_at'] }}

                        <div class="buttonActions" style="text-align: center;margin-top: 20px;">
                            <button onclick="location.href = '/admin/user/edit/'+{{ $data['id'] }};" class="btn btn-primary">Редактирай</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection