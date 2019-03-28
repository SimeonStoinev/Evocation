<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Evocation</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}" defer></script>
    <script src="{{ asset('js/app.min.js') }}" defer></script>
    <script src="{{ asset('js/layout.min.js') }}" defer></script>
    <script src="{{ asset('js/uglipop.min.js') }}" defer></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/default.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/landing/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon2.png') }}"/>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
    <div id="app">
        <nav id="header" class="navbar navbar-expand-md navbar-light navbar-laravel" style="position: relative;">
            <div class="container" style="width: 100%;">
                <div id="logo" style="padding-left: 0;">
                    @if (\Illuminate\Support\Facades\Auth::check())
                        @if (\Illuminate\Support\Facades\Auth::user()['rank'] === 'admin')
                            <a href="{{ url('admin/home') }}"><img src="{{ asset('img/white_logo.png') }}" alt="logo"></a>
                        @else
                            <a href="{{ url('/home') }}"><img src="{{ asset('img/white_logo.png') }}" alt="logo"></a>
                        @endif
                    @else
                        <a href="{{ url('/') }}"><img src="{{ asset('img/white_logo.png') }}" alt="logo"></a>
                    @endif
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="display: flex !important;">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    @if (isset($data['teacherInfo']))
                        <span id="schoolTitle">
                            <i class="icon-graduation"></i>
                            {{ $data['teacherInfo']['school'] }}
                        </span>
                    @endif

                    @if (isset($data['school']))
                        <span id="schoolTitle">
                            <i class="icon-graduation"></i>
                            {{ $data['school'] }}
                        </span>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <ul class="nav-menu">
                                <li><a href="{{ route('login') }}">{{ __('Вход') }}</a></li>
                                <li class="menu-active"><a href="{{ route('register') }}">{{ __('Регистрация') }}</a></li>
                            </ul>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} {{ Auth::user()->family }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Излез') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
