<?php $retorno = 't_dsservicios'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR FECHA SIN SERVICIO </h4>
                        </div>
                        @foreach($dssrvs as $dssrv)

                        {!! Form::open(['route' => ['t_dsservicios.update',$dssrv->created_at], 'method' => 'PUT', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::hidden('created_at', $dssrv->created_at, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Parqueadero'])!!}
                                @if ($errors->has('created_at'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('created_at') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('id_parque', 'Código: ')!!}
                                {!!Form::text('id_parque', $dssrv->id_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Parqueadero'])!!}
                                @if ($errors->has('id_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_parque', 'Parqueadero: ')!!}
                                {!!Form::text('des_parque', $dssrv->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Parqueadero'])!!}
                                @if ($errors->has('des_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('des_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('fecha_parque', 'Fecha: ')!!}
                                {!!Form::date('fecha_parque', $dssrv->fecha_parque, ['class'=>'form-control','placeholder'=>'Fecha sin servicio'])!!}
                                @if ($errors->has('fecha_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('fecha_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('hora_ini', 'Hora Inicial (Hora militar -> 24 horas): ')!!}
                                {!!Form::time('hora_ini', $dssrv->hora_ini, ['class'=>'form-control','placeholder'=>'Hora desde'])!!}
                                @if ($errors->has('hora_ini'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('hora_ini') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('hora_fin', 'Hora Final (Hora militar -> 24 horas): ')!!}
                                {!!Form::time('hora_fin', $dssrv->hora_fin, ['class'=>'form-control','placeholder'=>'Hora hasta'])!!}
                                @if ($errors->has('hora_fin'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('hora_fin') }}</li>
                                        </ul>
                                    </div>
                                @endif
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