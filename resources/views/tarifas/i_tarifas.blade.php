<?php $retorno = 't_tarifas'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR TARIFA</h4>
                        </div>

                        {!! Form::open(['route' => ['t_tarifas.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_parque', 'Código Parqueadero: ')!!}
                                <select name="id_parque" id="id_parque"
                                        class="form-control" style="height: 30px;">

                                    @foreach($parqos as $parqo) 
                                    <option value="{{ $parqo->id_parque }}">
                                            {{ $parqo->des_parque }}
                                        </option>
                                    @endforeach
                                </select>
                                @if(Session::has('message'))
                                    <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif
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

                            <div class="form-group">
                                {!!Form::label('und_parque', 'Unidad Tarifa: ')!!}
                                <select name="und_parque" id="und_parque"
                                        class="form-control" style="height: 30px;">

                                    @foreach($tarpvars as $tarpvar) 
                                    <option value="{{ $tarpvar->id_pv }}">
                                            {{ $tarpvar->des_pv }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!!Form::label('vr_parque', 'Valor Tarifa: ')!!}
                                {!!Form::number('vr_parque', null, ['class'=>'form-control','placeholder'=>'Valor de la Tarifa'])!!}
                                @if ($errors->has('vr_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('vr_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('cupo', 'Cupo: ')!!}
                                {!!Form::number('cupo', null, ['class'=>'form-control','placeholder'=>'Cupo Parqueadero'])!!}
                                @if ($errors->has('cupo'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cupo') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('porc_iva', 'Porcentaje Impuesto: ')!!}
                                {!!Form::number('porc_iva', null, ['class'=>'form-control','placeholder'=>'Porcentaje del Impuesto'])!!}
                                @if ($errors->has('porc_iva'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('porc_iva') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('iva', 'Impuesto (S/N): ')!!}
                                <select name="iva" id="iva"
                                        class="form-control" style="height: 30px;">

                                    @foreach($ivapvars as $ivapvar) 
                                    <option value="{{ $ivapvar->id_pv }}">
                                            {{ $ivapvar->des_pv }}
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