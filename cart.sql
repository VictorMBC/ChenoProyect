-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2014 a las 20:51:59
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cart`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `Nis` int(11) NOT NULL DEFAULT '0',
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IdDispositivo` varchar(50) NOT NULL,
  `Pin` int(50) NOT NULL,
  `NoCel` varchar(10) NOT NULL,
  `Foto_Lectura` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Foto_Serie` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Foto_Recibo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Serie` varchar(10) NOT NULL,
  `Lec_Ant` int(10) NOT NULL,
  `Lect_Act` int(10) NOT NULL,
  `Consumo` int(10) NOT NULL,
  `Anomalia` varchar(200) NOT NULL,
  `Editar` varchar(100) NOT NULL,
  `latitud` varchar(15) NOT NULL,
  `longitud` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Nis`, `Fecha`, `IdDispositivo`, `Pin`, `NoCel`, `Foto_Lectura`, `Foto_Serie`, `Foto_Recibo`, `Serie`, `Lec_Ant`, `Lect_Act`, `Consumo`, `Anomalia`, `Editar`, `latitud`, `longitud`) VALUES
(0, '2014-12-05 23:05:10', '', 0, '', '', '', '', '', 0, 0, 0, '', '', '0', '0'),
(1, '2014-11-27 07:00:00', 'JAHSDKJAHSKJD', 1212, '6622187274', '4', '5', '6', '3827365283', 23, 23, 0, 'Medidor Frenado', '', '29.12', '-111'),
(2, '2014-11-30 07:00:00', 'JASJDKASJAJSHDK', 1334, '6622847459', '1.jpg', '2.jpg', '3.jpg', '8298273847', 111, 99, 0, 'Medidor volteado', '', '28.11', '-110');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `username`, `rol`, `password`) VALUES
(11, 'Victor', 'Bolaños', 'admin', 'Administrador', '21232f297a57a5a743894a0e4a801fc3'),
(23, 'test2', 'test2', 'test2', 'Lecturista', 'yolo2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
 ADD PRIMARY KEY (`Nis`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
