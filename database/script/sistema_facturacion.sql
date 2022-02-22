-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2021 a las 18:54:11
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria_inventario`
--

CREATE TABLE `auditoria_inventario` (
  `id_auditoria_inventario` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `id_dominio_tipo_movimiento` int(11) NOT NULL,
  `id_licencia` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `auditoria_inventario`
--

INSERT INTO `auditoria_inventario` (`id_auditoria_inventario`, `id_factura`, `id_producto`, `cantidad`, `id_dominio_tipo_movimiento`, `id_licencia`, `estado`, `created_at`, `updated_at`) VALUES
(1, 80, 11, 130, 51, 2, 1, '2021-08-31 04:27:26', '2021-08-31 04:27:26'),
(2, 80, 10, 3, 51, 2, 1, '2021-08-31 04:27:28', '2021-08-31 04:27:28'),
(3, 80, 13, 0.15, 51, 2, 1, '2021-08-31 04:27:28', '2021-08-31 04:27:28'),
(4, 80, 14, 0.17, 51, 2, 1, '2021-08-31 04:27:28', '2021-08-31 04:27:28'),
(5, 80, 16, 1.5, 51, 2, 1, '2021-08-31 04:27:28', '2021-08-31 04:27:28'),
(6, 80, 18, 70, 51, 2, 1, '2021-08-31 04:27:28', '2021-08-31 04:27:28'),
(7, 80, 12, 50, 51, 2, 1, '2021-08-31 04:27:28', '2021-08-31 04:27:28'),
(8, 83, 11, 130, 51, 2, 1, '2021-08-31 20:37:15', '2021-08-31 20:37:15'),
(9, 83, 10, 3, 51, 2, 1, '2021-08-31 20:37:17', '2021-08-31 20:37:17'),
(10, 83, 13, 0.15, 51, 2, 1, '2021-08-31 20:37:17', '2021-08-31 20:37:17'),
(11, 83, 14, 0.17, 51, 2, 1, '2021-08-31 20:37:17', '2021-08-31 20:37:17'),
(12, 83, 16, 1.5, 51, 2, 1, '2021-08-31 20:37:17', '2021-08-31 20:37:17'),
(13, 83, 18, 30, 51, 2, 1, '2021-08-31 20:37:17', '2021-08-31 20:37:17'),
(14, 83, 12, 50, 51, 2, 1, '2021-08-31 20:37:17', '2021-08-31 20:37:17'),
(15, 81, 11, 200, 51, 2, 1, '2021-09-01 14:12:39', '2021-09-01 14:12:39'),
(16, 81, 11, 200, 52, 2, 1, '2021-09-01 14:29:25', '2021-09-01 14:29:25'),
(17, 81, 11, 200, 52, 2, 1, '2021-09-01 14:34:44', '2021-09-01 14:34:44'),
(18, 84, 11, 200, 51, 2, 1, '2021-09-01 14:46:39', '2021-09-01 14:46:39'),
(19, 84, 11, 200, 52, 2, 1, '2021-09-01 14:47:10', '2021-09-01 14:47:10'),
(20, 85, 11, 130, 51, 2, 1, '2021-09-02 04:13:30', '2021-09-02 04:13:30'),
(21, 85, 10, 3, 51, 2, 1, '2021-09-02 04:13:30', '2021-09-02 04:13:30'),
(22, 85, 13, 0.15, 51, 2, 1, '2021-09-02 04:13:30', '2021-09-02 04:13:30'),
(23, 85, 14, 0.17, 51, 2, 1, '2021-09-02 04:13:30', '2021-09-02 04:13:30'),
(24, 85, 16, 1.5, 51, 2, 1, '2021-09-02 04:13:30', '2021-09-02 04:13:30'),
(25, 85, 18, 30, 51, 2, 1, '2021-09-02 04:13:30', '2021-09-02 04:13:30'),
(26, 85, 12, 50, 51, 2, 1, '2021-09-02 04:13:30', '2021-09-02 04:13:30'),
(27, 85, 11, 130, 52, 2, 1, '2021-09-02 04:45:44', '2021-09-02 04:45:44'),
(28, 85, 10, 3, 52, 2, 1, '2021-09-02 04:45:44', '2021-09-02 04:45:44'),
(29, 85, 13, 0.15, 52, 2, 1, '2021-09-02 04:45:44', '2021-09-02 04:45:44'),
(30, 85, 14, 0.17, 52, 2, 1, '2021-09-02 04:45:44', '2021-09-02 04:45:44'),
(31, 85, 16, 1.5, 52, 2, 1, '2021-09-02 04:45:44', '2021-09-02 04:45:44'),
(32, 85, 18, 30, 52, 2, 1, '2021-09-02 04:45:44', '2021-09-02 04:45:44'),
(33, 85, 12, 50, 52, 2, 1, '2021-09-02 04:45:44', '2021-09-02 04:45:44'),
(34, 87, 11, 200, 51, 2, 1, '2021-09-07 16:49:06', '2021-09-07 16:49:06'),
(35, 77, 11, 200, 51, 2, 1, '2021-09-07 16:49:25', '2021-09-07 16:49:25'),
(36, 77, 15, 1, 51, 2, 1, '2021-09-07 16:49:25', '2021-09-07 16:49:25'),
(37, 77, 13, 0.15, 51, 2, 1, '2021-09-07 16:49:25', '2021-09-07 16:49:25'),
(38, 77, 14, 0.15, 51, 2, 1, '2021-09-07 16:49:25', '2021-09-07 16:49:25'),
(39, 77, 18, 30, 51, 2, 1, '2021-09-07 16:49:25', '2021-09-07 16:49:25'),
(40, 77, 10, 0.05, 51, 2, 1, '2021-09-07 16:49:25', '2021-09-07 16:49:25'),
(41, 77, 12, 80, 51, 2, 1, '2021-09-07 16:49:25', '2021-09-07 16:49:25'),
(42, 79, 11, 200, 51, 2, 1, '2021-09-07 16:49:40', '2021-09-07 16:49:40'),
(43, 86, 11, 130, 51, 2, 1, '2021-09-07 16:49:54', '2021-09-07 16:49:54'),
(44, 86, 10, 3, 51, 2, 1, '2021-09-07 16:49:54', '2021-09-07 16:49:54'),
(45, 86, 13, 0.15, 51, 2, 1, '2021-09-07 16:49:54', '2021-09-07 16:49:54'),
(46, 86, 14, 0.17, 51, 2, 1, '2021-09-07 16:49:54', '2021-09-07 16:49:54'),
(47, 86, 16, 1.5, 51, 2, 1, '2021-09-07 16:49:54', '2021-09-07 16:49:54'),
(48, 86, 18, 30, 51, 2, 1, '2021-09-07 16:49:54', '2021-09-07 16:49:54'),
(49, 86, 12, 50, 51, 2, 1, '2021-09-07 16:49:54', '2021-09-07 16:49:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_apertura` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_cierre` timestamp NULL DEFAULT NULL,
  `valor_inicial` double NOT NULL,
  `id_licencia` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `id_usuario`, `fecha_apertura`, `fecha_cierre`, `valor_inicial`, `id_licencia`, `estado`, `created_at`, `updated_at`) VALUES
(2, 1, '2021-09-03 04:43:22', '2021-09-03 17:06:10', 10000, 2, 1, '2021-09-03 04:43:22', '2021-09-03 17:06:10'),
(3, 1, '2021-09-03 22:42:40', '2021-09-07 16:50:33', 0, 2, 1, '2021-09-03 22:42:40', '2021-09-07 16:50:33'),
(4, 4, '2021-09-07 01:40:58', NULL, 10000, 2, 1, '2021-09-07 01:40:58', '2021-09-07 01:40:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_licencia` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`, `id_licencia`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Perros Calientes', 'Perros Calientes', 2, 1, '2020-08-21 02:32:52', '2021-08-07 23:18:21'),
(2, 'Hamburguesas', NULL, 2, 1, '2020-08-21 02:33:21', '2020-08-21 02:33:21'),
(3, 'Pizzas', NULL, 2, 1, '2021-08-05 03:02:53', '2021-08-05 03:02:53'),
(4, 'Salchipapas', NULL, 2, 1, '2021-08-05 04:27:45', '2021-08-05 04:27:45'),
(5, 'Adicionales', NULL, 2, 1, '2021-08-05 05:03:10', '2021-08-05 05:03:10'),
(6, 'Bebidas', NULL, 2, 1, '2021-08-05 05:05:08', '2021-08-05 05:05:08'),
(7, 'Patacones', NULL, 2, 1, '2021-08-05 05:05:08', '2021-08-05 05:05:08'),
(8, 'Helados', NULL, 2, 1, '2021-08-05 05:05:08', '2021-08-05 05:05:08'),
(9, 'Mazorcas', NULL, 2, 1, '2021-08-05 05:05:08', '2021-08-05 05:05:08'),
(10, 'Picadas', NULL, 2, 1, '2021-08-05 05:05:09', '2021-08-05 05:05:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE `dominio` (
  `id_dominio` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dominio`
