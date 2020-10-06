<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table="mov_parqueos";
    protected $fillable =[ 'id_entrada', 'id_parque','tipo_vehiculo', 
    'placa', 'email', 'fecha_ingreso', 'hora_ingreso', 'id_reserva', 'fecha_reserva', 
    'hora_reserva', 'cc_cliente', 'cc_user_e'];
}
