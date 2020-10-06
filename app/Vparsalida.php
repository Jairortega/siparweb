<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vparsalida extends Model
{
    protected $table="vparsalidas";
    protected $fillable =[ 'id_entrada', 'id_parque', 'des_parque', 'tipo_vehiculo', 
    'des_tvehiculo', 'placa', 'fecha_ingreso', 'hora_ingreso', 'id_reserva', 'cc_cliente',
    'fecha_reserva', 'hora_reserva', 'fecha_salida', 'hora_salida', 'email',
    'num_minutos', 'vr_liquidado', 'vr_iva', 'forma_pago', 'cc_user_e', 'cc_user_s'];
}
