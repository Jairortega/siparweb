<?php $retorno = 't_salidas'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">PAGO SERVICIO </h4>
                        </div>
                        @foreach($salidas as $sal)

                        {!! Form::open(['route' => ['t_salidas.update', $sal->id_entrada], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('id_entrada', 'Nro Entrada: ')!!}
                                {!!Form::text('id_entrada', $sal->id_entrada, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'ID Entrada'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('id_parque', $sal->id_parque, ['class'=>'form-control', 'placeholder'=>'Número de Reserva'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('des_parque', 'Parqueadero: ')!!}
                                {!!Form::text('des_parque', $sal->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Parqueadero'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('placa', 'Placa Vehículo: ')!!}
                                {!!Form::text('placa', $sal->placa, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Placa del vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('tipo_vehiculo', $sal->tipo_tvehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Tipo de Vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_tvehiculo', 'Tipo Vehículo: ')!!}
                                {!!Form::text('des_tvehiculo', $sal->des_tvehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Descripción tipo de Vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('forma_pago', $sal->forma_pago, ['class'=>'form-control', 'placeholder'=>'Forma de Pago (0 = Tarjeta / 1 = Efectivo)'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('id_reserva', 'No Reserva: ')!!}
                                {!!Form::number('id_reserva', $sal->id_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'ID Reserva'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('fecha_reserva', 'Fecha Reserva: ')!!}
                                {!!Form::text('fecha_reserva', $sal->fecha_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Fecha de Reserva'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('hora_reserva', 'Hora Reserva: ')!!}
                                {!!Form::time('hora_reserva', $sal->hora_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Hora de Reserva'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('fecha_ingreso', 'Fecha Ingreso: ')!!}
                                {!!Form::text('fecha_ingreso', $sal->fecha_ingreso, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Fecha de Ingreso'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('hora_ingreso', 'Hora Ingreso: ')!!}
                                {!!Form::time('hora_ingreso', $sal->hora_ingreso, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Hora de Ingreso'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('fecha_salida', 'Fecha Salida: ')!!}
                                {!!Form::text('fecha_salida', $sal->fecha_salida, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Fecha de Salida'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('hora_salida', 'Hora Salida: ')!!}
                                {!!Form::time('hora_salida', $sal->hora_salida, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Hora de Salida'])!!}
                            </div>

                            <div class="form-group  text-right">
                                {!!Form::label('num_minutos', 'Número de Minutos ')!!}
                                {!!Form::text('num_minutos', number_format($sal->num_minutos, 0, '.', ','), ['class'=>'form-control text-right', 'readonly'=>'readonly', 'placeholder'=>'Número de Minutos Liquidados'])!!}
                            </div>

                            <div class="form-group text-right">
                                {!!Form::label('vr_liquidado', 'Valor Liquidado ')!!}
                                {!!Form::text('vr_liquidado', number_format($sal->vr_liquidado, 2, '.', ','), ['class'=>'form-control text-right', 'readonly'=>'readonly', 'placeholder'=>'Valor Liquidado'])!!}
                            </div>

                            <div class="form-group text-right">
                                {!!Form::label('vr_iva', 'Valor Impuesto ')!!}
                                {!!Form::text('vr_iva', number_format($sal->vr_iva, 2, '.', ','), ['class'=>'form-control text-right', 'readonly'=>'readonly', 'placeholder'=>'Valor Impuesto'])!!}
                            </div>

                            <div class="form-group text-right text-danger h3">
                                {!!Form::label('vr_tot', 'Valor a Pagar ')!!}
                                {!!Form::text('vr_tot', number_format($sal->vr_liquidado + $sal->vr_iva, 2, '.', ','), ['class'=>'form-control form-control-lg text-right text-danger', 'readonly'=>'readonly', 'placeholder'=>'Valor total a Pagar'])!!}
                            </div>

                            <input type="submit" id="enviar_datos" name="enviar_datos" value="Pagar Servicio" class="btn btn-primary btn-block">

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