<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Operario extends Model
{
    protected $table="operarios";
    protected $fillable =['cc_operario', 'id_parque', 'cc_user', 
              'nom_operario', 'dir_operario', 'tel_operario', 
              'cel_operario', 'mail_operario', 'cod_dc_operario', 'bloqueo'];

}
