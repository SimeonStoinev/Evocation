@extends('layouts.app')

@section('content')

{{--@php var_dump($grades); die(); @endphp--}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Регистрация') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Име:') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="family" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия:') }}</label>

                            <div class="col-md-6">
                                <input id="family" type="text" class="form-control{{ $errors->has('family') ? ' is-invalid' : '' }}" name="family" value="{{ old('family') }}" required autofocus>

                                @if ($errors->has('family'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Е-мейл адрес:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rank" class="col-md-4 col-form-label text-md-right">{{ __('Вие сте:') }}</label>

                            <div class="col-md-6">
                                <select id="rank" name="rank" class="form-control{{ $errors->has('rank') ? ' is-invalid' : '' }}" onchange="rankRegisterForm({{ json_encode($grades) }})" required>
                                    <option>Моля изберете</option>
                                    <option value="subheadmaster">Зам. директор</option>
                                    <option value="teacher">Учител</option>
                                    <option value="student">Ученик</option>
                                    <option value="parent">Родител</option>
                                </select>

                                @if ($errors->has('rank'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rank') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="school" class="col-md-4 col-form-label text-md-right">{{ __('Училище:') }}</label>

                            <div class="col-md-6">
                                <select id="school" name="school" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}" onchange="schoolRegisterForm($(this), {{ json_encode($grades) }})" required>
                                    <option value="0">Моля изберете</option>
                                    @foreach($schools as $row)
                                        <option value="{{ $row['id'] }}">{{ $row['title'] }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('school'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('school') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="gradesWrapper" class="form-group row">
                            <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Клас:') }}</label>

                            <div class="col-md-6">
                                <select id="grade" name="grade" class="form-control{{ $errors->has('grade') ? ' is-invalid' : '' }}" required>
                                    <option value="0">Моля изберете</option>
                                </select>

                                @if ($errors->has('grade'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('grade') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Парола:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Повторете паролата:') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Регистрация') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection