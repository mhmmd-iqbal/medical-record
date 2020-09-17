-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 07:22 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekam_medik_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `log_admin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`username`, `password`, `nama`, `log_admin`) VALUES
('admin', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', '2019-07-15 14:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `kode_dokter` varchar(12) NOT NULL,
  `nama_dokter` varchar(40) NOT NULL,
  `id_spesialisasi` int(11) NOT NULL,
  `id_klinik` int(11) NOT NULL,
  `jnsklmn_dokter` enum('L','P') NOT NULL,
  `alamat_dokter` varchar(60) NOT NULL,
  `hp_dokter` varchar(14) NOT NULL,
  `password` varchar(255) NOT NULL,
  `log_dokter` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`kode_dokter`, `nama_dokter`, `id_spesialisasi`, `id_klinik`, `jnsklmn_dokter`, `alamat_dokter`, `hp_dokter`, `password`, `log_dokter`) VALUES
('MK-000001111', 'Agus Pramana', 1, 1, 'L', 'asdasd', '08210000111122', '827ccb0eea8a706c4c34a16891f84e7b', '2019-07-16 08:22:08'),
('MK-123456789', 'Dr. Sutisna', 2, 2, 'L', '', '', '827ccb0eea8a706c4c34a16891f84e7b', '2019-07-22 03:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_list_obat`
--

CREATE TABLE `tb_list_obat` (
  `id_list_obat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_harian` int(11) NOT NULL,
  `log_list_obat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_list_obat`
--

INSERT INTO `tb_list_obat` (`id_list_obat`, `id_obat`, `id_harian`, `log_list_obat`) VALUES
(53, 2, 35, '2019-08-06 15:16:39'),
(54, 1, 35, '2019-08-06 15:16:41'),
(55, 1, 36, '2019-08-06 15:16:55'),
(56, 1, 35, '2019-08-06 15:32:17'),
(58, 3, 35, '2019-08-06 15:54:16'),
(59, 1, 36, '2019-08-06 15:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_list_obat_konsultasi`
--

CREATE TABLE `tb_list_obat_konsultasi` (
  `id_list_obat_konsultasi` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `penggunaan` varchar(20) NOT NULL,
  `id_perawatan` int(11) NOT NULL,
  `log_list_obat_konsultasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_list_obat_konsultasi`
--

INSERT INTO `tb_list_obat_konsultasi` (`id_list_obat_konsultasi`, `id_obat`, `penggunaan`, `id_perawatan`, `log_list_obat_konsultasi`) VALUES
(9, 2, '', 27, '2019-08-06 15:04:50'),
(10, 1, '', 27, '2019-08-06 15:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(20) NOT NULL,
  `keterangan_obat` varchar(60) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `keterangan_obat`, `harga`) VALUES
(1, 'Antasida 100mg', 'obat oral untuk masuk angin', 40000),
(2, 'Milanta', 'Obat Angin', 35000),
(3, 'Mixagrip', 'Obat Sakit Kepala', 12500),
(4, 'Tabung Infus', 'cairan infus', 150000),
(5, 'asdasd', 'asdasd', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `kode_pasien` varchar(15) NOT NULL,
  `nik_pasien` varchar(16) NOT NULL,
  `nama_pasien` varchar(40) NOT NULL,
  `jnsklmn_pasien` enum('L','P') NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `status_perkawinan` enum('Kawin','Belum Kawin','Duda','Janda') NOT NULL,
  `agama` enum('Islam','Kristen','Protestan','Hindu','Buddha') NOT NULL,
  `alamat_pasien` varchar(60) NOT NULL,
  `tmp_lahir` varchar(60) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `log_pasien` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`kode_pasien`, `nik_pasien`, `nama_pasien`, `jnsklmn_pasien`, `pekerjaan`, `status_perkawinan`, `agama`, `alamat_pasien`, `tmp_lahir`, `tgl_lahir`, `no_hp`, `photo`, `log_pasien`) VALUES
('101156245200', '1111132206940001', 'Aswandi, S.Kom, M.Kom', 'L', 'Dosen', 'Kawin', 'Islam', 'Medan, Sumatra Utara', 'Medan', '1986-07-16', '082165678664', '', '2019-07-25 16:34:08'),
('13790616', '1111132206940002', 'Deva Mayzeda', 'P', 'Mahasiswa', 'Belum Kawin', 'Islam', 'oo', 'Medan', '2019-07-26', NULL, '', '2019-07-26 07:34:16'),
('21351229200', '1212190101961000', 'Amri', 'L', '', 'Kawin', 'Islam', 'Rusun', 'Medan', '1986-12-12', '082165678664', 'NO_IMAGE.jpg', '2019-07-15 13:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perawatan`
--

CREATE TABLE `tb_perawatan` (
  `id_perawatan` int(11) NOT NULL,
  `kode_pasien` varchar(15) NOT NULL,
  `kode_dokter` varchar(12) NOT NULL,
  `diagnosa_awal` varchar(100) DEFAULT NULL,
  `diagnosa_utama` varchar(100) DEFAULT NULL,
  `status_perawatan` enum('inap','jalan','konsultasi') NOT NULL,
  `cara_masuk` varchar(40) DEFAULT NULL,
  `cara_keluar` varchar(40) DEFAULT NULL,
  `keadaan_keluar` varchar(40) DEFAULT NULL,
  `pj` varchar(40) DEFAULT NULL,
  `hp_pj` varchar(15) DEFAULT NULL,
  `keadaan_perawatan` enum('dalam perawatan','tidak dalam perawatan') NOT NULL,
  `biaya_perawatan` int(11) NOT NULL,
  `total_biaya` int(11) DEFAULT NULL,
  `log_perawatan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perawatan`
--

INSERT INTO `tb_perawatan` (`id_perawatan`, `kode_pasien`, `kode_dokter`, `diagnosa_awal`, `diagnosa_utama`, `status_perawatan`, `cara_masuk`, `cara_keluar`, `keadaan_keluar`, `pj`, `hp_pj`, `keadaan_perawatan`, `biaya_perawatan`, `total_biaya`, `log_perawatan`) VALUES
(27, '101156245200', 'MK-123456789', 'asdsad', 'asdsad', 'konsultasi', NULL, NULL, NULL, NULL, NULL, 'tidak dalam perawatan', 300000, 375000, '2019-08-06 15:04:50'),
(29, '101156245200', 'MK-123456789', 'batuk berdahak', 'Lambung', 'inap', 'sendiri', 'diijinkan pulang', 'sembuh', 'Agus', '082112321232', 'tidak dalam perawatan', 200000, 407500, '2019-08-06 15:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perawatan_harian`
--

CREATE TABLE `tb_perawatan_harian` (
  `id_harian` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kondisi` varchar(100) DEFAULT NULL,
  `id_perawatan` int(11) DEFAULT NULL,
  `log_harian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perawatan_harian`
--

INSERT INTO `tb_perawatan_harian` (`id_harian`, `tanggal`, `kondisi`, `id_perawatan`, `log_harian`) VALUES
(35, '2019-08-06 10:08:23', 'Sesuai gejala diagnosis awal', 29, '2019-08-06 15:16:23'),
(36, '2019-08-06 10:08:51', 'sudah sembuh', 29, '2019-08-06 15:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_poliklinik`
--

CREATE TABLE `tb_poliklinik` (
  `id_klinik` int(11) NOT NULL,
  `nama_klinik` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_poliklinik`
--

INSERT INTO `tb_poliklinik` (`id_klinik`, `nama_klinik`) VALUES
(1, 'Klinik Bedah'),
(2, 'Klinik Anak');

-- --------------------------------------------------------

--
-- Table structure for table `tb_spesialisasi`
--

CREATE TABLE `tb_spesialisasi` (
  `id_spesialisasi` int(11) NOT NULL,
  `spesialisasi` varchar(20) NOT NULL,
  `log_spesialisasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_spesialisasi`
--

INSERT INTO `tb_spesialisasi` (`id_spesialisasi`, `spesialisasi`, `log_spesialisasi`) VALUES
(1, 'Jantung', '2019-07-15 15:27:16'),
(2, 'Gigi', '2019-07-15 15:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_list_obat`
--

CREATE TABLE `tmp_list_obat` (
  `id_tmp_obat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `penggunaan` varchar(20) DEFAULT NULL,
  `kode_pasien` varchar(15) NOT NULL,
  `kode_dokter` varchar(12) NOT NULL,
  `log_tmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`kode_dokter`),
  ADD KEY `id_spesialisasi` (`id_spesialisasi`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indexes for table `tb_list_obat`
--
ALTER TABLE `tb_list_obat`
  ADD PRIMARY KEY (`id_list_obat`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_harian` (`id_harian`);

--
-- Indexes for table `tb_list_obat_konsultasi`
--
ALTER TABLE `tb_list_obat_konsultasi`
  ADD PRIMARY KEY (`id_list_obat_konsultasi`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_perawatan` (`id_perawatan`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`kode_pasien`),
  ADD UNIQUE KEY `nik_pasien` (`nik_pasien`);

--
-- Indexes for table `tb_perawatan`
--
ALTER TABLE `tb_perawatan`
  ADD PRIMARY KEY (`id_perawatan`),
  ADD KEY `kode_dokter` (`kode_dokter`),
  ADD KEY `kode_pasien` (`kode_pasien`);

--
-- Indexes for table `tb_perawatan_harian`
--
ALTER TABLE `tb_perawatan_harian`
  ADD PRIMARY KEY (`id_harian`),
  ADD KEY `id_rawat_inap` (`id_perawatan`);

--
-- Indexes for table `tb_poliklinik`
--
ALTER TABLE `tb_poliklinik`
  ADD PRIMARY KEY (`id_klinik`);

--
-- Indexes for table `tb_spesialisasi`
--
ALTER TABLE `tb_spesialisasi`
  ADD PRIMARY KEY (`id_spesialisasi`);

--
-- Indexes for table `tmp_list_obat`
--
ALTER TABLE `tmp_list_obat`
  ADD PRIMARY KEY (`id_tmp_obat`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `kode_dokter` (`kode_dokter`),
  ADD KEY `kode_pasien` (`kode_pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_list_obat`
--
ALTER TABLE `tb_list_obat`
  MODIFY `id_list_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `tb_list_obat_konsultasi`
--
ALTER TABLE `tb_list_obat_konsultasi`
  MODIFY `id_list_obat_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_obat`
--
ALTER TABLE `tb_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_perawatan`
--
ALTER TABLE `tb_perawatan`
  MODIFY `id_perawatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tb_perawatan_harian`
--
ALTER TABLE `tb_perawatan_harian`
  MODIFY `id_harian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tb_poliklinik`
--
ALTER TABLE `tb_poliklinik`
  MODIFY `id_klinik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_spesialisasi`
--
ALTER TABLE `tb_spesialisasi`
  MODIFY `id_spesialisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tmp_list_obat`
--
ALTER TABLE `tmp_list_obat`
  MODIFY `id_tmp_obat` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD CONSTRAINT `tb_dokter_ibfk_1` FOREIGN KEY (`id_spesialisasi`) REFERENCES `tb_spesialisasi` (`id_spesialisasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_dokter_ibfk_2` FOREIGN KEY (`id_klinik`) REFERENCES `tb_poliklinik` (`id_klinik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_list_obat`
--
ALTER TABLE `tb_list_obat`
  ADD CONSTRAINT `tb_list_obat_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_list_obat_ibfk_2` FOREIGN KEY (`id_harian`) REFERENCES `tb_perawatan_harian` (`id_harian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_list_obat_konsultasi`
--
ALTER TABLE `tb_list_obat_konsultasi`
  ADD CONSTRAINT `tb_list_obat_konsultasi_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_list_obat_konsultasi_ibfk_2` FOREIGN KEY (`id_perawatan`) REFERENCES `tb_perawatan` (`id_perawatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_perawatan`
--
ALTER TABLE `tb_perawatan`
  ADD CONSTRAINT `tb_perawatan_ibfk_1` FOREIGN KEY (`kode_dokter`) REFERENCES `tb_dokter` (`kode_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_perawatan_ibfk_2` FOREIGN KEY (`kode_pasien`) REFERENCES `tb_pasien` (`kode_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_perawatan_harian`
--
ALTER TABLE `tb_perawatan_harian`
  ADD CONSTRAINT `tb_perawatan_harian_ibfk_1` FOREIGN KEY (`id_perawatan`) REFERENCES `tb_perawatan` (`id_perawatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tmp_list_obat`
--
ALTER TABLE `tmp_list_obat`
  ADD CONSTRAINT `tmp_list_obat_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `tb_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tmp_list_obat_ibfk_2` FOREIGN KEY (`kode_dokter`) REFERENCES `tb_dokter` (`kode_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tmp_list_obat_ibfk_3` FOREIGN KEY (`kode_pasien`) REFERENCES `tb_pasien` (`kode_pasien`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
