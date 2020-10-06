<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vtarifa extends Model
{
    protected $table="vtarifas";
    protected $fillable =['cc_user', 'id_parque', 'des_parque', 
    'cod_gr_parque', 'des_gr_parque', 'tipo_vehiculo', 
    'des_tvehiculo', 'und_parque', 'minhr', 'vr_parque', 'vr_minuto',
    'cupo', 'tot_e', 'tot_s', 'tot_r', 'porc_iva', 
    'dis_cupo', 'iva', 'sino', 'dir_parque', 'tel_parque', 
    'latitud_parque', 'longitud_parque', 'estado_parque'];

}
