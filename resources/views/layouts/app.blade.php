<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<!--    <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>SIPARWEB</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {!!Html::style('css/bootstrap-grid.css')!!}
    {!!Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')!!}
    {!!Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')!!}

    
</head>
<body>

    <div id="app">
<!--        <nav class="navbar navbar-expand-md navbar-info navbar-laravel"> -->
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}"><span class="icon-arrow-left"></span>
<!--                    {{ config('app.name', 'Laravel') }} -->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon bg-white"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->

<!--                    <ul class="navbar-nav mr-auto"> -->

                        <!-- Authentication Links -->
                        @guest
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item  text-white">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  text-white" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            </li>
                        </ul>    
                        @else
                        <ul class="nav justify-content-end">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                OPCIONES<span class="caret"></span>
                                </a>
                                <form id="app_form" method="post" action="/home">
                                <input type="hidden" id="id_perfil" name="id_perfil" value="{{ Auth::user()->id_perfil }}">
                                </form>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @foreach($perfiles as $perfil)
                                    <ul>
                                    <li><a href="{{ $perfil->consulta }}"><span style="font-size: 14px;">{{ $perfil->opcion }}</span></a></li>
                                    </ul>
                                @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-primary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                        @endguest
                    
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
