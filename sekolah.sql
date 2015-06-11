-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: inputsda2012
-- ------------------------------------------------------
-- Server version	5.5.24-1~dotdeb.1

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
  PRIMARY KEY (`ID_SEKOLAH`),
  KEY `INDEX_TINGKATAN` (`NO_TINGKATAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sekolah`
--

LOCK TABLES `sekolah` WRITE;
/*!40000 ALTER TABLE `sekolah` DISABLE KEYS */;
INSERT INTO `sekolah` VALUES (2,4,1,43,'SMP Negeri 2 Sidoarjo','Sidoarjo','Jl. A. Yani 8B','8941132',2,102,'opr8941132','2350b73387be90bb6bc137e9da702187'),(3,3,1,37,'SMP Negeri 3 Sidoarjo','Sidoarjo','Jl.Raden Patah 5','8941141',3,104,'opr8941141','0e72769f07bf9e8f51041bed4dc2af03'),(4,8,1,66,'SMP Negeri 4 Sidoarjo','Sidoarjo','Jl. Sungon. Suko','8963734',4,104,'opr8963734','abd07dc5f58d74195c7f4d5e5a4002a1'),(5,9,1,36,'SMP Negeri 5 Sidoarjo','Sidoarjo','Jl. Untung Suropati','8941769',5,104,'opr8941769','5a4394957f5a033bab8b9506e7b1c567'),(6,6,1,26,'SMP Negeri 6 Sidoarjo','Sidoarjo','Ds Bluru Kidul','8953888',6,102,'opr8953888','c344d5a89ffe797243f434c5abd03059'),(7,9,1,19,'SMP Negeri 1 Buduran','Buduran','Jl. P. Bawean 425','8961169',7,102,'opr8961169','938141196ce9e5ec9fdecd5f7828a1c9'),(8,5,1,23,'SMP Negeri 2 Buduran','Buduran','Ds. Sido Kepung','8962192',8,103,'opr8962192','2aaaec5ff02e9598b52ae272104b58a0'),(9,7,1,90,'SMP Negeri 1 Candi','Candi','Jl. Raya Candi','8941105',9,102,'opr8941105','9723c86d0fc644f27c01236b18ed3348'),(10,2,1,61,'SMP Negeri 2 Candi','Candi','Ds. Ngampel Sari','8961942',10,103,'opr8961942','7f2bbd4eac2b80d440b7273c8c2af0fd'),(11,7,1,77,'SMP Negeri 3 Candi','Candi','Ds. Sugihwaras','8953376',11,103,'opr8953376','3aa0a5a6aabf6d0f8c5fe8be2f00675c'),(12,9,1,96,'SMP Negeri 1 Porong','Porong','Jl. Bhayangkari 368','0343-851246',12,102,'opr0343-851246','989c210c30bf93324170e139377878d9'),(13,5,1,78,'SMP Negeri 2 Porong','Porong','Ds. Reno Kenongo','0343-853150',13,103,'opr0343-853150','0a43b36df8117239f480a7b56aab8c8e'),(14,4,1,71,'SMP Negeri 3 Porong','Porong','Jl. Wr. Supratman','0343-852572',14,103,'opr0343-852572','9a46353439a2544c7feb8a3cfd00eb00'),(15,6,1,36,'SMP Negeri 1 Krembung','Krembung','Ds. Mojoruntut','8850795',15,104,'opr8850795','cb00bd1a89e19b8839638f3a3f09e12f'),(16,6,1,67,'SMP Negeri 2 Krembung','Krembung','Jl. Krembung','8851455',16,103,'opr8851455','a39d932cb67cee4aaaf01dd02a940c6f'),(17,4,1,40,'SMP Negeri 1 Tulangan','Tulangan','Jl. AMD Gelang','8851650',17,103,'opr8851650','26a770129ab4a8409fb28fc0cf1af22f'),(18,4,1,78,'SMP Negeri 1 Tanggulangin','Tanggulangin','Ds. Kalisampurno','8850200',18,104,'opr8850200','c2ea672ae4635d4eee2764d7e8a99197'),(19,6,1,61,'SMP Negeri 2 Tanggulangin','Tanggulangin','Ds. Kedungbanteng','8923733',19,102,'opr8923733','d1468435964d15ced6bb0f68294e5be7'),(20,4,1,20,'SMP Negeri 1 Jabon','Jabon','Dukuhsari 17','0343-851295',20,101,'opr0343-851295','d8ccd38bfda1cd98f1b62a05fce810f1'),(21,4,1,66,'SMP Negeri 2 Jabon','Jabon','Ds. Permisan','0343-850886',21,102,'opr0343-850886','b260e22ec7804a038b33399237554d0b'),(22,1,1,4,'SMP Negeri 1 Krian','Krian','Jl. Raya Krian','8971253',22,101,'opr8971253','50789201c2cbb59c4ba3793b9496e38a'),(23,6,1,50,'SMP Negeri 2 Krian','Krian','Jl. Sndar. Pr. Sudarmo','8971575',23,103,'opr8971575','2fd1cf4c98c12cdda7884c13b5251e35'),(24,4,1,22,'SMP Negeri 3 Krian','Krian','Jl. Keboharan','8971540',24,102,'opr8971540','6d410442bf49ff19bd84effdd98f7b4a'),(25,8,1,101,'SMP Negeri 1 Balongbendo','Balongbendo','Jl. Raya Balongbendo','8972607',25,103,'opr8972607','c3ae5e38489d130a6f210dbe76becc6c'),(26,9,1,73,'SMP Negeri 2 Balongbendo','Balongbendo','Ds. Sumokbangsari','8974611',26,104,'opr8974611','25d81ac59f946ae9e58dea02add7948a'),(27,4,1,89,'SMP Negeri 1 Tarik','Tarik','Jl. Kemuning','8970425',27,103,'opr8970425','2d0dccb2c7175db112c293ad6f71efcb'),(28,9,1,2,'SMP Negeri 2 Tarik','Tarik','Jl. Kedungbacok','8970930',28,102,'opr8970930','58458f1f56132f919cd8864c280ccdb8'),(29,4,1,40,'SMP Negeri 1 Prambon','Prambon','Ds. Wirobiting','8975960',29,101,'opr8975960','0ec84ce4afc61e314b83f00c057f0ef5'),(30,3,1,45,'SMP Negeri 1 Wonoayu','Wonoayu','Jl. Raya Semambung','8972179',30,102,'opr8972179','5d7b8fa9a46c9c3786eb3fd4a5ef1aab'),(31,10,1,1,'SMP Negeri 2 Wonoayu','Wonoayu','Ds. Becirongengor','8830067',31,101,'opr8830067','fa409f505a6b34d0a1e282dc9d2a511b'),(32,7,1,11,'SMP Negeri 1 Taman','Taman','Jl. Kestrian 1 Ketegan','7881538',32,103,'opr7881538','5440fb2125d223e4c50ad3070c08ff0f'),(33,9,1,5,'SMP Negeri 2 Taman','Taman','Jl. Jemundo','7882459',33,102,'opr7882459','bbd209173e34f2d5bdeba7a4cbfcabdd'),(34,8,1,6,'SMP Negeri 3 Taman','Taman','Jl. Swnggaling Permai','7887649',34,103,'opr7887649','488f64dae00f7538dcb47674a2175c35'),(35,4,1,41,'SMP Negeri 1 Sukodono','Sukodono','Jl. Anggaswangi','8830579',35,101,'opr8830579','dc16aa00d3c8d103c7b068c579750c24'),(36,10,1,90,'SMP Negeri 2 Sukodono','Sukodono','Jl. Plumbungan','8831090',36,102,'opr8831090','7d9b21d3daf0fb2897efc6c97962ef00'),(37,7,1,76,'SMP Negeri 1 Gedangan','Gedangan','Jl. Raya Punggul','8912842',37,103,'opr8912842','6139dd4e579aeb7dde2146ccfeb81ff3'),(38,8,1,64,'SMP Negeri 2 Gedangan','Gedangan','Ds. Ganting','8910652',38,104,'opr8910652','b34cdae10820c1cf2761acc5fb1f0dbd'),(39,4,1,74,'SMP Negeri 1 Waru','Waru','Jl. Kepuh Kiriman','8665047',39,103,'opr8665047','834808a1339cfc946bb2e30e4496160d'),(40,4,1,20,'SMP Negeri 2 Waru','Waru','Jl. Kom. Kepuh Permai','8661775',40,104,'opr8661775','e2c017c832ad56f7e5fc08bdfc38529d'),(41,6,1,51,'SMP Negeri 3 Waru','Waru','Jl. Raya Waru','8531398',41,104,'opr8531398','b7c682339e7c72b25263cc0f7f4bbf4b'),(42,6,1,9,'SMP Negeri 4 Waru','Waru','Jl. Komp. Delta Sari','8544639',42,104,'opr8544639','f35222f8f07078e87c9d43b047bf157d'),(44,6,1,72,'SMP Negeri 2 Sedati','Sedati','Jl. Raya Camandi','8910754',44,101,'opr8910754','4ff1fc5e918c7b4b28ec76bbfc97c6cb'),(52,1,2,65,'SMA Negeri 2 Sidoarjo','Sidoarjo','Jl. Kutuk Sidokare','8961119',52,101,'opr8961119','5508174602e4e1ad7de56219f6242428'),(53,2,2,72,'SMA Negeri 3 Sidoarjo','Sidoarjo','Jl. Sultan Agung 9','8961625',53,102,'opr8961625','b52be715bd7b57cec41a0543bbda9342'),(54,3,2,1,'SMA Negeri 4 Sidoarjo','Sidoarjo','Jl. Raya Suko','8966365',54,102,'opr8966365','db7e911c168a9ad127b0ba462992b957'),(55,9,2,89,'SMA Negeri 1 Porong','Porong','Jl. Bhayangkari','0343-856068',55,104,'opr0343-856068','aba79c1994898cda38ca2ee79485e905'),(56,7,2,94,'SMA Negeri 1 Krembung','Krembung','Ds. Mojoruntut','8850565',56,103,'opr8850565','a1029258cfc7ede821a03fc25a819e4f'),(57,1,2,12,'SMA Negeri 1 Taman','Taman','Jl. S. Pry. Sudarmo','8971528',57,102,'opr8971528','386864ab6e7aa6128b41e4cd298378ba'),(58,5,2,92,'SMA Negeri 1 Waru','Waru','Jl. Sawunggaling 2, Jemundo','7882446',58,102,'opr7882446','480cf12b8f4514541ab56bc1bd95d061'),(59,8,2,86,'SMA Negeri 1 Gedangan','Gedangan','Jl. Brantas Barito Wisma Tropodo','8661460',59,103,'opr8661460','59f2dba9e4c9d37900578cc40002f205'),(60,10,2,39,'SMA Negeri 1 Wonoayu','Wonoayu','Jl. Raya Sedati','8910819',60,101,'opr8910819','5164aa35c09ab9d216689191dfe2f46a'),(61,6,2,91,'SMA Negeri 1 Tarik','Tarik','Ds. Pagerngumbuk','70960430',61,104,'opr70960430','413fb3ce9c0f59670f9b8afa57fba406'),(7506,0,3,NULL,'SMK Negeri 1 Jabon','KRIA KULIT','Kec. Jabon','0',0,0,'',''),(7101,4,3,89,'SMK Negeri 1 Sidoarjo','T. GAMBAR BANGUNAN','Jl. Monginsidi','8965636',7101,102,'opr8965636','fa6cd4d2b24a09049a88f1288781f6bf'),(7102,3,3,77,'SMK Negeri 1 Sidoarjo','T. AUDIO VIDEO','Jl. Monginsidi','8965636',7102,104,'opr8965636','eac847ba0816f9c624f5fce8f1d4e5c4'),(7103,6,3,77,'SMK Negeri 1 Sidoarjo','T. KENDARAAN RINGAN','Jl. Monginsidi','8965636',7103,102,'opr8965636','22511bf3c816a65ffc7057c28bbaea82'),(7104,6,3,38,'SMK Negeri 1 Sidoarjo','T. IN TALASI T. LISTRIK','Jl. Monginsidi','8965636',7104,101,'opr8965636','4f50ce4d9d012cffcbdd78f0d806064a'),(7105,1,3,37,'SMK Negeri 1 Sidoarjo','T. PENDINGIN DAN TATA UDARA','Jl. Monginsidi','8965636',7105,103,'opr8965636','8a2919191564f4244dbe57c82eac40c4'),(7106,7,3,8,'SMK Negeri 1 Sidoarjo','T. KONSTRUKSI KAYU','Jl. Monginsidi','8965636',7106,102,'opr8965636','d8f93d0da2fc4a8005ee972a548df83d'),(7107,8,3,12,'SMK Negeri 1 Sidoarjo','T. PERMESINAN','Jl. Monginsidi','8965636',7107,102,'opr8965636','3e2e34b15dcc13ccab3fcde095a4b46c'),(7201,9,3,49,'SMK Negeri 1 Buduran','JASA BOGA','Jl. Jenggolo 1 B','8941985',7201,104,'opr8941985','e128e4e222b250f043642a5ec44cddcd'),(7202,8,3,79,'SMK Negeri 1 Buduran','AKOMODASI PERHOTELAN','Jl. Jenggolo 1 B','8941985',7202,103,'opr8941985','27b9eb3bb3faf2bd695ee7ca645005cb'),(7203,8,3,5,'SMK Negeri 1 Buduran','BUSANA BUTIK','Jl. Jenggolo 1 B','8941985',7203,101,'opr8941985','58c30c7c1e0bd2f898ade35c72aaca96'),(7204,0,3,0,'SMK Negeri 1 Buduran','TATA KECANTIKAN','Jl. Jenggolo 1 B','8941985',7204,0,'',''),(7301,7,3,91,'SMK Negeri 2 Buduran','MULTIMEDIA','Jl. Jenggolo 2 A','8964034',7301,103,'opr8964034','391bb70da978fb0703d189039cee8baa'),(7302,3,3,64,'SMK Negeri 2 Buduran','REKAYASA PERANGKAT LUNAK','Jl. Jenggolo 2 A','8964034',7302,103,'opr8964034','c4b3dfffaddbf9b7fe17a2d9ed8ebd3b'),(7303,5,3,28,'SMK Negeri 2 Buduran','ADMINISTRASI PERKANTORAN','Jl. Jenggolo 2 A','8964034',7303,101,'opr8964034','0b9ce72d05cbfb9e11ec57011d26ed8f'),(7304,2,3,59,'SMK Negeri 2 Buduran','AKUNTANSI','Jl. Jenggolo 2 A','8964034',7304,103,'opr8964034','aa18bcfe6f17c8ca0ce891a7592e0899'),(7305,10,3,18,'SMK Negeri 2 Buduran','PEMASARAN','Jl. Jenggolo 2 A','8964034',7305,104,'opr8964034','6baaeafcf2a11aafea21187bf1e803e0'),(7306,0,3,0,'SMK Negeri 2 Buduran','PERBANKAN','Jl. Jenggolo 2 A','8964034',7306,0,'',''),(7401,10,3,7,'SMK Negeri 3 Buduran','GAMBAR RANCANG BANGUN','Jl. Jenggolo 1 C','8961218',7401,102,'opr8961218','1f0b81bf9cec4c6f0e48bc5ba01441d6'),(7402,7,3,35,'SMK Negeri 3 Buduran','I. PERMESINAN KAPAL','Jl. Jenggolo 1 C','8961218',7402,103,'opr8961218','f1f2b25c67a781e41785ed91f2bf0db8'),(7403,7,3,25,'SMK Negeri 3 Buduran','KELISTRIKAN KAPAL','Jl. Jenggolo 1 C','8961218',7403,101,'opr8961218','e53c0ebd67d96fbce9809074825a6cca'),(7404,3,3,96,'SMK Negeri 3 Buduran','T. PENGELASAN KAPAL','Jl. Jenggolo 1 C','8961218',7404,102,'opr8961218','0ceaee566aaeefc29f1b06b053222391'),(7405,3,3,39,'SMK Negeri 3 Buduran','T. KOMPUTER DAN JARINGAN','Jl. Jenggolo 1 C','8961218',7405,101,'opr8961218','884f7bd4a22f0d9f28e74fcc364dd56b'),(7406,9,3,46,'SMK Negeri 3 Buduran','T. PENDINGIN DAN TATA UDARA','Jl. Jenggolo 1 C','8961218',7406,103,'opr8961218','cc89f3af779504a2d913889f9ad2a90c'),(7407,9,3,47,'SMK Negeri 3 Buduran','KONSTRUKSI KAPAL BAJA','Jl. Jenggolo 1 C','8961218',7407,103,'opr8961218','28426d5734fb6272722b6aeabbb00b96'),(7408,3,3,95,'SMK Negeri 3 Buduran','T. MESIN PERKAKAS','Jl. Jenggolo 1 C','8961218',7408,104,'opr8961218','a82888f4146d8ffecfd41eb3832681f8'),(7409,5,3,99,'SMK Negeri 3 Buduran','TEKNIK KENDARAAN RINGAN','Jl. Jenggolo 1 C','8961218',7409,103,'opr8961218','e9651a22287e31db81eb4904820f9189'),(7410,2,3,8,'SMK Negeri 3 Buduran','INTERIOR KAPAL','Jl. Jenggolo 1 C','8961218',7410,101,'opr8961218','3639a60677771fc7ba4ec8f00578bb43'),(7501,0,3,0,'SMK Negeri 1 Jabon','TEKNIK OTOMOTIF','Kec. Jabon ','',7501,0,'',''),(7502,0,3,0,'SMK Negeri 1 Jabon','TEKNIK ELEKTRO','Kec. Jabon ','',7502,0,'',''),(7503,0,3,0,'SMK Negeri 1 Jabon','MULTIMEDIA','Kec. Jabon ','',7503,0,'',''),(7504,0,3,0,'SMK Negeri 1 Jabon','TATA BUSANA','Kec. Jabon ','',7504,0,'',''),(7505,0,3,0,'SMK Negeri 1 Jabon','KRIA TEKSTIL','Kec. Jabon ','',7505,0,'','');
/*!40000 ALTER TABLE `sekolah` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-06-21 15:32:49
