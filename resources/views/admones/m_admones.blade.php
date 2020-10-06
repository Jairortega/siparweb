<?php $retorno = 't_admones'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR ADMINISTRADOR </h4>
                        </div>
                        @foreach($admones as $admon)

                        {!! Form::open(['route' => ['t_admones.update',$admon->cc_admon], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('cc_admon', 'Cédula: ')!!}
                                {!!Form::text('cc_admon', $admon->cc_admon, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Administrador'])!!}
                                @if ($errors->has('cc_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cc_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('nom_admon', 'Nombre: ')!!}
                                {!!Form::text('nom_admon', $admon->nom_admon, ['class'=>'form-control','placeholder'=>'Nombre del Administrador'])!!}
                                @if ($errors->has('nom_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('nom_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_admon', 'Dirección: ')!!}
                                {!!Form::text('dir_admon', $admon->dir_admon, ['class'=>'form-control', 'placeholder'=>'Dirección del Administrador'])!!}
                                @if ($errors->has('dir_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('dir_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('tel_admon', 'Teléfono: ')!!}
                                {!!Form::number('tel_admon', $admon->tel_admon, ['class'=>'form-control','placeholder'=>'Teléfono del Administrador'])!!}
                                @if ($errors->has('tel_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('tel_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('cel_admon', 'Celular: ')!!}
                                {!!Form::number('cel_admon', $admon->cel_admon, ['class'=>'form-control','placeholder'=>'Celular del Administrador'])!!}
                                @if ($errors->has('cel_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cel_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('mail_admon', 'Correo Electrónico: ')!!}
                                {!!Form::text('mail_admon', $admon->mail_admon, ['class'=>'form-control', 'placeholder'=>'Correo Electrónico del Administrador'])!!}
                                @if ($errors->has('mail_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('mail_admon') }}</li>
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