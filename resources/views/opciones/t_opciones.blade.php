<?php $retorno = 'home'; ?>
@extends('components.vheadper')

@section('content')
@csrf
@foreach($perfiles as $perfil)
<?php
 $insertar = $perfil->p_insertar;
 $modificar = $perfil->p_modificar;
 $borrar = $perfil->p_borrar;
 ?>
@endforeach
    <div class="container">
        <!-- APPLICATION -->
        <div id="App" class="row pt-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <table>
                        <td><h4 style="color: #007bff; font-size: 20px; ">OPCIONES</h4></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        @if ($insertar == "1")
                        <td><a href="{{ $perfil->consulta }}/create"><button class="btn btn-primary">Insertar Registro</button></a></td>
                        @endif
                      </table>
                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead class="text-primary">
                                        <th>CÓDIGO</th>
                                        <th>OPCIÓN</th>
                                        <th>OBJETO</th>
                                        <th>OPCIONES</th>
                                    </thead>
                                    @foreach($opciones as $opcion)
                                    <tr>
                                        <td>{{ $opcion->id_opcion }}</td>
                                        <td>{{ $opcion->opcion }}</td>
                                        <td>{{ $opcion->name_objeto }}</td>
                                        <td>
                                            <a href="{{ $perfil->consulta }}/{{ $opcion->id_opcion }}"><button class="btn btn-primary">Visualizar</button></a>
                                            @if ($modificar == "1")
                                              <a href="{{ $perfil->consulta }}/{{ $opcion->id_opcion }}/edit"><button class="btn btn-primary">Editar</button></a>
                                            @endif
                                            @if ($borrar == "1")
                                            <a href="{{ $perfil->consulta }}/destroy/{{ $opcion->id_opcion }}" onclick="return confirm('Está seguro de borrarlo? ')"><button class="btn btn-danger">Eliminar</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                {!! $opciones->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@extends('components.vfootgral')

@endsection