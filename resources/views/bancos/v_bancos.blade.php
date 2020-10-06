<?php $retorno = 't_bancos'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA BANCO</h4>
                        </div>
                        @foreach($bancos as $banco)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_bancos.show', $banco->cod_bco], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('cod_bco', 'Código: ')!!}
                                {!!Form::number('cod_bco', $banco->cod_bco, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Banco'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('banco', 'Banco: ')!!}
                                {!!Form::text('banco', $banco->banco, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Banco'])!!}
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection