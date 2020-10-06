<?php $retorno = 't_dsservicios'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR DÍA SIN SERVICIO</h4>
                        </div>

                        {!! Form::open(['route' => ['t_dsservicios.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
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
                                {!!Form::label('fecha_parque', 'Fecha: ')!!}
                                {!!Form::date('fecha_parque', null, ['class'=>'form-control','placeholder'=>'Fecha sin servicio'])!!}

                                @if ($errors->has('fecha_parque'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('fecha_parque') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                {!!Form::label('hora_ini', 'Hora Inicial (Hora militar -> 24 horas): ')!!}
                                {!!Form::time('hora_ini', null, ['class'=>'form-control','placeholder'=>'Hora desde'])!!}
                                @if ($errors->has('hora_ini'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('hora_ini') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('hora_fin', 'Hora Final (Hora militar -> 24 horas): ')!!}
                                {!!Form::time('hora_fin', null, ['class'=>'form-control','placeholder'=>'Hora hasta'])!!}
                                @if ($errors->has('hora_fin'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('hora_fin') }}</li>
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