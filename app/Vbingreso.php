<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vbingreso extends Model
{
    protected $table="vbce_ingresos";
    protected $fillable =['id_parque', 'cc_user', 'cod_gr_parque', 'des_parque', 
    'nit_parque', 'id_regimen', 'dir_parque', 'tel_parque', 'mail_parque', 
	'cod_dc_parque', 'latiud_parque', 'longitud_parque', 'estado_parque', 
	'forma_pago', 'des_fpago', 'des_tvehiculo', 'id_reserva', 'fecha_desde',
    'fecha_hasta', 'cc_admon', 'nom_admon', 'cod_dc_admon', 'cod_bco_admon', 
	'ncuenta_admon', 'tcuenta_admon', 'fecha_ingreso', 'fecha_salida', 
	'vr_liquidado', 'vr_iva', 'vr_neto', 'cc_user_e', 'usuario_e', 
	'cc_user_s', 'usuario_s']; 

}
