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
                            <h4 style="color: #007bff; font-size: 20px; ">EDITAR OPCION POR PERFIL</h4>
                        </div>
                        @foreach($operfiles as $operfil)

                        {!! Form::open(['route' => ['t_perfilesxop.update', $operfil->id_perfil, $operfil->id_opcion], 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('id_perfil', 'Código Perfil: ')!!}
                                {!!Form::hidden('id_perfil', $operfil->id_perfil, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código del Perfil'])!!}
                                {!!Form::text('perfil', $operfil->perfil, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre del Perfil'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('id_opcion', 'Código Opción: ')!!}
                                {!!Form::hidden('id_opcion', $operfil->id_opcion, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Código de la Opción'])!!}
                                {!!Form::text('opcion', $operfil->opcion, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Nombre de la Opción'])!!}
                            </div>

                            <div class="form-group">
                               {!!Form::label('p_insertar', 'Insertar (S/N): ')!!}
                               <select name="p_insertar" id="p_insertar"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $operfil->p_insertar }}'>
                                           {{ $operfil->insertar }}
                                       </option>
                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                               {!!Form::label('p_modificar', 'Modificar (S/N): ')!!}
                               <select name="p_modificar" id="p_modificar"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $operfil->p_modificar }}'>
                                           {{ $operfil->modificar }}
                                       </option>
                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                               {!!Form::label('p_borrar', 'Borrar (S/N): ')!!}
                               <select name="p_borrar" id="p_borrar"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $operfil->p_borrar }}'>
                                           {{ $operfil->borrar }}
                                       </option>
                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                               {!!Form::label('r_pdf', 'Exportar PDF (S/N): ')!!}
                               <select name="r_pdf" id="r_pdf"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $operfil->r_pdf }}'>
                                           {{ $operfil->pdf }}
                                       </option>
                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                               {!!Form::label('r_csv', 'Exportar EXCEL (S/N): ')!!}
                               <select name="r_csv" id="r_csv"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $operfil->r_csv }}'>
                                           {{ $operfil->csv }}
                                       </option>
                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
                                    </option>
                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                               {!!Form::label('r_txt', 'Exportar TXT (S/N): ')!!}
                               <select name="r_txt" id="r_txt"
                                       class="form-control" style="height: 30px;">
                                       <option value='{{ $operfil->r_txt }}'>
                                           {{ $operfil->txt }}
                                       </option>
                                @foreach($ivapvars as $ivapvar)
                                   <option value="{{ $ivapvar->id_pv }}">
                                           {{ $ivapvar->des_pv }}
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