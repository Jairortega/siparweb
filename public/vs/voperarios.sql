			  
DROP VIEW `voperarios`;

create view `voperarios` as 
SELECT cc_operario, nom_operario, operarios.cc_user cc_user, 
       operarios.id_parque, des_parque, operarios.dir_operario dir_operario,
	   operarios.tel_operario tel_operario, operarios.cel_operario cel_operario,
       parqueaderos.cod_gr_parque cod_gr_parque, des_gr_parque, mail_operario,
	   operarios.cod_dc_operario cod_dc_operario, desc_ciudepto, bloqueo, 
	   sn.des_pv sino
FROM operarios
LEFT JOIN parqueaderos
ON (operarios.id_parque = parqueaderos.id_parque
   AND operarios.cc_user = parqueaderos.cc_user)
LEFT JOIN grupo_parqueos
ON (parqueaderos.cod_gr_parque = grupo_parqueos.cod_gr_parque
   AND parqueaderos.cc_user = grupo_parqueos.cc_user)
LEFT JOIN ciudad_depto cd
ON operarios.cod_dc_operario = cd.cod_dc
LEFT JOIN pvariables sn
ON (operarios.bloqueo = sn.id_pv
    AND sn.id_pv < 9);
			  