-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2023 a las 23:56:17
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(6) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `clave` varchar(10) DEFAULT NULL,
  `mail` varchar(20) DEFAULT NULL,
  `localidad` varchar(20) DEFAULT NULL,
  `fecha_de_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `clave`, `mail`, `localidad`, `fecha_de_registro`) VALUES
(1, 'Esteban', 'Madou', 'sdadad123', 'dkantor0@example.com', 'Quilmes', '2023-10-04'),
(2, 'Sabrina', 'Lopez', '1245sd3', 'sabri@example.com', 'Pompeya', '2014-10-08'),
(3, 'Dario', 'Ximor', 'sdwww1', 'daro@example.com', 'CABA', '2019-10-09'),
(4, 'Oscar', 'Somop', 'sdadad123', 'oscar@example.com', 'Monserrat', '2018-10-10'),
(5, 'Pablo', 'Laprida', '23233333', 'pablo@example.com', 'Wilde', '2020-10-30'),
(6, 'william', 'apellido', '1234', 'william@gmail.com', 'paternal', '2023-10-08'),
(7, 'pepe', 'perez', '56565', 'pepe@gmail.com', 'Lanus', '2023-10-08'),
(8, 'hernan', 'perez', '6566', 'www@gmail.com', 'Moron', '2023-10-08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
