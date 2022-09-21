-- MySQL dump 10.11
--
-- Host: localhost    Database: sicopre
-- ------------------------------------------------------
-- Server version	5.0.77-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accion`
--

DROP TABLE IF EXISTS `accion`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `accion` (
  `id` int(11) NOT NULL auto_increment,
  `actividad_id` int(11) NOT NULL,
  `nombreAccion` text,
  `claveAccion` int(11) default NULL,
  `unidad` varchar(150) NOT NULL,
  `cantidad` varchar(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `accion`
--

LOCK TABLES `accion` WRITE;
/*!40000 ALTER TABLE `accion` DISABLE KEYS */;
INSERT INTO `accion` VALUES (1,1,'PARA EL 2009, INCREMENTAR DEL 0% AL 45% LOS ESTUDIANTES EN PROGRAMAS EDUCATIVOS DE LICENCIATURA RECONOCIDOS O ACREDITADOS POR SU CALIDAD',1,'ESTUDIANTES EN PROGRAMAS DE EDUCACION SUPERIOR QUE','1461'),(2,3,'LOGRAR AL 2009 QUE EL 43.29% DE LOS PROFESORES DE TIEMPO COMPLETO CUENTEN CON ESTUDIOS DE POSGRADO',2,'PROFESORES DE TIEMPO COMPLETO CON POSGRADO','42'),(3,1,'ALCANZAR EN EL 2009 UNA EFICIENCIA TERMINAL (EFICIENCIA DE EGRESO) DEL 35% EN LOS PROGRAMAS EDUCATIVOS DE LICENCIATURA',3,'EFICIENCIA DE EGRESO','35%'),(4,18,'PARA EL 2009 INCREMENTAR DEL 13 A 15 LOS ESTUDIANTES EN PROGRAMAS RECONOCIDOS EN EL PROGRAMA NACIONAL DE POSGRADO DE CALIDAD (PNPC)',4,'ESTUDIANTES EN PROGRAMAS DE POSGRADO EN EL PNPC','15'),(5,18,'LOGRAR EN EL 2009 UNA EFICIENCIA TERMINAL DEL 50%EN LOS PROGRAMAS EDUCATIVOS DE POSGRADO',5,'EGRESADOS CON GRADO','50%'),(6,3,'PARA EL 2009, INCREMENTAR A 10 PROFESORES DE TIEMPO COMPLETO CON RECONOCIMIENTO DEL PERFIL DESEABLE ',6,'PROFESORES DE TIEMPO COMPLETO CON PERFIL DESEABLE','10'),(7,11,'PARA EL 2009 EL INSTITUTO MANTIENE CERTIFICADO SU PROCESO EDUCATIVO CONFORME A LA NORMA ISO9001:2000. Y SU CERTIFICACION EN LA NORMA ISO 14001:2004',7,'CERTIFICADOS ','1'),(8,2,'LOGRAR AL 2009 QUE EL 32% DE INVESTIGADORES DEL INSTITUTO SE INTEGREN A REDES DE INVESTIGACION PARA APROVECHAR LA CAPACIDAD DEL SISTEMA EN PROYECTOS EN PROYECTOS INTERINSTITUCIONALES DE GRAN IMPACTO',8,'INVESTIGADORES EN REDES DE INVESTIGACION','8'),(9,3,'LOGRAR AL 2009 INCORPORAR A 4 PROFESORES A ESTUDIAR EN PROGRAMAS DE POSGRADO RECONOCIDOS NACIONAL E INTERNACIONALMENTE, PARA FORTALECER LA PLANTA DOCENTE Y DE INVESTIGACION Y DE MEJORA LA CALIDAD DEL PROCESO EDUCATIVO',9,'PROFESORES EN PROGRAMAS DE POSGRADO ','4'),(10,18,'PARA EL 2009, 1 ESTUDIANTE DEL INSTITUTO SE INCORPORA A PROGRAMAS DE POSGRADO RECONOCIDOS INTERNACIONALMENTE, PARA FACILITAR LA MOVILIDAD E INTERCAMBIO DE ESTUDIANTES Y PROFESORES CON PROGRAMAS RELACIONADOS EN OTROS PAISES',10,'ESTUDIANTES EN PROGRAMAS DE POSGRADO RECONOCIDOS I','1'),(11,18,'PARA EL 2009, CREAR UN NUEVO CUERPO ACADEMICO EN  EL INSTITUTO, PARA FORTALECER LA INVESTIGACION Y MEJORAR LA CALIDAD DE LOS PROGRAMAS EDUCATIVOS',11,'CUERPO ACADEMICO','1'),(12,3,'LOGRAR AL 2009, INCREMENTAR A 50% LA PLANTA DE PROFESORES QUE PARTICIPAN EN EVENTOS DE FORMACION Y ACTUALIZACION PROFESIONAL, PARA COADYUVAR SU DESARROLLO INTEGRAL',12,'No. PROFESORES EN EVENTOS DE FORMACION Y ACTUALIZA','105'),(13,1,'LOGRAR AL 2009 INCORPORAR AL INSTITUTO AL ESPACIO COMUN DE LA EDUCACION SUPERIOR DEL PAIS, PARA ASEGURAR LA COMPARABILIDAD DE LOS PROGRAMAS Y GARANTIZAR LA MOVILIDAD DE LOS ESTUDIANTES ',13,'ESPACIO COMUN','1'),(14,13,'LOGRAR AL 2009, INCREMENTAR DEL 12.62% AL 15% LOS ESTUDIANTES APOYADOS EN EL PRONABES',14,'ESTUDIANTES BECARIOS DEL PRONABES ','386'),(15,1,'LOGRAR PARA EL 2009, INCREMENTAR DE 2854 A 3248  ESTUDIANTES LA MATRICULA DE LICENCIATURA  ',15,'ESTUDIANTES EN MODALIDAD ESCOLARIZADA','3248'),(16,18,'LOGRAR PARA EL 2009, QUE EL 42% DE LOS ESTUDIANTES DE POSGRADO OBTENGAN UNA BECA',16,'ESTUDIANTES CON BECA DE POSGRADO','42%'),(17,2,'PARA EL 2009, INCREMENTAR 200 ESTUDIANTES LA MATRICULA EN PROGRAMAS NO PRESENCIALES',17,'ESTUDIANTES EN MODALIDAD NO PRESENCIAL ','200'),(18,2,'ALCANZAR EN EL 2009, INCREMENTAR DE 15 A 35 LA MATRICULA DE ESTUDIANTES EN POSGRADO',18,'ESTUDIANTES EN POSGRADO','35'),(19,1,'LOGRAR AL 2009 LA REALIZACION DEL 35% DE LAS PRACTICAS DE TALLERES Y LABORATORIO CONSIGNADAS EN LOS PROGRAMAS DE ESTUDIO, PARA COADYUBAR A LA ARTICULACION DE LA TEORIA CON LA PRACTICA DE LOS ESTUDIANTES Y APROVECHAR AL MAXIMO EL EQUIPAMIENTO DISPONIBLE EN EL INSTITUTO ',19,'PRACTICAS DE LABORATORIOS Y TALLERES ','35'),(21,8,'PARA EL 2009, SE TENGAN 12 COMPUTADORAS CONECTADAS A INTERNET EN CENTRO DE INFORMACION',20,'NUMERO DE COMPUTADORAS CONECTADAS A INTERNET EN LA','12'),(22,8,'PARA EL 2009, INCREMENTAR DEL 19% AL 32% LAS AULAS EQUIPADAS CON TIC´S ',22,'AULAS EQUIPADAS','32'),(23,8,'PARA EL 2009, INCREMETAR LA INFRAESTRUCTURA EN COMPUTO PARA LOGRAR UN INDICADOR DE 10  ESTUDIANTES POR COMPUTADORA',21,'ESTUDIANTES POR COMPUTADORA','10'),(24,8,'LOGRAR PARA EL 2009, SE TENGA 1 COMPUTADORA CONECTADAS A INTERNET II EN EL INSTITUTO',23,'NUMERO DE COMPUTADORAS CONECTADAS A INTERNET II EN','1'),(25,3,'LOGRAR AL 2009, SE CUENTE CON UN PROGRAMA EDUCATIVO DE LICENCIATURA ORIENTADO AL DESARROLLO DE COMPETENCIAS PROFESIONALES',24,'PROGRAMAS EDUCATIVOS ACTUALIZADOS CON ENFOQUE AL D','1'),(26,9,'PARA EL 2009, LOGRAR QUE EL 75% DE LOS ESTUDIANTES PARTICIPEN EN ACTIVIADADES CULTURALES, CIVICAS, DEPORTIVAS Y RECREATIVAS',25,'ESTUDIANTES QUE PARTICIPEN EN ACTIVIDADES DEPORTIV','1948'),(27,1,'PARA EL 2009 INCREMENTAR DEL 6.3% AL 8% LOS ESTUDIANTES QUE PARTICIPEN EN EVENTOS DE CREATIVIDAD, EMPRENDEDORES Y CIENCIAS BASICAS',26,'ESTUDIANTES QUE PARTICIPEN EN EVENTOS DE CREATIVID','8%'),(28,1,'PARA EL 2009, QUE EL 30% DE ESTUDIANTES, DESARROLLEN COMPETENCIAS EN UNA SEGUNDA LENGUA',27,'ESTUDIANTES QUE DESARROLLAN COMPETENCIAS DE UNA SE','30%'),(29,4,'PARA EL 2009, LOGRAR QUE EL 35% DE LOS ESTUDIANTES REALICEN SERVICIO SOCIAL EN PROGRAMAS DE INTERES PUBLICO Y DESARROLLO COMUNITARIO',28,'ESTUDIANTES REALIZANDO SERVICIO SOCIAL','35%'),(30,4,'LOGRAR AL 2009, QUE EL 15% DE LOS ESTUDIANTES REALICEN SU PROYECTO DE RESIDENCIA PROFESIONAL PREFECTAMENTE HACIA LA VOCACION PRODUCTIVA DE LA REGION, PARA COADYUVAR A SU FORMACION PROFESIONAL Y FACILITAR SU TRANCITO AL MERCADO LABORAL ',29,'ESTUDIANTES RESIDENTES','15%'),(31,4,'PARA EL 2009, EL INSTITUTO TENDRA 100% CONFORMADO Y EN OPERACION SU CONSEJO DE VINCULACION',30,'CONSEJO DE VINCULACION','1'),(32,2,'LOGRAR AL 2009, INCREMENTAR DE 6 A 8 PROFESORES INVESTIGADORES QUE ESTEN INCORPORADOS AL SISTEMA NACIONAL DE INVESTIGADORES, PARA FORTALECER LA PLANTA DE INVESTIGACION  Y SU IMPACTO EN LA FORMACION DE PROFESORES DE ALTO NIVEL',31,'INVESTIGADORES EN EL SNI','8'),(33,4,'A PARTIR DEL 2009, SE OPERA EL PROCEDIMIENTO TECNICO ADMINISTRATIVO PARA DAR SEGUIMIENTO AL 20% DE LOS EGRESADOS ',32,'EGRESADOS UBICADOS','152'),(34,4,'PARA EL 2009, OBTENER 2 REGISTROS DE PROPIEDAD INTELECTUAL',33,'REGISTROS OTORGADOS POR EL IMPI','2'),(35,4,'PARA EL 2009, TENER UNA EMPRESA INCUBADA EN EL INSTITUTO',34,'EMPRESA INCUBADA','1'),(36,2,'LOGRAR AL 2009, QUE EL 4%DE LOS ESTUDIANTES DE LA LICENCIATURA TOMEN PARTE EN PROYECTOS DE INVESTIGACION TECNOLOGICA Y EDUCATIVA, PARA CONTRIBUIR AL DESARROLLO DE LOS DIFERENTES SECTORES PRODUCTIVOS DE SU LOCALIDAD ',35,'ESTUDIANTES EN PROYECTOS DE INVESTIGACION','130'),(37,7,'A PARTIR DEL 2009, EL INSTITUTO PARTICIPARA EN EL 100% DE LAS CONVOCATORIAS DEL PROGRAMA DE FORTALECIMIENTO INSTITUCIONAL ',36,'PROGRAMA','1'),(38,7,'LOGRAR AL 2009, LA ENTREGA ANUAL DEL INFORME DE RENDICION DE CUENTAS DEL INSTITUTO CON OPORTUNIDAD Y VERACIDAD',37,'INFORME DE RENDICION DE CUENTAS','1'),(40,6,'A PARTIR DEL 2009, EL INSTITUTO REALIZARA UN DIAGNOSTICO DE INFRAESTUCTURA EDUCATIVA',40,'DIAGNOSTICO DE LA INFRAESTRUCTURA EDUCATIVA|','1'),(41,6,'PARA EL 2009, SE INTEGRARA EL PLAN MAESTRO DE DESARROLLO Y CONSOLIDACION DE LA INFRAESTRUCTURA EDUCATIVA',39,'PLAN MAESTRO DE DESARROLLO DE LA INFRAESTRUCTURA A','100%'),(42,12,'LOGRAR PARA EL 2009, QUE EL 100% DE LOS DIRECTIVOS, FUNCIONARIOS DOCENTES Y PERSONAL DE APOYO Y ASISTENCIA A LA EDUCACION DEL INSTITUTO PARTICIPEN EN EVENTOS DE FORMACION Y ACTUALIZACION PROFESIONAL PARA COADYUVAR A SU DESARROLLO INTEGRAL.',38,'DIRECTIVOS, FUNCIONARIOS DOCENTES Y PERSONAL DE APOYO Y ASISTENCIA A LA EDUCACION ','62');
/*!40000 ALTER TABLE `accion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accion_apoa`
--

DROP TABLE IF EXISTS `accion_apoa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `accion_apoa` (
  `idmeta_apoa` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `nombreAccion` text,
  `claveAccion` int(11) default NULL,
  `unidad` varchar(50) NOT NULL,
  `cantidad` varchar(11) NOT NULL,
  `meta` varchar(10) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`idmeta_apoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `accion_apoa`
--

LOCK TABLES `accion_apoa` WRITE;
/*!40000 ALTER TABLE `accion_apoa` DISABLE KEYS */;
/*!40000 ALTER TABLE `accion_apoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accion_poa`
--

DROP TABLE IF EXISTS `accion_poa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `accion_poa` (
  `idmeta_apoa` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `nombreAccion` text,
  `claveAccion` int(11) default NULL,
  `unidad` varchar(50) NOT NULL,
  `cantidad` varchar(11) NOT NULL,
  `meta` varchar(10) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`idmeta_apoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `accion_poa`
--

LOCK TABLES `accion_poa` WRITE;
/*!40000 ALTER TABLE `accion_poa` DISABLE KEYS */;
/*!40000 ALTER TABLE `accion_poa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actividad`
--

DROP TABLE IF EXISTS `actividad`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `actividad` (
  `id` int(11) NOT NULL auto_increment,
  `proceso_id` int(11) NOT NULL,
  `nombreactiv` varchar(100) default NULL,
  `claveActiv` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
INSERT INTO `actividad` VALUES (1,1,'FORMACION PROFESIONAL',1),(2,1,'INVESTIGACION  ',2),(3,1,'DESARROLLO PROFESIONAL',3),(4,2,'VINCULACION INSTITUCIONAL',1),(5,2,'DIFUSION Y DIVULGACION',2),(6,3,'PROGRAMACION PRESUPUESTAL Y ESTRUCTURA FISICA',1),(7,3,'PLANEACION ESTRATEGICA Y TACTICA DE ORG.',2),(8,3,'SOPORTE TECNICO EN COMPUTO Y TELECOMUNICACIONES',3),(9,3,'DIFUSION CULTURAL Y DEPORTIVA',4),(10,4,'ASEGURAMIENTO DE LA CALIDAD',1),(11,4,'GESTION DE LA CALIDAD',2),(12,4,'CAPACITCION Y DESARROLLO',3),(13,4,'SERVICIOS ESCOLARES',4),(14,5,'ADMINISTRACION D RECURSOS FINANCIEROS',1),(15,5,'ADMINISTRACION DE RECURSOS HUMANOS',2),(16,5,'APOYO JURIDICO',3),(17,5,'ADMINISTRACION DE RECURSOS MATERIALES Y SERVICIOS',4),(18,1,'ESTUDIOS DE POSGRADO',2);
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bienservicio`
--

DROP TABLE IF EXISTS `bienservicio`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bienservicio` (
  `idbienservicio` int(11) NOT NULL auto_increment,
  `cantidad` int(11) NOT NULL,
  `unidad` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `idrequisicion` int(11) NOT NULL,
  PRIMARY KEY  (`idbienservicio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `bienservicio`
--

LOCK TABLES `bienservicio` WRITE;
/*!40000 ALTER TABLE `bienservicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `bienservicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dpto`
--

DROP TABLE IF EXISTS `dpto`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `dpto` (
  `id` int(11) NOT NULL auto_increment,
  `nombretitular` varchar(200) default NULL,
  `puesto` varchar(200) default NULL,
  `nombredpto` varchar(200) default NULL,
  `estado` tinyint(1) default NULL,
  `clavedpto` int(11) default NULL,
  `abreviatura` varchar(20) NOT NULL,
  `tiposub` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `dpto`
--

LOCK TABLES `dpto` WRITE;
/*!40000 ALTER TABLE `dpto` DISABLE KEYS */;
INSERT INTO `dpto` VALUES (1,'DIRECCION','DIRECTOR','DIRECCION',1,1,'Direccion',4),(2,'ENCARGADO DE LA SUBDIRECCIÓN DE PLANEACIÓN','JEFE DE DEPARTAMENTO','ENCARGADO DE LA SUBDIRECCIÓN DE PLANEACIÓN',1,2,'Sub. Planea.',1),(3,'ENCARGADO DE LA SUBDIRECCIÓN ACADÉMICA','JEFE DE DEPARTAMENTO','ENCARGADO DE LA SUBDIRECCIÓN ACADÉMICA',1,3,'Sub. Aca.',2),(4,'SUBDIRECCIÓN DE SERVICIOS ADMINISTRATIVOS','JEFE DE DEPARTAMENTO','SUBDIRECCIÓN DE SERVICIOS ADMINISTRATIVOS',1,4,'Sub. Admin.',3),(5,'PLANEACIÓN, PROGRAMACIÓN Y PRESUPUESTACIÓN','JEFE DE DEPARTAMENTO','PLANEACIÓN, PROGRAMACIÓN Y PRESUPUESTACIÓN',1,5,'Planeacion',1),(6,'GESTIÓN TECNOLÓGICA Y VINCULACIÓN','JEFE DE DEPARTAMENTO','GESTIÓN TECNOLÓGICA Y VINCULACIÓN',1,6,'Gestion',1),(7,'COMUNICACIÓN Y DIFUSIÓN','JEFE DE DEPARTAMENTO','COMUNICACIÓN Y DIFUSIÓN',1,7,'Comunicacion',1),(8,'ENCARGADO DE ACTIVIDADES EXTRAESCOLARES','JEFE DE DEPARTAMENTO','ENCARGADO DE ACTIVIDADES EXTRAESCOLARES',1,8,'Extraescolares',1),(9,'SERVICIOS ESCOLARES','JEFE DE DEPARTAMENTO','SERVICIOS ESCOLARES',1,9,'Escolares',1),(10,'CENTRO DE INFORMACIÓN ','JEFE DE DEPARTAMENTO','CENTRO DE INFORMACIÓN ',1,10,'Informacion',1),(11,'CIENCIAS BÁSICAS','JEFE DE DEPARTAMENTO','CIENCIAS BÁSICAS',1,11,'Basicas',2),(12,'SISTEMAS COMPUTACIONALES','JEFE DE DEPARTAMENTO','SISTEMAS COMPUTACIONALES',1,12,'Sistemas',2),(13,'METAL MECÁNICA','JEFE DE DEPARTAMENTO','METAL MECÁNICA',1,13,'Mecanica',2),(14,'QUÍMICA Y BIOQUÍMICA','JEFE DE DEPARTAMENTO','QUÍMICA Y BIOQUÍMICA',1,14,'Qui y Bio',2),(15,'INGENIERIA INDUSTRIAL','JEFE DE DEPARTAMENTO','INGENIERIA INDUSTRIAL',1,15,'Industrial',2),(16,'ELÉCTRICA Y ELECTRÓNICA','JEFE DE DEPARTAMENTO','ELÉCTRICA Y ELECTRÓNICA',1,16,'Ele y Eca',2),(17,'CIENCIAS ECONÓMICO-ADMINISTRATIVO','JEFE DE DEPARTAMENTO','CIENCIAS ECONÓMICO-ADMINISTRATIVO',1,17,'Informatica',2),(18,'ENCARGADA DE DESARROLLO ACADÉMICO','JEFE DE DEPARTAMENTO','ENCARGADA DE DESARROLLO ACADÉMICO',1,18,'Desarr. Aca.',2),(19,'DIVISIÓN DE ESTUDIOS  PROFESIONALES','JEFE DE DEPARTAMENTO','DIVISIÓN DE ESTUDIOS  PROFESIONALES',1,19,'Div. Estudios',2),(20,'ENCARGADO DE LA DIV. DE EST DE POSG E INVESTIGACIÓN','JEFE DE DEPARTAMENTO','ENCARGADO DE LA DIV. DE EST DE POSG E INVESTIGACIÓN',1,20,'Investigacion',2),(21,'RECURSOS HUMANOS','JEFE DE DEPARTAMENTO','RECURSOS HUMANOS',1,21,'Humanos',3),(22,'RECURSOS FINANCIEROS','JEFE DE DEPARTAMENTO','RECURSOS FINANCIEROS',1,22,'Financieros',3),(23,'RECURSOS MATERIALES','JEFE DE DEPARTAMENTO','RECURSOS MATERIALES',1,23,'Materiales',3),(24,'CENTRO DE CÓMPUTO','JEFE DE DEPARTAMENTO','CENTRO DE CÓMPUTO',1,24,'Computo',3);
/*!40000 ALTER TABLE `dpto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firmas_reportes`
--

DROP TABLE IF EXISTS `firmas_reportes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `firmas_reportes` (
  `id` int(11) NOT NULL auto_increment,
  `nombre_director` varchar(60) NOT NULL,
  `nombre_general` varchar(60) NOT NULL,
  `rfc_director` varchar(15) NOT NULL,
  `rfc_general` varchar(15) NOT NULL,
  `nombre_subplanea` varchar(150) NOT NULL,
  `nombre_subaca` varchar(150) NOT NULL,
  `nombre_subadmon` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `firmas_reportes`
--

LOCK TABLES `firmas_reportes` WRITE;
/*!40000 ALTER TABLE `firmas_reportes` DISABLE KEYS */;
INSERT INTO `firmas_reportes` VALUES (1,'DIRECTOR DEL PLANTEL','DR. CARLOS ALFONSO GARCIA IBARRA','RFC-DIRECTOR','GAIC-580123-BAO','SUBDIRECTOR PLANEACION','SUBDIRECTOR ACADEMICO','SUBDIRECTOR ADMINISTRATIVO');
/*!40000 ALTER TABLE `firmas_reportes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos_dpto`
--

DROP TABLE IF EXISTS `gastos_dpto`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `gastos_dpto` (
  `idgastos` int(11) NOT NULL auto_increment,
  `oficio` int(11) default NULL,
  `iddpto` char(19) default NULL,
  `documento` char(13) default NULL,
  `justificacion` char(41) default NULL,
  `fecha` date default NULL,
  `iddpto_solicitante` char(20) default NULL,
  `idproceso` int(11) default NULL,
  `idclave` int(11) NOT NULL,
  `idmeta` int(11) default NULL,
  `idaccion` int(11) NOT NULL,
  `monto` char(15) default NULL,
  `idpartida` int(11) default NULL,
  `donde` char(15) default NULL,
  `idrequisicion` int(11) NOT NULL,
  `idsolicitud` int(11) NOT NULL,
  `idviaticos` int(11) NOT NULL,
  PRIMARY KEY  (`idgastos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `gastos_dpto`
--

LOCK TABLES `gastos_dpto` WRITE;
/*!40000 ALTER TABLE `gastos_dpto` DISABLE KEYS */;
/*!40000 ALTER TABLE `gastos_dpto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_bienservicio`
--

DROP TABLE IF EXISTS `historial_bienservicio`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `historial_bienservicio` (
  `id` int(11) NOT NULL auto_increment,
  `idbienservicio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad` varchar(30) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `idrequisicion` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `historial_bienservicio`
--

LOCK TABLES `historial_bienservicio` WRITE;
/*!40000 ALTER TABLE `historial_bienservicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_bienservicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_gastos_dpto`
--

DROP TABLE IF EXISTS `historial_gastos_dpto`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `historial_gastos_dpto` (
  `id` int(11) NOT NULL auto_increment,
  `idgastos` int(11) NOT NULL,
  `oficio` int(11) default NULL,
  `iddpto` char(19) default NULL,
  `documento` char(13) default NULL,
  `justificacion` char(41) default NULL,
  `fecha` date default NULL,
  `iddpto_solicitante` char(20) default NULL,
  `idproceso` int(11) default NULL,
  `idclave` int(11) NOT NULL,
  `idmeta` int(11) default NULL,
  `idaccion` int(11) NOT NULL,
  `monto` char(15) default NULL,
  `idpartida` int(11) default NULL,
  `donde` char(15) default NULL,
  `idrequisicion` int(11) NOT NULL,
  `idsolicitud` int(11) NOT NULL,
  `idviaticos` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `historial_gastos_dpto`
--

LOCK TABLES `historial_gastos_dpto` WRITE;
/*!40000 ALTER TABLE `historial_gastos_dpto` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_gastos_dpto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_requisicion`
--

DROP TABLE IF EXISTS `historial_requisicion`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `historial_requisicion` (
  `id` int(11) NOT NULL auto_increment,
  `numero` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idpartida` int(11) NOT NULL,
  `nota` varchar(150) NOT NULL,
  `idproceso` int(11) NOT NULL,
  `idclave` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `idaccion` int(11) NOT NULL,
  `iddpto` int(11) NOT NULL,
  `planea` int(11) NOT NULL,
  `idsolicitud` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `idrequisicion` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `historial_requisicion`
--

LOCK TABLES `historial_requisicion` WRITE;
/*!40000 ALTER TABLE `historial_requisicion` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_requisicion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_solicitud_servicio`
--

DROP TABLE IF EXISTS `historial_solicitud_servicio`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `historial_solicitud_servicio` (
  `id` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `vigencia` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `rfc` varchar(30) NOT NULL,
  `domicilio` varchar(150) NOT NULL,
  `idpartida` int(11) NOT NULL,
  `forma_pago` varchar(50) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `planea` int(1) NOT NULL,
  `requisicion` varchar(150) NOT NULL,
  `iddpto` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `idaccion` int(11) NOT NULL,
  `nota` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `idsolicitud` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `historial_solicitud_servicio`
--

LOCK TABLES `historial_solicitud_servicio` WRITE;
/*!40000 ALTER TABLE `historial_solicitud_servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_solicitud_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_viaticos`
--

DROP TABLE IF EXISTS `historial_viaticos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `historial_viaticos` (
  `id` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  `comisionado` varchar(100) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `clave` varchar(30) NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `periodo` varchar(100) NOT NULL,
  `cuota` int(11) NOT NULL,
  `dias` float NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `pago` int(1) NOT NULL,
  `jerarquico` int(1) NOT NULL,
  `zona` int(1) NOT NULL,
  `iddpto` int(11) NOT NULL,
  `idpartida` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `planea` int(1) NOT NULL,
  `nota` varchar(200) NOT NULL,
  `idviaticos` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `historial_viaticos`
--

LOCK TABLES `historial_viaticos` WRITE;
/*!40000 ALTER TABLE `historial_viaticos` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_viaticos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insumo`
--

DROP TABLE IF EXISTS `insumo`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `insumo` (
  `id` int(11) NOT NULL auto_increment,
  `descinsu` varchar(100) NOT NULL,
  `medida` varchar(30) NOT NULL,
  `costuni` decimal(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `partida_id` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `insumo`
--

LOCK TABLES `insumo` WRITE;
/*!40000 ALTER TABLE `insumo` DISABLE KEYS */;
/*!40000 ALTER TABLE `insumo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insumo_apoa`
--

DROP TABLE IF EXISTS `insumo_apoa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `insumo_apoa` (
  `idinsumo_apoa` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL,
  `descinsu` varchar(100) NOT NULL,
  `medida` varchar(30) NOT NULL,
  `costuni` decimal(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `partida_id` int(10) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`idinsumo_apoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `insumo_apoa`
--

LOCK TABLES `insumo_apoa` WRITE;
/*!40000 ALTER TABLE `insumo_apoa` DISABLE KEYS */;
/*!40000 ALTER TABLE `insumo_apoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insumo_poa`
--

DROP TABLE IF EXISTS `insumo_poa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `insumo_poa` (
  `idinsumo_apoa` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL,
  `descinsu` varchar(100) NOT NULL,
  `medida` varchar(30) NOT NULL,
  `costuni` decimal(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `partida_id` int(10) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`idinsumo_apoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `insumo_poa`
--

LOCK TABLES `insumo_poa` WRITE;
/*!40000 ALTER TABLE `insumo_poa` DISABLE KEYS */;
/*!40000 ALTER TABLE `insumo_poa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metas`
--

DROP TABLE IF EXISTS `metas`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `metas` (
  `idaccion` int(11) NOT NULL auto_increment,
  `iddpto` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  `idpreacciones` int(11) NOT NULL,
  PRIMARY KEY  (`idaccion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `metas`
--

LOCK TABLES `metas` WRITE;
/*!40000 ALTER TABLE `metas` DISABLE KEYS */;
/*!40000 ALTER TABLE `metas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metas_apoa`
--

DROP TABLE IF EXISTS `metas_apoa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `metas_apoa` (
  `idaccion_apoa` int(11) NOT NULL auto_increment,
  `idaccion` int(11) NOT NULL,
  `iddpto` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  `idpreacciones` int(11) NOT NULL,
  PRIMARY KEY  (`idaccion_apoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `metas_apoa`
--

LOCK TABLES `metas_apoa` WRITE;
/*!40000 ALTER TABLE `metas_apoa` DISABLE KEYS */;
/*!40000 ALTER TABLE `metas_apoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metas_poa`
--

DROP TABLE IF EXISTS `metas_poa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `metas_poa` (
  `idaccion_apoa` int(11) NOT NULL auto_increment,
  `idaccion` int(11) NOT NULL,
  `iddpto` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  `idpreacciones` int(11) NOT NULL,
  PRIMARY KEY  (`idaccion_apoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `metas_poa`
--

LOCK TABLES `metas_poa` WRITE;
/*!40000 ALTER TABLE `metas_poa` DISABLE KEYS */;
/*!40000 ALTER TABLE `metas_poa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partida`
--

DROP TABLE IF EXISTS `partida`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `partida` (
  `id` int(11) NOT NULL auto_increment,
  `clavepartida` int(11) default NULL,
  `descpartida` text,
  `restringidas` tinyint(1) default NULL,
  `estado` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `partida`
--

LOCK TABLES `partida` WRITE;
/*!40000 ALTER TABLE `partida` DISABLE KEYS */;
INSERT INTO `partida` VALUES (7,1308,'COMPENSACION POR SERVICIOS EVENTUALES',0,1),(8,2101,'MATERIALES Y UTILES DE OFICINA',0,1),(9,2102,'MATERIALES DE LIMPIEZA',0,1),(11,2105,'MAT. Y UTIL.DE PROD.Y REPRODUCC.',0,1),(12,2106,'MATERIALES Y UTILES PARA PROCESAMIENTO EN EQUIPOS Y BIENES INFORMATICOS',0,1),(13,2204,'PROD. ALIMENT. P/PESONAL ENLAS INSTAL. DE DEPENDEN.',0,1),(14,2207,'PRODUCTOS ALIMENTICIOS PARA ANIMALES',0,1),(15,2301,'REFRACCIONES, ACCESORIOS Y HERRAMIENTAS',0,1),(16,2302,'REFRAC.Y ACCES. P/ EQUI. DE COMP.',0,1),(17,2303,'UTENCILIOS P/ SERVICIO DE ALIMENT.',0,1),(18,2104,'MATERIAL ESTADISTICO Y GEOGRAFICO',0,1),(19,2206,'PRODUCTOS ALIMENTICIOS PARA PERSONAL DERIVADOS DE ACTIVIDADES EXTRAORDINARIAS',0,1),(20,2401,'MATERIALES DE CONSTRUCCION',0,1),(21,2402,'ESTRUCTURAS Y MANUFACTURAS',0,1),(22,2403,'MATERIALES COMPLEMENTARIOS',0,1),(23,2404,'MATERIAL ELECTRICO Y ELECTRONICO',0,1),(24,2501,'MATERIAS PRIMAS DE PRODUCCION',0,1),(25,2503,'PLAGUICIDAS, ABONOS Y FETILIZANTES',0,1),(26,2504,'MEDICINAS Y PRODUCTOS FARMACEUTICOS',0,1),(27,2505,'MATERIALES, ACCES. Y SUMINS. MEDICOS',0,1),(28,2506,'MATER., ACCES. Y SUMINSTROS DE LABORAT.',0,1),(29,2602,'COMBUSTIBLES, LUBRICANTES Y ADITIVOS PARA VEHICULOS TERRESTRE, AEREOS, MARITIMOS Y LACUSTRES',0,1),(30,2603,'COMBUSTIBLES, LUBRICANTES Y ADITIVOS PARA VEHICULOS TERRESTRE, AEREOS, MARITIMOS Y LACUSTRES',0,1),(31,2605,'COMBUSTIBLES, LUBRICANTE Y ADITIVOS PARA MAQUINARIA, EQUIPO DE PRODUCCION Y SERVICIOS ADMINISTRATIVOS',0,1),(32,2701,'VESTUARIOS, UNIFORMES Y BLANCOS',0,1),(35,3101,'SERVICIO POSTAL',0,1),(36,3102,'SERVICIO TELEGRAFICO',0,1),(37,3103,'SERVICIO TELEFONICO CONVENCIONAL',0,1),(38,3305,'SERVICIO DE CAPACITACION A SERV. PUBLICOS',0,1),(39,3401,'ALMACENAJE EMBALAJE Y ENVASE',0,1),(40,3106,'SERVICIO DE ENERGIA ELECTRICA',0,1),(41,3107,'SERVICIO DE AGUA',0,1),(42,3108,'SERVICIO DE TELECUMUNICACIONES',0,1),(43,3109,'SERVICO DE CONDUCCION DE SEÑALES ANALOGICAS Y DIGITALES',0,1),(44,3203,'ARRENDAMIENTO DE MAQUINARIA Y EQUIPO',0,1),(45,3304,'OTRAS ASESORIAS P/OPERACION DE PROG.',0,1),(46,3404,'SEGURO  DE BIENES PATRIMONIALES',0,1),(47,3405,'IMPUESTOS Y DERECHOS DE IMPORTACION',0,1),(48,3406,'IMPUESTOS Y DERECHOS DE EXPORTACION',0,1),(49,3407,'OTROS IMPUESTOS Y DERECHOS',0,1),(50,3410,'DIFER. POR VARIACIONES DEL TIPO DE CAMBIO',0,1),(51,3411,'SERVICIOS DE VIGILANCIA',1,1),(52,3414,'SUBCONTRATACION DE SERV. C/ TERCEROS',0,1),(53,3501,'MANTEN.Y CONSERV.DE MOB. Y EQUIPO DE ADMON.',0,1),(54,3502,'MANTEN. Y CONSERV. DE BIENES INFORMATICOS',0,1),(55,3503,'MANTENIMIENTO Y CONSERVACION DE MAQUINARIA Y EQUIPO',0,1),(56,3504,'MANTEN. Y CONSERV. DE INMUEBLES',0,1),(57,3505,'SERV. DE LAVAND, LIMPIEZA, HIG. Y FUMIG.',0,1),(58,3506,'MANTENIMIENTO Y CONSERVACION DE VEHICULOS TERRESTRES, MARITIMOS, AEREOS, LACUSTRES Y FLUVIALES',0,1),(59,3602,'IMPRESION Y ELABORACION DE PUBLICACIONES OFICIALES Y DE INFORMACION GENERAL PAR A DIFUSION',1,1),(60,3603,'INSERCION Y PUBLICACIONES OFICIALES PARA LICITACIONES PUBLICAS Y TRAMITES ADMINISTRATIVOS',1,1),(61,3701,'DIFUS.E INFORM. DE MENS. Y ACTIVIDADES GUBERNAM.',0,1),(62,3808,'PASAJES NACIONALES PARA LABORES DEL CAMPO',0,1),(63,3813,'PASAJES INTERNACIONALES',1,1),(64,3803,'GASTOS DE ORDEN SOCIAL',1,1),(65,3804,'CONGRESOS Y CONVENCIONES',1,1),(66,3805,'EXPOSICIONES',1,1),(67,3811,'PASAJES NAC.P/SERVID. PUBL. DEMANDO EN EL DESEMPEÑO DE COMIS. Y FUNC. OFIC. ',0,1),(68,5402,'INSTRUMENTAL MEDICO Y DE LABORATORIO.',1,1),(69,3817,'VIATICOS NAL.P/SERVIDORES  PUB. EN EL DESEM. DE FUNC. OFICIALES}',0,1),(70,3819,'VIATICOS EN EL EXTRANJ. P/ SERV.PUB.EN EL DESEM. DE COMIS. Y FUNC. OFICIALES',0,1),(71,5101,'MOBILIARIO',1,1),(72,5102,'EQUIPO DE ADMINSTRACION',1,1),(73,5103,'EQUIPO EDUCACIONAL Y REGREATIVO\r\n',1,1),(74,5104,'BINES ARTICULOS Y CULTURALES',1,1),(75,5201,'MAQUINARIA  Y EQUIPO AGROPECUARIO',1,1),(76,5202,'MAQUINARIA  Y EQUIPO INDUSTRIAL',1,1),(77,5204,'EQUIPOS Y APARATOS DE COMUNICACIONES Y TELECOMUNICACIONES',1,1),(78,5205,'MAQ. Y EQUIPO ELEC. Y ELECTRON.',1,1),(79,5206,'BIENES INFORMATICOS',1,1),(80,5303,'VEHICULOS Y EQUIPOS TERRESTRES, AEREOS, MARITIMOS,  LACUSTRES Y FLUVIALES',1,1),(81,5304,'VEHICULOS Y EQUIPOS TERRESTRES, AEREOS, MARITIMOS, DESTINADOS A SERVICIOS ADMINSTRATIVOS',1,1),(82,5401,'EQUIPO MEDICO Y DE LABORATORIO',1,1),(83,5601,'ANIMALES DE TRABAJO',1,1),(84,5602,'ANIMALES DE REPRODUCCION',1,1),(85,7501,'GASTO RELACIONADO CON ACTIVIDADES CULTURALES, DEPORTIVAS Y DE AYUDA EXTRAORDINARIA',1,1),(86,7502,'GASTOS POR SERV. DE TRASLADO DE PERS.',1,1),(88,2107,'MATERIAL PARA INF. EN ACTIVIDADES DE INVES. CIENTIFICA Y TECNOLOGICA',0,1),(89,2203,'PRODUCTOS ALIMEN. PARA PERSONAL QUE REALIZE LAB. DE CAMPO',0,1),(90,2502,'SUSTANCIAS QUIMICAS',0,1),(91,3402,'FLETES Y MANIOBRAS',0,1),(92,3403,'SERVICIOS BANCARIOS Y FINANCIEROS.',0,1),(93,3409,'PATENTES REGALIAS Y OTROS.',0,1),(94,3413,'OTROS SERVICIOS COMERCIALES',0,1),(95,3814,'VIATICOS NACIONALES PARA LAB. EN CAMPO.',0,1),(96,5501,'HTAS. Y MAQUINAS HTAS.',1,1),(97,5502,'REFACCIONES Y ACCESORIOS',1,1),(98,2702,'PRENDAS DE PROTECCION PERSONAL',0,1),(99,2703,'ARTICULOS DEPORTIVOS.',0,1),(100,3210,'ARRENDAMIENTO DE MOBILIARIO',0,1),(101,3206,'Arrendamiento de vehiculos p/serv. publicos',0,1),(102,3310,'SERVICIOS REL.CON CERTIFICACION DE PROCESOS',0,1),(103,3507,'Mantenimiento y conservacion de plantase inst. prod.',0,1),(105,3206,'ARRENDAMIENTO DE VEHICULOS TERRESTRES, AEREOS, MARITIMOS',0,1),(107,3202,'ARRENDAMIENTO DE TERRENOS',0,1),(109,3601,'IMPRESIONES DE DOCUMENTOS OFICIALES PARA LA PRESTACION DE SERVICIOS PUBLICOS, IDENTIFICACION Y FORMATOS ADMINISTRATIVOS Y FISCALES, FORMAS VALORADAS, CERTIFICADOS Y TITULOS',0,1);
/*!40000 ALTER TABLE `partida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poa`
--

DROP TABLE IF EXISTS `poa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `poa` (
  `id` int(11) NOT NULL auto_increment,
  `anio` int(11) default NULL,
  `tipo` tinyint(1) NOT NULL,
  `actual` tinyint(1) NOT NULL,
  `iniciado` tinyint(1) NOT NULL,
  `terminado` tinyint(1) NOT NULL,
  `periodo` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `poa`
--

LOCK TABLES `poa` WRITE;
/*!40000 ALTER TABLE `poa` DISABLE KEYS */;
INSERT INTO `poa` VALUES (1,2010,1,1,1,0,1);
/*!40000 ALTER TABLE `poa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poa_dpto`
--

DROP TABLE IF EXISTS `poa_dpto`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `poa_dpto` (
  `id` int(11) NOT NULL auto_increment,
  `dpto_id` int(11) NOT NULL,
  `partida_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `justificacion` text NOT NULL,
  `idaccion` int(11) NOT NULL,
  `tipogasto` int(1) NOT NULL,
  `periodo` int(1) NOT NULL,
  `idproceso` int(11) NOT NULL,
  `idactividad` int(11) NOT NULL,
  `idacciones` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `poa_dpto`
--

LOCK TABLES `poa_dpto` WRITE;
/*!40000 ALTER TABLE `poa_dpto` DISABLE KEYS */;
/*!40000 ALTER TABLE `poa_dpto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poa_dpto_apoa`
--

DROP TABLE IF EXISTS `poa_dpto_apoa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `poa_dpto_apoa` (
  `idpoa_dpto_apoa` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL,
  `dpto_id` int(11) NOT NULL,
  `partida_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `justificacion` text NOT NULL,
  `idaccion` int(11) NOT NULL,
  `tipogasto` int(1) NOT NULL,
  `periodo` int(1) NOT NULL,
  `idproceso` int(11) NOT NULL,
  `idactividad` int(11) NOT NULL,
  `idacciones` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`idpoa_dpto_apoa`)
) ENGINE=InnoDB AUTO_INCREMENT=1114 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `poa_dpto_apoa`
--

LOCK TABLES `poa_dpto_apoa` WRITE;
/*!40000 ALTER TABLE `poa_dpto_apoa` DISABLE KEYS */;
INSERT INTO `poa_dpto_apoa` VALUES (1,0,24,49,43,1800,'',3,1,2,3,8,23,1),(2,0,24,49,43,70,'',4,1,2,3,8,24,1),(3,0,24,9,3,5,'',1,1,1,3,8,22,1),(4,0,24,9,3,5,'',1,1,2,3,8,22,1),(5,0,24,67,61,11,'',2,1,2,3,8,22,1),(6,0,24,65,58,120,'',2,1,1,3,8,22,1),(7,0,24,79,66,1,'Este es un appliance que permite administrar de manera centralizada los puntos de acceso de la red inalambrica',2,1,1,3,8,22,1),(8,0,24,69,64,39,'',2,1,1,3,8,22,1),(9,0,13,96,71,1,'PARA ATENDER LAS RECOMENDACIONES DE LOS CIEES PARA LA ACREDITACION DE LA CARRERA',24,1,2,1,1,1,1),(10,0,13,76,74,1,'PARA ATENDER LAS RECOMENDACIONES DE LOS CIEES PARA LA ACREDITACION DE LA CARRERA',24,1,1,1,1,1,1),(11,0,13,96,68,1,'PARA ATENDER LAS RECOMENDACIONES DE LOS CIEES PARA LA ACREDITACION DE LA CARRERA',24,1,1,1,1,1,1),(12,0,13,96,73,1,'PARA ATENDER LAS RECOMENDACIONES DE LOS CIEES PARA LA ACREDITACION DE LA CARRERA',24,1,2,1,1,1,1),(13,0,13,82,69,1,'PARA ATENDER LAS RECOMENDACIONES DE LOS CIEES PARA LA ACREDITACION DE LA CARRERA',24,1,1,1,1,1,1),(14,0,13,82,70,1,'PARA ATENDER LAS RECOMENDACIONES DE LOS CIEES PARA LA ACREDITACION DE LA CARRERA',24,1,1,1,1,1,1),(15,0,13,96,72,1,'PARA ATENDER LAS RECOMENDACIONES DE LOS CIEES PARA LA ACREDITACION DE LA CARRERA',24,1,2,1,1,1,1),(16,0,13,23,75,5,'',25,1,2,1,1,15,1),(17,0,13,23,76,1,'',25,1,1,1,1,15,1),(18,0,13,90,77,20,'',26,1,1,1,1,19,1),(19,0,13,20,78,20,'',26,1,1,1,1,19,1),(20,0,13,20,93,4,'',26,1,1,1,1,19,1),(21,0,13,15,101,10,'',26,1,1,1,1,19,1),(22,0,13,15,79,10,'',26,1,1,1,1,19,1),(23,0,13,15,89,10,'',26,1,1,1,1,19,1),(24,0,13,15,91,2,'',26,1,1,1,1,19,1),(25,0,13,15,90,2,'',26,1,1,1,1,19,1),(26,0,13,15,92,2,'',26,1,1,1,1,19,1),(27,0,13,15,94,2,'',26,1,1,1,1,19,1),(28,0,13,15,96,3,'',26,1,1,1,1,19,1),(29,0,13,15,97,3,'',26,1,1,1,1,19,1),(30,0,13,15,95,3,'',26,1,1,1,1,19,1),(31,0,13,15,83,1,'',26,1,1,1,1,19,1),(32,0,13,15,87,1,'',26,1,1,1,1,19,1),(33,0,13,15,82,2,'',26,1,1,1,1,19,1),(34,0,13,15,100,10,'',26,1,1,1,1,19,1),(35,0,13,15,81,1,'',26,1,1,1,1,19,1),(36,0,13,15,80,4,'',26,1,1,1,1,19,1),(37,0,13,15,98,5,'',26,1,1,1,1,19,1),(38,0,13,15,102,5,'',26,1,1,1,1,19,1),(39,0,13,15,103,1,'',26,1,1,1,1,19,1),(40,0,13,9,88,4,'',26,1,1,1,1,19,1),(41,0,13,9,85,10,'',26,1,1,1,1,19,1),(42,0,13,9,84,10,'',26,1,1,1,1,19,1),(43,0,13,9,86,10,'',26,1,1,1,1,19,1),(44,0,13,21,99,50,'',26,1,1,1,1,19,1),(45,0,13,12,104,10,'',27,1,1,1,1,27,1),(46,0,13,12,105,6,'',27,1,2,1,1,27,1),(47,0,13,67,61,30,'',28,1,1,1,3,2,1),(48,0,13,67,61,30,'',28,1,2,1,3,2,1),(49,0,13,67,106,2,'',28,1,1,1,3,2,1),(50,0,13,8,2,50,'',31,1,1,1,2,36,1),(51,0,13,49,43,25,'',29,1,1,2,4,30,1),(52,0,13,49,43,25,'',29,1,2,2,4,30,1),(53,0,13,69,64,100,'',30,1,1,2,4,30,1),(54,0,13,69,64,100,'',30,1,2,2,4,30,1),(55,0,18,8,2,13,'',32,1,2,1,1,15,1),(56,0,18,8,2,13,'',32,1,1,1,1,15,1),(57,0,18,12,5,14,'',32,1,1,1,1,15,1),(58,0,18,12,5,14,'',32,1,2,1,1,15,1),(59,0,18,29,21,30,'',32,1,2,1,1,15,1),(60,0,18,29,21,30,'',32,1,2,1,1,15,1),(61,0,18,20,11,25,'',32,1,1,1,1,15,1),(62,0,18,20,11,25,'',32,1,2,1,1,15,1),(63,0,18,59,54,66,'',32,1,1,1,1,15,1),(64,0,18,59,54,67,'',32,1,2,1,1,15,1),(65,0,18,69,107,1,'',32,1,1,1,1,15,1),(66,0,18,69,107,2,'',32,1,2,1,1,15,1),(67,0,18,23,75,10,'',22,1,1,3,8,22,1),(68,0,18,23,75,12,'',22,1,1,3,8,22,1),(69,0,16,76,115,4,'EQUIPAMIENTO DE LAB. DE ELECTRICA LAB. DE INST. DE CONTROL ',33,1,1,1,1,1,1),(70,0,16,79,114,1,'EQUIPAMIENTO DE LAB. DE SIMULACION DE ECA',33,1,1,1,1,1,1),(71,0,16,78,112,1,'EQUIP. DE LAB. ELECTRICA',33,1,1,1,1,1,1),(72,0,16,78,113,1,'EQUIPAM. LAB. DE ELECTRICA',33,1,1,1,1,1,1),(73,0,16,8,2,39,'',36,1,1,1,1,19,1),(74,0,16,8,2,39,'',36,1,2,1,1,19,1),(75,0,16,12,5,65,'',36,1,1,1,1,19,1),(76,0,16,12,5,65,'',36,1,2,1,1,19,1),(77,0,16,23,14,160,'',36,1,1,1,1,19,1),(78,0,16,23,14,160,'',36,1,2,1,1,19,1),(79,0,16,9,3,3,'',36,1,1,1,1,19,1),(80,0,16,15,98,10,'',36,1,1,1,1,19,1),(81,0,16,15,98,10,'',36,1,2,1,1,19,1),(82,0,16,20,11,5,'',36,1,1,1,1,19,1),(83,0,16,32,23,10,'',36,1,2,1,1,19,1),(84,0,16,29,21,12,'',37,1,1,1,1,27,1),(85,0,16,29,21,13,'',37,1,2,1,1,27,1),(86,0,16,49,43,7,'',39,1,1,2,4,30,1),(87,0,16,49,43,7,'',39,1,2,2,4,30,1),(88,0,16,67,106,7,'',35,1,1,1,3,12,1),(89,0,16,67,106,6,'',35,1,2,1,3,12,1),(90,0,16,69,107,11,'',35,1,1,1,3,12,1),(91,0,16,69,107,12,'',35,1,2,1,3,12,1),(92,0,16,13,7,17,'',34,1,1,1,1,15,1),(93,0,16,13,7,18,'',34,1,2,1,1,15,1),(94,0,3,49,43,600,'',42,1,1,1,1,15,1),(95,0,3,49,43,600,'',42,1,2,1,1,15,1),(96,0,3,102,116,150,'',40,1,2,1,1,1,1),(97,0,3,49,43,500,'',45,1,1,3,7,37,1),(98,0,3,67,106,10,'',45,1,1,3,7,37,1),(99,0,3,67,106,10,'',45,1,2,3,7,37,1),(100,0,3,69,107,5,'',45,1,1,3,7,37,1),(101,0,3,69,107,5,'',45,1,2,3,7,37,1),(102,0,3,8,2,50,'',43,1,1,1,3,12,1),(103,0,3,8,2,50,'',43,1,2,1,3,12,1),(104,0,3,12,5,50,'',43,1,1,1,3,12,1),(105,0,3,12,5,50,'',43,1,2,1,3,12,1),(106,0,3,13,7,50,'',45,1,1,3,7,37,1),(107,0,3,13,7,50,'',45,1,2,3,7,37,1),(108,0,3,29,21,30,'',42,1,1,1,1,15,1),(109,0,3,29,21,20,'',42,1,2,1,1,15,1),(110,0,3,67,106,3,'',45,1,1,3,7,37,1),(111,0,3,67,106,3,'',45,1,2,3,7,37,1),(112,0,3,69,107,5,'',45,1,1,3,7,37,1),(113,0,3,69,107,4,'',45,1,2,3,7,37,1),(114,0,3,73,110,1,'PARA APOYO A LAS AREAS ACADEMICAS Y ADMINISTRATIVAS',45,1,2,3,7,37,1),(115,0,3,49,43,50,'',42,1,2,1,1,15,1),(116,0,3,65,58,40,'',43,1,1,1,3,12,1),(117,0,3,65,58,40,'',43,1,2,1,3,12,1),(118,0,3,67,106,5,'',40,1,1,1,1,1,1),(119,0,3,67,106,5,'',40,1,2,1,1,1,1),(120,0,14,76,120,1,'PARA LA ATENCION DE PRACTICAS DE LABORATORIO',48,1,2,1,1,1,1),(121,0,14,82,121,2,'PARA LA ATENCION DE PRACTICAS DE LABORATORIO',48,1,2,1,1,1,1),(122,0,14,82,122,1,'PARA LA ATENCION DE PRACTICAS DE LABORATORIO',48,1,2,1,1,1,1),(123,0,14,23,76,5,'',49,1,1,1,1,15,1),(124,0,14,12,104,10,'',49,1,1,1,1,15,1),(125,0,14,12,5,35,'',49,1,1,1,1,15,1),(126,0,14,8,2,100,'',49,1,1,1,1,15,1),(127,0,11,82,117,1,'EL AREA DE CIENCIAS BASICAS SE ENCUENTRA EN LA ETAPA DE GENERACION DE UN LABORATORIO DE FISICA GENERAL, PARA ATENDER LAS NECESIDADES DE LOS NUEVOS PROGRAMAS DE FISICA, POR LO QUE NO CUENTA CON ESTOS EQUIPOS, NECESARIOS PARA ATENDER LOS FINES DIDACTICOS Y PEDAGOGICOS TANTO DE CATEDRATICOS COMO DE ALUMNOS.',5,1,2,1,1,1,1),(128,0,14,54,50,80,'',49,1,1,1,1,15,1),(129,0,11,82,118,1,'EL AREA DE CIENCIAS BASICAS SE ENCUENTRA EN LA ETAPA DE GENERACION DE UN LABORATORIO DE FISICA GENERAL, PARA ATENDER LAS NECESIDADES DE LOS NUEVOS PROGRAMAS DE FISICA, POR LO QUE NO CUENTA CON ESTOS EQUIPOS, NECESARIOS PARA ATENDER LOS FINES DIDACTICOS Y PEDAGOGICOS TANTO DE CATEDRATICOS COMO DE ALUMNOS.',5,1,1,1,1,1,1),(130,0,11,82,119,1,'EL AREA DE CIENCIAS BASICAS SE ENCUENTRA EN LA ETAPA DE GENERACION DE UN LABORATORIO DE FISICA GENERAL, PARA ATENDER LAS NECESIDADES DE LOS NUEVOS PROGRAMAS DE FISICA, POR LO QUE NO CUENTA CON ESTOS EQUIPOS, NECESARIOS PARA ATENDER LOS FINES DIDACTICOS Y PEDAGOGICOS TANTO DE CATEDRATICOS COMO DE ALUMNOS.',6,1,1,1,1,1,1),(131,0,14,67,61,75,'',52,1,1,2,4,30,1),(132,0,14,67,61,75,'',52,1,2,2,4,30,1),(133,0,14,69,107,10,'',52,1,1,2,4,30,1),(134,0,14,69,107,10,'',52,1,2,2,4,30,1),(135,0,14,49,43,25,'',52,1,1,2,4,30,1),(136,0,14,49,43,25,'',52,1,2,2,4,30,1),(137,0,11,8,2,40,'',7,1,1,1,3,12,1),(138,0,11,8,2,40,'',7,1,2,1,3,12,1),(139,0,11,12,105,1,'',7,1,1,1,3,12,1),(140,0,11,12,105,1,'',7,1,2,1,3,12,1),(141,0,11,8,2,1,'',8,1,1,1,3,12,1),(142,0,11,8,2,1,'',8,1,2,1,3,12,1),(143,0,14,31,22,60,'',50,1,1,1,1,19,1),(144,0,14,31,22,60,'',50,1,2,1,1,19,1),(145,0,14,20,11,25,'',50,1,1,1,1,19,1),(146,0,14,20,11,25,'',50,1,2,1,1,19,1),(147,0,11,13,7,5,'',9,1,1,1,3,12,1),(148,0,11,13,7,5,'',9,1,2,1,3,12,1),(149,0,14,15,8,90,'',50,1,1,1,1,19,1),(150,0,14,15,8,90,'',50,1,2,1,1,19,1),(151,0,14,90,16,200,'',50,1,1,1,1,19,1),(152,0,14,90,16,180,'',50,1,2,1,1,19,1),(153,0,11,8,2,10,'',10,1,1,1,1,19,1),(154,0,11,8,2,10,'',10,1,2,1,1,19,1),(155,0,11,9,3,20,'',11,1,1,1,1,19,1),(156,0,11,9,3,20,'',11,1,2,1,1,19,1),(157,0,11,12,105,1,'',11,1,1,1,1,19,1),(158,0,11,12,105,1,'',11,1,2,1,1,19,1),(159,0,11,9,3,1,'',10,1,1,1,1,19,1),(160,0,11,9,3,1,'',10,1,2,1,1,19,1),(161,0,11,16,9,40,'',12,1,1,1,1,19,1),(162,0,11,16,9,10,'',12,1,2,1,1,19,1),(163,0,14,27,19,15,'',50,1,1,1,1,19,1),(164,0,14,27,19,15,'',50,1,2,1,1,19,1),(165,0,14,28,20,200,'',50,1,1,1,1,19,1),(166,0,14,28,20,150,'',50,1,2,1,1,19,1),(167,0,11,90,16,30,'',12,1,1,1,1,19,1),(168,0,11,90,16,40,'',12,1,2,1,1,19,1),(169,0,14,98,24,50,'',50,1,1,1,1,19,1),(170,0,11,12,5,10,'',13,1,1,1,1,19,1),(171,0,11,12,5,10,'',13,1,2,1,1,19,1),(172,0,11,13,7,10,'',13,1,1,1,1,19,1),(173,0,11,13,7,10,'',13,1,2,1,1,19,1),(174,0,11,57,52,25,'',13,1,1,1,1,19,1),(175,0,11,57,52,25,'',13,1,2,1,1,19,1),(176,0,11,8,2,60,'',16,1,1,1,1,27,1),(177,0,11,8,2,20,'',16,1,2,1,1,27,1),(178,0,14,9,3,20,'',50,1,1,1,1,19,1),(179,0,11,12,105,1,'',16,1,1,1,1,27,1),(180,0,11,12,105,1,'',16,1,2,1,1,27,1),(181,0,14,17,10,50,'',50,1,1,1,1,19,1),(182,0,11,12,5,6,'',16,1,1,1,1,27,1),(183,0,11,12,5,6,'',16,1,2,1,1,27,1),(184,0,11,12,5,5,'',16,1,1,1,1,27,1),(185,0,11,12,5,5,'',16,1,2,1,1,27,1),(186,0,14,13,7,10,'',50,1,1,1,1,19,1),(187,0,14,13,7,10,'',50,1,2,1,1,19,1),(188,0,11,13,7,20,'',16,1,1,1,1,27,1),(189,0,11,13,7,10,'',16,1,2,1,1,27,1),(190,0,11,23,75,10,'',16,1,1,1,1,27,1),(191,0,11,23,75,10,'',16,1,2,1,1,27,1),(192,0,11,32,23,20,'',16,1,1,1,1,27,1),(193,0,11,32,23,100,'',16,1,2,1,1,27,1),(194,0,14,55,49,100,'',50,1,1,1,1,19,1),(195,0,14,55,49,150,'',50,1,2,1,1,19,1),(196,0,11,86,123,1,'',18,1,2,1,1,27,1),(197,0,11,86,124,95,'',18,1,2,1,1,27,1),(198,0,11,13,7,10,'',46,1,1,1,1,15,1),(199,0,11,13,7,10,'',46,1,2,1,1,15,1),(200,0,11,23,75,10,'',46,1,1,1,1,15,1),(201,0,11,23,75,10,'',46,1,2,1,1,15,1),(202,0,11,23,76,1,'',46,1,1,1,1,15,1),(203,0,11,23,14,5,'',46,1,1,1,1,15,1),(204,0,11,23,14,5,'',46,1,2,1,1,15,1),(205,0,11,67,106,1,'',46,1,1,1,1,15,1),(206,0,11,67,106,1,'',46,1,2,1,1,15,1),(207,0,11,67,61,40,'',46,1,1,1,1,15,1),(208,0,11,67,61,40,'',46,1,2,1,1,15,1),(209,0,11,69,107,2,'',46,1,1,1,1,15,1),(210,0,11,69,107,2,'',46,1,2,1,1,15,1),(211,0,11,8,2,9,'',8,1,1,1,3,12,1),(212,0,11,8,2,9,'',8,1,2,1,3,12,1),(213,0,11,8,2,20,'',15,1,1,3,8,22,1),(214,0,11,8,2,20,'',15,1,2,3,8,22,1),(215,0,11,16,9,16,'',15,1,1,3,8,22,1),(216,0,11,16,9,16,'',15,1,2,3,8,22,1),(217,0,7,60,55,700,'',53,1,2,3,7,38,1),(218,0,7,59,54,50,'',54,1,1,3,7,38,1),(219,0,7,59,54,50,'',54,1,2,3,7,38,1),(220,0,7,61,56,100,'',54,1,1,3,7,38,1),(221,0,7,61,56,100,'',54,1,2,3,7,38,1),(222,0,7,60,55,125,'',54,1,1,3,7,38,1),(223,0,7,60,55,125,'',54,1,2,3,7,38,1),(224,0,7,22,13,60,'',54,1,1,3,7,38,1),(225,0,7,22,13,60,'',54,1,2,3,7,38,1),(226,0,7,59,54,110,'',55,1,1,3,7,38,1),(227,0,7,59,54,110,'',55,1,2,3,7,38,1),(228,0,7,64,57,450,'',56,1,1,3,7,38,1),(229,0,7,64,57,450,'',56,1,2,3,7,38,1),(230,0,7,59,54,50,'',56,1,1,3,7,38,1),(231,0,7,59,54,50,'',56,1,2,3,7,38,1),(232,0,7,64,57,200,'',56,1,1,3,7,38,1),(233,0,7,64,57,200,'',56,1,2,3,7,38,1),(234,0,19,7,1,7000,'',57,1,2,1,1,3,1),(235,0,19,7,1,875,'',57,1,1,1,1,3,1),(236,0,19,7,1,875,'',57,1,2,1,1,3,1),(237,0,19,8,2,15,'',58,1,1,1,1,15,1),(238,0,19,8,2,15,'',58,1,2,1,1,15,1),(239,0,19,12,5,210,'',59,1,1,1,1,15,1),(240,0,19,12,5,210,'',59,1,2,1,1,15,1),(241,0,19,71,126,1,'PARA LA COORDINACION DE GESTION EMPRESARIAL',59,1,1,1,1,15,1),(242,0,19,71,128,1,'PARA LA COORDINACION DE GESTION EMPRESARIAL',59,1,1,1,1,15,1),(243,0,19,79,127,1,'PARA LA JEFATURA DE LA DIV. DE EST. PROFESIONALES DEBIDO A QUE NO EXISTE',59,1,1,1,1,15,1),(244,0,19,8,2,25,'',60,1,1,1,1,15,1),(245,0,19,8,2,24,'',60,1,2,1,1,15,1),(246,0,15,8,2,35,'',61,1,1,1,1,1,1),(247,0,15,8,2,35,'',61,1,2,1,1,1,1),(248,0,15,67,61,125,'',63,1,1,1,3,2,1),(249,0,15,67,61,125,'',63,1,2,1,3,2,1),(250,0,15,23,75,13,'',64,1,1,1,1,15,1),(251,0,15,23,75,12,'',64,1,2,1,1,15,1),(252,0,15,15,89,550,'',65,1,1,1,1,19,1),(253,0,15,15,89,500,'',65,1,2,1,1,19,1),(254,0,15,12,5,60,'',66,1,1,1,1,27,1),(255,0,15,12,5,40,'',66,1,2,1,1,27,1),(256,0,15,49,43,30,'',67,1,1,2,4,30,1),(257,0,15,49,43,20,'',67,1,2,2,4,30,1),(258,0,15,69,107,6,'',68,1,1,2,4,30,1),(259,0,15,69,107,4,'',68,1,2,2,4,30,1),(260,0,15,82,130,2,'ATENCION A LA RECOMENDACION DE CIESS',62,1,1,1,1,1,1),(261,0,15,82,135,2,'ATENCION A LA RECOMENDACION DE CIESS',62,1,1,1,1,1,1),(262,0,15,78,131,1,'ATENCION A LA RECOMENDACION DE CIESS',62,1,1,1,1,1,1),(263,0,15,82,132,5,'ATENCION RECOMENDACION DE CIESS',62,1,1,1,1,1,1),(264,0,15,82,133,5,'ATENCION RECOMENDACION DE CIESS',62,1,1,1,1,1,1),(265,0,15,82,134,5,'ATENCION A RECOMEDACION DE CIESS',62,1,1,1,1,1,1),(266,0,12,8,2,7,'',82,1,1,1,1,1,1),(267,0,12,12,5,13,'',82,1,1,1,1,1,1),(268,0,12,65,58,20,'',82,1,1,1,1,1,1),(269,0,12,12,5,13,'',83,1,1,1,1,3,1),(270,0,12,12,5,13,'',83,1,2,1,1,3,1),(271,0,12,8,2,7,'',83,1,1,1,1,3,1),(272,0,12,8,2,7,'',83,1,2,1,1,3,1),(273,0,12,12,5,26,'',84,1,1,1,1,15,1),(274,0,12,12,5,13,'',84,1,2,1,1,15,1),(275,0,17,8,2,40,'',98,1,1,2,4,30,1),(276,0,17,8,2,40,'',98,1,2,2,4,30,1),(277,0,12,32,23,2,'',84,1,1,1,1,15,1),(278,0,12,13,7,10,'',84,1,1,1,1,15,1),(279,0,12,12,5,6,'',84,1,1,1,1,15,1),(280,0,12,8,2,23,'',84,1,1,1,1,15,1),(281,0,12,8,2,20,'',84,1,2,1,1,15,1),(282,0,17,69,64,20,'',98,1,1,2,4,30,1),(283,0,17,67,61,50,'',94,1,1,1,3,12,1),(284,0,12,12,5,13,'',85,1,1,1,1,15,1),(285,0,12,8,2,7,'',85,1,1,1,1,15,1),(286,0,12,12,5,30,'',99,1,1,1,1,19,1),(287,0,12,13,7,10,'',99,1,1,1,1,19,1),(288,0,12,8,2,10,'',88,1,1,1,1,27,1),(289,0,12,13,7,10,'',88,1,1,1,1,27,1),(290,0,17,32,23,50,'',96,1,1,1,1,27,1),(291,0,12,49,43,50,'',88,1,1,1,1,27,1),(292,0,12,69,64,96,'',88,1,1,1,1,27,1),(293,0,12,69,64,34,'',88,1,2,1,1,27,1),(294,0,12,8,2,17,'',89,1,2,1,1,27,1),(295,0,12,12,5,13,'',89,1,2,1,1,27,1),(296,0,12,13,7,20,'',90,1,2,1,3,6,1),(297,0,12,69,64,30,'',90,1,1,1,3,6,1),(298,0,12,65,58,50,'',91,1,1,1,3,12,1),(299,0,12,69,64,20,'',91,1,1,1,3,12,1),(300,0,12,67,61,30,'',91,1,1,1,3,12,1),(301,0,12,69,64,20,'',92,1,1,1,3,12,1),(302,0,12,67,61,30,'',92,1,1,1,3,12,1),(303,0,12,38,37,40,'',93,1,1,1,3,12,1),(304,0,12,13,7,10,'',93,1,1,1,3,12,1),(305,0,12,8,2,10,'',93,1,1,1,3,12,1),(306,0,12,13,7,15,'',87,1,1,1,1,27,1),(307,0,12,8,2,10,'',87,1,1,1,1,27,1),(308,0,12,59,54,3,'',87,1,1,1,1,27,1),(309,0,12,20,78,4,'',87,1,1,1,1,27,1),(310,0,12,32,23,20,'',87,1,1,1,1,27,1),(311,0,12,13,7,20,'',88,1,2,1,1,27,1),(312,0,12,79,137,2,'SE REQUIERE CREAR LAS IMAGENES Y RESTAURAR LAS MAQUINAS DE LABORATORIO, INSTALACION DE SOFTWARE',99,1,1,1,1,19,1),(313,0,12,79,138,1,'PARA SISTEMA DE CONTROL DE ACCESO AL LABORATORIO Y GENERACION DE ESTADISTICAS',99,1,1,1,1,19,1),(314,0,12,79,139,1,'SERVIRA PARA REPARACION DEL SERVIDOR DE RESPALDO DE LABORATORIO',99,1,1,1,1,19,1),(315,0,12,79,140,1,'SERVICIO DE IMPRESION EN EL LABORATORIO PARA ALUMNOS Y DOCENTES',99,1,1,1,1,19,1),(316,0,12,72,141,1,'SE FOTOCOPIARAN: MANUALES Y PRACTICAS DE LABORATORI PARA FORMAR ARCHIVOS DE RESPALDO Y SOPORTE PARA EXAMENES ESPECIALES Y GLOBALES, MANUALES PARA CURSOS, RETICULAS Y TRIPTICOS PARA VISITAS AL LABORATORIO Y PROMOCION DE LA CARRERA',99,1,1,1,1,19,1),(317,0,12,79,111,3,'REMPLAZO DE EQUIPOS DESCOMPUESTOS DE LABORATORIOS',99,1,2,1,1,19,1),(318,0,12,77,143,1,'PARA VIGILANCIA DE LABORATORIO',99,1,1,1,1,19,1),(319,0,17,69,64,20,'',94,1,1,1,3,12,1),(320,0,17,69,64,19,'',94,1,2,1,3,12,1),(321,0,17,49,43,100,'',95,1,1,1,3,12,1),(322,0,16,79,144,2,'PARA LAB. DE ELEC Y ELECTRONICA, PLC',33,1,1,1,1,1,1),(323,0,17,12,105,2,'',94,1,1,1,3,12,1),(324,0,17,12,105,2,'',94,1,2,1,3,12,1),(325,0,17,12,104,5,'',96,1,1,1,1,27,1),(326,0,17,12,104,5,'',96,1,2,1,1,27,1),(327,0,25,8,2,60,'',100,1,1,1,1,1,1),(328,0,25,8,2,60,'',100,1,2,1,1,1,1),(329,0,25,9,3,25,'',100,1,1,1,1,1,1),(330,0,25,9,3,25,'',100,1,2,1,1,1,1),(331,0,25,12,5,40,'',100,1,1,1,1,1,1),(332,0,25,12,5,40,'',100,1,2,1,1,1,1),(333,0,25,15,8,70,'',101,1,1,1,1,1,1),(334,0,25,15,8,70,'',101,1,2,1,1,1,1),(335,0,25,20,11,25,'',101,1,1,1,1,1,1),(336,0,25,20,11,25,'',101,1,2,1,1,1,1),(337,0,25,23,14,600,'',101,1,1,1,1,1,1),(338,0,25,23,14,600,'',101,1,2,1,1,1,1),(339,0,25,31,22,15,'',101,1,1,1,1,1,1),(340,0,25,31,22,15,'',101,1,2,1,1,1,1),(341,0,25,32,23,40,'',101,1,1,1,1,1,1),(342,0,25,32,23,40,'',101,1,2,1,1,1,1),(343,0,25,77,145,1,'NO HAY EN EXISTENCIA EN EL DEPARTAMENTO Y ES DE VITAL IMPORTANCIA PARA LA COMUNICACION INTERNA',100,1,1,1,1,1,1),(344,0,25,53,146,199,'',102,1,1,1,1,1,1),(345,0,25,53,146,199,'',102,1,2,1,1,1,1),(346,0,25,13,147,1,'',102,1,1,1,1,1,1),(347,0,25,13,147,1,'',102,1,2,1,1,1,1),(348,0,17,49,43,50,'',97,1,1,1,1,27,1),(349,0,17,69,64,20,'',98,1,2,2,4,30,1),(350,0,17,67,106,2,'',98,1,1,2,4,30,1),(351,0,17,67,106,2,'',98,1,2,2,4,30,1),(352,0,17,49,43,15,'',98,1,1,2,4,30,1),(353,0,17,49,43,15,'',98,1,2,2,4,30,1),(354,0,18,67,106,6,'',115,1,1,1,1,13,1),(355,0,18,67,106,6,'',115,1,2,1,1,13,1),(356,0,18,69,107,2,'',115,1,1,1,1,13,1),(357,0,18,69,107,2,'',115,1,2,1,1,13,1),(358,0,18,8,2,50,'',115,1,1,1,1,13,1),(359,0,18,8,2,50,'',115,1,2,1,1,13,1),(360,0,18,67,106,6,'',116,1,2,1,3,6,1),(361,0,18,69,107,2,'',116,1,2,1,3,6,1),(362,0,18,73,110,1,'PARA APOYO A DOCENTES EN LA ENSEÑANZA-APRENDIZAJE',22,1,1,3,8,22,1),(363,0,18,73,110,2,'PARA APOYO A DOCENTES EN LA ENSEÑANZA-APRENDIZAJE',22,1,2,3,8,22,1),(364,0,18,23,14,22,'',22,1,1,3,8,22,1),(365,0,18,15,101,21,'',22,1,1,3,8,22,1),(366,0,18,15,101,21,'',22,1,2,3,8,22,1),(367,0,18,12,5,30,'',22,1,1,3,8,22,1),(368,0,18,12,5,30,'',22,1,2,3,8,22,1),(369,0,9,8,2,10,'',103,1,2,1,1,15,1),(370,0,9,8,2,50,'',103,1,2,1,1,15,1),(371,0,18,23,75,30,'',22,1,1,3,8,22,1),(372,0,18,73,149,1,'PARA CURSOS A DOCENTES',22,1,2,3,8,22,1),(373,0,9,8,2,10,'',105,1,2,1,1,15,1),(374,0,18,72,150,1,'PARA CURSOS A DOCENTES',22,1,2,3,8,22,1),(375,0,9,46,41,2100,'',105,1,1,1,1,15,1),(376,0,18,67,106,20,'',19,1,1,1,3,12,1),(377,0,18,67,106,20,'',19,1,2,1,3,12,1),(378,0,18,69,107,12,'',19,1,1,1,3,12,1),(379,0,18,69,107,12,'',19,1,2,1,3,12,1),(380,0,18,38,37,75,'',19,1,1,1,3,12,1),(381,0,18,38,37,75,'',19,1,2,1,3,12,1),(382,0,18,32,23,70,'',32,1,1,1,1,15,1),(383,0,18,32,23,70,'',32,1,2,1,1,15,1),(384,0,18,38,37,250,'',20,1,1,1,3,12,1),(385,0,18,38,37,250,'',20,1,2,1,3,12,1),(386,0,18,13,147,25,'',20,1,1,1,3,12,1),(387,0,18,13,147,30,'',20,1,2,1,3,12,1),(388,0,9,12,105,12,'',106,1,1,1,1,15,1),(389,0,9,12,105,12,'',106,1,2,1,1,15,1),(390,0,18,12,5,3,'',20,1,1,1,3,12,1),(391,0,18,12,5,3,'',20,1,2,1,3,12,1),(392,0,18,12,105,8,'',20,1,1,1,3,12,1),(393,0,18,12,105,8,'',20,1,2,1,3,12,1),(394,0,9,8,2,44,'',106,1,2,1,1,15,1),(395,0,18,65,58,30,'',21,1,1,1,3,12,1),(396,0,18,65,58,30,'',21,1,2,1,3,12,1),(397,0,9,8,2,650,'',106,1,2,1,1,15,1),(398,0,9,8,2,10,'',107,1,1,4,13,14,1),(399,0,9,8,2,10,'',107,1,2,4,13,14,1),(400,0,18,67,106,2,'',20,1,1,1,3,12,1),(401,0,18,67,106,1,'',20,1,2,1,3,12,1),(402,0,18,69,107,1,'',20,1,1,1,3,12,1),(403,0,18,69,107,1,'',20,1,2,1,3,12,1),(404,0,9,67,106,1,'',108,1,1,4,13,14,1),(405,0,9,67,106,1,'',108,1,2,4,13,14,1),(406,0,18,29,21,3,'',20,1,1,1,3,12,1),(407,0,18,29,21,3,'',20,1,2,1,3,12,1),(408,0,9,8,2,10,'',112,1,1,1,2,16,1),(409,0,9,8,2,20,'',113,1,1,2,4,30,1),(410,0,23,20,11,1680,'',121,1,1,1,1,1,1),(411,0,23,20,11,1680,'',121,1,2,1,1,1,1),(412,0,23,21,12,410,'',121,1,1,1,1,1,1),(413,0,23,21,12,410,'',121,1,2,1,1,1,1),(414,0,23,56,51,4900,'',121,1,1,1,1,1,1),(415,0,23,56,51,4900,'',121,1,2,1,1,1,1),(416,0,23,9,3,350,'',121,1,1,1,1,1,1),(417,0,23,9,3,350,'',121,1,2,1,1,1,1),(418,0,23,8,2,75,'',121,1,1,1,1,1,1),(419,0,23,8,2,75,'',121,1,2,1,1,1,1),(420,0,23,12,5,60,'',121,1,1,1,1,1,1),(421,0,23,12,5,60,'',121,1,2,1,1,1,1),(422,0,23,13,7,150,'',121,1,1,1,1,1,1),(423,0,23,13,7,150,'',121,1,2,1,1,1,1),(424,0,23,11,4,25,'',121,1,1,1,1,1,1),(425,0,23,11,4,25,'',121,1,2,1,1,1,1),(426,0,23,15,8,100,'',121,1,1,1,1,1,1),(427,0,23,15,8,50,'',121,1,2,1,1,1,1),(428,0,23,46,41,1200,'',122,1,1,1,1,15,1),(429,0,23,57,52,2700,'',122,1,1,1,1,15,1),(430,0,23,57,52,2700,'',122,1,2,1,1,15,1),(431,0,23,51,45,3900,'',122,1,1,1,1,15,1),(432,0,23,51,45,3900,'',122,1,2,1,1,15,1),(433,0,23,41,30,750,'',122,1,1,1,1,15,1),(434,0,23,41,30,750,'',122,1,2,1,1,15,1),(435,0,23,13,7,225,'',122,1,1,1,1,15,1),(436,0,23,13,7,225,'',122,1,2,1,1,15,1),(437,0,23,57,52,1200,'',122,1,1,1,1,15,1),(438,0,23,57,52,1200,'',122,1,2,1,1,15,1),(439,0,23,32,23,500,'',122,1,1,1,1,15,1),(440,0,23,58,53,600,'',123,1,1,3,9,26,1),(441,0,23,58,53,600,'',123,1,2,3,9,26,1),(442,0,23,29,21,350,'',123,1,1,3,9,26,1),(443,0,23,29,21,350,'',123,1,2,3,9,26,1),(444,0,23,49,43,150,'',123,1,1,3,9,26,1),(445,0,23,49,43,150,'',123,1,2,3,9,26,1),(446,0,9,26,18,150,'',124,1,1,1,1,3,1),(447,0,9,26,18,150,'',124,1,2,1,1,3,1),(448,0,9,8,2,40,'',125,1,1,1,1,3,1),(449,0,9,8,2,40,'',125,1,2,1,1,3,1),(450,0,9,12,5,20,'',126,1,1,1,1,3,1),(451,0,9,12,105,10,'',126,1,1,1,1,3,1),(452,0,9,8,2,40,'',126,1,2,1,1,3,1),(453,0,9,8,2,20,'',127,1,2,1,1,3,1),(454,0,9,69,108,10,'',127,1,1,1,1,3,1),(455,0,9,69,108,10,'',127,1,2,1,1,3,1),(456,0,9,67,61,400,'',127,1,1,1,1,3,1),(457,0,9,67,61,400,'',127,1,2,1,1,3,1),(458,0,22,8,2,39,'',117,1,1,3,7,38,1),(459,0,22,8,2,20,'',117,1,2,3,7,38,1),(460,0,22,12,105,4,'',117,1,1,3,7,38,1),(461,0,22,12,105,6,'',117,1,2,3,7,38,1),(462,0,22,13,7,5,'',117,1,1,3,7,38,1),(463,0,22,13,7,5,'',117,1,2,3,7,38,1),(464,0,22,16,9,20,'',117,1,1,3,7,38,1),(465,0,22,16,9,8,'',117,1,2,3,7,38,1),(466,0,22,32,23,20,'',117,1,1,3,7,38,1),(467,0,22,32,23,5,'',117,1,2,3,7,38,1),(468,0,22,92,40,35,'',117,1,1,3,7,38,1),(469,0,22,92,40,35,'',117,1,2,3,7,38,1),(470,0,22,53,146,3,'',117,1,1,3,7,38,1),(471,0,22,53,146,2,'',117,1,2,3,7,38,1),(472,0,20,65,58,160,'',144,1,1,1,2,36,1),(473,0,20,86,124,540,'',144,1,1,1,2,36,1),(474,0,20,23,14,380,'',145,1,1,1,2,36,1),(475,0,20,23,14,380,'',145,1,2,1,2,36,1),(476,0,22,109,151,80,'',117,1,1,3,7,38,1),(477,0,22,67,61,90,'',117,1,1,3,7,38,1),(478,0,22,67,61,90,'',117,1,2,3,7,38,1),(479,0,9,79,140,1,'PARA IMPRESION DE TITULOS ',127,1,2,1,1,3,1),(480,0,22,69,107,6,'',117,1,1,3,7,38,1),(481,0,22,69,107,6,'',117,1,2,3,7,38,1),(482,0,20,28,20,85,'',145,1,1,1,2,36,1),(483,0,20,28,20,85,'',145,1,2,1,2,36,1),(484,0,9,79,111,2,'PARA FOTOCREDENCIALIZACION DE ESTUDIANTES',127,1,2,1,1,3,1),(485,0,20,90,16,370,'',145,1,1,1,2,36,1),(486,0,20,90,16,370,'',145,1,2,1,2,36,1),(487,0,22,8,2,10,'',118,1,1,3,7,38,1),(488,0,22,8,2,2,'',118,1,2,3,7,38,1),(489,0,22,12,105,1,'',118,1,1,3,7,38,1),(490,0,22,12,105,1,'',118,1,2,3,7,38,1),(491,0,22,13,147,1,'',118,1,1,3,7,38,1),(492,0,20,15,8,122,'',145,1,1,1,2,36,1),(493,0,20,15,8,122,'',145,1,2,1,2,36,1),(494,0,22,16,9,5,'',118,1,1,3,7,38,1),(495,0,9,8,2,10,'',114,1,1,2,4,30,1),(496,0,9,8,2,10,'',114,1,2,2,4,30,1),(497,0,22,32,23,2,'',118,1,1,3,7,38,1),(498,0,22,92,40,10,'',118,1,1,3,7,38,1),(499,0,22,92,40,5,'',118,1,2,3,7,38,1),(500,0,20,16,9,60,'',145,1,1,1,2,36,1),(501,0,20,16,9,60,'',145,1,2,1,2,36,1),(502,0,22,53,146,1,'',118,1,1,3,7,38,1),(503,0,20,12,5,60,'',145,1,2,1,2,36,1),(504,0,20,12,5,60,'',145,1,2,1,2,36,1),(505,0,22,109,151,16,'',118,1,1,3,7,38,1),(506,0,22,67,61,18,'',118,1,1,3,7,38,1),(507,0,22,67,61,18,'',118,1,2,3,7,38,1),(508,0,22,69,107,1,'',118,1,1,3,7,38,1),(509,0,22,8,2,10,'',119,1,1,3,7,38,1),(510,0,22,12,104,6,'',119,1,1,3,7,38,1),(511,0,20,20,78,160,'',145,1,1,1,2,36,1),(512,0,20,20,78,160,'',145,1,2,1,2,36,1),(513,0,22,16,9,5,'',119,1,1,3,7,38,1),(514,0,22,32,23,2,'',119,1,1,3,7,38,1),(515,0,22,92,40,10,'',119,1,1,3,7,38,1),(516,0,22,92,40,5,'',119,1,2,3,7,38,1),(517,0,22,53,146,1,'',119,1,1,3,7,38,1),(518,0,22,109,151,16,'',119,1,1,3,7,38,1),(519,0,22,67,61,18,'',119,1,1,3,7,38,1),(520,0,22,67,61,18,'',119,1,2,3,7,38,1),(521,0,20,22,13,43,'',145,1,1,1,2,36,1),(522,0,20,22,13,43,'',145,1,2,1,2,36,1),(523,0,22,69,107,1,'',119,1,1,3,7,38,1),(524,0,20,65,58,50,'',145,1,1,1,2,36,1),(525,0,20,65,58,50,'',145,1,2,1,2,36,1),(526,0,22,8,2,30,'',120,1,1,3,7,38,1),(527,0,22,8,2,5,'',120,1,2,3,7,38,1),(528,0,22,12,105,4,'',120,1,1,3,7,38,1),(529,0,22,12,105,3,'',120,1,2,3,7,38,1),(530,0,22,16,9,16,'',120,1,1,3,7,38,1),(531,0,22,32,23,7,'',120,1,1,3,7,38,1),(532,0,22,92,40,20,'',120,1,1,3,7,38,1),(533,0,22,92,40,20,'',120,1,2,3,7,38,1),(534,0,22,53,146,3,'',120,1,1,3,7,38,1),(535,0,22,109,151,45,'',120,1,1,3,7,38,1),(536,0,22,67,61,40,'',120,1,1,3,7,38,1),(537,0,22,67,61,40,'',120,1,2,3,7,38,1),(538,0,22,69,107,1,'',120,1,1,3,7,38,1),(539,0,22,67,61,8,'',120,1,1,3,7,38,1),(540,0,5,8,2,40,'',148,1,1,3,7,38,1),(541,0,5,8,2,40,'',148,1,2,3,7,38,1),(542,0,5,12,5,75,'',148,1,1,3,7,38,1),(543,0,5,12,5,75,'',148,1,2,3,7,38,1),(544,0,5,13,7,5,'',148,1,1,3,7,38,1),(545,0,5,13,7,5,'',148,1,2,3,7,38,1),(546,0,5,67,106,3,'',147,1,1,1,1,1,1),(547,0,5,67,106,3,'',147,1,2,1,1,1,1),(548,0,5,69,107,2,'',147,1,1,1,1,1,1),(549,0,5,69,107,2,'',147,1,2,1,1,1,1),(550,0,5,67,106,6,'',148,1,1,3,7,38,1),(551,0,5,67,106,6,'',148,1,2,3,7,38,1),(552,0,5,69,107,5,'',148,1,1,3,7,38,1),(553,0,5,69,107,5,'',148,1,2,3,7,38,1),(554,0,5,67,61,5,'',149,1,1,3,6,40,1),(555,0,5,67,61,5,'',149,1,2,3,6,40,1),(556,0,5,16,9,10,'',148,1,1,3,7,38,1),(557,0,5,16,9,10,'',148,1,2,3,7,38,1),(558,0,5,56,51,50,'',147,1,1,1,1,1,1),(559,0,5,56,51,50,'',147,1,2,1,1,1,1),(560,0,5,73,110,5,'EQUIPAMIENTO DE AULAS CON TIC´S',150,1,1,3,8,22,1),(561,0,5,73,110,4,'EQUIPAMIENTO DE AULAS CON TIC´S',150,1,2,3,8,22,1),(562,0,5,73,149,5,'PARA EQUIPAMIENTO DE SALONES CON TIC´S',150,1,1,3,8,22,1),(563,0,5,73,149,6,'PARA EQUIPAMIENTO DE SALONES CON TIC´S',150,1,2,3,8,22,1),(564,0,5,32,23,10,'',147,1,2,1,1,1,1),(565,0,21,64,57,500,'',151,1,1,3,9,26,1),(566,0,21,64,57,250,'',151,1,2,3,9,26,1),(567,0,21,67,61,385,'',152,1,1,3,7,38,1),(568,0,21,67,61,385,'',152,1,2,3,7,38,1),(569,0,21,69,64,240,'',152,1,1,3,7,38,1),(570,0,21,69,64,240,'',152,1,2,3,7,38,1),(571,0,21,8,2,50,'',153,1,1,4,12,42,1),(572,0,21,8,2,50,'',153,1,2,4,12,42,1),(573,0,21,12,5,50,'',153,1,1,4,12,42,1),(574,0,21,12,5,50,'',153,1,2,4,12,42,1),(575,0,21,13,7,100,'',153,1,1,4,12,42,1),(576,0,21,13,7,100,'',153,1,2,4,12,42,1),(577,0,21,8,2,55,'',154,1,1,4,12,42,1),(578,0,21,8,2,55,'',154,1,2,4,12,42,1),(579,0,21,12,5,55,'',154,1,1,4,12,42,1),(580,0,21,12,5,55,'',154,1,2,4,12,42,1),(581,0,21,35,26,15,'',154,1,1,4,12,42,1),(582,0,21,35,26,15,'',154,1,2,4,12,42,1),(583,0,21,53,48,15,'',154,1,1,4,12,42,1),(584,0,21,53,48,15,'',154,1,2,4,12,42,1),(585,0,21,79,152,1,'PARA USO DEL DEPARTAMENTO COMO IMPRESION DE OFICIOS, FORMATOS Y COSAS OFICIALES',153,1,1,4,12,42,1),(586,0,11,82,153,1,'EL AREA DE CIENCIAS BASICAS SE ENCUENTRA EN LA ETAPA DE GENERACION DE UN LABORATORIO DE FISICA GENERAL, PARA ATENDER LAS NECESIDADES DE LOS NUEVOS PROGRAMAS DE FISICA, POR LO QUE NO CUENTA CON ESTOS EQUIPOS, NECESARIOS PARA ATENDER LOS FINES DIDACTICOS Y PEDAGOGICOS TANTO DE CATEDRATICOS COMO DE ALUMNOS. ',6,1,1,1,1,1,1),(587,0,3,8,2,625,'',155,1,1,3,7,37,1),(588,0,3,8,2,625,'',155,1,2,3,7,37,1),(589,0,3,88,6,300,'',155,1,1,3,7,37,1),(590,0,3,88,6,600,'',155,1,2,3,7,37,1),(591,0,3,13,147,40,'',155,1,1,3,7,37,1),(592,0,3,13,147,40,'',155,1,2,3,7,37,1),(593,0,3,43,32,45,'',155,1,1,3,7,37,1),(594,0,3,94,46,525,'',155,1,1,3,7,37,1),(595,0,3,94,46,525,'',155,1,2,3,7,37,1),(596,0,3,56,51,250,'',155,1,2,3,7,37,1),(597,0,3,67,106,20,'',155,1,1,3,7,37,1),(598,0,3,67,106,20,'',155,1,2,3,7,37,1),(599,0,3,69,107,10,'',155,1,1,3,7,37,1),(600,0,3,69,107,10,'',155,1,2,3,7,37,1),(601,0,3,73,149,9,'EQUIP. DE SALONES CON TIC´S',155,1,1,3,7,37,1),(602,0,3,73,149,9,'EQUIP. DE SALONES CON TIC´S',155,1,2,3,7,37,1),(603,0,3,71,128,11,'PARA EQUIPAMIENTO DE AULAS',155,1,1,3,7,37,1),(604,0,3,71,128,12,'PARA EQUIPAMIENTO DE AULAS',155,1,2,3,7,37,1),(605,0,2,8,2,40,'',157,1,1,3,7,37,1),(606,0,2,8,2,40,'',157,1,2,3,7,37,1),(607,0,2,11,4,50,'',157,1,1,3,7,37,1),(608,0,2,11,4,50,'',157,1,2,3,7,37,1),(609,0,8,8,2,60,'',163,1,1,3,9,26,1),(610,0,8,8,2,60,'',163,1,2,3,9,26,1),(611,0,2,53,48,160,'',157,1,1,3,7,37,1),(612,0,2,53,48,160,'',157,1,2,3,7,37,1),(613,0,2,8,2,30,'',158,1,1,3,6,40,1),(614,0,2,8,2,30,'',158,1,2,3,6,40,1),(615,0,2,11,4,20,'',158,1,1,3,6,40,1),(616,0,2,11,4,20,'',158,1,2,3,6,40,1),(617,0,3,73,110,8,'Equipamiento de aulas',155,1,1,3,7,37,1),(618,0,3,73,110,7,'Equipamiento de aulas',155,1,2,3,7,37,1),(619,0,2,12,5,20,'',158,1,1,3,6,40,1),(620,0,2,12,5,20,'',158,1,2,3,6,40,1),(621,0,2,13,7,50,'',158,1,1,3,6,40,1),(622,0,2,13,7,50,'',158,1,2,3,6,40,1),(623,0,2,29,21,5,'',158,1,1,3,6,40,1),(624,0,2,29,21,5,'',158,1,2,3,6,40,1),(625,0,2,35,26,5,'',158,1,1,3,6,40,1),(626,0,2,35,26,5,'',158,1,2,3,6,40,1),(627,0,2,67,61,120,'',158,1,1,3,6,40,1),(628,0,2,67,61,120,'',158,1,2,3,6,40,1),(629,0,2,69,64,50,'',158,1,1,3,6,40,1),(630,0,2,69,64,50,'',158,1,2,3,6,40,1),(631,0,3,79,111,8,'Equipamiento de aulas',155,1,1,3,7,37,1),(632,0,3,79,111,8,'Equipamiento de aulas',155,1,2,3,7,37,1),(633,0,2,8,2,20,'',161,1,1,2,4,31,1),(634,0,2,8,2,20,'',161,1,2,2,4,31,1),(635,0,2,12,5,20,'',161,1,1,2,4,31,1),(636,0,2,12,5,20,'',161,1,2,2,4,31,1),(637,0,2,13,7,225,'',161,1,1,2,4,31,1),(638,0,2,13,7,225,'',161,1,2,2,4,31,1),(639,0,2,29,21,15,'',161,1,1,2,4,31,1),(640,0,2,29,21,15,'',161,1,2,2,4,31,1),(641,0,2,60,55,60,'',161,1,2,2,4,31,1),(642,0,2,60,55,60,'',161,1,2,2,4,31,1),(643,0,3,79,140,2,'Equipamiento de lab. y areas adminsitrativas',155,1,1,3,7,37,1),(644,0,3,79,140,2,'Equipamiento de lab. y areas adminsitrativas',155,1,2,3,7,37,1),(645,0,8,12,104,10,'',163,1,1,3,9,26,1),(646,0,8,12,104,10,'',163,1,2,3,9,26,1),(647,0,2,64,57,75,'',161,1,1,2,4,31,1),(648,0,2,64,57,75,'',161,1,2,2,4,31,1),(649,0,2,67,61,40,'',161,1,1,2,4,31,1),(650,0,2,67,61,40,'',161,1,2,2,4,31,1),(651,0,8,12,105,2,'',163,1,1,3,9,26,1),(652,0,8,12,105,2,'',163,1,2,3,9,26,1),(653,0,2,69,64,20,'',161,1,1,2,4,31,1),(654,0,2,69,64,20,'',161,1,2,2,4,31,1),(655,0,2,44,33,25,'',161,1,1,2,4,31,1),(656,0,2,44,33,25,'',161,1,2,2,4,31,1),(657,0,2,13,7,35,'',162,1,1,1,1,15,1),(658,0,2,13,7,35,'',162,1,2,1,1,15,1),(659,0,8,15,8,12,'',163,1,1,3,9,26,1),(660,0,8,15,8,12,'',163,1,2,3,9,26,1),(661,0,3,79,156,1,'PARA USO DEL LAB. DE COMPUTO DE ELECTRONICA',155,1,2,3,7,37,1),(662,0,2,85,155,75,'',162,1,1,1,1,15,1),(663,0,2,85,155,75,'',162,1,2,1,1,15,1),(664,0,3,79,160,2,'PARA USO DE INTERNET DE LOS ALUMNOS',155,1,2,3,7,37,1),(665,0,3,72,158,1,'EL PROGRAMA NECESITA ESTE SERVICIO PARA LOS ALUMNOS Y REPRODUCCION DE MATERIAL',155,1,1,3,7,37,1),(666,0,8,73,154,1,'PARA EVENTOS DEPORTIVOS Y CULTURALES.',163,1,1,3,9,26,1),(667,0,3,71,159,1,'RESGUARDAR LOS DOCUMENTOS DE LOS PARTICIPANTES',155,1,2,3,7,37,1),(668,0,8,73,110,1,'PARA EVENTOS DEPORTIVOS Y CULTURALES.',163,1,1,3,9,26,1),(669,0,3,72,161,8,'PARA AULAS ',155,1,1,3,7,37,1),(670,0,3,72,161,9,'PARA AULAS ',155,1,2,3,7,37,1),(671,0,8,79,111,1,'PARA EL PROCESO DE INSCRIPCIONES DEL DEPARTAMENTO.',163,1,2,3,9,26,1),(672,0,6,8,2,10,'',170,1,1,2,4,29,1),(673,0,6,8,2,10,'',170,1,2,2,4,29,1),(674,0,6,12,5,30,'',170,1,1,2,4,29,1),(675,0,6,12,5,50,'',170,1,2,2,4,29,1),(676,0,6,13,7,50,'',170,1,1,2,4,29,1),(677,0,6,15,8,24,'',170,1,2,2,4,29,1),(678,0,6,16,9,24,'',170,1,1,2,4,29,1),(679,0,8,85,155,300,'',163,1,1,3,9,26,1),(680,0,6,79,163,1,'PARA LA IMPRESION DE DOCUMENTOS DE ALUMNOS DE SERVICIO SOCIAL, RESIDENTES Y EGRESADOS',170,1,1,2,4,29,1),(681,0,6,49,43,20,'',170,1,2,2,4,29,1),(682,0,8,85,155,353,'',164,1,2,3,9,26,1),(683,0,6,53,48,20,'',170,1,1,2,4,29,1),(684,0,6,54,50,10,'',170,1,1,2,4,29,1),(685,0,6,69,64,25,'',170,1,1,2,4,29,1),(686,0,6,69,64,25,'',170,1,2,2,4,29,1),(687,0,6,67,61,25,'',170,1,1,2,4,29,1),(688,0,6,67,61,25,'',170,1,2,2,4,29,1),(689,0,8,69,108,18,'',164,1,2,3,9,26,1),(690,0,6,7,1,500,'',171,1,1,1,1,28,1),(691,0,6,7,1,500,'',171,1,2,1,1,28,1),(692,0,6,102,116,210,'',171,1,1,1,1,28,1),(693,0,6,102,116,210,'',171,1,2,1,1,28,1),(694,0,6,8,2,50,'',171,1,1,1,1,28,1),(695,0,6,8,2,50,'',171,1,2,1,1,28,1),(696,0,6,12,5,25,'',171,1,1,1,1,28,1),(697,0,6,12,5,25,'',171,1,2,1,1,28,1),(698,0,6,65,58,75,'',171,1,1,1,1,28,1),(699,0,6,65,58,75,'',171,1,2,1,1,28,1),(700,0,2,86,124,75,'',162,1,1,1,1,15,1),(701,0,2,86,124,75,'',162,1,2,1,1,15,1),(702,0,6,94,46,250,'',171,1,1,1,1,28,1),(703,0,6,94,46,250,'',171,1,2,1,1,28,1),(704,0,2,29,21,15,'',162,1,1,1,1,15,1),(705,0,2,29,21,15,'',162,1,2,1,1,15,1),(706,0,6,8,2,10,'',172,1,1,2,4,35,1),(707,0,6,8,2,10,'',172,1,2,2,4,35,1),(708,0,6,13,7,20,'',172,1,1,2,4,35,1),(709,0,6,13,7,20,'',172,1,2,2,4,35,1),(710,0,2,71,162,2,'PARA USO DE PERSONAL ADMINISTRATIVO ',156,1,1,1,1,1,1),(711,0,6,94,46,10,'',172,1,1,2,4,35,1),(712,0,6,94,46,10,'',172,1,2,2,4,35,1),(713,0,6,67,61,10,'',172,1,1,2,4,35,1),(714,0,6,67,61,10,'',172,1,2,2,4,35,1),(715,0,8,85,155,692,'',165,1,2,3,9,26,1),(716,0,6,15,8,10,'',175,1,1,2,4,31,1),(717,0,6,20,11,10,'',175,1,2,2,4,31,1),(718,0,6,29,21,450,'',175,1,1,2,4,31,1),(719,0,6,29,21,400,'',175,1,2,2,4,31,1),(720,0,6,32,23,60,'',175,1,1,2,4,31,1),(721,0,6,32,23,60,'',175,1,2,2,4,31,1),(722,0,8,69,108,38,'',165,1,2,3,9,26,1),(723,0,6,23,14,10,'',175,1,1,2,4,31,1),(724,0,6,23,14,10,'',175,1,2,2,4,31,1),(725,0,6,8,2,10,'',175,1,1,2,4,31,1),(726,0,6,8,2,10,'',175,1,2,2,4,31,1),(727,0,6,13,7,35,'',175,1,1,2,4,31,1),(728,0,6,13,7,30,'',175,1,2,2,4,31,1),(729,0,2,77,186,1,'PARA MANTENER INFORMADA A LA COMUNIDAD TECNOLOGICA',156,1,2,1,1,1,1),(730,0,6,22,13,75,'',175,1,1,2,4,31,1),(731,0,6,22,13,75,'',175,1,2,2,4,31,1),(732,0,6,12,5,35,'',175,1,1,2,4,31,1),(733,0,6,12,5,35,'',175,1,2,2,4,31,1),(734,0,6,59,54,12,'',175,1,1,2,4,31,1),(735,0,6,59,54,13,'',175,1,2,2,4,31,1),(736,0,6,100,35,50,'',175,1,1,2,4,31,1),(737,0,6,100,35,50,'',175,1,2,2,4,31,1),(738,0,6,44,33,25,'',175,1,1,2,4,31,1),(739,0,6,44,33,25,'',175,1,2,2,4,31,1),(740,0,6,91,39,15,'',175,1,1,2,4,31,1),(741,0,6,91,39,15,'',175,1,2,2,4,31,1),(742,0,6,35,26,15,'',175,1,1,2,4,31,1),(743,0,6,35,26,15,'',175,1,2,2,4,31,1),(744,0,8,85,155,1254,'',166,1,1,3,9,26,1),(745,0,8,69,108,22,'',166,1,1,3,9,26,1),(746,0,2,79,111,1,'ATENCION DE ALUMNOS EN INSCRIPCIONES Y REINSCRIPCIONES.',156,1,1,1,1,1,1),(747,0,2,79,140,1,'PARA USO DE LA SECRETARIA YA QUE NO CUENTA CON EQUIPO DE IMPRESION',156,1,1,1,1,1,1),(748,0,8,49,43,70,'',166,1,1,3,9,26,1),(749,0,2,73,110,1,'PARA EQUIPAMIENTO DE LA SALA DE JUNTAS',156,1,1,1,1,1,1),(750,0,8,85,155,520,'',167,1,2,3,9,26,1),(751,0,6,15,8,10,'',173,1,1,1,1,27,1),(752,0,6,8,2,7,'',173,1,1,1,1,27,1),(753,0,6,8,2,8,'',173,1,2,1,1,27,1),(754,0,6,12,5,35,'',173,1,1,1,1,27,1),(755,0,6,12,5,35,'',173,1,2,1,1,27,1),(756,0,8,85,155,202,'',167,1,2,3,9,26,1),(757,0,6,13,7,50,'',173,1,1,1,1,27,1),(758,0,6,13,7,60,'',173,1,2,1,1,27,1),(759,0,6,22,13,70,'',173,1,1,1,1,27,1),(760,0,6,22,13,70,'',173,1,2,1,1,27,1),(761,0,6,20,11,22,'',173,1,1,1,1,27,1),(762,0,6,20,11,13,'',173,1,2,1,1,27,1),(763,0,8,69,108,11,'',167,1,2,3,9,26,1),(764,0,6,29,21,40,'',173,1,1,1,1,27,1),(765,0,6,29,21,40,'',173,1,2,1,1,27,1),(766,0,8,29,21,142,'',167,1,2,3,9,26,1),(767,0,6,67,61,120,'',173,1,1,1,1,27,1),(768,0,6,67,61,130,'',173,1,2,1,1,27,1),(769,0,6,69,64,100,'',173,1,1,1,1,27,1),(770,0,6,69,64,100,'',173,1,2,1,1,27,1),(771,0,8,32,23,315,'',167,1,2,3,9,26,1),(772,0,6,49,43,50,'',173,1,1,1,1,27,1),(773,0,6,49,43,50,'',173,1,2,1,1,27,1),(774,0,6,35,26,10,'',173,1,1,1,1,27,1),(775,0,6,35,26,10,'',173,1,2,1,1,27,1),(776,0,6,100,35,30,'',173,1,1,1,1,27,1),(777,0,6,100,35,40,'',173,1,2,1,1,27,1),(778,0,6,44,33,50,'',173,1,1,1,1,27,1),(779,0,6,44,33,50,'',173,1,2,1,1,27,1),(780,0,6,65,58,500,'',173,1,1,1,1,27,1),(781,0,6,65,58,500,'',173,1,2,1,1,27,1),(782,0,6,86,124,625,'',173,1,1,1,1,27,1),(783,0,6,86,124,625,'',173,1,2,1,1,27,1),(784,0,2,8,2,20,'',162,1,1,1,1,15,1),(785,0,2,8,2,20,'',162,1,2,1,1,15,1),(786,0,6,79,165,1,'PARA PROYECCION Y CAPTURA DE DATOS REFERENTES A SERVICIOS SOCIAL, RESIDENTES Y EVENTOS DE VINCULACION',173,1,1,1,1,27,1),(787,0,6,8,2,25,'',174,1,1,2,4,33,1),(788,0,6,8,2,25,'',174,1,2,2,4,33,1),(789,0,6,12,5,25,'',174,1,1,2,4,33,1),(790,0,6,12,5,25,'',174,1,2,2,4,33,1),(791,0,6,13,7,50,'',174,1,1,2,4,33,1),(792,0,6,13,7,50,'',174,1,2,2,4,33,1),(793,0,8,32,23,500,'',169,1,1,3,9,26,1),(794,0,8,85,167,800,'',168,1,1,3,9,26,1),(795,0,8,32,23,460,'',168,1,1,3,9,26,1),(796,0,8,99,25,240,'',168,1,1,3,9,26,1),(797,0,6,8,2,200,'',182,1,2,2,4,31,1),(798,0,6,11,4,700,'',182,1,2,2,4,31,1),(799,0,6,67,61,700,'',182,1,2,2,4,31,1),(800,0,20,8,2,5,'',128,1,1,1,2,4,1),(801,0,20,8,2,5,'',128,1,2,1,2,4,1),(802,0,6,69,64,300,'',182,1,2,2,4,31,1),(803,0,6,64,57,700,'',182,1,2,2,4,31,1),(804,0,20,72,150,1,'Proceso de documentos para la Maestria en Mecatronica',128,1,1,1,2,4,1),(805,0,20,79,111,1,'Procesamiento de información para la Maestría en Mecatrónica',128,1,1,1,2,4,1),(806,0,20,8,2,5,'',129,1,1,1,2,4,1),(807,0,20,8,2,5,'',129,1,2,1,2,4,1),(808,0,3,52,47,2500,'',155,1,1,3,7,37,1),(809,0,3,52,47,2500,'',155,1,2,3,7,37,1),(810,0,20,88,6,2,'',130,1,1,1,2,4,1),(811,0,20,88,6,2,'',130,1,2,1,2,4,1),(812,0,3,71,126,3,'PARA ADECUAR LOS ESPACIOS DEL EDIFICIO Q PARA EL DIPLOMADO PROFORDEMS',155,1,1,3,7,37,1),(813,0,3,71,126,3,'PARA ADECUAR LOS ESPACIOS DEL EDIFICIO Q PARA EL DIPLOMADO PROFORDEMS',155,1,2,3,7,37,1),(814,0,20,55,49,10,'',129,1,1,1,2,4,1),(815,0,20,55,49,10,'',129,1,2,1,2,4,1),(816,0,20,28,20,5,'',129,1,1,1,2,4,1),(817,0,20,28,20,5,'',129,1,2,1,2,4,1),(818,0,3,12,105,11,'',155,1,1,3,7,37,1),(819,0,3,12,105,11,'',155,1,2,3,7,37,1),(820,0,20,8,2,5,'',130,1,1,1,2,4,1),(821,0,20,12,5,2,'',131,1,1,1,2,4,1),(822,0,20,12,5,2,'',131,1,2,1,2,4,1),(823,0,20,65,58,20,'',132,1,1,1,2,8,1),(824,0,20,65,58,20,'',132,1,2,1,2,8,1),(825,0,20,67,61,20,'',132,1,1,1,2,8,1),(826,0,20,67,61,20,'',132,1,2,1,2,8,1),(827,0,20,69,108,2,'',132,1,1,1,2,8,1),(828,0,20,69,108,2,'',132,1,2,1,2,8,1),(829,0,20,69,107,2,'',132,1,1,1,2,8,1),(830,0,20,69,107,2,'',132,1,2,1,2,8,1),(831,0,20,8,2,2,'',133,1,1,1,2,8,1),(832,0,20,8,2,2,'',133,1,2,1,2,8,1),(833,0,20,12,105,1,'',133,1,1,1,2,8,1),(834,0,20,12,105,1,'',133,1,2,1,2,8,1),(835,0,20,67,61,15,'',141,1,1,1,2,16,1),(836,0,20,67,61,15,'',141,1,2,1,2,16,1),(837,0,20,69,108,2,'',141,1,1,1,2,16,1),(838,0,20,69,108,2,'',141,1,2,1,2,16,1),(839,0,20,59,54,2,'',141,1,1,1,2,16,1),(840,0,20,59,54,2,'',141,1,2,1,2,16,1),(841,0,20,8,2,5,'',145,1,1,1,2,36,1),(842,0,20,8,2,5,'',145,1,2,1,2,36,1),(843,0,20,8,2,5,'',139,1,1,1,2,11,1),(844,0,20,8,2,5,'',139,1,2,1,2,11,1),(845,0,20,65,58,10,'',142,1,1,1,2,32,1),(846,0,20,65,58,30,'',142,1,2,1,2,32,1),(847,0,20,8,2,5,'',132,1,1,1,2,8,1),(848,0,20,8,2,5,'',132,1,2,1,2,8,1),(849,0,20,86,124,20,'',146,1,2,1,2,36,1),(850,0,20,8,2,5,'',140,1,1,1,2,16,1),(851,0,20,8,2,5,'',140,1,2,1,2,16,1),(852,0,20,67,61,10,'',143,1,1,1,2,32,1),(853,0,20,67,61,20,'',143,1,2,1,2,32,1),(854,0,20,67,61,5,'',137,1,1,1,2,10,1),(855,0,20,67,61,15,'',137,1,2,1,2,10,1),(856,0,20,12,105,1,'',139,1,1,1,2,11,1),(857,0,20,12,105,2,'',139,1,2,1,2,11,1),(858,0,20,8,2,10,'',135,1,1,1,3,9,1),(859,0,20,8,2,10,'',135,1,2,1,3,9,1),(860,0,20,28,20,10,'',129,1,1,1,2,4,1),(861,0,20,28,20,10,'',129,1,2,1,2,4,1),(862,0,20,55,49,5,'',136,1,1,1,2,10,1),(863,0,20,55,49,5,'',136,1,2,1,2,10,1),(864,0,20,16,9,5,'',128,1,1,1,2,4,1),(865,0,20,16,9,15,'',128,1,2,1,2,4,1),(866,0,20,8,2,10,'',142,1,1,1,2,32,1),(867,0,20,8,2,10,'',142,1,2,1,2,32,1),(868,0,20,90,16,10,'',129,1,1,1,2,4,1),(869,0,20,90,16,10,'',129,1,2,1,2,4,1),(870,0,20,8,2,10,'',140,1,1,1,2,16,1),(871,0,20,8,2,10,'',140,1,2,1,2,16,1),(872,0,20,12,104,1,'',135,1,1,1,3,9,1),(873,0,20,12,104,2,'',135,1,2,1,3,9,1),(874,0,20,12,104,1,'',128,1,1,1,2,4,1),(875,0,20,12,104,1,'',128,1,2,1,2,4,1),(876,0,20,8,2,5,'',137,1,1,1,2,10,1),(877,0,20,8,2,5,'',137,1,2,1,2,10,1),(878,0,20,16,9,3,'',129,1,1,1,2,4,1),(879,0,20,16,9,15,'',129,1,2,1,2,4,1),(880,0,8,12,5,20,'',166,1,1,3,9,26,1),(881,0,8,8,2,50,'',166,1,1,3,9,26,1),(882,0,8,102,136,70,'',166,1,1,3,9,26,1),(883,0,8,99,25,150,'',166,1,1,3,9,26,1),(884,0,8,20,11,10,'',166,1,1,3,9,26,1),(885,0,8,32,23,400,'',166,1,1,3,9,26,1),(886,0,8,85,155,350,'',166,1,1,3,9,26,1),(887,0,8,29,21,120,'',166,1,1,3,9,26,1),(888,0,8,49,43,50,'',166,1,1,3,9,26,1),(889,0,8,85,155,240,'',164,1,2,3,9,26,1),(890,0,10,79,111,3,'PARA USO DE BASE DE DATOS Y DE ACCESO A INTERNET',184,1,1,3,8,21,1),(891,0,10,79,111,4,'PARA USO DE BASE DE DATOS Y DE ACCESO A INTERNET',184,1,2,3,8,21,1),(892,0,10,79,140,1,'PARA RESPALDO DE LOS PRESTAMOS EXTERNOS Y DOCUMENTACION GENERAL DEL DEPARTAMENTO',184,1,1,3,8,21,1),(893,0,10,79,168,1,'PARA ELABORACION DE ETIQUETAS Y TARJETAS CATALOGRAFICAS Y DE PRESTAMOS',184,1,1,3,8,21,1),(894,0,8,74,169,3,'CONFORMACION DE UNA RONDAYA',169,1,1,3,9,26,1),(895,0,8,74,170,12,'CONFORMACION DE UNA RONDAYA',169,1,1,3,9,26,1),(896,0,8,74,171,1,'CONFORMACION DE UNA RONDAYA',169,1,1,3,9,26,1),(897,0,6,7,1,420,'',190,1,1,1,1,3,1),(898,0,6,7,1,420,'',190,1,2,1,1,3,1),(899,0,12,71,172,1,'REMPLAZO DE INMOBILIARIO DETERIORADO Y DESCOMPUESTO DEL DEPARTAMENTO',99,1,1,1,1,19,1),(900,0,6,7,1,700,'',192,1,2,1,1,3,1),(901,0,6,8,2,50,'',192,1,2,1,1,3,1),(902,0,12,71,128,2,'PARA REMPLAZAR INMOBILIARIO DETERIORADO DEL DEPARTAMENTO',99,1,1,1,1,19,1),(903,0,6,16,9,50,'',192,1,2,1,1,3,1),(904,0,6,15,8,200,'',192,1,2,1,1,3,1),(905,0,6,73,110,3,'EQUIPAMIENTO DE AULAS CON TIC´S',192,1,2,1,1,3,1),(906,0,6,8,2,30,'',190,1,1,1,1,3,1),(907,0,6,8,2,30,'',190,1,2,1,1,3,1),(908,0,6,12,5,60,'',190,1,1,1,1,3,1),(909,0,6,12,5,60,'',190,1,2,1,1,3,1),(910,0,6,12,5,5,'',190,1,1,1,1,3,1),(911,0,6,12,5,5,'',190,1,2,1,1,3,1),(912,0,6,16,9,5,'',190,1,1,1,1,3,1),(913,0,6,16,9,5,'',190,1,2,1,1,3,1),(914,0,6,22,13,40,'',190,1,1,1,1,3,1),(915,0,6,22,13,40,'',190,1,2,1,1,3,1),(916,0,6,73,110,3,'PARA LAS TRES SALAS DE LOS LABORATORIOS DE SISTEMAS',190,1,1,1,1,3,1),(917,0,6,79,173,2,'PARA EQUPAMIENTO DE LAS SALAS DE LABORATORIOS DE SISTEMAS',190,1,1,1,1,3,1),(918,0,6,73,174,3,'PARA USO EN LOS LABORATORIOS DE SISTEMAS',190,1,1,1,1,3,1),(919,0,6,79,175,2,'PARA USO EN LOS LABORATORIOS DE SISTEMAS',190,1,1,1,1,3,1),(920,0,6,79,176,1,'PARA SERVICIO DE IMPRESION A LOS DOCENTES',190,1,1,1,1,3,1),(921,0,6,79,173,6,'PARA USO DE LOS DOCENTES EN LOS LABORATORIOS Y APLICACION DE TICS AL AULA',190,1,2,1,1,3,1),(922,0,6,7,1,550,'',193,1,1,1,1,3,1),(923,0,6,7,1,550,'',193,1,2,1,1,3,1),(924,0,6,56,51,145,'',193,1,1,1,1,3,1),(925,0,6,56,51,145,'',193,1,2,1,1,3,1),(926,0,6,16,9,230,'',193,1,1,1,1,3,1),(927,0,6,16,9,230,'',193,1,2,1,1,3,1),(928,0,6,13,7,60,'',193,1,1,1,1,3,1),(929,0,6,13,7,60,'',193,1,2,1,1,3,1),(930,0,6,8,2,90,'',193,1,1,1,1,3,1),(931,0,6,8,2,90,'',193,1,2,1,1,3,1),(932,0,6,23,14,200,'',193,1,1,1,1,3,1),(933,0,6,23,14,200,'',193,1,2,1,1,3,1),(934,0,6,7,1,585,'',193,1,1,1,1,3,1),(935,0,6,7,1,585,'',193,1,2,1,1,3,1),(936,0,6,16,9,400,'',193,1,1,1,1,3,1),(937,0,6,16,9,400,'',193,1,2,1,1,3,1),(938,0,6,13,7,60,'',193,1,1,1,1,3,1),(939,0,6,13,7,60,'',193,1,2,1,1,3,1),(940,0,6,8,2,90,'',193,1,1,1,1,3,1),(941,0,6,8,2,90,'',193,1,2,1,1,3,1),(942,0,6,16,9,100,'',193,1,1,1,1,3,1),(943,0,6,16,9,100,'',193,1,2,1,1,3,1),(944,0,6,23,14,100,'',193,1,1,1,1,3,1),(945,0,6,23,14,100,'',193,1,2,1,1,3,1),(946,0,6,23,14,100,'',193,1,1,1,1,3,1),(947,0,6,23,14,100,'',193,1,2,1,1,3,1),(948,0,6,7,1,210,'',194,1,1,1,1,3,1),(949,0,6,7,1,210,'',194,1,2,1,1,3,1),(950,0,6,79,111,3,'NECEARIA PARA LA IMPARTICION DE LOS CURSOS DE TITULACION DE ING QUIMICA Y BIOQUIMICA',194,1,1,1,1,3,1),(951,0,6,73,110,4,'NESACARIA PARA LA IMPARTICION DE CURSOS DE TITULACION DE ING. QUIMICA Y BIOQUIMICA',194,1,1,1,1,3,1),(952,0,6,8,2,40,'',194,1,1,1,1,3,1),(953,0,6,8,2,40,'',194,1,2,1,1,3,1),(954,0,6,82,177,1,'NESACARIA PARA LA IMPARTICION DE CURSOS DE TITULACION DE ING. QUIMICA Y BIOQUIMICA ',194,1,1,1,1,3,1),(955,0,6,82,178,1,'NESACARIA PARA LA IMPARTICION DE CURSOS DE TITULACION DE ING. QUIMICA Y BIOQUIMICA ',194,1,1,1,1,3,1),(956,0,6,82,181,1,'NESACARIA PARA LA IMPARTICION DE CURSOS DE TITULACION DE ING. QUIMICA Y BIOQUIMICA ',194,1,1,1,1,3,1),(957,0,6,82,179,1,'NESACARIA PARA LA IMPARTICION DE CURSOS DE TITULACION DE ING. QUIMICA Y BIOQUIMICA ',194,1,1,1,1,3,1),(958,0,6,82,122,1,'NESACARIA PARA LA IMPARTICION DE CURSOS DE TITULACION DE ING. QUIMICA Y BIOQUIMICA ',194,1,1,1,1,3,1),(959,0,7,88,6,40,'',54,1,1,3,7,38,1),(960,0,7,88,6,40,'',54,1,2,3,7,38,1),(961,0,7,8,2,50,'',55,1,1,3,7,38,1),(962,0,7,8,2,50,'',55,1,2,3,7,38,1),(963,0,7,12,5,140,'',55,1,1,3,7,38,1),(964,0,7,12,5,140,'',55,1,2,3,7,38,1),(965,0,7,38,37,25,'',55,1,1,3,7,38,1),(966,0,7,38,37,25,'',55,1,2,3,7,38,1),(967,0,7,43,32,40,'',55,1,1,3,7,38,1),(968,0,7,43,32,50,'',55,1,2,3,7,38,1),(969,0,7,67,61,30,'',55,1,1,3,7,38,1),(970,0,7,67,61,40,'',55,1,2,3,7,38,1),(971,0,7,69,64,30,'',55,1,1,3,7,38,1),(972,0,7,69,64,30,'',55,1,2,3,7,38,1),(973,0,7,72,182,1,'PARA CUBRIR LAS ACTIVIDADES ACADEMICAS, EVENTOS CULTURALES Y DEPORTIVOS DE LA INSTITUCION',55,1,1,3,7,38,1),(974,0,7,73,183,2,'PARA CUBRIR LAS ACTIVIDADES ACADEMICAS, EVENTOS CULTURALES Y DEPORTIVOS DE LA INSTITUCION',55,1,1,3,7,38,1),(975,0,10,8,2,55,'',185,1,1,3,8,21,1),(976,0,10,8,2,55,'',185,1,2,3,8,21,1),(977,0,10,15,8,3,'',185,1,1,3,8,21,1),(978,0,10,15,8,2,'',185,1,2,3,8,21,1),(979,0,10,16,9,15,'',185,1,1,3,8,21,1),(980,0,10,16,9,15,'',185,1,2,3,8,21,1),(981,0,10,90,16,1,'',185,1,1,3,8,21,1),(982,0,10,90,16,1,'',185,1,2,3,8,21,1),(983,0,10,35,26,1,'',185,1,1,3,8,21,1),(984,0,10,35,26,2,'',185,1,2,3,8,21,1),(985,0,10,12,5,25,'',186,1,1,3,8,21,1),(986,0,10,12,5,25,'',186,1,2,3,8,21,1),(987,0,10,67,61,30,'',186,1,1,3,8,21,1),(988,0,10,67,61,30,'',186,1,2,3,8,21,1),(989,0,10,69,107,4,'',186,1,1,3,8,21,1),(990,0,10,69,107,5,'',186,1,2,3,8,21,1),(991,0,10,88,6,500,'',187,1,1,3,8,21,1),(992,0,10,88,6,500,'',187,1,2,3,8,21,1),(993,0,10,88,6,1000,'',188,1,1,3,8,21,1),(994,0,10,88,6,1000,'',188,1,2,3,8,21,1),(995,0,10,8,2,10,'',189,1,1,3,8,21,1),(996,0,10,8,2,10,'',189,1,2,3,8,21,1),(997,0,10,11,4,15,'',189,1,1,3,8,21,1),(998,0,10,11,4,15,'',189,1,2,3,8,21,1),(999,0,10,20,11,50,'',189,1,1,3,8,21,1),(1000,0,10,20,11,50,'',189,1,2,3,8,21,1),(1001,0,6,7,1,420,'',195,1,1,1,1,3,1),(1002,0,6,7,1,420,'',195,1,2,1,1,3,1),(1003,0,6,54,50,390,'',195,1,1,1,1,3,1),(1004,0,6,54,50,390,'',195,1,2,1,1,3,1),(1005,0,1,8,2,60,'',183,1,1,2,4,31,1),(1006,0,1,8,2,60,'',183,1,2,2,4,31,1),(1007,0,3,7,1,26100,'',196,1,1,2,4,31,1),(1008,0,3,7,1,26100,'',196,1,2,2,4,31,1),(1009,0,1,12,5,50,'',183,1,1,2,4,31,1),(1010,0,1,12,5,40,'',183,1,2,2,4,31,1),(1011,0,1,13,7,600,'',183,1,1,2,4,31,1),(1012,0,1,13,7,600,'',183,1,2,2,4,31,1),(1013,0,1,16,9,4,'',183,1,1,2,4,31,1),(1014,0,1,16,9,4,'',183,1,2,2,4,31,1),(1015,0,1,22,13,40,'',183,1,1,2,4,31,1),(1016,0,1,22,13,40,'',183,1,2,2,4,31,1),(1017,0,1,26,18,30,'',183,1,1,2,4,31,1),(1018,0,1,26,18,30,'',183,1,2,2,4,31,1),(1019,0,1,29,21,60,'',183,1,1,2,4,31,1),(1020,0,1,29,21,60,'',183,1,2,2,4,31,1),(1021,0,1,32,23,10,'',183,1,1,2,4,31,1),(1022,0,1,32,23,10,'',183,1,2,2,4,31,1),(1023,0,1,35,26,15,'',183,1,1,2,4,31,1),(1024,0,1,35,26,15,'',183,1,2,2,4,31,1),(1025,0,1,91,39,4,'',183,1,1,2,4,31,1),(1026,0,1,91,39,3,'',183,1,2,2,4,31,1),(1027,0,1,49,43,75,'',183,1,1,2,4,31,1),(1028,0,1,49,43,75,'',183,1,2,2,4,31,1),(1029,0,1,94,46,3,'',183,1,1,2,4,31,1),(1030,0,1,94,46,2,'',183,1,2,2,4,31,1),(1031,0,1,56,51,330,'',183,1,1,2,4,31,1),(1032,0,1,56,51,330,'',183,1,2,2,4,31,1),(1033,0,1,59,54,20,'',183,1,1,2,4,31,1),(1034,0,1,59,54,20,'',183,1,2,2,4,31,1),(1035,0,1,64,57,150,'',183,1,1,2,4,31,1),(1036,0,1,64,57,160,'',183,1,2,2,4,31,1),(1037,0,1,67,61,400,'',183,1,1,2,4,31,1),(1038,0,1,67,61,400,'',183,1,2,2,4,31,1),(1039,0,1,69,64,350,'',183,1,1,2,4,31,1),(1040,0,1,69,64,350,'',183,1,2,2,4,31,1),(1041,0,1,71,184,1,'PARA SALA DE ESPERA PARA LA DIRECCION',183,1,1,2,4,31,1),(1042,0,4,37,28,850,'',200,1,1,4,12,42,1),(1043,0,4,37,28,850,'',200,1,2,4,12,42,1),(1044,0,4,72,161,6,'CAMBIO DE EQUIPOS DE AIRE ACONDICIONADO INTEGRALES POR CLIMAS DE VENTANA, PARA AHORRO DE ENERGIA EN LOS EDIF. A Y AB',198,1,1,4,11,7,1),(1045,0,4,72,161,7,'CAMBIO DE EQUIPOS DE AIRE ACONDICIONADO INTEGRALES POR CLIMAS DE VENTANA, PARA AHORRO DE ENERGIA EN LOS EDIF. A Y AB',198,1,2,4,11,7,1),(1046,0,4,8,2,25,'',202,1,1,4,12,42,1),(1047,0,4,8,2,25,'',202,1,2,4,12,42,1),(1048,0,4,67,106,7,'',202,1,1,4,12,42,1),(1049,0,4,67,106,10,'',202,1,2,4,12,42,1),(1050,0,4,69,107,10,'',202,1,1,4,12,42,1),(1051,0,4,69,107,5,'',202,1,2,4,12,42,1),(1052,0,4,8,2,50,'',199,1,1,3,7,38,1),(1053,0,4,8,2,50,'',199,1,2,3,7,38,1),(1054,0,4,13,7,100,'',199,1,1,3,7,38,1),(1055,0,4,13,7,100,'',199,1,2,3,7,38,1),(1056,0,4,67,106,6,'',199,1,1,3,7,38,1),(1057,0,4,67,106,6,'',199,1,2,3,7,38,1),(1058,0,4,69,107,5,'',199,1,1,3,7,38,1),(1059,0,4,69,107,5,'',199,1,2,3,7,38,1),(1060,0,4,12,5,50,'',199,1,1,3,7,38,1),(1061,0,4,12,5,50,'',199,1,2,3,7,38,1),(1062,0,4,29,21,30,'',202,1,1,4,12,42,1),(1063,0,4,29,21,25,'',202,1,2,4,12,42,1),(1064,0,4,49,43,20,'',202,1,1,4,12,42,1),(1065,0,4,49,43,20,'',202,1,2,4,12,42,1),(1066,0,4,13,7,32,'',201,1,1,4,12,42,1),(1067,0,4,13,7,33,'',201,1,2,4,12,42,1),(1068,0,3,72,185,50,'ENGARGOLADORA DE ARILLO METALICO',204,1,1,4,11,7,1),(1069,0,3,12,5,25,'',204,1,1,4,11,7,1),(1070,0,3,12,5,25,'',204,1,2,4,11,7,1),(1071,0,3,8,2,5,'',204,1,1,4,11,7,1),(1072,0,3,8,2,0,'',204,1,2,4,11,7,1),(1073,0,3,8,2,25,'',204,1,1,4,11,7,1),(1074,0,3,8,2,25,'',204,1,2,4,11,7,1),(1075,0,3,59,54,15,'',204,1,1,4,11,7,1),(1076,0,3,69,64,90,'',205,1,1,4,11,7,1),(1077,0,3,69,64,90,'',205,1,2,4,11,7,1),(1078,0,3,67,61,75,'',205,1,1,4,11,7,1),(1079,0,3,67,61,75,'',205,1,2,4,11,7,1),(1080,0,3,38,37,600,'',203,1,1,4,11,7,1),(1081,0,3,38,37,600,'',203,1,2,4,11,7,1),(1082,0,6,71,128,28,'PARA AULAS DE INGLES',206,1,1,1,1,28,1),(1083,0,6,71,128,30,'PARA AULAS DE INGLES',206,1,2,1,1,28,1),(1084,0,6,71,126,10,'PARA AULAS DE INGLES',206,1,1,1,1,28,1),(1085,0,6,71,126,8,'PARA AULAS DE INGLES',206,1,2,1,1,28,1),(1086,0,6,79,111,9,'PARA AULAS DE INGLES',206,1,1,1,1,28,1),(1087,0,6,79,111,10,'PARA AULAS DE INGLES',206,1,2,1,1,28,1),(1088,0,18,79,111,2,'EQUIPAMIENTO DE SALA DE TUTORIAS ',207,1,1,1,1,3,1),(1089,0,18,79,111,2,'EQUIPAMIENTO DE SALA DE TUTORIAS ',207,1,2,1,1,3,1),(1090,0,18,71,126,1,'EQUIPAMIENTO DE SALA DE TUTORIAS',207,1,1,1,1,3,1),(1091,0,18,71,126,1,'EQUIPAMIENTO DE SALA DE TUTORIAS',207,1,2,1,1,3,1),(1092,0,18,71,128,1,'EQUIPAMIENTO DE SALA DE TUTORIAS',207,1,1,1,1,3,1),(1093,0,18,71,128,2,'EQUIPAMIENTO DE SALA DE TUTORIAS',207,1,2,1,1,3,1),(1094,0,18,79,156,2,'EQUIPAMIENTO DE SALA DE TUTORIAS',207,1,2,1,1,3,1),(1095,0,18,73,110,1,'EQUIPAMIENTO DE SALA DE TUTORIAS',207,1,2,1,1,3,1),(1096,0,23,56,51,1500,'',208,2,1,1,1,1,1),(1097,0,23,56,51,1500,'',208,2,2,1,1,1,1),(1098,0,23,23,76,25,'',208,2,1,1,1,1,1),(1099,0,23,23,76,25,'',208,2,2,1,1,1,1),(1100,0,23,20,11,750,'',208,2,1,1,1,1,1),(1101,0,23,20,11,750,'',208,2,2,1,1,1,1),(1102,0,23,57,52,1000,'',208,2,1,1,1,1,1),(1103,0,23,57,52,1000,'',208,2,2,1,1,1,1),(1104,0,23,9,3,250,'',208,2,1,1,1,1,1),(1105,0,23,9,3,250,'',208,2,2,1,1,1,1),(1106,0,20,90,16,1250,'',209,2,1,1,2,16,1),(1107,0,20,90,16,1250,'',209,2,2,1,2,16,1),(1108,0,20,28,20,1250,'',209,2,1,1,2,16,1),(1109,0,20,28,20,1250,'',209,2,2,1,2,16,1),(1110,0,20,8,2,250,'',209,2,1,1,2,16,1),(1111,0,20,8,2,250,'',209,2,2,1,2,16,1),(1112,0,20,55,49,500,'',209,2,1,1,2,16,1),(1113,0,20,55,49,500,'',209,2,2,1,2,16,1);
/*!40000 ALTER TABLE `poa_dpto_apoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poa_dpto_gastos`
--

DROP TABLE IF EXISTS `poa_dpto_gastos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `poa_dpto_gastos` (
  `id` int(11) NOT NULL auto_increment,
  `dpto_id` int(11) NOT NULL,
  `partida_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `justificacion` text NOT NULL,
  `idaccion` int(11) NOT NULL,
  `tipogasto` int(1) NOT NULL,
  `periodo` int(1) NOT NULL,
  `idproceso` int(11) NOT NULL,
  `idactividad` int(11) NOT NULL,
  `idacciones` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `poa_dpto_gastos`
--

LOCK TABLES `poa_dpto_gastos` WRITE;
/*!40000 ALTER TABLE `poa_dpto_gastos` DISABLE KEYS */;
/*!40000 ALTER TABLE `poa_dpto_gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poa_dpto_poa`
--

DROP TABLE IF EXISTS `poa_dpto_poa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `poa_dpto_poa` (
  `idpoa_dpto_apoa` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL,
  `dpto_id` int(11) NOT NULL,
  `partida_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `justificacion` text NOT NULL,
  `idaccion` int(11) NOT NULL,
  `tipogasto` int(1) NOT NULL,
  `periodo` int(1) NOT NULL,
  `idproceso` int(11) NOT NULL,
  `idactividad` int(11) NOT NULL,
  `idacciones` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`idpoa_dpto_apoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `poa_dpto_poa`
--

LOCK TABLES `poa_dpto_poa` WRITE;
/*!40000 ALTER TABLE `poa_dpto_poa` DISABLE KEYS */;
/*!40000 ALTER TABLE `poa_dpto_poa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preacciones`
--

DROP TABLE IF EXISTS `preacciones`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `preacciones` (
  `id` int(11) NOT NULL auto_increment,
  `claveaccion` int(11) NOT NULL,
  `accion` text NOT NULL,
  `enero` int(11) NOT NULL,
  `julio` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `preacciones`
--

LOCK TABLES `preacciones` WRITE;
/*!40000 ALTER TABLE `preacciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `preacciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preacciones_apoa`
--

DROP TABLE IF EXISTS `preacciones_apoa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `preacciones_apoa` (
  `idpreaccion_apoa` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL,
  `claveaccion` int(11) NOT NULL,
  `accion` text NOT NULL,
  `enero` int(11) NOT NULL,
  `julio` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`idpreaccion_apoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `preacciones_apoa`
--

LOCK TABLES `preacciones_apoa` WRITE;
/*!40000 ALTER TABLE `preacciones_apoa` DISABLE KEYS */;
/*!40000 ALTER TABLE `preacciones_apoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preacciones_poa`
--

DROP TABLE IF EXISTS `preacciones_poa`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `preacciones_poa` (
  `idpreaccion_apoa` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL,
  `claveaccion` int(11) NOT NULL,
  `accion` text NOT NULL,
  `enero` int(11) NOT NULL,
  `julio` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `idpoa` int(11) NOT NULL,
  PRIMARY KEY  (`idpreaccion_apoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `preacciones_poa`
--

LOCK TABLES `preacciones_poa` WRITE;
/*!40000 ALTER TABLE `preacciones_poa` DISABLE KEYS */;
/*!40000 ALTER TABLE `preacciones_poa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presupuesto`
--

DROP TABLE IF EXISTS `presupuesto`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `presupuesto` (
  `id` int(11) NOT NULL auto_increment,
  `dpto_id` int(11) NOT NULL,
  `presupuesto` decimal(10,2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `presupuesto`
--

LOCK TABLES `presupuesto` WRITE;
/*!40000 ALTER TABLE `presupuesto` DISABLE KEYS */;
/*!40000 ALTER TABLE `presupuesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proceso`
--

DROP TABLE IF EXISTS `proceso`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `proceso` (
  `id` int(11) NOT NULL auto_increment,
  `nombreproceso` varchar(100) default NULL,
  `claveproceso` varchar(20) default NULL,
  `proyecto` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `proceso`
--

LOCK TABLES `proceso` WRITE;
/*!40000 ALTER TABLE `proceso` DISABLE KEYS */;
INSERT INTO `proceso` VALUES (1,'ACADEMICO','01','01012035E008'),(2,'VINCULACION','02','010220035E08'),(3,'PLANEACION','03','01032035E008'),(4,'CALIDAD','04','01042035E008'),(5,'ADMINISTRACION DE RECURSOS','05','01052035E008');
/*!40000 ALTER TABLE `proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisicion`
--

DROP TABLE IF EXISTS `requisicion`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `requisicion` (
  `idrequisicion` int(11) NOT NULL auto_increment,
  `numero` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idpartida` int(11) NOT NULL,
  `nota` varchar(150) NOT NULL,
  `idproceso` int(11) NOT NULL,
  `idclave` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `idaccion` int(11) NOT NULL,
  `iddpto` int(11) NOT NULL,
  `planea` int(11) NOT NULL,
  `idsolicitud` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  PRIMARY KEY  (`idrequisicion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `requisicion`
--

LOCK TABLES `requisicion` WRITE;
/*!40000 ALTER TABLE `requisicion` DISABLE KEYS */;
/*!40000 ALTER TABLE `requisicion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revision_reportes`
--

DROP TABLE IF EXISTS `revision_reportes`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `revision_reportes` (
  `id` int(11) NOT NULL auto_increment,
  `revision` varchar(30) NOT NULL,
  `tec` varchar(100) NOT NULL,
  `clavetec` varchar(50) NOT NULL,
  `snest` varchar(50) NOT NULL,
  `snest1` varchar(30) NOT NULL,
  `snest2` varchar(30) NOT NULL,
  `snest3` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `revision_reportes`
--

LOCK TABLES `revision_reportes` WRITE;
/*!40000 ALTER TABLE `revision_reportes` DISABLE KEYS */;
INSERT INTO `revision_reportes` VALUES (1,'REV. 5','XYZ','','SNEST-PL-PO-003-01','SNEST-PL-PO-003-02','SNEST-PL-PO-003-03','SNEST-PL-PO-003-04');
/*!40000 ALTER TABLE `revision_reportes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_servicio`
--

DROP TABLE IF EXISTS `solicitud_servicio`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `solicitud_servicio` (
  `idsolicitud` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `vigencia` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `rfc` varchar(30) NOT NULL,
  `domicilio` varchar(150) NOT NULL,
  `idpartida` int(11) NOT NULL,
  `forma_pago` varchar(50) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `planea` int(1) NOT NULL,
  `requisicion` varchar(150) NOT NULL,
  `iddpto` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `idaccion` int(11) NOT NULL,
  `nota` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  PRIMARY KEY  (`idsolicitud`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `solicitud_servicio`
--

LOCK TABLES `solicitud_servicio` WRITE;
/*!40000 ALTER TABLE `solicitud_servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitud_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL auto_increment,
  `nombreusuario` varchar(200) default NULL,
  `tipousuario` int(1) default NULL,
  `dpto_id` int(11) NOT NULL default '0',
  `clave` varchar(250) default NULL,
  `estado` tinyint(1) default NULL,
  `usuario` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (8,'ADMIN',1,0,'ADMIN',1,'ADMIN'),(13,'DIRECCION',3,1,'DIRECCION',1,'DIRECCION'),(14,'ACADEMICA',3,3,'ACADEMICA',1,'ACADEMICA'),(15,'PLANEACION',3,2,'PLANEACION',1,'PLANEACION'),(16,'ADMINISTRATIVA',3,4,'ADMINISTRATIVA',1,'ADMINISTRATIVA'),(20,'INDUSTRIAL',3,15,'INDUSTRIAL',1,'INDUSTRIAL'),(23,'PROGRAMACION',3,5,'PROGRAMACION',1,'PROGRAMACION'),(32,'HUMANOS',3,21,'HUMANOS',1,'HUMANOS'),(33,'FINANCIEROS',3,22,'FINANCIEROS',1,'FINANCIEROS'),(34,'MATERIALES',3,23,'MATERIALES',1,'MATERIALES'),(40,'CAPTURA',4,0,'CAPTURA',1,'CAPTURA');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viaticos`
--

DROP TABLE IF EXISTS `viaticos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `viaticos` (
  `idviaticos` int(11) NOT NULL auto_increment,
  `fecha` date NOT NULL,
  `comisionado` varchar(100) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `clave` varchar(30) NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `periodo` varchar(100) NOT NULL,
  `cuota` int(11) NOT NULL,
  `dias` float NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `pago` int(1) NOT NULL,
  `jerarquico` int(1) NOT NULL,
  `zona` int(1) NOT NULL,
  `iddpto` int(11) NOT NULL,
  `idpartida` int(11) NOT NULL,
  `idmeta` int(11) NOT NULL,
  `planea` int(1) NOT NULL,
  `nota` varchar(200) NOT NULL,
  PRIMARY KEY  (`idviaticos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `viaticos`
--

LOCK TABLES `viaticos` WRITE;
/*!40000 ALTER TABLE `viaticos` DISABLE KEYS */;
/*!40000 ALTER TABLE `viaticos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-10-12 18:27:07
