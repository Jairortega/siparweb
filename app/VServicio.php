<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class VServicio extends Model
{
    protected $table="vservicios";
    protected $fillable =['cc_user', 'id_parque', 'des_parque', 'cod_gr_parque', 
    'dir_parque', 'tel_parque', 'latiud_parque', 'longitud_parque', 'tipo_vehiculo',
    'des_tvehiculo', 'cupo', 'tot_e', 'tot_s', 'tot_r', 'dis_cupo', 'und_parque',
    'minhr', 'vr_parque', 'porc_iva', 'iva']; 

}
