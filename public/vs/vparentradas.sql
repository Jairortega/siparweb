
DROP VIEW `vparentradas`;

create view `vparentradas` as 
SELECT id_entrada, mpa.id_parque id_parque, des_parque,
       mpa.tipo_vehiculo tipo_vehiculo, des_tvehiculo, 
	   placa, id_reserva, fecha_reserva, hora_reserva, 
	   email, fecha_ingreso, hora_ingreso, cc_user_e
FROM mov_parqueos mpa
LEFT JOIN tipo_vehiculos
ON mpa.tipo_vehiculo = tipo_vehiculos.tipo_vehiculo
LEFT JOIN parqueaderos par
ON mpa.id_parque = par.id_parque
WHERE mpa.vr_liquidado = 0
