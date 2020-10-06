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
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR ENTRADA CON RESERVA</h4>
                        </div>

                        {!! Form::open(['route' => ['t_entradas.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            @foreach($usuarios as $usu)
                            <div class="form-group">
                                {!!Form::hidden('cc_user_e', $usu->cc_user, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Usuario'])!!}
                            </div>
                            @endforeach

                        @foreach($reservas as $vres)
                            <div class="form-group">
                                {!!Form::label('placa', 'Placa Vehículo: ')!!}
                                {!!Form::text('placa', $vres->placa, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Placa del vehículo'])!!}
                                @if ($errors->has('placa'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('placa') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('id_parque', $vres->id_parque, ['class'=>'form-control', 'placeholder'=>'Número de Reserva'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('des_parque', 'Nro Reserva: ')!!}
                                {!!Form::text('des_parque', $vres->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Parqueadero'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('id_reserva', 'Nro Reserva: ')!!}
                                {!!Form::text('id_reserva', $vres->id_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Número de Reserva'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::hidden('tipo_vehiculo', $vres->tipo_vehiculo, ['class'=>'form-control', 'placeholder'=>'Tipo de Vehículo'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('des_tvehiculo', 'Tipo Vehículo: ')!!}
                                {!!Form::text('des_tvehiculo', $vres->des_tvehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Descripción tipo de Vehículo'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('email', 'Correo Electrónico: ')!!}
                                {!!Form::text('email', $vres->email, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Correo Electrónico del Cliente'])!!}
                            </div>

                        @endforeach
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