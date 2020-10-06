<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vconreser extends Model
{
    protected $table="vreserpqs";
    protected $fillable =['id_parque','tipo_vehiculo', 'tot_r'];
}
