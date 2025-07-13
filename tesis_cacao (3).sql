-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2024 a las 03:10:20
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tesis_cacao`
--
CREATE DATABASE IF NOT EXISTS `tesis_cacao` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tesis_cacao`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idtipoactividades` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`, `idtipoactividades`, `descripcion`) VALUES
(1, 'Riego de plantas en venta', 2, 'Regar plantas en stock de venta'),
(2, 'Abono de producción', 1, 'Abonar para su debido cuidado'),
(3, 'Fumigacion de Plantas en Stock', 3, 'Fumigación para el control y fortalecimiento'),
(4, 'Llenado de fundas', 1, 'Llenar fundas de plantas'),
(5, 'Riego en Producción', 1, 'Regar plantas producidas'),
(6, 'Fumigación en producción', 1, 'Fumigar las plantas producidas'),
(7, 'Abono de planta', 5, 'Abonar las plantas para la venta'),
(8, 'Siembra', 1, 'Siembra para la producción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_produccion`
--

CREATE TABLE `actividad_produccion` (
  `id` int(11) NOT NULL,
  `idgestionactividad` int(11) NOT NULL,
  `idproduccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividad_produccion`
--

INSERT INTO `actividad_produccion` (`id`, `idgestionactividad`, `idproduccion`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 1),
(4, 5, 1),
(5, 7, 2),
(6, 8, 2),
(7, 9, 2),
(8, 10, 2),
(9, 12, 3),
(10, 13, 3),
(11, 14, 3),
(12, 15, 3),
(13, 17, 4),
(14, 18, 4),
(15, 19, 4),
(16, 20, 4),
(17, 22, 5),
(18, 23, 5),
(19, 24, 5),
(20, 25, 5),
(21, 27, 6),
(22, 28, 6),
(23, 29, 6),
(24, 30, 6),
(25, 31, 6),
(26, 32, 7),
(27, 33, 7),
(28, 34, 7),
(29, 36, 8),
(30, 37, 8),
(31, 38, 8),
(32, 39, 8),
(33, 40, 8),
(34, 41, 9),
(35, 42, 9),
(36, 43, 7),
(37, 44, 7),
(38, 45, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_recurso`
--

CREATE TABLE `actividad_recurso` (
  `id` int(11) NOT NULL,
  `idgestionactividad` int(11) NOT NULL,
  `idinsumo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividad_recurso`
--

INSERT INTO `actividad_recurso` (`id`, `idgestionactividad`, `idinsumo`, `cantidad`) VALUES
(1, 1, 2, 3),
(2, 1, 1, 2),
(3, 2, 4, 10),
(4, 3, 3, 5),
(5, 4, 2, 5),
(6, 5, 1, 5),
(7, 5, 3, 5),
(8, 6, 2, 4),
(9, 6, 1, 2),
(10, 7, 4, 6),
(11, 8, 3, 8),
(12, 9, 2, 7),
(13, 10, 1, 5),
(14, 10, 3, 6),
(15, 11, 2, 4),
(16, 11, 1, 2),
(17, 12, 4, 6),
(18, 13, 3, 8),
(19, 14, 2, 7),
(20, 15, 1, 5),
(21, 15, 3, 6),
(22, 16, 2, 4),
(23, 16, 1, 2),
(24, 17, 4, 6),
(25, 18, 3, 8),
(26, 19, 2, 7),
(27, 20, 1, 5),
(28, 20, 3, 6),
(29, 21, 2, 4),
(30, 21, 1, 2),
(31, 22, 4, 6),
(32, 23, 3, 8),
(33, 24, 2, 7),
(34, 25, 1, 5),
(35, 25, 3, 6),
(36, 26, 3, 4),
(37, 27, 5, 20),
(38, 28, 2, 3),
(39, 29, 1, 5),
(40, 30, 3, 5),
(41, 30, 1, 3),
(42, 31, 2, 5),
(43, 32, 5, 10),
(44, 33, 6, 1000),
(45, 34, 2, 3),
(46, 35, 1, 4),
(47, 36, 5, 7),
(48, 37, 2, 12),
(49, 38, 6, 650),
(50, 39, 1, 5),
(51, 40, 1, 3),
(52, 41, 5, 7),
(53, 42, 6, 700),
(54, 43, 3, 5),
(55, 44, 2, 5),
(56, 45, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_trabajador`
--

CREATE TABLE `actividad_trabajador` (
  `id` int(11) NOT NULL,
  `idgestionactividad` int(11) NOT NULL,
  `idtrabajador` int(11) NOT NULL,
  `costo` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividad_trabajador`
--

INSERT INTO `actividad_trabajador` (`id`, `idgestionactividad`, `idtrabajador`, `costo`) VALUES
(1, 1, 1, '20.00'),
(2, 2, 3, '20.00'),
(3, 3, 3, '20.00'),
(4, 4, 1, '20.00'),
(5, 5, 1, '22.00'),
(6, 5, 3, '17.00'),
(7, 6, 1, '22.00'),
(8, 7, 3, '25.00'),
(9, 8, 3, '23.00'),
(10, 9, 1, '25.00'),
(11, 10, 1, '22.00'),
(12, 10, 3, '20.00'),
(13, 11, 1, '25.00'),
(14, 12, 3, '28.00'),
(15, 13, 3, '25.00'),
(16, 14, 1, '24.00'),
(17, 15, 1, '25.00'),
(18, 15, 3, '22.00'),
(19, 16, 1, '18.00'),
(20, 17, 3, '22.00'),
(21, 18, 3, '20.00'),
(22, 19, 1, '21.00'),
(23, 20, 1, '22.00'),
(24, 20, 3, '18.00'),
(25, 21, 1, '28.00'),
(26, 22, 3, '25.00'),
(27, 23, 3, '22.00'),
(28, 24, 1, '23.00'),
(29, 25, 1, '25.00'),
(30, 25, 3, '22.00'),
(31, 26, 1, '20.00'),
(32, 27, 3, '25.00'),
(33, 28, 1, '15.00'),
(34, 29, 3, '22.00'),
(35, 30, 1, '25.00'),
(36, 30, 3, '15.00'),
(37, 31, 1, '20.00'),
(38, 32, 3, '15.00'),
(39, 33, 3, '20.00'),
(40, 34, 1, '16.00'),
(41, 35, 3, '20.00'),
(42, 36, 1, '20.00'),
(43, 37, 3, '20.00'),
(44, 38, 1, '20.00'),
(45, 39, 1, '20.00'),
(46, 40, 1, '20.00'),
(47, 41, 3, '20.00'),
(48, 42, 1, '20.00'),
(49, 43, 3, '20.00'),
(50, 44, 3, '20.00'),
(51, 45, 1, '15.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT '1111-11-11 00:00:00',
  `estado` tinyint(1) NOT NULL DEFAULT 0,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `fecha_inicio`, `fecha_fin`, `estado`, `total`) VALUES
(1, '2024-01-18 15:25:52', '2024-01-19 12:49:00', 1, '213.15'),
(2, '2024-01-19 13:43:50', '2024-01-19 19:30:35', 1, '225.15'),
(3, '2024-01-19 19:39:19', '1111-11-11 00:00:00', 0, '170.15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `cedula`, `nombre`, `email`, `direccion`) VALUES
(1, '0942533712', 'Juan Parra Morales', 'juanparra@gmail.com', 'Calle A - B'),
(3, '0940934615', 'Josue Almeida', 'josuealmeida@gmail.com', 'Yaguachi'),
(4, '0929604056', 'Jorge Estrada', 'jorgeestrada1990@hotmail.com', 'San Lorenzo de Garaicoa'),
(5, '0956433510', 'Agustín Palacios', 'agustinpm1982@gmail.com', 'Balao'),
(6, '0954638219', 'Alberto Moreno Romero', 'alberto@gmail.com', 'Yaguachi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idinsumo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `factura` varchar(100) NOT NULL DEFAULT '0000-0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `idproveedor`, `idinsumo`, `fecha`, `precio`, `cantidad`, `total`, `codigo`, `factura`) VALUES
(1, 1, 1, '2023-08-01 10:30:00', '5.75', 10, '57.50', 'COD001', 'FAC001'),
(2, 2, 2, '2023-08-02 11:45:00', '7.25', 8, '58.00', 'COD002', 'FAC002'),
(3, 3, 3, '2023-08-03 09:15:00', '8.00', 5, '40.00', 'COD003', 'FAC003'),
(4, 4, 4, '2023-08-04 14:20:00', '0.50', 15, '7.50', 'COD004', 'FAC004'),
(5, 5, 5, '2023-08-05 16:30:00', '0.80', 20, '16.00', 'COD005', 'FAC005'),
(6, 1, 1, '2023-08-06 08:45:00', '5.75', 12, '69.00', 'COD006', 'FAC006'),
(7, 2, 2, '2023-08-07 12:00:00', '7.25', 10, '72.50', 'COD007', 'FAC007'),
(8, 3, 3, '2023-08-08 13:20:00', '8.00', 7, '56.00', 'COD008', 'FAC008'),
(9, 4, 4, '2023-08-09 15:10:00', '0.50', 25, '12.50', 'COD009', 'FAC009'),
(10, 5, 5, '2023-08-10 17:45:00', '0.80', 18, '14.40', 'COD010', 'FAC010'),
(11, 1, 1, '2023-09-01 10:30:00', '5.75', 10, '57.50', 'COD011', 'FAC011'),
(12, 2, 2, '2023-09-02 11:45:00', '7.25', 8, '58.00', 'COD012', 'FAC012'),
(13, 3, 3, '2023-09-03 09:15:00', '8.00', 5, '40.00', 'COD013', 'FAC013'),
(14, 4, 4, '2023-09-04 14:20:00', '0.50', 15, '7.50', 'COD014', 'FAC014'),
(15, 5, 5, '2023-09-05 16:30:00', '0.80', 20, '16.00', 'COD015', 'FAC015'),
(16, 1, 1, '2023-09-06 08:45:00', '5.75', 12, '69.00', 'COD016', 'FAC016'),
(17, 2, 2, '2023-09-07 12:00:00', '7.25', 10, '72.50', 'COD017', 'FAC017'),
(18, 3, 3, '2023-09-08 13:20:00', '8.00', 7, '56.00', 'COD018', 'FAC018'),
(19, 4, 4, '2023-09-09 15:10:00', '0.50', 25, '12.50', 'COD019', 'FAC019'),
(20, 5, 5, '2023-09-10 17:45:00', '0.80', 18, '14.40', 'COD020', 'FAC020'),
(21, 1, 1, '2023-10-01 10:30:00', '5.75', 10, '57.50', 'COD021', 'FAC021'),
(22, 2, 2, '2023-10-02 11:45:00', '7.25', 8, '58.00', 'COD022', 'FAC022'),
(23, 3, 3, '2023-10-03 09:15:00', '8.00', 5, '40.00', 'COD023', 'FAC023'),
(24, 4, 4, '2023-10-04 14:20:00', '0.50', 15, '7.50', 'COD024', 'FAC024'),
(25, 5, 5, '2023-10-05 16:30:00', '0.80', 20, '16.00', 'COD025', 'FAC025'),
(26, 1, 1, '2023-10-06 08:45:00', '5.75', 12, '69.00', 'COD026', 'FAC026'),
(27, 2, 2, '2023-10-07 12:00:00', '7.25', 10, '72.50', 'COD027', 'FAC027'),
(28, 3, 3, '2023-10-08 13:20:00', '8.00', 7, '56.00', 'COD028', 'FAC028'),
(29, 4, 4, '2023-10-09 15:10:00', '0.50', 25, '12.50', 'COD029', 'FAC029'),
(30, 5, 5, '2023-10-10 17:45:00', '0.80', 18, '14.40', 'COD030', 'FAC030'),
(31, 1, 1, '2023-11-01 10:30:00', '5.75', 10, '57.50', 'COD031', 'FAC031'),
(32, 2, 2, '2023-11-02 11:45:00', '7.25', 8, '58.00', 'COD032', 'FAC032'),
(33, 3, 3, '2023-11-03 09:15:00', '8.00', 5, '40.00', 'COD033', 'FAC033'),
(34, 4, 4, '2023-11-04 14:20:00', '0.50', 15, '7.50', 'COD034', 'FAC034'),
(35, 5, 5, '2023-11-05 16:30:00', '0.80', 20, '16.00', 'COD035', 'FAC035'),
(36, 1, 1, '2023-11-06 08:45:00', '5.75', 12, '69.00', 'COD036', 'FAC036'),
(37, 2, 2, '2023-11-07 12:00:00', '7.25', 10, '72.50', 'COD037', 'FAC037'),
(38, 3, 3, '2023-11-08 13:20:00', '8.00', 7, '56.00', 'COD038', 'FAC038'),
(39, 4, 4, '2023-11-09 15:10:00', '0.50', 25, '12.50', 'COD039', 'FAC039'),
(40, 5, 5, '2023-11-10 17:45:00', '0.80', 18, '14.40', 'COD040', 'FAC040'),
(41, 1, 1, '2023-12-01 10:30:00', '5.75', 10, '57.50', 'COD041', 'FAC041'),
(42, 2, 2, '2023-12-02 11:45:00', '7.25', 8, '58.00', 'COD042', 'FAC042'),
(43, 3, 3, '2023-12-03 09:15:00', '8.00', 5, '40.00', 'COD043', 'FAC043'),
(44, 4, 4, '2023-12-04 14:20:00', '0.50', 15, '7.50', 'COD044', 'FAC044'),
(45, 5, 5, '2023-12-05 16:30:00', '0.80', 20, '16.00', 'COD045', 'FAC045'),
(46, 1, 1, '2023-12-06 08:45:00', '5.75', 12, '69.00', 'COD046', 'FAC046'),
(47, 2, 2, '2023-12-07 12:00:00', '7.25', 10, '72.50', 'COD047', 'FAC047'),
(48, 3, 3, '2023-12-08 13:20:00', '8.00', 7, '56.00', 'COD048', 'FAC048'),
(49, 4, 4, '2023-12-09 15:10:00', '0.50', 25, '12.50', 'COD049', 'FAC049'),
(50, 5, 5, '2023-12-10 17:45:00', '0.80', 18, '14.40', 'COD050', 'FAC050'),
(51, 1, 3, '2024-01-18 15:53:04', '7.80', 10, '78.00', '511', 'TDM000102'),
(52, 1, 2, '2024-01-18 15:53:04', '7.05', 10, '70.50', '511', 'TDM000102'),
(53, 2, 3, '2024-01-19 14:32:16', '7.80', 10, '78.00', '531', 'HR209383'),
(55, 3, 6, '2024-01-19 15:57:24', '0.08', 1000, '80.00', '551', 'HZM0289282'),
(56, 3, 6, '2024-01-19 15:58:40', '0.07', 2000, '140.00', '561', 'HZM229102938');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fases`
--

CREATE TABLE `fases` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fases`
--

INSERT INTO `fases` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Llenado de fundas', 'Llenado de fundas para el inicio'),
(2, 'Siembra de Cacao', 'Colocación de semillas a las respectivas fundas llenadas'),
(3, 'Crecimiento de la Planta', 'Tercera Fase, crecimiento de la planta'),
(4, 'Injertación', 'Cuarta Fase, injertación de la planta'),
(5, 'Control de calidad', 'Quinta fase, calidad de la planta para la venta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujocaja`
--

CREATE TABLE `flujocaja` (
  `id` int(11) NOT NULL,
  `idcaja` int(11) NOT NULL,
  `idmovimientos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `entrada` decimal(10,2) NOT NULL DEFAULT 0.00,
  `salida` decimal(10,2) NOT NULL DEFAULT 0.00,
  `parcial` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `flujocaja`
--

INSERT INTO `flujocaja` (`id`, `idcaja`, `idmovimientos`, `fecha`, `entrada`, `salida`, `parcial`) VALUES
(1, 1, 1, '2024-01-18 15:25:52', '0.00', '0.00', '0.00'),
(2, 1, 11, '2024-01-18 15:25:52', '166.25', '0.00', '166.25'),
(3, 1, 11, '2024-01-18 15:26:52', '99.00', '0.00', '265.25'),
(4, 1, 15, '2024-01-18 15:53:04', '0.00', '148.50', '116.75'),
(5, 1, 16, '2024-01-19 12:38:58', '0.00', '20.00', '96.75'),
(6, 1, 9, '2024-01-19 12:41:29', '0.00', '30.00', '66.75'),
(7, 1, 10, '2024-01-19 12:41:45', '30.00', '0.00', '96.75'),
(8, 1, 11, '2024-01-19 12:41:59', '116.40', '0.00', '213.15'),
(9, 1, 2, '2024-01-19 12:49:00', '0.00', '0.00', '213.15'),
(10, 2, 1, '2024-01-19 13:43:50', '0.00', '0.00', '213.15'),
(11, 2, 16, '2024-01-19 13:43:50', '0.00', '20.00', '193.15'),
(12, 2, 16, '2024-01-19 13:46:18', '0.00', '20.00', '173.15'),
(13, 2, 16, '2024-01-19 13:59:50', '0.00', '20.00', '153.15'),
(14, 2, 16, '2024-01-19 14:00:39', '0.00', '20.00', '133.15'),
(15, 2, 16, '2024-01-19 14:01:27', '0.00', '39.00', '94.15'),
(16, 2, 15, '2024-01-19 14:32:16', '0.00', '78.00', '16.15'),
(17, 2, 16, '2024-01-19 14:35:12', '0.00', '20.00', '-3.85'),
(18, 2, 16, '2024-01-19 15:04:42', '0.00', '25.00', '-28.85'),
(19, 2, 16, '2024-01-19 15:20:50', '0.00', '15.00', '-43.85'),
(20, 2, 16, '2024-01-19 15:30:45', '0.00', '22.00', '-65.85'),
(21, 2, 16, '2024-01-19 15:31:22', '0.00', '40.00', '-105.85'),
(22, 2, 16, '2024-01-19 15:31:43', '0.00', '20.00', '-125.85'),
(23, 2, 16, '2024-01-19 15:44:13', '0.00', '15.00', '-140.85'),
(24, 2, 15, '2024-01-19 15:57:24', '0.00', '80.00', '-220.85'),
(25, 2, 15, '2024-01-19 15:58:40', '0.00', '140.00', '-360.85'),
(26, 2, 16, '2024-01-19 16:00:07', '0.00', '20.00', '-380.85'),
(27, 2, 16, '2024-01-19 16:00:33', '0.00', '16.00', '-396.85'),
(28, 2, 11, '2024-01-19 18:28:45', '782.00', '0.00', '385.15'),
(29, 2, 16, '2024-01-19 18:33:10', '0.00', '20.00', '365.15'),
(30, 2, 16, '2024-01-19 18:36:01', '0.00', '20.00', '345.15'),
(31, 2, 16, '2024-01-19 18:37:35', '0.00', '20.00', '325.15'),
(32, 2, 16, '2024-01-19 18:40:58', '0.00', '20.00', '305.15'),
(33, 2, 16, '2024-01-19 18:44:47', '0.00', '20.00', '285.15'),
(34, 2, 16, '2024-01-19 18:47:43', '0.00', '20.00', '265.15'),
(35, 2, 16, '2024-01-19 19:01:55', '0.00', '20.00', '245.15'),
(36, 2, 16, '2024-01-19 19:05:55', '0.00', '20.00', '225.15'),
(37, 2, 2, '2024-01-19 19:30:35', '0.00', '0.00', '225.15'),
(38, 3, 1, '2024-01-19 19:39:19', '0.00', '0.00', '225.15'),
(39, 3, 16, '2024-01-19 19:39:19', '0.00', '20.00', '205.15'),
(40, 3, 16, '2024-01-19 19:57:27', '0.00', '20.00', '185.15'),
(41, 3, 16, '2024-01-19 20:00:11', '0.00', '15.00', '170.15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion_actividad`
--

CREATE TABLE `gestion_actividad` (
  `id` int(11) NOT NULL,
  `idactividades` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gestion_actividad`
--

INSERT INTO `gestion_actividad` (`id`, `idactividades`, `fecha`) VALUES
(1, 1, '2023-08-19 13:43:49'),
(2, 4, '2023-08-19 13:46:18'),
(3, 2, '2023-08-19 13:59:50'),
(4, 6, '2023-08-19 14:00:39'),
(5, 6, '2023-08-19 14:01:27'),
(6, 1, '2023-09-19 13:43:49'),
(7, 4, '2023-09-19 13:46:18'),
(8, 2, '2023-09-19 13:59:50'),
(9, 6, '2023-09-19 14:00:39'),
(10, 6, '2023-09-19 14:01:27'),
(11, 1, '2023-10-20 13:43:49'),
(12, 4, '2023-10-20 13:46:18'),
(13, 2, '2023-10-20 13:59:50'),
(14, 6, '2023-10-20 14:00:39'),
(15, 6, '2023-10-20 14:01:27'),
(16, 1, '2023-11-20 13:43:49'),
(17, 4, '2023-11-20 13:46:18'),
(18, 2, '2023-11-20 13:59:50'),
(19, 6, '2023-11-20 14:00:39'),
(20, 6, '2023-11-20 14:01:27'),
(21, 1, '2023-12-20 13:43:49'),
(22, 4, '2023-12-20 13:46:18'),
(23, 2, '2023-12-20 13:59:50'),
(24, 6, '2023-12-20 14:00:39'),
(25, 6, '2023-12-20 14:01:27'),
(26, 7, '2024-01-19 14:35:12'),
(27, 4, '2024-01-19 15:04:42'),
(28, 5, '2024-01-19 15:20:49'),
(29, 6, '2024-01-19 15:30:45'),
(30, 2, '2024-01-19 15:31:22'),
(31, 5, '2024-01-19 15:31:43'),
(32, 4, '2024-01-19 15:44:13'),
(33, 8, '2024-01-19 16:00:06'),
(34, 5, '2024-01-19 16:00:33'),
(35, 1, '2024-01-19 18:33:10'),
(36, 4, '2024-01-19 18:36:00'),
(37, 2, '2024-01-19 18:37:35'),
(38, 8, '2024-01-19 18:40:58'),
(39, 5, '2024-01-19 18:44:47'),
(40, 6, '2024-01-19 18:47:42'),
(41, 4, '2024-01-19 19:01:54'),
(42, 8, '2024-01-19 19:05:55'),
(43, 6, '2024-01-19 19:39:19'),
(44, 2, '2024-01-19 19:57:27'),
(45, 5, '2024-01-19 20:00:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `existencia` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `nombre`, `precio`, `existencia`, `imagen`) VALUES
(1, 'Giberelin 10%', '5.75', 6, 'Giberelin.jpg'),
(2, 'Robusterra ha-1 acido humico', '7.25', 3, 'Robusterra.jpg'),
(3, 'Cacao Producción 50 kg', '8.00', 2, 'cacaoproduccion.jpg'),
(4, 'Funda de cacao pequeña', '0.50', 58, 'funda-pequeña.jpg'),
(5, 'Fundas de cacao grande', '0.80', 151, 'funda-grande.jpg'),
(6, 'Semillas de cacao', '2.00', 650, 'semillas.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `idtipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `nombre`, `descripcion`, `idtipo`) VALUES
(1, 'Apertura', 'Apertura de Caja', 1),
(2, 'Cierre', 'Cierre de Caja', 2),
(4, 'Servicio de Luz', 'Pagar servicio básico de luz', 2),
(5, 'Servicio de Agua', 'Pago de servicio básico del agua', 2),
(6, 'Pago de Internet', 'Pago mensual del internet', 2),
(7, 'Reparación de Equipos', 'Gasto en la reparación de equipos del hogar o vivero', 2),
(8, 'Mantenimiento en equipos', 'Gasto para el mantenimiento de equipos o dispositivos', 2),
(9, 'Prestamo', 'Préstamo realizado a trabajador o conocido', 2),
(10, 'Prestamo Pagado', 'Abono o pago total de un préstamo brindado', 1),
(11, 'Venta', 'Se obtuvo pago de una venta', 1),
(12, 'Suplido Pagado', 'Suplido de un trabajador pagado', 1),
(14, 'prestamo devuelto', 'ingreso de  dolares prestados', 1),
(15, 'Compra', 'Movimiento de las Compras', 2),
(16, 'Actividad o Producción', 'Actividades diarias del vivero', 2),
(17, 'Suplido', 'Suplido realizado a trabajador', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perdida`
--

CREATE TABLE `perdida` (
  `id` int(11) NOT NULL,
  `idproduccion` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perdida`
--

INSERT INTO `perdida` (`id`, `idproduccion`, `fecha`, `cantidad`, `descripcion`) VALUES
(1, 6, '2024-01-19 15:23:42', 10, 'No brotaron las semillas'),
(2, 6, '2024-01-19 15:25:06', 3, 'Daños de fundas'),
(3, 7, '2024-01-19 16:01:04', 5, 'No brotaron'),
(4, 8, '2024-01-19 18:52:37', 50, 'secas'),
(5, 8, '2024-01-19 19:06:47', 40, 'Pago de almuerzo a uno o más trabajadores'),
(6, 7, '2024-01-19 19:58:04', 10, 'Muerte de la planta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantas`
--

CREATE TABLE `plantas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `existencia` int(11) NOT NULL,
  `imagen` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `plantas`
--

INSERT INTO `plantas` (`id`, `nombre`, `precio`, `existencia`, `imagen`) VALUES
(1, 'Planta de cacao grande', '0.98', 3738, 'grandes.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `id` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL DEFAULT '1111-11-11 00:00:00',
  `cantidad` int(11) NOT NULL,
  `idplanta` int(11) NOT NULL,
  `idfase` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `produccion`
--

INSERT INTO `produccion` (`id`, `fecha_inicio`, `fecha_fin`, `cantidad`, `idplanta`, `idfase`, `estado`) VALUES
(1, '2023-08-19 14:04:23', '2023-08-19 14:04:29', 1000, 1, 5, 1),
(2, '2023-09-19 14:04:23', '2023-09-19 14:04:29', 5000, 1, 5, 1),
(3, '2023-10-20 14:04:23', '2023-10-20 14:04:29', 8000, 1, 5, 1),
(4, '2023-11-20 14:04:23', '2023-11-20 14:04:29', 5000, 1, 5, 1),
(5, '2023-12-20 14:04:23', '2023-12-20 14:04:29', 10000, 1, 5, 1),
(6, '2024-01-19 15:04:29', '2024-01-19 15:31:46', 1987, 1, 5, 1),
(7, '2024-01-19 15:44:03', '2024-01-19 20:00:33', 985, 1, 5, 1),
(8, '2024-01-19 18:35:25', '1111-11-11 00:00:00', 610, 1, 3, 0),
(9, '2024-01-19 19:01:39', '1111-11-11 00:00:00', 700, 1, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `cedula`, `email`, `direccion`) VALUES
(1, 'Tienda Don Marcos', '0942098112', 'tienda@hotmail.com', 'Avenida de las Américas'),
(2, 'Hacienda Rendon', '0929604056', 'haciendarendon@hotmail.com', 'Panamericana'),
(3, 'Hector Zambrano', '0943736975', 'hectorzambrano45@hotmail.com', 'Calle Juan Vargas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoactividades`
--

CREATE TABLE `tipoactividades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoactividades`
--

INSERT INTO `tipoactividades` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Actividad de Producción', 'Actividad sólo para producción'),
(2, 'Actividad de Riego', 'Actividad que se complementan con el riego'),
(3, 'Actividad de Fumigación', 'Actividad para realizar un cuidado por medio de fumigación a la planta'),
(4, 'Actividad para el Control de Plagas', 'Control de plagas para el cuidado de plantas ya en Stock'),
(5, 'Actividad de Abono', 'Abonar plantas en stock');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomovimiento`
--

CREATE TABLE `tipomovimiento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipomovimiento`
--

INSERT INTO `tipomovimiento` (`id`, `nombre`) VALUES
(1, 'Entrada'),
(2, 'Salida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `cedula`, `nombre`, `email`, `direccion`) VALUES
(1, '0929888162', 'Alvaro Ramirez Escobar', 'alvaro_ramirez@gmail.com', 'Avenida x - z'),
(3, '1803731221', 'Bryan Santos Campoverde', 'bryan@gmail.com', 'Calle Nueva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `email`, `pass`) VALUES
(1, 'Administrador', 'Cesar', 'cesarliguin@gmail.com', '$2y$10$k6gumz7vzX2OpxwN7FVsFOTI.jQAmLjSAI6o7SBjru/V9PDn0V60y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idplanta` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `codigo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `idcliente`, `idplanta`, `fecha`, `precio`, `cantidad`, `total`, `codigo`) VALUES
(1, 1, 1, '2023-08-01 10:30:00', '0.95', 100, '95.00', 'COD001'),
(2, 2, 1, '2023-08-02 11:45:00', '1.00', 80, '80.00', 'COD002'),
(3, 3, 1, '2023-08-03 09:15:00', '0.92', 120, '110.40', 'COD003'),
(4, 4, 1, '2023-08-04 14:20:00', '0.98', 150, '147.00', 'COD004'),
(5, 5, 1, '2023-08-05 16:30:00', '1.00', 200, '200.00', 'COD005'),
(6, 1, 1, '2023-08-06 08:45:00', '0.93', 90, '83.70', 'COD006'),
(7, 2, 1, '2023-08-07 12:00:00', '0.96', 110, '105.60', 'COD007'),
(8, 3, 1, '2023-08-08 13:20:00', '1.00', 80, '80.00', 'COD008'),
(9, 4, 1, '2023-08-09 15:10:00', '0.94', 130, '122.20', 'COD009'),
(10, 5, 1, '2023-08-10 17:45:00', '0.97', 180, '174.60', 'COD010'),
(11, 1, 1, '2023-09-01 10:30:00', '0.95', 90, '85.50', 'COD011'),
(12, 2, 1, '2023-09-02 11:45:00', '1.00', 70, '70.00', 'COD012'),
(13, 3, 1, '2023-09-03 09:15:00', '0.92', 110, '101.20', 'COD013'),
(14, 4, 1, '2023-09-04 14:20:00', '0.98', 140, '137.20', 'COD014'),
(15, 5, 1, '2023-09-05 16:30:00', '1.00', 180, '180.00', 'COD015'),
(16, 1, 1, '2023-09-06 08:45:00', '0.93', 80, '74.40', 'COD016'),
(17, 2, 1, '2023-09-07 12:00:00', '0.96', 100, '96.00', 'COD017'),
(18, 3, 1, '2023-09-08 13:20:00', '1.00', 70, '70.00', 'COD018'),
(19, 4, 1, '2023-09-09 15:10:00', '0.94', 120, '112.80', 'COD019'),
(20, 5, 1, '2023-09-10 17:45:00', '0.97', 160, '155.20', 'COD020'),
(21, 1, 1, '2023-10-01 10:30:00', '0.95', 90, '85.50', 'COD021'),
(22, 2, 1, '2023-10-02 11:45:00', '1.00', 70, '70.00', 'COD022'),
(23, 3, 1, '2023-10-03 09:15:00', '0.92', 110, '101.20', 'COD023'),
(24, 4, 1, '2023-10-04 14:20:00', '0.98', 140, '137.20', 'COD024'),
(25, 5, 1, '2023-10-05 16:30:00', '1.00', 180, '180.00', 'COD025'),
(26, 1, 1, '2023-10-06 08:45:00', '0.93', 80, '74.40', 'COD026'),
(27, 2, 1, '2023-10-07 12:00:00', '0.96', 100, '96.00', 'COD027'),
(28, 3, 1, '2023-10-08 13:20:00', '1.00', 70, '70.00', 'COD028'),
(29, 4, 1, '2023-10-09 15:10:00', '0.94', 120, '112.80', 'COD029'),
(30, 5, 1, '2023-10-10 17:45:00', '0.97', 160, '155.20', 'COD030'),
(31, 1, 1, '2023-11-01 10:30:00', '0.95', 90, '85.50', 'COD031'),
(32, 2, 1, '2023-11-02 11:45:00', '1.00', 70, '70.00', 'COD032'),
(33, 3, 1, '2023-11-03 09:15:00', '0.92', 110, '101.20', 'COD033'),
(34, 4, 1, '2023-11-04 14:20:00', '0.98', 140, '137.20', 'COD034'),
(35, 5, 1, '2023-11-05 16:30:00', '1.00', 180, '180.00', 'COD035'),
(36, 1, 1, '2023-11-06 08:45:00', '0.93', 80, '74.40', 'COD036'),
(37, 2, 1, '2023-11-07 12:00:00', '0.96', 100, '96.00', 'COD037'),
(38, 3, 1, '2023-11-08 13:20:00', '1.00', 70, '70.00', 'COD038'),
(39, 4, 1, '2023-11-09 15:10:00', '0.94', 120, '112.80', 'COD039'),
(40, 5, 1, '2023-11-10 17:45:00', '0.97', 160, '155.20', 'COD040'),
(41, 1, 1, '2023-12-01 10:30:00', '0.95', 90, '85.50', 'COD041'),
(42, 2, 1, '2023-12-02 11:45:00', '1.00', 70, '70.00', 'COD042'),
(43, 3, 1, '2023-12-03 09:15:00', '0.92', 110, '101.20', 'COD043'),
(44, 4, 1, '2023-12-04 14:20:00', '0.98', 140, '137.20', 'COD044'),
(45, 5, 1, '2023-12-05 16:30:00', '1.00', 180, '180.00', 'COD045'),
(46, 1, 1, '2023-12-06 08:45:00', '0.93', 80, '74.40', 'COD046'),
(47, 2, 1, '2023-12-07 12:00:00', '0.96', 100, '96.00', 'COD047'),
(48, 3, 1, '2023-12-08 13:20:00', '1.00', 70, '70.00', 'COD048'),
(49, 4, 1, '2023-12-09 15:10:00', '0.94', 120, '112.80', 'COD049'),
(50, 5, 1, '2023-12-10 17:45:00', '0.97', 160, '155.20', 'COD050'),
(51, 3, 1, '2024-01-18 15:25:51', '0.95', 175, '166.25', '511'),
(52, 1, 1, '2024-01-18 15:26:52', '0.99', 100, '99.00', '521'),
(53, 6, 1, '2024-01-19 12:41:59', '0.97', 120, '116.40', '531'),
(54, 1, 1, '2024-01-19 18:28:44', '23.00', 34, '782.00', '541');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `actividad_produccion`
--
ALTER TABLE `actividad_produccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actividad_recurso`
--
ALTER TABLE `actividad_recurso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `actividad_trabajador`
--
ALTER TABLE `actividad_trabajador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fases`
--
ALTER TABLE `fases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `flujocaja`
--
ALTER TABLE `flujocaja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gestion_actividad`
--
ALTER TABLE `gestion_actividad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `perdida`
--
ALTER TABLE `perdida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_proveedor` (`email`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `tipoactividades`
--
ALTER TABLE `tipoactividades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tipomovimiento`
--
ALTER TABLE `tipomovimiento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_trabajador` (`email`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_usuarios` (`usuario`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `actividad_produccion`
--
ALTER TABLE `actividad_produccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `actividad_recurso`
--
ALTER TABLE `actividad_recurso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `actividad_trabajador`
--
ALTER TABLE `actividad_trabajador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `fases`
--
ALTER TABLE `fases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `flujocaja`
--
ALTER TABLE `flujocaja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `gestion_actividad`
--
ALTER TABLE `gestion_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `perdida`
--
ALTER TABLE `perdida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `plantas`
--
ALTER TABLE `plantas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipoactividades`
--
ALTER TABLE `tipoactividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipomovimiento`
--
ALTER TABLE `tipomovimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
