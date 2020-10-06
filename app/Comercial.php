<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Comercial extends Model
{
    protected $table="comerciales";
    protected $fillable =[ 'id_comer', 'archi_comer','tipo_comer'];

}
