
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura</title>
    {!! Html::style('/css/app.css') !!}
    {!! Html::style('/css/style.css') !!}
    {!!Html::style('css/bootstrap-grid.css')!!}
    {!!Html::script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')!!}
    {!!Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')!!}

  </head>
  <body>   

    <div class="container">
        <!-- APPLICATION -->
        <div id="App" class="row pt-12">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    @foreach($psalidas as $sal) 
                    <table>
                       <tr> 
                            <td>&nbsp;</td>
                       </tr>
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
                       <td>&nbsp;</td>
                            <td><h4 style="color: #007bff; font-size: 14px; ">Correo: {{ $sal->email }} </h4></td>
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
                            <td><h4 style="color: #007bff; font-size: 14px; ">Placa: {{ $sal->placa }} - {{ $sal->des_tvehiculo }} </h4></td>
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
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>


