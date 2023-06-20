-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2023 a las 14:27:27
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_tareas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros_equipo`
--

CREATE TABLE `miembros_equipo` (
  `me_ID` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `miembros_equipo`
--

INSERT INTO `miembros_equipo` (`me_ID`, `Nombre`, `Rol`) VALUES
(1, 'John', 'Desarrollador'),
(2, 'Maria', 'Diseñadora'),
(3, 'Yessica', 'Tester'),
(4, 'Sara', 'Gerente'),
(5, 'Katherin', 'Analista'),
(6, 'Natalia', 'Analista'),
(7, 'Valeria', 'Analista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `pro_ID` int(11) NOT NULL,
  `Nombre_proyecto` varchar(50) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`pro_ID`, `Nombre_proyecto`, `Descripcion`) VALUES
(1, 'Proyecto A', 'Proyecto de desarrollo web'),
(2, 'Proyecto B', 'Proyecto de diseño de interfaz'),
(3, 'Proyecto C', 'Proyecto de pruebas de software'),
(4, 'Proyecto D', 'Proyecto de evaluacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `tar_ID` int(11) NOT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `pro_ID` int(11) DEFAULT NULL,
  `me_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`tar_ID`, `Descripcion`, `pro_ID`, `me_ID`) VALUES
(1, 'Desarrollar la página de inicio', 1, 1),
(2, 'Diseñar la interfaz de usuario', 2, 2),
(3, 'Realizar pruebas de funcionalidad', 3, 3),
(4, 'Crear plan de proyecto', 4, 4),
(5, 'Analizar requisitos del cliente', 1, 5),
(6, 'Brindar asesoramiento técnico', 2, 6),
(7, 'Requerimientos', 4, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1054398308, 'valegiraldo968@gmail.com', '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `miembros_equipo`
--
ALTER TABLE `miembros_equipo`
  ADD PRIMARY KEY (`me_ID`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`pro_ID`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`tar_ID`),
  ADD KEY `pro_ID` (`pro_ID`),
  ADD KEY `me_ID` (`me_ID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1054398309;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`pro_ID`) REFERENCES `proyectos` (`pro_ID`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`me_ID`) REFERENCES `miembros_equipo` (`me_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
