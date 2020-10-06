<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ csrf_field() }}
    <!-- CSRF Token -->
<!--    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>SIPARWEB</title>

    <!-- Scripts  -->
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
<!--                <a class="navbar-brand text-white" href="{{ url('/') }}">Retornar
                    {{ config('app.name', 'Laravel') }} 
                </a> -->
<!--				<lo id="siparweb" class ="nav-item text-white"><h4>SIPARWEB</h4></lo> -->
                <a id="siparweb" class ="nav-item text-white" href="{{ url($retorno) }}"><h4>SIPARWEB</h4></a>
				
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon bg-white"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                        <? php $retorno = '/'; ?>
                            <a class="nav-link text-white" href="{{ url($retorno) }}"><span class="icon-arrow-left"></span>&nbsp;{{ __('Retornar') }}</span></a>
                        </li>
<!--                        <li class="nav-item">
                            <a class="nav-link  text-white" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li> -->
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
