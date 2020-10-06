<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- CSRF Token -->
<!--    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>SIPARWEB</title>

    <!-- Scripts  -->
<!--   <script src="{{ asset('js/app.js') }}" defer></script>
-->

<!--     {!!Html::script('js/app.js')!!} -->

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
                <a id="siparweb" class ="nav-item text-white" href="{{ url($retorno) }}"><h4>SIPARWEB</h4></a>
                    
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
