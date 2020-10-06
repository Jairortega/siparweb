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
drop view `vreservas`;

CREATE VIEW `vreservas`  AS  
select `re`.`id_reserva` AS `id_reserva`,
`re`.`id_parque` AS `id_parque`,
`pa`.`des_parque` AS `des_parque`,
`pa`.`dir_parque` AS `dir_parque`,
`pa`.`tel_parque` AS `tel_parque`,
`pa`.`foto_parque` AS `foto_parque`,
`re`.`cc_cliente` AS `cc_cliente`,
`usu`.`name` AS `name`,
`usu`.`id_perfil` AS `id_perfil`,
`usu`.`email` AS `email`,
`re`.`tipo_vehiculo` AS `tipo_vehiculo`,
`tpv`.`des_tvehiculo` AS `des_tvehiculo`,
`re`.`placa` AS `placa`,
`re`.`fecha_reserva` AS `fecha_reserva`,
`re`.`hora_reserva` AS `hora_reserva`,
`re`.`estado_reserva` AS `estado_reserva`,
`pva`.`des_pv` AS `des_ereserva`,
`re`.`latitud_clien` AS `latitud_clien`,
`re`.`longitud_clien` AS `longitud_clien`,
`re`.`latitud_origen` AS `latitud_origen`,
`re`.`longitud_origen` AS `longitud_origen`,
`re`.`latitud_destino` AS `latitud_destino`,
`re`.`longitud_destino` AS `longitud_destino`,
`re`.`latitud_parque` AS `latitud_parque`,
`re`.`longitud_parque` AS `longitud_parque`,
`re`.`fecha_sys` AS `fecha_sys`,
`re`.`hora_sys` AS `hora_sys`,
`re`.`created_at` AS `created_at`,
`re`.`updated_at` AS `updated_at`
from `reservas` `re` 
left join `parqueaderos` `pa`
on re.id_parque = pa.id_parque
left join `pvariables` `pva`
on re.estado_reserva = pva.id_pv
left join `tipo_vehiculos` `tpv`
on re.tipo_vehiculo = tpv.tipo_vehiculo
left join `users` `usu`
on re.cc_cliente = usu.cc_user;
COMMIT;

/*!40101 SET CHARACTER_SET_reENT=@OLD_CHARACTER_SET_reENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
