<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Valmones extends Model
{
    protected $table="vadmones";
    protected $fillable =['cc_admon','nom_admon', 'dir_admon',
    'tel_admon', 'cel_admon', 'mail_admon', 'cod_dc_admon', 'desc_ciudepto', 
    'cod_bco_admon', 'ncuenta_admon', 'tcuenta_admon', 'bloqueo'];
}
