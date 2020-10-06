<?php $retorno = 't_perfiles'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR PERFIL</h4>
                        </div>

                        {!! Form::open(['route' => ['t_perfiles.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_perfil', 'Código: ')!!}
                                {!!Form::number('id_perfil', null, ['class'=>'form-control','placeholder'=>'Código del Perfil'])!!}
                                @if(Session::has('message'))
                                    <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif

                                @if ($errors->has('id_perfil'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_perfil') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('perfil', 'Perfil: ')!!}
                                {!!Form::text('perfil', null, ['class'=>'form-control','placeholder'=>'Nombre del Perfil'])!!}
                                @if ($errors->has('perfil'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('perfil') }}</li>
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