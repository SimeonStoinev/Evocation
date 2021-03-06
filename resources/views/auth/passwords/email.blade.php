@extends('layouts.app')

@section('content')
<div class="containerAuth" >

                <div>
                    <img src="{{asset('img/intro/1.jpg')}}" alt="">
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h1>{{ __('Възстановяване на парола') }}</h1>

                            <div class="inputsAuth">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{('Е-мейл')}}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                        <div class="authBtn">
                                <button type="submit" class="btn btn-outline-primary">
                                    {{ __('Изпращане') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
@endsection
