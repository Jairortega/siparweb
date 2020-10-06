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
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR GRUPO DE PARQUEADEROS </h4>
                        </div>
                        @foreach($grparqos as $grparqo)

                        {!! Form::open(['route' => ['t_gparqueos.update',$grparqo->cod_gr_parque], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('cod_gr_parque', 'Código: ')!!}
                                {!!Form::text('cod_gr_parque', $grparqo->cod_gr_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Grupo'])!!}
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
                                {!!Form::text('des_gr_parque', $grparqo->des_gr_parque, ['class'=>'form-control','placeholder'=>'Nombre del Grupo'])!!}
                                @if ($errors->has('des_gr_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('des_gr_parque') }}</li>
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