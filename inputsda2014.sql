-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: inputsda2014
-- ------------------------------------------------------
-- Server version	5.5.43-0+deb8u1

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
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_pendaftar_sma`
--

DROP TABLE IF EXISTS `log_pendaftar_sma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_pendaftar_sma` (
  `PID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NO_PENDAFTARAN` varchar(20) NOT NULL,
  `NO_UJIAN` varchar(15) NOT NULL DEFAULT '',
  `TAHUN_LULUS` varchar(9) DEFAULT '2007/2008',
  `NAMA` varchar(60) NOT NULL DEFAULT '',
  `UAN_NAMA` varchar(40) NOT NULL,
  `JENIS_KEL` char(1) NOT NULL DEFAULT '',
  `TMP_LAHIR` varchar(40) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `ALAMAT` varchar(60) DEFAULT NULL,
  `KOTA` varchar(40) DEFAULT NULL,
  `NO_TELP` varchar(20) DEFAULT NULL,
  `NAMA_ORTU` varchar(60) DEFAULT NULL,
  `ASAL_SEKOLAH` varchar(50) NOT NULL DEFAULT '',
  `KOTA_ASAL_SEKOLAH` varchar(40) NOT NULL DEFAULT '',
  `UAN_BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_BING` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NUN_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NTMB` decimal(8,2) DEFAULT '0.00',
  `NTK` decimal(8,2) DEFAULT '0.00',
  `NILAI_AKHIR` decimal(8,2) NOT NULL DEFAULT '0.00',
  `JALUR_DAFTAR` varchar(2) DEFAULT NULL,
  `PILIH1` varchar(10) NOT NULL DEFAULT '',
  `PILIH2` varchar(10) DEFAULT NULL,
  `WAKTU_DAFTAR` date DEFAULT NULL,
  `LOG_DAFTAR` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `USER_FISIK` varchar(10) NOT NULL DEFAULT '',
  `IP_ADDRESS` varchar(20) DEFAULT NULL,
  `ID_SEKOLAH` varchar(5) DEFAULT NULL,
  `NO_TINGKATAN` smallint(2) DEFAULT '0',
  `ALASAN_PERUBAHAN` text,
  `DOMISILI` varchar(150) NOT NULL,
  PRIMARY KEY (`PID`),
  KEY `INDEX_JALUR_DAFTAR` (`JALUR_DAFTAR`),
  KEY `INDEX_ID_SEKOLAH` (`ID_SEKOLAH`),
  KEY `INDEX_NO_UJIAN` (`NO_UJIAN`)
) ENGINE=MyISAM AUTO_INCREMENT=4892 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_pendaftar_smk`
--

DROP TABLE IF EXISTS `log_pendaftar_smk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_pendaftar_smk` (
  `PID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NO_PENDAFTARAN` varchar(20) NOT NULL,
  `NO_UJIAN` varchar(15) NOT NULL DEFAULT '',
  `TAHUN_LULUS` varchar(9) DEFAULT '2007/2008',
  `NAMA` varchar(60) NOT NULL DEFAULT '',
  `UAN_NAMA` varchar(40) NOT NULL,
  `JENIS_KEL` char(1) NOT NULL DEFAULT '',
  `TMP_LAHIR` varchar(40) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `ALAMAT` varchar(60) DEFAULT NULL,
  `KOTA` varchar(40) DEFAULT NULL,
  `NO_TELP` varchar(20) DEFAULT NULL,
  `NAMA_ORTU` varchar(60) DEFAULT NULL,
  `ASAL_SEKOLAH` varchar(50) NOT NULL DEFAULT '',
  `KOTA_ASAL_SEKOLAH` varchar(40) NOT NULL DEFAULT '',
  `UAN_BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_BING` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NUN_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NTMB` decimal(8,2) DEFAULT '0.00',
  `NTK` decimal(8,2) DEFAULT '0.00',
  `NILAI_AKHIR` decimal(8,2) NOT NULL DEFAULT '0.00',
  `JALUR_DAFTAR` varchar(2) DEFAULT NULL,
  `PILIH1` varchar(10) NOT NULL DEFAULT '',
  `PILIH2` varchar(10) DEFAULT NULL,
  `WAKTU_DAFTAR` date DEFAULT NULL,
  `LOG_DAFTAR` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `USER_FISIK` varchar(10) NOT NULL DEFAULT '',
  `IP_ADDRESS` varchar(20) DEFAULT NULL,
  `ID_SEKOLAH` varchar(5) DEFAULT NULL,
  `NO_TINGKATAN` smallint(2) DEFAULT '0',
  `ALASAN_PERUBAHAN` text,
  `DOMISILI` varchar(150) NOT NULL,
  PRIMARY KEY (`PID`),
  KEY `INDEX_JALUR_DAFTAR` (`JALUR_DAFTAR`),
  KEY `INDEX_ID_SEKOLAH` (`ID_SEKOLAH`),
  KEY `INDEX_NO_UJIAN` (`NO_UJIAN`)
) ENGINE=MyISAM AUTO_INCREMENT=4332 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_pendaftar_smp`
--

DROP TABLE IF EXISTS `log_pendaftar_smp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_pendaftar_smp` (
  `PID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NO_PENDAFTARAN` varchar(20) NOT NULL,
  `NO_UJIAN` varchar(15) NOT NULL DEFAULT '',
  `TAHUN_LULUS` varchar(9) DEFAULT '2007/2008',
  `NAMA` varchar(60) NOT NULL DEFAULT '',
  `UAN_NAMA` varchar(40) NOT NULL,
  `JENIS_KEL` char(1) NOT NULL DEFAULT '',
  `TMP_LAHIR` varchar(40) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `ALAMAT` varchar(60) DEFAULT NULL,
  `KOTA` varchar(40) DEFAULT NULL,
  `NO_TELP` varchar(20) DEFAULT NULL,
  `NAMA_ORTU` varchar(60) DEFAULT NULL,
  `ASAL_SEKOLAH` varchar(50) NOT NULL DEFAULT '',
  `KOTA_ASAL_SEKOLAH` varchar(40) NOT NULL DEFAULT '',
  `UAN_BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `RAP_BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `AKHIR_BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `RAP_MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `AKHIR_MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_BING` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `RAP_IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `AKHIR_IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NUN_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NRAP_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NAKHIR_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NTMB` decimal(8,2) DEFAULT '0.00',
  `NTK` decimal(8,2) DEFAULT '0.00',
  `NILAI_AKHIR` decimal(8,2) NOT NULL DEFAULT '0.00',
  `JALUR_DAFTAR` varchar(2) DEFAULT NULL,
  `PILIH1` varchar(10) NOT NULL DEFAULT '',
  `PILIH2` varchar(10) DEFAULT NULL,
  `WAKTU_DAFTAR` date DEFAULT NULL,
  `LOG_DAFTAR` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `USER_FISIK` varchar(10) NOT NULL DEFAULT '',
  `IP_ADDRESS` varchar(20) DEFAULT NULL,
  `ID_SEKOLAH` varchar(5) DEFAULT NULL,
  `NO_TINGKATAN` smallint(2) DEFAULT '0',
  `ALASAN_PERUBAHAN` text,
  `DOMISILI` varchar(150) NOT NULL,
  `ALASAN` varchar(300) DEFAULT NULL,
  `FLAG_ALASAN` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`PID`),
  KEY `INDEX_JALUR_DAFTAR` (`JALUR_DAFTAR`),
  KEY `INDEX_ID_SEKOLAH` (`ID_SEKOLAH`),
  KEY `INDEX_NO_UJIAN` (`NO_UJIAN`)
) ENGINE=MyISAM AUTO_INCREMENT=21685 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `master_un_sd`
--

