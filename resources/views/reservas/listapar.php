<?php
// Seleccion datos de solicitudes_cr
if (isset($_POST['lati'], $_POST['longi']) 
	and "" != $_POST['lati']
	and "" != $_POST['longi']) {

    $lati = $_POST['lati'];
    $longi = $_POST['longi'];
	
	$rilati = $lati - 0.08;
	$rflati = $lati + 0.08;
	$rilngi = $longi - 0.08;
	$rflngi = $longi + 0.08;
	
	$parqos = DB::table('vtarifas_cupo')
            ->where('latitud_parque', '>=', $rilati)
			->where('latitud_parque', '<=', $rflati)
			->where('longitud_parque', '>=', $rilngi)
            ->where('longitud_parque', '<=', $rflngi)->get();
/*
    foreach($parqos as $parqo) {
      <select id="id_parque" name="id_parque">
      echo "<option value='<?php $parqo->id_parque ?>'>";
      echo '<?php  $parqo->des_parque ?>'."</option>";
      </select>
    }

echo $parqo->id_parque;
*/
echo $parqos;
} 
?>
