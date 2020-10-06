<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table="mov_parqueos";
    protected $fillable =[ 'id_entrada', 'id_parque','tipo_vehiculo', 
    'placa', 'email', 'fecha_ingreso', 'hora_ingreso', 'id_reserva', 
    'fecha_reserva', 'hora_reserva', 'fecha_salida',
    'hora_salida', 'num_minutos', 'vr_liquidado', 'vr_iva', 'forma_pago',
    'cc_cliente', 'cc_user_e', 'cc_user_s'];

}
