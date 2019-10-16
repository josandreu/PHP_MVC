use mini;
CREATE TABLE IF NOT EXISTS `respuesta` (
 `id_respuesta` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `id_pregunta` int(10) NOT NULL,
 `id_usuario` int(11) not null ,
 `respuesta` varchar(250) DEFAULT NULL,
 PRIMARY KEY (`id_respuesta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;