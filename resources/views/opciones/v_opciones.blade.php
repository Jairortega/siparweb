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
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA OPCIÓN</h4>
                        </div>
                        @foreach($opciones as $opcion)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_opciones.show', $opcion->id_opcion], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_opcion', 'Código: ')!!}
                                {!!Form::number('id_opcion', $opcion->id_opcion, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código de la Opción'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('opcion', 'Opción: ')!!}
                                {!!Form::text('opcion', $opcion->opcion, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Descripción de la Opción'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('name_objeto', 'Nombre del Objeto: ')!!}
                                {!!Form::text('name_objeto', $opcion->name_objeto, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Objeto'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('consulta', 'Vista: ')!!}
                                {!!Form::text('consulta', $opcion->consulta, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre de la Vista'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('rep_pdf', 'Archivo PDF: ')!!}
                                {!!Form::number('rep_pdf', $opcion->rep_pdf, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del PDF'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('rep_csv', 'Archivo CSV: ')!!}
                                {!!Form::number('rep_csv', $opcion->rep_csv, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del CSV'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('rep_txt', 'Archivo TXT: ')!!}
                                {!!Form::number('rep_txt', $opcion->rep_txt, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del TXT'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('grupo', 'Grupo: ')!!}
                                {!!Form::text('grupo', $opcion->gnombre, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Descripción del Grupo'])!!}
                            </div>
                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection