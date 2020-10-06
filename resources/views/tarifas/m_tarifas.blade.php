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
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR TARIFA </h4>
                        </div>
                        @foreach($tarifas as $tarifa)

                        {!! Form::open(['route' => ['t_tarifas.update', $tarifa->id_parque], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                               {!!Form::label('id_parque', 'Código Parqueadero: ')!!}
                               {!!Form::text('id_parque', $tarifa->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Parqueadero'])!!}
                               {!!Form::hidden('id_parque', $tarifa->id_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                               {!!Form::label('tipo_vehiculo', 'Tipo Vehículo: ')!!}
                               {!!Form::text('tipo_vehiculo', $tarifa->des_tvehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Tipo de Vehículo'])!!}
                               {!!Form::hidden('tipo_vehiculo', $tarifa->tipo_vehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Tipo de Vehículo'])!!}
                            </div>

                            <div class="form-group">
                               {!!Form::label('und_parque', 'Unidad Tarifa: ')!!}
                               <select name="und_parque" id="und_parque"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $tarifa->und_parque }}'>
                                           {{ $tarifa->minhr }}
                                       </option>
                                @foreach($tarpvars as $tarpv)
                                   <option value="{{ $tarpv->id_pv }}">
                                           {{ $tarpv->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!!Form::label('vr_parque', 'Valor Tarifa: ')!!}
                                {!!Form::number('vr_parque', $tarifa->vr_parque, ['class'=>'form-control','placeholder'=>'Valor de la Tarifa'])!!}
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
                                {!!Form::number('cupo', $tarifa->cupo, ['class'=>'form-control','placeholder'=>'Cupo Parqueadero'])!!}
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
                                {!!Form::number('porc_iva', $tarifa->porc_iva, ['class'=>'form-control','placeholder'=>'Porcentaje del Impuesto'])!!}
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
                                       <option value='{{ $tarifa->iva }}'>
                                           {{ $tarifa->sino }}
                                       </option>
                                @foreach($ivapvars as $ivapv)
                                   <option value="{{ $ivapv->id_pv }}">
                                           {{ $ivapv->des_pv }}
                                    </option>
                                @endforeach
                                </select>
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