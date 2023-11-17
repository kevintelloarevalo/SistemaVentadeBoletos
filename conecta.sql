-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 17-11-2023 a las 03:44:26
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conecta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(11, 'General'),
(12, 'Vip  '),
(13, 'Gratis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `nombre` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `dni` int(11) NOT NULL,
  `email` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `nombre`, `apellido`, `dni`, `email`, `telefono`, `direccion`, `fecha_nacimiento`) VALUES
(21, 'Prueba', 'Prueba', 0, 'prueba@gmail.com', '111111111', 'Lima', '2001-05-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idempleado` int(11) NOT NULL,
  `nombre` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `dni` int(8) NOT NULL,
  `telefono` int(11) NOT NULL,
  `trabajo` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `sueldo` int(11) NOT NULL,
  `direccion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `ciudad` text COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `idproveedor`, `idcategoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`) VALUES
(68, 13, 11, 'ENT-001', 'Entrada General', 'vistas/img/productos/ENT-001/777.jpg', 999, 20, 38),
(70, 13, 13, 'ENT-002', 'Entrada Preferente', 'vistas/img/productos/ENT-003/464.jpg', 995, 0, 0),
(71, 13, 13, 'ENT-003', 'Entrada Estudiantil', 'vistas/img/productos/ENT-003/183.jpg', 995, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL,
  `proveedor` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `contacto` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `proveedor`, `contacto`, `telefono`, `direccion`, `fecha`) VALUES
(13, 'Conecta Producciones', 'Milagros Campos Flores', 935776619, 'Jr. Aljovin Miguel Nro. 261 Lima-Lima', '1999-02-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `dni` int(8) NOT NULL,
  `usuario` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `foto` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `dni`, `usuario`, `password`, `perfil`, `foto`, `estado`) VALUES
(9, 'Mayra Aldana Rincón', 1232303, 'mayra@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auW0xx9fDCZntXyTH1.T4AYSljHAY3BD.', 'Administrador', 'vistas/img/usuarios/abigailmostacero@hotmail.com/589.jpg', 1),
(16, 'Thais Aguilar ', 74935117, 'thais@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auPDi5YhiV2xde37OBjJl1gAm6zuUqSnS', 'Administrador', 'vistas/img/usuarios/thais@gmail.com/818.jpg', 1),
(17, 'Pamela Herrera', 55555555, 'pamela@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auBrU/TZuGTB.UZ6jefmuYguKgPA2rvgi', 'Vendedor', 'vistas/img/usuarios/pamela@gmail.com/685.jpg', 1),
(18, 'Mariel Risco', 11111111, 'mariel@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auVkWx9BYEJqOtGjlFNYkQQvRj2zNPQkK', 'Vendedor', 'vistas/img/usuarios/mariel@gmail.com/830.jpg', 1),
(19, 'Luz Vasquez', 77777777, 'luz@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auUhB721lzgIImunAkOaxo68cBpoYDr4u', 'Vendedor', 'vistas/img/usuarios/luz@gmail.com/295.jpg', 1),
(20, 'Jhony Ludeña', 99999999, 'jhony@gmail.com', '$2a$07$asxx54ahjppf45sd87a5autFXLBgdq7x0Aj26rE4coyjVdzzLUjci', 'Vendedor', 'vistas/img/usuarios/jhony@gmail.com/423.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `idvendedor` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `cantidadproductos` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qr` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `observacion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `seguimiento` text COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `idvendedor`, `idcliente`, `cantidadproductos`, `total`, `metodo_pago`, `fecha`, `qr`, `observacion`, `seguimiento`) VALUES
(156, 10000, 9, 21, '[{\"id\":\"70\",\"descripcion\":\"Entrada Preferente\",\"cantidad\":\"1\",\"stock\":\"1000\",\"precio\":\"0\",\"total\":\"0\"}]', 0, 'Gratuito Cortesia', '2023-07-12 18:05:32', '', 'Ninguna Entrada alumno', 'Cortesia'),
(158, 10001, 9, 21, '[{\"id\":\"70\",\"descripcion\":\"Entrada Preferente\",\"cantidad\":\"5\",\"stock\":\"995\",\"precio\":\"0\",\"total\":\"0\"}]', 0, 'Gratuito Cortesia', '2023-07-12 20:31:59', 'Hola Prueba Prueba, separaste las entradas a partir del COD-10001. Recuerda que eres responsable de la lista de entradas asignadas a tu persona.', 'Ninguna', 'Cortesia'),
(159, 10006, 9, 21, '[{\"id\":\"68\",\"descripcion\":\"Entrada General\",\"cantidad\":\"1\",\"stock\":\"999\",\"precio\":\"38\",\"total\":\"38\"}]', 38, 'Efectivo', '2023-07-12 22:08:49', 'Hola Prueba Prueba, separaste las entradas a partir del COD-10006. Recuerda que eres responsable de la lista de entradas asignadas a tu persona.', 'Pago', 'Pagado'),
(161, 10007, 9, 21, '[{\"id\":\"71\",\"descripcion\":\"Entrada Estudiantil\",\"cantidad\":\"5\",\"stock\":\"995\",\"precio\":\"0\",\"total\":\"0\"}]', 0, 'Gratuito Cortesia', '2023-11-17 02:39:19', 'Hola Prueba Prueba, separaste las entradas a partir del COD-10007. Recuerda que eres responsable de la lista de entradas asignadas a tu persona.', 'Son estudiantes', 'Cortesia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idempleado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fk_categoria_productos` (`idcategoria`),
  ADD KEY `fk_proveedor_productos` (`idproveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clienteS` (`idcliente`),
  ADD KEY `fk_vendedorS` (`idvendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idempleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria_productos` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_proveedor_productos` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_clienteS` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`),
  ADD CONSTRAINT `fk_vendedorS` FOREIGN KEY (`idvendedor`) REFERENCES `usuarios` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
