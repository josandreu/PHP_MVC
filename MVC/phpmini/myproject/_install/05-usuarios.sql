use mini;
CREATE TABLE IF NOT EXISTS `usuario` (
    `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
    `login` varchar(50) NOT NULL,
    `pass` varchar(250) NOT NULL,
    `nombre` varchar(200) NOT NULL,
    `id_perfil` int(11) NOT NULL,
    `marcador` bigint(20) NOT NULL,
    `token_recordarme` varchar(250) NOT NULL,
    PRIMARY KEY (`id_usuario`),
    UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `login`, `pass`, `nombre`, `id_perfil`, `marcador`, `token_recordarme`) VALUES
(1, 'miguel@desarrolloweb.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Miguel A Alvarez', 1, 216781394851371, 'c4be99126436fa4661ce8130b124d115f1ce659b161099976b1dd9c8d6b1a805'),
(2, 'sara@desarrolloweb.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Sara Alvarez', 1, 379901394849217, '');