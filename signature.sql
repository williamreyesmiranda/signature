-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2021 a las 14:05:04
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `signature`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nombre_empleado` varchar(50) NOT NULL,
  `cargo_empleado` varchar(50) DEFAULT NULL,
  `correo_empleado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `nombre_empresa` varchar(200) NOT NULL,
  `nit_empresa` varchar(50) NOT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE `person` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Name` varchar(85) CHARACTER SET utf8 NOT NULL,
  `Signature` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`ID`, `Name`, `Signature`) VALUES
(11, 'gfgf', '{\"lines\":[[[26,19.52],[26,19.52],[25,23.52],[22,31.52],[20,44.52],[17,61.52],[17,80.52],[17,85.52],[17,86.52],[20,88.52],[21,89.52],[26,90.52],[30,90.52],[40,84.52],[51,73.52],[55,66.52],[58,55.52],[60,43.52],[60,36.52],[60,40.52],[60,43.52],[60,55.52],[60,68.52],[60,81.52],[60,93.52],[61,95.52],[62,98.52],[63,98.52],[68,93.52],[73,91.52],[82,84.52],[87,78.52],[88,74.52],[91,63.52],[92,51.52],[93,40.52],[93,30.52],[93,25.52],[93,24.52],[93,23.52]]]}'),
(12, 'fgff', '{\"lines\":[[[26,19.52],[26,19.52],[25,23.52],[22,31.52],[20,44.52],[17,61.52],[17,80.52],[17,85.52],[17,86.52],[20,88.52],[21,89.52],[26,90.52],[30,90.52],[40,84.52],[51,73.52],[55,66.52],[58,55.52],[60,43.52],[60,36.52],[60,40.52],[60,43.52],[60,55.52],[60,68.52],[60,81.52],[60,93.52],[61,95.52],[62,98.52],[63,98.52],[68,93.52],[73,91.52],[82,84.52],[87,78.52],[88,74.52],[91,63.52],[92,51.52],[93,40.52],[93,30.52],[93,25.52],[93,24.52],[93,23.52]],[[111,58.52],[112,60.52],[112,66.52],[112,71.52],[112,78.52],[112,84.52],[112,86.52],[112,89.52],[112,91.52],[112,94.52],[113,96.52],[113,98.52],[113,99.52]]]}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(200) NOT NULL,
  `usuario_sesion` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `correo_usuario` varchar(50) NOT NULL,
  `firma_usuario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `usuario_sesion`, `clave`, `correo_usuario`, `firma_usuario`) VALUES
(1, 'Administrador', 'admin', '1234', '', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `empresa` (`empresa`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
