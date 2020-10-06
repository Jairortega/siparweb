<?php

namespace parqueos;

use Illuminate\Database\Eloquent\Model;

class Vfactura extends Model
{
    protected $table="vfacturas";
    protected $fillable =['id_entrada', 'id_parque', 'des_parque', 'nit_parque',
    'tipo_vehiculo', 'des_tvehiculo', 'placa', 'forma_pago', 'id_reserva', 'dforpago',
    'fecha_reserva', 'hora_reserva', 'fecha_ingreso', 'hora_ingreso', 'fecha_salida',
    'hora_salida', 'email', 'num_minutos', 'vr_liquidado', 'vr_iva', 'und_parque', 'vr_parque',
    'porc_iva', 'iva', 'id_regimen', 'dregimen', 'dir_parque', 'tel_parque', 'latitud_parque',
    'longitud_parque', 'cc_user_e', 'cc_user_s', 'estado_parque'];   
}
