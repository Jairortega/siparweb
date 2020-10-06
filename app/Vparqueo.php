<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vparqueo extends Model
{
    protected $table="vparqueos";
    protected $fillable =['cod_gr_parque', 'des_gr_parque', 'id_parque', 
    'cc_user', 'des_parque', 'nit_parque', 'id_regimen', 'dregimen', 
    'dir_parque', 'tel_parque', 'mail_parque', 'foto_parque', 'cod_dc_parque', 
    'desc_ciuddepto', 'latitud_parque', 'longitud_parque', 
    'estado_parque'];
}