--

INSERT INTO `dominio` (`id_dominio`, `nombre`, `descripcion`, `id_padre`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 'Tipos de tercero', 'Tipos de tercero', NULL, NULL, '2020-08-04 21:42:22', '2020-08-04 21:42:22'),
(2, 'Empleado', 'Empleado', 1, NULL, '2020-08-04 21:43:16', '2020-08-04 21:43:16'),
(3, 'Cliente', 'Cliente', 1, NULL, '2020-08-04 21:43:16', '2020-08-04 21:43:16'),
(4, 'Tipos de identificacion', 'Tipos de identificacion', NULL, NULL, '2020-08-04 21:51:31', '2020-08-04 21:51:31'),
(5, 'CC', ' Cedula de ciudadanía', 4, NULL, '2020-08-04 21:55:32', '2020-08-04 21:55:32'),
(6, 'NIT', 'NIT', 4, NULL, '2020-08-04 21:55:32', '2020-08-04 21:55:32'),
(7, 'CE', 'Cédula de Extranjería', 4, NULL, '2020-08-04 21:55:32', '2020-08-04 21:55:32'),
(8, 'TI', 'Tarjeta de Identidad', 4, NULL, '2020-08-04 21:55:32', '2020-08-04 21:55:32'),
(9, 'PASAPORTE', 'PASAPORTE', 4, NULL, '2020-08-04 21:55:32', '2020-08-04 21:55:32'),
(10, 'NUIP', 'Número de identificación personal', 4, NULL, '2020-08-04 21:55:32', '2020-08-04 21:55:32'),
(11, 'PEP', 'Permiso especial de permanencia', 4, NULL, '2020-08-04 21:55:32', '2020-08-04 21:55:32'),
(12, 'Tipos de sexo', 'Tipos de sexo', NULL, NULL, '2020-08-04 21:58:23', '2020-08-04 21:58:23'),
(13, 'Indefinido', '', 12, NULL, '2020-08-04 21:59:07', '2020-08-04 21:59:07'),
(14, 'Masculino', '', 12, NULL, '2020-08-04 21:59:07', '2020-08-04 21:59:07'),
(15, 'Tipos de factura', 'Tipos de factura', NULL, NULL, '2020-08-10 22:36:00', '2020-08-10 22:36:00'),
(16, 'Factura de venta', 'Factura de venta', 15, NULL, '2020-08-10 22:36:38', '2020-08-10 22:36:38'),
(17, 'Cotizacion', 'Cotización', 15, NULL, '2020-08-10 22:36:38', '2020-08-10 22:36:38'),
(18, 'Empresa', 'Empresa', 1, NULL, '2020-08-10 23:02:05', '2020-08-10 23:02:05'),
(19, 'Formas de pago', 'Formas de pago', NULL, NULL, '2020-08-12 14:21:16', '2020-08-12 14:21:16'),
(20, 'Efectivo', 'Efectivo', 19, NULL, '2020-08-12 14:28:22', '2020-08-12 14:28:22'),
(21, 'Transferencia ', 'Cheque', 19, NULL, '2020-08-12 14:28:22', '2020-08-12 14:28:22'),
(22, 'Tarjeta Débito', 'Tarjeta Débito', 19, NULL, '2020-08-12 14:28:22', '2020-08-12 14:28:22'),
(23, 'Tarjeta Crédito', 'Tarjeta Crédito', 19, NULL, '2020-08-12 14:28:22', '2020-08-12 14:28:22'),
(24, 'Presentacion de productos', 'Presentacion de productos', NULL, NULL, '2020-08-21 02:34:48', '2020-08-21 02:34:48'),
(25, 'un', 'Unidades', 24, NULL, '2020-08-21 02:35:19', '2020-08-21 02:35:19'),
(26, 'l', 'Litro', 24, NULL, '2020-08-21 02:36:05', '2020-08-21 02:36:05'),
(27, 'ml', 'Mililitro', 24, NULL, '2020-08-21 02:36:05', '2020-08-21 02:36:05'),
(28, 'kg', 'Kilogramo', 24, NULL, '2020-08-21 02:36:05', '2020-08-21 02:36:05'),
(29, 'gr', 'Gramo', 24, NULL, '2020-08-21 02:36:05', '2020-08-21 02:36:05'),
(30, 'oz', 'Onza', 24, NULL, '2020-08-21 02:36:05', '2020-08-21 02:36:05'),
(31, 'cm3', 'Centimetro cubico', 24, NULL, '2020-08-21 02:38:01', '2020-08-21 02:38:01'),
(32, 'cm', 'Centimetro', 24, NULL, '2020-08-21 02:38:57', '2020-08-21 02:38:57'),
(33, 'mm', 'Milimetro', 24, NULL, '2020-08-21 02:38:57', '2020-08-21 02:38:57'),
(34, 'm', 'Metro', 24, NULL, '2020-08-21 02:38:57', '2020-08-21 02:38:57'),
(35, 'Tipo de producto', '', NULL, NULL, '2021-08-07 18:28:38', '2021-08-07 18:28:38'),
(36, 'Producto', '', 35, NULL, '2021-08-07 18:29:31', '2021-08-07 18:29:31'),
(37, 'Servicio', '', 35, NULL, '2021-08-07 18:29:31', '2021-08-07 18:29:31'),
(38, 'Ingrediente', '', 35, NULL, '2021-08-07 18:29:31', '2021-08-07 18:29:31'),
(39, 'Movimientos de inventario', '', NULL, NULL, '2021-08-14 18:34:58', '2021-08-14 18:34:58'),
(40, 'Entrada de inventario', '', 39, NULL, '2021-08-14 18:35:28', '2021-08-14 18:35:28'),
(41, 'Salida de inventario', '', 39, NULL, '2021-08-14 18:35:28', '2021-08-14 18:35:28'),
(42, 'Proveedor', '', 1, NULL, '2021-08-16 15:30:04', '2021-08-16 15:30:04'),
(43, 'Femenino', '', 12, NULL, '2021-08-16 15:33:04', '2021-08-16 15:33:04'),
(44, 'Canales de venta', '', NULL, NULL, '2021-08-17 14:27:53', '2021-08-17 14:27:53'),
(45, 'Rappi', '', 44, 'canales/rappi.png', '2021-08-17 14:28:40', '2021-08-17 14:28:40'),
(46, 'Domicilio', '', 44, 'canales/delivery.png', '2021-08-17 14:28:40', '2021-08-17 14:28:40'),
(47, 'Mesa', '', 44, 'canales/table.png', '2021-08-17 14:28:40', '2021-08-17 14:28:40'),
(48, 'IFood', '', 44, 'canales/ifood.png', '2021-08-30 02:35:36', '2021-08-30 02:35:36'),
(49, 'No definido', '', 44, 'canales/rappi.png', '2021-08-30 05:24:27', '2021-08-30 05:24:27'),
(50, 'Movimientos para auditoria inventario', '', NULL, NULL, '2021-08-31 04:10:28', '2021-08-31 04:10:28'),
(51, 'Descuento', '', 50, NULL, '2021-08-31 04:11:34', '2021-08-31 04:11:34'),
(52, 'Ingreso', '', 50, NULL, '2021-08-31 04:11:34', '2021-08-31 04:11:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `numero` text COLLATE utf8_spanish_ci NOT NULL,
  `descuento` double NOT NULL DEFAULT 0,
  `valor` float NOT NULL,
  `id_licencia` int(11) NOT NULL,
  `id_caja` int(11) DEFAULT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_dominio_tipo_factura` int(11) NOT NULL,
  `id_dominio_canal` int(11) DEFAULT NULL,
  `id_mesa` int(11) DEFAULT NULL,
  `domicilio` double NOT NULL DEFAULT 0,
  `direccion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `servicio_voluntario` double NOT NULL DEFAULT 0,
  `finalizada` int(11) NOT NULL DEFAULT 1,
  `id_usuario_anula` int(11) DEFAULT NULL,
  `motivo_anulacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `id_tercero`, `numero`, `descuento`, `valor`, `id_licencia`, `id_caja`, `id_usuario_registra`, `observaciones`, `fecha`, `id_dominio_tipo_factura`, `id_dominio_canal`, `id_mesa`, `domicilio`, `direccion`, `servicio_voluntario`, `finalizada`, `id_usuario_anula`, `motivo_anulacion`, `estado`, `created_at`, `updated_at`) VALUES
(76, 7, 'FV-20', 2000, 56000, 2, NULL, 1, 'Todo el pedido es sin salsas', '2021-08-27 04:27:31', 16, 47, 1, 0, NULL, 5000, 1, NULL, NULL, 1, '2021-08-27 09:27:31', '2021-08-30 10:11:07'),
(77, 11, 'FV-49', 500, 78500, 2, 3, 1, NULL, '2021-08-30 02:18:05', 16, 46, NULL, 3000, 'Cra 23 # 7B 74 Villa concha 2 etapa', 1000, 1, NULL, NULL, 1, '2021-08-30 07:18:05', '2021-09-07 16:49:22'),
(78, 7, 'FV-30', 0, 480000, 2, NULL, 1, 'Todo sin salsas', '2021-08-30 04:18:09', 16, 47, 3, 0, NULL, 0, 1, NULL, NULL, 1, '2021-08-30 09:18:09', '2021-08-31 01:57:30'),
(79, 7, 'FV-50', 0, 3000, 2, 3, 1, NULL, '2021-08-30 05:20:12', 16, 48, NULL, 0, NULL, 0, 1, NULL, NULL, 1, '2021-08-30 10:20:12', '2021-09-07 16:49:38'),
(80, 10, 'FV-31', 0, 10000, 2, NULL, 1, NULL, '2021-08-30 05:26:30', 16, 45, NULL, 0, NULL, 0, 1, NULL, NULL, 1, '2021-08-30 10:26:30', '2021-08-31 04:27:24'),
(81, 7, 'FV-39', 0, 5000, 2, NULL, 1, NULL, '2021-08-31 01:47:10', 16, 47, 5, 0, NULL, 2000, 1, 1, 'Por que si', 0, '2021-08-31 06:47:09', '2021-09-01 14:34:45'),
(82, 7, 'FV-29', 1000, 29000, 2, NULL, 1, NULL, '2021-08-31 01:50:29', 16, 45, NULL, 0, NULL, 0, 1, NULL, NULL, 1, '2021-08-31 06:50:29', '2021-08-31 01:56:43'),
(83, 7, 'FV-33', 0, 12000, 2, NULL, 1, NULL, '2021-08-31 20:36:44', 16, 47, 1, 0, NULL, 2000, 1, NULL, NULL, 1, '2021-08-31 20:36:44', '2021-08-31 20:37:10'),
(84, 7, 'FV-42', 0, 6000, 2, NULL, 1, NULL, '2021-09-01 14:46:08', 16, 47, 1, 0, NULL, 0, 1, 1, 'Por prueba', 0, '2021-09-01 14:46:08', '2021-09-01 14:47:10'),
(85, 7, 'FV-43', 0, 10000, 2, NULL, 1, NULL, '2021-09-02 04:13:25', 16, 47, 1, 0, NULL, 0, 1, 1, 'gfsdfgsdfgs', 0, '2021-09-02 04:13:25', '2021-09-02 04:45:44'),
(86, 7, 'FV-51', 0, 20000, 2, 3, 1, NULL, '2021-09-03 14:33:01', 16, 48, NULL, 0, NULL, 0, 1, NULL, NULL, 1, '2021-09-03 14:33:01', '2021-09-07 16:49:51'),
(87, 7, 'FV-48', 2000, 13000, 2, 3, 1, NULL, '2021-09-03 17:05:36', 16, 47, 2, 0, NULL, 0, 1, NULL, NULL, 1, '2021-09-03 17:05:36', '2021-09-07 16:49:00'),
(90, 2, 'FV-46', 2000, 28000, 2, 3, 1, 'dfgsdfgdf', '2021-09-03 22:59:20', 16, 49, NULL, 0, NULL, 0, 1, NULL, NULL, 1, '2021-09-03 22:59:20', '2021-09-03 22:59:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_detalle`
--

CREATE TABLE `factura_detalle` (
  `id_factura_detalle` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` double NOT NULL DEFAULT 1,
  `nombre_producto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_producto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_producto` float NOT NULL,
  `presentacion_producto` text COLLATE utf8_spanish_ci NOT NULL,
  `iva_producto` int(11) DEFAULT NULL,
  `descuento_producto` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura_detalle`
--

INSERT INTO `factura_detalle` (`id_factura_detalle`, `id_factura`, `id_producto`, `cantidad`, `nombre_producto`, `descripcion_producto`, `precio_producto`, `presentacion_producto`, `iva_producto`, `descuento_producto`, `created_at`, `updated_at`) VALUES
(130, 76, 6, 2, 'Salchipapa Mixta', NULL, 10000, 'un', NULL, 0, '2021-08-30 10:11:07', '2021-08-30 10:11:07'),
(131, 76, 7, 2, 'Salchipapa Trifasica', NULL, 15000, 'un', NULL, 0, '2021-08-30 10:11:07', '2021-08-30 10:11:07'),
(132, 76, 21, 1, 'Porción de papas', NULL, 3000, 'un', NULL, 0, '2021-08-30 10:11:07', '2021-08-30 10:11:07'),
(142, 82, 7, 2, 'Salchipapa Trifasica', NULL, 15000, 'un', NULL, 0, '2021-08-31 01:56:43', '2021-08-31 01:56:43'),
(143, 78, 6, 3, 'Salchipapa Mixta', NULL, 10000, 'un', NULL, 0, '2021-08-31 01:57:30', '2021-08-31 01:57:30'),
(144, 78, 21, 150, 'Porción de papas', NULL, 3000, 'gr', NULL, 0, '2021-08-31 01:57:30', '2021-08-31 01:57:30'),
(152, 80, 6, 1, 'Salchipapa Mixta', NULL, 10000, 'un', NULL, 0, '2021-08-31 04:27:24', '2021-08-31 04:27:24'),
(154, 83, 6, 1, 'Salchipapa Mixta', NULL, 10000, 'un', NULL, 0, '2021-08-31 20:37:10', '2021-08-31 20:37:10'),
(160, 81, 21, 1, 'Porción de papas', NULL, 3000, 'un', NULL, 0, '2021-09-01 14:12:34', '2021-09-01 14:12:34'),
(163, 84, 21, 2, 'Porción de papas', NULL, 3000, 'un', NULL, 0, '2021-09-01 14:46:37', '2021-09-01 14:46:37'),
(164, 85, 6, 1, 'Salchipapa Mixta', NULL, 10000, 'un', NULL, 0, '2021-09-02 04:13:25', '2021-09-02 04:13:25'),
(167, 90, 9, 1, 'Reservas', NULL, 30000, 'un', 0, 2000, '2021-09-03 22:59:20', '2021-09-03 22:59:20'),
(169, 87, 21, 5, 'Porción de papas', NULL, 3000, 'un', NULL, 0, '2021-09-07 16:49:00', '2021-09-07 16:49:00'),
(170, 77, 7, 5, 'Salchipapa Trifasica', NULL, 15000, 'un', NULL, 0, '2021-09-07 16:49:22', '2021-09-07 16:49:22'),
(171, 79, 21, 1, 'Porción de papas', NULL, 3000, 'gr', NULL, 0, '2021-09-07 16:49:38', '2021-09-07 16:49:38'),
(172, 86, 6, 2, 'Salchipapa Mixta', NULL, 10000, 'un', NULL, 0, '2021-09-07 16:49:51', '2021-09-07 16:49:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `id_forma_pago` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_dominio_forma_pago` int(11) NOT NULL,
  `valor` float NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`id_forma_pago`, `id_factura`, `id_dominio_forma_pago`, `valor`, `estado`, `created_at`, `updated_at`) VALUES
(83, 76, 20, 56000, 1, '2021-08-30 10:11:07', '2021-08-30 10:11:07'),
(92, 82, 21, 29000, 1, '2021-08-31 01:56:43', '2021-08-31 01:56:43'),
(93, 78, 20, 160000, 1, '2021-08-31 01:57:30', '2021-08-31 01:57:30'),
(94, 78, 21, 160000, 1, '2021-08-31 01:57:30', '2021-08-31 01:57:30'),
(95, 78, 22, 160000, 1, '2021-08-31 01:57:30', '2021-08-31 01:57:30'),
(103, 80, 20, 10000, 1, '2021-08-31 04:27:24', '2021-08-31 04:27:24'),
(105, 83, 20, 12000, 1, '2021-08-31 20:37:10', '2021-08-31 20:37:10'),
(121, 81, 20, 5000, 1, '2021-09-01 14:12:34', '2021-09-01 14:12:34'),
(124, 84, 20, 6000, 1, '2021-09-01 14:46:37', '2021-09-01 14:46:37'),
(125, 85, 23, 10000, 1, '2021-09-02 04:13:25', '2021-09-02 04:13:25'),
(128, 90, 20, 28000, 1, '2021-09-03 22:59:20', '2021-09-03 22:59:20'),
(130, 87, 21, 13000, 1, '2021-09-07 16:49:00', '2021-09-07 16:49:00'),
(131, 77, 20, 26166.7, 1, '2021-09-07 16:49:22', '2021-09-07 16:49:22'),
(132, 77, 21, 26166.7, 1, '2021-09-07 16:49:22', '2021-09-07 16:49:22'),
(133, 77, 22, 26166.7, 1, '2021-09-07 16:49:22', '2021-09-07 16:49:22'),
(134, 79, 20, 3000, 1, '2021-09-07 16:49:38', '2021-09-07 16:49:38'),
(135, 86, 20, 20000, 1, '2021-09-07 16:49:51', '2021-09-07 16:49:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_dominio_tipo_movimiento` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `id_tercero_proveedor` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `observaciones` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `id_usuario_modifica` int(11) DEFAULT NULL,
  `id_licencia` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_dominio_tipo_movimiento`, `fecha`, `id_tercero_proveedor`, `estado`, `observaciones`, `id_usuario_registra`, `id_usuario_modifica`, `id_licencia`, `created_at`, `updated_at`) VALUES
(1, 40, '2021-08-16', NULL, 1, '', 1, 0, 2, '2021-08-14 18:36:31', '2021-08-14 18:36:31'),
(2, 41, '2021-08-16', NULL, 1, '', 1, 0, 2, '2021-08-14 18:36:56', '2021-08-14 18:36:56'),
(6, 40, '2021-08-16', 6, 1, 'Llego tarde el pedido', 1, NULL, 2, '2021-08-17 03:09:12', '2021-08-17 03:09:12'),
(7, 40, '2021-08-16', 6, 1, NULL, 1, NULL, 2, '2021-08-17 03:56:30', '2021-08-17 03:56:30'),
(8, 40, '2021-08-31', NULL, 1, NULL, 1, NULL, 2, '2021-08-31 20:34:31', '2021-08-31 20:34:31'),
(9, 40, '2021-08-31', NULL, 1, NULL, 1, NULL, 2, '2021-08-31 20:35:43', '2021-08-31 20:35:43'),
(10, 40, '2021-09-01', NULL, 1, NULL, 1, NULL, 2, '2021-09-02 01:47:26', '2021-09-02 01:47:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_detalle`
--

CREATE TABLE `inventario_detalle` (
  `id_inventario_detalle` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `nombre_producto` text COLLATE utf8_spanish_ci NOT NULL,
  `presentacion_producto` text COLLATE utf8_spanish_ci NOT NULL,
  `precio_producto` double NOT NULL,
  `cantidad` double NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inventario_detalle`
--

INSERT INTO `inventario_detalle` (`id_inventario_detalle`, `id_inventario`, `id_producto`, `nombre_producto`, `presentacion_producto`, `precio_producto`, `cantidad`, `estado`, `created_at`, `updated_at`) VALUES
(1, 6, 10, 'QUESO COSTEñO', 'kg', 15000, 2, 1, '2021-08-17 03:09:12', '2021-08-17 03:09:12'),
(2, 7, 10, 'QUESO COSTEñO', 'kg', 15000, 6, 1, '2021-08-17 03:56:30', '2021-08-17 03:56:30'),
(3, 7, 11, 'PAPAS FRITAS', 'kg', 4000, 1.5, 1, '2021-08-17 03:56:30', '2021-08-17 03:56:30'),
(4, 8, 18, 'PAPA RIPIO', 'gr', 11, 200, 1, '2021-08-31 20:34:31', '2021-08-31 20:34:31'),
(5, 9, 18, 'PAPA RIPIO', 'gr', 11, 500, 1, '2021-08-31 20:35:43', '2021-08-31 20:35:43'),
(6, 10, 10, 'QUESO COSTEñO', 'kg', 15000, 50, 1, '2021-09-02 01:47:26', '2021-09-02 01:47:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `id_licencia` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `nit` text COLLATE utf8_spanish_ci NOT NULL,
  `telefonos` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen_small` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen_url` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `color_botones` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `color_letras` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `emails_reportes` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `token` text COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`id_licencia`, `nombre`, `email`, `nit`, `telefonos`, `direccion`, `ciudad`, `imagen`, `imagen_small`, `imagen_url`, `color_botones`, `color_letras`, `emails_reportes`, `estado`, `token`, `created_at`, `updated_at`) VALUES
(2, 'Demo', NULL, '901213972-7', '3165700919', 'Cra 16 # 13 - 12', 'Valledupar - Cesar', 'logo.png', 'logo.png', 'https://cdn.shortpixel.ai/spai/w_888+q_lossless+ret_img+to_webp/https://www.sosfactory.com/wp-content/uploads/2016/12/logo-mr-bolat.png', '#efbc05', '#000000', 'ldaponte98@gmail.com', 1, '7f831774267cf767c5809b791731ce7f', '2020-08-10 22:47:34', '2020-08-10 22:47:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia_canal`
--

CREATE TABLE `licencia_canal` (
  `id_licencia_canal` int(11) NOT NULL,
  `id_licencia` int(11) NOT NULL,
  `id_dominio_canal` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `licencia_canal`
--

INSERT INTO `licencia_canal` (`id_licencia_canal`, `id_licencia`, `id_dominio_canal`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, 47, 1, '2021-08-30 03:02:33', '2021-08-30 03:02:33'),
(2, 2, 46, 1, '2021-08-30 03:02:33', '2021-08-30 03:02:33'),
(3, 2, 48, 1, '2021-08-30 03:02:33', '2021-08-30 03:02:33'),
(4, 2, 45, 1, '2021-08-30 03:02:33', '2021-08-30 03:02:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `titulo` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalle` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id_log`, `titulo`, `detalle`, `estado`, `created_at`, `updated_at`) VALUES
(4, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-08-31 04:27:26', '2021-08-31 04:27:26'),
(5, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-08-31 04:27:28', '2021-08-31 04:27:28'),
(6, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-08-31 20:37:15', '2021-08-31 20:37:15'),
(7, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-08-31 20:37:17', '2021-08-31 20:37:17'),
(8, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-01 14:12:39', '2021-09-01 14:12:39'),
(9, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-01 14:29:25', '2021-09-01 14:29:25'),
(10, 'Anulación de factura', 'El usuario [1] anula factura [81]', 1, '2021-09-01 14:29:25', '2021-09-01 14:29:25'),
(11, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-01 14:34:44', '2021-09-01 14:34:44'),
(12, 'Anulacion de factura', 'El usuario [1] anula factura [81]', 1, '2021-09-01 14:34:45', '2021-09-01 14:34:45'),
(13, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-01 14:46:39', '2021-09-01 14:46:39'),
(14, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-01 14:47:10', '2021-09-01 14:47:10'),
(15, 'Anulacion de factura', 'El usuario [1] anula factura [84]', 1, '2021-09-01 14:47:10', '2021-09-01 14:47:10'),
(16, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-02 04:13:30', '2021-09-02 04:13:30'),
(17, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-02 04:45:44', '2021-09-02 04:45:44'),
(18, 'Anulacion de factura', 'El usuario [1] anula factura [85]', 1, '2021-09-02 04:45:45', '2021-09-02 04:45:45'),
(19, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-07 16:49:05', '2021-09-07 16:49:05'),
(20, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-07 16:49:25', '2021-09-07 16:49:25'),
(21, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-07 16:49:40', '2021-09-07 16:49:40'),
(22, 'Envio email de aviso de inventario', 'Se envia email a [ldaponte98@gmail.com] con respuesta [Envio exitoso]', 1, '2021-09-07 16:49:54', '2021-09-07 16:49:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `icono` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `ruta` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT 1,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `nombre`, `icono`, `id_padre`, `ruta`, `orden`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Terceros', 'users', NULL, NULL, 2, 1, '2020-08-05 04:50:45', '2020-08-05 04:50:45'),
(2, 'Administrar terceros', 'circle', 1, 'tercero/administrar', 2, 1, '2020-08-05 05:19:05', '2020-08-05 05:19:05'),
(3, 'Crear tercero', 'circle', 1, 'tercero/crear', 1, 1, '2020-08-05 05:19:05', '2020-08-05 05:19:05'),
(4, 'Reportes', 'bar-chart', NULL, NULL, 4, 1, '2020-08-13 15:20:54', '2020-08-13 15:20:54'),
(5, 'Reporte de ventas', 'circle', 4, 'reportes/facturas', 1, 1, '2020-08-13 15:22:04', '2020-08-13 15:22:04'),
(6, 'Inventario', 'laptop', NULL, NULL, 3, 1, '2020-08-21 01:46:20', '2020-08-21 01:46:20'),
(7, 'Productos', 'circle', 6, 'producto/administrar', 1, 1, '2020-08-21 01:48:29', '2020-08-21 01:48:29'),
(8, 'Categorias', 'circle', 6, 'categoria/administrar', 2, 1, '2020-08-21 01:48:58', '2020-08-21 01:48:58'),
(9, 'Movimientos', 'circle', 6, 'inventario/movimientos', 3, 1, '2021-08-14 18:30:45', '2021-08-14 18:30:45'),
(10, 'Servicio', 'shopping-cart', NULL, 'canales_servicio', 1, 1, '2021-08-30 03:13:37', '2021-08-30 03:13:37'),
(11, 'Stock Actual', 'circle', 6, 'inventario/stock_actual', 4, 1, '2021-09-02 00:29:21', '2021-09-02 00:29:21'),
(12, 'Auditoria interna inventario', 'circle', 4, 'reportes/auditoria_interna', 2, 1, '2021-09-02 04:47:40', '2021-09-02 04:47:40'),
(13, 'Reporte de caja', 'circle', 4, 'reportes/caja', 1, 1, '2021-09-03 17:07:17', '2021-09-03 17:07:17'),
(14, 'Sistema', 'cog', NULL, NULL, 5, 1, '2021-09-04 16:37:23', '2021-09-04 16:37:23'),
(15, 'Mesas', 'circle', 14, 'mesa/administrar', 1, 1, '2021-09-04 16:38:46', '2021-09-04 16:38:46'),
(16, 'Usuarios', 'circle', 14, 'usuario/administrar', 1, 1, '2021-09-04 16:38:46', '2021-09-04 16:38:46'),
(17, 'Menú para clientes', 'circle', 14, 'licencia/menu_clientes', 3, 1, '2021-09-07 15:55:45', '2021-09-07 15:55:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_perfil`
--

CREATE TABLE `menu_perfil` (
  `id_menu_perfil` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu_perfil`
--

INSERT INTO `menu_perfil` (`id_menu_perfil`, `id_menu`, `id_perfil`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2020-08-05 05:26:16', '2020-08-05 05:26:16'),
(3, 3, 1, 1, '2020-08-05 05:26:29', '2020-08-05 05:26:29'),
(6, 4, 1, 1, '2020-08-13 15:23:13', '2020-08-13 15:23:13'),
(7, 5, 1, 1, '2020-08-13 15:23:13', '2020-08-13 15:23:13'),
(8, 2, 1, 1, '2020-08-18 14:42:27', '2020-08-18 14:42:27'),
(9, 6, 1, 1, '2020-08-21 01:49:32', '2020-08-21 01:49:32'),
(10, 7, 1, 1, '2020-08-21 01:49:48', '2020-08-21 01:49:48'),
(11, 8, 1, 1, '2020-08-21 01:49:48', '2020-08-21 01:49:48'),
(12, 9, 1, 1, '2021-08-14 18:31:30', '2021-08-14 18:31:30'),
(15, 10, 1, 1, '2021-08-30 03:14:45', '2021-08-30 03:14:45'),
(16, 11, 1, 1, '2021-09-02 00:29:38', '2021-09-02 00:29:38'),
(18, 12, 1, 1, '2021-09-02 04:48:14', '2021-09-02 04:48:14'),
(20, 13, 1, 1, '2021-09-03 17:07:44', '2021-09-03 17:07:44'),
(22, 14, 1, 1, '2021-09-04 16:42:19', '2021-09-04 16:42:19'),
(24, 15, 1, 1, '2021-09-04 16:44:10', '2021-09-04 16:44:10'),
(26, 16, 1, 1, '2021-09-04 16:44:10', '2021-09-04 16:44:10'),
(58, 1, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(59, 3, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(60, 4, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(61, 5, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(62, 2, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(63, 6, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(64, 7, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(65, 8, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(66, 9, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(67, 10, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(68, 11, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(69, 12, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(70, 13, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(71, 14, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(72, 15, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(73, 16, 2, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(89, 1, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(90, 3, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(91, 4, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(93, 2, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(94, 6, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(95, 7, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(96, 8, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(97, 9, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(98, 10, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(99, 11, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(100, 12, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(101, 13, 3, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(120, 1, 4, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(121, 3, 4, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(124, 2, 4, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(129, 10, 4, 1, '2021-09-06 20:02:11', '2021-09-06 20:02:11'),
(136, 17, 1, 1, '2021-09-07 15:56:42', '2021-09-07 15:56:42'),
(137, 17, 2, 1, '2021-09-07 15:56:42', '2021-09-07 15:56:42'),
(138, 17, 3, 1, '2021-09-07 15:56:42', '2021-09-07 15:56:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id_mesa` int(11) NOT NULL,
  `numero` text COLLATE utf8_spanish_ci NOT NULL,
  `id_licencia` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id_mesa`, `numero`, `id_licencia`, `estado`, `created_at`, `updated_at`) VALUES
(1, '1', 2, 1, '2021-08-26 01:31:33', '2021-08-26 01:31:33'),
(2, '2', 2, 1, '2021-08-26 01:31:33', '2021-08-26 01:31:33'),
(3, '3', 2, 1, '2021-08-30 03:35:38', '2021-08-30 03:35:38'),
(4, '4', 2, 1, '2021-08-30 03:35:38', '2021-08-30 03:35:38'),
(5, '5', 2, 1, '2021-08-30 03:35:38', '2021-08-30 03:35:38'),
(6, '6', 2, 1, '2021-08-30 03:35:38', '2021-08-30 03:35:38'),
(7, '7', 2, 1, '2021-08-30 03:35:38', '2021-08-30 03:35:38'),
(8, '8', 2, 1, '2021-08-30 03:35:38', '2021-09-04 17:55:20'),
(9, '9', 2, 1, '2021-09-04 17:54:00', '2021-09-04 17:54:00'),
(10, '10', 2, 1, '2021-09-04 17:55:27', '2021-09-04 17:55:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Super administrador', 'Super administrador', 1, '2020-08-04 21:50:36', '2020-08-04 21:50:36'),
(2, 'Administrador', 'Administrador', 1, '2020-08-04 21:50:59', '2020-08-04 21:50:59'),
(3, 'CAJERO', NULL, 1, '2021-09-06 17:22:37', '2021-09-06 17:22:37'),
(4, 'MESERO', NULL, 1, '2021-09-06 17:22:37', '2021-09-06 17:22:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_permiso`
--

CREATE TABLE `perfil_permiso` (
  `id_perfil_permiso` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfil_permiso`
--

INSERT INTO `perfil_permiso` (`id_perfil_permiso`, `id_perfil`, `id_permiso`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2021-09-01 04:51:56', '2021-09-01 04:51:56'),
(2, 2, 1, 1, '2021-09-01 04:51:56', '2021-09-01 04:51:56'),
(3, 4, 3, 1, '2021-09-06 20:20:07', '2021-09-06 20:20:07'),
(4, 3, 2, 1, '2021-09-07 01:40:25', '2021-09-07 01:40:25'),
(5, 1, 4, 1, '2021-09-07 16:39:53', '2021-09-07 16:39:53'),
(6, 2, 4, 1, '2021-09-07 16:39:53', '2021-09-07 16:39:53'),
(7, 3, 4, 1, '2021-09-07 16:39:53', '2021-09-07 16:39:53'),
(8, 2, 2, 1, '2021-09-07 16:48:18', '2021-09-07 16:48:18'),
(9, 1, 2, 1, '2021-09-07 16:48:18', '2021-09-07 16:48:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Anular pedidos finalizados', NULL, 1, '2021-09-01 04:49:03', '2021-09-01 04:49:03'),
(2, 'Abrir caja', NULL, 1, '2021-09-03 15:15:21', '2021-09-03 15:15:21'),
(3, 'Facturar con ultima caja abierta', NULL, 1, '2021-09-06 20:19:33', '2021-09-06 20:19:33'),
(4, 'Notificaciones de productos agotándose del inventario', NULL, 1, '2021-09-07 16:37:53', '2021-09-07 16:37:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `id_dominio_tipo_producto` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `iva` int(11) NOT NULL,
  `contenido` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_dominio_presentacion` int(11) NOT NULL,
  `descontado` int(1) DEFAULT 1,
  `descontado_ingredientes` int(11) NOT NULL DEFAULT 0,
  `id_licencia` int(11) NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `alerta` int(11) NOT NULL DEFAULT 0,
  `cantidad_minimo_alerta` float DEFAULT NULL,
  `cantidad_actual` float DEFAULT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `id_dominio_tipo_producto`, `descripcion`, `precio_compra`, `precio_venta`, `iva`, `contenido`, `id_dominio_presentacion`, `descontado`, `descontado_ingredientes`, `id_licencia`, `imagen`, `alerta`, `cantidad_minimo_alerta`, `cantidad_actual`, `id_usuario_registra`, `created_at`, `updated_at`, `estado`) VALUES
(6, 'Salchipapa Mixta', 36, 'Carne, pollo, pasa fritas, queso costeño, salsas de la casa, salchicha suiza', 0, 10000, 0, '1', 25, 0, 1, 2, '861998-2021-08-07-15-51-13.jpg', 0, 0, 0, 1, '2021-08-07 20:38:28', '2021-08-13 08:15:28', 1),
(7, 'Salchipapa Trifasica', 36, 'Carne, pollo, salchicha queso costeño, papa ripio, queso mozarela y salsas', 0, 15000, 0, '1', 25, 0, 1, 2, '309750-2021-08-07-15-57-56.jpg', 0, 0, 0, 1, '2021-08-07 20:56:18', '2021-09-07 15:50:08', 1),
(9, 'Reservas', 37, NULL, 0, 30000, 0, '1', 25, 0, 0, 2, NULL, 0, 0, 0, 1, '2021-08-08 00:01:56', '2021-08-08 00:05:29', 1),
(10, 'Queso Costeño', 38, NULL, 15000, 0, 0, '1', 28, 0, 0, 2, '275330-2021-08-12-21-17-19.jpg', 1, 5, 48.95, 1, '2021-08-08 00:09:00', '2021-09-07 16:49:54', 1),
(11, 'Papas fritas', 38, NULL, 4000, 0, 0, '1', 29, 0, 0, 2, '44968-2021-08-12-20-53-48.jpg', 1, 500, -790, 1, '2021-08-13 01:53:48', '2021-09-07 16:49:54', 1),
(12, 'Queso mozarrella', 38, NULL, 0, 0, 0, '1', 29, 0, 0, 2, '883458-2021-08-12-21-18-27.jpg', 0, 0, -230, 1, '2021-08-13 02:18:27', '2021-09-07 16:49:54', 1),
(13, 'Carne de res', 38, NULL, 15000, 0, 0, '1', 28, 0, 0, 2, '356422-2021-08-12-21-23-31.jpg', 0, 0, -0.6, 1, '2021-08-13 02:23:31', '2021-09-07 16:49:54', 1),
(14, 'Pollo', 38, NULL, 8000, 0, 0, '1', 28, 0, 0, 2, '329904-2021-08-12-21-24-45.jpeg', 0, 0, -0.66, 1, '2021-08-13 02:24:45', '2021-09-07 16:49:54', 1),
(15, 'Salchicha manguera', 38, NULL, 800, 0, 0, '1', 25, 0, 0, 2, '981140-2021-08-12-21-26-22.jpg', 0, 0, -1, 1, '2021-08-13 02:26:11', '2021-09-07 16:49:25', 1),
(16, 'Salchicha ranchera', 38, NULL, 1500, 0, 0, '1', 25, 0, 0, 2, '422386-2021-08-12-21-29-48.jpg', 0, 0, -4.5, 1, '2021-08-13 02:29:48', '2021-09-07 16:49:54', 1),
(17, 'Salchicha suiza', 38, NULL, 2000, 0, 0, '1', 25, 0, 0, 2, '374895-2021-08-12-21-46-28.png', 0, 0, 0, 1, '2021-08-13 02:46:28', '2021-08-13 02:46:28', 1),
(18, 'Papa ripio', 38, NULL, 11, 0, 0, '1', 29, 0, 0, 2, '146612-2021-08-12-21-47-41.jpg', 0, 0, 540, 1, '2021-08-13 02:47:41', '2021-09-07 16:49:54', 1),
(19, 'Tomate', 38, NULL, 30, 0, 0, '1', 29, 0, 0, 2, '763549-2021-08-12-21-50-41.jpg', 0, 0, 0, 1, '2021-08-13 02:50:41', '2021-08-13 02:50:41', 1),
(20, 'Cebolla', 38, NULL, 12, 0, 0, '1', 29, 0, 0, 2, '290279-2021-08-12-21-51-25.jpg', 0, 0, 0, 1, '2021-08-13 02:51:25', '2021-08-13 02:51:25', 1),
(21, 'Porción de papas', 36, 'Porción de papas de 200 gramos', 0, 3000, 0, '1', 25, 0, 1, 2, '58954-2021-08-13-04-19-13.jpg', 0, 0, 0, 1, '2021-08-13 09:19:14', '2021-09-07 15:47:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_categoria`
--

CREATE TABLE `producto_categoria` (
  `id_producto_categoria` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto_categoria`
--

INSERT INTO `producto_categoria` (`id_producto_categoria`, `id_producto`, `id_categoria`, `estado`, `created_at`, `updated_at`) VALUES
(29, 6, 4, 1, '2021-08-31 20:36:22', '2021-08-31 20:36:22'),
(31, 21, 5, 1, '2021-09-07 15:47:00', '2021-09-07 15:47:00'),
(32, 7, 4, 1, '2021-09-07 15:50:08', '2021-09-07 15:50:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_ingrediente`
--

CREATE TABLE `producto_ingrediente` (
  `id_producto_ingrediente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  `cantidad` double NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto_ingrediente`
--

INSERT INTO `producto_ingrediente` (`id_producto_ingrediente`, `id_producto`, `id_ingrediente`, `cantidad`, `estado`, `created_at`, `updated_at`) VALUES
(37, 6, 11, 130, 1, '2021-08-31 20:36:22', '2021-08-31 20:36:22'),
(38, 6, 10, 3, 1, '2021-08-31 20:36:22', '2021-08-31 20:36:22'),
(39, 6, 13, 0.15, 1, '2021-08-31 20:36:22', '2021-08-31 20:36:22'),
(40, 6, 14, 0.17, 1, '2021-08-31 20:36:22', '2021-08-31 20:36:22'),
(41, 6, 16, 1.5, 1, '2021-08-31 20:36:22', '2021-08-31 20:36:22'),
(42, 6, 18, 30, 1, '2021-08-31 20:36:22', '2021-08-31 20:36:22'),
(43, 6, 12, 50, 1, '2021-08-31 20:36:22', '2021-08-31 20:36:22'),
(44, 21, 11, 200, 1, '2021-09-07 15:47:00', '2021-09-07 15:47:00'),
(45, 7, 11, 200, 1, '2021-09-07 15:50:08', '2021-09-07 15:50:08'),
(46, 7, 15, 1, 1, '2021-09-07 15:50:09', '2021-09-07 15:50:09'),
(47, 7, 13, 0.15, 1, '2021-09-07 15:50:09', '2021-09-07 15:50:09'),
(48, 7, 14, 0.15, 1, '2021-09-07 15:50:09', '2021-09-07 15:50:09'),
(49, 7, 18, 30, 1, '2021-09-07 15:50:09', '2021-09-07 15:50:09'),
(50, 7, 10, 0.05, 1, '2021-09-07 15:50:09', '2021-09-07 15:50:09'),
(51, 7, 12, 80, 1, '2021-09-07 15:50:09', '2021-09-07 15:50:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resolucion_factura`
--

CREATE TABLE `resolucion_factura` (
  `id_resolucion_factura` int(11) NOT NULL,
  `id_licencia` int(11) NOT NULL,
  `consecutivo_factura` float NOT NULL,
  `consecutivo_cotizacion` float NOT NULL,
  `prefijo_factura` text COLLATE utf8_spanish_ci NOT NULL,
  `prefijo_cotizacion` text COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `resolucion_factura`
--

INSERT INTO `resolucion_factura` (`id_resolucion_factura`, `id_licencia`, `consecutivo_factura`, `consecutivo_cotizacion`, `prefijo_factura`, `prefijo_cotizacion`, `created_at`, `updated_at`) VALUES
(2, 2, 51, 1, 'FV', 'COT', '2020-08-10 22:48:26', '2021-09-07 16:49:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tercero`
--

CREATE TABLE `tercero` (
  `id_tercero` int(11) NOT NULL,
  `nombres` text COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_dominio_tipo_tercero` int(11) NOT NULL,
  `id_dominio_tipo_identificacion` int(11) NOT NULL,
  `identificacion` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_dominio_sexo` int(11) DEFAULT NULL,
  `telefono` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_licencia` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tercero`
--

INSERT INTO `tercero` (`id_tercero`, `nombres`, `apellidos`, `id_dominio_tipo_tercero`, `id_dominio_tipo_identificacion`, `identificacion`, `email`, `id_dominio_sexo`, `telefono`, `direccion`, `imagen`, `id_licencia`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '', 3, 6, '1065843703', 'ldaponte98@gmail.com', 13, '3164689467', NULL, NULL, 2, 1, '2020-08-04 22:04:50', '2020-08-04 22:04:50'),
(2, 'Luis Daniel', 'Aponte Daza', 2, 5, '1065843702', 'ldaponte98@gmail.com', 13, '3164689467', 'CALLE 16 #23B-87', '717332-2020-08-09-23-07-16.jpg', 2, 1, '2020-08-10 04:07:16', '2020-08-13 20:18:11'),
(6, 'Santana', NULL, 42, 5, '202108161537064091', NULL, 13, NULL, NULL, NULL, 2, 1, '2021-08-16 20:37:06', '2021-08-16 20:37:06'),
(7, 'Desconocido', NULL, 3, 5, '000000000', 'desconocido@gmail.com', 13, NULL, NULL, NULL, 2, 1, '2021-08-27 08:01:56', '2021-08-27 08:01:56'),
(9, 'Juan jose', NULL, 3, 5, '1065843703123', 'desconocido@gmail.com', 13, '3015142030', NULL, NULL, 2, 1, '2021-08-27 08:11:23', '2021-08-27 08:11:23'),
(10, 'Maria Jose Perez', NULL, 3, 5, '1065987456', 'desconocido@gmail.com', 13, '3158963624', NULL, NULL, 2, 1, '2021-08-30 10:34:07', '2021-08-30 10:34:07'),
(11, 'Juan Antonio Jimenez', NULL, 3, 5, '5896369887', 'desconocido@gmail.com', 13, '3215966332', NULL, NULL, 2, 1, '2021-09-01 03:16:11', '2021-09-01 03:16:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_tercero`, `id_perfil`, `usuario`, `clave`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'administrador', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2020-08-04 22:10:51', '2020-08-04 22:10:51'),
(3, 2, 4, '1065843703', '148b7eba57bfc10168718d897a686b41', 1, '2021-09-06 17:40:16', '2021-09-06 17:48:23'),
(4, 2, 3, 'CAJERO', '9a951b541d12368f539b746c7c8b7da6', 1, '2021-09-06 20:36:49', '2021-09-06 20:36:49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria_inventario`
--
ALTER TABLE `auditoria_inventario`
  ADD PRIMARY KEY (`id_auditoria_inventario`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `dominio`
--
ALTER TABLE `dominio`
  ADD PRIMARY KEY (`id_dominio`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `fk_factura_tercero` (`id_tercero`),
  ADD KEY `fk_factura_licencia` (`id_licencia`),
  ADD KEY `fk_factura_caja` (`id_caja`),
  ADD KEY `fk_factura_usuario_registra` (`id_usuario_registra`),
  ADD KEY `fk_factura_usuario_anula` (`id_usuario_anula`),
  ADD KEY `fk_factura_dominio_tipo_factura` (`id_dominio_tipo_factura`),
  ADD KEY `fk_factura_dominio_canal` (`id_dominio_canal`),
  ADD KEY `fk_factura_mesa` (`id_mesa`);

--
-- Indices de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD PRIMARY KEY (`id_factura_detalle`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id_forma_pago`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`);

--
-- Indices de la tabla `inventario_detalle`
--
ALTER TABLE `inventario_detalle`
  ADD PRIMARY KEY (`id_inventario_detalle`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`id_licencia`);

--
-- Indices de la tabla `licencia_canal`
--
ALTER TABLE `licencia_canal`
  ADD PRIMARY KEY (`id_licencia_canal`),
  ADD KEY `fk_licencia_canal_licencia` (`id_licencia`),
  ADD KEY `fk_licencia_canal_dominio` (`id_dominio_canal`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `menu_perfil`
--
ALTER TABLE `menu_perfil`
  ADD PRIMARY KEY (`id_menu_perfil`),
  ADD KEY `menu_menu_perfil_fk` (`id_menu`),
  ADD KEY `perfil_menu_perfil_fk` (`id_perfil`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id_mesa`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `perfil_permiso`
--
ALTER TABLE `perfil_permiso`
  ADD PRIMARY KEY (`id_perfil_permiso`),
  ADD KEY `fk_permiso_perfil` (`id_perfil`),
  ADD KEY `fk_permiso_id_permiso` (`id_permiso`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  ADD PRIMARY KEY (`id_producto_categoria`);

--
-- Indices de la tabla `producto_ingrediente`
--
ALTER TABLE `producto_ingrediente`
  ADD PRIMARY KEY (`id_producto_ingrediente`);

--
-- Indices de la tabla `resolucion_factura`
--
ALTER TABLE `resolucion_factura`
  ADD PRIMARY KEY (`id_resolucion_factura`),
  ADD KEY `licencia_resolucion_fk` (`id_licencia`);

--
-- Indices de la tabla `tercero`
--
ALTER TABLE `tercero`
  ADD PRIMARY KEY (`id_tercero`),
  ADD KEY `tipo_tercero_fk` (`id_dominio_tipo_tercero`),
  ADD KEY `tipo_identificacion_tercero_fk` (`id_dominio_tipo_identificacion`),
  ADD KEY `tipo_sexo_tercero_fk` (`id_dominio_sexo`),
  ADD KEY `licencia_tercero_fk` (`id_licencia`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `tercero_usuario_fk` (`id_tercero`),
  ADD KEY `perfil_usuario_fk` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria_inventario`
--
ALTER TABLE `auditoria_inventario`
  MODIFY `id_auditoria_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `id_dominio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  MODIFY `id_factura_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id_forma_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `inventario_detalle`
--
ALTER TABLE `inventario_detalle`
  MODIFY `id_inventario_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `id_licencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `licencia_canal`
--
ALTER TABLE `licencia_canal`
  MODIFY `id_licencia_canal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `menu_perfil`
--
ALTER TABLE `menu_perfil`
  MODIFY `id_menu_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfil_permiso`
--
ALTER TABLE `perfil_permiso`
  MODIFY `id_perfil_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  MODIFY `id_producto_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `producto_ingrediente`
--
ALTER TABLE `producto_ingrediente`
  MODIFY `id_producto_ingrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `resolucion_factura`
--
ALTER TABLE `resolucion_factura`
  MODIFY `id_resolucion_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tercero`
--
ALTER TABLE `tercero`
  MODIFY `id_tercero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_factura_caja` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id_caja`),
  ADD CONSTRAINT `fk_factura_dominio_canal` FOREIGN KEY (`id_dominio_canal`) REFERENCES `dominio` (`id_dominio`),
  ADD CONSTRAINT `fk_factura_dominio_tipo_factura` FOREIGN KEY (`id_dominio_tipo_factura`) REFERENCES `dominio` (`id_dominio`),
  ADD CONSTRAINT `fk_factura_licencia` FOREIGN KEY (`id_licencia`) REFERENCES `licencia` (`id_licencia`),
  ADD CONSTRAINT `fk_factura_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id_mesa`),
  ADD CONSTRAINT `fk_factura_tercero` FOREIGN KEY (`id_tercero`) REFERENCES `tercero` (`id_tercero`),
  ADD CONSTRAINT `fk_factura_usuario_anula` FOREIGN KEY (`id_usuario_anula`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_factura_usuario_registra` FOREIGN KEY (`id_usuario_registra`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `licencia_canal`
--
ALTER TABLE `licencia_canal`
  ADD CONSTRAINT `fk_licencia_canal_dominio` FOREIGN KEY (`id_dominio_canal`) REFERENCES `dominio` (`id_dominio`),
  ADD CONSTRAINT `fk_licencia_canal_licencia` FOREIGN KEY (`id_licencia`) REFERENCES `licencia` (`id_licencia`);

--
-- Filtros para la tabla `menu_perfil`
--
ALTER TABLE `menu_perfil`
  ADD CONSTRAINT `menu_menu_perfil_fk` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `perfil_menu_perfil_fk` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`);

--
-- Filtros para la tabla `perfil_permiso`
--
ALTER TABLE `perfil_permiso`
  ADD CONSTRAINT `fk_permiso_id_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`),
  ADD CONSTRAINT `fk_permiso_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`);

--
-- Filtros para la tabla `resolucion_factura`
--
ALTER TABLE `resolucion_factura`
  ADD CONSTRAINT `licencia_resolucion_fk` FOREIGN KEY (`id_licencia`) REFERENCES `licencia` (`id_licencia`);

--
-- Filtros para la tabla `tercero`
--
ALTER TABLE `tercero`
  ADD CONSTRAINT `licencia_tercero_fk` FOREIGN KEY (`id_licencia`) REFERENCES `licencia` (`id_licencia`),
  ADD CONSTRAINT `tipo_identificacion_tercero_fk` FOREIGN KEY (`id_dominio_tipo_identificacion`) REFERENCES `dominio` (`id_dominio`),
  ADD CONSTRAINT `tipo_sexo_tercero_fk` FOREIGN KEY (`id_dominio_sexo`) REFERENCES `dominio` (`id_dominio`),
  ADD CONSTRAINT `tipo_tercero_fk` FOREIGN KEY (`id_dominio_tipo_tercero`) REFERENCES `dominio` (`id_dominio`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `perfil_usuario_fk` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `tercero_usuario_fk` FOREIGN KEY (`id_tercero`) REFERENCES `tercero` (`id_tercero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
