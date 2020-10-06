
DROP VIEW `vservicios`;

create view `vservicios` as 
SELECT vta.cc_user cc_user, 
       vta.id_parque id_parque, des_parque, 
       cod_gr_parque, dir_parque,
	   tel_parque, latitud_parque, longitud_parque,
	   tipo_vehiculo, des_tvehiculo, cupo, tot_e,
       tot_s, tot_r, dis_cupo, und_parque, minhr,
       vr_parque, porc_iva, iva	   
FROM vtarifas vta
WHERE estado_parque = 0
AND vta.id_parque not in (select vsin.id_parque
                     FROM vsinservicios vsin)
					 
protected $table="vservicios";

    protected $fillable =['cc_user', 'id_parque', 'des_parque', 'cod_gr_parque', 
    'dir_parque', 'tel_parque', 'latiud_parque', 'longitud_parque', 'tipo_vehiculo',
    'des_tvehiculo', 'cupo', 'tot_e', 'tot_s', 'tot_r', 'dis_cupo', 'und_parque',
    'minhr', 'vr_parque', 'porc_iva', 'iva']; 
