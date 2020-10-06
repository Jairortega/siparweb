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
                        <td><h4 style="color: #007bff; font-size: 20px; ">RESERVAS - Ubicacion: </h4></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        @if ($insertar == "1")
                        <td><a href="{{ $perfil->consulta }}/create/1"><button class="btn btn-primary">Automática</button></a></td>
                        <td><a href="{{ $perfil->consulta }}/create/2"><button class="btn btn-primary">Manual</button></a></td>
                        @endif
                      </table>
                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead class="text-primary">
                                        <th>CÓDIGO</th>
                                        <th>PARQUEADERO</th>
                                        <th>PLACA</th>
                                        <th>FECHA</th>
                                        <th>HORA</th>
                                        <th>ESTADO</th>
                                        <th>OPCIONES</th>
                                    </thead>
                                    @foreach($reservas as $res)
                                    <tr>
                                        <td>{{ $res->id_parque }}</td>
                                        <td>{{ $res->des_parque }}</td>
                                        <td>{{ $res->placa }}</td>
                                        <td>{{ $res->fecha_reserva }}</td>
                                        <td>{{ $res->hora_reserva }}</td>
                                        <td>{{ $res->des_ereserva }}</td>
                                        <td>
                                            <a href="{{ $perfil->consulta }}/show/{{ $res->id_reserva }}"><button class="btn btn-primary">Visualizar</button></a>
                                            @if ($modificar == "1")
                                              <a href="{{ $perfil->consulta }}/{{ $res->id_reserva }}/edit"><button class="btn btn-primary">Editar</button></a>
                                            @endif
                                            @if ($borrar == "1")
                                            <a href="{{ $perfil->consulta }}/destroy/{{ $res->id_reserva }}" onclick="return confirm('Está seguro de borrarlo? ')"><button class="btn btn-danger">Eliminar</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                {!! $reservas->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@extends('components.vfootgral')

@endsection