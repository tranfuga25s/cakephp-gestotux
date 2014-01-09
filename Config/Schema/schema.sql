USE turnera;
CREATE TABLE IF NOT EXISTS `estado_fiscal` ( `id_estado_fiscal` int(11) NOT NULL AUTO_INCREMENT, `titulo` tinytext COLLATE utf8_spanish_ci NOT NULL, PRIMARY KEY (`id_estado_fiscal`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE IF NOT EXISTS `paises` ( `id_pais` bigint(20) NOT NULL AUTO_INCREMENT, `nombre` tinytext COLLATE utf8_spanish_ci NOT NULL, `predeterminado` tinyint(1) NOT NULL DEFAULT '0', PRIMARY KEY (`id_pais`), UNIQUE KEY `nombre_unico` (`nombre`(50)) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE IF NOT EXISTS `provincias` ( `id_provincia` bigint(20) NOT NULL AUTO_INCREMENT, `nombre` tinytext COLLATE utf8_spanish_ci NOT NULL, `predeterminado` tinyint(1) NOT NULL DEFAULT '0', `id_pais` bigint(20) NOT NULL, PRIMARY KEY (`id_provincia`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE IF NOT EXISTS `clientes` ( `id` bigint(10) NOT NULL auto_increment, `razon_social` tinytext NOT NULL, `nombre` tinytext, `apellido` tinytext, `calle` tinytext, `numero` int(2) default NULL, `piso` int(2) default NULL, `depto` tinytext, `ciudad` tinytext, `codigo_postal` tinytext, `provincia` BIGINT(20) NULL DEFAULT NULL, `pais` BIGINT(20) NULL DEFAULT NULL, `tel_fijo` tinytext, `tel_celular` tinytext, `fax` tinytext, `email` tinytext, `comprobante_email` tinyint(1) default '1', `ctacte` tinyint(1) default NULL, `CUIT/CUIL` tinytext default null, `id_estado_fiscal` INT NULL,  FOREIGN KEY (`id_estado_fiscal`) REFERENCES `estado_fiscal`(`id_estado_fiscal`),PRIMARY KEY  (`id`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE IF NOT EXISTS `report` ( `report_id` int(11) NOT NULL AUTO_INCREMENT, `report_name` text, `report_descrip` text NOT NULL, `report_grade` int(11) NOT NULL DEFAULT '0', `report_source` longtext,  PRIMARY KEY (`report_id`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE `clientes` ADD CONSTRAINT `pais_fk` FOREIGN KEY (`pais`) REFERENCES `paises`(`id_pais`);
ALTER TABLE `clientes` ADD CONSTRAINT `provincia_fk` FOREIGN KEY (`provincia`) REFERENCES `provincias`(`id_provincia`);
INSERT INTO `clientes` (`id`, `razon_social`, `nombre` ) VALUES (  0, 'Consumidor Final', 'Consumidor Final'  );
INSERT INTO `estado_fiscal` (`id_estado_fiscal`, `titulo`) VALUES ( 1, 'Responsable Inscripto'), (2, 'Responsable Monotributista'), (3, 'No Responable Inscripto'), (4, 'Exento'), (5, 'Consumidor Final'), (6, 'Monotributista Social'), (7, 'PequeÃƒÂ±o Contribuidor Eventual'), (8, 'PequeÃƒÂ±o Contribuyente Eventual Social' );
CREATE TABLE IF NOT EXISTS `servicios` ( `id_servicio` bigint(20) NOT NULL auto_increment, `nombre` tinytext NOT NULL, `descripcion` text NULL, `fecha_alta` date NOT NULL,  `fecha_baja` date NULL,  `precio_base` decimal(20,3) NOT NULL,  `periodo` int NOT NULL,  `dia_cobro` int NOT NULL,  `forma_incompleto` int NOT NULL,  PRIMARY KEY  (`id_servicio`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE IF NOT EXISTS `servicios_clientes` ( `id_servicio` bigint(20) REFERENCES servicios(id_servicio), `id_cliente` bigint(20) REFERENCES clientes(id), `fecha_alta` DATETIME NOT NULL, `fecha_baja` DATETIME NULL, `razon` TINYTEXT NULL, PRIMARY KEY  (`id_servicio`, `id_cliente` )) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE IF NOT EXISTS `recargos` ( `id_recargo` bigint(20) NOT NULL AUTO_INCREMENT, `id_servicio` bigint(20) NOT NULL,  `cant_dias` int NOT NULL,  `porcentaje` decimal(20,8) DEFAULT NULL,  `recargo` decimal(20,3) DEFAULT NULL,  PRIMARY KEY (`id_recargo`) ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE IF NOT EXISTS `periodo_servicio` ( `id_periodo_servicio` bigint(20) NOT NULL AUTO_INCREMENT, `id_servicio` bigint(20) NOT NULL, `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `periodo` INT NOT NULL, `ano` YEAR NOT NULL, `fecha_inicio` DATE NOT NULL, `fecha_fin` DATE NOT NULL,  FOREIGN KEY ( `id_servicio` ) REFERENCES `servicios`( `id_servicio` ), PRIMARY KEY ( `id_periodo_servicio` )) ENGINE = InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE VIEW IF NOT EXISTS "v_servicios_clientes" AS   SELECT id_servicio, id_cliente, fecha_alta, fecha_baja, razon, id_servicio AS idservicio, id_cliente AS idcliente FROM servicios_clientes;
CREATE TABLE IF NOT EXISTS `conteo_sms` (
  `id_conteo_sms` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `envios` int(10) NOT NULL DEFAULT '0',
  `recibidos` int(10) NOT NULL DEFAULT '0',
  `costo` float(10,4) DEFAULT NULL,
  PRIMARY KEY (`id_conteo_sms`),
  UNIQUE KEY `clientefecha` (`cliente_id`,`fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;