<?php $retorno = 't_opciones'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR OPCION </h4>
                        </div>
                        @foreach($opciones as $opcion)

                        {!! Form::open(['route' => ['t_opciones.update',$opcion->id_opcion], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('id_opcion', 'Código: ')!!}
                                {!!Form::text('id_opcion', $opcion->id_opcion, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código de la Opción'])!!}
                                @if ($errors->has('id_opcion'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_opcion') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('opcion', 'Opción: ')!!}
                                {!!Form::text('opcion', $opcion->opcion, ['class'=>'form-control','placeholder'=>'Descripción de la Opción'])!!}
                                @if ($errors->has('opcion'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('opcion') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('name_objeto', 'Nombre del Objeto: ')!!}
                                {!!Form::text('name_objeto', $opcion->name_objeto, ['class'=>'form-control','placeholder'=>'Nombre del Objeto'])!!}
                                @if ($errors->has('name_objeto'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('name_objeto') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('consulta', 'Vista: ')!!}
                                {!!Form::text('consulta', $opcion->consulta, ['class'=>'form-control','placeholder'=>'Nombre de la Vista'])!!}
                                @if ($errors->has('consulta'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('consulta') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('rep_pdf', 'Archivo PDF: ')!!}
                                {!!Form::text('rep_pdf', $opcion->rep_pdf, ['class'=>'form-control','placeholder'=>'Nombre del PDF'])!!}
                                @if ($errors->has('rep_pdf'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('rep_pdf') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('rep_csv', 'Archivo CSV: ')!!}
                                {!!Form::text('rep_csv', $opcion->rep_csv, ['class'=>'form-control','placeholder'=>'Nombre del CSV'])!!}
                                @if ($errors->has('rep_csv'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('rep_csv') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('rep_txt', 'Archivo TXT: ')!!}
                                {!!Form::text('rep_txt', $opcion->rep_txt, ['class'=>'form-control','placeholder'=>'Nombre del TXT'])!!}
                                @if ($errors->has('rep_txt'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('rep_txt') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                               {!!Form::label('grupo', 'Grupo: ')!!}
                               <select name="grupo" id="grupo"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $opcion->grupo }}'>
                                           {{ $opcion->gnombre }}
                                       </option>
                                @foreach($grupos as $grupo)
                                   <option value="{{ $grupo->grupo }}">
                                           {{ $grupo->gnombre }}
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