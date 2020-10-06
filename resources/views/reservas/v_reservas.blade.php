<?php $retorno = 't_reservas'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA RESERVA</h4>
                        </div>
                        @foreach($reservas as $reserva)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    
                        <div class="visible-print text-center" style="color: #007bff; font-size: 18px; ">
                            {!! QrCode::size(150)->generate($reserva->placa); !!}
                            <p> </p>
                            <p>!! Estimado Cliente: Por favor mostrar este QR a la entrada del Parqueadero !!.</p>
                        </div>

                        {!! Form::open(['route' => ['t_reservas.show', $reserva->id_reserva], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::hidden('id_reserva', $reserva->id_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'ID Reserva'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('name', 'Nombre: ')!!}
                                {!!Form::text('name', $reserva->name, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Cliente'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('email', 'Correo Electrónico: ')!!}
                                {!!Form::text('email', $reserva->email, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Correo Electrónico'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_parque', 'Parqueadero: ')!!}
                                {!!Form::text('des_parque', $reserva->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_parque', 'Dirección Parqueadero: ')!!}
                                {!!Form::text('dir_parque', $reserva->dir_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Dirección del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('tel_parque', 'Teléfono Parqueadero: ')!!}
                                {!!Form::text('tel_parque', $reserva->tel_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Teléfono del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('tipo_vehiculo', 'Tipo Vehículo: ')!!}
                                {!!Form::text('tipo_vehiculo', $reserva->des_tvehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Tipo de Vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('placa', 'Placa: ')!!}
                                {!!Form::text('placa', $reserva->placa, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Placa Vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('fecha_reserva', 'Fecha Reserva: ')!!}
                                {!!Form::date('fecha_reserva', $reserva->fecha_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Fecha de la Reserva'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('hora_reserva', 'Hora Reserva: ')!!}
                                {!!Form::time('hora_reserva', $reserva->hora_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Hora de la Reserva'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_ereserva', 'Estado Reserva: ')!!}
                                {!!Form::text('des_ereserva', $reserva->des_ereserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Estado de la Reserva'])!!}
                            </div>

                            <div class="form-group">
                            
                                {!!Form::label('latitud_origen', 'Latitud Origen: ')!!}
                                {!!Form::text('latitud_origen', $reserva->latitud_origen, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Latitud Origen'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('longitud_origen', 'Longitud Origen: ')!!}
                                {!!Form::text('longitud_origen', $reserva->longitud_origen, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Longitud Origen'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('latitud_destino', 'Latitud Destino: ')!!}
                                {!!Form::text('latitud_destino', $reserva->latitud_destino, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Latitud Destino'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('longitud_destino', 'Longitud Destino: ')!!}
                                {!!Form::text('longitud_destino', $reserva->longitud_destino, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Longitud Destino'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('latitud_parque', 'Latitud Parqueadero: ')!!}
                                {!!Form::text('latitud_parque', $reserva->latitud_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Latitud del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('longitud_parque', 'Longitud Parqueadero: ')!!}
                                {!!Form::text('longitud_parque', $reserva->longitud_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Longitud del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('foto_parque', 'Foto Parqueadero: ')!!}
                                <img width="300px" src="/../img/{{$reserva->foto_parque}}"> 
                            </div>

                            <div class="form-group">
                                <p style= "color: 44b4c4; font-size: 18px; ">RUTA SUGERIDA AL PARQUEADERO</p>
                                <p> </p>
                                <?php include_once(public_path().'\..\resources\views\reservas\mapavrs.php') ?>
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection