<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table="reservas"; 
    protected $fillable =['id_reserva', 'cc_cliente', 'id_parque', 'tipo_vehiculo', 'placa', 'fecha_reserva', 
    'hora_reserva', 'email', 'dir_origen', 'dir_destino', 'estado_reserva', 'latitud_clien', 'longitud_clien', 
    'latitud_origen', 'longitud_origen', 'latitud_destino', 'longitud_destino', 'latitud_parque', 'longitud_parque', 
    'fecha_sys', 'hora_sys', 'created_at', 'updated_at'];
}
