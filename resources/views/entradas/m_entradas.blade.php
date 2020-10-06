<?php $retorno = 't_entradas'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR ENTRADA </h4>
                        </div>
                        @foreach($entradas as $entrada)

                        {!! Form::open(['route' => ['t_entradas.update', $entrada->id_entrada], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('id_entrada', 'Nro Entrada: ')!!}
                                {!!Form::text('id_entrada', $entrada->id_entrada, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'ID Entrada'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('id_parque', $entrada->id_parque, ['class'=>'form-control', 'placeholder'=>'Número de Reserva'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('des_parque', 'Parqueadero: ')!!}
                                {!!Form::text('des_parque', $entrada->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Parqueadero'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('tipo_vehiculo', 'Tipo Vehículo: ')!!}
                                <select name="tipo_vehiculo" id="tipo_vehiculo"
                                        class="form-control" style="height: 30px;">
                                        <option value='{{ $entrada->tipo_vehiculo }}'>
                                           {{ $entrada->des_tvehiculo }}
                                       </option>
                                    @foreach($tipovehiculos as $tveh) 
                                    <option value="{{ $tveh->tipo_vehiculo }}">
                                            {{ $tveh->des_tvehiculo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!!Form::label('email', 'Correo electrónico: ')!!}
                                {!!Form::email('email', $entrada->email, ['class'=>'form-control', 'placeholder'=>'Correo electrónico del Cliente'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('placa', 'Placa Vehículo: ')!!}
                                {!!Form::text('placa', $entrada->placa, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Placa del vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('id_reserva', 'No Reserva: ')!!}
                                {!!Form::number('id_reserva', $entrada->id_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'ID Reserva'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('fecha_reserva', 'Fecha Reserva: ')!!}
                                {!!Form::text('fecha_reserva', $entrada->fecha_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Fecha de Reserva'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('hora_reserva', 'Hora Reserva: ')!!}
                                {!!Form::time('hora_reserva', $entrada->hora_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Hora de Reserva'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('fecha_ingreso', 'Fecha Ingreso: ')!!}
                                {!!Form::text('fecha_ingreso', $entrada->fecha_ingreso, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Fecha de Ingreso'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('hora_ingreso', 'Hora Ingreso: ')!!}
                                {!!Form::time('hora_ingreso', $entrada->hora_ingreso, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Hora de Ingreso'])!!}
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