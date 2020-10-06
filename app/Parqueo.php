<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Parqueo extends Model
{
    protected $table="parqueaderos";
    protected $fillable =['id_parque','cc_user', 'des_parque',
    'nit_parque', 'id_regimen', 'dir_parque', 'tel_parque', 
    'mail_parque', 'foto_parque', 'cod_dc_parque', 'latitud_parque', 
    'longitud_parque', 'forma_pago', 'reserva', 'fecha_desde', 'fecha_hasta', 
    'cod_gr_parque', 'estado_parque'];
}
