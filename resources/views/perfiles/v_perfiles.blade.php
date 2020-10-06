<?php $retorno = 't_perfiles'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA PERFIL</h4>
                        </div>
                        @foreach($operfiles as $perfil)
                        @if(session('status'))
                        <div class="alert alert-info">
                            {{ session('status') }}
                        </div>
                        @endif    

                        {!! Form::open(['route' => ['t_perfiles.show', $perfil->id_perfil], 'method' => 'GET', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_perfil', 'Código: ')!!}
                                {!!Form::number('id_perfil', $perfil->id_perfil, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Perfil'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('perfil', 'Perfil: ')!!}
                                {!!Form::text('perfil', $perfil->perfil, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Perfil'])!!}
                            </div>

                            {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection