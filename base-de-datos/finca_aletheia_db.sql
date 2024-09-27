-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2022 a las 04:36:15
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `finca_aletheia_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_producto`, `descripcion`, `imagen`, `precio`, `stock`) VALUES
(1, 'Mermelada de durazno', 'Ingredientes: duraznos y azúcar. Contenido neto: 454grs. Vencimiento: marzo 2023.', 'durazno.jpg', 200, 0),
(2, 'Mermelada de ciruela', 'Ingredientes: ciruelas y azúcar. Contenido neto: 454grs. Vencimiento: marzo 2023.', 'ciruela.jpg', 200, 0),
(3, 'Tomate triturado', 'Ingredientes: tomates Elaborado con tomates maduros de estación, estrujados y desemillados a mano. Contenido neto: 950 grs. Vencimiento: marzo 2023.', 'tomates.jpg', 180, 0),
(4, 'Aceite de Oliva extra virgen (Farga)', 'Ingredientes: aceite de oliva extra virgen. Contenido neto: 500 cc. Vencimiento: junio 2023.', 'aceite-farga.jpg', 350, 0),
(5, 'Aceite de Oliva extra virgen (Blend)', 'Ingredientes: aceite de oliva extra virgen. Contenido neto: 500 cc. Vencimiento: junio 2022.', 'aceite-blend.jpg', 350, 0),
(6, 'Aceite de Oliva extra virgen (Blend)', 'Ingredientes: aceite de oliva extra virgen. Contenido neto: 1000 cc. Vencimiento: junio 2022.', 'aceite-blend2.jpg', 600, 0),
(7, 'Aceitunas Verdes (1000 grs.)', 'Ingredientes: aceitunas verdes en salmuera.\r\nContenido neto: 1000 grs. Vencimiento: octubre 2024', 'aceitunas-verdes.jpg', 450, 0),
(8, 'Aceitunas Verdes (2000 grs.)', 'Ingredientes: aceitunas verdes en salmuera. Contenido neto: 2000 grs. Vencimiento: octubre 2024', 'aceitunas-verdes.jpg', 700, 0),
(9, 'Aceitunas Negras', 'Ingredientes: aceitunas negras. Contenido neto: 1000 grs. Vencimiento: septiembre 2024.', 'aceitunas-negras.jpg', 450, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
