
DROP VIEW `vsinservicios`;

create view `vsinservicios` as 
SELECT par.cc_user cc_user, par.id_parque id_parque,
       cod_gr_parque, des_parque, fecha_parque, hora_ini, hora_fin
FROM parqueaderos par, fecsin_servicio fss
WHERE par.id_parque = fss.id_parque
AND fecha_parque = curdate()
AND (fss.hora_ini <= curtime() 
AND fss.hora_fin >= curtime()) 
