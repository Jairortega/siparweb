<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vsalida extends Model
{
    protected $table="vsalidas";
    protected $fillable =['id_parque','tipo_vehiculo', 'tot_s'];
}
