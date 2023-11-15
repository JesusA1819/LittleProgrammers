-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         11.1.2-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para lpstec
CREATE DATABASE IF NOT EXISTS `lpstec` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `lpstec`;

-- Volcando estructura para tabla lpstec.calificaciones
CREATE TABLE IF NOT EXISTS `calificaciones` (
  `ID_Cali` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Calificacion` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Cali`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Tabla dedicada para el almacenamiento de la calificacion del estudiante.';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.carreras
CREATE TABLE IF NOT EXISTS `carreras` (
  `ID_Car` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Carrera` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_Car`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='La carrera de estudio que esta tomando el usuario';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.conexion_t_c
CREATE TABLE IF NOT EXISTS `conexion_t_c` (
  `ID_Conexion_T_C` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ID_Tarea` int(10) unsigned NOT NULL,
  `ID_Matricula` int(8) unsigned zerofill NOT NULL,
  PRIMARY KEY (`ID_Conexion_T_C`) USING BTREE,
  KEY `FK_ID_Tarea` (`ID_Tarea`),
  KEY `FK_ID_Matricula` (`ID_Matricula`),
  CONSTRAINT `FK_ID_Matricula` FOREIGN KEY (`ID_Matricula`) REFERENCES `usuario` (`Matricula`),
  CONSTRAINT `FK_ID_Tarea` FOREIGN KEY (`ID_Tarea`) REFERENCES `tareas` (`ID_Tarea`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci COMMENT='Puente entre las tablas de Usuario y Tareas, siendo una relacion de muchos a muchos.';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.correos
CREATE TABLE IF NOT EXISTS `correos` (
  `ID_Email` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Correo_electronico` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID_Email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Correo electronico de los usuarios';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.documentos
CREATE TABLE IF NOT EXISTS `documentos` (
  `ID_Doc` int(11) NOT NULL,
  `Archivo` text DEFAULT NULL,
  `Ruta` longblob DEFAULT NULL,
  PRIMARY KEY (`ID_Doc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.estados_de_alumnos
CREATE TABLE IF NOT EXISTS `estados_de_alumnos` (
  `ID_Estado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Estado_Alumno` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`ID_Estado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Un marcador para los usuarios que se encuentran activos o inactivos';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.estatus_instruccion
CREATE TABLE IF NOT EXISTS `estatus_instruccion` (
  `ID_Stt` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Stt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.instrucciones
CREATE TABLE IF NOT EXISTS `instrucciones` (
  `ID_Itrccs` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(1000) NOT NULL,
  `Instruccion` varchar(1000) NOT NULL,
  `CalificacionMax` int(11) NOT NULL DEFAULT 0,
  `ID_Stt` int(10) unsigned DEFAULT 1,
  PRIMARY KEY (`ID_Itrccs`),
  KEY `ID_Stt` (`ID_Stt`),
  CONSTRAINT `FK_ID_Stt` FOREIGN KEY (`ID_Stt`) REFERENCES `status_instruccion` (`ID_Stt`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.semestres
CREATE TABLE IF NOT EXISTS `semestres` (
  `ID_Sem` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Semestre` varchar(15) NOT NULL,
  PRIMARY KEY (`ID_Sem`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Semestre de estudio que esta cursando el usuario';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.status_de_entrega
CREATE TABLE IF NOT EXISTS `status_de_entrega` (
  `ID_Status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Estado` varchar(8) NOT NULL,
  PRIMARY KEY (`ID_Status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Permite la activar y desactivar la visualizacion de la actividad.';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.status_instruccion
CREATE TABLE IF NOT EXISTS `status_instruccion` (
  `ID_Stt` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Stt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.tareas
CREATE TABLE IF NOT EXISTS `tareas` (
  `ID_Tarea` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Archivo` varchar(300) DEFAULT NULL,
  `Rutas` longblob NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Tiempo` time DEFAULT NULL,
  `ID_Itrccs` int(10) unsigned DEFAULT NULL,
  `ID_Cali` int(10) unsigned DEFAULT NULL,
  `ID_Status` int(10) unsigned DEFAULT 1,
  PRIMARY KEY (`ID_Tarea`),
  KEY `FK_ID_Itrccs` (`ID_Itrccs`),
  KEY `FK_ID_Calificaciones` (`ID_Cali`),
  KEY `FK_ID_Status` (`ID_Status`),
  CONSTRAINT `FK_ID_Calificaciones` FOREIGN KEY (`ID_Cali`) REFERENCES `calificaciones` (`ID_Cali`),
  CONSTRAINT `FK_ID_Itrccs` FOREIGN KEY (`ID_Itrccs`) REFERENCES `instrucciones` (`ID_Itrccs`),
  CONSTRAINT `FK_ID_Status` FOREIGN KEY (`ID_Status`) REFERENCES `status_de_entrega` (`ID_Status`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Tabla decicada para el registro de actividades o trabajos de los usuarios';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.telefono
CREATE TABLE IF NOT EXISTS `telefono` (
  `ID_Cel` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Telefono` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Cel`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Numero telefonico personal de los usuarios';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla lpstec.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `Matricula` int(8) unsigned zerofill NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellido_P` varchar(30) NOT NULL,
  `Apellido_M` varchar(30) NOT NULL,
  `Contrasena` varchar(50) NOT NULL,
  `Edad` varchar(3) NOT NULL,
  `ID_Cel` int(10) unsigned DEFAULT NULL,
  `ID_Email` int(10) unsigned DEFAULT NULL,
  `ID_Sem` int(10) unsigned DEFAULT NULL,
  `ID_Car` int(10) unsigned DEFAULT NULL,
  `ID_Estado` int(10) unsigned DEFAULT 1,
  PRIMARY KEY (`Matricula`),
  KEY `FK_ID_Cel` (`ID_Cel`),
  KEY `FK_ID_Email` (`ID_Email`),
  KEY `FK_ID_Sem` (`ID_Sem`),
  KEY `FK_ID_Car` (`ID_Car`),
  KEY `FK_ID_Estado` (`ID_Estado`),
  CONSTRAINT `FK_ID_Car` FOREIGN KEY (`ID_Car`) REFERENCES `carreras` (`ID_Car`),
  CONSTRAINT `FK_ID_Cel` FOREIGN KEY (`ID_Cel`) REFERENCES `telefono` (`ID_Cel`),
  CONSTRAINT `FK_ID_Email` FOREIGN KEY (`ID_Email`) REFERENCES `correos` (`ID_Email`),
  CONSTRAINT `FK_ID_Estado` FOREIGN KEY (`ID_Estado`) REFERENCES `estados_de_alumnos` (`ID_Estado`),
  CONSTRAINT `FK_ID_Sem` FOREIGN KEY (`ID_Sem`) REFERENCES `semestres` (`ID_Sem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='Registro general de usuarios';

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
