<?php $retorno = 't_admones'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA ADMINISTRADOR </h4>
                        </div>
                            @foreach($admones as $admon)
                             @if(session('status'))
                             <div class="alert alert-info">
                                 {{ session('status') }}
                             </div>
                             @endif    
                            {!! Form::open(['route' => ['t_admones.show',$admon->cc_admon], 'method' => 'GET', 'class' => 'card-body']) !!}
                            
                            <div class="form-group">
                                {!!Form::label('cc_admon', 'Cédula: ')!!}
                                {!!Form::text('cc_admon', $admon->cc_admon, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Administrador'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('nom_admon', 'Nombre: ')!!}
                                {!!Form::text('nom_admon', $admon->nom_admon, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Administrador'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_admon', 'Dirección: ')!!}
                                {!!Form::text('dir_admon', $admon->dir_admon, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Dirección del Administrador'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('tel_admon', 'Teléfono: ')!!}
                                {!!Form::number('tel_admon', $admon->tel_admon, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Teléfono del Administrador'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('cel_admon', 'Celular: ')!!}
                                {!!Form::number('cel_admon', $admon->cel_admon, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Celular del Administrador'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('mail_admon', 'Correo Electrónico: ')!!}
                                {!!Form::text('mail_admon', $admon->mail_admon, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Correo Electrónico del Administrador'])!!}
                            </div>

                        {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


@extends('components.vfootgral')

@endsection