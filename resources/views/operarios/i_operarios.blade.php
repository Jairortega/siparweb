<?php $retorno = 't_operarios'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR OPERARIO</h4>
                        </div>

                        {!! Form::open(['route' => ['t_operarios.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('cc_operario', 'Cédula Operario: ')!!}
                                {!!Form::number('cc_operario', null, ['class'=>'form-control','placeholder'=>'Cédula del Operario'])!!}
                                @if ($errors->has('cc_operario'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cc_operario') }}</li>
                                        </ul>
                                    </div>
                                @endif
                                @if(Session::has('message'))
                                    <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('nom_operario', 'Nombre Operario: ')!!}
                                {!!Form::text('nom_operario', null, ['class'=>'form-control','placeholder'=>'Nombre del Operario'])!!}
                                @if ($errors->has('nom_operario'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('nom_operario') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_operario', 'Dirección Operario: ')!!}
                                {!!Form::text('dir_operario', null, ['class'=>'form-control','placeholder'=>'Dirección del Operario'])!!}
                                @if ($errors->has('dir_operario'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('dir_operario') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('tel_operario', 'Teléfono: ')!!}
                                {!!Form::number('tel_operario', null, ['class'=>'form-control','placeholder'=>'Teléfono del Operario'])!!}
                                @if ($errors->has('tel_operario'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('tel_operario') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('cel_operario', 'Celular: ')!!}
                                {!!Form::number('cel_operario', null, ['class'=>'form-control','placeholder'=>'Celular del Operario'])!!}
                                @if ($errors->has('cel_operario'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cel_operario') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('mail_operario', 'Correo Electrónico: ')!!}
                                {!!Form::email('mail_operario', null, ['class'=>'form-control','placeholder'=>'Correo electrónio del Operario'])!!}
                                @if ($errors->has('mail_operario'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('mail_operario') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('id_parque', 'Parqueadero: ')!!}
                                <select name="id_parque" id="id_parque"
                                        class="form-control" style="height: 30px;">

                                    @foreach($parqos as $parq) 
                                    <option value="{{ $parq->id_parque }}">
                                            {{ $parq->des_parque }}
                                        </option>
                                    @endforeach
                                </select>
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