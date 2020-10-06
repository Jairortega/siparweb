<?php $retorno = '/'; ?>
@extends('components.vheadgral')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CONTACTENOS (Únicamente para Administradores)</h4>
                        </div>
<!--                        <div id="mensaje" class="alert alert-danger"> </div>
                        @if ($errors->any())
                           <div class="alert alert-danger">
                              <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                              </ul>
                           </div>
                        @endif
 -->
                        <form id="admon_form" method="post" action="/contactenos" class="card-body">
                            @csrf
                            <div class="form-group">
                                {!!Form::label('cc_admon', 'Cédula: ')!!}
                                {!!Form::number('cc_admon', null, ['class'=>'form-control','placeholder'=>'Cédula del Administrador'])!!}
<!--                                <input type="number" id="cc_admon" name="cc_admon" placeholder="Cedula" class="form-control"> -->
                                @if ($errors->has('cc_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cc_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif

                                @if(Session::has('message'))
                                <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif

                            </div>
                            <div class="form-group">
                                {!!Form::label('nom_admon', 'Nombre: ')!!}
                                {!!Form::text('nom_admon', null, ['class'=>'form-control','placeholder'=>'Nombre del Administrador'])!!}
                                @if ($errors->has('nom_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('nom_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('dir_admon', 'Dirección: ')!!}
                                {!!Form::text('dir_admon', null, ['class'=>'form-control','placeholder'=>'Dirección del Administrador'])!!}
                                @if ($errors->has('dir_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('dir_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">
                                {!!Form::label('tel_admon', 'Teléfono: ')!!}
                                {!!Form::number('tel_admon', null, ['class'=>'form-control','placeholder'=>'Teléfono del Administrador'])!!}
                                @if ($errors->has('tel_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('tel_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif

                            </div>
                            <div class="form-group">
                                {!!Form::label('cel_admon', 'Celular: ')!!}
                                {!!Form::number('cel_admon', null, ['class'=>'form-control','placeholder'=>'Celular del Administrador'])!!}
                                @if ($errors->has('cel_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('cel_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif

                            </div>

                            <div class="form-group">
                                {!!Form::label('mail_admon', 'Correo Electrónico: ')!!}
                                {!!Form::text('mail_admon', null, ['class'=>'form-control','placeholder'=>'Correo Electrónico del Administrador'])!!}
                                @if ($errors->has('mail_admon'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('mail_admon') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <input type="submit" id="enviar_datos" name="enviar_datos" value="Registrar" class="btn btn-primary btn-block">
                        </form>
<!--                        <div id="mensaje2" class="alert alert-info"> </div> -->
                        @if(Session::has('message'))
                        <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

<!--
  <footer id="pie" class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="col-md-12">  
       <div><h6>CONTÁCTENOS</h6>
          <h6>Teléfonos: (+571) 7590645  -  Cel: 304419138  - E-Mail: oortegon@gmail.com  -  Bogotá Colombia</h6>
       </div>
    </div>
  </footer> 
-->

@extends('components.vfootgral')

@endsection