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

-- Dumping database structure for rankingsda2015
CREATE DATABASE IF NOT EXISTS `rankingsda2015` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `rankingsda2015`;


-- Dumping structure for table rankingsda2015.pagu_sekolah
CREATE TABLE IF NOT EXISTS `pagu_sekolah` (
  `ID_SEKOLAH` varchar(11) NOT NULL DEFAULT '0',
  `NAMA_SEKOLAH` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `JURUSAN` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `PAGUPSB` int(4) DEFAULT NULL,
  `PAGU_SISA` int(4) DEFAULT '0',
  `PAGU_TAHAP2` int(4) DEFAULT '0',
  `JML_TIDAK_NAIK` int(4) NOT NULL,
  `JML_PRESTASI` int(4) NOT NULL,
  `PAGUREKOM` int(4) DEFAULT '0',
  `PAGUAWAL` int(4) DEFAULT '0',
  `PAGULAIN2` int(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table rankingsda2015.pagu_sekolah: ~69 rows (approximately)
/*!40000 ALTER TABLE `pagu_sekolah` DISABLE KEYS */;
REPLACE INTO `pagu_sekolah` (`ID_SEKOLAH`, `NAMA_SEKOLAH`, `JURUSAN`, `PAGUPSB`, `PAGU_SISA`, `PAGU_TAHAP2`, `JML_TIDAK_NAIK`, `JML_PRESTASI`, `PAGUREKOM`, `PAGUAWAL`, `PAGULAIN2`) VALUES
	('25', 'SMP Negeri 2 Sidoarjo', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('26', 'SMP Negeri 4 Sidoarjo', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('27', 'SMP Negeri 6 Sidoarjo', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('28', 'SMP Negeri 1 Buduran', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('29', 'SMP Negeri 2 Buduran', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('30', 'SMP Negeri 1 Candi', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('31', 'SMP Negeri 2 Candi', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('32', 'SMP Negeri 3 Candi', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('33', 'SMP Negeri 1 Porong', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('34', 'SMP Negeri 2 Porong', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('35', 'SMP Negeri 3 Porong', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('36', 'SMP Negeri 1 Krembung', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('37', 'SMP Negeri 2 Krembung', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('38', 'SMP Negeri 1 Tulangan', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('39', 'SMP Negeri 1 Tanggulangin', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('40', 'SMP Negeri 2 Tanggulangin', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('41', 'SMP Negeri 1 Jabon', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('42', 'SMP Negeri 2 Jabon', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('43', 'SMP Negeri 1 Krian', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('44', 'SMP Negeri 2 Krian', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('45', 'SMP Negeri 3 Krian', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('46', 'SMP Negeri 1 Balongbendo', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('47', 'SMP Negeri 2 Balongbendo', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('48', 'SMP Negeri 1 Tarik', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('49', 'SMP Negeri 2 Tarik', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('50', 'SMP Negeri 1 Prambon', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('51', 'SMP Negeri 1 Wonoayu', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('52', 'SMP Negeri 2 Wonoayu', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('53', 'SMP Negeri 1 Taman', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('54', 'SMP Negeri 2 Taman', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('55', 'SMP Negeri 3 Taman', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('56', 'SMP Negeri 1 Sukodono', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('57', 'SMP Negeri 2 Sukodono', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('58', 'SMP Negeri 1 Gedangan', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('59', 'SMP Negeri 2 Gedangan', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('60', 'SMP Negeri 1 Waru', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('61', 'SMP Negeri 2 Waru', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('62', 'SMP Negeri 3 Waru', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('63', 'SMP Negeri 4 Waru', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('64', 'SMP Negeri 2 Sedati', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('17', 'SMA Negeri 4 Sidoarjo', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('18', 'SMA Negeri 1 Porong', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('19', 'SMA Negeri 1 Waru', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('20', 'SMA Negeri 1 Gedangan', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('21', 'SMA Negeri 1 Wonoayu', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('22', 'SMA Negeri 1 Tarik', '', 0, 0, 0, 0, 0, 0, 0, 0),
	('75118', 'SMK Negeri 1 Jabon', 'Desain dan Produksi Kriya Kulit', 0, 0, 0, 0, 0, 0, 0, 0),
	('74064', 'SMK Negeri 3 Buduran', 'Teknik Komputer dan Jaringan', 0, 0, 0, 0, 0, 0, 0, 0),
	('74054', 'SMK Negeri 3 Buduran', 'Interior Kapal', 0, 0, 0, 0, 0, 0, 0, 0),
	('74053', 'SMK Negeri 3 Buduran', 'Teknik Gambar Rancang Bangun Kapal', 0, 0, 0, 0, 0, 0, 0, 0),
	('74052', 'SMK Negeri 3 Buduran', 'Kelistrikan Kapal', 0, 0, 0, 0, 0, 0, 0, 0),
	('74051', 'SMK Negeri 3 Buduran', 'Teknik Pengelasan Kapal', 0, 0, 0, 0, 0, 0, 0, 0),
	('72111', 'SMK Negeri 1 Buduran', 'Tata Busana', 0, 0, 0, 0, 0, 0, 0, 0),
	('73104', 'SMK Negeri 2 Buduran', 'Pemasaran', 0, 0, 0, 0, 0, 0, 0, 0),
	('71055', 'SMK Negeri 1 Sidoarjo', 'Teknik Audio Video', 0, 0, 0, 0, 0, 0, 0, 0),
	('71043', 'SMK Negeri 1 Sidoarjo', 'Teknik Kendaraan Ringan', 0, 0, 0, 0, 0, 0, 0, 0),
	('75117', 'SMK Negeri 1 Jabon', 'Desain dan Produksi Kriya Tekstil', 0, 0, 0, 0, 0, 0, 0, 0),
	('71013', 'SMK Negeri 1 Sidoarjo', 'Teknik Pemesinan', 0, 0, 0, 0, 0, 0, 0, 0),
	('75111', 'SMK Negeri 1 Jabon', 'Tata Busana', 0, 0, 0, 0, 0, 0, 0, 0),
	('75056', 'SMK Negeri 1 Jabon', 'Teknik Elektronika Industri', 0, 0, 0, 0, 0, 0, 0, 0),
	('75065', 'SMK Negeri 1 Jabon', 'Multimedia', 0, 0, 0, 0, 0, 0, 0, 0),
	('75043', 'SMK Negeri 1 Jabon', 'Teknik Kendaraan Ringan', 0, 0, 0, 0, 0, 0, 0, 0),
	('74050', 'SMK Negeri 3 Buduran', 'Teknik Instalasi Pemesinan Kapal', 0, 0, 0, 0, 0, 0, 0, 0),
	('74046', 'SMK Negeri 3 Buduran', 'Teknik Konstruksi Kapal Baja', 0, 0, 0, 0, 0, 0, 0, 0),
	('74043', 'SMK Negeri 3 Buduran', 'Teknik Kendaraan Ringan', 0, 0, 0, 0, 0, 0, 0, 0),
	('74013', 'SMK Negeri 3 Buduran', 'Teknik Pemesinan', 0, 0, 0, 0, 0, 0, 0, 0),
	('74012', 'SMK Negeri 3 Buduran', 'Teknik Pendingin dan Tata Udara', 0, 0, 0, 0, 0, 0, 0, 0),
	('73102', 'SMK Negeri 2 Buduran', 'Perbankan', 0, 0, 0, 0, 0, 0, 0, 0),
	('73101', 'SMK Negeri 2 Buduran', 'Akuntansi', 0, 0, 0, 0, 0, 0, 0, 0),
	('73100', 'SMK Negeri 2 Buduran', 'Administrasi Perkantoran', 0, 0, 0, 0, 0, 0, 0, 0),
	('73065', 'SMK Negeri 2 Buduran', 'Multimedia', 0, 0, 0, 0, 0, 0, 0, 0),
	('73063', 'SMK Negeri 2 Buduran', 'Rekayasa Perangkat Lunak', 0, 0, 0, 0, 0, 0, 0, 0),
	('72110', 'SMK Negeri 1 Buduran', 'Tata Kecantikan Kulit', 0, 0, 0, 0, 0, 0, 0, 0),
	('72109', 'SMK Negeri 1 Buduran', 'Tata Kecantikan Rambut', 0, 0, 0, 0, 0, 0, 0, 0),
	('72107', 'SMK Negeri 1 Buduran', 'Jasa Boga', 0, 0, 0, 0, 0, 0, 0, 0),
	('72106', 'SMK Negeri 1 Buduran', 'Akomodasi Perhotelan', 0, 0, 0, 0, 0, 0, 0, 0),
	('71012', 'SMK Negeri 1 Sidoarjo', 'Teknik Pendingin dan Tata Udara', 0, 0, 0, 0, 0, 0, 0, 0),
	('71010', 'SMK Negeri 1 Sidoarjo', 'Teknik Instalasi Pemanfaatan Tenaga Listrik', 0, 0, 0, 0, 0, 0, 0, 0),
	('71004', 'SMK Negeri 1 Sidoarjo', 'Teknik Gambar Bangunan', 0, 0, 0, 0, 0, 0, 0, 0),
	('71002', 'SMK Negeri 1 Sidoarjo', 'Teknik Konstruksi Kayu', 0, 0, 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `pagu_sekolah` ENABLE KEYS */;


-- Dumping structure for table rankingsda2015.pagu_sekolah_backup
CREATE TABLE IF NOT EXISTS `pagu_sekolah_backup` (
  `ID_SEKOLAH` varchar(11) NOT NULL DEFAULT '0',
  `NAMA_SEKOLAH` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `JURUSAN` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `PAGUPSB` int(4) DEFAULT NULL,
  `PAGU_SISA` int(4) DEFAULT '0',
  `PAGU_TAHAP2` int(4) DEFAULT '0',
  `JML_TIDAK_NAIK` int(4) NOT NULL,
  `JML_PRESTASI` int(4) NOT NULL,
  `PAGUREKOM` int(4) DEFAULT '0',
  `PAGUAWAL` int(4) DEFAULT '0',
  `PAGULAIN2` int(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table rankingsda2015.pagu_sekolah_backup: ~85 rows (approximately)
/*!40000 ALTER TABLE `pagu_sekolah_backup` DISABLE KEYS */;
REPLACE INTO `pagu_sekolah_backup` (`ID_SEKOLAH`, `NAMA_SEKOLAH`, `JURUSAN`, `PAGUPSB`, `PAGU_SISA`, `PAGU_TAHAP2`, `JML_TIDAK_NAIK`, `JML_PRESTASI`, `PAGUREKOM`, `PAGUAWAL`, `PAGULAIN2`) VALUES
	('02', 'SMP Negeri 2 Sidoarjo', '', 256, 311, 0, 0, 13, 0, 266, 0),
	('03', 'SMP Negeri 3 Sidoarjo', '', 272, 277, 4, 0, 11, 0, 282, 0),
	('04', 'SMP Negeri 4 Sidoarjo', '', 269, 285, 0, 0, 3, 0, 279, 0),
	('05', 'SMP Negeri 5 Sidoarjo', '', 244, 251, 2, 0, 1, 0, 254, 0),
	('06', 'SMP Negeri 6 Sidoarjo', '', 249, 250, 13, 0, 2, 0, 259, 0),
	('07', 'SMP Negeri 1 Buduran', '', 316, 286, 12, 0, 2, 0, 326, 0),
	('08', 'SMP Negeri 2 Buduran', '', 248, 249, 11, 0, 3, 0, 258, 0),
	('09', 'SMP Negeri 1 Candi', '', 243, 246, 3, 1, 5, 0, 253, 0),
	('10', 'SMP Negeri 2 Candi', '', 318, 323, 3, 0, 1, 0, 328, 0),
	('11', 'SMP Negeri 3 Candi', '', 211, 211, 0, 1, 4, 0, 221, 0),
	('12', 'SMP Negeri 1 Porong', '', 286, 288, 10, 0, 0, 0, 296, 0),
	('13', 'SMP Negeri 2 Porong', '', 252, 250, 0, 0, 2, 0, 262, 0),
	('14', 'SMP Negeri 3 Porong', '', 216, 216, 6, 0, 0, 0, 226, 0),
	('15', 'SMP Negeri 1 Krembung', '', 244, 250, 18, 0, 2, 0, 254, 0),
	('16', 'SMP Negeri 2 Krembung', '', 287, 288, 12, 0, 0, 0, 297, 0),
	('17', 'SMP Negeri 1 Tulangan', '', 383, 393, 10, 0, 3, 0, 393, 0),
	('18', 'SMP Negeri 1 Tanggulangin', '', 324, 287, 18, 0, 1, 0, 334, 0),
	('19', 'SMP Negeri 2 Tanggulangin', '', 215, 252, 8, 0, 0, 0, 225, 0),
	('20', 'SMP Negeri 1 Jabon', '', 287, 252, 7, 0, 0, 0, 297, 0),
	('21', 'SMP Negeri 2 Jabon', '', 216, 216, 5, 0, 0, 0, 226, 0),
	('22', 'SMP Negeri 1 Krian', '', 358, 323, 1, 0, 1, 0, 368, 0),
	('23', 'SMP Negeri 2 Krian', '', 356, 357, 2, 0, 3, 0, 366, 0),
	('24', 'SMP Negeri 3 Krian', '', 284, 286, 8, 0, 2, 0, 294, 0),
	('25', 'SMP Negeri 1 Balongbendo', '', 286, 288, 20, 0, 0, 0, 296, 0),
	('26', 'SMP Negeri 2 Balongbendo', '', 216, 216, 39, 0, 0, 0, 226, 0),
	('27', 'SMP Negeri 1 Tarik', '', 286, 287, 4, 0, 1, 0, 296, 0),
	('28', 'SMP Negeri 2 Tarik', '', 251, 252, 38, 0, 0, 0, 261, 0),
	('29', 'SMP Negeri 1 Prambon', '', 286, 285, 3, 2, 1, 0, 296, 0),
	('30', 'SMP Negeri 1 Wonoayu', '', 318, 323, 6, 1, 0, 0, 328, 0),
	('31', 'SMP Negeri 2 Wonoayu', '', 276, 288, 25, 0, 0, 0, 286, 0),
	('32', 'SMP Negeri 1 Taman', '', 422, 319, 3, 0, 5, 0, 432, 0),
	('33', 'SMP Negeri 2 Taman', '', 345, 356, 9, 0, 4, 0, 355, 0),
	('34', 'SMP Negeri 3 Taman', '', 252, 251, 9, 0, 1, 0, 262, 0),
	('35', 'SMP Negeri 1 Sukodono', '', 308, 317, 5, 3, 4, 0, 318, 0),
	('36', 'SMP Negeri 2 Sukodono', '', 320, 324, 5, 0, 0, 0, 330, 0),
	('37', 'SMP Negeri 1 Gedangan', '', 282, 283, 2, 2, 3, 0, 292, 0),
	('38', 'SMP Negeri 2 Gedangan', '', 391, 396, 11, 0, 0, 0, 401, 0),
	('39', 'SMP Negeri 1 Waru', '', 357, 319, 9, 0, 5, 0, 367, 0),
	('40', 'SMP Negeri 2 Waru', '', 318, 249, 7, 1, 2, 0, 328, 0),
	('41', 'SMP Negeri 3 Waru', '', 247, 252, 2, 0, 0, 0, 257, 0),
	('42', 'SMP Negeri 4 Waru', '', 240, 246, 2, 0, 6, 0, 250, 0),
	('44', 'SMP Negeri 2 Sedati', '', 280, 282, 11, 0, 6, 0, 290, 0),
	('52', 'SMA Negeri 2 Sidoarjo', '', 310, 325, 9, 2, 33, 0, 320, 0),
	('53', 'SMA Negeri 3 Sidoarjo', '', 242, 267, 0, 0, 21, 0, 252, 0),
	('54', 'SMA Negeri 4 Sidoarjo', '', 283, 242, 2, 6, 40, 0, 293, 0),
	('55', 'SMA Negeri 1 Porong', '', 312, 249, 13, 0, 3, 0, 322, 0),
	('56', 'SMA Negeri 1 Krembung', '', 355, 315, 8, 0, 9, 0, 365, 0),
	('57', 'SMA Negeri 1 Taman', '', 300, 308, 2, 0, 16, 0, 310, 0),
	('58', 'SMA Negeri 1 Waru', '', 342, 341, 15, 5, 14, 0, 352, 0),
	('59', 'SMA Negeri 1 Gedangan', '', 285, 289, 14, 0, 35, 0, 295, 0),
	('60', 'SMA Negeri 1 Wonoayu', '', 289, 201, 6, 1, 14, 0, 299, 0),
	('61', 'SMA Negeri 1 Tarik', '', 251, 246, 0, 3, 3, 0, 261, 0),
	('7101', 'SMK Negeri 1 Sidoarjo', 'TEKNIK GAMBAR BANGUNAN', 67, 72, 0, 0, 0, 0, 77, 0),
	('7102', 'SMK Negeri 1 Sidoarjo', 'TEKNIK AUDIO VIDEO', 36, 36, 0, 0, 0, 0, 46, 0),
	('7103', 'SMK Negeri 1 Sidoarjo', 'TEKNIK KENDARAAN RINGAN', 67, 72, 0, 0, 0, 0, 77, 0),
	('7104', 'SMK Negeri 1 Sidoarjo', 'TEKNIK INSTALASI TENAGA LISTRIK', 71, 72, 0, 0, 0, 0, 81, 0),
	('7105', 'SMK Negeri 1 Sidoarjo', 'TEKNIK PENDINGIN DAN TATA UDARA', 35, 36, 0, 0, 0, 0, 45, 0),
	('7106', 'SMK Negeri 1 Sidoarjo', 'TEKNIK KONSTRUKSI KAYU', 33, 36, 2, 0, 0, 0, 43, 0),
	('7107', 'SMK Negeri 1 Sidoarjo', 'TEKNIK PERMESINAN', 68, 72, 0, 0, 0, 0, 78, 0),
	('7201', 'SMK Negeri 1 Buduran', 'JASA BOGA', 143, 140, 3, 3, 1, 0, 153, 0),
	('7202', 'SMK Negeri 1 Buduran', 'AKOMODASI PERHOTELAN', 72, 69, 5, 1, 2, 0, 82, 0),
	('7203', 'SMK Negeri 1 Buduran', 'BUSANA BUTIK', 143, 141, 2, 2, 1, 0, 153, 0),
	('7204', 'SMK Negeri 1 Buduran', 'TATA KECANTIKAN RAMBUT', 36, 36, 1, 0, 0, 0, 46, 0),
	('7301', 'SMK Negeri 2 Buduran', 'MULTIMEDIA', 97, 108, 0, 0, 0, 0, 107, 0),
	('7302', 'SMK Negeri 2 Buduran', 'REKAYASA PERANGKAT LUNAK', 35, 36, 0, 0, 0, 0, 45, 0),
	('7303', 'SMK Negeri 2 Buduran', 'ADMINISTRASI PERKANTORAN', 72, 71, 0, 0, 1, 0, 82, 0),
	('7304', 'SMK Negeri 2 Buduran', 'AKUNTANSI', 106, 108, 0, 0, 0, 0, 116, 0),
	('7305', 'SMK Negeri 2 Buduran', 'PEMASARAN', 71, 72, 0, 0, 0, 0, 81, 0),
	('7306', 'SMK Negeri 2 Buduran', 'PERBANKAN', 35, 36, 0, 0, 0, 0, 45, 0),
	('7401', 'SMK Negeri 3 Buduran', 'TEKNIK GAMBAR RANCANG BANGUN KAPAL', 72, 72, 0, 0, 0, 0, 82, 0),
	('7402', 'SMK Negeri 3 Buduran', 'TEKNIK INSTALASI PERMESINAN KAPAL', 36, 36, 0, 0, 1, 0, 46, 0),
	('7403', 'SMK Negeri 3 Buduran', 'KELISTRIKAN KAPAL', 34, 36, 0, 0, 0, 0, 44, 0),
	('7404', 'SMK Negeri 3 Buduran', 'TEKNIK PENGELASAN KAPAL', 35, 36, 0, 0, 0, 0, 45, 0),
	('7405', 'SMK Negeri 3 Buduran', 'TEKNIK KOMPUTER DAN JARINGAN', 71, 72, 0, 0, 1, 0, 81, 0),
	('7406', 'SMK Negeri 3 Buduran', 'TEKNIK PENDINGIN DAN TATA UDARA', 36, 36, 0, 0, 0, 0, 46, 0),
	('7407', 'SMK Negeri 3 Buduran', 'TEKNIK KONSTRUKSI KAPAL BAJA', 36, 36, 0, 0, 0, 0, 46, 0),
	('7408', 'SMK Negeri 3 Buduran', 'TEKNIK PERMESINAN', 35, 36, 0, 0, 1, 0, 45, 0),
	('7409', 'SMK Negeri 3 Buduran', 'TEKNIK KENDARAAN RINGAN', 36, 36, 0, 0, 0, 0, 46, 0),
	('7410', 'SMK Negeri 3 Buduran', 'TEKNIK INTERIOR KAPAL', 36, 36, 0, 0, 0, 0, 46, 0),
	('7501', 'SMK Negeri 1 Jabon', 'TEKNIK KENDARAAN RINGAN', 33, 36, 2, 0, 0, 0, 43, 0),
	('7502', 'SMK Negeri 1 Jabon', 'TEKNIK ELEKTRO INDUSTRI', 36, 36, 0, 0, 0, 0, 46, 0),
	('7503', 'SMK Negeri 1 Jabon', 'MULTIMEDIA', 36, 36, 2, 0, 0, 0, 46, 0),
	('7504', 'SMK Negeri 1 Jabon', 'BUSANA BUTIK', 34, 36, 2, 0, 0, 0, 44, 0),
	('7505', 'SMK Negeri 1 Jabon', 'DESAIN & PRODUKSI KRIA TEKSTIL', 31, 36, 13, 0, 0, 0, 41, 0),
	('7506', 'SMK Negeri 1 Jabon', 'DESAIN & PRODUKSI KRIA KULIT', 33, 36, 12, 0, 0, 0, 43, 0);
/*!40000 ALTER TABLE `pagu_sekolah_backup` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;