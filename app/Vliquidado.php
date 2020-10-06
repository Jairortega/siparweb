<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vliquidado extends Model
{
    protected $table="vliquidado";
    protected $fillable =['id_entrada', 'id_parque', 'des_parque', 'tipo_vehiculo', 
    'des_tvehiculo', 'placa', 'forma_pago', 'id_reserva', 'fecha_reserva', 
    'hora_reserva', 'fecha_ingreso', 'hora_ingreso', 'fecha_salida', 
    'hora_salida', 'num_minutos', 'vr_liquidado', 'vr_iva', 'cupo',
    'tot_e', 'tot_s', 'tot_r', 'dis_cupo', 'und_parque', 'vr_parque', 
    'porc_iva', 'iva', 'dir_parque', 'tel_parque', 'cc_user_e', 'cc_user_s', 
    'latitud_parque', 'longitud_parque', 'estado_parque'];

}
