@extends('layouts.app')

@section('content')
    <div class="containerAuth">
        <div>
            <img src="{{asset('img/intro/1.jpg')}}" alt="">
        </div>
        <form method="POST" action="{{ route('login') }}" >
            @csrf
            <h1>{{'Вход'}}</h1>

            <div class="inputsAuth">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{'Е-мейл адрес'}}">

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="inputsAuth">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{'Парола'}}">

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-check" id="rememberMe">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="margin-left: -15px;">

                <label class="form-check-label" for="remember" style="padding: 1px;margin-bottom: 5px;">
                    {{ __('Запомни ме') }}
                </label>
            </div>

            <div>
                <div class="authBtn">
                    <button type="submit" class="btn btn-outline-primary">
                        {{ __('Вход') }}
                    </button>
                </div>
            </div>
        </form>
        <div id="forgotPass">
            <a  href="{{ route('password.request') }}">
                {{ __('Забравена парола') }}
            </a>
        </div>
    </div>
@endsection
