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
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR QUERY </h4>
                        </div>
                        @foreach($oconsolas as $ocon)

                        {!! Form::open(['route' => ['t_consola.update',$ocon->id_query], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('id_query', 'Código: ')!!}
                                {!!Form::text('id_query', $ocon->id_query, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Query'])!!}
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
                                       <option value='{{ $ocon->id_crud }}'>
                                           {{ $ocon->des_crud }}
                                       </option>

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
                                       <option value='{{ $ocon->table_name }}'>
                                           {{ $ocon->table_name }}
                                       </option>
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
                                {!!Form::textarea('condicion', $ocon->condicion, ['class'=>'form-control','placeholder'=>'Condición del Query'])!!}
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
                                {!!Form::text('valor1', $ocon->valor1, ['class'=>'form-control','placeholder'=>'Valor 1 del Query'])!!}
                                @if ($errors->has('valor1'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('valor1') }}</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('valor2', $ocon->valor2, ['class'=>'form-control','placeholder'=>'Valor 2 del Query'])!!}
                                @if ($errors->has('valor2'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('valor2') }}</li>
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