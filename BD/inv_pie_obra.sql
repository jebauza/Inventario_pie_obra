# MySQL-Front 5.0  (Build 1.0)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;


# Host: localhost    Database: inv_pie_obra
# ------------------------------------------------------
# Server version 5.5.27

DROP DATABASE IF EXISTS `inv_pie_obra`;
CREATE DATABASE `inv_pie_obra` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inv_pie_obra`;

#
# Table structure for table movimiento
#

CREATE TABLE `movimiento` (
  `idmov` int(11) NOT NULL AUTO_INCREMENT,
  `idobra` varchar(11) NOT NULL DEFAULT '',
  `idproducto` varchar(255) NOT NULL DEFAULT '',
  `numdocumento` int(11) NOT NULL DEFAULT '0',
  `operacion` varchar(255) NOT NULL DEFAULT '',
  `fecha` date DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmov`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `movimiento` VALUES (1,'222259','598612',1,'entrada','2015-05-19',100,1);
INSERT INTO `movimiento` VALUES (2,'222259','598612',2,'entrada','2015-05-19',200,1);
/*!40000 ALTER TABLE `movimiento` ENABLE KEYS */;
UNLOCK TABLES;

#
# Table structure for table obra
#

CREATE TABLE `obra` (
  `id_obra` varchar(11) NOT NULL DEFAULT '',
  `descricion` text,
  `tecnico_obra` varchar(255) DEFAULT NULL,
  `ejecutor_obra` varchar(255) DEFAULT NULL,
  `dirrecion_obra` varchar(255) DEFAULT NULL,
  `fecha_ini` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id_obra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `obra` VALUES ('222259','super tocada','Juana de la caridad','Eduardo','Calle j','2014-01-01','2015-02-09');
/*!40000 ALTER TABLE `obra` ENABLE KEYS */;
UNLOCK TABLES;

#
# Table structure for table producto
#

CREATE TABLE `producto` (
  `id_producto` varchar(11) NOT NULL DEFAULT '',
  `descricion_prod` text,
  `unidad_medida` varchar(255) DEFAULT NULL,
  `precio_mn` decimal(10,2) DEFAULT NULL,
  `precio_cuc` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `producto` VALUES ('598612','Cemento Blamco','m2',31.26,60.32);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

#
# Table structure for table totalprodobra
#

CREATE TABLE `totalprodobra` (
  `idp` varchar(11) NOT NULL DEFAULT '',
  `ido` varchar(255) NOT NULL DEFAULT '',
  `canttotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`idp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `totalprodobra` VALUES ('598612','222259',539);
/*!40000 ALTER TABLE `totalprodobra` ENABLE KEYS */;
UNLOCK TABLES;

#
# Table structure for table transferencia
#

CREATE TABLE `transferencia` (
  `idtrans` int(11) NOT NULL AUTO_INCREMENT,
  `numdocumento` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idproducto` varchar(255) DEFAULT NULL,
  `idobraRetiro` varchar(255) DEFAULT NULL,
  `idobraEntrada` varchar(255) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtrans`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40000 ALTER TABLE `transferencia` ENABLE KEYS */;
UNLOCK TABLES;

#
# Table structure for table usuario
#

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `rol` varchar(255) DEFAULT NULL,
  `activo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
INSERT INTO `usuario` VALUES (1,'Alina','alina','123456','administrador','si');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
