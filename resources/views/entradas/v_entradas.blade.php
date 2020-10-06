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
                          <table>
                             <td><h4 style="color: #007bff; font-size: 20px; ">CONSULTA ENTRADA</h4></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                             @foreach ($servicios as $servi)
                               <td><p class= "text-primary"> &nbsp;&nbsp;&nbsp;CUPO DISPONIBLE {{ $servi->des_tvehiculo }}S&nbsp;&nbsp;&nbsp;&nbsp;{{ $servi->dis_cupo }}</p></td>
                             @endforeach
                          </table>
                        </div>
                        @foreach($entradas as $entrada)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_entradas.show', $entrada->id_entrada], 'method' => 'GET', 'class' => 'card-body']) !!}
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
                                {!!Form::hidden('tipo_vehiculo', $entrada->tipo_tvehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Tipo de Vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_tvehiculo', 'Tipo Vehículo: ')!!}
                                {!!Form::text('des_tvehiculo', $entrada->des_tvehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Descripción tipo de Vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('placa', 'Placa Vehículo: ')!!}
                                {!!Form::text('placa', $entrada->placa, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Placa del vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('email', 'Correo Electrónico: ')!!}
                                {!!Form::text('email', $entrada->email, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Correo Electrónico del Cliente'])!!}
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

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection