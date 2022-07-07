-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 Mei 2021 pada 13.47
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgisdishub`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_lampu`
--

CREATE TABLE `daftar_lampu` (
  `id_lampu` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `latitude` float(9,6) NOT NULL,
  `longitude` float(9,6) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_lampu`
--

INSERT INTO `daftar_lampu` (`id_lampu`, `id_status`, `latitude`, `longitude`, `alamat`) VALUES
(2, 1, 5.552613, 95.317429, 'Sp. A. Ujung Rimba Masjid Raya Baiturrahman'),
(3, 1, 5.532389, 95.330254, 'Sp. AMD Desa Batoh'),
(4, 1, 5.552979, 95.344711, 'Sp. BPKP Desa Lambhuk'),
(5, 1, 5.561789, 95.323875, 'Sp. DKK Desa Kuta Alam'),
(6, 1, 5.528987, 95.295189, 'Sp. Dodik Desa Lamteumen Barat'),
(7, 1, 5.547961, 95.316994, 'Sp. Jam Tugu BNI Desa Baru'),
(8, 1, 5.558741, 95.330170, 'Sp. Jambo Tape'),
(9, 1, 5.520874, 95.302521, 'Sp. Keutapang'),
(10, 1, 5.551069, 95.324387, 'Sp. Gedung Keuangan Peuniti'),
(11, 1, 5.551402, 95.320328, 'Sp. Kodim'),
(12, 1, 5.525861, 95.320114, 'Sp. Lhong Raya'),
(13, 1, 5.556002, 95.321793, 'Sp. Lima'),
(14, 1, 5.562865, 95.329842, 'Sp. MAN Model'),
(15, 1, 5.561562, 95.321030, 'Sp. Methodist'),
(16, 1, 5.520404, 95.304123, 'Sp. Mibo'),
(17, 1, 5.537174, 95.315102, 'Sp. Neusu'),
(18, 1, 5.567298, 95.339142, 'Sp. PDAM Masjid Oman'),
(19, 1, 5.545936, 95.319550, 'Sp. Pendopo Peuniti'),
(20, 1, 5.534412, 95.304192, 'Sp. PU Suzuya Mall'),
(21, 1, 5.541639, 95.311264, 'Sp. Seulawah'),
(22, 1, 5.545993, 95.323654, 'Sp. TM Pahlawan'),
(23, 1, 5.571755, 95.367683, 'Sp. UNSYIAH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_laporan`
--

CREATE TABLE `daftar_laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_lampu` int(11) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT '1',
  `nama` varchar(50) NOT NULL,
  `keterangan` varchar(300) NOT NULL,
  `lat` float(11,9) NOT NULL,
  `lng` float(11,9) NOT NULL,
  `tanggal` datetime NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `kevalidan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_laporan`
--

INSERT INTO `daftar_laporan` (`id_laporan`, `id_lampu`, `id_status`, `nama`, `keterangan`, `lat`, `lng`, `tanggal`, `gambar`, `kevalidan`) VALUES
(20, 18, 1, 'koko', 'dwad', 5.574645996, 95.347763062, '2021-05-29 18:32:02', '39290521063207.jpg', 'Tidak Valid'),
(22, 18, 1, 'dwad', 'dwad', 5.574645996, 95.347763062, '2021-05-29 18:32:09', '39290521063216.jpeg', 'Tidak Valid'),
(25, 17, 1, 'intan', 'dwa', 5.574645996, 95.347763062, '2021-05-29 18:39:20', '81290521063930.jpg', 'Tidak Valid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` enum('Admin','Petugas') NOT NULL DEFAULT 'Petugas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_user`, `nama_user`, `password`, `level`) VALUES
(1, 'Admin', '$2y$10$oNX.X8jgLhNclHBeI8ytT.1vODlml8.AN1Ieb.rSIChhCa1e7cS0S', 'Admin'),
(2, 'Petugas', '$2y$10$oNX.X8jgLhNclHBeI8ytT.1vODlml8.AN1Ieb.rSIChhCa1e7cS0S', 'Petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proses_perbaikan`
--

CREATE TABLE `proses_perbaikan` (
  `id_perbaikan` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `petugas_perbaikan` varchar(80) NOT NULL,
  `keterangan_perbaikan` varchar(250) NOT NULL,
  `tanggal_perbaikan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_perbaikan`
--

CREATE TABLE `riwayat_perbaikan` (
  `id_riwayat` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `petugas_selesai` varchar(50) NOT NULL,
  `keterangan_selesai` varchar(250) NOT NULL,
  `foto_setelah_perbaikan` varchar(100) NOT NULL,
  `tanggal_selesai` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_lampu`
--

CREATE TABLE `status_lampu` (
  `id_status` int(11) NOT NULL,
  `kode_status` varchar(25) NOT NULL,
  `nama_status` varchar(40) NOT NULL,
  `marker` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_lampu`
--

INSERT INTO `status_lampu` (`id_status`, `kode_status`, `nama_status`, `marker`) VALUES
(1, '01', 'Normal', '17020521121940.png'),
(2, '02', 'Sedang diperbaiki', '36290521103525.png'),
(6, '03', 'Rusak', '19010521095253.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi_laporan`
--

CREATE TABLE `verifikasi_laporan` (
  `id_verifikasi` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `petugas_verifikasi` varchar(50) NOT NULL,
  `keterangan_verifikasi` varchar(300) NOT NULL,
  `foto_sebelum_perbaikan` varchar(80) NOT NULL,
  `tanggal_verifikasi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `verifikasi_laporan`
--

INSERT INTO `verifikasi_laporan` (`id_verifikasi`, `id_laporan`, `petugas_verifikasi`, `keterangan_verifikasi`, `foto_sebelum_perbaikan`, `tanggal_verifikasi`) VALUES
(15, 20, 'alvandi', 'daw', '2290521063308.jpg', '2021-05-29 18:33:04'),
(17, 22, 'dwad', 'adwad', '37290521063323.jpg', '2021-05-29 18:33:19'),
(20, 25, 'alvin', 'wda', '64290521063944.jpg', '2021-05-29 18:39:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_lampu`
--
ALTER TABLE `daftar_lampu`
  ADD PRIMARY KEY (`id_lampu`),
  ADD KEY `fkstatuslampu` (`id_status`);

--
-- Indexes for table `daftar_laporan`
--
ALTER TABLE `daftar_laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `fklaporanlampu` (`id_lampu`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `proses_perbaikan`
--
ALTER TABLE `proses_perbaikan`
  ADD PRIMARY KEY (`id_perbaikan`),
  ADD KEY `fk_laporan_perbaikan_verifikasi` (`id_laporan`);

--
-- Indexes for table `riwayat_perbaikan`
--
ALTER TABLE `riwayat_perbaikan`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `fk_laporan_riwayat_perbaiki` (`id_laporan`);

--
-- Indexes for table `status_lampu`
--
ALTER TABLE `status_lampu`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `verifikasi_laporan`
--
ALTER TABLE `verifikasi_laporan`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD KEY `fk_verifikasi_laporan` (`id_laporan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_lampu`
--
ALTER TABLE `daftar_lampu`
  MODIFY `id_lampu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `daftar_laporan`
--
ALTER TABLE `daftar_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proses_perbaikan`
--
ALTER TABLE `proses_perbaikan`
  MODIFY `id_perbaikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `riwayat_perbaikan`
--
ALTER TABLE `riwayat_perbaikan`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `status_lampu`
--
ALTER TABLE `status_lampu`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `verifikasi_laporan`
--
ALTER TABLE `verifikasi_laporan`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_lampu`
--
ALTER TABLE `daftar_lampu`
  ADD CONSTRAINT `fkstatuslampu` FOREIGN KEY (`id_status`) REFERENCES `status_lampu` (`id_status`);

--
-- Ketidakleluasaan untuk tabel `daftar_laporan`
--
ALTER TABLE `daftar_laporan`
  ADD CONSTRAINT `fklaporanlampu` FOREIGN KEY (`id_lampu`) REFERENCES `daftar_lampu` (`id_lampu`);

--
-- Ketidakleluasaan untuk tabel `proses_perbaikan`
--
ALTER TABLE `proses_perbaikan`
  ADD CONSTRAINT `fk_laporan_perbaikan_verifikasi` FOREIGN KEY (`id_laporan`) REFERENCES `daftar_laporan` (`id_laporan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_perbaikan`
--
ALTER TABLE `riwayat_perbaikan`
  ADD CONSTRAINT `fk_laporan_riwayat_perbaiki` FOREIGN KEY (`id_laporan`) REFERENCES `daftar_laporan` (`id_laporan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `verifikasi_laporan`
--
ALTER TABLE `verifikasi_laporan`
  ADD CONSTRAINT `fk_verifikasi_laporan` FOREIGN KEY (`id_laporan`) REFERENCES `daftar_laporan` (`id_laporan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
