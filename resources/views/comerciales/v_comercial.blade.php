<?php $retorno = 't_comercial'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA ARCHIVO COMERCIAL</h4>
                        </div>
                        @foreach($comerciales as $comer)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_comercial.show', $comer->id_comer], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_comer', 'Código: ')!!}
                                {!!Form::number('id_comer', $comer->id_comer, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Archivo'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('tipo_comer', 'Tipo de Archivo: ')!!}
                                {!!Form::text('tipo_comer', $comer->tipo_comer, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Tipo de Archivo Comercial'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('archi_comer', 'Archivo Comercial: ')!!}
                                {!!Form::text('archi_comer', $comer->archi_comer, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Archivo Comercial'])!!}
                            </div>

                            <div class="form-group">
                                <img width="100%" src="/../img/{{$comer->archi_comer}}"> 
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection