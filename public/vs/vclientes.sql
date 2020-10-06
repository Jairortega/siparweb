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


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parqueos`
--

-- --------------------------------------------------------

--
-- Structure for view `vclientes`
--
drop view `vclientes`;

CREATE VIEW `vclientes`  AS  
select `cli`.`id` AS `id`,
`cli`.`cc_user` AS `cc_user`,
`cli`.`name` AS `name`,
`cli`.`id_perfil` AS `id_perfil`,
`cli`.`tel_user` AS `tel_user`,
`cli`.`cel_user` AS `cel_user`,
`cli`.`cod_dc_user` AS `cod_dc_user`,
`cd`.`desc_ciudepto` AS `desc_ciudepto`,
`cli`.`email` AS `email`,
`cli`.`password` AS `password`,
`cli`.`bloqueo` AS `bloqueo`,
`cli`.`remember_token` AS `remember_token`,
`cli`.`created_at` AS `created_at`,
`cli`.`updated_at` AS `updated_at`
from (`users` `cli` join `ciudad_depto` `cd`) where (`cd`.`cod_dc` = `cli`.`cod_dc_user`) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
