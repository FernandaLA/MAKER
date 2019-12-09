-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: maker
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `en_agendamento`
--

DROP TABLE IF EXISTS `en_agendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `en_agendamento` (
  `COD_AGENDAMENTO` int(11) NOT NULL AUTO_INCREMENT,
  `COD_PRESTADOR` int(11) NOT NULL,
  `COD_CLIENTE` int(11) NOT NULL,
  `COD_SERVICO` int(11) NOT NULL,
  `DTA_AGENDAMENTO` date NOT NULL,
  `DSC_HORARIO` time NOT NULL,
  `COD_STATUS` int(11) NOT NULL,
  PRIMARY KEY (`COD_AGENDAMENTO`),
  KEY `EN_AGENDAMENTO_SE_USUARIO_FK` (`COD_PRESTADOR`),
  KEY `EN_AGENDAMENTO_SE_USUARIO_FK_1` (`COD_CLIENTE`),
  KEY `EN_AGENDAMENTO_EN_SERVICO_PRESTADOR_FK` (`COD_SERVICO`),
  KEY `EN_AGENDAMENTO_EN_STATUS_AGENDAMENTO_FK` (`COD_STATUS`),
  CONSTRAINT `EN_AGENDAMENTO_EN_SERVICO_PRESTADOR_FK` FOREIGN KEY (`COD_SERVICO`) REFERENCES `en_servico_prestador` (`COD_SERVICO_PRESTADOR`),
  CONSTRAINT `EN_AGENDAMENTO_EN_STATUS_AGENDAMENTO_FK` FOREIGN KEY (`COD_STATUS`) REFERENCES `en_status_agendamento` (`COD_STATUS`),
  CONSTRAINT `EN_AGENDAMENTO_SE_USUARIO_FK` FOREIGN KEY (`COD_PRESTADOR`) REFERENCES `se_usuario` (`COD_USUARIO`),
  CONSTRAINT `EN_AGENDAMENTO_SE_USUARIO_FK_1` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `se_usuario` (`COD_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `en_agendamento`
--

