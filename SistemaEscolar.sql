-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: sistemacontrolescolar
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `ID_Alumno` varchar(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `ApellidoPaterno` varchar(20) NOT NULL,
  `ApellidoMaterno` varchar(20) NOT NULL,
  `Genero` varchar(1) NOT NULL COMMENT 'M = Masculino\nF = Femenino',
  `FechaNacimiento` date NOT NULL COMMENT 'YYYY-MM-DD',
  `Ciudad` varchar(20) NOT NULL,
  `AlcaldiaMunicipio` varchar(20) NOT NULL,
  `Colonia` varchar(20) NOT NULL,
  `Calle` varchar(20) NOT NULL,
  `Numero` varchar(5) NOT NULL,
  `NumeroInterior` varchar(20) NOT NULL,
  `CodigoPostal` varchar(5) NOT NULL,
  `Email` varchar(63) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Documentacion` varchar(1) NOT NULL COMMENT 'C = Completo\nI = Incompleto',
  `Estado` varchar(1) NOT NULL COMMENT 'I = Inscrito\nN = No Inscrito',
  `Imagen` varchar(255) NOT NULL COMMENT 'URL de la imagen',
  PRIMARY KEY (`ID_Alumno`),
  UNIQUE KEY `ID_Alumno_UNIQUE` (`ID_Alumno`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  CONSTRAINT `alumnos_chk_1` CHECK (regexp_like(`CodigoPostal`,_utf8mb4'^[0-9]+$')),
  CONSTRAINT `alumnos_chk_2` CHECK (regexp_like(`Telefono`,_utf8mb4'^[0-9]+$')),
  CONSTRAINT `chk_documentacion` CHECK ((`Documentacion` in (_utf8mb4'C',_utf8mb4'I'))),
  CONSTRAINT `chk_estado` CHECK ((`Estado` in (_utf8mb4'I',_utf8mb4'N'))),
  CONSTRAINT `chk_genero` CHECK ((`Genero` in (_utf8mb4'F',_utf8mb4'M')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencias`
--

DROP TABLE IF EXISTS `asistencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asistencias` (
  `NumeroAsistencia` int NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Inasistencia` varchar(1) NOT NULL COMMENT '1 = Falta',
  `ID_Alumno` varchar(10) NOT NULL,
  `ID_Materia` varchar(10) NOT NULL,
  `Justificacion` varchar(255) NOT NULL,
  PRIMARY KEY (`NumeroAsistencia`),
  KEY `ID_Alumno_idx` (`ID_Alumno`),
  KEY `ID_Materia_idx` (`ID_Materia`),
  CONSTRAINT `ID_Alumno` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`),
  CONSTRAINT `ID_Materia` FOREIGN KEY (`ID_Materia`) REFERENCES `materias` (`ID_Materia`),
  CONSTRAINT `chk_inasistencia` CHECK (regexp_like(`inasistencia`,_utf8mb4'^[1]+$'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencias`
--

LOCK TABLES `asistencias` WRITE;
/*!40000 ALTER TABLE `asistencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `asistencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autenticacion`
--

DROP TABLE IF EXISTS `autenticacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `autenticacion` (
  `Usuario` varchar(10) NOT NULL,
  `Contraseña` varchar(45) NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`Usuario`),
  UNIQUE KEY `Usuario_UNIQUE` (`Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autenticacion`
--

LOCK TABLES `autenticacion` WRITE;
/*!40000 ALTER TABLE `autenticacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `autenticacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificaciones`
--

DROP TABLE IF EXISTS `calificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calificaciones` (
  `NumeroCalificacion` int NOT NULL AUTO_INCREMENT,
  `Calificacion` varchar(2) NOT NULL,
  `ID_Alumno` varchar(10) NOT NULL,
  `ID_Profesor` varchar(10) NOT NULL,
  `ID_Materia` varchar(10) NOT NULL,
  PRIMARY KEY (`NumeroCalificacion`),
  KEY `fk_calificaciones_alumnos` (`ID_Alumno`),
  KEY `fk_calificaciones_profesores` (`ID_Profesor`),
  KEY `fk_calificaciones_materias` (`ID_Materia`),
  CONSTRAINT `fk_calificaciones_alumnos` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`),
  CONSTRAINT `fk_calificaciones_materias` FOREIGN KEY (`ID_Materia`) REFERENCES `materias` (`ID_Materia`),
  CONSTRAINT `fk_calificaciones_profesores` FOREIGN KEY (`ID_Profesor`) REFERENCES `profesores` (`ID_Profesor`),
  CONSTRAINT `chk_calificacion` CHECK (regexp_like(`Calificacion`,_utf8mb4'^[0-9]+$'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificaciones`
--

LOCK TABLES `calificaciones` WRITE;
/*!40000 ALTER TABLE `calificaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `calificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carreras`
--

DROP TABLE IF EXISTS `carreras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carreras` (
  `ID_Carrera` varchar(10) NOT NULL,
  `Nombre` varchar(63) NOT NULL,
  `CreditosNecesarios` varchar(3) NOT NULL,
  `Semestres` varchar(2) NOT NULL,
  PRIMARY KEY (`ID_Carrera`),
  CONSTRAINT `chk_creditosnecesarios` CHECK (regexp_like(`CreditosNecesarios`,_utf8mb4'^[0-9]+$')),
  CONSTRAINT `chk_semestres` CHECK (regexp_like(`semestres`,_utf8mb4'^[0-9]+$'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carreras`
--

LOCK TABLES `carreras` WRITE;
/*!40000 ALTER TABLE `carreras` DISABLE KEYS */;
/*!40000 ALTER TABLE `carreras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controlescolar`
--

DROP TABLE IF EXISTS `controlescolar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `controlescolar` (
  `Folio` int NOT NULL AUTO_INCREMENT,
  `CicloEscolar` varchar(10) NOT NULL,
  `ID_Grupo` varchar(10) NOT NULL,
  `ID_Salon` varchar(10) NOT NULL,
  `NumeroHorario` int NOT NULL,
  PRIMARY KEY (`Folio`),
  KEY `ID_Grupo_idx` (`ID_Grupo`),
  KEY `ID_Salon_idx` (`ID_Salon`),
  CONSTRAINT `ID_Grupo` FOREIGN KEY (`ID_Grupo`) REFERENCES `grupos` (`ID_Grupo`),
  CONSTRAINT `ID_Salon` FOREIGN KEY (`ID_Salon`) REFERENCES `salones` (`ID_Salon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controlescolar`
--

LOCK TABLES `controlescolar` WRITE;
/*!40000 ALTER TABLE `controlescolar` DISABLE KEYS */;
/*!40000 ALTER TABLE `controlescolar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos` (
  `ID_Grupo` varchar(10) NOT NULL,
  `ID_Materia` varchar(10) NOT NULL,
  `ID_Salon` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Grupo`),
  KEY `ID_Materia_idx` (`ID_Materia`),
  KEY `ID_Salon_idx` (`ID_Salon`),
  CONSTRAINT `fk_grupos_materias` FOREIGN KEY (`ID_Materia`) REFERENCES `materias` (`ID_Materia`),
  CONSTRAINT `fk_grupos_salones` FOREIGN KEY (`ID_Salon`) REFERENCES `salones` (`ID_Salon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horarios` (
  `NumeroHorario` int NOT NULL AUTO_INCREMENT,
  `Hora` time NOT NULL,
  `Dia` varchar(10) NOT NULL,
  `Turno` varchar(1) NOT NULL COMMENT 'M= Matutino\nV = Vespertino',
  PRIMARY KEY (`NumeroHorario`),
  CONSTRAINT `chk_turno` CHECK ((`turno` in (_utf8mb4'M',_utf8mb4'V')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias` (
  `ID_Materia` varchar(10) NOT NULL,
  `Nombre` varchar(63) NOT NULL,
  `ID_Carrera` varchar(10) NOT NULL,
  `Grado` varchar(20) NOT NULL,
  `Creditos` varchar(2) NOT NULL,
  PRIMARY KEY (`ID_Materia`),
  KEY `fk_materias_carreras` (`ID_Carrera`),
  CONSTRAINT `fk_materias_carreras` FOREIGN KEY (`ID_Carrera`) REFERENCES `carreras` (`ID_Carrera`),
  CONSTRAINT `ID_Carrera` FOREIGN KEY (`ID_Materia`) REFERENCES `carreras` (`ID_Carrera`),
  CONSTRAINT `chk_creditos` CHECK (regexp_like(`Creditos`,_utf8mb4'^[0-9]+$'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesores`
--

DROP TABLE IF EXISTS `profesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesores` (
  `ID_Profesor` varchar(10) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `ApellidoPaterno` varchar(20) NOT NULL,
  `ApellidoMaterno` varchar(20) NOT NULL,
  `Genero` varchar(1) NOT NULL COMMENT 'M = Masculino\nF = Femenino',
  `FechaNacimiento` date NOT NULL,
  `Ciudad` varchar(20) NOT NULL,
  `AlcaldiaMunicipio` varchar(20) NOT NULL,
  `Colonia` varchar(20) NOT NULL,
  `Calle` varchar(20) NOT NULL,
  `Numero` varchar(5) NOT NULL,
  `NumeroInterior` varchar(20) NOT NULL,
  `CodigoPostal` varchar(5) NOT NULL,
  `Email` varchar(63) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Cedula` varchar(10) NOT NULL,
  `Estado` varchar(1) NOT NULL COMMENT 'I = Disponible\nN = No inscrito',
  `Imagen` varchar(255) NOT NULL COMMENT 'Url de la imagen',
  PRIMARY KEY (`ID_Profesor`),
  UNIQUE KEY `ID_Profesor_UNIQUE` (`ID_Profesor`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  CONSTRAINT `profesores_chk_1` CHECK (regexp_like(`CodigoPostal`,_utf8mb4'^[0-9]+$')),
  CONSTRAINT `profesores_chk_2` CHECK (regexp_like(`Telefono`,_utf8mb4'^[0-9]+$'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesores`
--

LOCK TABLES `profesores` WRITE;
/*!40000 ALTER TABLE `profesores` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salones`
--

DROP TABLE IF EXISTS `salones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salones` (
  `ID_Salon` varchar(10) NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `Disponibilidad` varchar(1) NOT NULL COMMENT 'D = Disponible\nN = No Disponible',
  `Capacidad` varchar(3) NOT NULL,
  `Descripcion` varchar(64) NOT NULL,
  PRIMARY KEY (`ID_Salon`),
  CONSTRAINT `chk_Capacidad` CHECK (regexp_like(`Capacidad`,_utf8mb4'^[0-9]+$')),
  CONSTRAINT `chk_Disponibilidad` CHECK ((`Disponibilidad` in (_utf8mb4'D',_utf8mb4'N')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salones`
--

LOCK TABLES `salones` WRITE;
/*!40000 ALTER TABLE `salones` DISABLE KEYS */;
/*!40000 ALTER TABLE `salones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-01 18:59:16
