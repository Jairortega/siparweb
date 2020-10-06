<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table="users";
    protected $fillable = [
        'name', 'cc_user', 'email', 'password','id_perfil',
        'tel_user', 'cel_user', 'cod_dc_user', 'bloqueo'];

}
