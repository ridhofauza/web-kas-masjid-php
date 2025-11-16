-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2025 at 08:16 PM
-- Server version: 10.6.4-MariaDB-log
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kas_masjid`
--

-- --------------------------------------------------------

--
-- Table structure for table `donasi`
--

CREATE TABLE `donasi` (
  `id_donasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `tanggal_donasi` date NOT NULL,
  `jumlah` decimal(10,0) NOT NULL,
  `metode_pembayaran` enum('transfer_bank','qris','tunai') NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `status_verifikasi` enum('pending','verifikasi','rejected') NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donasi`
--

INSERT INTO `donasi` (`id_donasi`, `id_user`, `id_kegiatan`, `tanggal_donasi`, `jumlah`, `metode_pembayaran`, `bukti_transfer`, `status_verifikasi`, `keterangan`) VALUES
(14, 2, 4, '2025-11-16', '350000', 'transfer_bank', 'uploads/bukti_transfer/20251116200854_androidparty.png', 'verifikasi', 'donasi untuk pengajian'),
(15, 7, 5, '2025-11-17', '120000', 'qris', 'uploads/bukti_transfer/20251116201042_androidparty.png', 'verifikasi', 'donasi untuk banjari'),
(16, 2, NULL, '2025-11-18', '50000', 'tunai', 'uploads/bukti_transfer/20251116201126_islamic_mosque.png', 'pending', 'donasi kegiatan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_keuangan`
--

CREATE TABLE `kategori_keuangan` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_keuangan`
--

INSERT INTO `kategori_keuangan` (`id_kategori`, `nama_kategori`, `deskripsi`) VALUES
(5, 'Pentas Banjari', 'Kebutuhan Pentas Banjari'),
(6, 'Pengajian Rutin', 'Kebutuhan Pengajian Rutin');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_masjid`
--

CREATE TABLE `kegiatan_masjid` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `dibuat_oleh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_masjid`
--

INSERT INTO `kegiatan_masjid` (`id_kegiatan`, `nama_kegiatan`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `lokasi`, `dibuat_oleh`) VALUES
(4, 'Pengajian Rutin Bulanan', 'Mengadakan kegiatan pengajian rutin bulanan', '2025-11-10', '2025-11-30', 'Masjid', 1),
(5, 'Festival Banjari', 'Mengikuti festival banjari', '2025-11-16', '2025-11-23', 'Aula Masjid', 1);

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE `keuangan` (
  `id_keuangan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('pemasukan','pengeluaran') NOT NULL,
  `jumlah` decimal(10,0) NOT NULL,
  `sumber` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `id_donasi` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id_keuangan`, `tanggal`, `jenis`, `jumlah`, `sumber`, `keterangan`, `id_donasi`, `id_kategori`) VALUES
(9, '2025-11-16', 'pengeluaran', '20000', 'Donasi', 'beli konsumsi', 14, 6),
(10, '2025-11-16', 'pengeluaran', '150000', 'donasi', 'Biaya penceramah', 14, 6),
(11, '2025-11-17', 'pengeluaran', '75000', 'Donasi Banjari', 'konsumsi peserta banjari', 15, 5),
(12, '2025-11-16', 'pemasukan', '20000', 'sumbangan', 'sumbangan dari jamaah', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `total_pemasukan` decimal(10,0) NOT NULL,
  `total_pengeluaran` decimal(10,0) NOT NULL,
  `saldo_akhir` decimal(10,0) NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `tanggal_dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `file_pdf` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `periode`, `total_pemasukan`, `total_pengeluaran`, `saldo_akhir`, `dibuat_oleh`, `tanggal_dibuat`, `file_pdf`) VALUES
(9, 'November 2025', '490000', '245000', '245000', 1, '2025-11-16 20:14:49', 'uploads/laporan_pdf/laporan_November_2025_20251116201449.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `masjid`
--

CREATE TABLE `masjid` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masjid`
--

INSERT INTO `masjid` (`nama`, `alamat`, `email`, `no_telp`, `bank`, `no_rek`, `ketua_takmir`, `bendahara`, `sekretaris`, `logo`) VALUES
('Samsul Huda', 'Jalan Mardikarya no. 7 Kota Madiun', 'masjidsamsulhuda@gmail.com', '085187965433', 'Syariah Indonesia', 87827563, 'Muhammad Yusuf', 'Yoga Hendrawan', 'Abdullah', 'logo-msh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `role` enum('admin','jamaah') NOT NULL,
  `foto_profil` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `no_hp`, `role`, `foto_profil`) VALUES
(1, 'useradmin', 'admin@admin.com', '$2a$12$Co9c4bOTOZsCaWbOGPh8F./2sy/675lIdxHrU/2YCzjxuWLK.bKCi', '0821987676', 'admin', 'uploads/Kholis4.jpg'),
(2, 'Human Satu', 'humansatu@jamaah.com', '$2a$12$BIHGwWc8CjlLehM4C9VKAOu6iJfx76Zd/NUuwdlydJ/.jzY0tXAZi', '082198987000', 'jamaah', 'uploads/default-avatar.png'),
(7, 'Jamaah Ketiga', 'jamaah3@jamaah.com', '$2y$10$s5GesTAPbFLTbdHBf.y2PueLFKxi5xf07o1FJHAgHzGzJez1EvBIu', '082198765', 'jamaah', 'uploads/20251116195756_naruto.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id_donasi`),
  ADD KEY `fk_donasi_id_user` (`id_user`),
  ADD KEY `fk_donasi_id_kegiatan` (`id_kegiatan`);

--
-- Indexes for table `kategori_keuangan`
--
ALTER TABLE `kategori_keuangan`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kegiatan_masjid`
--
ALTER TABLE `kegiatan_masjid`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `fk_kegiatan_masjid_users` (`dibuat_oleh`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id_keuangan`),
  ADD KEY `fk_keuangan_donasi` (`id_donasi`),
  ADD KEY `fk_keuangan_kategori` (`id_kategori`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `fk_laporan_user` (`dibuat_oleh`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id_donasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategori_keuangan`
--
ALTER TABLE `kategori_keuangan`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kegiatan_masjid`
--
ALTER TABLE `kegiatan_masjid`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donasi`
--
ALTER TABLE `donasi`
  ADD CONSTRAINT `fk_donasi_id_kegiatan` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan_masjid` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_donasi_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kegiatan_masjid`
--
ALTER TABLE `kegiatan_masjid`
  ADD CONSTRAINT `fk_kegiatan_masjid_users` FOREIGN KEY (`dibuat_oleh`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD CONSTRAINT `fk_keuangan_donasi` FOREIGN KEY (`id_donasi`) REFERENCES `donasi` (`id_donasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_keuangan_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_keuangan` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `fk_laporan_user` FOREIGN KEY (`dibuat_oleh`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
