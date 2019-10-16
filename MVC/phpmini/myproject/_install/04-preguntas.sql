use mini;
CREATE TABLE IF NOT EXISTS `pregunta` (
    `id_pregunta` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `asunto` varchar(250) DEFAULT NULL,
    `cuerpo` text,
    `slug` varchar(250) NOT NULL,
    PRIMARY KEY (`id_pregunta`),
    UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `asunto`, `cuerpo`, `slug`) VALUES
(1, 'Pregunta de prueba', 'Esto es una prueba', 'preg1'),
(2, 'Otra pregunta', 'Esto mola!!', 'preg2'),
(3, 'Hola que tal', 'Cuerpo aleatorio', 'preg3'),
(4, 'Y otra más para la saca', 'Cuerpo de la pregunta 4', 'preg4'),
(5, 'Probando slug', 'Pero qué pasa aquí?', 'preg5');
