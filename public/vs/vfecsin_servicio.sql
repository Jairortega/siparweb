
drop view `vfecsin_servicio`;

CREATE VIEW `vfecsin_servicio`  AS  
select  fs.cc_user, fs.id_parque id_parque, des_parque, pa.cod_gr_parque cod_gr_parque, 
        des_gr_parque, fecha_parque, fs.created_at created_at, fs.updated_at updated_at, 
		hora_ini, hora_fin
from `fecsin_servicio` `fs`
left join `parqueaderos` `pa` 
on (`pa`.`id_parque` = `fs`.`id_parque`
    and `pa`.`cc_user` = `fs`.`cc_user`)
left join `grupo_parqueos` `gp`
on (`gp`.`cod_gr_parque` = `pa`.`cod_gr_parque`
    and `gp`.`cc_user` = `pa`.`cc_user`)
order by cod_gr_parque;

