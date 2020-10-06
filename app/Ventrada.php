<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Ventrada extends Model
{
    protected $table="ventradas";
    protected $fillable =['id_parque','tipo_vehiculo', 'tot_e'];
}
