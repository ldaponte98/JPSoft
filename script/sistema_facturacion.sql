-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2021 a las 23:06:10
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
(52, 'Ingreso', '', 50, NULL, '2021-08-31 04:11:34', '2021-08-31 04:11:34'),
(53, 'Comprobante de egreso', 'Comprobante de egreso', 15, NULL, '2021-09-24 01:33:56', '2021-09-24 01:33:56'),
(54, 'Menu Digital', '', 44, 'canales/mobile.png', '2021-10-06 21:22:49', '2021-10-06 21:22:49');

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
  `minutos_duracion` int(11) NOT NULL DEFAULT 20,
  `finalizada` int(11) NOT NULL DEFAULT 1,
  `id_usuario_anula` int(11) DEFAULT NULL,
  `motivo_anulacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_dominio_tipo_movimiento` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `id_tercero_proveedor` int(11) DEFAULT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `observaciones` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `id_usuario_modifica` int(11) DEFAULT NULL,
  `id_licencia` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `id_licencia` int(11) NOT NULL,
  `id_tercero_responsable` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `nit` text COLLATE utf8_spanish_ci NOT NULL,
  `telefonos` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen_small` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen_url` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `color_principal` text COLLATE utf8_spanish_ci NOT NULL,
  `color_botones` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `color_letras` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `emails_reportes` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `minutos_duracion_promedio` int(11) NOT NULL DEFAULT 20,
  `estado` int(11) NOT NULL DEFAULT 1,
  `token` text COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`id_licencia`, `id_tercero_responsable`, `nombre`, `email`, `nit`, `telefonos`, `direccion`, `ciudad`, `imagen`, `imagen_small`, `imagen_url`, `color_principal`, `color_botones`, `color_letras`, `emails_reportes`, `minutos_duracion_promedio`, `estado`, `token`, `created_at`, `updated_at`) VALUES
(2, 15, 'Distribuciones S.E.B', NULL, '', '3016136581', 'Carrera 26 # 5 a 10', 'Sincelejo', 'distribuciones_esb.png', 'distribuciones_esb.jpeg', NULL, '#cd201e', '#cd201e', '#FFFFFF', 'eydysuarez@unicesar.edu.co', 20, 1, '7f831774267cf767c5809b791731ce7f', '2020-08-10 22:47:34', '2020-08-10 22:47:34');

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
(2, 2, 46, 1, '2021-08-30 03:02:33', '2021-08-30 03:02:33'),
(5, 2, 54, 1, '2021-10-06 22:08:25', '2021-10-06 22:08:25');

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
(17, 'Menú para clientes', 'circle', 14, 'licencia/menu_clientes', 3, 1, '2021-09-07 15:55:45', '2021-09-07 15:55:45'),
(18, 'Pedidos pendientes', 'mobile', NULL, 'pedidos_pendientes', 1, 1, '2021-10-06 22:04:07', '2021-10-06 22:04:07');

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
(138, 17, 3, 1, '2021-09-07 15:56:42', '2021-09-07 15:56:42'),
(139, 18, 1, 1, '2021-10-06 22:04:51', '2021-10-06 22:04:51'),
(140, 18, 2, 1, '2021-10-06 22:04:51', '2021-10-06 22:04:51'),
(141, 18, 3, 1, '2021-10-06 22:04:51', '2021-10-06 22:04:51');

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
(10, '10', 2, 1, '2021-09-04 17:55:27', '2021-09-13 23:23:39');

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
(1, 'SUPER ADMINISTRADOR', 'Super administrador', 1, '2020-08-04 21:50:36', '2020-08-04 21:50:36'),
(2, 'ADMINISTRADOR', 'Administrador', 1, '2020-08-04 21:50:59', '2020-08-04 21:50:59'),
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resolucion_factura`
--

CREATE TABLE `resolucion_factura` (
  `id_resolucion_factura` int(11) NOT NULL,
  `id_licencia` int(11) NOT NULL,
  `consecutivo_factura` float NOT NULL DEFAULT 1,
  `consecutivo_cotizacion` float NOT NULL DEFAULT 1,
  `consecutivo_comprobante_egreso` float NOT NULL DEFAULT 1,
  `prefijo_factura` text COLLATE utf8_spanish_ci NOT NULL DEFAULT 'FV',
  `prefijo_cotizacion` text COLLATE utf8_spanish_ci NOT NULL DEFAULT 'COT',
  `prefijo_comprobante_egreso` text COLLATE utf8_spanish_ci NOT NULL DEFAULT 'CE',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `resolucion_factura`
--

INSERT INTO `resolucion_factura` (`id_resolucion_factura`, `id_licencia`, `consecutivo_factura`, `consecutivo_cotizacion`, `consecutivo_comprobante_egreso`, `prefijo_factura`, `prefijo_cotizacion`, `prefijo_comprobante_egreso`, `created_at`, `updated_at`) VALUES
(2, 2, 70, 2, 3, 'FV', 'COT', 'CE', '2020-08-10 22:48:26', '2021-10-08 01:16:41');

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
(1, 'Zorax', NULL, 3, 6, '1065843703', 'ldaponte98@gmail.com', 13, '3164689467', NULL, NULL, 2, 1, '2020-08-04 22:04:50', '2021-10-11 17:11:38'),
(15, 'Distribuciones ESB', '.', 2, 6, '3016136581', 'eydysuarez@unicesar.edu.co', 14, '3016136581', 'Carrera 26 # 5 a 10', '782219-2021-10-11-15-40-12.jpeg', 2, 1, '2021-10-11 20:40:12', '2021-10-11 20:40:39');

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
(6, 15, 2, 'DISTRIBUCIONESESB', 'c5e8860fc9928401085e4cf099a233fa', 1, '2021-10-11 20:41:41', '2021-10-11 20:41:41');

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
  MODIFY `id_auditoria_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `id_dominio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  MODIFY `id_factura_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id_forma_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `inventario_detalle`
--
ALTER TABLE `inventario_detalle`
  MODIFY `id_inventario_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `licencia`
--
ALTER TABLE `licencia`
  MODIFY `id_licencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `licencia_canal`
--
ALTER TABLE `licencia_canal`
  MODIFY `id_licencia_canal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `menu_perfil`
--
ALTER TABLE `menu_perfil`
  MODIFY `id_menu_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

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
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  MODIFY `id_producto_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `producto_ingrediente`
--
ALTER TABLE `producto_ingrediente`
  MODIFY `id_producto_ingrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `resolucion_factura`
--
ALTER TABLE `resolucion_factura`
  MODIFY `id_resolucion_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tercero`
--
ALTER TABLE `tercero`
  MODIFY `id_tercero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
