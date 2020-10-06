<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vcliente extends Model
{
    protected $table="vclientes";
    protected $fillable =['cc_user','name', 'id_perfil', 'tel_user', 
               'cel_user', 'cod_dc_user', 'desc_ciudepto','email', 
               'password', 'bloqueo'];

}
