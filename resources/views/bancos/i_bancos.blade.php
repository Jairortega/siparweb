<?php $retorno = 't_bancos'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR BANCO</h4>
                        </div>

                        {!! Form::open(['route' => ['t_bancos.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('cod_bco', 'Código: ')!!}
                                {!!Form::number('cod_bco', null, ['class'=>'form-control','placeholder'=>'Código del Banco'])!!}
                                @if(Session::has('message'))
                                    <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif

                                @if ($errors->has('cod_bco'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cod_bco') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('banco', 'Banco: ')!!}
                                {!!Form::text('banco', null, ['class'=>'form-control','placeholder'=>'Nombre del Banco'])!!}
                                @if ($errors->has('banco'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('banco') }}</li>
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