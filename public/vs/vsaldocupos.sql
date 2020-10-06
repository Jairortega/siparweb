-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2018 at 04:55 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_reENT=@@CHARACTER_SET_reENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parqueos`
--

-- --------------------------------------------------------

--
-- Structure for view `vreservas`
--
drop view `vsaldocupos`;

CREATE VIEW `vsaldocupos`  AS  
select `ta`.`id_parque` AS `id_parque`,
`pa`.`des_parque` AS `des_parque`,
`pa`.`dir_parque` AS `dir_parque`,
`pa`.`mail_parque` AS `mail_parque`,
`pa`.`latitud_parque` AS `latitud_parque`,
`pa`.`longitud_parque` AS `longitud_parque`,
`ta`.`tipo_vehiculo` AS `tipo_vehiculo`,
`tpv`.`des_tvehiculo` AS `des_tvehiculo`,
`ta`.`und_parque` AS `und_parque`,
`ta`.`vr_parque` AS `vr_parque`,
`ta`.`cupo` AS `cupo`,
`ta`.`porc_iva` AS `porc_iva`,
`ta`.`iva` AS `iva`,
(`ta`.`cupo` - `ep`.`tot_e` + `sp`.`tot_s`) dis_cupo
from `tarifas` `ta` 
left join `parqueaderos` `pa`
on ta.id_parque = pa.id_parque
left join `tipo_vehiculos` `tpv`
on ta.tipo_vehiculo = tpv.tipo_vehiculo
left join `ventradas` `ep`
on (ta.id_parque = ep.id_parque
    and ta.tipo_vehiculo = ep.tipo_vehiculo)
left join `vsalidas` `sp`
on (ta.id_parque = sp.id_parque
    and ta.tipo_vehiculo = sp.tipo_vehiculo);
	
COMMIT;

/*!40101 SET CHARACTER_SET_reENT=@OLD_CHARACTER_SET_reENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