DROP TABLE IF EXISTS `master_un_sd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_un_sd` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NO_UJIAN` varchar(10) NOT NULL,
  `NO_TINGKATAN` int(1) DEFAULT NULL,
  `KODE_PROVINSI` int(2) DEFAULT NULL,
  `KODE_RAYON` int(2) DEFAULT NULL,
  `KODE_SUBRAYON` int(2) DEFAULT NULL,
  `NAMA` varchar(60) DEFAULT NULL,
  `JENIS_KEL` char(1) DEFAULT NULL,
  `TMP_LAHIR` varchar(50) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `ALAMAT` varchar(250) DEFAULT NULL,
  `KOTA` varchar(30) DEFAULT NULL,
  `NO_TELP` varchar(50) DEFAULT NULL,
  `NAMA_ORTU` varchar(50) DEFAULT NULL,
  `ASAL_SEKOLAH` varchar(150) DEFAULT NULL,
  `KOTA_ASAL_SEKOLAH` varchar(30) DEFAULT NULL,
  `TAHUN_LULUS` varchar(9) NOT NULL,
  `BIND` decimal(8,2) NOT NULL,
  `RAP_BIND` decimal(8,2) NOT NULL,
  `AKHIR_BIND` decimal(8,2) NOT NULL,
  `BING` decimal(8,2) NOT NULL,
  `MAT` decimal(8,2) NOT NULL,
  `RAP_MAT` decimal(8,2) NOT NULL,
  `AKHIR_MAT` decimal(8,2) NOT NULL,
  `IPA` decimal(8,2) NOT NULL,
  `RAP_IPA` decimal(8,2) NOT NULL,
  `AKHIR_IPA` decimal(8,2) NOT NULL,
  `NUN_ASLI` decimal(8,2) NOT NULL,
  `NRAP_ASLI` decimal(8,2) NOT NULL,
  `NAKHIR_ASLI` decimal(8,2) NOT NULL,
  `DOMISILI` varchar(150) NOT NULL,
  UNIQUE KEY `id` (`ID`),
  UNIQUE KEY `NO_DAFTAR` (`NO_UJIAN`,`NO_TINGKATAN`)
) ENGINE=MyISAM AUTO_INCREMENT=33294 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `master_un_sd_old`
--

DROP TABLE IF EXISTS `master_un_sd_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_un_sd_old` (
  `NO_UJIAN` varchar(10) NOT NULL DEFAULT '',
  `NAMA` varchar(60) DEFAULT NULL,
  `JENIS_KEL` char(1) DEFAULT 'L',
  `TMP_LAHIR` varchar(50) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT '0000-00-00',
  `ALAMAT` varchar(250) DEFAULT NULL,
  `KOTA` varchar(30) DEFAULT NULL,
  `NO_TELP` varchar(50) DEFAULT NULL,
  `NAMA_ORTU` varchar(50) DEFAULT NULL,
  `ASAL_SEKOLAH` varchar(150) DEFAULT NULL,
  `KOTA_ASAL_SEKOLAH` varchar(30) DEFAULT NULL,
  `BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `BING` decimal(8,2) NOT NULL DEFAULT '0.00',
  `IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NUN_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NO_TINGKATAN` int(11) DEFAULT NULL,
  `DOMISILI` varchar(150) NOT NULL,
  UNIQUE KEY `id` (`ID`),
  UNIQUE KEY `NO_DAFTAR` (`NO_UJIAN`,`NO_TINGKATAN`)
) ENGINE=MyISAM AUTO_INCREMENT=33412 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `master_un_smp`
--

