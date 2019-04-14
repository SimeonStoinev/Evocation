@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @include('admin.menu')

            <div class="col-md-8">
                <div class="card">
                    <div class="adminContent" style="display: block;">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection