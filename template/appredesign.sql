-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2020 at 08:20 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appredesign`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_desainer`
--

CREATE TABLE `tb_desainer` (
  `IDDesigner` varchar(5) NOT NULL,
  `IDUser` varchar(5) DEFAULT NULL,
  `No_telp` varchar(11) DEFAULT NULL,
  `Keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_diskusiproduksi`
--

CREATE TABLE `tb_diskusiproduksi` (
  `IDDispro` varchar(5) NOT NULL,
  `IDDesigner` varchar(5) DEFAULT NULL,
  `IDPesan` varchar(5) DEFAULT NULL,
  `IDPengelola` varchar(5) DEFAULT NULL,
  `Komentar` varchar(200) DEFAULT NULL,
  `Tanggal_waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_diskusiumkm`
--

CREATE TABLE `tb_diskusiumkm` (
  `IDDiskum` varchar(5) NOT NULL,
  `IDUMKM` varchar(5) DEFAULT NULL,
  `IDPengelola` varchar(5) DEFAULT NULL,
  `IDPesan` varchar(5) DEFAULT NULL,
  `Komentar` varchar(200) DEFAULT NULL,
  `Tanggal_waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `IDPesan` varchar(5) NOT NULL,
  `IDUMKM` varchar(5) DEFAULT NULL,
  `IDPengelola` varchar(5) DEFAULT NULL,
  `IDDesigner` varchar(5) DEFAULT NULL,
  `Status` enum('0','1','2','3','4','5') DEFAULT NULL,
  `Harga` int(11) DEFAULT NULL,
  `Tgl_mulai` date DEFAULT NULL,
  `Tgl_akhir` date DEFAULT NULL,
  `Keterangan_design` varchar(200) DEFAULT NULL,
  `Revisi_design` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengelola`
--

CREATE TABLE `tb_pengelola` (
  `IDPengelola` varchar(5) NOT NULL,
  `IDUser` varchar(5) DEFAULT NULL,
  `No_telp` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_portofolio`
--

CREATE TABLE `tb_portofolio` (
  `IDPortofolio` varchar(5) NOT NULL,
  `IDDesigner` varchar(5) DEFAULT NULL,
  `Judul` varchar(30) DEFAULT NULL,
  `Bukti_portofolio` varchar(150) DEFAULT NULL,
  `Detail_portofolio` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_telkom`
--

CREATE TABLE `tb_telkom` (
  `IDTelkom` varchar(5) NOT NULL,
  `IDUser` varchar(5) DEFAULT NULL,
  `No_telp` varchar(11) DEFAULT NULL,
  `Regional` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_umkm`
--

CREATE TABLE `tb_umkm` (
  `IDUMKM` varchar(5) NOT NULL,
  `IDUser` varchar(5) DEFAULT NULL,
  `Nama_umkm` varchar(30) DEFAULT NULL,
  `Regional` varchar(50) DEFAULT NULL,
  `Alamat` varchar(200) DEFAULT NULL,
  `No_telp` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_umkm_data`
--

CREATE TABLE `tb_umkm_data` (
  `IDDataUMKM` varchar(5) NOT NULL,
  `IDUMKM` varchar(5) DEFAULT NULL,
  `Nama_produk` varchar(30) DEFAULT NULL,
  `Foto_produk` varchar(150) DEFAULT NULL,
  `Keterangan` varchar(200) DEFAULT NULL,
  `Logo_produk` varchar(150) DEFAULT NULL,
  `Kemasan_produk` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `IDUser` varchar(5) NOT NULL,
  `Username` varchar(30) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Nama_lengkap` varchar(30) DEFAULT NULL,
  `Foto` varchar(150) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Level` enum('Pengelola','UMKM','CDC','Designer') DEFAULT NULL,
  `Status` enum('Aktif','Tidak Aktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_desainer`
--
ALTER TABLE `tb_desainer`
  ADD PRIMARY KEY (`IDDesigner`),
  ADD KEY `IDUser` (`IDUser`);

--
-- Indexes for table `tb_diskusiproduksi`
--
ALTER TABLE `tb_diskusiproduksi`
  ADD PRIMARY KEY (`IDDispro`),
  ADD KEY `IDDesigner` (`IDDesigner`),
  ADD KEY `IDPesan` (`IDPesan`),
  ADD KEY `IDPengelola` (`IDPengelola`);

--
-- Indexes for table `tb_diskusiumkm`
--
ALTER TABLE `tb_diskusiumkm`
  ADD PRIMARY KEY (`IDDiskum`),
  ADD KEY `IDUMKM` (`IDUMKM`),
  ADD KEY `IDPengelola` (`IDPengelola`),
  ADD KEY `IDPesan` (`IDPesan`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`IDPesan`),
  ADD KEY `IDUMKM` (`IDUMKM`),
  ADD KEY `IDPengelola` (`IDPengelola`),
  ADD KEY `IDDesigner` (`IDDesigner`);

--
-- Indexes for table `tb_pengelola`
--
ALTER TABLE `tb_pengelola`
  ADD PRIMARY KEY (`IDPengelola`),
  ADD KEY `IDUser` (`IDUser`);

--
-- Indexes for table `tb_portofolio`
--
ALTER TABLE `tb_portofolio`
  ADD PRIMARY KEY (`IDPortofolio`),
  ADD KEY `IDDesigner` (`IDDesigner`);

--
-- Indexes for table `tb_telkom`
--
ALTER TABLE `tb_telkom`
  ADD PRIMARY KEY (`IDTelkom`),
  ADD KEY `IDUser` (`IDUser`);

--
-- Indexes for table `tb_umkm`
--
ALTER TABLE `tb_umkm`
  ADD PRIMARY KEY (`IDUMKM`),
  ADD KEY `IDUser` (`IDUser`);

--
-- Indexes for table `tb_umkm_data`
--
ALTER TABLE `tb_umkm_data`
  ADD PRIMARY KEY (`IDDataUMKM`),
  ADD KEY `IDUMKM` (`IDUMKM`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`IDUser`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_desainer`
--
ALTER TABLE `tb_desainer`
  ADD CONSTRAINT `tb_desainer_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `tb_user` (`IDUser`);

--
-- Constraints for table `tb_diskusiproduksi`
--
ALTER TABLE `tb_diskusiproduksi`
  ADD CONSTRAINT `tb_diskusiproduksi_ibfk_1` FOREIGN KEY (`IDDesigner`) REFERENCES `tb_desainer` (`IDDesigner`),
  ADD CONSTRAINT `tb_diskusiproduksi_ibfk_2` FOREIGN KEY (`IDPesan`) REFERENCES `tb_pemesanan` (`IDPesan`),
  ADD CONSTRAINT `tb_diskusiproduksi_ibfk_3` FOREIGN KEY (`IDPengelola`) REFERENCES `tb_pengelola` (`IDPengelola`);

--
-- Constraints for table `tb_diskusiumkm`
--
ALTER TABLE `tb_diskusiumkm`
  ADD CONSTRAINT `tb_diskusiumkm_ibfk_1` FOREIGN KEY (`IDUMKM`) REFERENCES `tb_umkm` (`IDUMKM`),
  ADD CONSTRAINT `tb_diskusiumkm_ibfk_2` FOREIGN KEY (`IDPengelola`) REFERENCES `tb_pengelola` (`IDPengelola`),
  ADD CONSTRAINT `tb_diskusiumkm_ibfk_3` FOREIGN KEY (`IDPesan`) REFERENCES `tb_pemesanan` (`IDPesan`);

--
-- Constraints for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD CONSTRAINT `tb_pemesanan_ibfk_1` FOREIGN KEY (`IDUMKM`) REFERENCES `tb_umkm` (`IDUMKM`),
  ADD CONSTRAINT `tb_pemesanan_ibfk_2` FOREIGN KEY (`IDPengelola`) REFERENCES `tb_pengelola` (`IDPengelola`),
  ADD CONSTRAINT `tb_pemesanan_ibfk_3` FOREIGN KEY (`IDDesigner`) REFERENCES `tb_desainer` (`IDDesigner`);

--
-- Constraints for table `tb_pengelola`
--
ALTER TABLE `tb_pengelola`
  ADD CONSTRAINT `tb_pengelola_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `tb_user` (`IDUser`);

--
-- Constraints for table `tb_portofolio`
--
ALTER TABLE `tb_portofolio`
  ADD CONSTRAINT `tb_portofolio_ibfk_1` FOREIGN KEY (`IDDesigner`) REFERENCES `tb_desainer` (`IDDesigner`);

--
-- Constraints for table `tb_telkom`
--
ALTER TABLE `tb_telkom`
  ADD CONSTRAINT `tb_telkom_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `tb_user` (`IDUser`);

--
-- Constraints for table `tb_umkm`
--
ALTER TABLE `tb_umkm`
  ADD CONSTRAINT `tb_umkm_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `tb_user` (`IDUser`);

--
-- Constraints for table `tb_umkm_data`
--
ALTER TABLE `tb_umkm_data`
  ADD CONSTRAINT `tb_umkm_data_ibfk_1` FOREIGN KEY (`IDUMKM`) REFERENCES `tb_umkm` (`IDUMKM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