LOCK TABLES `en_agendamento` WRITE;
/*!40000 ALTER TABLE `en_agendamento` DISABLE KEYS */;
INSERT INTO `en_agendamento` VALUES (1,3,1,1,'2019-11-27','13:00:00',2),(2,3,1,1,'2019-11-28','09:00:00',3),(3,3,2,3,'2019-11-29','09:00:00',4),(4,3,2,6,'2019-11-29','09:00:00',2),(5,3,2,15,'2019-11-29','09:00:00',3),(6,3,2,1,'2019-11-29','09:00:00',2),(7,3,7,1,'2019-11-29','00:00:00',3),(8,3,10,6,'2019-11-04','16:00:00',2),(9,11,10,14,'2019-11-06','12:00:00',4),(10,3,10,15,'2019-12-09','16:00:00',2),(11,3,2,14,'2019-12-02','14:00:00',3),(12,11,2,14,'2019-11-30','13:00:00',1),(13,19,2,17,'2019-12-02','17:00:00',4),(14,19,2,16,'2019-11-30','14:00:00',4),(15,18,2,27,'2019-12-04','19:00:00',2),(16,17,2,22,'2019-11-05','16:00:00',2),(17,11,20,1,'2019-12-03','14:00:00',1),(18,3,20,1,'2019-12-03','16:00:00',1),(19,3,20,1,'2019-12-03','14:00:00',1),(20,3,2,15,'2019-12-04','09:00:00',5),(21,3,2,6,'2019-12-05','14:00:00',5),(22,3,2,3,'2019-12-05','11:00:00',5),(23,19,2,16,'2019-12-03','10:00:00',4),(24,19,2,19,'2019-12-03','14:00:00',4),(25,19,2,18,'2019-12-03','16:00:00',4),(26,19,22,17,'2019-12-11','15:00:00',2),(27,3,2,1,'2019-12-18','16:00:00',2);
/*!40000 ALTER TABLE `en_agendamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_avaliacao`
--

DROP TABLE IF EXISTS `en_avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `en_avaliacao` (
  `COD_AVALIACAO` int(11) NOT NULL AUTO_INCREMENT,
  `COD_USUARIO` int(11) NOT NULL,
  `NRO_NOTA_AVALIACAO` int(11) NOT NULL,
  `DSC_AVALIACAO` varchar(100) DEFAULT NULL,
  `COD_USUARIO_AVALIADO` int(11) NOT NULL,
  `COD_AGENDAMENTO` int(11) NOT NULL,
  PRIMARY KEY (`COD_AVALIACAO`),
  KEY `EN_AVALIACAO_SE_USUARIO_FK` (`COD_USUARIO`),
  KEY `EN_AVALIACAO_SE_USUARIO_FK_1` (`COD_USUARIO_AVALIADO`),
  CONSTRAINT `EN_AVALIACAO_SE_USUARIO_FK` FOREIGN KEY (`COD_USUARIO`) REFERENCES `se_usuario` (`COD_USUARIO`),
  CONSTRAINT `EN_AVALIACAO_SE_USUARIO_FK_1` FOREIGN KEY (`COD_USUARIO_AVALIADO`) REFERENCES `se_usuario` (`COD_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `en_avaliacao`
--

LOCK TABLES `en_avaliacao` WRITE;
/*!40000 ALTER TABLE `en_avaliacao` DISABLE KEYS */;
INSERT INTO `en_avaliacao` VALUES (1,11,5,NULL,10,9),(2,3,5,'Uma Ã³tima cliente!!',2,3),(3,19,5,'Uma Ã³tima cliente!!!',2,13),(4,19,5,NULL,2,14),(5,19,4,NULL,2,24),(6,19,5,'Ã“tima!!!',2,25);
/*!40000 ALTER TABLE `en_avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_categoria_servico`
--

DROP TABLE IF EXISTS `en_categoria_servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `en_categoria_servico` (
  `COD_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT,
  `DSC_CATEGORIA` varchar(50) NOT NULL,
  `IND_ATIVO` char(1) NOT NULL,
  PRIMARY KEY (`COD_CATEGORIA`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `en_categoria_servico`
--

LOCK TABLES `en_categoria_servico` WRITE;
/*!40000 ALTER TABLE `en_categoria_servico` DISABLE KEYS */;
INSERT INTO `en_categoria_servico` VALUES (1,'Depilador','S'),(2,'Cabeleireiro','S'),(3,'Manicure/Pedicure','S'),(4,'Podologo','S');
/*!40000 ALTER TABLE `en_categoria_servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_dias_jornada_prestador`
--

DROP TABLE IF EXISTS `en_dias_jornada_prestador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `en_dias_jornada_prestador` (
  `COD_DIAS_JORNADA_PRESTADOR` int(11) NOT NULL AUTO_INCREMENT,
  `COD_JORNADA_PRESTADOR` int(11) NOT NULL,
  `COD_DIA` int(11) NOT NULL,
  PRIMARY KEY (`COD_DIAS_JORNADA_PRESTADOR`),
  KEY `EN_DIAS_JORNADA_PRESTADOR_EN_JORNADA_PRESTADOR_FK` (`COD_JORNADA_PRESTADOR`),
  CONSTRAINT `EN_DIAS_JORNADA_PRESTADOR_EN_JORNADA_PRESTADOR_FK` FOREIGN KEY (`COD_JORNADA_PRESTADOR`) REFERENCES `en_jornada_prestador` (`COD_JORNADA_PRESTADOR`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `en_dias_jornada_prestador`
--

LOCK TABLES `en_dias_jornada_prestador` WRITE;
/*!40000 ALTER TABLE `en_dias_jornada_prestador` DISABLE KEYS */;
INSERT INTO `en_dias_jornada_prestador` VALUES (9,1,2),(10,1,3),(11,1,4),(12,1,5),(13,1,6),(24,2,2),(25,2,3),(26,2,4),(27,2,5),(28,2,6),(29,3,1),(30,3,2),(31,3,3),(32,3,4),(33,3,5),(34,3,6),(35,3,7),(48,5,2),(49,5,3),(50,5,4),(51,5,5),(52,5,6),(53,5,7),(54,6,1),(55,6,4),(56,6,5),(57,6,6),(58,6,7),(63,4,2),(64,4,3),(65,4,4),(66,4,5);
/*!40000 ALTER TABLE `en_dias_jornada_prestador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_jornada_prestador`
--

DROP TABLE IF EXISTS `en_jornada_prestador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `en_jornada_prestador` (
  `COD_JORNADA_PRESTADOR` int(11) NOT NULL AUTO_INCREMENT,
  `COD_PRESTADOR` int(11) NOT NULL,
  `HRA_INICIO` time NOT NULL,
  `HRA_FIM` time NOT NULL,
  PRIMARY KEY (`COD_JORNADA_PRESTADOR`),
  KEY `EN_JORNADA_PRESTADOR_SE_USUARIO_FK` (`COD_PRESTADOR`),
  CONSTRAINT `EN_JORNADA_PRESTADOR_SE_USUARIO_FK` FOREIGN KEY (`COD_PRESTADOR`) REFERENCES `se_usuario` (`COD_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `en_jornada_prestador`
--

LOCK TABLES `en_jornada_prestador` WRITE;
/*!40000 ALTER TABLE `en_jornada_prestador` DISABLE KEYS */;
INSERT INTO `en_jornada_prestador` VALUES (1,1,'08:00:00','17:00:00'),(2,3,'09:00:00','16:00:00'),(3,11,'08:00:00','14:00:00'),(4,19,'10:00:00','17:00:00'),(5,17,'08:00:00','17:00:00'),(6,18,'10:00:00','19:00:00');
/*!40000 ALTER TABLE `en_jornada_prestador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_servico_prestador`
--

DROP TABLE IF EXISTS `en_servico_prestador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `en_servico_prestador` (
  `COD_SERVICO_PRESTADOR` int(11) NOT NULL AUTO_INCREMENT,
  `COD_CATEGORIA` int(11) NOT NULL,
  `DSC_SERVICO` varchar(70) NOT NULL,
  `VLR_SERVICO` varchar(10) NOT NULL,
  `TMP_DURACAO_SERVICO` time NOT NULL,
  `COD_PRESTADOR` int(11) NOT NULL,
  `IND_ATIVO` char(1) NOT NULL,
  PRIMARY KEY (`COD_SERVICO_PRESTADOR`),
  KEY `EN_SERVICO_PRESTADOR_EN_CATEGORIA_SERVICO_FK` (`COD_CATEGORIA`),
  KEY `EN_SERVICO_PRESTADOR_SE_USUARIO_FK` (`COD_PRESTADOR`),
  CONSTRAINT `EN_SERVICO_PRESTADOR_EN_CATEGORIA_SERVICO_FK` FOREIGN KEY (`COD_CATEGORIA`) REFERENCES `en_categoria_servico` (`COD_CATEGORIA`),
  CONSTRAINT `EN_SERVICO_PRESTADOR_SE_USUARIO_FK` FOREIGN KEY (`COD_PRESTADOR`) REFERENCES `se_usuario` (`COD_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `en_servico_prestador`
--

LOCK TABLES `en_servico_prestador` WRITE;
/*!40000 ALTER TABLE `en_servico_prestador` DISABLE KEYS */;
INSERT INTO `en_servico_prestador` VALUES (1,2,'Corte','30,00','00:30:00',3,'S'),(2,2,'Tintura','40,00','00:50:00',3,'N'),(3,1,'DepilaÃ§Ã£o a laser','80,00','01:00:00',3,'S'),(4,1,'DepilaÃ§Ã£o a cera','50,00','00:40:00',3,'N'),(5,1,'DepilaÃ§Ã£o a cera','50,00','40:00:00',3,'N'),(6,1,'DepilaÃ§Ã£o a cera','50,00','00:40:00',3,'S'),(7,2,'Tintura','45,00','00:50:00',3,'N'),(8,2,'Tintura','50','00:50:00',3,'N'),(9,2,'Tintura','55','00:45:00',3,'N'),(10,2,'Tintura','65,00','00:45:00',3,'N'),(11,2,'Tintura','75,00','00:45:00',3,'N'),(12,2,'Tintura','45','00:45:00',3,'N'),(13,2,'Tintura','80,00','00:50:00',3,'N'),(14,2,'Tintura','45,00','00:50:00',3,'S'),(15,1,'DepilaÃ§Ã£o a linha','40,00','00:30:00',3,'S'),(16,4,'HidrataÃ§Ã£o dos pÃ©s com parafina','60,00','00:30:00',19,'S'),(17,4,'Argiloterapia','70,00','00:45:00',19,'S'),(18,4,'Ã“rteses e prÃ³teses','90,00','00:30:00',19,'S'),(19,4,'Tratamento de infecÃ§Ã£o nas unhas','50,00','00:40:00',19,'S'),(20,3,'EsmaltaÃ§Ã£o','40,00','00:40:00',17,'S'),(21,3,'Alongamento de unha fibra de vidro','80,00','01:30:00',17,'S'),(22,3,'Unha Acrigel','70,00','01:20:00',17,'S'),(23,3,'ManutenÃ§Ã£o unha Acrigel ou Fibra de vidro','30,00','00:45:00',17,'S'),(24,3,'EsfoliaÃ§Ã£o pÃ©s','60,00','00:50:00',17,'S'),(25,2,'Corte','30,00','00:30:00',18,'S'),(26,2,'Tintura','60,00','01:00:00',18,'S'),(27,2,'Progressiva','70,00','00:50:00',18,'S'),(28,2,'Selagem','80,00','01:00:00',18,'S'),(29,2,'Botox capilar','100,00','01:15:00',18,'S'),(30,4,'Corte','20,00','00:30:00',19,'N'),(31,4,'corte de unha','20,00','00:30:00',19,'N');
/*!40000 ALTER TABLE `en_servico_prestador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_status_agendamento`
--

DROP TABLE IF EXISTS `en_status_agendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `en_status_agendamento` (
  `COD_STATUS` int(11) NOT NULL AUTO_INCREMENT,
  `DSC_STATUS` varchar(50) NOT NULL,
  PRIMARY KEY (`COD_STATUS`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `en_status_agendamento`
--

LOCK TABLES `en_status_agendamento` WRITE;
/*!40000 ALTER TABLE `en_status_agendamento` DISABLE KEYS */;
INSERT INTO `en_status_agendamento` VALUES (1,'Pendente'),(2,'Confirmado'),(3,'Recusado'),(4,'Finalizado'),(5,'Cancelado');
/*!40000 ALTER TABLE `en_status_agendamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `en_unidade_federativa`
--

DROP TABLE IF EXISTS `en_unidade_federativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `en_unidade_federativa` (
  `SGL_ESTADO` varchar(5) NOT NULL,
  `DSC_ESTADO` varchar(80) NOT NULL,
  PRIMARY KEY (`SGL_ESTADO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `en_unidade_federativa`
--

LOCK TABLES `en_unidade_federativa` WRITE;
/*!40000 ALTER TABLE `en_unidade_federativa` DISABLE KEYS */;
INSERT INTO `en_unidade_federativa` VALUES ('AC','Acre'),('AL','Alagoas'),('AM','Amazonas'),('AP','Amapa'),('BA','Bahia'),('CE','Ceara'),('DF','Distrito Federal'),('ES','Espirito Santo'),('GO','Goias'),('MA','Maranhao'),('MG','Minas Gerais'),('MS','Mato Grosso do Sul'),('MT','Mato Grosso'),('PA','Para'),('PB','Paraiba'),('PE','Pernambuco'),('PI','Piaui'),('PR','Parana'),('RJ','Rio de Janeiro'),('RN','Rio Grande do Norte'),('RO','Rondonia'),('RR','Roraima'),('RS','Rio Grande do Sul'),('SC','Santa Catarina'),('SE','Sergipe'),('SP','Sao Paulo'),('TO','Tocantins');
/*!40000 ALTER TABLE `en_unidade_federativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_categoria_servico_prestador`
--

DROP TABLE IF EXISTS `re_categoria_servico_prestador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `re_categoria_servico_prestador` (
  `COD_CATEGORIA_SERVICO_PRESTADOR` int(11) NOT NULL AUTO_INCREMENT,
  `COD_PRESTADOR` int(11) NOT NULL,
  `COD_CATEGORIA` int(11) NOT NULL,
  PRIMARY KEY (`COD_CATEGORIA_SERVICO_PRESTADOR`),
  KEY `RE_CATEGORIA_SERVICO_PRESTADOR_SE_USUARIO_FK` (`COD_PRESTADOR`),
  KEY `RE_CATEGORIA_SERVICO_PRESTADOR_EN_CATEGORIA_SERVICO_FK` (`COD_CATEGORIA`),
  CONSTRAINT `RE_CATEGORIA_SERVICO_PRESTADOR_EN_CATEGORIA_SERVICO_FK` FOREIGN KEY (`COD_CATEGORIA`) REFERENCES `en_categoria_servico` (`COD_CATEGORIA`),
  CONSTRAINT `RE_CATEGORIA_SERVICO_PRESTADOR_SE_USUARIO_FK` FOREIGN KEY (`COD_PRESTADOR`) REFERENCES `se_usuario` (`COD_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_categoria_servico_prestador`
--

LOCK TABLES `re_categoria_servico_prestador` WRITE;
/*!40000 ALTER TABLE `re_categoria_servico_prestador` DISABLE KEYS */;
INSERT INTO `re_categoria_servico_prestador` VALUES (7,6,1),(8,9,1),(9,9,2),(10,9,4),(11,11,2),(12,11,4),(13,1,2),(16,3,1),(17,3,2),(18,16,1),(19,16,3),(20,17,3),(21,18,2),(22,19,4),(23,21,1),(24,21,2),(25,23,1),(26,23,2);
/*!40000 ALTER TABLE `re_categoria_servico_prestador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `se_menu`
--

DROP TABLE IF EXISTS `se_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `se_menu` (
  `COD_MENU` int(11) NOT NULL AUTO_INCREMENT,
  `DSC_MENU` varchar(80) NOT NULL,
  `NME_CONTROLLER` varchar(100) DEFAULT NULL,
  `COD_MENU_PAI` int(11) DEFAULT NULL,
  `NME_METHOD` varchar(100) DEFAULT NULL,
  `IND_ATALHO` char(1) DEFAULT NULL,
  `DSC_CAMINHO_IMAGEM` varchar(100) DEFAULT NULL,
  `IND_VISIBLE` char(1) DEFAULT NULL,
  `IND_ATIVO` char(1) NOT NULL,
  PRIMARY KEY (`COD_MENU`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `se_menu`
--

LOCK TABLES `se_menu` WRITE;
/*!40000 ALTER TABLE `se_menu` DISABLE KEYS */;
INSERT INTO `se_menu` VALUES (1,'Restrito',NULL,0,NULL,NULL,'oi-cog','S','S'),(2,'Home','MenuPrincipal',0,'ChamaView',NULL,'oi-home','S','S'),(3,'Menu','Menu',1,'ChamaView',NULL,'oi-menu','S','S'),(4,'Agenda','Agenda',0,'ChamaView','','oi-calendar','S','S'),(5,'Finalizados','ServicoFinalizado',0,'ChamaView',NULL,'oi-circle-check','S','S'),(6,'Pendentes','ServicoPendente',0,'ChamaView',NULL,'oi-clock','S','S'),(7,'Perfil','Prestador',0,'ChamaView',NULL,'oi-person','S','S'),(8,'Monta File','MontaFile',1,'ChamaView',NULL,'oi-file','S','S'),(9,'Verifica Sessao','MenuPrincipal',2,'VerificaSessao',NULL,'','N','S'),(10,'Carrega Menu New','MenuPrincipal',2,'CarregaMenuNew',NULL,'','N','S'),(11,'Lista Menus','Menu',3,'ListaMenus',NULL,'','N','S'),(12,'Listar Menus Grid','Menu',3,'ListarMenusGrid',NULL,'','N','S'),(13,'listar Controller','Menu',3,'listarController',NULL,'','N','S'),(14,'Listar Metodos','Menu',3,'ListarMetodos',NULL,'','N','S'),(15,'AddMenu','Menu',3,'AddMenu',NULL,'','N','S'),(16,'Update Menu','Menu',3,'UpdateMenu','','','N','S'),(17,'PermissÃ£o Menus','PermissaoMenu',1,'ChamaView','','oi-ban','S','S'),(18,'Listar Menus','PermissaoMenu',17,'ListarMenus','','','N','S'),(19,'Atualiza Permissoes','PermissaoMenu',17,'AtualizaPermissoes','','','N','S'),(20,'Listar Categoria Servico Ativo','CategoriaServico',0,'ListarCategoriaServicoAtivo','','','N','S'),(21,'Carrega Lista Prestadores','Cliente',0,'CarregaListaPrestadores','','','N','S'),(22,'Listar Perfil Ativo','Perfil',17,'ListarPerfilAtivo',NULL,'','N','S'),(23,'Listar Servico Finalizado','ServicoFinalizado',5,'ListarServicoFinalizado','','','N','S'),(24,'Listar Servico Pendente','ServicoPendente',6,'ListarServicoPendente','','','N','S'),(25,'Carrega Dados Prestador','Prestador',7,'CarregaDadosPrestador','','','N','S'),(26,'Carrega Jornada Prestador','JornadaPrestador',0,'CarregaJornadaPrestador','','','N','S'),(27,'Insert Jornada Prestador','JornadaPrestador',0,'InsertJornadaPrestador','','','N','S'),(28,'Update Jornada Prestador','JornadaPrestador',0,'UpdateJornadaPrestador','','','N','S'),(29,'Listar Servico Prestador','ServicoPrestador',0,'ListarServicoPrestador','','','N','S'),(30,'Insert Servico Prestador','ServicoPrestador',0,'InsertServicoPrestador','','','N','S'),(31,'Update Servico Prestador','ServicoPrestador',0,'UpdateServicoPrestador','','','N','S'),(32,'Listar Unidade Federativa','UnidadeFederativa',7,'ListarUnidadeFederativa','','','N','S'),(33,'Listar Categoria Servico Prestador','CategoriaServico',0,'ListarCategoriaServicoPrestador','','','N','S'),(34,'Usuarios','Usuario',1,'ChamaView','','oi-people','S','S'),(35,'ListarUsuario','Usuario',34,'ListarUsuario','','','N','S'),(36,'Add Usuario','Usuario',34,'AddUsuario','','','N','S'),(37,'Update Usuario','Usuario',34,'UpdateUsuario','','','N','S'),(38,'Validar Prestador','ValidaPrestador',1,'ChamaView','','oi-check','S','S'),(39,'Listar Prestadores Pendentes','ValidaPrestador',38,'ListarPrestadoresPendentes','','','N','S'),(40,'Update Status Prestador','ValidaPrestador',38,'UpdateStatusPrestador','','','N','S'),(41,'Retorna Perfil Usuario Logado','Perfil',2,'RetornaPerfilUsuarioLogado','','','N','S'),(42,'Listar Servicos Futuros','Agenda',2,'ListarServicosFuturos','','','N','S'),(46,'Listar Servico Ativo Prestador','ServicoPrestador',2,'ListarServicoAtivoPrestador','','','N','S'),(47,'Perfil','Cliente',0,'ChamaView','','oi-person','S','S'),(48,'Carrega Dados Cliente','Cliente',47,'CarregaDadosCliente','','','N','S'),(49,'Delete Menu','Menu',3,'DeleteMenu','','','N','S'),(50,'Verifica Cpf','Usuario',34,'VerificaCpf','','','N','S'),(51,'Update Prestador','Prestador',7,'UpdatePrestador','','','N','S'),(52,'Lista HorÃ¡rios Disponiveis','Agenda',2,'ListaHorariosDisponiveis','','','N','S'),(53,'Lista Horarios Disponiveis','Agenda',2,'ListaHorariosDisponiveis','','','N','S'),(54,'Insert Agendamento','Agenda',2,'InsertAgendamento','','','N','S'),(55,'Update Agendamento','Agenda',6,'UpdateAgendamento','','','N','S'),(56,'Insert Avaliacao Agendamento','AvaliacaoAgendamento',5,'InsertAvaliacaoAgendamento','','','N','S'),(57,'Carrega Avaliacao Agendamento','AvaliacaoAgendamento',5,'CarregaAvaliacaoAgendamento','','','N','S');
/*!40000 ALTER TABLE `se_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `se_menu_perfil`
--

DROP TABLE IF EXISTS `se_menu_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `se_menu_perfil` (
  `COD_PERFIL` int(11) NOT NULL,
  `COD_MENU` int(11) NOT NULL,
  KEY `SE_MENU_PERFIL_SE_MENU_FK` (`COD_MENU`),
  KEY `SE_MENU_PERFIL_SE_PERFIL_FK` (`COD_PERFIL`),
  CONSTRAINT `SE_MENU_PERFIL_SE_MENU_FK` FOREIGN KEY (`COD_MENU`) REFERENCES `se_menu` (`COD_MENU`),
  CONSTRAINT `SE_MENU_PERFIL_SE_PERFIL_FK` FOREIGN KEY (`COD_PERFIL`) REFERENCES `se_perfil` (`COD_PERFIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `se_menu_perfil`
--

LOCK TABLES `se_menu_perfil` WRITE;
/*!40000 ALTER TABLE `se_menu_perfil` DISABLE KEYS */;
INSERT INTO `se_menu_perfil` VALUES (2,2),(2,47),(2,1),(2,10),(2,41),(2,9),(2,48),(2,32),(2,38),(2,39),(2,40),(1,4),(1,26),(1,21),(1,5),(1,2),(1,27),(1,30),(1,20),(1,33),(1,29),(1,6),(1,47),(1,7),(1,1),(1,28),(1,31),(1,57),(1,56),(1,23),(1,10),(1,54),(1,53),(1,52),(1,46),(1,42),(1,41),(1,9),(1,15),(1,49),(1,11),(1,13),(1,12),(1,14),(1,16),(1,24),(1,55),(1,48),(1,25),(1,32),(1,51),(1,19),(1,18),(1,22),(1,3),(1,8),(1,17),(1,34),(1,38),(1,36),(1,35),(1,37),(1,50),(1,39),(1,40),(3,4),(3,26),(3,5),(3,2),(3,27),(3,30),(3,20),(3,33),(3,29),(3,6),(3,7),(3,28),(3,31),(3,56),(3,23),(3,10),(3,53),(3,42),(3,41),(3,9),(3,24),(3,55),(3,25),(3,32),(3,51),(3,17),(3,39),(4,4),(4,21),(4,5),(4,2),(4,20),(4,6),(4,47),(4,56),(4,23),(4,10),(4,54),(4,53),(4,52),(4,46),(4,41),(4,9),(4,24),(4,55),(4,48),(4,32);
/*!40000 ALTER TABLE `se_menu_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `se_perfil`
--

DROP TABLE IF EXISTS `se_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `se_perfil` (
  `COD_PERFIL` int(11) NOT NULL AUTO_INCREMENT,
  `DSC_PERFIL` varchar(50) NOT NULL,
  `IND_ATIVO` char(1) NOT NULL,
  PRIMARY KEY (`COD_PERFIL`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `se_perfil`
--

LOCK TABLES `se_perfil` WRITE;
/*!40000 ALTER TABLE `se_perfil` DISABLE KEYS */;
INSERT INTO `se_perfil` VALUES (1,'Desenvolvimento','S'),(2,'Administrador','S'),(3,'Prestador','S'),(4,'Cliente','S');
/*!40000 ALTER TABLE `se_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `se_usuario`
--

DROP TABLE IF EXISTS `se_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `se_usuario` (
  `COD_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `NME_USUARIO` varchar(50) NOT NULL,
  `DSC_SOBRENOME` varchar(100) NOT NULL,
  `NRO_CPF` varchar(15) NOT NULL,
  `DTA_NASCIMENTO` date NOT NULL,
  `TXT_EMAIL` varchar(100) NOT NULL,
  `NRO_TELEFONE` varchar(20) NOT NULL,
  `NRO_CEP` varchar(20) NOT NULL,
  `DSC_LOGRADOURO` varchar(100) NOT NULL,
  `DSC_COMPLEMENTO_ENDERECO` varchar(100) DEFAULT NULL,
  `DSC_BAIRRO` varchar(50) NOT NULL,
  `DSC_CIDADE` varchar(50) NOT NULL,
  `SGL_UF` varchar(5) NOT NULL,
  `COD_PERFIL` int(11) NOT NULL,
  `TXT_SENHA` varchar(100) NOT NULL,
  `IND_ATIVO` char(1) NOT NULL,
  `DSC_CAMINHO_FOTO` varchar(100) DEFAULT NULL,
  `DSC_CAMINHO_CERTIFICADO` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`COD_USUARIO`),
  KEY `SE_USUARIO_SE_PERFIL_FK` (`COD_PERFIL`),
  KEY `SE_USUARIO_EN_UNIDADE_FEDERATIVA_FK` (`SGL_UF`),
  CONSTRAINT `SE_USUARIO_EN_UNIDADE_FEDERATIVA_FK` FOREIGN KEY (`SGL_UF`) REFERENCES `en_unidade_federativa` (`SGL_ESTADO`),
  CONSTRAINT `SE_USUARIO_SE_PERFIL_FK` FOREIGN KEY (`COD_PERFIL`) REFERENCES `se_perfil` (`COD_PERFIL`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `se_usuario`
--

LOCK TABLES `se_usuario` WRITE;
/*!40000 ALTER TABLE `se_usuario` DISABLE KEYS */;
INSERT INTO `se_usuario` VALUES (1,'FERNANDA','LOPES DE ASSIS','033.500.641-83','0000-00-00','fernandalassis21@gmail.com','(61) 98530-1735','71920-180','Quadra 107 Rua E','lote 3 apt 803','Norte (Ãguas Claras)','BrasÃ­lia','DF',1,'202cb962ac59075b964b07152d234b70','S',NULL,NULL),(2,'BIANCA DOS SANTOS','MARINHO','065.976.391-54','1998-05-16','biancasantosmarinho@gmail.com','(61) 99902-4239','72001-655','ChÃ¡cara 111','17','Setor Habitacional Samambaia (Vicente Pires)','BrasÃ­lia','DF',4,'96953cc4a25d0a7c7c436024eef40b22','S',NULL,NULL),(3,'CAIORODRIGUES','RODRIGUES','012.022.911-04','0000-00-00','caioslvr@gmail.com','(61) 98194-8229','72220-253','QNN 24 Conjunto M',NULL,'CeilÃ¢ndia Sul (CeilÃ¢ndia)','BrasÃ­lia','DF',3,'e8858d5d62ba5c80fe85e75087d489df','S',NULL,NULL),(6,'GISLANE','SANTANA','352.028.581-91','2020-01-01','santana@email.com','(61) 91284-1231','72800-440','Rua Doutor JoÃ£o Teixeira',NULL,'Centro','LuziÃ¢nia','GO',3,'e10adc3949ba59abbe56e057f20f883e','N',NULL,NULL),(7,'ELISAGONÃ§ALVES','GONÃ§ALVES','056.860.941-79','1500-12-30','elisa@email.com','(12) 38172-0471','72800-440','Rua Doutor JoÃ£o Teixeira','casa 1','Centro','LuziÃ¢nia','GO',2,'e10adc3949ba59abbe56e057f20f883e','S',NULL,NULL),(8,'LEUZA111','SANTOS','994.997.895-53','2020-02-01','Leuzasantosm@gmail.com','(61) 90008-8888','72001-655','ChÃ¡cara 111',NULL,'Setor Habitacional Samambaia (Vicente Pires)','BrasÃ­lia','DF',4,'f8e845320a318db20ad6a767819889cb','S',NULL,NULL),(9,'CLODOALDO','LOPES','620.559.335-15','1971-10-10','cloadoaldo@email.com','(61) 23559-8532','72800-440','Rua Doutor JoÃ£o Teixeira','Qd 71 A Lt 13','Centro','LuziÃ¢nia','GO',3,'e10adc3949ba59abbe56e057f20f883e','N',NULL,NULL),(10,'ELIANE123','GONCALVES','798.987.691-49','1976-11-27','eliane@email.com','(61) 95478-2336','72800-440','Rua Doutor JoÃ£o Teixeira','1','Centro','LuziÃ¢nia','GO',4,'e10adc3949ba59abbe56e057f20f883e','S',NULL,NULL),(11,'WESLEY','RODRIGUES','682.658.596-00','1970-10-16','wesley@email.com','(61) 99999-9999','72800-440','Rua Doutor JoÃ£o Teixeira','as','Centro','LuziÃ¢nia','GO',3,'e10adc3949ba59abbe56e057f20f883e','S',NULL,NULL),(12,'ALANA','MARQUES','076.360.810-67','0000-00-00','alana@gmail.com','(61) 99999-9999','72800-440','Rua Doutor JoÃ£o Teixeira','8','Centro','LuziÃ¢nia','GO',4,'ef775988943825d2871e1cfa75473ec0','S',NULL,NULL),(13,'ANDERSON','CASTRO','504.624.170-69','1980-10-10','anderson@gmail.com','(61) 98753-2167','72800-440','Rua Doutor JoÃ£o Teixeira','4','Centro','LuziÃ¢nia','GO',4,'e10adc3949ba59abbe56e057f20f883e','S',NULL,NULL),(14,'AMANDA','CAROL','539.907.380-38','1940-10-10','amanda@gmail.com','(61) 98563-2178','72800-440','Rua Doutor JoÃ£o Teixeira','4','Centro','LuziÃ¢nia','GO',4,'e10adc3949ba59abbe56e057f20f883e','S',NULL,NULL),(15,'FABIANA','MONTEIRO','500.425.400-11','1953-08-05','fabiana@gmail.com','(61) 95478-5325','72800-440','Rua Doutor JoÃ£o Teixeira',NULL,'Centro','LuziÃ¢nia','GO',4,'e10adc3949ba59abbe56e057f20f883e','S',NULL,NULL),(16,'RENATO','FREIRE','377.439.250-13','1975-01-16','renatofreire@email.com','(61) 21388-7312','71936-250','Avenida das AraucÃ¡rias','lote 5 apt 301','Sul (Ãguas Claras)','BrasÃ­lia','DF',3,'e10adc3949ba59abbe56e057f20f883e','N',NULL,'true,Resources/Certificados/DiagramaMakerDB.pdf'),(17,'LUANA ','DIAS','488.195.030-42','1990-10-05','caios@outlook.com','(61) 98144-8766','72220-222','QNN 22 Conjunto B','40','CeilÃ¢ndia Sul (CeilÃ¢ndia)','BrasÃ­lia','DF',3,'243eccbb98c2269875cf80f0210f9820','S',NULL,'Resources/Certificados/Resume.pdf'),(18,'SABRINA','SALES','513.749.070-90','1988-09-20','caios@outlook.com','(61) 98145-3888','72305-312','QR 305 Conjunto 11','10','Samambaia Sul (Samambaia)','BrasÃ­lia','DF',3,'243eccbb98c2269875cf80f0210f9820','S',NULL,'Resources/Certificados/Resume.pdf'),(19,'LUISA','MIRANDA','012.022.951-00','1991-12-15','caios@outlook.com','(61) 98125-0932','70658-471','SHCES Quadra 1407 Bloco A','20','Cruzeiro Novo','BrasÃ­lia','DF',3,'243eccbb98c2269875cf80f0210f9820','S',NULL,'Resources/Certificados/Resume.pdf'),(20,'LUCAS','SANTOS','670.859.130-88','1998-05-17','lucassantos@gmail.com','(61) 99955-0130','72001-655','ChÃ¡cara 111','17','Setor Habitacional Samambaia (Vicente Pires)','BrasÃ­lia','DF',4,'e10adc3949ba59abbe56e057f20f883e','S',NULL,NULL),(21,'MARCELO','RODRIGUES','020.553.711-18','1976-10-12','marcelo@gmail.com','(61) 95352-5887','72800-440','Rua Doutor JoÃ£o Teixeira','8','Centro','LuziÃ¢nia','GO',3,'e10adc3949ba59abbe56e057f20f883e','N',NULL,'Resources/Certificados/___ Quadrix - Boleto Concurso ___.pdf'),(22,'ELAINE','LOPES','601.889.361-49','1973-08-15','ELAINE@GMAIL.COM','(61) 95221-4892','72800-440','Rua Doutor JoÃ£o Teixeira','A','Centro','LuziÃ¢nia','GO',4,'e10adc3949ba59abbe56e057f20f883e','S',NULL,NULL),(23,'KAROL','MALTA','477.035.780-02','1970-10-10','karol@gmail.com','(61) 98533-2998','72800-440','Rua Doutor JoÃ£o Teixeira','4','Centro','LuziÃ¢nia','GO',3,'e10adc3949ba59abbe56e057f20f883e','S',NULL,'Resources/Certificados/___ Quadrix - Boleto Concurso ___.pdf'),(24,'JOAO','PEREIRA','271.140.151-00','1990-09-16','joao@gmail.com','(61) 98263-5723','72220-220','QNN 22','30','CeilÃ¢ndia Sul (CeilÃ¢ndia)','BrasÃ­lia','DF',4,'243eccbb98c2269875cf80f0210f9820','S',NULL,NULL);
/*!40000 ALTER TABLE `se_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-09 19:18:29
