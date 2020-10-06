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
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR CLIENTE </h4>
                        </div>
                        @foreach($clientes as $cliente)

                        {!! Form::open(['route' => ['t_clientes.update',$cliente->cc_user], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('cc_user', 'Cédula: ')!!}
                                {!!Form::text('cc_user', $cliente->cc_user, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Cédula del Cliente'])!!}
                                @if ($errors->has('cc_user'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cc_user') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('email', 'Correo Electrónico: ')!!}
                                {!!Form::text('email', $cliente->email, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Correo Electrónico del Cliente'])!!}
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('email') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('name', 'Nombre: ')!!}
                                {!!Form::text('name', $cliente->name, ['class'=>'form-control','placeholder'=>'Nombre del Cliente'])!!}
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('name') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('tel_user', 'Teléfono: ')!!}
                                {!!Form::number('tel_user', $cliente->tel_user, ['class'=>'form-control','placeholder'=>'Teléfono del Cliente'])!!}
                                @if ($errors->has('tel_user'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('tel_user') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('cel_user', 'Celular: ')!!}
                                {!!Form::number('cel_user', $cliente->cel_user, ['class'=>'form-control','placeholder'=>'Celular del Cliente'])!!}
                                @if ($errors->has('cel_user'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cel_user') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                               {!!Form::label('cod_dc_user', 'Ciudad: ')!!}
                               <select name="cod_dc_user" id="cod_dc_user"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $cliente->cod_dc_user }}'>
                                           {{ $cliente->desc_ciudepto }}
                                       </option>
                                @foreach($deptos as $depto)
                                   <option value="{{ $depto->cod_dc }}">
                                           {{ $depto->desc_ciudepto }}
                                    </option>
                                @endforeach
                                </select>
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