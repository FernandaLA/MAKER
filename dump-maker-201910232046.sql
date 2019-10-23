-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: maker
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `EN_AGENDAMENTO`
--

DROP TABLE IF EXISTS `EN_AGENDAMENTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EN_AGENDAMENTO` (
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
  CONSTRAINT `EN_AGENDAMENTO_EN_SERVICO_PRESTADOR_FK` FOREIGN KEY (`COD_SERVICO`) REFERENCES `EN_SERVICO_PRESTADOR` (`COD_SERVICO_PRESTADOR`),
  CONSTRAINT `EN_AGENDAMENTO_EN_STATUS_AGENDAMENTO_FK` FOREIGN KEY (`COD_STATUS`) REFERENCES `EN_STATUS_AGENDAMENTO` (`COD_STATUS`),
  CONSTRAINT `EN_AGENDAMENTO_SE_USUARIO_FK` FOREIGN KEY (`COD_PRESTADOR`) REFERENCES `SE_USUARIO` (`COD_USUARIO`),
  CONSTRAINT `EN_AGENDAMENTO_SE_USUARIO_FK_1` FOREIGN KEY (`COD_CLIENTE`) REFERENCES `SE_USUARIO` (`COD_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EN_AGENDAMENTO`
--

LOCK TABLES `EN_AGENDAMENTO` WRITE;
/*!40000 ALTER TABLE `EN_AGENDAMENTO` DISABLE KEYS */;
/*!40000 ALTER TABLE `EN_AGENDAMENTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EN_CATEGORIA_SERVICO`
--

DROP TABLE IF EXISTS `EN_CATEGORIA_SERVICO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EN_CATEGORIA_SERVICO` (
  `COD_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT,
  `DSC_CATEGORIA` varchar(50) NOT NULL,
  `IND_ATIVO` char(1) NOT NULL,
  PRIMARY KEY (`COD_CATEGORIA`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EN_CATEGORIA_SERVICO`
--

LOCK TABLES `EN_CATEGORIA_SERVICO` WRITE;
/*!40000 ALTER TABLE `EN_CATEGORIA_SERVICO` DISABLE KEYS */;
INSERT INTO `EN_CATEGORIA_SERVICO` VALUES (1,'Depilador','S'),(2,'Cabeleireiro','S'),(3,'Manicure/Pedicure','S'),(4,'Podologo','S');
/*!40000 ALTER TABLE `EN_CATEGORIA_SERVICO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EN_DIAS_JORNADA_PRESTADOR`
--

DROP TABLE IF EXISTS `EN_DIAS_JORNADA_PRESTADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EN_DIAS_JORNADA_PRESTADOR` (
  `COD_DIAS_JORNADA_PRESTADOR` int(11) NOT NULL AUTO_INCREMENT,
  `COD_JORNADA_PRESTADOR` int(11) NOT NULL,
  `COD_DIA` int(11) NOT NULL,
  PRIMARY KEY (`COD_DIAS_JORNADA_PRESTADOR`),
  KEY `EN_DIAS_JORNADA_PRESTADOR_EN_JORNADA_PRESTADOR_FK` (`COD_JORNADA_PRESTADOR`),
  CONSTRAINT `EN_DIAS_JORNADA_PRESTADOR_EN_JORNADA_PRESTADOR_FK` FOREIGN KEY (`COD_JORNADA_PRESTADOR`) REFERENCES `EN_JORNADA_PRESTADOR` (`COD_JORNADA_PRESTADOR`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EN_DIAS_JORNADA_PRESTADOR`
--

LOCK TABLES `EN_DIAS_JORNADA_PRESTADOR` WRITE;
/*!40000 ALTER TABLE `EN_DIAS_JORNADA_PRESTADOR` DISABLE KEYS */;
INSERT INTO `EN_DIAS_JORNADA_PRESTADOR` VALUES (9,1,2),(10,1,3),(11,1,4),(12,1,5),(13,1,6);
/*!40000 ALTER TABLE `EN_DIAS_JORNADA_PRESTADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EN_JORNADA_PRESTADOR`
--

DROP TABLE IF EXISTS `EN_JORNADA_PRESTADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EN_JORNADA_PRESTADOR` (
  `COD_JORNADA_PRESTADOR` int(11) NOT NULL AUTO_INCREMENT,
  `COD_PRESTADOR` int(11) NOT NULL,
  `HRA_INICIO` time NOT NULL,
  `HRA_FIM` time NOT NULL,
  PRIMARY KEY (`COD_JORNADA_PRESTADOR`),
  KEY `EN_JORNADA_PRESTADOR_SE_USUARIO_FK` (`COD_PRESTADOR`),
  CONSTRAINT `EN_JORNADA_PRESTADOR_SE_USUARIO_FK` FOREIGN KEY (`COD_PRESTADOR`) REFERENCES `SE_USUARIO` (`COD_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EN_JORNADA_PRESTADOR`
--

LOCK TABLES `EN_JORNADA_PRESTADOR` WRITE;
/*!40000 ALTER TABLE `EN_JORNADA_PRESTADOR` DISABLE KEYS */;
INSERT INTO `EN_JORNADA_PRESTADOR` VALUES (1,1,'08:00:00','17:00:00');
/*!40000 ALTER TABLE `EN_JORNADA_PRESTADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EN_SERVICO_PRESTADOR`
--

DROP TABLE IF EXISTS `EN_SERVICO_PRESTADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EN_SERVICO_PRESTADOR` (
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
  CONSTRAINT `EN_SERVICO_PRESTADOR_EN_CATEGORIA_SERVICO_FK` FOREIGN KEY (`COD_CATEGORIA`) REFERENCES `EN_CATEGORIA_SERVICO` (`COD_CATEGORIA`),
  CONSTRAINT `EN_SERVICO_PRESTADOR_SE_USUARIO_FK` FOREIGN KEY (`COD_PRESTADOR`) REFERENCES `SE_USUARIO` (`COD_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EN_SERVICO_PRESTADOR`
--

LOCK TABLES `EN_SERVICO_PRESTADOR` WRITE;
/*!40000 ALTER TABLE `EN_SERVICO_PRESTADOR` DISABLE KEYS */;
/*!40000 ALTER TABLE `EN_SERVICO_PRESTADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EN_STATUS_AGENDAMENTO`
--

DROP TABLE IF EXISTS `EN_STATUS_AGENDAMENTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EN_STATUS_AGENDAMENTO` (
  `COD_STATUS` int(11) NOT NULL AUTO_INCREMENT,
  `DSC_STATUS` varchar(50) NOT NULL,
  PRIMARY KEY (`COD_STATUS`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EN_STATUS_AGENDAMENTO`
--

LOCK TABLES `EN_STATUS_AGENDAMENTO` WRITE;
/*!40000 ALTER TABLE `EN_STATUS_AGENDAMENTO` DISABLE KEYS */;
INSERT INTO `EN_STATUS_AGENDAMENTO` VALUES (1,'Pendente'),(2,'Confirmado'),(3,'Recusado'),(4,'Finalizado'),(5,'Cancelado');
/*!40000 ALTER TABLE `EN_STATUS_AGENDAMENTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EN_UNIDADE_FEDERATIVA`
--

DROP TABLE IF EXISTS `EN_UNIDADE_FEDERATIVA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EN_UNIDADE_FEDERATIVA` (
  `SGL_ESTADO` varchar(5) NOT NULL,
  `DSC_ESTADO` varchar(80) NOT NULL,
  PRIMARY KEY (`SGL_ESTADO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EN_UNIDADE_FEDERATIVA`
--

LOCK TABLES `EN_UNIDADE_FEDERATIVA` WRITE;
/*!40000 ALTER TABLE `EN_UNIDADE_FEDERATIVA` DISABLE KEYS */;
INSERT INTO `EN_UNIDADE_FEDERATIVA` VALUES ('AC','Acre'),('AL','Alagoas'),('AM','Amazonas'),('AP','Amapa'),('BA','Bahia'),('CE','Ceara'),('DF','Distrito Federal'),('ES','Espirito Santo'),('GO','Goias'),('MA','Maranhao'),('MG','Minas Gerais'),('MS','Mato Grosso do Sul'),('MT','Mato Grosso'),('PA','Para'),('PB','Paraiba'),('PE','Pernambuco'),('PI','Piaui'),('PR','Parana'),('RJ','Rio de Janeiro'),('RN','Rio Grande do Norte'),('RO','Rondonia'),('RR','Roraima'),('RS','Rio Grande do Sul'),('SC','Santa Catarina'),('SE','Sergipe'),('SP','Sao Paulo'),('TO','Tocantins');
/*!40000 ALTER TABLE `EN_UNIDADE_FEDERATIVA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RE_CATEGORIA_SERVICO_PRESTADOR`
--

DROP TABLE IF EXISTS `RE_CATEGORIA_SERVICO_PRESTADOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RE_CATEGORIA_SERVICO_PRESTADOR` (
  `COD_CATEGORIA_SERVICO_PRESTADOR` int(11) NOT NULL AUTO_INCREMENT,
  `COD_PRESTADOR` int(11) NOT NULL,
  `COD_CATEGORIA` int(11) NOT NULL,
  PRIMARY KEY (`COD_CATEGORIA_SERVICO_PRESTADOR`),
  KEY `RE_CATEGORIA_SERVICO_PRESTADOR_SE_USUARIO_FK` (`COD_PRESTADOR`),
  KEY `RE_CATEGORIA_SERVICO_PRESTADOR_EN_CATEGORIA_SERVICO_FK` (`COD_CATEGORIA`),
  CONSTRAINT `RE_CATEGORIA_SERVICO_PRESTADOR_EN_CATEGORIA_SERVICO_FK` FOREIGN KEY (`COD_CATEGORIA`) REFERENCES `EN_CATEGORIA_SERVICO` (`COD_CATEGORIA`),
  CONSTRAINT `RE_CATEGORIA_SERVICO_PRESTADOR_SE_USUARIO_FK` FOREIGN KEY (`COD_PRESTADOR`) REFERENCES `SE_USUARIO` (`COD_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RE_CATEGORIA_SERVICO_PRESTADOR`
--

LOCK TABLES `RE_CATEGORIA_SERVICO_PRESTADOR` WRITE;
/*!40000 ALTER TABLE `RE_CATEGORIA_SERVICO_PRESTADOR` DISABLE KEYS */;
/*!40000 ALTER TABLE `RE_CATEGORIA_SERVICO_PRESTADOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SE_MENU`
--

DROP TABLE IF EXISTS `SE_MENU`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SE_MENU` (
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SE_MENU`
--

LOCK TABLES `SE_MENU` WRITE;
/*!40000 ALTER TABLE `SE_MENU` DISABLE KEYS */;
INSERT INTO `SE_MENU` VALUES (1,'Restrito',NULL,0,NULL,NULL,'oi-cog','S','S'),(2,'Home','MenuPrincipal',0,'ChamaView',NULL,'oi-home','S','S'),(3,'Menu','Menu',1,'ChamaView',NULL,'oi-menu','S','S'),(4,'Agenda','Agenda',0,'ChamaView','','oi-calendar','S','S'),(5,'Finalizados','ServicoFinalizado',0,'ChamaView',NULL,'oi-circle-check','S','S'),(6,'Pendentes','ServicoPendente',0,'ChamaView',NULL,'oi-clock','S','S'),(7,'Perfil','Prestador',0,'ChamaView',NULL,'oi-person','S','S'),(8,'Monta File','MontaFile',1,'ChamaView',NULL,'oi-file','S','S'),(9,'Verifica Sessao','MenuPrincipal',2,'VerificaSessao',NULL,'','N','S'),(10,'Carrega Menu New','MenuPrincipal',2,'CarregaMenuNew',NULL,'','N','S'),(11,'Lista Menus','Menu',3,'ListaMenus',NULL,'','N','S'),(12,'Listar Menus Grid','Menu',3,'ListarMenusGrid',NULL,'','N','S'),(13,'listar Controller','Menu',3,'listarController',NULL,'','N','S'),(14,'Listar Metodos','Menu',3,'ListarMetodos',NULL,'','N','S'),(15,'AddMenu','Menu',3,'AddMenu',NULL,'','N','S'),(16,'Update Menu','Menu',3,'UpdateMenu','','','N','S'),(17,'PermissÃ£o Menus','PermissaoMenu',1,'ChamaView','','oi-ban','S','S'),(18,'Listar Menus','PermissaoMenu',17,'ListarMenus','','','N','S'),(19,'Atualiza Permissoes','PermissaoMenu',17,'AtualizaPermissoes','','','N','S'),(20,'Listar Categoria Servico Ativo','CategoriaServico',0,'ListarCategoriaServicoAtivo','','','N','S'),(21,'Carrega Lista Prestadores','Cliente',0,'CarregaListaPrestadores','','','N','S'),(22,'Listar Perfil Ativo','Perfil',17,'ListarPerfilAtivo',NULL,'','N','S'),(23,'Listar Servico Finalizado','ServicoFinalizado',5,'ListarServicoFinalizado','','','N','S'),(24,'Listar Servico Pendente','ServicoPendente',6,'ListarServicoPendente','','','N','S'),(25,'Carrega Dados Prestador','Prestador',7,'CarregaDadosPrestador','','','N','S'),(26,'Carrega Jornada Prestador','JornadaPrestador',0,'CarregaJornadaPrestador','','','N','S'),(27,'Insert Jornada Prestador','JornadaPrestador',0,'InsertJornadaPrestador','','','N','S'),(28,'Update Jornada Prestador','JornadaPrestador',0,'UpdateJornadaPrestador','','','N','S'),(29,'Listar Servico Prestador','ServicoPrestador',0,'ListarServicoPrestador','','','N','S'),(30,'Insert Servico Prestador','ServicoPrestador',0,'InsertServicoPrestador','','','N','S'),(31,'Update Servico Prestador','ServicoPrestador',0,'UpdateServicoPrestador','','','N','S'),(32,'Listar Unidade Federativa','UnidadeFederativa',7,'ListarUnidadeFederativa','','','N','S'),(33,'Listar Categoria Servico Prestador','CategoriaServico',0,'ListarCategoriaServicoPrestador','','','N','S');
/*!40000 ALTER TABLE `SE_MENU` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SE_MENU_PERFIL`
--

DROP TABLE IF EXISTS `SE_MENU_PERFIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SE_MENU_PERFIL` (
  `COD_PERFIL` int(11) NOT NULL,
  `COD_MENU` int(11) NOT NULL,
  KEY `SE_MENU_PERFIL_SE_MENU_FK` (`COD_MENU`),
  KEY `SE_MENU_PERFIL_SE_PERFIL_FK` (`COD_PERFIL`),
  CONSTRAINT `SE_MENU_PERFIL_SE_MENU_FK` FOREIGN KEY (`COD_MENU`) REFERENCES `SE_MENU` (`COD_MENU`),
  CONSTRAINT `SE_MENU_PERFIL_SE_PERFIL_FK` FOREIGN KEY (`COD_PERFIL`) REFERENCES `SE_PERFIL` (`COD_PERFIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SE_MENU_PERFIL`
--

LOCK TABLES `SE_MENU_PERFIL` WRITE;
/*!40000 ALTER TABLE `SE_MENU_PERFIL` DISABLE KEYS */;
INSERT INTO `SE_MENU_PERFIL` VALUES (2,2),(2,1),(2,10),(2,9),(2,25),(2,32),(4,4),(4,21),(4,5),(4,2),(4,20),(4,6),(4,7),(4,23),(4,10),(4,9),(4,25),(4,32),(1,4),(1,26),(1,21),(1,5),(1,2),(1,27),(1,30),(1,20),(1,33),(1,29),(1,6),(1,7),(1,1),(1,28),(1,31),(1,23),(1,10),(1,9),(1,15),(1,11),(1,13),(1,12),(1,14),(1,16),(1,24),(1,25),(1,32),(1,19),(1,18),(1,22),(1,3),(1,8),(1,17),(3,4),(3,26),(3,5),(3,2),(3,27),(3,30),(3,33),(3,29),(3,6),(3,7),(3,28),(3,31),(3,23),(3,10),(3,9),(3,25),(3,32);
/*!40000 ALTER TABLE `SE_MENU_PERFIL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SE_PERFIL`
--

DROP TABLE IF EXISTS `SE_PERFIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SE_PERFIL` (
  `COD_PERFIL` int(11) NOT NULL AUTO_INCREMENT,
  `DSC_PERFIL` varchar(50) NOT NULL,
  `IND_ATIVO` char(1) NOT NULL,
  PRIMARY KEY (`COD_PERFIL`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SE_PERFIL`
--

LOCK TABLES `SE_PERFIL` WRITE;
/*!40000 ALTER TABLE `SE_PERFIL` DISABLE KEYS */;
INSERT INTO `SE_PERFIL` VALUES (1,'Desenvolvimento','S'),(2,'Administrador','S'),(3,'Prestador','S'),(4,'Cliente','S');
/*!40000 ALTER TABLE `SE_PERFIL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SE_USUARIO`
--

DROP TABLE IF EXISTS `SE_USUARIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SE_USUARIO` (
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
  CONSTRAINT `SE_USUARIO_EN_UNIDADE_FEDERATIVA_FK` FOREIGN KEY (`SGL_UF`) REFERENCES `EN_UNIDADE_FEDERATIVA` (`SGL_ESTADO`),
  CONSTRAINT `SE_USUARIO_SE_PERFIL_FK` FOREIGN KEY (`COD_PERFIL`) REFERENCES `SE_PERFIL` (`COD_PERFIL`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SE_USUARIO`
--

LOCK TABLES `SE_USUARIO` WRITE;
/*!40000 ALTER TABLE `SE_USUARIO` DISABLE KEYS */;
INSERT INTO `SE_USUARIO` VALUES (1,'FERNANDA','LOPES DE ASSIS','033.500.641-83','1997-12-21','fernandalassis21@gmail.com','(61) 98530-1735','71920-180','Quadra 107 Rua E','lote 3 apt 803','Norte (Ãguas Claras)','BrasÃ­lia','DF',1,'202cb962ac59075b964b07152d234b70','S',NULL,NULL);
/*!40000 ALTER TABLE `SE_USUARIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'maker'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-23 20:46:42
