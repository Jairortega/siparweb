<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vreserva extends Model
{
    protected $table="vreservas"; 
    protected $fillable =['id_reserva', 'id_parque', 'des_parque', 'dir_parque', 
    'cc_cliente', 'name', 'tel_parque', 'foto_parque',  'id_perfil', 'email', 
    'fecha_reserva', 'tipo_vehiculo', 'des_tvehiculo', 'placa', 'hora_reserva', 
    'estado_reserva', 'des_ereserva', 'latitud_clien', 'longitud_clien', 
    'latitud_origen', 'longitud_origen', 'latitud_destino', 'longitud_destino', 
    'latitud_parque', 'longitud_parque', 'fecha_sys', 'hora_sys', 'created_at', 
    'updated_at'];

}
