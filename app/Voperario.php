<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Voperario extends Model
{
    protected $table="voperarios";
    protected $fillable =['cc_operario', 'id_parque', 'des_parque', 
              'cc_user', 'nom_operario', 'dir_operario', 'tel_operario', 
              'cel_operario', 'cod_gr_parque', 'des_gr_parque', 
              'cod_dc_operario', 'desc_ciudepto', 'mail_operario', 'bloqueo', 'sino'];

}
