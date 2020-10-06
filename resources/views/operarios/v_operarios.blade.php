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
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA OPERARIO</h4>
                        </div>
                        @foreach($operarios as $operario)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_operarios.show', $operario->cc_operario], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('cc_operario', 'Cédula: ')!!}
                                {!!Form::text('cc_operario', $operario->cc_operario, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Operario'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('nom_operario', 'Nombre: ')!!}
                                {!!Form::text('nom_operario', $operario->nom_operario, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Operario'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_parque', 'Parqueadero Asignado: ')!!}
                                {!!Form::text('des_parque', $operario->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_gr_parque', 'Grupo Parqueadero: ')!!}
                                {!!Form::text('des_gr_parque', $operario->des_gr_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Grupo del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_operario', 'Dirección Operario: ')!!}
                                {!!Form::text('dir_operario', $operario->dir_operario, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Dirección del Operario'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('tel_operario', 'Teléfono Operario: ')!!}
                                {!!Form::text('tel_operario', $operario->tel_operario, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Teléfono del Operario'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('cel_operario', 'Celular Operario: ')!!}
                                {!!Form::text('cel_operario', $operario->cel_operario, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Celular del Operario'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('mail_operario', 'Correor Operario: ')!!}
                                {!!Form::text('mail_operario', $operario->mail_operario, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Correo del Operario'])!!}
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection