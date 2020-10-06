<?php $retorno = 't_perfilesxop'; ?>
@extends('components.vheadper')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">CREAR OPCIÓN POR PERFIL</h4>
                        </div>

                        {!! Form::open(['route' => ['t_perfilesxop.store'], 'method' => 'POST', 'class' => 'card-body']) !!}
                        <div class="form-group">
                               {!!Form::label('id_perfil', 'Perfil: ')!!}
                               <select name="id_perfil" id="id_perfil"
                                       class="form-control" style="height: 30px;">

                                @foreach($perfiles as $perfile)
                                   <option value="{{ $perfile->id_perfil }}">
                                           {{ $perfile->perfil }}
                                    </option>
                                @endforeach
                                </select>
                                @if(Session::has('message'))
                                   <div id="mensaje2" class="alert alert-{{ Session::get('class')}}">{{ Session::get('message')}} </div>
                                @endif

                                @if ($errors->has('id_perfil'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_perfil') }}</li>
                                        </ul>
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                               {!!Form::label('id_opcion', 'Opción: ')!!}
                               <select name="id_opcion" id="id_opcion"
                                       class="form-control" style="height: 30px;">

                                @foreach($opciones as $opcion)
                                   <option value="{{ $opcion->id_opcion }}">
                                           {{ $opcion->opcion }}
                                    </option>
                                @endforeach
                                </select>
                                @if ($errors->has('id_opcion'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_opcion') }}</li>
                                        </ul>
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                               {!!Form::label('p_insertar', 'Insertar (S/N): ')!!}
                               <select name="p_insertar" id="p_insertar"
                                       class="form-control" style="height: 30px;">

                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                                @if ($errors->has('id_opcion'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('id_opcion') }}</li>
                                        </ul>
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                               {!!Form::label('p_modificar', 'Modicar (S/N): ')!!}
                               <select name="p_modificar" id="p_modificar"
                                       class="form-control" style="height: 30px;">

                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                                @if ($errors->has('p_modificar'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('p_modificar') }}</li>
                                        </ul>
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                               {!!Form::label('p_borrar', 'Borrar (S/N): ')!!}
                               <select name="p_borrar" id="p_borrar"
                                       class="form-control" style="height: 30px;">

                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                                @if ($errors->has('p_borrar'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('p_borrar') }}</li>
                                        </ul>
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                               {!!Form::label('r_pdf', 'Exportar PDF (S/N): ')!!}
                               <select name="r_pdf" id="r_pdf"
                                       class="form-control" style="height: 30px;">

                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                                @if ($errors->has('r_pdf'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('r_pdf') }}</li>
                                        </ul>
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                               {!!Form::label('r_csv', 'Exportar EXCEL (S/N): ')!!}
                               <select name="r_csv" id="r_csv"
                                       class="form-control" style="height: 30px;">

                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                                @if ($errors->has('r_csv'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('r_csv') }}</li>
                                        </ul>
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                               {!!Form::label('r_txt', 'Exportar TXT (S/N): ')!!}
                               <select name="r_txt" id="r_txt"
                                       class="form-control" style="height: 30px;">

                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                                @if ($errors->has('r_txt'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ $errors->first('r_txt') }}</li>
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