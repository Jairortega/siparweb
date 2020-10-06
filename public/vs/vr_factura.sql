DROP VIEW `vfacturas`;

create view `vfacturas` as 
SELECT id_entrada, mvpar.id_parque id_parque, des_parque, nit_parque,
       mvpar.tipo_vehiculo tipo_vehiculo, des_tvehiculo, placa, 
	   case when forma_pago = 0
	   then 'TARJETA'
	   else 'EFECTIVO'
	   end as dforpago, 
	   id_reserva, `fecha_reserva`, `hora_reserva`, `email`,
	   `fecha_ingreso`, `hora_ingreso`, fecha_salida, hora_salida, num_minutos, vr_liquidado, vr_iva,
	   und_parque, vr_parque, porc_iva, iva, par.id_regimen id_regimen, des_pv dregimen,
	   dir_parque, tel_parque, cc_user_e, cc_user_s, latitud_parque, longitud_parque, estado_parque
FROM mov_parqueos mvpar
LEFT JOIN tarifas 
ON (mvpar.id_parque = tarifas.id_parque
   AND mvpar.tipo_vehiculo = tarifas.tipo_vehiculo)
LEFT JOIN parqueaderos par
ON mvpar.id_parque = par.id_parque
LEFT JOIN tipo_vehiculos
ON mvpar.tipo_vehiculo = tipo_vehiculos.tipo_vehiculo
LEFT JOIN pvariables pvar
ON par.id_regimen = pvar.id_pv;


