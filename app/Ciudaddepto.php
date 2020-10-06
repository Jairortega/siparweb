<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Ciudaddepto extends Model
{
    protected $table="ciudad_depto";
    protected $fillable =['cod_dc','desc_ciudepto', 'desc_depto', 'desc_ciudad',
               'cod_depto', 'cod_ciud'];

}
