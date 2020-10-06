<?php $retorno = 't_perfilesxop'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA OPCIÓN POR PERFIL</h4>
                        </div>
                        @foreach($operfiles as $operfil)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_perfilesxop.show', $operfil->id_perfil, $operfil->id_opcion], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_perfil', 'Código Perfil: ')!!}
                                {!!Form::number('id_perfil', $operfil->id_perfil, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Perfil'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('perfil', 'Perfil: ')!!}
                                {!!Form::text('perfil', $operfil->perfil, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Perfil'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('id_opcion', 'Código Opción: ')!!}
                                {!!Form::number('id_opcion', $operfil->id_opcion, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código de la Opción'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('opcion', 'Opción: ')!!}
                                {!!Form::text('opcion', $operfil->opcion, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre de la Opción'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('insertar', 'Insertar: ')!!}
                                {!!Form::text('insertar', $operfil->insertar, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Permiso de Insertar'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('modificar', 'Modificar: ')!!}
                                {!!Form::text('modificar', $operfil->modificar, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Permiso de Modificar'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('borrar', 'Borrar: ')!!}
                                {!!Form::text('borrar', $operfil->borrar, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Permiso de Borrar'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('pdf', 'Exportar PDF: ')!!}
                                {!!Form::text('pdf', $operfil->pdf, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Exportar a PDF'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('csv', 'Exportar EXCEL: ')!!}
                                {!!Form::text('csv', $operfil->csv, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Exportar a EXCEL'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('txt', 'Exportar TXT: ')!!}
                                {!!Form::text('txt', $operfil->txt, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Exportar a TXT'])!!}
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection