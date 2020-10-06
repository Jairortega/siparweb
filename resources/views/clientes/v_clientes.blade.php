<?php $retorno = 't_clientes'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONSULTA CLIENTE </h4>
                        </div>
                            @foreach($clientes as $cliente)
                             @if(session('status'))
                             <div class="alert alert-info">
                                 {{ session('status') }}
                             </div>
                             @endif    
                            {!! Form::open(['route' => ['t_clientes.show',$cliente->cc_user], 'method' => 'GET', 'class' => 'card-body']) !!}
                            
                            <div class="form-group">
                                {!!Form::label('cc_user', 'Cédula: ')!!}
                                {!!Form::text('cc_user', $cliente->cc_user, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Cliente'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('email', 'Correo Electrónico: ')!!}
                                {!!Form::text('email', $cliente->email, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Correo Electrónico del Cliente'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('name', 'Nombre: ')!!}
                                {!!Form::text('name', $cliente->name, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Cliente'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('tel_user', 'Teléfono: ')!!}
                                {!!Form::number('tel_user', $cliente->tel_user, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Teléfono del Cliente'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('cel_user', 'Celular: ')!!}
                                {!!Form::number('cel_user', $cliente->cel_user, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Celular del Cliente'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('cod_dc_user', 'Ciudad: ')!!} 
                                {!!Form::text('cod_dc_user', $cliente->desc_ciudepto, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Ciudad del Cliente'])!!}
                            </div>
                        {!! Form::close() !!}    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


@extends('components.vfootgral')

@endsection