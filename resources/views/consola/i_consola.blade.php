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
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR QUERY</h4>
                        </div>

                        {!! Form::open(['route' => ['t_consola.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                            <div class="form-group">
                                {!!Form::label('id_query', 'Código: ')!!}
                                {!!Form::number('id_query', null, ['class'=>'form-control','placeholder'=>'Código del Query'])!!}
                                @if(Session::has('message'))
                                    <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif

                                @if ($errors->has('id_query'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_query') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                               {!!Form::label('id_crud', 'CRUD: ')!!}
                               <select name="id_crud" id="id_crud"
                                       class="form-control" style="height: 30px;">

                                @foreach($cruds as $crud)
                                   <option value="{{ $crud->id_crud }}">
                                           {{ $crud->des_crud }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                               {!!Form::label('table_name', 'Tabla: ')!!}
                               <select name="table_name" id="table_name"
                                       class="form-control" style="height: 30px;">

                                @foreach($ctablas as $ctab)
                                   <option value="{{ $ctab->table_name }}">
                                           {{ $ctab->table_name }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                              <p>select * from opciones where id_opcion in (1000, 1045, ?), [2000]</P>
                              <p>select * from opciones where opcion like "%ser%", ['ser']</P>
                              <p>select * from opciones where id_opcion between 1000 and ?, [2000]</P>
                              <p>select * from opciones where id_opcion = 1010 and opcion like "%ser%", ['ser']</P>
                            </div>

                            <div class="form-group">
                                {!!Form::label('condicion', 'Condición: ')!!}
                                {!!Form::textarea('condicion', null, ['class'=>'form-control','placeholder'=>'Detalle de la Condición'])!!}
                                @if ($errors->has('condicion'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('condicion') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::label('valor1', 'Valor 1: ')!!}
                                {!!Form::text('valor1', null, ['class'=>'form-control','placeholder'=>'Valor 1 de la Condición'])!!}
                                @if ($errors->has('valor1'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('valor1') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('valor2', null, ['class'=>'form-control','placeholder'=>'Valor 2 de la Condición'])!!}
                                @if ($errors->has('valor2'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('valor2') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <input type="submit" id="enviar_datos" name="enviar_datos" value="Registrar" class="btn btn-primary btn-block">
                        {!! Form::close() !!}
                        @if(Session::has('message'))
                        <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection