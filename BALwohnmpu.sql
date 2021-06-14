-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-06-2021 a las 00:25:51
-- Versión del servidor: 8.0.13-4
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `BALwohnmpu`
--
CREATE DATABASE IF NOT EXISTS `BALwohnmpu` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `BALwohnmpu`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id` int(10) NOT NULL,
  `codigoPedido` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `puntosMesa` int(10) NOT NULL,
  `puntosMozo` int(10) NOT NULL,
  `puntosRestaurante` int(10) NOT NULL,
  `puntosCocinero` int(10) NOT NULL,
  `comentarios` varchar(66) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id`, `codigoPedido`, `puntosMesa`, `puntosMozo`, `puntosRestaurante`, `puntosCocinero`, `comentarios`) VALUES
(1, '6JQS2', 10, 10, 10, 10, 'Nunca comi tanto en mi vida como hoy'),
(2, 'L2TCJ', 5, 5, 5, 5, 'No vuelvo nunca mas');

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
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `usuario`, `ruta`, `metodo`, `ip`) VALUES
(130, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(131, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(132, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(133, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(134, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(135, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(136, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(137, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(138, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(139, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(140, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(141, 'scardozo', '/productos/7', 'GET', '::1'),
(142, 'scardozo', '/productos/', 'GET', '::1'),
(143, 'scardozo', '/productos/7', 'GET', '::1'),
(144, 'scardozo', '/productos/', 'GET', '::1'),
(145, 'scardozo', '/productos/', 'GET', '::1'),
(146, 'scardozo', '/productos/', 'GET', '::1'),
(147, 'scardozo', '/productos/cargarUnProducto/', 'POST', '::1'),
(148, 'scardozo', '/productos/', 'GET', '::1'),
(149, 'scardozo', '/pedido/', 'GET', '::1'),
(150, 'scardozo', '/mesa/modificarUna/', 'POST', '::1'),
(151, 'scardozo', '/mesa/modificarUna/', 'POST', '::1'),
(152, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(153, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(154, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(155, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(156, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(157, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(158, 'scardozo', '/pedido/prepararPedido', 'POST', '::1'),
(159, 'scardozo', '/pedido/prepararPedido', 'POST', '::1'),
(160, 'scardozo', '/pedido/terminarPedido?codigoPedido=fmeQz', 'POST', '::1'),
(161, 'Jorgitosi', '/pedido/servirPedido', 'POST', '::1'),
(162, 'Jorgitosi', '/pedido/cobrarPedido', 'POST', '::1'),
(163, 'Jorgitosi', '/pedido/cobrarPedido', 'POST', '::1'),
(164, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(165, 'scardozo', '/pedido/prepararPedido', 'POST', '::1'),
(166, 'Jorgitosi', '/pedido/servirPedido', 'POST', '::1'),
(167, 'Jorgitosi', '/pedido/cobrarPedido', 'POST', '::1'),
(168, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(169, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(170, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(171, 'Jorgitosi', '/pedido/terminarPedido?codigoPedido=fmeQz', 'POST', '::1'),
(172, 'Jorgitosi', '/pedido/servirPedido', 'POST', '::1'),
(173, 'Jorgitosi', '/pedido/terminarPedido?codigoPedido=fmeQz', 'POST', '::1'),
(174, 'Jorgitosi', '/pedido/servirPedido', 'POST', '::1'),
(175, 'Jorgitosi', '/pedido/terminarPedido?codigoPedido=fmeQz', 'POST', '::1'),
(176, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(177, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(178, 'Jorgitosi', '/pedido/terminarPedido?codigoPedido=fmeQz', 'POST', '::1'),
(179, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(180, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(181, 'Jorgitosi', '/pedido/terminarPedido?codigoPedido=fmeQz', 'POST', '::1'),
(182, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(183, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(184, 'scardozo', '/mesa/modificarUna/', 'POST', '::1'),
(185, 'scardozo', '/mesa/modificarUna/', 'POST', '::1'),
(186, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(187, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(188, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(189, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(190, 'Jorgitosi', '/pedido/terminarPedido?codigoPedido=fmeQz', 'POST', '::1'),
(191, 'Jorgitosi', '/pedido/servirPedido', 'POST', '::1'),
(192, 'Jorgitosi', '/pedido/servirPedido', 'POST', '::1'),
(193, 'Jorgitosi', '/pedido/cobrarPedido', 'POST', '::1'),
(194, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(195, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(196, 'Jorgitosi', '/pedido/', 'GET', '::1'),
(197, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(198, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(199, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(200, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(201, 'scardozo', '/mesa/modificarUna/', 'POST', '::1'),
(202, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(203, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(204, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(205, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(206, 'scardozo', '/mesa/modificarUna/', 'POST', '::1'),
(207, 'Jorgitosi', '/pedido/', 'POST', '::1'),
(208, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(209, 'Jorgitosi', '/pedido/prepararPedido', 'POST', '::1'),
(210, 'Jorgitosi', '/pedido/servirPedido', 'POST', '::1'),
(211, 'Jorgitosi', '/pedido/cobrarPedido', 'POST', '::1'),
(212, 'Jorgitosi', '/pedido/cobrarPedido', 'POST', '::1'),
(213, 'scardozo', '/usuarios/cargarUno/', 'POST', '::1'),
(214, 'scardozo', '/usuarios/cargarUno/', 'POST', '10.158.177.55'),
(215, 'scardozo', '/usuarios/', 'GET', '10.158.177.55'),
(216, 'scardozo', '/usuarios/1', 'GET', '10.158.177.55'),
(217, 'scardozo', '/productos/7', 'GET', '10.149.172.110'),
(218, 'scardozo', '/productos/', 'GET', '10.149.172.110'),
(219, 'scardozo', '/usuarios/bajaEmpleado/', 'POST', '10.149.172.110'),
(220, 'scardozo', '/productos/bajaProducto/', 'POST', '10.149.172.110'),
(221, 'scardozo', '/mesa/2', 'GET', '10.101.182.164'),
(222, 'scardozo', '/mesa/', 'GET', '10.101.182.164'),
(223, 'scardozo', '/pedido/217', 'GET', '10.99.241.169'),
(224, 'scardozo', '/pedido/227', 'GET', '10.99.241.169'),
(225, 'scardozo', '/pedido/227', 'GET', '10.99.241.169'),
(226, 'scardozo', '/pedido/', 'GET', '10.99.241.169'),
(227, 'scardozo', '/usuarios/cargarUno/', 'POST', '10.51.242.97'),
(228, 'vijua', '/pedido/realizarEncuesta', 'POST', '10.51.242.97'),
(229, 'vijua', '/pedido/realizarEncuesta', 'POST', '10.51.242.97');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `codigoMesa` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estadoMesa` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `codigoMesa`, `estadoMesa`, `deleted_at`) VALUES
(1, 'ME01', 'Libre', NULL),
(2, 'ME02', 'Esperando', NULL),
(3, 'ME03', 'Esperando', NULL),
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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `estadoPedido`, `codigoPedido`, `codigoMesa`, `idUsuario`, `producto`, `nombreCliente`, `imagen`, `tiempo`, `deleted_at`) VALUES
(226, 'Cobrado', 'vOWGC', 'ME02', 15, '2345', 'Juanas', 'C:\\xampp\\tmp\\php47D.tmp', '0', NULL),
(227, 'Recibido', 'rj3e6', 'ME02', 15, '457', 'Juanas', 'C:\\xampp\\tmp\\phpE829.tmp', '1', NULL),
(228, 'En Preparacion', 'L2TCJ', 'ME01', 15, '457', 'Juanas', 'C:\\xampp\\tmp\\php2CE.tmp', '1', NULL),
(229, 'Cobrado', '6JQS2', 'ME01', 15, '457', 'Juanas', 'C:\\xampp\\tmp\\phpFE13.tmp', '0', NULL);

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
(44, 'Pepsi', 250, 'Bartender', NULL),
(45, 'Manaos', 100, ' Bartender\r\n', NULL),
(50, 'Manon', 200, ' Bartender\r\n', NULL),
(51, '7up', 300, ' Mozo\r\n', NULL),
(52, 'Flan', 400, ' Cocinero\r\n', NULL),
(53, 'Helado', 300, ' Cocinero', NULL);

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
(156, 'vOWGC', 2, 'Listo Para Servir', NULL),
(157, 'vOWGC', 3, 'Listo Para Servir', NULL),
(158, 'vOWGC', 4, 'Listo Para Servir', NULL),
(159, 'vOWGC', 5, 'Listo Para Servir', NULL),
(160, 'rj3e6', 4, 'Pendiente', NULL),
(161, 'rj3e6', 5, 'Pendiente', NULL),
(162, 'rj3e6', 7, 'Pendiente', NULL),
(163, 'L2TCJ', 4, 'En Preparacion', NULL),
(164, 'L2TCJ', 5, 'En Preparacion', NULL),
(165, 'L2TCJ', 7, 'Pendiente', NULL),
(166, '6JQS2', 4, 'Servido', NULL),
(167, '6JQS2', 5, 'Servido', NULL),
(168, '6JQS2', 7, 'Servido', NULL);

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
  `estadoEmpleado` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `rol`, `usuario`, `clave`, `estadoEmpleado`, `deleted_at`) VALUES
(1, 'Sergio', 'Cardozo', 'Socio', 'scardozo', '1234', 'Activo', NULL),
(2, 'Mariano', 'Madou', 'Socio', 'mmadou', '$2y$10$cSL', 'Activo', NULL),
(3, 'Franco', 'Lippi', 'Socio', 'flippi', '$2y$10$YhB', 'Activo', NULL),
(14, 'Roberto', 'bolaños', 'Mozo', 'Jorgitos', '1234', 'Inactivo', NULL),
(15, 'Robertito', 'bolañosito', 'Mozo', 'Jorgitosi', '1234', 'Inactivo', NULL),
(16, 'Jorge', 'Fulanito', 'Bartender', 'Jofu', '1234', 'Activo', NULL),
(17, 'Viviana', 'Juarez', 'Mozo', 'vijua', '1234', 'Activo', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigoPedido`, `mesa`, `usuario`, `precioTotal`) VALUES
(11, 'fmeQz', 'ME03', 'flippis', 800),
(12, 'HBOtD', 'ME01', 'Jorgitosi', 700),
(13, 'WaMnk', 'ME01', 'Jorgitosi', 950),
(14, 'vOWGC', 'ME02', 'Jorgitosi', 700),
(15, '6JQS2', 'ME01', 'Jorgitosi', 1000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
