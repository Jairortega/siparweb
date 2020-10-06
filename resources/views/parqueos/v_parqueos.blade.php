<?php $retorno = 't_parqueos'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA PARQUEADERO</h4>
                        </div>
                        @foreach($parqos as $parqo)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_parqueos.show', $parqo->id_parque], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_parque', 'Código: ')!!}
                                {!!Form::number('id_parque', $parqo->id_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_parque', 'Nombre: ')!!}
                                {!!Form::text('des_parque', $parqo->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('nit_parque', 'NIT Parqueadero: ')!!}
                                {!!Form::text('nit_parque', $parqo->nit_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'NIT Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_parque', 'Dirección: ')!!}
                                {!!Form::text('dir_parque', $parqo->dir_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Dirección del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('tel_parque', 'Teléfono: ')!!}
                                {!!Form::text('tel_parque', $parqo->tel_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Teléfono del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('mail_parque', 'Correo Electrónico: ')!!}
                                {!!Form::text('mail_parque', $parqo->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Correo Electrónico del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('id_regimen', 'Regimen: ')!!}
                                {!!Form::text('id_regimen', $parqo->dregimen, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Regimen Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('cod_gr_parque', 'Grupo Parqueadero: ')!!}
                                {!!Form::text('cod_gr_parque', $parqo->des_gr_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Grupo del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
<!--                                {!!Form::label('latitud_parque', 'Latitud Parqueadero: ')!!} -->
                                {!!Form::hidden('latitud_parque', $parqo->latitud_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Latitud del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
<!--                                {!!Form::label('longitud_parque', 'Longitud Parqueadero: ')!!} -->
                                {!!Form::hidden('longitud_parque', $parqo->longitud_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Longitud del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('foto_parque', 'Foto Parqueadero: ')!!}
                                {!!Form::text('foto_parque', $parqo->foto_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Foto del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                <img width="300px" src="/../img/{{$parqo->foto_parque}}"> 
                            </div>

                            <div class="form-group">
                            <p>UBICACIÓN DEL PARQUEADERO (Icono Rojo)</p>
                            <p> </p>
                                <?php include_once(public_path().'\..\resources\views\parqueos\mapav.php') ?>
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection