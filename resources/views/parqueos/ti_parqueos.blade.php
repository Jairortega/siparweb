<?php $retorno = 't_parqueos'; ?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@csrf
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIPARWEB</title>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    {!!Html::style('css/bootstrap-grid.css')!!}
    {!!Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')!!}
    {!!Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')!!}

    <script>
        var infowindow = null;

        function initialize() {
            //************************************************************************** */
            // Localizacion del usuario
            //************************************************************************** */
            var divMapa = document.getElementById('map_canvas');
            navigator.geolocation.getCurrentPosition(fn_ok, fn_mal);

            function fn_mal() {
             alert("Por favor activar el Localizador de su dispositivo ...!!");
                return 
            };
            var map;
            function fn_ok(rta) {
                // Localizacion del usuario
                var lat = rta.coords.latitude;
                var lon = rta.coords.longitude;

                var myLatLng = {lat: lat, lng: lon};

                var map = new google.maps.Map(
                    document.getElementById('map_canvas'), {
                        center: myLatLng,
                        zoom: 17
                    });
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: "Esta aqui"
                });

            }
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXIqdGhFh9mxTOXGHvMJI6V2NmA9Vcwn8&callback=initialize" async defer target="_blank"></script>


    <style>
        #map_canvas {
            height: 95%;
            width: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

    
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container">
                <a id="siparweb" class ="nav-item text-white" href="{{ url($retorno) }}"><h4>SIPARWEB</h4></a>
                <a class="navbar-toggler" type="button" href="{{ url($retorno) }}" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon bg-white"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right"  aria-labelledby="navbarDropdown">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul>
                    </ul>
                </div>
            </div>
        </nav>

        <p> </p>
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR PARQUEADERO</h4>
                        </div>
                        <div id="map_canvas" class="form-group">
             
                        </div>

                        {!! Form::open(['route' => ['t_parqueos.store'], 'method' => 'POST', 'class' => 'card-body', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {!!Form::label('des_parque', 'Nombre: ')!!}
                                {!!Form::text('des_parque', null, ['class'=>'form-control','placeholder'=>'Nombre del Parqueadero'])!!}
                                @if ($errors->has('des_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('des_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('nit_parque', 'NIT Parqueadero: ')!!}
                                {!!Form::text('nit_parque', null, ['class'=>'form-control','placeholder'=>'NIT Parqueadero'])!!}
                                @if ($errors->has('nit_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('nit_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_parque', 'Dirección: ')!!}
                                {!!Form::text('dir_parque', null, ['class'=>'form-control','placeholder'=>'Dirección del Parqueadero'])!!}
                                @if ($errors->has('dir_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('dir_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('tel_parque', 'Teléfono: ')!!}
                                {!!Form::number('tel_parque', null, ['class'=>'form-control','placeholder'=>'Teléfono del Parqueadero'])!!}
                                @if ($errors->has('tel_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('tel_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('mail_parque', 'Correo Electrónico: ')!!}
                                {!!Form::text('mail_parque', null, ['class'=>'form-control','placeholder'=>'Correo electrónio del Parqueadero'])!!}
                                @if ($errors->has('mail_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('mail_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                               {!!Form::label('id_regimen', 'Regimen: ')!!}
                               <select name="id_regimen" id="id_regimen"
                                       class="form-control" style="height: 30px;">

                                @foreach($regimenes as $regime) 
                                   <option value="{{ $regime->id_pv }}">
                                           {{ $regime->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                               {!!Form::label('cod_gr_parque', 'Grupo Parqueadero: ')!!}
                               <select name="cod_gr_parque" id="cod_gr_parque"
                                       class="form-control" style="height: 30px;">

                                @foreach($grparqos as $grparqo) 
                                   <option value="{{ $grparqo->cod_gr_parque }}">
                                           {{ $grparqo->des_gr_parque }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!!Form::label('latitud_parque', 'Latitud: ')!!}
                                {!!Form::text('latitud_parque', null, ['class'=>'form-control','placeholder'=>'Latitud del Parqueadero'])!!}
                                @if ($errors->has('latitud_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('latitud_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('longitud_parque', 'Longitud: ')!!}
                                {!!Form::text('longitud_parque', null, ['class'=>'form-control','placeholder'=>'Longitud del Parqueadero'])!!}
                                @if ($errors->has('longitud_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('longitud_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('foto_parque', 'Archivo Parqueadero: ')!!}
                                {!!Form::file('foto_parque', null, ['class'=>'form-control','placeholder'=>'Foto del Parqueadero'])!!}
                                @if ($errors->has('foto_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('foto_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
  
                            <input type="submit" id="enviar_datos" name="enviar_datos" value="Registrar" class="btn btn-primary btn-block">
                            {!! Form::close() !!}
                            @if(Session::has('message'))
                               <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>


</div>
@extends('components.vfootgral')

</body>
</html>
