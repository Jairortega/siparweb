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
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR PERFIL </h4>
                        </div>
                        @foreach($operfiles as $perfil)

                        {!! Form::open(['route' => ['t_perfiles.update',$perfil->id_perfil], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('id_perfil', 'Código: ')!!}
                                {!!Form::text('id_perfil', $perfil->id_perfil, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Perfil'])!!}
                                @if ($errors->has('id_perfil'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_perfil') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('perfil', 'Perfil: ')!!}
                                {!!Form::text('perfil', $perfil->perfil, ['class'=>'form-control','placeholder'=>'Nombre del Perfil'])!!}
                                @if ($errors->has('perfil'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('perfil') }}</li>
                                        </ul>
                                    </div>
                                @endif
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