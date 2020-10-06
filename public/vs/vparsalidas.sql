
DROP VIEW `vparsalidas`;

create view `vparsalidas` as 
SELECT id_entrada, mpa.id_parque id_parque, des_parque,
       mpa.tipo_vehiculo tipo_vehiculo, des_tvehiculo, 
	   mpa.placa placa, fecha_ingreso, hora_ingreso, res.cc_cliente,
	   mpa.id_reserva id_reserva, res.fecha_reserva fecha_reserva, 
	   res.hora_reserva hora_reserva, mpa.email email, fecha_salida, 
	   hora_salida, num_minutos, vr_liquidado, vr_iva, 
	   mpa.forma_pago forma_pago, cc_user_e, cc_user_s
FROM mov_parqueos mpa
LEFT JOIN tipo_vehiculos
ON mpa.tipo_vehiculo = tipo_vehiculos.tipo_vehiculo
LEFT JOIN parqueaderos par
ON mpa.id_parque = par.id_parque
LEFT JOIN reservas res
ON mpa.id_reserva = res.id_reserva
WHERE mpa.vr_liquidado >= 0;

