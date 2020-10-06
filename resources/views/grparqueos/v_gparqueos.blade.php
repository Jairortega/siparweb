<?php $retorno = 't_gparqueos'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA GRUPO DE PARQUEADEROS</h4>
                        </div>
                        @foreach($grparqos as $grparqo)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_gparqueos.show', $grparqo->cod_gr_parque], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('cod_gr_parque', 'Código: ')!!}
                                {!!Form::number('cod_gr_parque', $grparqo->cod_gr_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Grupo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('des_gr_parque', 'Grupo: ')!!}
                                {!!Form::text('des_gr_parque', $grparqo->des_gr_parque, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Grupo'])!!}
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection