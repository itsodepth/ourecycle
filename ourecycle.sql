-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Des 2024 pada 10.16
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

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
-- Struktur dari tabel `tb_jenis_sampah`
--

CREATE TABLE `tb_jenis_sampah` (
  `id_jenis` int(11) NOT NULL,
  `jenis_sampah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_jenis_sampah`
--

INSERT INTO `tb_jenis_sampah` (`id_jenis`, `jenis_sampah`) VALUES
(1, 'Kertas'),
(2, 'Plastik'),
(3, 'Elektronik'),
(4, 'Botol Kaca'),
(5, 'Besi & Logam'),
(6, 'Organik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `jenis_sampah` varchar(50) DEFAULT NULL,
  `subjenis_sampah` text DEFAULT NULL,
  `berat_sampah` decimal(5,2) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `foto_sampah` longblob DEFAULT NULL,
  `foto_type` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `patokan_rumah` varchar(100) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `tanggal_pengambilan` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Menunggu Konfirmasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_order`
--

INSERT INTO `tb_order` (`id`, `id_user`, `nama`, `jenis_sampah`, `subjenis_sampah`, `berat_sampah`, `nomor_telepon`, `foto_sampah`, `foto_type`, `alamat`, `patokan_rumah`, `latitude`, `longitude`, `tanggal_pengambilan`, `jam_mulai`, `jam_akhir`, `pesan`, `status`) VALUES
(32, 0, 'Moona', 'organik', 'plastik, kertas', 3.00, '0896757676454', 0x2e2e2f75706c6f6164732f496e7374616772616d20706f7374202d20372e706e672c202e2e2f75706c6f6164732f4d6f6d656e20416e696d652e706e67, NULL, 'Jalan Monginsidi, Kestalan, Surakarta, Central Java, Java, 57137, Indonesia', 'kok bisa deket situ', -7.55820000, 110.82610000, '2024-12-29', '05:05:00', '06:05:00', 'cepetan', 'Menunggu Konfirmasi'),
(33, 0, 'Moona', 'organik', 'plastik, kertas', 3.00, '0896757676454', 0x2e2e2f75706c6f6164732f496e7374616772616d20706f7374202d20372e706e672c202e2e2f75706c6f6164732f4d6f6d656e20416e696d652e706e67, NULL, 'Jalan Monginsidi, Kestalan, Surakarta, Central Java, Java, 57137, Indonesia', 'kok bisa deket situ', -7.55820000, 110.82610000, '2024-12-29', '05:05:00', '06:05:00', 'cepetan', 'Menunggu Konfirmasi'),
(34, 0, 'Luffy', 'anorganik', 'plastik, logam', 6.00, '089675677821', 0x2e2e2f75706c6f6164732f31366269742d73656e736174696f6e2d776174617368692d746f2d6d696e6e612d67612d7473756b757474612d626973686f756a6f2d67616d652d312e706e672c202e2e2f75706c6f6164732f35346462346331322d323133332d343266392d383030392d6132306133626232316662332e6a7067, NULL, 'Krajan, Bancak, Semarang, Jawa Tengah, Jawa, Indonesia', 'rumah warna merah darah', -7.24479001, 110.59867859, '2024-12-08', '05:27:00', '05:28:00', 'anime', 'Menunggu Konfirmasi'),
(35, 0, 'Airani Iofifteen', 'plastik', 'Botol Plastik, Sedotan Plastik, Plastik Wrap', 9.00, '089675677821', 0x2e2e2f75706c6f6164732f616b7579616b75207265696a6f752e6a7065672c202e2e2f75706c6f6164732f616e6b6f6b756865697368695f50522e6a706567, NULL, '手代森トンネル, 門, Morioka, Iwate Prefecture, 020-0831, Jepang', 'Rumah deket toko sembako Iwata-san', 39.66597088, 141.19628906, '2024-12-25', '09:56:00', '10:56:00', 'cepetan ya banh', 'Menunggu Konfirmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order_dropoff`
--

CREATE TABLE `tb_order_dropoff` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_subjenis` int(11) NOT NULL,
  `berat_sampah` decimal(5,2) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `foto_sampah` longblob DEFAULT NULL,
  `foto_type` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `cabang` varchar(100) DEFAULT NULL,
  `tanggal_pengambilan` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Menunggu Konfirmasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_order_pickup`
--

CREATE TABLE `tb_order_pickup` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_subjenis` int(11) NOT NULL,
  `berat_sampah` decimal(5,2) DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `foto_sampah` longblob DEFAULT NULL,
  `foto_type` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `patokan_rumah` varchar(100) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `tanggal_pengambilan` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Menunggu Konfirmasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_order_pickup`
--

INSERT INTO `tb_order_pickup` (`id`, `id_user`, `nama`, `id_jenis`, `id_subjenis`, `berat_sampah`, `nomor_telepon`, `foto_sampah`, `foto_type`, `alamat`, `patokan_rumah`, `latitude`, `longitude`, `tanggal_pengambilan`, `jam_mulai`, `jam_akhir`, `pesan`, `status`) VALUES
(1, 12, 'Jimbe', 3, 18, 2.00, '089675677821', 0x2e2e2f75706c6f6164732f363737313064356235356165372e6a7067, 'jpg', 'Jalan Monginsidi, Kestalan, Surakarta, Jawa Tengah, Jawa, 57137, Indonesia', 'Rumah deket toko sembako Iwata-san', -7.55820000, 110.82610000, '2024-12-19', '15:50:00', '15:50:00', 'anime', 'Menunggu Konfirmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_subjenis_sampah`
--

CREATE TABLE `tb_subjenis_sampah` (
  `id_subjenis` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `subjenis_sampah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_subjenis_sampah`
--

INSERT INTO `tb_subjenis_sampah` (`id_subjenis`, `id_jenis`, `subjenis_sampah`) VALUES
(1, 1, 'Kertas Koran'),
(2, 1, 'Kertas Karton'),
(3, 1, 'Kertas Buku'),
(4, 1, 'Kertas Pembungkus'),
(5, 1, 'Kertas Nota'),
(6, 1, 'Kertas Fotokopi'),
(7, 2, 'Kardus Plastik'),
(8, 2, 'Botol Plastik'),
(9, 2, 'Kantong Plastik'),
(10, 2, 'Kemasan Plastik'),
(11, 2, 'Sedotan Plastik'),
(12, 2, 'Plastik Wrap'),
(13, 2, 'Gelas Plastik'),
(14, 3, 'Telepon'),
(15, 3, 'Kulkas'),
(16, 3, 'Komputer'),
(17, 3, 'Ponsel'),
(18, 3, 'Laptop'),
(19, 3, 'Printer'),
(20, 3, 'Baterai'),
(21, 3, 'Mesin Cuci'),
(22, 4, 'Botol Kecap'),
(23, 4, 'Botol Saos'),
(24, 4, 'Botol Sirup DHT'),
(25, 4, 'Botol Miras'),
(26, 4, 'Botol Soda'),
(27, 5, 'Aki'),
(28, 5, 'Timah'),
(29, 5, 'Besi Tipis'),
(30, 5, 'Besi Tebal'),
(31, 5, 'Kuningan'),
(32, 5, 'Tembaga Biasa'),
(33, 5, 'Tembaga Super'),
(34, 5, 'Kepala Aki'),
(35, 6, 'Minyak Jelantah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Karyawan','Pengguna') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(12, 'forza', '$2y$10$15D6x4SukFzHqwYry6Uhjea6o1KSCAKHHHmfbknCzdpPyurmhk0pW', 'Pengguna');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jenis_sampah`
--
ALTER TABLE `tb_jenis_sampah`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Indeks untuk tabel `tb_order_dropoff`
--
ALTER TABLE `tb_order_dropoff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_subjenis` (`id_subjenis`);

--
-- Indeks untuk tabel `tb_order_pickup`
--
ALTER TABLE `tb_order_pickup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_subjenis` (`id_subjenis`);

--
-- Indeks untuk tabel `tb_subjenis_sampah`
--
ALTER TABLE `tb_subjenis_sampah`
  ADD PRIMARY KEY (`id_subjenis`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_sampah`
--
ALTER TABLE `tb_jenis_sampah`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `tb_order_dropoff`
--
ALTER TABLE `tb_order_dropoff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_order_pickup`
--
ALTER TABLE `tb_order_pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_subjenis_sampah`
--
ALTER TABLE `tb_subjenis_sampah`
  MODIFY `id_subjenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_order_dropoff`
--
ALTER TABLE `tb_order_dropoff`
  ADD CONSTRAINT `tb_order_dropoff_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_order_dropoff_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis_sampah` (`id_jenis`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_order_dropoff_ibfk_3` FOREIGN KEY (`id_subjenis`) REFERENCES `tb_subjenis_sampah` (`id_subjenis`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_order_pickup`
--
ALTER TABLE `tb_order_pickup`
  ADD CONSTRAINT `tb_order_pickup_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_order_pickup_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis_sampah` (`id_jenis`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_order_pickup_ibfk_3` FOREIGN KEY (`id_subjenis`) REFERENCES `tb_subjenis_sampah` (`id_subjenis`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_subjenis_sampah`
--
ALTER TABLE `tb_subjenis_sampah`
  ADD CONSTRAINT `tb_subjenis_sampah_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis_sampah` (`id_jenis`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
