-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql203.infinityfree.com
-- Tiempo de generación: 13-06-2025 a las 11:30:35
-- Versión del servidor: 10.6.19-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `if0_38644371_dieta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alergias`
--

CREATE TABLE `Alergias` (
  `id_alergia` varchar(5) NOT NULL,
  `nombre_alergia` varchar(45) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Alergias`
--

INSERT INTO `Alergias` (`id_alergia`, `nombre_alergia`, `id_usuario`, `fechaCreacion`, `fechaModificacion`) VALUES
('AL001', 'Contiene Gluten', 0, '2025-05-21 00:00:00', '2025-05-21 00:00:00'),
('AL002', 'Crustaceos', 0, '2025-05-21 00:00:00', '2025-05-21 00:00:00'),
('AL003', 'Huevos', 0, '2025-05-21 00:00:00', '2025-05-21 00:00:00'),
('AL004', 'Pescados', 0, '2025-05-21 00:00:00', '2025-05-21 00:00:00'),
('AL005', 'Cacahuetes', 0, '2025-05-21 00:00:00', '2025-05-21 00:00:00'),
('AL006', 'Soja', 0, '2025-05-21 00:00:00', '2025-05-21 00:00:00'),
('AL007', 'Lacteos', 0, '2025-05-21 00:00:00', '2025-05-21 00:00:00'),
('AL008', 'Frutos de Cascara', 0, '2025-05-21 00:00:00', '2025-05-21 00:00:00'),
('AL009', 'Apio', 0, '2025-05-21 00:00:00', '2025-05-21 00:00:00'),
('AL010', 'Mostaza', 0, '2025-05-21 00:00:00', '2025-05-21 00:00:00'),
('AL011', 'Granos de Sesamo', 0, '2025-06-05 00:00:00', '2025-06-05 00:00:00'),
('AL012', 'Dioxido de Azufre y Sulfitos', 0, '2025-06-05 00:00:00', '2025-06-05 00:00:00'),
('AL013', 'Moluscos', 0, '2025-06-05 00:00:00', '2025-06-05 00:00:00'),
('AL014', 'Altramuces', 0, '2025-06-05 00:00:00', '2025-06-05 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alergias_Alimentos`
--

CREATE TABLE `Alergias_Alimentos` (
  `id_alergia` varchar(5) NOT NULL,
  `id_alimentos` varchar(5) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alergias_Recetas`
--

CREATE TABLE `Alergias_Recetas` (
  `id_alergia` varchar(5) NOT NULL,
  `id_receta` varchar(5) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alimentos`
--

CREATE TABLE `Alimentos` (
  `id_alimentos` varchar(5) NOT NULL,
  `nombreAlimento` varchar(100) NOT NULL,
  `PC` float NOT NULL,
  `e_100` float NOT NULL,
  `prot_100` float NOT NULL,
  `grasa_100` float NOT NULL,
  `ags_100` float NOT NULL,
  `agmi_100` float NOT NULL,
  `agpi_100` float NOT NULL,
  `col_100` float NOT NULL,
  `hc_100` float NOT NULL,
  `fibra_100` float NOT NULL,
  `vit_c_100` float NOT NULL,
  `vit_b6_100` float NOT NULL,
  `vit_e_100` float NOT NULL,
  `fe_100` float NOT NULL,
  `na_100` float NOT NULL,
  `ca_100` float NOT NULL,
  `k_100` float NOT NULL,
  `vit_d_100` float DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `fechaModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Alimentos`
--

INSERT INTO `Alimentos` (`id_alimentos`, `nombreAlimento`, `PC`, `e_100`, `prot_100`, `grasa_100`, `ags_100`, `agmi_100`, `agpi_100`, `col_100`, `hc_100`, `fibra_100`, `vit_c_100`, `vit_b6_100`, `vit_e_100`, `fe_100`, `na_100`, `ca_100`, `k_100`, `vit_d_100`, `id_usuario`, `fechaCreacion`, `fechaModificacion`) VALUES
('A0001', 'Leche Entera de Vaca', 1, 62, 3.2, 3.6, 2.2, 1.1, 0.11, 14, 4.6, 0, 1, 0.02, 0.07, 0.1, 45, 119, 148, NULL, 0, NULL, NULL),
('A0002', 'Yogur Natural', 1, 62, 3.47, 3.27, 2.1, 0.89, 0.09, 13, 4.66, 0, 0.5, 0.03, 0.09, 0.05, 46, 121, 155, NULL, 0, NULL, NULL),
('A0003', 'Nueces', 1, 688, 14, 68.5, 5.6, 12.4, 47.5, 0, 4, 5.2, 2.6, 0.87, 6.2, 5, 3, 183, 903, NULL, 0, NULL, NULL),
('A0004', 'Almendras', 1, 575, 20, 53.5, 4.2, 36.6, 10, 0, 3.5, 14.3, 0, 0.1, 20, 6.3, 12, 270, 690, NULL, 0, NULL, NULL),
('A0005', 'Melocoton', 0.88, 37, 0.6, 0.1, 0, 0, 0, 0, 9, 2.3, 31, 0.02, 0.5, 0.4, 1, 7, 170, NULL, 0, NULL, NULL),
('A0006', 'Platano', 0.66, 85, 2.2, 0.27, 0.12, 0, 0.09, 0, 20.8, 2.5, 11.5, 0.37, 0.23, 0.59, 1.5, 7.3, 350, NULL, 0, NULL, NULL),
('A0007', 'Aceite de Oliva', 1, 900, 0, 100, 13.5, 73.7, 8.4, 0, 0, 0, 0, 0, 12.4, 0.38, 0, 0, 0, NULL, 0, NULL, NULL),
('A0008', 'Zumo de Naranja', 1, 41, 0.6, 0.1, 0, 0, 0, 0, 10, 0.1, 40, 0.04, 0.09, 0.2, 1, 15.5, 166, NULL, 0, NULL, NULL),
('A0009', 'Pan de Trigo (sin gluten)', 1, 244, 4.1, 7.7, 0, 0, 0, 0, 34.1, 11.1, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL),
('A0010', 'Mermelada de Fresa', 1, 222, 0.5, 0, 0, 0, 0, 0, 58.65, 0, 20.6, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL),
('A0011', 'Pera', 0.88, 48, 0.4, 0.3, 0.04, 0.05, 0.11, 0, 11.7, 22.2, 5.2, 0.02, 0.89, 0.3, 3, 9.6, 130, NULL, 0, NULL, NULL),
('A0012', 'Lentejas', 1, 306, 23, 0.996, 0.13, 0.16, 0.44, 0, 54.8, 11.2, 3.4, 0.7, 0.33, 6.2, 40, 126, 1160, NULL, 0, NULL, NULL),
('A0013', 'Arroz Integral', 1, 332, 8, 2.8, 0.7, 0.7, 1, 0, 73.41, 2.8, 0, 0.64, 0.6, 2, 6, 20, 200, NULL, 0, NULL, NULL),
('A0014', 'Patata', 0.9, 72, 2.5, 0.16, 0.03, 0.02, 0.09, 0, 16.1, 1.8, 18, 0.25, 0.06, 0.78, 10, 7.2, 570, NULL, 0, NULL, NULL),
('A0015', 'Zanahoria', 0.89, 33, 0.9, 0.19, 0.03, 0.01, 0.01, 0, 7.3, 2.9, 7, 0.16, 0.5, 0.3, 35, 27, 286, NULL, 0, NULL, NULL),
('A0016', 'Cebolla', 0.9, 56, 1.16, 0.16, 0.03, 0.02, 0.06, 0, 7.9, 1.8, 6.4, 0.12, 0.13, 0.22, 3, 20, 157, NULL, 0, NULL, NULL),
('A0017', 'Tomate', 0.94, 18, 1, 0.11, 0, 0, 0.1, 0, 3.5, 1.4, 26.6, 0.13, 0.56, 0.7, 6, 10.6, 250, NULL, 0, NULL, NULL),
('A0018', 'Ajo', 0.76, 114, 5.3, 0.23, 0.05, 0.03, 0.1, 0, 24.3, 1.2, 14, 0.32, 0.1, 1.2, 20, 17.8, 530, NULL, 0, NULL, NULL),
('A0019', 'Naranja', 0.73, 38, 0.8, 0.3, 0.035, 0.055, 0.06, 0, 8.6, 2.3, 50.6, 0.06, 0.21, 0.49, 3, 41, 200, NULL, 0, NULL, NULL),
('A0020', 'Crema Catalana', 1, 173, 3.6, 9.1, 0, 0, 0, 0, 20.5, 0, 0, 0.15, 0, 0.95, 35, 35, 124, NULL, 0, NULL, NULL),
('A0021', 'Kefir', 1, 63, 3.3, 3.5, 0, 0, 0, 0, 4.8, 0, 0, 0, 0, 0.13, 46, 0, 160, NULL, 0, NULL, NULL),
('A0022', 'Chia', 1, 517, 17, 32.9, 0, 0, 0, 0, 38.3, 0, 0, 0.2, 0, 6.04, 16, 595, 642, NULL, 0, NULL, NULL),
('A0023', 'Arandanos', 0.98, 30, 0.6, 0.2, 0, 0, 0, 0, 6.9, 1.8, 17, 0.05, 0, 0.5, 3, 12, 88, NULL, 0, NULL, NULL),
('A0024', 'Zumo de Piña', 1, 48, 0.4, 0.1, 0, 0, 0, 0, 12.08, 0.1, 10, 0.1, 0.03, 0.7, 1, 12, 140, NULL, 0, NULL, NULL),
('A0025', 'Boquerones', 0.79, 138, 20.6, 6, 2.3, 0.81, 2.3, 69, 0.5, 0, 0, 1.1, 0.02, 1, 104, 28.2, 383, NULL, 0, NULL, NULL),
('A0026', 'Vinagre', 1, 4, 0.4, 0, 0, 0, 0, 0, 0.6, 0, 0, 0, 0, 0.5, 20, 15, 90, NULL, 0, NULL, NULL),
('A0027', 'Lechuga', 0.6, 14, 1.5, 0.3, 0.04, 0.01, 0.16, 0, 1.4, 1.5, 12.2, 0.06, 0.52, 1, 10, 34.7, 240, NULL, 0, NULL, NULL),
('A0028', 'Maiz', 1, 311, 8.54, 3.8, 0.57, 1.03, 1.5, 0, 64.66, 9.2, 0, 0.4, 1.95, 4.3, 6, 15, 330, NULL, 0, NULL, NULL),
('A0029', 'Manzana Roja', 0.9, 46, 0.3, 0.1, 0.05, 0.07, 0.03, 0, 11.7, 1.7, 3, 0.04, 0.53, 0.1, 1, 4, 99, NULL, 0, NULL, NULL),
('A0030', 'Muslo de Pollo', 0.38, 109, 19.5, 3.4, 1.4, 1.4, 0.49, 68.3, 0, 0, 1.7, 0.4, 0.1, 1.5, 0, 12.4, 0, NULL, 0, NULL, NULL),
('A0031', 'Limon', 0.64, 39, 0.7, 0.3, 0.04, 0.01, 0.09, 0, 9, 1, 50, 0.11, 0.5, 0.4, 3, 12, 149, NULL, 0, NULL, NULL),
('A0032', 'Vino Blanco', 1, 62, 0, 0, 0, 0, 0, 0, 0.2, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL),
('A0033', 'Mandarina', 0.72, 39, 0.8, 0.19, 0.02, 0.03, 0.04, 0, 9, 1.9, 35, 0.07, 0.22, 0.3, 2, 36, 185, NULL, 0, NULL, NULL),
('A0034', 'prueba', 8, 1, 34, 4, 56, 76, 7, 5, 65, 7, 6, 4, 4, 6, 7, 4, 7, 7, 1, '2025-05-08 12:25:14', '2025-05-08 12:25:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alimentos_Recetas`
--

CREATE TABLE `Alimentos_Recetas` (
  `id_alimentos` varchar(5) NOT NULL,
  `id_receta` varchar(5) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL,
  `pesoBruto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Alimentos_Recetas`
--

INSERT INTO `Alimentos_Recetas` (`id_alimentos`, `id_receta`, `id_usuario`, `fechaCreacion`, `fechaModificacion`, `pesoBruto`) VALUES
('A0001', 'A0001', 0, '2025-05-30 01:54:27', '2025-05-30 01:54:27', 5),
('A0001', 'A0002', 0, '2025-05-30 03:12:36', '2025-05-30 03:12:36', 45),
('A0001', 'A0003', 0, '2025-06-06 03:47:22', '2025-06-06 03:47:22', 50),
('A0002', 'A0001', 0, '2025-05-30 01:54:27', '2025-05-30 01:54:27', 5),
('A0002', 'A0002', 0, '2025-05-30 03:12:36', '2025-05-30 03:12:36', 5),
('A0005', 'A0001', 0, '2025-05-30 01:54:27', '2025-05-30 01:54:27', 5),
('A0005', 'A0002', 0, '2025-05-30 03:12:36', '2025-05-30 03:12:36', 5),
('A0006', 'A0002', 0, '2025-05-30 03:12:36', '2025-05-30 03:12:36', 100),
('A0006', 'A0003', 0, '2025-06-06 03:47:22', '2025-06-06 03:47:22', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Clientes`
--

CREATE TABLE `Clientes` (
  `dni_cliente` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `edad` int(3) NOT NULL,
  `descripcionCaso` varchar(512) NOT NULL,
  `caracteristicasMenu` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Clientes`
--

INSERT INTO `Clientes` (`dni_cliente`, `nombre`, `apellido`, `edad`, `descripcionCaso`, `caracteristicasMenu`) VALUES
('12345678', 'Paco', 'Pica', 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Clientes_Alergias`
--

CREATE TABLE `Clientes_Alergias` (
  `dni_cliente` varchar(9) NOT NULL,
  `id_alergia` varchar(5) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Recetas`
--

CREATE TABLE `Recetas` (
  `id_receta` varchar(5) NOT NULL,
  `nombre_receta` varchar(65) NOT NULL,
  `desc_receta` varchar(150) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Recetas`
--

INSERT INTO `Recetas` (`id_receta`, `nombre_receta`, `desc_receta`, `id_usuario`, `fechaCreacion`, `fechaModificacion`) VALUES
('A0001', 'a', 'aaaa', 0, '2025-05-30 01:54:27', '2025-05-30 01:54:27'),
('A0002', '', '', 0, '2025-05-30 03:12:36', '2025-05-30 03:12:36'),
('A0003', 'receta1', 'receta1', 0, '2025-06-06 03:47:22', '2025-06-06 03:47:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Recetas_Semana`
--

CREATE TABLE `Recetas_Semana` (
  `id_registro` int(32) NOT NULL,
  `dia` datetime NOT NULL,
  `diaSemana` enum('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO') NOT NULL,
  `momentoDia` enum('DESAYUNO','ALMUERZO','COMIDA','MERIENDA','CENA','SUPLEMENTO') NOT NULL,
  `id_receta` varchar(5) DEFAULT NULL,
  `dni_cliente` varchar(9) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Recetas_Semana`
--

INSERT INTO `Recetas_Semana` (`id_registro`, `dia`, `diaSemana`, `momentoDia`, `id_receta`, `dni_cliente`, `id_usuario`, `fechaCreacion`, `fechaModificacion`) VALUES
(1, '2025-06-09 00:00:00', 'LUNES', 'DESAYUNO', 'A0003', '12345678', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(25) NOT NULL,
  `administrador` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id_usuario`, `nombre`, `apellidos`, `email`, `contrasena`, `administrador`) VALUES
(0, 'comun', 'comun', 'comun@comun.com', 'aaa123', 0),
(1, 'testAlumno', 'ape', 'alumno@test.com', 'alumno', 1),
(2, 'Maria Isabel', 'Martin', 'mimartin1@educa.madrid.org', 'MaribelMartin', 1),
(3, 'Asier', 'Marfagon', 'adsier@gmail.es', 'Asd123$%', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alergias`
--
ALTER TABLE `Alergias`
  ADD PRIMARY KEY (`id_alergia`,`id_usuario`),
  ADD KEY `fk_idUsuario_Alergias_idx` (`id_usuario`);

--
-- Indices de la tabla `Alergias_Alimentos`
--
ALTER TABLE `Alergias_Alimentos`
  ADD PRIMARY KEY (`id_alergia`,`id_usuario`,`id_alimentos`),
  ADD KEY `fk_Alergias_has_Alimentos_Alimentos1_idx` (`id_alimentos`),
  ADD KEY `fk_Alergias_has_Alimentos_Alergias1_idx` (`id_alergia`),
  ADD KEY `fk_idUsuario_Alergias_Alimentos_idx` (`id_usuario`);

--
-- Indices de la tabla `Alergias_Recetas`
--
ALTER TABLE `Alergias_Recetas`
  ADD PRIMARY KEY (`id_alergia`,`id_receta`,`id_usuario`),
  ADD KEY `fk_Alergias_Alergias_Recetas` (`id_alergia`),
  ADD KEY `fk_Recetas_Alergias_Recetas` (`id_receta`),
  ADD KEY `fk_Usuarios_Alergias_Recetas` (`id_usuario`);

--
-- Indices de la tabla `Alimentos`
--
ALTER TABLE `Alimentos`
  ADD PRIMARY KEY (`id_alimentos`,`id_usuario`),
  ADD KEY `fk_idUsuario_Alimentos_idx` (`id_usuario`);

--
-- Indices de la tabla `Alimentos_Recetas`
--
ALTER TABLE `Alimentos_Recetas`
  ADD PRIMARY KEY (`id_alimentos`,`id_receta`,`id_usuario`),
  ADD KEY `fk_Alimentos_has_Recetas_Recetas1_idx` (`id_receta`),
  ADD KEY `fk_Alimentos_has_Recetas_Alimentos1_idx` (`id_alimentos`),
  ADD KEY `fk_idUsuario_Alimentos_Recetas_idx` (`id_usuario`);

--
-- Indices de la tabla `Clientes`
--
ALTER TABLE `Clientes`
  ADD PRIMARY KEY (`dni_cliente`);

--
-- Indices de la tabla `Clientes_Alergias`
--
ALTER TABLE `Clientes_Alergias`
  ADD PRIMARY KEY (`dni_cliente`),
  ADD KEY `fk_Clientes_has_Alergias_Alergias1_idx` (`id_alergia`),
  ADD KEY `fk_idUsuario_Clientes_Alergias_idx` (`id_usuario`),
  ADD KEY `fk_Clientes_has_Alergias_Clientes_idx` (`dni_cliente`);

--
-- Indices de la tabla `Recetas`
--
ALTER TABLE `Recetas`
  ADD PRIMARY KEY (`id_receta`,`id_usuario`),
  ADD KEY `fk_idUsuario_Recetas_idx` (`id_usuario`);

--
-- Indices de la tabla `Recetas_Semana`
--
ALTER TABLE `Recetas_Semana`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `fk_Recetas_Semana_Recetas1_idx` (`id_receta`),
  ADD KEY `fk_idUsuario_Recetas_Semana_idx` (`id_usuario`),
  ADD KEY `fk_Recetas_Semana_Clientes1_idx` (`dni_cliente`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Recetas_Semana`
--
ALTER TABLE `Recetas_Semana`
  MODIFY `id_registro` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Alergias`
--
ALTER TABLE `Alergias`
  ADD CONSTRAINT `fk_idUsuario_Alergias` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Alergias_Alimentos`
--
ALTER TABLE `Alergias_Alimentos`
  ADD CONSTRAINT `fk_Alergias_has_Alimentos_Alergias1` FOREIGN KEY (`id_alergia`) REFERENCES `Alergias` (`id_alergia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Alergias_has_Alimentos_Alimentos1` FOREIGN KEY (`id_alimentos`) REFERENCES `Alimentos` (`id_alimentos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idUsuario_Alergias_Alimentos` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Alimentos`
--
ALTER TABLE `Alimentos`
  ADD CONSTRAINT `fk_idUsuario_Alimentos` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Alimentos_Recetas`
--
ALTER TABLE `Alimentos_Recetas`
  ADD CONSTRAINT `fk_Alimentos_has_Recetas_Alimentos1` FOREIGN KEY (`id_alimentos`) REFERENCES `Alimentos` (`id_alimentos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Alimentos_has_Recetas_Recetas1` FOREIGN KEY (`id_receta`) REFERENCES `Recetas` (`id_receta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idUsuario_Alimentos_Recetas` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Clientes_Alergias`
--
ALTER TABLE `Clientes_Alergias`
  ADD CONSTRAINT `fk_Clientes_has_Alergias_Alergias1` FOREIGN KEY (`id_alergia`) REFERENCES `Alergias` (`id_alergia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Clientes_has_Alergias_Clientes` FOREIGN KEY (`dni_cliente`) REFERENCES `Clientes` (`dni_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idUsuario_Clientes_Alergias` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Recetas`
--
ALTER TABLE `Recetas`
  ADD CONSTRAINT `fk_idUsuario_Recetas` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Recetas_Semana`
--
ALTER TABLE `Recetas_Semana`
  ADD CONSTRAINT `fk_Recetas_Semana_Clientes1` FOREIGN KEY (`dni_cliente`) REFERENCES `Clientes` (`dni_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Recetas_Semana_Recetas1` FOREIGN KEY (`id_receta`) REFERENCES `Recetas` (`id_receta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idUsuario_Recetas_Semana` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;