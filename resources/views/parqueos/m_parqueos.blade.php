<?php $retorno = 't_parqueos'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR PARQUEADERO </h4>
                        </div>
                        @foreach($parqos as $parqo)

                        {!! Form::open(['route' => ['t_parqueos.update',$parqo->id_parque], 'method' => 'PUT', 'class' => 'card-body', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-group">
                                {!!Form::label('id_parque', 'Código: ')!!}
                                {!!Form::text('id_parque', $parqo->id_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Parqueadero'])!!}
                                @if ($errors->has('id_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('nit_parque', 'NIT Parqueadero: ')!!}
                                {!!Form::text('nit_parque', $parqo->nit_parque, ['class'=>'form-control','placeholder'=>'NIT Parqueadero'])!!}
                                @if ($errors->has('nit_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('nit_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_parque', 'Nombre: ')!!}
                                {!!Form::text('des_parque', $parqo->des_parque, ['class'=>'form-control','placeholder'=>'Nombre del Parqueadero'])!!}
                                @if ($errors->has('des_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('des_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_parque', 'Dirección: ')!!}
                                {!!Form::text('dir_parque', $parqo->dir_parque, ['class'=>'form-control','onchange'=> 'initMap();', 'placeholder'=>'Dirección del Parqueadero'])!!}
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
                                {!!Form::text('tel_parque', $parqo->tel_parque, ['class'=>'form-control','placeholder'=>'Teléfono del Parqueadero'])!!}
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
                                {!!Form::text('mail_parque', $parqo->mail_parque, ['class'=>'form-control','placeholder'=>'Correo Electrónico del Parqueadero'])!!}
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
                                       <option value='{{ $parqo->id_regimen }}'>
                                           {{ $parqo->dregimen }}
                                       </option>
                                @foreach($regimenes as $regime) 
                                   <option value="{{ $regime->id_pv }}">
                                           {{ $regime->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                               {!!Form::label('cod_gr_parque', 'Grupo: ')!!}
                               <select name="cod_gr_parque" id="cod_gr_parque"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $parqo->cod_gr_parque }}'>
                                           {{ $parqo->des_gr_parque }}
                                       </option>
                                @foreach($grparqos as $grparqo)
                                   <option value="{{ $grparqo->cod_gr_parque }}">
                                           {{ $grparqo->des_gr_parque }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!!Form::label('latitud_parque', 'Latitud Parqueadero: ')!!} 
                                {!!Form::text('latitud_parque', $parqo->latitud_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Latitud del Parqueadero'])!!}
                                @if ($errors->has('latitud_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('latitud_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('longitud_parque', 'Longitud Parqueadero: ')!!}
                                {!!Form::text('longitud_parque', $parqo->longitud_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Longitud del Parqueadero'])!!}
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

                            <div class="form-group">
                                <img width="300px" src="/../img/{{$parqo->foto_parque}}"> 
                            </div>

                            <div class="form-group">
                                <p>UBICACIÓN DEL PARQUEADERO (Icono Rojo)</p>
                                <p> </p>
                                <?php include_once(public_path().'\..\resources\views\parqueos\mapav.php') ?>
                            </div>

                            <input type="submit" id="enviar_datos" name="enviar_datos" value="Actualizar" class="btn btn-primary btn-block">

                            @if(Session::has('message'))
                            <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                            @endif
                        {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


@extends('components.vfootgral')

@endsection