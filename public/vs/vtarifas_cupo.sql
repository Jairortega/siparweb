
DROP VIEW vtarifas_cupo;

create view vtarifas_cupo as 
select pa.id_parque id_parque, pa.cc_user cc_user, cod_gr_parque,
  des_parque, nit_parque, id_regimen, 
  dir_parque, tel_parque, mail_parque, 
  foto_parque, cod_dc_parque, latitud_parque, 
  longitud_parque, estado_parque, 
  IFNULL(car.vr_minuto,0) minutocar,
  IFNULL(moto.vr_minuto,0) minutomoto,
  IFNULL(bici.vr_minuto,0) minutobici,
  IFNULL((car.cupo + car.tot_s - car.tot_e - car.tot_r),0) dis_cupocar,
  IFNULL((moto.cupo + moto.tot_s - moto.tot_e - moto.tot_r),0) dis_cupomoto,
  IFNULL((bici.cupo + bici.tot_s - bici.tot_e - bici.tot_r),0) dis_cupobici
FROM parqueaderos pa
LEFT JOIN tarifas car
ON (pa.cc_user = car.cc_user
   AND pa.id_parque = car.id_parque
   AND car.tipo_vehiculo = 1)
LEFT JOIN tarifas moto
ON (pa.cc_user = moto.cc_user
   AND pa.id_parque = moto.id_parque
   AND moto.tipo_vehiculo = 2)
LEFT JOIN tarifas bici
ON (pa.cc_user = bici.cc_user
   AND pa.id_parque = bici.id_parque
   AND bici.tipo_vehiculo = 3) 
WHERE pa.estado_parque = 0;   


$query->whereBetween('lat', [$lat-0.08, $lat+0.08]) AND 

whereBetween('lng', [$lng-0.08, $lng+0.08])

