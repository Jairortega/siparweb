<?php $retorno = 't_comercial'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR ARCHIVO COMERCIAL </h4>
                        </div>

                        @foreach($comerciales as $comer)

                        {!! Form::open(['route' => ['t_comercial.update',$comer->id_comer], 'method' => 'PUT', 'class' => 'card-body', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-group">
                                {!!Form::label('id_comer', 'Código: ')!!}
                                {!!Form::text('id_comer', $comer->id_comer, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Archivo'])!!}
                                @if ($errors->has('id_comer'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_comer') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('tipo_comer', 'Tipo de Archivo: ')!!}
                                {!!Form::text('tipo_comer', $comer->tipo_comer, ['class'=>'form-control','placeholder'=>'Tipo de Archivo (PNG, JPG, MP4, PDF)'])!!}
                                @if ($errors->has('tipo_comer'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('tipo_comer') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('archi_comer', 'Archivo Comercial: ')!!}
                                {!!Form::file('archi_comer', null, ['class'=>'form-control','placeholder'=>'Nombre del Archivo Comercial'])!!}
                                @if ($errors->has('archi_comer'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('archi_comer') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <img width="100%" src="/../img/{{$comer->archi_comer}}"> 
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