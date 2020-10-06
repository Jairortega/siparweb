<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table="perfiles";
    protected $fillable =['id_perfil', 'perfil'];
}
