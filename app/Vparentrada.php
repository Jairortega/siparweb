<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vparentrada extends Model
{
    protected $table="vparentradas";
    protected $fillable =[ 'id_entrada', 'id_parque', 'des_parque', 'tipo_vehiculo', 
    'des_tvehiculo', 'placa', 'id_reserva', 'fecha_reserva', 'hora_reserva', 
    'fecha_ingreso', 'hora_ingreso', 'email', 'cc_user_e'];
}
