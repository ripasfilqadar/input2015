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

-- Dumping database structure for viewsda2015
CREATE DATABASE IF NOT EXISTS `viewsda2015` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;
USE `viewsda2015`;


-- Dumping structure for table viewsda2015.status_terima_sma
CREATE TABLE IF NOT EXISTS `status_terima_sma` (
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table viewsda2015.status_terima_sma: ~0 rows (approximately)
/*!40000 ALTER TABLE `status_terima_sma` DISABLE KEYS */;
REPLACE INTO `status_terima_sma` (`status_id`) VALUES
	(1);
/*!40000 ALTER TABLE `status_terima_sma` ENABLE KEYS */;


-- Dumping structure for table viewsda2015.status_terima_smk
CREATE TABLE IF NOT EXISTS `status_terima_smk` (
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table viewsda2015.status_terima_smk: ~0 rows (approximately)
/*!40000 ALTER TABLE `status_terima_smk` DISABLE KEYS */;
REPLACE INTO `status_terima_smk` (`status_id`) VALUES
	(1);
/*!40000 ALTER TABLE `status_terima_smk` ENABLE KEYS */;


-- Dumping structure for table viewsda2015.status_terima_smp
CREATE TABLE IF NOT EXISTS `status_terima_smp` (
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table viewsda2015.status_terima_smp: ~0 rows (approximately)
/*!40000 ALTER TABLE `status_terima_smp` DISABLE KEYS */;
REPLACE INTO `status_terima_smp` (`status_id`) VALUES
	(1);
/*!40000 ALTER TABLE `status_terima_smp` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
