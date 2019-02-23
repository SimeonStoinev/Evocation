@extends('layouts.app')

@section('content')

<div class="containerAuth" id="registerForm">
    <div>
        <img src="{{asset('img/intro/1.jpg')}}" alt="">
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1>{{'Регистрация'}}</h1>

            <div class="inputsAuth">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="{{'Име'}}">

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>




            <div class="inputsAuth">
                <input id="family" type="text" class="form-control{{ $errors->has('family') ? ' is-invalid' : '' }}" name="family" value="{{ old('family') }}" required autofocus placeholder="{{'Фамилия'}}">

                @if ($errors->has('family'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                @endif
            </div>




            <div class="inputsAuth">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{'Е-мейл'}}">

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>




            <div class="inputsAuth">
                <select id="rank" name="rank" class="form-control{{ $errors->has('rank') ? ' is-invalid' : '' }}" onchange="rankRegisterForm({{ json_encode($grades) }})" required>
                    <option>{{'Вие сте'}}</option>
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




            <div class="inputsAuth">
                <select id="school" name="school" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}" onchange="schoolRegisterForm($(this), {{ json_encode($grades) }})" required>
                    <option value="0">{{('Училище')}}</option>
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

        <div id="gradesWrapper" class="form-group row">
            <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Клас') }}</label>

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

        <div class="inputsAuth">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{('Парола')}}">

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>


            <div class="inputsAuth">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{('Повторете паролата')}}">
            </div>


        <div class="authBtn">
                <button type="submit" class="btn btn-outline-primary">
                    {{ __('Регистрация') }}
                </button>
        </div>
    </form>
</div>

@endsection


