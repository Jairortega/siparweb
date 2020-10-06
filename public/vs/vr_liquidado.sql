DROP VIEW `vliquidado`;

create view `vliquidado` as 
SELECT id_entrada, mvpar.id_parque, des_parque,
       mvpar.tipo_vehiculo tipo_vehiculo, des_tvehiculo, placa, forma_pago, 
	   id_reserva, `fecha_reserva`, `hora_reserva`,
	   `fecha_ingreso`, `hora_ingreso`, curdate() fecha_salida, curtime() hora_salida,
	   (case when (ifnull(`id_reserva`,0) > 0) 
       then (hour((timediff(sysdate(), concat(`fecha_reserva`, ' ', `hora_reserva`)))) * 60 +  
            minute((timediff(sysdate(), concat(`fecha_reserva`, ' ', `hora_reserva`))))) 
       else (hour((timediff(sysdate(), concat(`fecha_ingreso`, ' ', `hora_ingreso`)))) * 60 +  
            minute((timediff(sysdate(), concat(`fecha_ingreso`, ' ', `hora_ingreso`)))))			
       end) AS `num_minutos`,
	   (case when (ifnull(`id_reserva`,0) > 0) 
       then (hour((timediff(sysdate(), concat(`fecha_reserva`, ' ', `hora_reserva`)))) * 60 +  
            minute((timediff(sysdate(), concat(`fecha_reserva`, ' ', `hora_reserva`))))) * vr_minuto
       else (hour((timediff(sysdate(), concat(`fecha_ingreso`, ' ', `hora_ingreso`)))) * 60 +  
            minute((timediff(sysdate(), concat(`fecha_ingreso`, ' ', `hora_ingreso`))))) * vr_minuto	 
       end) AS `vr_liquidado`, 
	   round(((case when (ifnull(`id_reserva`,0) > 0) 
       then (hour((timediff(sysdate(), concat(`fecha_reserva`, ' ', `hora_reserva`)))) * 60 +  
            minute((timediff(sysdate(), concat(`fecha_reserva`, ' ', `hora_reserva`))))) * vr_minuto
       else (hour((timediff(sysdate(), concat(`fecha_ingreso`, ' ', `hora_ingreso`)))) * 60 +  
            minute((timediff(sysdate(), concat(`fecha_ingreso`, ' ', `hora_ingreso`))))) * vr_minuto	 
       end)* (porc_iva / 100)),0) AS `vr_iva`, 
	   cupo, tot_e, tot_s, tot_r, (cupo + tot_s - tot_e - tot_r) dis_cupo,
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
ON par.id_regimen = pvar.id_pv

	