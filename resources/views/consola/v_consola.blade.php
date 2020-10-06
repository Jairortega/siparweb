<?php $retorno = 't_consola'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA QUERY</h4>
                        </div>
                        @foreach($oconsolas as $ocon)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_consola.show', $ocon->id_query], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_query', 'Código: ')!!}
                                {!!Form::number('id_query', $ocon->id_query, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Query'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('id_crud', 'CRUD: ')!!}
                                {!!Form::text('id_crud', $ocon->des_crud, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del CRUD'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('table_name', 'Tabla: ')!!}
                                {!!Form::text('table_name', $ocon->table_name, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre de la Tabla'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('condicion', 'Condición: ')!!}
                                {!!Form::textarea('condicion', $ocon->condicion, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Detalle del Query'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('valor1', 'Valor 1: ')!!}
                                {!!Form::text('valor1', $ocon->valor1, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Valor 1 del Query'])!!}
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection