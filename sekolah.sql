-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.6.14 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.2.0.4951
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for inputsda2014
CREATE DATABASE IF NOT EXISTS `inputsda2014` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inputsda2014`;


-- Dumping structure for table inputsda2014.sekolah
CREATE TABLE IF NOT EXISTS `sekolah` (
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

-- Dumping data for table inputsda2014.sekolah: 80 rows
/*!40000 ALTER TABLE `sekolah` DISABLE KEYS */;
REPLACE INTO `sekolah` (`ID_SEKOLAH`, `ID_SUB_RAYON`, `NO_TINGKATAN`, `ID_KECAMATAN`, `NAMA_SEKOLAH`, `JURUSAN`, `ALAMAT_SEKOLAH`, `TELPON`, `ID_SEKOLAH_SERVER`, `ID_KAWASAN`, `FTP_LOGIN`, `FTP_PASSWORD`, `NO_RUMPUN`) VALUES
	(25, 4, 1, 43, 'SMP Negeri 2 Sidoarjo', 'Sidoarjo', 'Jl. A. Yani 8B', '8941132', 2, 102, 'opr8941132', '2350b73387be90bb6bc137e9da702187', ''),
	(26, 8, 1, 66, 'SMP Negeri 4 Sidoarjo', 'Sidoarjo', 'Jl. Sungon. Suko', '8963734', 4, 104, 'opr8963734', 'abd07dc5f58d74195c7f4d5e5a4002a1', ''),
	(27, 6, 1, 26, 'SMP Negeri 6 Sidoarjo', 'Sidoarjo', 'Ds Bluru Kidul', '8953888', 6, 102, 'opr8953888', 'c344d5a89ffe797243f434c5abd03059', ''),
	(28, 9, 1, 19, 'SMP Negeri 1 Buduran', 'Buduran', 'Jl. P. Bawean 425', '8961169', 7, 102, 'opr8961169', '938141196ce9e5ec9fdecd5f7828a1c9', ''),
	(29, 5, 1, 23, 'SMP Negeri 2 Buduran', 'Buduran', 'Ds. Sido Kepung', '8962192', 8, 103, 'opr8962192', '2aaaec5ff02e9598b52ae272104b58a0', ''),
	(30, 7, 1, 90, 'SMP Negeri 1 Candi', 'Candi', 'Jl. Raya Candi', '8941105', 9, 102, 'opr8941105', '9723c86d0fc644f27c01236b18ed3348', ''),
	(31, 2, 1, 61, 'SMP Negeri 2 Candi', 'Candi', 'Ds. Ngampel Sari', '8961942', 10, 103, 'opr8961942', '7f2bbd4eac2b80d440b7273c8c2af0fd', ''),
	(32, 7, 1, 77, 'SMP Negeri 3 Candi', 'Candi', 'Ds. Sugihwaras', '8953376', 11, 103, 'opr8953376', '3aa0a5a6aabf6d0f8c5fe8be2f00675c', ''),
	(33, 9, 1, 96, 'SMP Negeri 1 Porong', 'Porong', 'Jl. Bhayangkari 368', '0343-851246', 12, 102, 'opr0343-851246', '989c210c30bf93324170e139377878d9', ''),
	(34, 5, 1, 78, 'SMP Negeri 2 Porong', 'Porong', 'Ds. Reno Kenongo', '0343-853150', 13, 103, 'opr0343-853150', '0a43b36df8117239f480a7b56aab8c8e', ''),
	(35, 4, 1, 71, 'SMP Negeri 3 Porong', 'Porong', 'Jl. Wr. Supratman', '0343-852572', 14, 103, 'opr0343-852572', '9a46353439a2544c7feb8a3cfd00eb00', ''),
	(36, 6, 1, 36, 'SMP Negeri 1 Krembung', 'Krembung', 'Ds. Mojoruntut', '8850795', 15, 104, 'opr8850795', 'cb00bd1a89e19b8839638f3a3f09e12f', ''),
	(37, 6, 1, 67, 'SMP Negeri 2 Krembung', 'Krembung', 'Jl. Krembung', '8851455', 16, 103, 'opr8851455', 'a39d932cb67cee4aaaf01dd02a940c6f', ''),
	(38, 4, 1, 40, 'SMP Negeri 1 Tulangan', 'Tulangan', 'Jl. AMD Gelang', '8851650', 17, 103, 'opr8851650', '26a770129ab4a8409fb28fc0cf1af22f', ''),
	(39, 4, 1, 78, 'SMP Negeri 1 Tanggulangin', 'Tanggulangin', 'Ds. Kalisampurno', '8850200', 18, 104, 'opr8850200', 'c2ea672ae4635d4eee2764d7e8a99197', ''),
	(40, 6, 1, 61, 'SMP Negeri 2 Tanggulangin', 'Tanggulangin', 'Ds. Kedungbanteng', '8923733', 19, 102, 'opr8923733', 'd1468435964d15ced6bb0f68294e5be7', ''),
	(41, 4, 1, 20, 'SMP Negeri 1 Jabon', 'Jabon', 'Dukuhsari 17', '0343-851295', 20, 101, 'opr0343-851295', 'd8ccd38bfda1cd98f1b62a05fce810f1', ''),
	(42, 4, 1, 66, 'SMP Negeri 2 Jabon', 'Jabon', 'Ds. Permisan', '0343-850886', 21, 102, 'opr0343-850886', 'b260e22ec7804a038b33399237554d0b', ''),
	(43, 1, 1, 4, 'SMP Negeri 1 Krian', 'Krian', 'Jl. Raya Krian', '8971253', 22, 101, 'opr8971253', '50789201c2cbb59c4ba3793b9496e38a', ''),
	(44, 6, 1, 50, 'SMP Negeri 2 Krian', 'Krian', 'Jl. Sndar. Pr. Sudarmo', '8971575', 23, 103, 'opr8971575', '2fd1cf4c98c12cdda7884c13b5251e35', ''),
	(45, 4, 1, 22, 'SMP Negeri 3 Krian', 'Krian', 'Jl. Keboharan', '8971540', 24, 102, 'opr8971540', '6d410442bf49ff19bd84effdd98f7b4a', ''),
	(46, 8, 1, 101, 'SMP Negeri 1 Balongbendo', 'Balongbendo', 'Jl. Raya Balongbendo', '8972607', 25, 103, 'opr8972607', 'c3ae5e38489d130a6f210dbe76becc6c', ''),
	(47, 9, 1, 73, 'SMP Negeri 2 Balongbendo', 'Balongbendo', 'Ds. Sumokbangsari', '8974611', 26, 104, 'opr8974611', '25d81ac59f946ae9e58dea02add7948a', ''),
	(48, 4, 1, 89, 'SMP Negeri 1 Tarik', 'Tarik', 'Jl. Kemuning', '8970425', 27, 103, 'opr8970425', '2d0dccb2c7175db112c293ad6f71efcb', ''),
	(49, 9, 1, 2, 'SMP Negeri 2 Tarik', 'Tarik', 'Jl. Kedungbacok', '8970930', 28, 102, 'opr8970930', '58458f1f56132f919cd8864c280ccdb8', ''),
	(50, 4, 1, 40, 'SMP Negeri 1 Prambon', 'Prambon', 'Ds. Wirobiting', '8975960', 29, 101, 'opr8975960', '0ec84ce4afc61e314b83f00c057f0ef5', ''),
	(51, 3, 1, 45, 'SMP Negeri 1 Wonoayu', 'Wonoayu', 'Jl. Raya Semambung', '8972179', 30, 102, 'opr8972179', '5d7b8fa9a46c9c3786eb3fd4a5ef1aab', ''),
	(52, 10, 1, 1, 'SMP Negeri 2 Wonoayu', 'Wonoayu', 'Ds. Becirongengor', '8830067', 31, 101, 'opr8830067', 'fa409f505a6b34d0a1e282dc9d2a511b', ''),
	(53, 7, 1, 11, 'SMP Negeri 1 Taman', 'Taman', 'Jl. Kestrian 1 Ketegan', '7881538', 32, 103, 'opr7881538', '5440fb2125d223e4c50ad3070c08ff0f', ''),
	(54, 9, 1, 5, 'SMP Negeri 2 Taman', 'Taman', 'Jl. Jemundo', '7882459', 33, 102, 'opr7882459', 'bbd209173e34f2d5bdeba7a4cbfcabdd', ''),
	(55, 8, 1, 6, 'SMP Negeri 3 Taman', 'Taman', 'Jl. Swnggaling Permai', '7887649', 34, 103, 'opr7887649', '488f64dae00f7538dcb47674a2175c35', ''),
	(56, 4, 1, 41, 'SMP Negeri 1 Sukodono', 'Sukodono', 'Jl. Anggaswangi', '8830579', 35, 101, 'opr8830579', 'dc16aa00d3c8d103c7b068c579750c24', ''),
	(57, 10, 1, 90, 'SMP Negeri 2 Sukodono', 'Sukodono', 'Jl. Plumbungan', '8831090', 36, 102, 'opr8831090', '7d9b21d3daf0fb2897efc6c97962ef00', ''),
	(58, 7, 1, 76, 'SMP Negeri 1 Gedangan', 'Gedangan', 'Jl. Raya Punggul', '8912842', 37, 103, 'opr8912842', '6139dd4e579aeb7dde2146ccfeb81ff3', ''),
	(59, 8, 1, 64, 'SMP Negeri 2 Gedangan', 'Gedangan', 'Ds. Ganting', '8910652', 38, 104, 'opr8910652', 'b34cdae10820c1cf2761acc5fb1f0dbd', ''),
	(60, 4, 1, 74, 'SMP Negeri 1 Waru', 'Waru', 'Jl. Kepuh Kiriman', '8665047', 39, 103, 'opr8665047', '834808a1339cfc946bb2e30e4496160d', ''),
	(61, 4, 1, 20, 'SMP Negeri 2 Waru', 'Waru', 'Jl. Kom. Kepuh Permai', '8661775', 40, 104, 'opr8661775', 'e2c017c832ad56f7e5fc08bdfc38529d', ''),
	(62, 6, 1, 51, 'SMP Negeri 3 Waru', 'Waru', 'Jl. Raya Waru', '8531398', 41, 104, 'opr8531398', 'b7c682339e7c72b25263cc0f7f4bbf4b', ''),
	(63, 6, 1, 9, 'SMP Negeri 4 Waru', 'Waru', 'Jl. Komp. Delta Sari', '8544639', 42, 104, 'opr8544639', 'f35222f8f07078e87c9d43b047bf157d', ''),
	(64, 6, 1, 72, 'SMP Negeri 2 Sedati', 'Sedati', 'Jl. Raya Camandi', '8910754', 44, 101, 'opr8910754', '4ff1fc5e918c7b4b28ec76bbfc97c6cb', ''),
	(17, 3, 2, 1, 'SMA Negeri 4 Sidoarjo', 'Sidoarjo', 'Jl. Raya Suko', '8966365', 54, 102, 'opr8966365', 'db7e911c168a9ad127b0ba462992b957', ''),
	(18, 9, 2, 89, 'SMA Negeri 1 Porong', 'Porong', 'Jl. Bhayangkari', '0343-856068', 55, 104, 'opr0343-856068', 'aba79c1994898cda38ca2ee79485e905', ''),
	(19, 5, 2, 92, 'SMA Negeri 1 Waru', 'Waru', 'Jl. Sawunggaling 2, Jemundo', '7882446', 58, 102, 'opr7882446', '480cf12b8f4514541ab56bc1bd95d061', ''),
	(20, 8, 2, 86, 'SMA Negeri 1 Gedangan', 'Gedangan', 'Jl. Brantas Barito Wisma Tropodo', '8661460', 59, 103, 'opr8661460', '59f2dba9e4c9d37900578cc40002f205', ''),
	(21, 10, 2, 39, 'SMA Negeri 1 Wonoayu', 'Wonoayu', 'Jl. Raya Sedati', '8910819', 60, 101, 'opr8910819', '5164aa35c09ab9d216689191dfe2f46a', ''),
	(22, 6, 2, 91, 'SMA Negeri 1 Tarik', 'Tarik', 'Ds. Pagerngumbuk', '70960430', 61, 104, 'opr70960430', '413fb3ce9c0f59670f9b8afa57fba406', ''),
	(71002, 4, 3, 89, 'SMK Negeri 1 Sidoarjo', 'Teknik Konstruksi Kayu', 'Jl. Monginsidi', '8965636', 7101, 102, 'opr8965636', 'fa6cd4d2b24a09049a88f1288781f6bf', '1.5'),
	(71004, 3, 3, 77, 'SMK Negeri 1 Sidoarjo', 'Teknik Gambar Bangunan', 'Jl. Monginsidi', '8965636', 7102, 104, 'opr8965636', 'eac847ba0816f9c624f5fce8f1d4e5c4', '1.6'),
	(71010, 6, 3, 77, 'SMK Negeri 1 Sidoarjo', 'Teknik Instalasi Pemanfaatan Tenaga Listrik', 'Jl. Monginsidi', '8965636', 7103, 102, 'opr8965636', '22511bf3c816a65ffc7057c28bbaea82', '1.17'),
	(71012, 4, 3, 89, 'SMK Negeri 1 Sidoarjo', 'Teknik Pendingin dan Tata Udara', 'Jl. Monginsidi', '8965636', 71011, 102, 'opr8965636', 'fa6cd4d2b24a09049a88f1288781f6bf', '1.15'),
	(72106, 9, 3, 49, 'SMK Negeri 1 Buduran', 'Akomodasi Perhotelan', 'Jl. Jenggolo 1 B', '8941985', 7201, 104, 'opr8941985', 'e128e4e222b250f043642a5ec44cddcd', '7.2'),
	(72107, 8, 3, 79, 'SMK Negeri 1 Buduran', 'Jasa Boga', 'Jl. Jenggolo 1 B', '8941985', 7202, 103, 'opr8941985', '27b9eb3bb3faf2bd695ee7ca645005cb', '7.1'),
	(72109, 8, 3, 5, 'SMK Negeri 1 Buduran', 'Tata Kecantikan Rambut', 'Jl. Jenggolo 1 B', '8941985', 7203, 101, 'opr8941985', '58c30c7c1e0bd2f898ade35c72aaca96', '7.4'),
	(72110, 0, 3, 0, 'SMK Negeri 1 Buduran', 'Tata Kecantikan Kulit', 'Jl. Jenggolo 1 B', '8941985', 7204, 0, '', '', '7.3'),
	(73063, 7, 3, 91, 'SMK Negeri 2 Buduran', 'Rekayasa Perangkat Lunak', 'Jl. Jenggolo 2 A', '8964034', 7301, 103, 'opr8964034', '391bb70da978fb0703d189039cee8baa', '6.1'),
	(73065, 3, 3, 64, 'SMK Negeri 2 Buduran', 'Multimedia', 'Jl. Jenggolo 2 A', '8964034', 7302, 103, 'opr8964034', 'c4b3dfffaddbf9b7fe17a2d9ed8ebd3b', '2.1'),
	(73100, 5, 3, 28, 'SMK Negeri 2 Buduran', 'Administrasi Perkantoran', 'Jl. Jenggolo 2 A', '8964034', 7303, 101, 'opr8964034', '0b9ce72d05cbfb9e11ec57011d26ed8f', '6.2'),
	(73101, 2, 3, 59, 'SMK Negeri 2 Buduran', 'Akuntansi', 'Jl. Jenggolo 2 A', '8964034', 7304, 103, 'opr8964034', 'aa18bcfe6f17c8ca0ce891a7592e0899', '6.3'),
	(73102, 2, 3, 59, 'SMK Negeri 2 Buduran', 'Perbankan', 'Jl. Jenggolo 2 A', '8964034', 7304, 103, 'opr8964034', 'aa18bcfe6f17c8ca0ce891a7592e0899', '6.3'),
	(74012, 10, 3, 7, 'SMK Negeri 3 Buduran', 'Teknik Pendingin dan Tata Udara', 'Jl. Jenggolo 1 C', '8961218', 7401, 102, 'opr8961218', '1f0b81bf9cec4c6f0e48bc5ba01441d6', '2.1'),
	(74013, 7, 3, 35, 'SMK Negeri 3 Buduran', 'Teknik Pemesinan', 'Jl. Jenggolo 1 C', '8961218', 7402, 103, 'opr8961218', 'f1f2b25c67a781e41785ed91f2bf0db8', '1.5'),
	(74043, 7, 3, 25, 'SMK Negeri 3 Buduran', 'Teknik Kendaraan Ringan', 'Jl. Jenggolo 1 C', '8961218', 7403, 101, 'opr8961218', 'e53c0ebd67d96fbce9809074825a6cca', '1.16'),
	(74046, 3, 3, 96, 'SMK Negeri 3 Buduran', 'Teknik Konstruksi Kapal Baja', 'Jl. Jenggolo 1 C', '8961218', 7404, 102, 'opr8961218', '0ceaee566aaeefc29f1b06b053222391', '1.6'),
	(74050, 3, 3, 39, 'SMK Negeri 3 Buduran', 'Teknik Instalasi Pemesinan Kapal', 'Jl. Jenggolo 1 C', '8961218', 7405, 101, 'opr8961218', '884f7bd4a22f0d9f28e74fcc364dd56b', '1.15'),
	(75043, 0, 3, 0, 'SMK Negeri 1 Jabon', 'Teknik Kendaraan Ringan', 'Kec. Jabon ', '', 7501, 0, '', '', '1.17'),
	(75056, 0, 3, 0, 'SMK Negeri 1 Jabon', 'Teknik Elektronika Industri', 'Kec. Jabon ', '', 7502, 0, '', '', '1.15'),
	(75065, 0, 3, 0, 'SMK Negeri 1 Jabon', 'Multimedia', 'Kec. Jabon ', '', 7503, 0, '', '', '2.1'),
	(75111, 0, 3, 0, 'SMK Negeri 1 Jabon', 'Tata Busana', 'Kec. Jabon ', '', 7504, 0, '', '', '7.4'),
	(75117, 0, 3, 0, 'SMK Negeri 1 Jabon', 'Desain dan Produksi Kriya Tekstil', 'Kec. Jabon ', '', 7505, 0, '', '', '8.2'),
	(71013, 4, 3, 89, 'SMK Negeri 1 Sidoarjo', 'Teknik Pemesinan', 'Jl. Monginsidi', '8965636', 71011, 102, 'opr8965636', 'fa6cd4d2b24a09049a88f1288781f6bf', '1.15'),
	(71043, 4, 3, 89, 'SMK Negeri 1 Sidoarjo', 'Teknik Kendaraan Ringan', 'Jl. Monginsidi', '8965636', 71011, 102, 'opr8965636', 'fa6cd4d2b24a09049a88f1288781f6bf', '1.15'),
	(71055, 4, 3, 89, 'SMK Negeri 1 Sidoarjo', 'Teknik Audio Video', 'Jl. Monginsidi', '8965636', 71011, 102, 'opr8965636', 'fa6cd4d2b24a09049a88f1288781f6bf', '1.15'),
	(72111, 0, 3, 0, 'SMK Negeri 1 Buduran', 'Tata Busana', 'Jl. Jenggolo 1 B', '8941985', 7204, 0, '', '', '7.3'),
	(73104, 2, 3, 59, 'SMK Negeri 2 Buduran', 'Pemasaran', 'Jl. Jenggolo 2 A', '8964034', 7304, 103, 'opr8964034', 'aa18bcfe6f17c8ca0ce891a7592e0899', '6.3'),
	(74051, 3, 3, 39, 'SMK Negeri 3 Buduran', 'Teknik Pengelasan Kapal', 'Jl. Jenggolo 1 C', '8961218', 7405, 101, 'opr8961218', '884f7bd4a22f0d9f28e74fcc364dd56b', '1.15'),
	(74052, 3, 3, 39, 'SMK Negeri 3 Buduran', 'Kelistrikan Kapal', 'Jl. Jenggolo 1 C', '8961218', 7405, 101, 'opr8961218', '884f7bd4a22f0d9f28e74fcc364dd56b', '1.15'),
	(74053, 3, 3, 39, 'SMK Negeri 3 Buduran', 'Teknik Gambar Rancang Bangun Kapal', 'Jl. Jenggolo 1 C', '8961218', 7405, 101, 'opr8961218', '884f7bd4a22f0d9f28e74fcc364dd56b', '1.15'),
	(74054, 3, 3, 39, 'SMK Negeri 3 Buduran', 'Interior Kapal', 'Jl. Jenggolo 1 C', '8961218', 7405, 101, 'opr8961218', '884f7bd4a22f0d9f28e74fcc364dd56b', '1.15'),
	(74064, 3, 3, 39, 'SMK Negeri 3 Buduran', 'Teknik Komputer dan Jaringan', 'Jl. Jenggolo 1 C', '8961218', 7405, 101, 'opr8961218', '884f7bd4a22f0d9f28e74fcc364dd56b', '1.15'),
	(75118, 0, 3, 0, 'SMK Negeri 1 Jabon', 'Desain dan Produksi Kriya Kulit', 'Kec. Jabon ', '', 7505, 0, '', '', '8.2');
/*!40000 ALTER TABLE `sekolah` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
