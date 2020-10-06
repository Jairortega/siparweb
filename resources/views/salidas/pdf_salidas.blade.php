<?php $retorno = 't_salidas'; ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
@extends('components.vheadper')


@section('content')
@csrf
    <div class="container">
        <!-- APPLICATION -->
        <div id="App" class="row pt-12">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    @foreach($psalidas as $sal)
                    <?php if( $sal->vr_liquidado > 0 ) { ?>
                    <div class="visible-print text-center" style="color: #007bff; font-size: 16px; ">
                        {!! QrCode::size(100)->generate($sal->placa.' - '.$sal->des_tvehiculo.' Hora salida: '.date("Y-m-d - H:i:s")); !!}
                        <p> </p>
                        <p>!! Estimado Cliente: Por favor mostrar este QR a la salida del Parqueadero !!.</p>
                        <p>Tiene 15 minutos para la Salida.</p>
                    </div>
                      <table>
                       <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 20px; ">FACTURA Nro.{{ $sal->id_entrada }} </h4></td>
                       </tr>
                       <tr> 
                       <td>&nbsp;</td>
                            <td><h3 style="color: #007bff; font-size: 12px; ">Fecha Sistema: {{ date("Y-m-d - H:i:s")}}</h3></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td><h3 style="color: #007bff; font-size: 10px; "><hr></h3></td>
                            <td><h3 style="color: #007bff; font-size: 10px; "><hr></h3></td>
                       </tr>
                       <tr>
                        <td>&nbsp;</td> 
                            <td><h3 style="color: #007bff; font-size: 16px; ">Parqueadero: {{ $sal->des_parque }} </h4></td>
                       </tr>
                       <tr>
                        <td>&nbsp;</td> 
                            <td><h4 style="color: #007bff; font-size: 14px; ">NIT: {{ $sal->nit_parque }} </h4></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 14px; ">Dirección: {{ $sal->dir_parque }} </h4></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 14px; ">Teléfono: {{ $sal->tel_parque }} </h4></td>
                       </tr>
                       <tr> 
                       <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 14px; ">{{ $sal->dregimen }} </h4></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 14px; ">Fecha: {{ $sal->fecha_reserva }} </h4></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 12px; ">Hora Inicio: {{ $sal->hora_reserva }} Hora Pago: {{ $sal->hora_salida }} </h4></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 14px; ">Placa: {{ $sal->placa }} </h4></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 14px; ">Forma de Pago: {{ $sal->dforpago }} </h4></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td ><h4 style="color: #007bff; font-size: 16px; ">Valor -></h4></td>
                            <td class="text-right"><h4 style="color: #007bff; font-size: 16px; ">{{ number_format($sal->vr_liquidado, 0, '.', ',') }} </h4></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 16px; ">Impuesto -> ({{ $sal->porc_iva }}%) </h4></td>
                            <td class="text-right"><h4 style="color: #007bff; font-size: 16px; ">{{ number_format($sal->vr_iva, 0, '.', ',') }} </h4></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 16px; ">Valor Total -> </h4></td>
                            <td class="text-right"><h4 style="color: #007bff; font-size: 16px; ">{{ number_format($sal->vr_liquidado + $sal->vr_iva, 0, '.', ',') }} </h4></td>
                       </tr>
                       <tr> 
                        <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 20px; ">GRACIAS POR SU PAGO</h4></td>
                       </tr>

                      </table>
                    <?php } ?>
                      @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    @foreach($perfiles as $perfil)
                      <table>
                       <tr> 
                            <td>
                                <a href="../../{{ $perfil->consulta }}/showpdf/{{ $sal->id_entrada }}" target="_blank"><button class="btn btn-primary">ARCHIVO PDF</button></a>
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <a href="../../{{ $perfil->consulta }}/showcorreo/{{ $sal->id_entrada }}"><button class="btn btn-primary">CORREO ELECTRONICO</button></a>
                            </td>
                       </tr>
                      </table>
                      @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@extends('components.vfootgral')

@endsection