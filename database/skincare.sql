-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2026 a las 00:44:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `skincare`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id`, `pedido_id`, `producto_id`, `cantidad`) VALUES
(1, 1, 2, 1),
(2, 1, 2, 1),
(3, 1, 5, 1),
(4, 1, 2, 1),
(5, 1, 3, 1),
(6, 2, 2, 1),
(7, 2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `total`, `fecha`) VALUES
(1, 1, 1705.00, '2026-05-23 23:07:36'),
(2, 1, 647.00, '2026-05-24 01:30:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `marca` text NOT NULL,
  `ingredientes` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `imagen`, `marca`, `ingredientes`, `descripcion`) VALUES
(1, 'SKIN1004 Aceite Limpiador Ligero de Centella de Madagascar 200 ml', 290.00, 'aceite.jpg', 'SKIN1004', 'Extracto de Centella Asiática\r\nAceite de girasol\r\nAceite de oliva\r\nAceite de jojoba\r\nAceite de bergamota\r\nEthylhexyl Stearate\r\nCetyl Ethylhexanoate', 'Aceite limpiador ligero que elimina maquillaje, protector solar, exceso de grasa e impurezas sin irritar la piel. Su fórmula con Centella Asiática de Madagascar y aceites botánicos ayuda a calmar, hidratar y limpiar profundamente dejando un acabado fresco y no grasoso. Ideal para piel sensible, mixta y acneica'),
(2, 'SKIN1004 Espuma limpiadora de centella de Madagascar 120 ml', 272.00, 'limpiador.jpg', 'SKIN1004', 'Extracto de Centella Asiática\r\nBicarbonato de sodio ultrafino\r\nCoco-betaína\r\nÁcido cítrico\r\nGlicerina', 'Limpiador facial en espuma de textura suave que elimina impurezas y exceso de grasa sin resecar la piel. Ayuda a mantener el equilibrio natural de hidratación mientras calma la irritación y el enrojecimiento. Perfecto para uso diario.'),
(3, 'SKIN1004 Madagascar Centella Asiatica Ampoule 100ml', 375.00, 'serum.jpg', 'SKIN1004', 'Extracto 100% de Centella Asiática', 'Ampoule facial formulada con 100% extracto de Centella Asiática para calmar, hidratar y fortalecer la barrera cutánea. Ayuda a reducir irritaciones, rojeces y brotes de acné dejando la piel más saludable y luminosa.'),
(4, 'SKIN1004 Madagascar Centella Toning Toner 210ml', 402.00, 'toner.jpg', 'SKIN1004', 'Centella Asiática\r\nPHA (Gluconolactona)\r\nNiacinamida\r\nÁcido hialurónico\r\nAdenosina', 'Tónico exfoliante suave que ayuda a remover células muertas e impurezas mientras hidrata y calma la piel. Su fórmula ligera y sin fragancia mejora la textura y luminosidad sin causar irritación.'),
(5, 'Beauty of Joseon Dynasty Cream 100ml ', 514.00, 'cremaj.jpg', 'Beauty of Joseon', 'Agua de salvado de arroz\r\nGinseng\r\nNiacinamida\r\nEscualano\r\nÁcido hialurónico', 'Crema hidratante nutritiva inspirada en la belleza tradicional coreana. Ayuda a mantener la piel hidratada, luminosa y saludable gracias a su mezcla de arroz, ginseng y niacinamida.'),
(6, 'Beauty of Joseon Sérum Glow Deep 30 ml', 399.00, 'serumj.jpg', 'Beauty of Joseon', 'Extracto de arroz\r\nAlpha Arbutin\r\nNiacinamida\r\nGlicerina', 'Sérum iluminador que ayuda a unificar el tono de la piel y disminuir manchas oscuras mientras aporta hidratación y luminosidad.'),
(7, 'Beauty of Joseon Rice Milk Toner tónico facial 150 ml ', 415.00, 'tonerj.jpg', 'Beauty of Joseon', 'Extracto de arroz\r\nAminoácidos de arroz\r\nCeramidas\r\nPantenol', 'Tónico hidratante de textura ligera que nutre, suaviza y mejora la luminosidad de la piel gracias a su contenido de arroz y extractos calmantes.'),
(8, 'SKIN1004 Madagascar Centella Retinol 0.2 Boosting Shot Ampolla 30ml', 403.00, 'retinol.jpg', 'SKIN1004', 'Retinol 0.2%\r\nRetinal\r\nCentella Asiática\r\nCeramidas\r\nPantenol', 'Ampoule anti-edad formulada con retinol y retinal que ayuda a mejorar firmeza, textura y apariencia de líneas finas. Su tecnología Boosting Shot favorece una mejor absorción para resultados visibles.'),
(9, 'Beauty of Joseon Sérum solar de ginseng 50 ml', 373.00, 'ginsenj.jpg', 'Beauty of Joseon', 'Ginseng\r\nNiacinamida\r\nFiltros UV químicos\r\nAdenosina', 'Protector solar en sérum ligero con extracto de ginseng que protege la piel de los rayos UV mientras hidrata y aporta luminosidad sin sensación grasosa.'),
(10, 'Beauty of Joseon Bálsamo limpiador iluminador 100 ml ', 419.00, 'balsamoj.jpg', 'Beauty of Joseon', 'Aceite de arroz\r\nAceite de espino amarillo\r\nExtractos fermentados\r\nVitamina E', 'Bálsamo limpiador que elimina maquillaje e impurezas mientras hidrata y deja la piel suave y luminosa. Se transforma en aceite al contacto con la piel.'),
(11, 'ANUA Tónico facial Rice 70 250 ml', 430.00, 'tonicoa.jpg', 'ANUA', 'Extracto de arroz 70%\r\nNiacinamida\r\nCeramidas\r\nÁcido hialurónico', 'Tónico hidratante con 70% de extracto de arroz que ayuda a iluminar, suavizar e hidratar profundamente la piel.'),
(12, 'ANUA 7+ Rice Ceramide Serum 50 ml', 435.00, 'ceramidaa.jpg', 'ANUA', 'Extracto de arroz\r\nCeramidas\r\nNiacinamida\r\nPantenol', 'Sérum nutritivo enriquecido con arroz y ceramidas que fortalece la barrera cutánea y mejora la hidratación y luminosidad.'),
(13, 'ANUA Polvo limpiador iluminador con enzimas de arroz 40 g', 346.00, 'polvoa.jpg', 'ANUA', 'Enzimas de arroz\r\nAlmidón de arroz\r\nPapaína\r\nCeramidas', 'Limpiador en polvo con enzimas de arroz que exfolia suavemente, limpia los poros y ayuda a mejorar la textura y brillo de la piel.'),
(14, 'ANUA Rice 70 Leche Hidratante Intensiva 150ml ', 259.00, 'lechea.jpg', 'ANUA', 'Extracto de arroz 70%\r\nCeramidas\r\nEscualano\r\nPantenol', 'Loción hidratante ligera con extracto de arroz que nutre profundamente la piel y ayuda a mantenerla suave y luminosa.'),
(15, 'ANUA Mascarilla de colágeno Rice 70 Glow (4 piezas) ', 246.00, 'mascarillaa.jpg', 'ANUA', 'Colágeno\r\nExtracto de arroz\r\nÁcido hialurónico\r\nNiacinamida', 'Mascarilla hidratante e iluminadora con colágeno y arroz que ayuda a mejorar elasticidad, suavidad y luminosidad de la piel.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
