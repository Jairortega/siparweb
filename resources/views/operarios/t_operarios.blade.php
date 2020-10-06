<?php $retorno = 'home'; ?>
@extends('components.vheadper')
@csrf
@section('content')
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
                        <td><h4 style="color: #007bff; font-size: 20px; ">OPERARIOS</h4></td>
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
                                        <th>CEDULA</th>
                                        <th>NOMBRE</th>
                                        <th>PARQUEADERO</th>
                                        <th>OPCIONES</th>
                                    </thead>
                                    @foreach($operarios as $operario)
                                    <tr>
                                        <td>{{ $operario->cc_operario }}</td>
                                        <td>{{ $operario->nom_operario }}</td>
                                        <td>{{ $operario->des_parque }}</td>
                                        <td>
                                          @foreach($perfiles as $perfil)
                                            <a href="{{ $perfil->consulta }}/show/{{ $operario->cc_operario }}"><button class="btn btn-primary">Visualizar</button></a>
                                            @if ($modificar == "1")
                                              <a href="{{ $perfil->consulta }}/{{ $operario->cc_operario }}/edit"><button class="btn btn-primary">Editar</button></a>
                                            @endif
                                            @if ($borrar == "1")
                                            <a href="{{ $perfil->consulta }}/destroy/{{ $operario->cc_operario }}" onclick="return confirm('Está seguro de borrarlo? ')"><button class="btn btn-danger">Eliminar</button></a>
                                            @endif
                                          @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                {!! $operarios->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@extends('components.vfootgral')

@endsection