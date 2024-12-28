-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 27, 2024 at 02:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ourecycle`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int NOT NULL,
  `jenis_sampah` varchar(50) DEFAULT NULL,
  `subjenis_sampah` text,
  `berat_sampah` decimal(5,2) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `alamat` text,
  `patokan_rumah` varchar(100) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `tanggal_pengambilan` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `pesan` text,
  `status` varchar(50) DEFAULT 'Menunggu Konfirmasi',
  `foto_sampah` longblob,
  `foto_type` varchar(50) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id`, `jenis_sampah`, `subjenis_sampah`, `berat_sampah`, `nomor_telepon`, `alamat`, `patokan_rumah`, `latitude`, `longitude`, `tanggal_pengambilan`, `jam_mulai`, `jam_akhir`, `pesan`, `status`, `foto_sampah`, `foto_type`, `nama`) VALUES
(25, 'organik', 'plastik', 77.00, '08122931313', 'Jalan Monginsidi, Kestalan, Surakarta, Central Java, Java, 57137, Indonesia', 'Gang Senggol', -7.55820000, 110.82610000, '2024-12-26', '16:22:00', '16:22:00', 'l', 'Selesai', 0x75706c6f6164732f53637265656e73686f7420323032342d31312d3330203131303435352e706e67, NULL, 'Satriyo'),
(27, 'organik', 'logam', 11.00, '11', 'Jalan Monginsidi, Kestalan, Surakarta, Central Java, Java, 57137, Indonesia', '111', -7.55820000, 110.82610000, '2024-12-26', '17:03:00', '17:03:00', 'll', 'Menunggu Konfirmasi', 0x75706c6f6164732f6f6365616e2073757266696e67202831292e706e67, NULL, 'Budiono'),
(28, 'organik', 'plastik', 12.00, '11', 'Jalan Monginsidi, Kestalan, Surakarta, Central Java, Java, 57137, Indonesia', 'Gerbang Belakang', -7.55820000, 110.82610000, '2024-12-26', '17:24:00', '17:25:00', '123', 'Menunggu Konfirmasi', 0x75706c6f6164732f53637265656e73686f7420323032342d31322d3031203231333733302e706e67, NULL, 'Kunyit'),
(29, 'organik', 'plastik', 12.00, '081326691584', 'Monterico, Inopacan, 5th District, Leyte, Eastern Visayas, 6522, Philippines', 'Gerbang Belakang', 10.57422208, 124.91015623, '2024-12-27', '19:59:00', '20:59:00', 'Ceptan woy atmin', 'Diproses', 0x75706c6f6164732f53637265656e73686f7420323032342d31322d3031203231333733302e706e67, NULL, 'Devanus');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('karyawan','pengguna') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(4, 'qwe', '$2y$10$Ec2O/FaonCUBaKZQb.6fyO6zMZ.IS6aYDBdqAcCQio9BjqDOztZ1i', 'pengguna'),
(7, 'emp_alif', '$2y$10$sVZavYE.mMt5AWBsbAKnp..i8kPzbrIVi9VfmYIfj.jpMP8/.d8Xi', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