DROP TABLE IF EXISTS `master_un_smp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_un_smp` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NO_UJIAN` varchar(10) NOT NULL,
  `NO_TINGKATAN` int(1) DEFAULT NULL,
  `KODE_PROVINSI` int(2) DEFAULT NULL,
  `KODE_RAYON` int(2) DEFAULT NULL,
  `KODE_SUBRAYON` int(2) DEFAULT NULL,
  `NAMA` varchar(60) DEFAULT NULL,
  `JENIS_KEL` char(1) DEFAULT NULL,
  `TMP_LAHIR` varchar(50) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `ALAMAT` varchar(250) DEFAULT NULL,
  `KOTA` varchar(30) DEFAULT NULL,
  `NO_TELP` varchar(50) DEFAULT NULL,
  `NAMA_ORTU` varchar(50) DEFAULT NULL,
  `ASAL_SEKOLAH` varchar(150) DEFAULT NULL,
  `KOTA_ASAL_SEKOLAH` varchar(30) DEFAULT NULL,
  `TAHUN_LULUS` varchar(9) NOT NULL,
  `BIND` decimal(8,2) NOT NULL,
  `BING` decimal(8,2) NOT NULL,
  `MAT` decimal(8,2) NOT NULL,
  `IPA` decimal(8,2) NOT NULL,
  `NUN_ASLI` decimal(8,2) NOT NULL,
  `DOMISILI` varchar(150) NOT NULL,
  UNIQUE KEY `id` (`ID`),
  UNIQUE KEY `NO_DAFTAR` (`NO_UJIAN`,`NO_TINGKATAN`)
) ENGINE=MyISAM AUTO_INCREMENT=27642 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `master_un_smp_old`
--

DROP TABLE IF EXISTS `master_un_smp_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_un_smp_old` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NO_UJIAN` varchar(10) NOT NULL,
  `NO_TINGKATAN` int(1) DEFAULT NULL,
  `KODE_PROVINSI` int(2) DEFAULT NULL,
  `KODE_RAYON` int(2) DEFAULT NULL,
  `KODE_SUBRAYON` int(2) DEFAULT NULL,
  `NAMA` varchar(60) DEFAULT NULL,
  `JENIS_KEL` char(1) DEFAULT NULL,
  `TMP_LAHIR` varchar(50) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `ALAMAT` varchar(250) DEFAULT NULL,
  `KOTA` varchar(30) DEFAULT NULL,
  `NO_TELP` varchar(50) DEFAULT NULL,
  `NAMA_ORTU` varchar(50) DEFAULT NULL,
  `ASAL_SEKOLAH` varchar(150) DEFAULT NULL,
  `KOTA_ASAL_SEKOLAH` varchar(30) DEFAULT NULL,
  `TAHUN_LULUS` varchar(9) NOT NULL,
  `BIND` decimal(8,2) NOT NULL,
  `MAT` decimal(8,2) NOT NULL,
  `BING` decimal(8,2) NOT NULL,
  `IPA` decimal(8,2) NOT NULL,
  `NUN_ASLI` decimal(8,2) NOT NULL,
  `DOMISILI` varchar(150) NOT NULL,
  UNIQUE KEY `id` (`ID`),
  UNIQUE KEY `NO_DAFTAR` (`NO_UJIAN`,`NO_TINGKATAN`)
) ENGINE=MyISAM AUTO_INCREMENT=28475 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pendaftar_sma`
--

DROP TABLE IF EXISTS `pendaftar_sma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendaftar_sma` (
  `PID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NO_PENDAFTARAN` varchar(25) NOT NULL,
  `NO_UJIAN` varchar(15) NOT NULL DEFAULT '',
  `TAHUN_LULUS` varchar(9) DEFAULT '2007/2008',
  `NAMA` varchar(60) NOT NULL DEFAULT '',
  `UAN_NAMA` varchar(40) NOT NULL,
  `JENIS_KEL` char(1) NOT NULL DEFAULT '',
  `TMP_LAHIR` varchar(40) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `ALAMAT` varchar(60) DEFAULT NULL,
  `KOTA` varchar(40) DEFAULT NULL,
  `NO_TELP` varchar(20) DEFAULT NULL,
  `NAMA_ORTU` varchar(60) DEFAULT NULL,
  `ASAL_SEKOLAH` varchar(50) NOT NULL DEFAULT '',
  `KOTA_ASAL_SEKOLAH` varchar(40) NOT NULL DEFAULT '',
  `UAN_BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_BING` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NUN_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NTMB` decimal(8,2) DEFAULT '0.00',
  `NTK` decimal(8,2) DEFAULT '0.00',
  `NILAI_AKHIR` decimal(8,2) NOT NULL DEFAULT '0.00',
  `JALUR_DAFTAR` varchar(2) NOT NULL DEFAULT '1',
  `PILIH1` varchar(10) NOT NULL DEFAULT '',
  `PILIH2` varchar(10) DEFAULT NULL,
  `WAKTU_DAFTAR` date DEFAULT NULL,
  `LOG_DAFTAR` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `USER_FISIK` varchar(10) NOT NULL DEFAULT '',
  `IP_ADDRESS` varchar(20) DEFAULT NULL,
  `ID_SEKOLAH` varchar(5) DEFAULT NULL,
  `NO_TINGKATAN` smallint(2) DEFAULT '0',
  `DOMISILI` varchar(150) NOT NULL,
  UNIQUE KEY `PID` (`PID`),
  KEY `INDEX_NO_UJIAN` (`NO_UJIAN`),
  KEY `INDEX_ID_SEKOLAH` (`ID_SEKOLAH`),
  KEY `INDEX_JALUR_DAFTAR` (`JALUR_DAFTAR`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pendaftar_smk`
--

DROP TABLE IF EXISTS `pendaftar_smk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendaftar_smk` (
  `PID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NO_PENDAFTARAN` varchar(25) NOT NULL,
  `NO_UJIAN` varchar(15) NOT NULL DEFAULT '',
  `TAHUN_LULUS` varchar(9) DEFAULT '2007/2008',
  `NAMA` varchar(60) NOT NULL DEFAULT '',
  `UAN_NAMA` varchar(40) NOT NULL,
  `JENIS_KEL` char(1) NOT NULL DEFAULT '',
  `TMP_LAHIR` varchar(40) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `ALAMAT` varchar(60) DEFAULT NULL,
  `KOTA` varchar(40) DEFAULT NULL,
  `NO_TELP` varchar(20) DEFAULT NULL,
  `NAMA_ORTU` varchar(60) DEFAULT NULL,
  `ASAL_SEKOLAH` varchar(50) NOT NULL DEFAULT '',
  `KOTA_ASAL_SEKOLAH` varchar(40) NOT NULL DEFAULT '',
  `UAN_BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_BING` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NUN_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NTMB` decimal(8,2) DEFAULT '0.00',
  `NTK` decimal(8,2) DEFAULT '0.00',
  `NILAI_AKHIR` decimal(8,2) NOT NULL DEFAULT '0.00',
  `JALUR_DAFTAR` varchar(2) DEFAULT NULL,
  `PILIH1` varchar(10) NOT NULL DEFAULT '',
  `PILIH2` varchar(10) DEFAULT NULL,
  `WAKTU_DAFTAR` date DEFAULT NULL,
  `LOG_DAFTAR` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `USER_FISIK` varchar(10) NOT NULL DEFAULT '',
  `IP_ADDRESS` varchar(20) DEFAULT NULL,
  `ID_SEKOLAH` varchar(5) DEFAULT NULL,
  `NO_TINGKATAN` smallint(2) DEFAULT '0',
  `DOMISILI` varchar(150) NOT NULL,
  UNIQUE KEY `PID` (`PID`),
  KEY `INDEX_ID_SEKOLAH` (`ID_SEKOLAH`),
  KEY `INDEX_JALUR_DAFTAR` (`JALUR_DAFTAR`),
  KEY `INDEX_NO_UJIAN` (`NO_UJIAN`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pendaftar_smp`
--

DROP TABLE IF EXISTS `pendaftar_smp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendaftar_smp` (
  `PID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NO_PENDAFTARAN` varchar(25) NOT NULL,
  `NO_UJIAN` varchar(15) NOT NULL DEFAULT '',
  `TAHUN_LULUS` varchar(9) DEFAULT '2007/2008',
  `NAMA` varchar(60) NOT NULL DEFAULT '',
  `UAN_NAMA` varchar(40) NOT NULL,
  `JENIS_KEL` char(1) NOT NULL DEFAULT '',
  `TMP_LAHIR` varchar(40) DEFAULT NULL,
  `TGL_LAHIR` date DEFAULT NULL,
  `ALAMAT` varchar(60) DEFAULT NULL,
  `KOTA` varchar(40) DEFAULT NULL,
  `NO_TELP` varchar(20) DEFAULT NULL,
  `NAMA_ORTU` varchar(60) DEFAULT NULL,
  `ASAL_SEKOLAH` varchar(50) NOT NULL DEFAULT '',
  `KOTA_ASAL_SEKOLAH` varchar(40) NOT NULL DEFAULT '',
  `UAN_BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `RAP_BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `AKHIR_BIND` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `RAP_MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `AKHIR_MAT` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_BING` decimal(8,2) NOT NULL DEFAULT '0.00',
  `UAN_IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `RAP_IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `AKHIR_IPA` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NUN_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NRAP_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NAKHIR_ASLI` decimal(8,2) NOT NULL DEFAULT '0.00',
  `NTMB` decimal(8,2) DEFAULT '0.00',
  `NTK` decimal(8,2) DEFAULT '0.00',
  `NILAI_AKHIR` decimal(8,2) NOT NULL DEFAULT '0.00',
  `JALUR_DAFTAR` varchar(2) DEFAULT NULL,
  `PILIH1` varchar(10) NOT NULL DEFAULT '',
  `PILIH2` varchar(10) DEFAULT NULL,
  `WAKTU_DAFTAR` date DEFAULT NULL,
  `LOG_DAFTAR` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `USER_FISIK` varchar(10) NOT NULL DEFAULT '',
  `IP_ADDRESS` varchar(20) DEFAULT NULL,
  `ID_SEKOLAH` varchar(5) DEFAULT NULL,
  `NO_TINGKATAN` smallint(2) DEFAULT '0',
  `DOMISILI` varchar(150) NOT NULL,
  `ALASAN` varchar(300) DEFAULT NULL,
  `FLAG_ALASAN` int(11) DEFAULT NULL,
  PRIMARY KEY (`PID`),
  KEY `INDEX_JALUR_DAFTAR` (`JALUR_DAFTAR`),
  KEY `INDEX_ID_SEKOLAH` (`ID_SEKOLAH`),
  KEY `INDEX_NO_UJIAN` (`NO_UJIAN`)
) ENGINE=MyISAM AUTO_INCREMENT=474 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sekolah`
--

DROP TABLE IF EXISTS `sekolah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sekolah` (
  `ID_SEKOLAH` int(11) NOT NULL DEFAULT '0',
  `ID_SUB_RAYON` int(11) DEFAULT NULL,
  `NO_TINGKATAN` int(11) DEFAULT NULL,
  `ID_KECAMATAN` int(11) DEFAULT NULL,
  `NAMA_SEKOLAH` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `JURUSAN` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ALAMAT_SEKOLAH` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `TELPON` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `ID_SEKOLAH_SERVER` int(11) DEFAULT NULL,
  `ID_KAWASAN` int(11) DEFAULT NULL,
  `FTP_LOGIN` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `FTP_PASSWORD` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `NO_RUMPUN` varchar(5) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ID_SEKOLAH`),
  KEY `INDEX_TINGKATAN` (`NO_TINGKATAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_aplikasi`
--

DROP TABLE IF EXISTS `user_aplikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_aplikasi` (
  `ID_SEKOLAH` int(11) DEFAULT NULL,
  `NAMAUSER` varchar(25) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `NAMALENGKAP` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `PASSWD` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `KETERANGAN` mediumtext COLLATE latin1_general_ci,
  `hak` enum('admin','inputsmp','inputsma','inputsmk','inputrekomsmp','inputrekomsmk','inputrekomsma') COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`NAMAUSER`),
  KEY `INDEX_ID_SEKOLAH` (`ID_SEKOLAH`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-17  0:51:15
