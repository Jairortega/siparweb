<?php $retorno = 't_gparqueos'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR GRUPO DE PARQUEADEROS</h4>
                        </div>

                        {!! Form::open(['route' => ['t_gparqueos.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('cod_gr_parque', 'Código: ')!!}
                                {!!Form::number('cod_gr_parque', null, ['class'=>'form-control','placeholder'=>'Código del Grupo'])!!}
                                @if(Session::has('message'))
                                    <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif

                                @if ($errors->has('cod_gr_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cod_gr_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_gr_parque', 'Grupo: ')!!}
                                {!!Form::text('des_gr_parque', null, ['class'=>'form-control','placeholder'=>'Nombre del Grupo'])!!}
                                @if ($errors->has('des_gr_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('des_gr_parque') }}</li>
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

@extends('components.vfootgral')

@endsection