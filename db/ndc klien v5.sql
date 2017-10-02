-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2016 at 08:03 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ndc`
--
CREATE DATABASE IF NOT EXISTS `ndc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ndc`;

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

DROP TABLE IF EXISTS `antrian`;
CREATE TABLE `antrian` (
  `id_antrian` varchar(100) NOT NULL,
  `id_pasien` varchar(100) NOT NULL,
  `nomer_antrian` int(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Antri','On Progress','Selesai_ditangani','Selesai','Batal') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_cabang`
--

DROP TABLE IF EXISTS `clinic_cabang`;
CREATE TABLE `clinic_cabang` (
  `id_cabang` varchar(100) NOT NULL,
  `nama_clinic` varchar(100) NOT NULL,
  `alamat_clinic` varchar(100) NOT NULL,
  `db_name` varchar(255) NOT NULL,
  `db_username` varchar(100) NOT NULL,
  `db_passwd` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `diagnosa`
--

DROP TABLE IF EXISTS `diagnosa`;
CREATE TABLE `diagnosa` (
  `id_diagnosa` varchar(100) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

DROP TABLE IF EXISTS `inventaris`;
CREATE TABLE `inventaris` (
  `id_inventaris` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan` (
  `id_karyawan` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `tempat_lahir` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `id_profesi` varchar(100) NOT NULL,
  `SIP` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `privilege` enum('admin','kasir') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_inventaris`
--

DROP TABLE IF EXISTS `laporan_inventaris`;
CREATE TABLE `laporan_inventaris` (
  `id_laporan_inventaris` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_inventaris` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prevStok` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_keuangan`
--

DROP TABLE IF EXISTS `laporan_keuangan`;
CREATE TABLE `laporan_keuangan` (
  `id_laporan` varchar(100) NOT NULL,
  `id_pemasukan` varchar(100) DEFAULT NULL,
  `id_pengeluaran` varchar(100) DEFAULT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_obat`
--

DROP TABLE IF EXISTS `laporan_obat`;
CREATE TABLE `laporan_obat` (
  `id_laporan_obat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_obat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `prevStok` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `prevHarga` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

DROP TABLE IF EXISTS `obat`;
CREATE TABLE `obat` (
  `id_obat` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_cabang` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

DROP TABLE IF EXISTS `pasien`;
CREATE TABLE `pasien` (
  `id_pasien` varchar(100) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `tgllahir` date NOT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `id_cabang` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

DROP TABLE IF EXISTS `pemasukan`;
CREATE TABLE `pemasukan` (
  `id_pemasukan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(100) NOT NULL,
  `id_rekam_medik` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE `pengeluaran` (
  `id_pengeluaran` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` int(100) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profesi`
--

DROP TABLE IF EXISTS `profesi`;
CREATE TABLE `profesi` (
  `id_profesi` varchar(100) NOT NULL,
  `nama` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medik`
--

DROP TABLE IF EXISTS `rekam_medik`;
CREATE TABLE `rekam_medik` (
  `id_rekam_medik` varchar(100) NOT NULL,
  `id_pasien` varchar(100) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `id_antrian` varchar(100) NOT NULL,
  `id_resep` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `galeri` varchar(40) NOT NULL,
  `biaya` int(255) NOT NULL,
  `jenis_pembayaran` enum('Cash','Kredit','EDC','') DEFAULT NULL,
  `jumlah_pembayaran` int(100) NOT NULL,
  `keterangan_pembayaran` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medik_to_diagnosa`
--

DROP TABLE IF EXISTS `rekam_medik_to_diagnosa`;
CREATE TABLE `rekam_medik_to_diagnosa` (
  `id_rekam_medik_to_diagnosa` varchar(100) NOT NULL,
  `id_rekam_medik` varchar(100) NOT NULL,
  `id_diagnosa` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medik_to_karyawan`
--

DROP TABLE IF EXISTS `rekam_medik_to_karyawan`;
CREATE TABLE `rekam_medik_to_karyawan` (
  `id_rekam_medik_to_karyawan` varchar(100) NOT NULL,
  `id_rekam_medik` varchar(100) NOT NULL,
  `id_karyawan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medik_to_tindakan`
--

DROP TABLE IF EXISTS `rekam_medik_to_tindakan`;
CREATE TABLE `rekam_medik_to_tindakan` (
  `id_rekam_medik_to_tindakan` varchar(100) NOT NULL,
  `id_rekam_medik` varchar(100) NOT NULL,
  `id_tindakan` varchar(100) NOT NULL,
  `biaya` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

DROP TABLE IF EXISTS `resep`;
CREATE TABLE `resep` (
  `id_resep` varchar(100) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `biaya` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resep_to_obat`
--

DROP TABLE IF EXISTS `resep_to_obat`;
CREATE TABLE `resep_to_obat` (
  `id_resep_to_obat` varchar(100) NOT NULL,
  `id_resep` varchar(100) NOT NULL,
  `id_obat` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `aturan_pakai` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `savesql`
--

DROP TABLE IF EXISTS `savesql`;
CREATE TABLE `savesql` (
  `id_sql` int(11) NOT NULL,
  `query` text COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

DROP TABLE IF EXISTS `tindakan`;
CREATE TABLE `tindakan` (
  `id_tindakan` varchar(100) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` varchar(100) NOT NULL,
  `id_karyawan` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `peran` enum('admin','superuser','kasir') NOT NULL,
  `id_cabang` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `clinic_cabang`
--
ALTER TABLE `clinic_cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`id_diagnosa`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_inventaris`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_profesi` (`id_profesi`);

--
-- Indexes for table `laporan_inventaris`
--
ALTER TABLE `laporan_inventaris`
  ADD PRIMARY KEY (`id_laporan_inventaris`);

--
-- Indexes for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `laporan_obat`
--
ALTER TABLE `laporan_obat`
  ADD PRIMARY KEY (`id_laporan_obat`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `profesi`
--
ALTER TABLE `profesi`
  ADD PRIMARY KEY (`id_profesi`);

--
-- Indexes for table `rekam_medik`
--
ALTER TABLE `rekam_medik`
  ADD PRIMARY KEY (`id_rekam_medik`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_resep` (`id_resep`),
  ADD KEY `id_antrian` (`id_antrian`);

--
-- Indexes for table `rekam_medik_to_diagnosa`
--
ALTER TABLE `rekam_medik_to_diagnosa`
  ADD PRIMARY KEY (`id_rekam_medik_to_diagnosa`),
  ADD KEY `id_rekam_medik` (`id_rekam_medik`),
  ADD KEY `id_diagnosa` (`id_diagnosa`),
  ADD KEY `id_rekam_medik_2` (`id_rekam_medik`),
  ADD KEY `id_diagnosa_2` (`id_diagnosa`);

--
-- Indexes for table `rekam_medik_to_karyawan`
--
ALTER TABLE `rekam_medik_to_karyawan`
  ADD PRIMARY KEY (`id_rekam_medik_to_karyawan`),
  ADD KEY `id_rekam_medik` (`id_rekam_medik`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_rekam_medik_2` (`id_rekam_medik`),
  ADD KEY `id_karyawan_2` (`id_karyawan`);

--
-- Indexes for table `rekam_medik_to_tindakan`
--
ALTER TABLE `rekam_medik_to_tindakan`
  ADD PRIMARY KEY (`id_rekam_medik_to_tindakan`),
  ADD KEY `id_rekam_medik` (`id_rekam_medik`),
  ADD KEY `id_tindakan` (`id_tindakan`),
  ADD KEY `id_rekam_medik_2` (`id_rekam_medik`),
  ADD KEY `id_tindakan_2` (`id_tindakan`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_resep` (`id_resep`);

--
-- Indexes for table `resep_to_obat`
--
ALTER TABLE `resep_to_obat`
  ADD PRIMARY KEY (`id_resep_to_obat`),
  ADD KEY `id_resep_to_obat` (`id_resep_to_obat`),
  ADD KEY `id_resep` (`id_resep`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_resep_2` (`id_resep`),
  ADD KEY `id_obat_2` (`id_obat`);

--
-- Indexes for table `savesql`
--
ALTER TABLE `savesql`
  ADD PRIMARY KEY (`id_sql`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id_tindakan`),
  ADD KEY `id_tindakan` (`id_tindakan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `savesql`
--
ALTER TABLE `savesql`
  MODIFY `id_sql` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
