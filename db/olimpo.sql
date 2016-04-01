CREATE DATABASE  IF NOT EXISTS `olimpo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `olimpo`;
-- MySQL dump 10.13  Distrib 5.6.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: olimpo
-- ------------------------------------------------------
-- Server version	5.6.28-0ubuntu0.15.10.1

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `cliid` int(11) NOT NULL AUTO_INCREMENT,
  `cliNome` varchar(100) NOT NULL,
  `cliMatricula` varchar(100) NOT NULL,
  `cliNascimento` datetime NOT NULL,
  `cliTelefone1` varchar(20) NOT NULL,
  `cliTelefone2` varchar(20) NOT NULL,
  PRIMARY KEY (`cliid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clientes_carnes`
--

DROP TABLE IF EXISTS `clientes_carnes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes_carnes` (
  `carId` int(11) NOT NULL AUTO_INCREMENT,
  `carNum` int(11) NOT NULL,
  `carParcela` int(11) NOT NULL,
  `cliId` int(11) NOT NULL,
  `carDescricao` varchar(250) NOT NULL,
  `carVencimento` datetime NOT NULL,
  `carValor` decimal(10,2) NOT NULL,
  `carValorVencido` decimal(10,2) NOT NULL,
  `carPago` tinyint(1) NOT NULL,
  `reId` int(11) NOT NULL,
  PRIMARY KEY (`carId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contas`
--

DROP TABLE IF EXISTS `contas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contas` (
  `conId` int(11) NOT NULL AUTO_INCREMENT,
  `conNome` varchar(45) NOT NULL,
  PRIMARY KEY (`conId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores` (
  `forid` int(11) NOT NULL AUTO_INCREMENT,
  `forNome` varchar(100) NOT NULL,
  `forTelefone1` varchar(20) NOT NULL,
  `forTelefone2` varchar(20) NOT NULL,
  PRIMARY KEY (`forid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fornecedores_carnes`
--

DROP TABLE IF EXISTS `fornecedores_carnes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores_carnes` (
  `fcId` int(11) NOT NULL AUTO_INCREMENT,
  `fcNum` int(11) NOT NULL,
  `fcParcela` int(11) NOT NULL,
  `forId` int(11) NOT NULL,
  `fcDescricao` varchar(100) NOT NULL,
  `fcVencimento` datetime NOT NULL,
  `fcValor` decimal(10,2) NOT NULL,
  `fcValorVencido` decimal(10,2) NOT NULL,
  `fcPago` tinyint(1) NOT NULL,
  `rsId` int(11) NOT NULL,
  PRIMARY KEY (`fcId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registrocategorias`
--

DROP TABLE IF EXISTS `registrocategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrocategorias` (
  `rcId` int(11) NOT NULL AUTO_INCREMENT,
  `rcNome` varchar(50) NOT NULL,
  `rcSaida` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rcId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registroentradas`
--

DROP TABLE IF EXISTS `registroentradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registroentradas` (
  `reId` int(11) NOT NULL AUTO_INCREMENT,
  `reDescricao` varchar(100) NOT NULL,
  `reValor` decimal(10,2) NOT NULL,
  `reData` datetime NOT NULL,
  `reCategoria` int(11) NOT NULL,
  `conId` int(11) NOT NULL,
  `turId` int(11) NOT NULL,
  PRIMARY KEY (`reId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registrosaidas`
--

DROP TABLE IF EXISTS `registrosaidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrosaidas` (
  `rsId` int(11) NOT NULL AUTO_INCREMENT,
  `rsDescricao` varchar(100) NOT NULL,
  `rsValor` decimal(10,2) NOT NULL,
  `rsData` datetime NOT NULL,
  `rsCategoria` int(11) NOT NULL,
  `conId` int(11) NOT NULL,
  `turId` varchar(45) NOT NULL,
  PRIMARY KEY (`rsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuId` int(11) NOT NULL AUTO_INCREMENT,
  `usuNome` varchar(45) NOT NULL,
  `usuSenha` varchar(45) NOT NULL,
  `conId` int(11) NOT NULL,
  `perId` int(11) NOT NULL,
  PRIMARY KEY (`usuId`),
  UNIQUE KEY `usuNome_UNIQUE` (`usuNome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-01 13:33:52
