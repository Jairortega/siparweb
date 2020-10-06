<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $table="tarifas";
    protected $fillable =['cc_user', 'id_parque', 'tipo_vehiculo', 
    'cupo', 'tot_e', 'tot_s', 'tot_r', 'und_parque', 'vr_parque', 
    'vr_minuto', 'porc_iva', 'iva'];

}
