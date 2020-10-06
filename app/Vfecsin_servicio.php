<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vfecsin_servicio extends Model
{
    protected $table="vfecsin_servicio";
    protected $fillable =['cc_user', 'id_parque', 'des_parque', 'cod_gr_parque', 
    'des_gr_parque', 'fecha_parque', 'hora_ini', 'hora_fin', 'created_at', 'updated_at'];

}
