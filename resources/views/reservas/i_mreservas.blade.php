<?php $retorno = 't_reservas'; ?>
@extends('components.vheadper')

@section('content')

        <div class="container">
            <!-- APPLICATION   -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR RESERVA (Ubicación Manual)</h4>
                        </div>
                        @csrf
                        {!! Form::open(['route' => ['t_reservas.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            @foreach($usuarios as $usu)
                            <div class="form-group">
                                {!!Form::hidden('cc_cliente', $usu->cc_user, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Cliente'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('name', 'Nombre: ')!!}
                                {!!Form::text('name', $usu->name, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Cliente'])!!}
                            </div>
                            @endforeach

                            <div class="form-group">
                                {!!Form::label('dir_origen', 'Dirección Origen: ')!!}
                                {!!Form::text('dir_origen', null, ['class'=>'form-control','onchange'=> 'origenMap();', 'placeholder'=>'Dirección Origen'])!!}
                                @if ($errors->has('dir_origen'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('dir_origen') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_destino', 'Dirección Destino: ')!!}
                                {!!Form::text('dir_destino', null, ['class'=>'form-control','onchange'=> 'destinoMap();', 'placeholder'=>'Dirección Destino'])!!}
                                @if ($errors->has('dir_destino'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('dir_destino') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('tipo_vehiculo', 'Tipo Vehículo: ')!!}
                                <select name="tipo_vehiculo" id="tipo_vehiculo" 
                                        class="form-control" style="height: 40px; color: red;">
                                    <option>--------</option>
                                    @foreach($tipovehiculos as $tveh) 
                                    <option value="{{ $tveh->tipo_vehiculo }}">
                                            {{ $tveh->des_tvehiculo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!!Form::label('placa', 'Placa Vehículo: ')!!}
                                {!!Form::text('placa', null, ['class'=>'form-control', 'placeholder'=>'Placa del vehículo'])!!}
                                @if ($errors->has('placa'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('placa') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('latitud_clien', 'Latitud Cliente: ')!!}
                                {!!Form::text('latitud_clien', null, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Latitud Cliente'])!!}
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
                                {!!Form::text('longitud_clien', null, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Longitud Cliente'])!!}
                                @if ($errors->has('longitud_clien'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('longitud_clien') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('latitud_origen', 'Latitud Origen: ')!!}
                                {!!Form::text('latitud_origen', null, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Latitud Origen'])!!}
                                @if ($errors->has('latitud_origen'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('latitud_origen') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('longitud_origen', 'Longitud Origen: ')!!}
                                {!!Form::text('longitud_origen', null, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Longitud Origen'])!!}
                                @if ($errors->has('longitud_origen'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('longitud_origen') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('latitud_destino', 'Latitud Destino: ')!!}
                                {!!Form::text('latitud_destino', null, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Latitud Destino'])!!}
                                @if ($errors->has('latitud_destino'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('latitud_destino') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('longitud_destino', 'Longitud Destino: ')!!}
                                {!!Form::text('longitud_destino', null, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Longitud Destino'])!!}
                                @if ($errors->has('longitud_destino'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('longitud_destino') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('latitud_parque', 0, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Latitud Parqueadero'])!!}
                                @if ($errors->has('latitud_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('latitud_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('longitud_parque', 0, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Longitud Parqueadero'])!!}
                                @if ($errors->has('longitud_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('longitud_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <p style= "color: 44b4c4; font-size: 18px; ">ORIGEN (Icono Amarillo) -  DESTINO (Icono Verde)</p>
                                <p> </p>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token"> 
                                <?php include_once(public_path().'\..\resources\views\reservas\mapars.php') ?>
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