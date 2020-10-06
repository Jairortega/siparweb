<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Dsservicio extends Model
{
    protected $table="fecsin_servicio";
    protected $fillable =['id_parque', 'cc_user', 'fecha_parque', 'hora_ini', 'hora_fin'];
    protected $dates=['fecha_parque',];
}
