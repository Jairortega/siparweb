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
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR PARQUEADERO</h4>
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
                                {!!Form::text('dir_parque', null, ['class'=>'form-control','onchange'=> 'destinoMap();', 'placeholder'=>'Dirección del Parqueadero'])!!}
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
                                {!!Form::text('latitud_parque', null, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Latitud del Parqueadero'])!!}
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
                                {!!Form::text('longitud_parque', null, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Longitud del Parqueadero'])!!}
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
                                <p>UBICACIÓN DEL PARQUEADERO (Icono Verde)</p>
                                <p> </p>
                                <?php include_once(public_path().'\..\resources\views\parqueos\mapa.php') ?>
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

@extends('components.vfootgral')

@endsection