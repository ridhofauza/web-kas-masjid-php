-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.11.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for kas_masjid
-- CREATE DATABASE IF NOT EXISTS `kas_masjid` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `kas_masjid`;

-- Dumping structure for table kas_masjid.masjid
CREATE TABLE IF NOT EXISTS `masjid` (
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `no_rek` int(20) NOT NULL,
  `ketua_takmir` varchar(50) NOT NULL,
  `bendahara` varchar(50) NOT NULL,
  `sekretaris` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kas_masjid.masjid: ~0 rows (approximately)
INSERT INTO `masjid` (`nama`, `alamat`, `email`, `no_telp`, `bank`, `no_rek`, `ketua_takmir`, `bendahara`, `sekretaris`, `logo`) VALUES
	('Samsul Huda', 'Jalan Mardikarya no. 7 Kota Madiun', 'masjidsamsulhuda@gmail.com', '085187965433', 'Syariah Indonesia', 87827563, 'Muhammad Yusuf', 'Yoga Hendrawan', 'Abdullah', 'logo-msh.jpg');

-- Dumping structure for table kas_masjid.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` int(20) NOT NULL AUTO_INCREMENT,
  `foto_profil` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','owner') NOT NULL,
  PRIMARY KEY (`id_pengguna`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kas_masjid.pengguna: ~3 rows (approximately)
INSERT INTO `pengguna` (`id_pengguna`, `foto_profil`, `nama`, `username`, `password`, `role`) VALUES
	(14, 'uploads/Kholis3.jpg', 'Kholis', 'kholis', '$2y$10$m0XwGqZziWavw/sWHVj2jO6Xm5G1/vIxrS4Q34UuYP1gfWSpRT9lS', 'owner'),
	(16, 'uploads/person.png', 'Fulan', 'fulan', '$2y$10$ldjtGOpC3HSztCyQBG5t0.C0so8FY4HNb4pn213.MqAPehZfrtxDS', 'admin'),
	(27, 'uploads/Kholis4.jpg', 'Amru', 'amru', '$2y$10$ACw1yAonKPw2PmYSrLLjbeE9Tao7d0ZfY2Olsmw6YiBs1vegUwqAm', 'admin');

-- Dumping structure for table kas_masjid.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(15) NOT NULL,
  `kategori` enum('Pemasukan','Pengeluaran') NOT NULL,
  `rincian` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table kas_masjid.transaksi: ~12 rows (approximately)
INSERT INTO `transaksi` (`id_transaksi`, `nama`, `tanggal`, `nominal`, `kategori`, `rincian`, `timestamp`) VALUES
	(3, 'Aisyah', '2025-03-24', -2500000, 'Pengeluaran', 'kebutuhan', '2025-03-24 14:38:12'),
	(4, 'Zainab', '2025-03-19', -9000000, 'Pengeluaran', 'shodaqoh', '2025-03-24 14:39:19'),
	(5, 'Amru', '2025-03-15', 4000000, 'Pemasukan', 'Perlengkapan masjid', '2025-03-27 00:24:15'),
	(8, 'Wahyono', '2025-04-01', 5900000, 'Pemasukan', 'Infaq', '2025-03-31 19:27:31'),
	(10, 'Wardi', '2025-04-02', 4000000, 'Pengeluaran', 'Kebutuhan lain-lain', '2025-04-02 03:30:41'),
	(18, 'Purwanto', '2025-04-11', 2500000, 'Pengeluaran', 'Peralatan bersih-bersih', '2025-04-10 22:49:19'),
	(20, 'Fauzan', '2025-04-11', 5000000, 'Pemasukan', 'Lain2', '2025-04-10 22:55:55'),
	(22, 'Jagad', '2025-04-11', 4000000, 'Pemasukan', 'Test', '2025-04-10 23:01:05'),
	(23, 'Jastro', '2025-04-11', 5000000, 'Pemasukan', 'Test', '2025-04-10 23:01:46'),
	(29, 'Sugiman', '2025-04-12', 2000000, 'Pemasukan', 'test', '2025-04-11 23:48:48'),
	(30, 'Amir', '2025-04-12', 2000000, 'Pemasukan', 'test', '2025-04-11 23:49:40'),
	(31, 'Hadi', '2025-04-12', -2000000, 'Pengeluaran', 'Kajian akbar', '2025-04-11 23:54:56');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
