<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Depto extends Model
{
    protected $table="deptos";
    protected $fillable =['desc_depto','cod_depto'];
}
