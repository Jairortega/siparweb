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
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR OPERARIO </h4>
                        </div>
                        @foreach($operarios as $operario)

                        {!! Form::open(['route' => ['t_operarios.update', $operario->cc_operario], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                               {!!Form::label('cc_operario', 'Cédula Operario: ')!!}
                               {!!Form::text('cc_operario', $operario->cc_operario, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Operario'])!!}
                            </div>

                            <div class="form-group">
                               {!!Form::label('nom_operario', 'Nombre Operario: ')!!}
                               {!!Form::text('nom_operario', $operario->nom_operario, ['class'=>'form-control', 'placeholder'=>'Nombre del Operario'])!!}
                            </div>

                            <div class="form-group">
                               {!!Form::label('id_parque', 'Parqueadero: ')!!}
                               <select name="id_parque" id="id_parque"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $operario->id_parque }}'>
                                           {{ $operario->des_parque }}
                                       </option>
                                @foreach($parqos as $parq)
                                   <option value="{{ $parq->id_parque }}">
                                           {{ $parq->des_parque }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_operario', 'Dirección Operario: ')!!}
                                {!!Form::text('dir_operario', $operario->dir_operario, ['class'=>'form-control','placeholder'=>'Dirección del Operario'])!!}
                                @if ($errors->has('dir_operario'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('dir_operario') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('tel_operario', 'Teléfono Operario: ')!!}
                                {!!Form::text('tel_operario', $operario->tel_operario, ['class'=>'form-control','placeholder'=>'Teléfono del Operario'])!!}
                                @if ($errors->has('tel_operario'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('tel_operario') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('cel_operario', 'Celular Operario: ')!!}
                                {!!Form::text('cel_operario', $operario->cel_operario, ['class'=>'form-control','placeholder'=>'Celular del Operario'])!!}
                                @if ($errors->has('cel_operario'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cel_operario') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('mail_operario', 'Correo Electrónico Operario: ')!!}
                                {!!Form::email('mail_operario', $operario->mail_operario, ['class'=>'form-control','placeholder'=>'Correo Electrónico del Operario'])!!}
                                @if ($errors->has('mail_operario'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('mail_operario') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group  text-danger">
                               {!!Form::label('bloqueo', 'Bloqueado (S/N): ')!!}
                               <select name="bloqueo" id="bloqueo"
                                       class="form-control text-danger" style="height: 30px;">
                                       <option value='{{ $operario->bloqueo }}'>
                                           {{ $operario->sino }}
                                       </option>
                                @foreach($ivapvars as $ivapv)
                                   <option value="{{ $ivapv->id_pv }}">
                                           {{ $ivapv->des_pv }}
                                    </option>
                                @endforeach
                                </select>
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