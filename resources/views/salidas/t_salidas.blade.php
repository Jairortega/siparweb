<?php $retorno = 'home'; ?>
@extends('components.vheadper')

@section('content')

@foreach($perfiles as $perfil)
<?php
 $insertar = $perfil->p_insertar;
 $modificar = $perfil->p_modificar;
 $borrar = $perfil->p_borrar;
 ?>
@endforeach
@csrf
    <div class="container">
        <!-- APPLICATION -->
        <div id="App" class="row pt-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <table>
                        <td><h4 style="color: #007bff; font-size: 20px; ">SALIDAS</h4></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      </table>
                    </div>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover">
                                    <thead class="text-primary">
                                        <th>CÓDIGO</th>
                                        <th>PARQUEADERO</th>
                                        <th>RESERVA</th>
                                        <th>PLACA</th>
                                        <th>FECHA</th>
                                        <th>HORA</th>
                                        <th>VR PAGO</th>
                                        <th>OPCIONES</th>
                                    </thead>
                                    @foreach($salidas as $sal)
                                    <tr>
                                        <td>{{ $sal->id_entrada }}</td>
                                        <td>{{ $sal->des_parque }}</td>
                                        <td>{{ $sal->id_reserva }}</td>
                                        <td>{{ $sal->placa }}</td>
                                        <td>{{ $sal->fecha_ingreso }}</td>
                                        <td>{{ $sal->hora_ingreso }}</td>
                                        <td class="text-right">{{ number_format($sal->vr_liquidado + $sal->vr_iva, 0, '.', ',') }}</td>
                                        <td>
                                            @if ($sal->vr_liquidado > 0)
                                              <a href="{{ $perfil->consulta }}/show/{{ $sal->id_entrada }}"><button class="btn btn-primary">Visualizar</button></a>
                                            @endif
                                            @if ($modificar == "1" and $sal->vr_liquidado == 0)
                                              <a href="{{ $perfil->consulta }}/{{ $sal->id_entrada }}/edit"><button class="btn btn-primary">Pagar</button></a>
                                            @endif
                                            @if ($borrar == "1")
                                            <a href="{{ $perfil->consulta }}/destroy/{{ $sal->id_entrada }}" onclick="return confirm('Está seguro de borrarlo? ')"><button class="btn btn-danger">Eliminar</button></a>
                                            @endif
                                            <a href="{{ $perfil->consulta }}/showreg/{{ $sal->id_entrada }}"><button class="btn btn-primary">Factura</button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                {!! $salidas->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@extends('components.vfootgral')

@endsection
