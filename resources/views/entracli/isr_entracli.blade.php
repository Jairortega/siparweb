<?php $retorno = 'i_entracli'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR ENTRADA</h4>
                        </div>

                        {!! Form::open(['route' => ['i_entracli.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            @foreach($usuarios as $usu)
                            <div class="form-group">
                                {!!Form::hidden('cc_user_e', $usu->cc_user, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Usuario'])!!}
                            </div>
                            @endforeach

                            <div class="form-group">
                                {!!Form::label('tipo_vehiculo', 'Tipo Vehículo: ')!!}
                                <select name="tipo_vehiculo" id="tipo_vehiculo"
                                        class="form-control" style="height: 30px;">
                                    <option>-----------</option>
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
                                {!!Form::hidden('id_parque', $id_parque, ['class'=>'form-control', 'placeholder'=>'ID Parqueadero'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::hidden('id_reserva', 0, ['class'=>'form-control', 'placeholder'=>'Número de Reserva'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::hidden('email', 'sincorreo@gmail.com', ['class'=>'form-control', 'required' => 'required', 'placeholder'=>'Correo Electrónico (Para recibir su factura)'])!!}
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('email') }}</li>
                                        </ul>
                                    </div>
                                @endif
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