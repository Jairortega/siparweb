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
                            <h4 style="color: #007bff; font-size: 20px; ">REGISTRO DE ENTRADA</h4>
                        </div>

                        {!! Form::open(['route' => ['i_entracli.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            @foreach($usuarios as $usu)
                            <div class="form-group">
                                {!!Form::hidden('cc_user_e', 0, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Usuario'])!!}
                            </div>
                            @endforeach

                            <div class="form-group">
                                {!!Form::label('snreserva', 'Tiene reserva Parqueadero (S/N): ')!!}
                                <select name="snreserva" id="snreserva"
                                        class="form-control" style="height: 30px;">
                                    <option>-----------</option>
                                    @foreach($ivapvars as $ivapvar) 
                                    <option value="{{ $ivapvar->id_pv }}">
                                            {{ $ivapvar->des_pv }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="submit" id="enviar_datos" name="enviar_datos" value="Continuar" class="btn btn-primary btn-block">
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