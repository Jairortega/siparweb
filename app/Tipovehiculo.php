<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Tipovehiculo extends Model
{
    protected $table="tipo_vehiculos";
    protected $fillable =['tipo_vehiculo', 'des_tvehiculo'];

}
