<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table="administradores";
    protected $fillable =['cc_admon','nom_admon', 'dir_admon',
    'tel_admon', 'cel_admon', 'mail_admon', 'cod_dc_admon', 'cod_bco_admon',
    'ncuenta_admon', 'tcuenta_admon', 'fecha_sys', 'hora_sys', 'bloqueo'];

}
