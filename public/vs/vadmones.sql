
drop view `vadmones`;

CREATE VIEW `vadmones`  AS  
select  cc_admon, nom_admon, dir_admon, tel_admon, cel_admon, mail_admon, 
        ad.cod_dc_admon cod_dc_admon, desc_ciudepto, cod_bco_admon,
		ncuenta_admon, tcuenta_admon, bloqueo
from `administradores` `ad` 
left join `ciudad_depto` `cd`
on `ad`.`cod_dc_admon` = `cd`.`cod_dc`;

