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
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR ENTRADA SIN RESERVA</h4>
                        </div>

                        {!! Form::open(['route' => ['t_entradas.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            @foreach($usuarios as $usu)
                            <div class="form-group">
                                {!!Form::hidden('cc_user_e', $usu->cc_user, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Usuario'])!!}
                            </div>
                            @endforeach

                            <div class="form-group">
                                {!!Form::label('placa', 'Placa Vehículo: ')!!}
                                {!!Form::text('placa', $placa, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Placa del vehículo'])!!}
                                @if ($errors->has('placa'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('placa') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('id_parque', 'Parqueadero: ')!!}
                                <select name="id_parque" id="id_parque"
                                        class="form-control" style="height: 30px;">

                                    @foreach($parqos as $par) 
                                    <option value="{{ $par->id_parque }}">
                                            {{ $par->des_parque }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('id_reserva', 0, ['class'=>'form-control', 'placeholder'=>'Número de Reserva'])!!}
                            </div> 
                            <div class="form-group">
                                {!!Form::label('tipo_vehiculo', 'Tipo Vehículo: ')!!}
                                <select name="tipo_vehiculo" id="tipo_vehiculo"
                                        class="form-control" style="height: 30px;">

                                    @foreach($tipovehiculos as $tveh) 
                                    <option value="{{ $tveh->tipo_vehiculo }}">
                                            {{ $tveh->des_tvehiculo }}
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