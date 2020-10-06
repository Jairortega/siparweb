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
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR BANCO </h4>
                        </div>
                        @foreach($bancos as $banco)

                        {!! Form::open(['route' => ['t_bancos.update',$banco->cod_bco], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('cod_bco', 'Código: ')!!}
                                {!!Form::text('cod_bco', $banco->cod_bco, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Banco'])!!}
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
                                {!!Form::text('banco', $banco->banco, ['class'=>'form-control','placeholder'=>'Nombre del Banco'])!!}
                                @if ($errors->has('banco'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('banco') }}</li>
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