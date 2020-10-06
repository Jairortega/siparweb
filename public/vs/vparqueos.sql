

drop view `vparqueos`;

CREATE VIEW `vparqueos`  AS  
select pa.cod_gr_parque cod_gr_parque, des_gr_parque, id_parque, pa.cc_user cc_user, 
       des_parque, nit_parque, pa.id_regimen id_regimen, des_pv dregimen, dir_parque, tel_parque, 
	   mail_parque, foto_parque, cod_dc_parque, desc_ciudepto, latitud_parque, longitud_parque,  
	   estado_parque
from `parqueaderos` `pa` 
left join `grupo_parqueos` `gp`
on (`pa`.`cod_gr_parque` = `gp`.`cod_gr_parque`
    and `pa`.`cc_user` = `gp`.`cc_user`)
left join `ciudad_depto` `cd`
on `pa`.`cod_dc_parque` = `cd`.`cod_dc`
left join `pvariables` `pvar`
on `pa`.`id_regimen` = `pvar`.`id_pv`;
