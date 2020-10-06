<?php $retorno = 't_salidas'; ?>
@extends('components.vheadper')
@csrf
@section('content')
<?php  
$ApiKey = "xif6PaM5D2kH3Sd2FTdmleRqH7";
$merchant_id = $_REQUEST['merchantId'];
$referenceCode = $_REQUEST['referenceCode'];
$TX_VALUE = $_REQUEST['TX_VALUE'];
$New_value = number_format($TX_VALUE, 1, '.', '');
$currency = $_REQUEST['currency'];
$transactionState = $_REQUEST['transactionState'];
$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
$firmacreada = md5($firma_cadena);
$firma = $_REQUEST['signature'];
$reference_pol = $_REQUEST['reference_pol'];
$cus = $_REQUEST['cus'];
$extra1 = $_REQUEST['description'];
$pseBank = $_REQUEST['pseBank'];
$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
$transactionId = $_REQUEST['transactionId'];

if ($_REQUEST['transactionState'] == 4 ) {
	$estadoTx = "Transacción aprobada";
}

else if ($_REQUEST['transactionState'] == 6 ) {
	$estadoTx = "Transacción rechazada";
}

else if ($_REQUEST['transactionState'] == 104 ) {
	$estadoTx = "Error";
}

else if ($_REQUEST['transactionState'] == 7 ) {
	$estadoTx = "Transacción pendiente";
}

else {
	$estadoTx=$_REQUEST['mensaje'];
}


if (strtoupper($firma) == strtoupper($firmacreada)) {
?>
	<h2>Resumen Transacción</h2>
	<table>
	<tr>
	<td>Estado de la transaccion</td>
	<td><?php echo $estadoTx; ?></td>
	</tr>
	<tr>
	<tr>
	<td>ID de la transaccion</td>
	<td><?php echo $transactionId; ?></td>
	</tr>
	<tr>
	<td>Referencia de la venta</td>
	<td><?php echo $reference_pol; ?></td>
	</tr>
	<tr>
	<td>Referencia de la transaccion</td>
	<td><?php echo $referenceCode; ?></td>
	</tr>
	<tr>
	<?php
	if($pseBank != null) {
	?>
		<tr>
		<td>cus </td>
		<td><?php echo $cus; ?> </td>
		</tr>
		<tr>
		<td>Banco </td>
		<td><?php echo $pseBank; ?> </td>
		</tr>
	<?php
	}
	?>
	<tr>
	<td>Valor total</td>
	<td>$<?php echo number_format($TX_VALUE); ?></td>
	</tr>
	<tr>
	<td>Moneda</td>
	<td><?php echo $currency; ?></td>
	</tr>
	<tr>
	<td>Descripción</td>
	<td><?php echo ($extra1); ?></td>
	</tr>
	<tr>
	<td>Entidad:</td>
	<td><?php echo ($lapPaymentMethod); ?></td>
	</tr>
	</table>
<?php
}
else
{
?>
	<h1>Error validando firma digital.</h1>
<?php
}

?> 
 

        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">RESPUESTA DEL PAGO CON TARJETA </h4>
                        </div>
                        {!! Form::open(['route' => ['t_salidas.respuesta', $referenceCode, 'method' => 'PUT', 'class' => 'card-body']) !!}

                            <div class="form-group">
                                {!!Form::label('id_reserva', 'Nro Reserva: ')!!}
                                {!!Form::text('id_reserva', $referenceCode, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'ID Reserva'])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::hidden('vr_liquidado', TX_VALUE, ['class'=>'form-control', 'placeholder'=>'Valor Liquidado'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('estado_pago', 'Estado Pago: ')!!}
                                {!!Form::text('estado_pago', $estadoTx, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'Estado del Pago'])!!}
                            </div> 

                            <div class="form-group">
                                {!!Form::label('id_transac', 'ID Transacción: ')!!}
                                {!!Form::text('id_transac', $transactionId, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'ID Transaccion'])!!}
                            </div>

                            <input type="submit" id="enviar_datos" name="enviar_datos" value="Continuar" class="btn btn-primary btn-block">
                            {!! Form::close() !!}
                        
                    </div>
                </div>
            </div>
        </div>


@extends('components.vfootgral')

@endsection