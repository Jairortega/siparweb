<?php $retorno = 't_bingresos'; ?>
@extends('components.vheadper')
@csrf
@section('content')
<div class="container">
    <!-- APPLICATION -->
    <div id="App" class="row pt-12">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <table>
                        @foreach($parqos as $parque)
                        <td><h4 style="color: #007bff; font-size: 20px; ">CONSULTA BALANCE DE INGRESOS - {{ $parque->des_parque }}&nbsp;&nbsp;&nbsp;&nbsp; ** DESDE: {{ $parque->fecha_desde }}  HASTA: {{ $parque->fecha_hasta }}</h4></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        @endforeach
                    </table>
                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead class="text-primary">
                                    <th>F INGRESO</th>
                                    <th>TIPO</th>
                                    <th>RESERVA</th>
                                    <th class="text-primary text-right">VR NETO</th>
                                    <th class="text-primary text-right">VR IVA</th>
                                    <th class="text-primary text-right">VR PAGO</th>
                                </thead>
                                @foreach($ingresos as $ingre)
                                    <tr>
                                        <td>{{ $ingre->fecha_ingreso }}</td>
                                        <td>{{ $ingre->des_tvehiculo }}</td>
                                        <td>{{ $ingre->id_reserva }}</td>
                                        <td class="text-black text-right">{{ number_format($ingre->vr_neto, 2, '.', ',') }}</td>
                                        <td class="text-black text-right">{{ number_format($ingre->vr_iva, 2, '.', ',') }}</td>
                                        <td class="text-black text-right">{{ number_format($ingre->vr_liquidado, 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            {!! $ingresos->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@extends('components.vfootgral')

@endsection