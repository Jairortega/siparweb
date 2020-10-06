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
                            <h4 style="color: #007bff; font-size: 20px; ">SELECCIONE O MODIFIQUE PARQUEADERO </h4>
                        </div>
                        @foreach($reservas as $reserva)

                        {!! Form::open(['route' => ['t_reservas.update', $reserva->id_reserva], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::hidden('id_reserva', $reserva->id_reserva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'ID Reserva'])!!}
                                {!!Form::hidden('tipo_vehiculo', $reserva->tipo_tvehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Tipo de Vehículo'])!!}
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
                                {!!Form::label('des_tvehiculo', 'Tipo Vehículo: ')!!}
                                {!!Form::text('des_tvehiculo', $reserva->des_tvehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Placa del Vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('placa', 'Placa: ')!!}
                                {!!Form::text('placa', $reserva->placa, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Placa del Vehículo'])!!}
                                @if ($errors->has('placa'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('placa') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group" style="color: red;">
                                {!!Form::label('id_parque', 'Parqueaderos Zona Destino: ')!!}
                                <select name="id_parque" id="id_parque"
                                        class="form-control" style="height: 40px;">
                                    <option> ------------</option>
                                    @foreach($parqos as $parqo) 
                                    <option value="{{ $parqo->id_parque }}">
                                        @if($reserva->tipo_vehiculo == 1)
                                            {{ $parqo->des_parque.' --- DIRECC: '.$parqo->dir_parque. ' --- VR MINUTO: '.$parqo->minutocar. ' COP' }}
                                        @endif
                                        @if($reserva->tipo_vehiculo == 2)
                                            {{ $parqo->des_parque.' --- DIRECC: '.$parqo->dir_parque. ' --- VR MINUTO: '.$parqo->minutomoto. ' COP' }}
                                        @endif
                                        @if($reserva->tipo_vehiculo == 3)
                                            {{ $parqo->des_parque.' --- DIRECC: '.$parqo->dir_parque. ' --- VR MINUTO: '.$parqo->minutobici. ' COP' }}
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                                @if(Session::has('message'))
                                    <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif
                            </div>

                            <div class="form-group">
                               {!!Form::label('estado_reserva', 'Estado Reserva: ')!!}
                               <select name="estado_reserva" id="estado_reserva"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $reserva->estado_reserva }}'>
                                           {{ $reserva->des_ereserva }}
                                       </option>
                                @foreach($estapvars as $estapv)
                                   <option value="{{ $estapv->id_pv }}">
                                           {{ $estapv->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!!Form::label('latitud_clien', 'Latitud Cliente: ')!!}
                                {!!Form::text('latitud_clien', $reserva->latitud_clien, ['class'=>'form-control','placeholder'=>'Latitud Cliente'])!!}
                                @if ($errors->has('latitud_clien'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('latitud_clien') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('longitud_clien', 'Longitud Cliente: ')!!}
                                {!!Form::text('longitud_clien', $reserva->longitud_clien, ['class'=>'form-control','placeholder'=>'Longitud Cliente'])!!}
                                @if ($errors->has('longitud_clien'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('longitud_clien') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('latitud_parque', 'Latitud Parqueadero: ')!!}
                                {!!Form::text('latitud_parque', $reserva->latitud_parque, ['class'=>'form-control','placeholder'=>'Latitud Parqueadero'])!!}
                                @if ($errors->has('latitud_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('latitud_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('longitud_parque', 'Longitud Parqueadero: ')!!}
                                {!!Form::text('longitud_parque', $reserva->longitud_parque, ['class'=>'form-control','placeholder'=>'Longitud Parqueadero'])!!}
                                @if ($errors->has('longitud_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('longitud_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
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