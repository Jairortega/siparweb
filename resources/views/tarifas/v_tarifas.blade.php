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
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA TARIFA</h4>
                        </div>
                        @foreach($tarifas as $tarifa)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_tarifas.show', $tarifa->id_parque, $tarifa->tipo_vehiculo], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_parque', 'Código: ')!!}
                                {!!Form::text('id_parque', $tarifa->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('tipo_vehiculo', 'Tipo Vehículo: ')!!}
                                {!!Form::text('tipo_vehiculo', $tarifa->des_tvehiculo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Tipo de Vehículo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('und_parque', 'Unidad Tarifa: ')!!}
                                {!!Form::text('und_parque', $tarifa->minhr, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Unidad de Tarifa'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('vr_parque', 'Valor Tarifa: ')!!}
                                {!!Form::text('vr_parque', $tarifa->vr_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Valor Tarifa'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('cupo', 'Cupo: ')!!}
                                {!!Form::text('cupo', $tarifa->cupo, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cupo Parqueadero'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('porc_iva', 'Porcentaje Impuesto: ')!!}
                                {!!Form::text('porc_iva', $tarifa->porc_iva, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Porcentaje del Impuesto'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('iva', 'Impuesto (S/N): ')!!}
                                {!!Form::text('iva', $tarifa->sino, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Impuesto (S/N)'])!!}
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection