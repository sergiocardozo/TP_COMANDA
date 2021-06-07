-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2021 a las 23:31:07
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `balwohnmpu`
--
CREATE DATABASE IF NOT EXISTS `balwohnmpu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `balwohnmpu`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `usuario` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ruta` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `metodo` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ip` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `usuario`, `ruta`, `metodo`, `ip`, `fecha`) VALUES
(130, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 00:42:28'),
(131, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 00:42:40'),
(132, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 00:42:51'),
(133, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 00:44:10'),
(134, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 00:44:27'),
(135, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 17:48:32'),
(136, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 17:49:15'),
(137, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 17:51:42'),
(138, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 17:52:09'),
(139, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 17:52:38'),
(140, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1', '2021-06-01 17:53:01'),
(141, 'scardozo', '/productos/7', 'GET', '::1', '2021-06-06 22:05:31'),
(142, 'scardozo', '/productos/', 'GET', '::1', '2021-06-06 22:05:46'),
(143, 'scardozo', '/productos/7', 'GET', '::1', '2021-06-06 22:06:26'),
(144, 'scardozo', '/productos/', 'GET', '::1', '2021-06-06 22:06:31'),
(145, 'scardozo', '/productos/', 'GET', '::1', '2021-06-06 22:06:42'),
(146, 'scardozo', '/productos/', 'GET', '::1', '2021-06-06 22:07:08'),
(147, 'scardozo', '/productos/cargarUnProducto/', 'POST', '::1', '2021-06-06 22:08:23'),
(148, 'scardozo', '/productos/', 'GET', '::1', '2021-06-06 22:08:57'),
(149, 'scardozo', '/pedido/', 'GET', '::1', '2021-06-06 22:21:05'),
(150, 'scardozo', '/mesa/modificarUna/', 'POST', '::1', '2021-06-06 22:57:37'),
(151, 'scardozo', '/mesa/modificarUna/', 'POST', '::1', '2021-06-06 22:57:48'),
(152, 'Jorgitosi', '/pedido/', 'POST', '::1', '2021-06-06 22:59:21'),
(153, 'Jorgitosi', '/pedido/', 'POST', '::1', '2021-06-06 23:00:45'),
(154, 'Jorgitosi', '/pedido/', 'POST', '::1', '2021-06-06 23:00:47'),
(155, 'Jorgitosi', '/pedido/', 'POST', '::1', '2021-06-06 23:02:49'),
(156, 'Jorgitosi', '/pedido/', 'POST', '::1', '2021-06-06 23:05:08'),
(157, 'Jorgitosi', '/pedido/', 'POST', '::1', '2021-06-06 23:05:17'),
(158, 'scardozo', '/pedido/prepararPedido', 'POST', '::1', '2021-06-06 23:06:16'),
(159, 'scardozo', '/pedido/prepararPedido', 'POST', '::1', '2021-06-06 23:06:30'),
(160, 'scardozo', '/pedido/terminarPedido?codigoPedido=fmeQz', 'POST', '::1', '2021-06-06 23:06:46'),
(161, 'Jorgitosi', '/pedido/servirPedido', 'POST', '::1', '2021-06-06 23:07:00'),
(162, 'Jorgitosi', '/pedido/cobrarPedido', 'POST', '::1', '2021-06-06 23:07:13'),
(163, 'Jorgitosi', '/pedido/cobrarPedido', 'POST', '::1', '2021-06-06 23:07:19'),
(164, 'Jorgitosi', '/pedido/', 'POST', '::1', '2021-06-06 23:07:42'),
(165, 'scardozo', '/pedido/prepararPedido', 'POST', '::1', '2021-06-06 23:08:00'),
(166, 'Jorgitosi', '/pedido/servirPedido', 'POST', '::1', '2021-06-06 23:08:22'),
(167, 'Jorgitosi', '/pedido/cobrarPedido', 'POST', '::1', '2021-06-06 23:08:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `codigoMesa` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estadoMesa` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `codigoMesa`, `estadoMesa`, `deleted_at`) VALUES
(1, 'ME01', 'Libre', NULL),
(2, 'ME02', 'Libre', NULL),
(3, 'ME03', 'Libre', NULL),
(4, 'ME04', 'Esperando', NULL),
(5, 'ME05', 'Esperando', NULL),
(6, 'ME06', 'Libre', '2021-06-01 22:08:28'),
(7, 'ME06', 'Esperando', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `estadoPedido` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `codigoPedido` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `codigoMesa` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `producto` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nombreCliente` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `imagen` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tiempo` varchar(11) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `estadoPedido`, `codigoPedido`, `codigoMesa`, `idUsuario`, `producto`, `nombreCliente`, `imagen`, `tiempo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(217, 'Recibido', 'p5xem', 'ME03', 1, '2345', 'Juanas', 'C:\\xampp\\tmp\\php910B.tmp', '1', '2021-06-06 23:19:03', '2021-06-06 23:33:55', '2021-06-06 23:33:55'),
(218, 'Recibido', 'zTz9h', 'ME03', 1, '2345', 'Juanas', 'C:\\xampp\\tmp\\php37EE.tmp', '1', '2021-06-06 23:40:32', '2021-06-06 23:41:35', '2021-06-06 23:41:35'),
(219, 'Cobrado', 'fmeQz', 'ME03', 4, '1,2,3', 'Juanas', 'C:\\xampp\\tmp\\php675A.tmp', '0', '2021-06-06 23:48:21', '2021-06-07 03:01:49', NULL),
(220, 'Cobrado', 'HBOtD', 'ME01', 15, '2345', 'Juanas', 'C:\\xampp\\tmp\\phpA3AB.tmp', '0', '2021-06-07 04:05:17', '2021-06-07 04:07:19', NULL),
(221, 'Cobrado', 'WaMnk', 'ME01', 15, '23453', 'Juanas', 'C:\\xampp\\tmp\\phpDB2D.tmp', '0', '2021-06-07 04:07:42', '2021-06-07 04:08:28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `rol` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `descripcion`, `precio`, `rol`, `deleted_at`) VALUES
(1, 'Coca-Cola', 300, 'Bartender', NULL),
(2, 'Sprite', 250, 'Bartender', NULL),
(3, 'Aquarius', 250, 'Bartender', NULL),
(4, 'Cafe', 100, 'Mozo', NULL),
(5, 'Te', 100, 'Mozo', NULL),
(6, 'Agua', 100, 'Mozo', NULL),
(7, 'Milanesa con Papas Fritas', 800, 'Cocina', NULL),
(8, 'Ojo de Bife con Papas Fritas', 800, 'Cocina', NULL),
(9, 'Asado para dos', 1100, 'Cocina', NULL),
(10, 'Rabas', 400, 'Cocina', NULL),
(11, 'Honey', 300, 'Cervecero', NULL),
(12, 'Red Lagger', 300, 'Cervecero', NULL),
(13, 'IPA', 300, 'Cervecero', NULL),
(40, 'APA', 300, 'Cervecero', NULL),
(43, 'Fanta', 250, 'Bartender', '2021-06-01 21:27:50'),
(44, 'Pepsi', 250, 'Bartender', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pedidos`
--

CREATE TABLE `productos_pedidos` (
  `id` int(11) NOT NULL,
  `codigoPedido` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `idProducto` int(11) NOT NULL,
  `estadoProducto` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos_pedidos`
--

INSERT INTO `productos_pedidos` (`id`, `codigoPedido`, `idProducto`, `estadoProducto`, `deleted_at`) VALUES
(116, 'zTz9h', 2, 'Pendiente', '2021-06-06 23:41:37'),
(117, 'zTz9h', 3, 'Pendiente', '2021-06-06 23:41:37'),
(118, 'zTz9h', 4, 'Pendiente', '2021-06-06 23:41:37'),
(119, 'zTz9h', 5, 'Pendiente', '2021-06-06 23:41:37'),
(120, 'fmeQz', 2, 'Pendiente', '2021-06-06 23:59:19'),
(121, 'fmeQz', 3, 'Pendiente', '2021-06-06 23:59:19'),
(122, 'fmeQz', 4, 'Pendiente', '2021-06-06 23:59:19'),
(123, 'fmeQz', 5, 'Pendiente', '2021-06-06 23:59:19'),
(124, 'fmeQz', 0, 'Pendiente', '2021-06-07 00:00:19'),
(125, 'fmeQz', 123, 'Pendiente', '2021-06-07 00:00:44'),
(126, 'fmeQz', 1, 'Servido', NULL),
(127, 'fmeQz', 2, 'Servido', NULL),
(128, 'fmeQz', 3, 'Servido', NULL),
(129, 'HBOtD', 2, 'Servido', NULL),
(130, 'HBOtD', 3, 'Servido', NULL),
(131, 'HBOtD', 4, 'Servido', NULL),
(132, 'HBOtD', 5, 'Servido', NULL),
(133, 'WaMnk', 2, 'Servido', NULL),
(134, 'WaMnk', 3, 'Servido', NULL),
(135, 'WaMnk', 4, 'Servido', NULL),
(136, 'WaMnk', 5, 'Servido', NULL),
(137, 'WaMnk', 3, 'Servido', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `rol` varchar(11) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `usuario` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `clave` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `rol`, `usuario`, `clave`, `deleted_at`) VALUES
(1, 'Sergio', 'Cardozo', 'Socio', 'scardozo', '1234', NULL),
(2, 'Mariano', 'Madou', 'Socio', 'mmadou', '$2y$10$cSL', NULL),
(3, 'Franco', 'Lippi', 'Socio', 'flippi', '$2y$10$YhB', NULL),
(4, 'Francos', 'Lippis', 'Socio', 'flippis', '1234', NULL),
(5, 'Sergio', 'Cardozo', 'Socio', 'scardozo', '1234', '2021-06-01 18:52:18'),
(6, 'Francos', 'Lippis', 'Socio', 'flippis', '1234', NULL),
(7, 'Jorge', 'Asd', 'Socio', 'Jorgito', '1234', NULL),
(8, 'Jorge', 'Asd', 'Socio', 'Jorgito', '1234', NULL),
(9, 'Jorge', 'Asd', 'Socio', 'Jorgito', '1234', NULL),
(10, 'Jorge', 'Asd', 'Socio', 'Jorgito', '1234', NULL),
(11, 'Jorge', 'Asd', 'Socio', 'Jorgito', '1234', NULL),
(12, 'Jorge', 'Asd', 'Socio', 'Jorgito', '1234', NULL),
(13, 'Jorgea', 'Asds', 'Socio', 'Jorgitos', '1234', NULL),
(14, 'Roberto', 'bolaños', 'Mozo', 'Jorgitos', '1234', NULL),
(15, 'Robertito', 'bolañosito', 'Mozo', 'Jorgitosi', '1234', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigoPedido` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `mesa` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `usuario` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `precioTotal` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigoPedido`, `mesa`, `usuario`, `precioTotal`) VALUES
(11, 'fmeQz', 'ME03', 'flippis', 800),
(12, 'HBOtD', 'ME01', 'Jorgitosi', 700),
(13, 'WaMnk', 'ME01', 'Jorgitosi', 950);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
