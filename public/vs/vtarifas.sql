-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2019 at 04:11 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parqueos`
--

-- --------------------------------------------------------

--
-- Structure for view `vtarifas`
--

CREATE VIEW `vtarifas`  AS  
select `tarifas`.`cc_user` AS `cc_user`,
`tarifas`.`id_parque` AS `id_parque`,
`parqueaderos`.`des_parque` AS `des_parque`,
`parqueaderos`.`cod_gr_parque` AS `cod_gr_parque`,
`grupo_parqueos`.`des_gr_parque` AS `des_gr_parque`,
`tarifas`.`tipo_vehiculo` AS `tipo_vehiculo`,
`tipo_vehiculos`.`des_tvehiculo` AS `des_tvehiculo`,
`tarifas`.`cupo` AS `cupo`,
`tarifas`.`tot_e` AS `tot_e`,
`tarifas`.`tot_s` AS `tot_s`,
`tarifas`.`tot_r` AS `tot_r`,
(((`tarifas`.`cupo` + `tarifas`.`tot_s`) - `tarifas`.`tot_e`) - `tarifas`.`tot_r`) AS `dis_cupo`,
`tarifas`.`und_parque` AS `und_parque`,
`tt`.`des_pv` AS `minhr`,
`tarifas`.`vr_parque` AS `vr_parque`,
`tarifas`.`vr_minuto` AS `vr_minuto`,
`tarifas`.`porc_iva` AS `porc_iva`,
`tarifas`.`iva` AS `iva`,
`sn`.`des_pv` AS `sino`,
`parqueaderos`.`dir_parque` AS `dir_parque`,
`parqueaderos`.`tel_parque` AS `tel_parque`,
`parqueaderos`.`latitud_parque` AS `latitud_parque`,
`parqueaderos`.`longitud_parque` AS `longitud_parque`,
`parqueaderos`.`estado_parque` AS `estado_parque` 
from (((((`tarifas` 
left join `parqueaderos` on(((`tarifas`.`id_parque` = `parqueaderos`.`id_parque`) 
and (`tarifas`.`cc_user` = `parqueaderos`.`cc_user`)))) 
left join `grupo_parqueos` on(((`parqueaderos`.`cod_gr_parque` = `grupo_parqueos`.`cod_gr_parque`) 
and (`parqueaderos`.`cc_user` = `grupo_parqueos`.`cc_user`)))) 
left join `tipo_vehiculos` on((`tarifas`.`tipo_vehiculo` = `tipo_vehiculos`.`tipo_vehiculo`))) 
left join `pvariables` `sn` on(((`tarifas`.`iva` = `sn`.`id_pv`) 
and (`sn`.`id_pv` < 9)))) 
left join `pvariables` `tt` 
on(((`tarifas`.`und_parque` = `tt`.`id_pv`) 
and (`tt`.`id_pv` > 9)))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
