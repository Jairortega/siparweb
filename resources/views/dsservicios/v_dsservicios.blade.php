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
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA FECHA SIN SERVICIO</h4>
                        </div>
                        @foreach($dssrvs as $dssrv)
                        @if(session('status'))
                        <div class="alert alert-{{ Session::get('class')}}">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_dsservicios.show', $dssrv->id_parque, $dssrv->fecha_parque, $dssrv->hora_ini], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_parque', 'Código: ')!!}
                                {!!Form::number('id_parque', $dssrv->id_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_parque', 'Parqueadero: ')!!}
                                {!!Form::text('des_parque', $dssrv->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_gr_parque', 'Grupo: ')!!}
                                {!!Form::text('des_gr_parque', $dssrv->des_gr_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Grupo Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('fecha_parque', 'Fecha: ')!!}
                                {!!Form::text('fecha_parque', $dssrv->fecha_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Fecha sin servicio'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('hora_ini', 'Hora Inicial (Hora militar -> 24 horas): ')!!}
                                {!!Form::time('hora_ini', $dssrv->hora_ini, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Hora desde'])!!}
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
                                {!!Form::time('hora_fin', $dssrv->hora_fin, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Hora hasta'])!!}
                                @if ($errors->has('hora_fin'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('hora_fin') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection