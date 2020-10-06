<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vtaricupo extends Model
{
    protected $table="vtarifas_cupo";
    protected $fillable =['id_parque', 'cc_user', 'cod_gr_parque', 'des_parque',
    'nit_parque', 'id_regimen', 'dir_parque', 'tel_parque',
    'mail_parque', 'foto_parque', 'cod_dc_parque',
    'latitud_parque', 'longitud_parque', 'estado_parque',
    'minutocar', 'minutomoto', 'minutobici', 'dis_cupocar',
    'dis_cupomoto', 'dis_cupobici'];

}
