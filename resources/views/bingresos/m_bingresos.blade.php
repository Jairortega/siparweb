<?php $retorno = 't_bingresos'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR PARAMETROS - BALANCE DE INGRESOS </h4>
                        </div>
                        @foreach($parqos as $parqo)

                        {!! Form::open(['route' => ['t_bingresos.update',$parqo->id_parque], 'method' => 'PUT', 'class' => 'card-body', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-group">
                                {!!Form::label('id_parque', 'Parqueadero: ')!!}
                                {!!Form::text('id_parque', $parqo->des_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Parqueadero'])!!}
                                @if ($errors->has('id_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                               {!!Form::label('forma_pago', 'Forma de Pago: ')!!}
                               <select name="forma_pago" id="forma_pago"
                                       class="form-control" style="height: 30px;">
                                <option> -------- </option>
                                @foreach($fpagos as $fpago) 
                                   <option value="{{ $fpago->id_pv }}">
                                           {{ $fpago->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                               {!!Form::label('reserva', 'Con Reserva (S/N): ')!!}
                               <select name="reserva" id="reserva"
                                       class="form-control" style="height: 30px;">
                                <option> -------- </option>
                                @foreach($sinos as $sino) 
                                   <option value="{{ $sino->id_pv }}">
                                           {{ $sino->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!!Form::label('fecha_desde', 'Fecha Desde: ')!!}
                                {!!Form::date('fecha_desde', $parqo->fecha_desde, ['class'=>'form-control','placeholder'=>'Fecha Inicial Rango '])!!}
                                @if ($errors->has('fecha_desde'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('fecha_desde') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('fecha_hasta', 'Fecha Hasta: ')!!}
                                {!!Form::date('fecha_hasta', $parqo->fecha_hasta, ['class'=>'form-control','placeholder'=>'Fecha Final Rango '])!!}
                                @if ($errors->has('fecha_hasta'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('fecha_hasta') }}</li>
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