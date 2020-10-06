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
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR OPCIÓN</h4>
                        </div>

                        {!! Form::open(['route' => ['t_opciones.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_opcion', 'Código: ')!!}
                                {!!Form::number('id_opcion', null, ['class'=>'form-control','placeholder'=>'Código de la Opción'])!!}
                                @if(Session::has('message'))
                                    <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif

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
                                {!!Form::text('opcion', null, ['class'=>'form-control','placeholder'=>'Descripción de la Opción'])!!}
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
                                {!!Form::text('name_objeto', null, ['class'=>'form-control','placeholder'=>'Nombre del Objeto'])!!}
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
                                {!!Form::text('consulta', null, ['class'=>'form-control','placeholder'=>'Nombre de la Vista'])!!}
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
                                {!!Form::text('rep_pdf', null, ['class'=>'form-control','placeholder'=>'Nombre del PDF'])!!}
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
                                {!!Form::text('rep_csv', null, ['class'=>'form-control','placeholder'=>'Nombre del CSV'])!!}
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
                                {!!Form::text('rep_txt', null, ['class'=>'form-control','placeholder'=>'Nombre del TXT'])!!}
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

                                @foreach($grupos as $grupo)
                                   <option value="{{ $grupo->grupo }}">
                                           {{ $grupo->gnombre }}
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