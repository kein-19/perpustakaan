-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2020 at 08:10 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik_merahputih`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agama`
--

CREATE TABLE `tbl_agama` (
  `kd_agama` varchar(2) NOT NULL,
  `nama_agama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_agama`
--

INSERT INTO `tbl_agama` (`kd_agama`, `nama_agama`) VALUES
('01', 'Islam'),
('02', 'Kristen Protestan'),
('03', 'Katholik'),
('04', 'Hindu'),
('05', 'Budha'),
('06', 'Konghucu'),
('99', 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `kd_jurusan` varchar(4) NOT NULL,
  `nama_jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`kd_jurusan`, `nama_jurusan`) VALUES
('AP', 'Administrasi Perkantoran'),
('TKJ', 'Teknik Komputer dan Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id` int(11) NOT NULL,
  `id_member` varchar(50) NOT NULL,
  `nisn` int(20) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `tempat_lahir` varchar(128) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `kd_agama` varchar(2) NOT NULL,
  `jurusan` varchar(128) NOT NULL,
  `warganegara` enum('WNI','WNA') NOT NULL,
  `statussiswa` enum('Kandung','Yatim','Piatu','Yatim Piatu','Tiri','Angkat') NOT NULL,
  `anak_ke` int(2) NOT NULL,
  `dari__bersaudara` int(2) NOT NULL,
  `jumlah_saudara` int(2) NOT NULL,
  `alamat` text NOT NULL,
  `rt` int(3) NOT NULL,
  `rw` int(3) NOT NULL,
  `kelurahan` varchar(128) NOT NULL,
  `kecamatan` varchar(128) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `tinggalbersama` enum('Orang tua','Saudara','Orang lain','Asrama') NOT NULL,
  `jarak` int(2) NOT NULL,
  `transport` enum('Kendaraan Umum','Kendaraan Pribadi','Jalan Kaki') NOT NULL,
  `asal_sekolah` varchar(128) NOT NULL,
  `no_sttb` varchar(50) NOT NULL,
  `pindahan` varchar(128) NOT NULL,
  `suratpindah` enum('Ada','Tidak') NOT NULL,
  `alasan` text NOT NULL,
  `image` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama_ot` varchar(128) NOT NULL,
  `alamat_ot` text NOT NULL,
  `no_hp_ot` varchar(13) NOT NULL,
  `pendidikan_ot` varchar(128) NOT NULL,
  `pekerjaan_ot` varchar(128) NOT NULL,
  `penghasilan_ot` int(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `id_member`, `nisn`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `kd_agama`, `jurusan`, `warganegara`, `statussiswa`, `anak_ke`, `dari__bersaudara`, `jumlah_saudara`, `alamat`, `rt`, `rw`, `kelurahan`, `kecamatan`, `no_hp`, `tinggalbersama`, `jarak`, `transport`, `asal_sekolah`, `no_sttb`, `pindahan`, `suratpindah`, `alasan`, `image`, `email`, `password`, `nama_ot`, `alamat_ot`, `no_hp_ot`, `pendidikan_ot`, `pekerjaan_ot`, `penghasilan_ot`, `role_id`, `is_active`, `date_created`) VALUES
(21, '20-21-PSB-05120003', 1234567811, 'Salma Nur Labibah', 'Cibinong', '2000-12-12', 'P', '01', 'AP', 'WNI', 'Kandung', 1, 2, 2, 'Bojong gede', 5, 5, 'Bojong gede', 'Bojong gede', '081234567891', 'Saudara', 3, 'Kendaraan Pribadi', 'SMPN 1 Cibinong', '2120071134567', '', '', '', 'profile211.png', 'salma@gmail.com', '$2y$10$Ji0QWzSSygYVjz1fROReje7WHWE03vMPervV401wDrTP86ZcQRwyG', 'Raswa Ewo', 'Bojong gede', '085723417999', 'S1', 'Guru', 5000000, 2, 0, 1589347959),
(22, '20-21-PSB-05130004', 2147483647, 'Zaki Almatin', 'Bogor', '2005-12-12', 'L', '01', 'AP', 'WNI', 'Kandung', 1, 0, 0, 'Cibinong', 3, 2, 'Cibinong', 'Cibinong', '085712345798', 'Orang tua', 2, 'Kendaraan Umum', 'SMPN 1 Cibinong', '21342145645', '', '', '', 'default1.jpg', 'zaki@gmail.com', '$2y$10$0GSr86WEaVbCr0otrYrYk.9zAeSwG6Qxf8nNGqC3qQg2CypIv0UUe', 'Komarudin', 'Cibinong', '081243567847', 'SMA', 'Karyawan Swasta', 3000000, 2, 1, 1589402516),
(25, '20-21-PSB-05150006', 1234567890, 'Mugny', 'Kuningan', '2000-11-11', 'L', '01', 'TKJ', 'WNI', 'Kandung', 2, 2, 1, 'Ciwaru', 2, 2, 'Ciwaru', 'Ciwaru', '081234567891', 'Orang tua', 2, 'Kendaraan Umum', 'SMPN 1 Ciwaru', '1231413423424524', '', '', '', 'default.png', 'mugny@gmail.com', '$2y$10$zQTfWJuAmLR/qR0KlefhrepCVBAdT87/OXjx7pM4t4vzXaCx8dKfa', 'Arif', 'Ciwaru', '085723417898', 'SMA', 'Wiraswasta', 500000, 2, 0, 1589507513),
(26, '20-21-PSB-06020007', 1424876132, 'Uzumaki Naruto', 'Konohagakure', '2000-10-10', 'L', '01', 'TKJ', 'WNI', 'Yatim Piatu', 1, 0, 0, 'Konohagakure', 3, 1, 'Konohagakure', 'Konohagakure', '085712349798', 'Asrama', 1, 'Jalan Kaki', 'SMPN Konohagakure', '21342145645', '', '', '', 'default.png', 'naruto@gmail.com', '$2y$10$D6a6f.R6iykwbyWuDXABV.py6AjrNq0YrZC/k.DvnL.Bu8CZ9xpiq', 'Minato Namikaze', 'Konohagakure', '081243567147', 'Hokage', 'Hokage', 2147483647, 2, 0, 1591071325);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `foto` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_user`, `nama_lengkap`, `email`, `password`, `role_id`, `is_active`, `date_created`, `foto`) VALUES
(8, 'yusron', 'yusron@gmail.com', '$2y$10$li3aMn9/9DcKPK.sJgzHmulDzjOS14Q29KkTuZQ45mKI3qO/AkSMO', 1, 1, 1589403197, 'default.png'),
(9, 'naruto', 'naruto@gmail.com', '$2y$10$yqXXIYDJdhX4RuJGGNuSKOrQ3oj9kQX4kpqcduychBOPW6ApS6EhG', 1, 1, 1589462771, 'default.png'),
(10, 'admin', 'admin@gmail.com', '$2y$10$6hxXElzZcuzO3v2Ghud/X.WjL3DsosMI8TKiauJvRT5aqemeTFPFm', 1, 1, 1589771627, 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_access_menu`
--

CREATE TABLE `t_user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user_access_menu`
--

INSERT INTO `t_user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(4, 1, 2),
(8, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `t_user_menu`
--

CREATE TABLE `t_user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user_menu`
--

INSERT INTO `t_user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(5, 'Walikelas');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_role`
--

CREATE TABLE `t_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user_role`
--

INSERT INTO `t_user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `t_user_sub_menu`
--

CREATE TABLE `t_user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user_sub_menu`
--

INSERT INTO `t_user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Home', 'member', 'fas fa-fw fa-home', 1),
(3, 2, 'My Profile', 'member/profile', 'fas fa-fw fa-user', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(6, 1, 'Role', 'admin/role', 'fas fa-fw fa-pencil-ruler', 1),
(10, 2, 'Edit Profile', 'member/editprofile', 'fas fa-fw fa-user-edit', 1),
(11, 1, 'Change Password', 'admin/changepassword', 'fas fa-fw fa-key', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_agama`
--
ALTER TABLE `tbl_agama`
  ADD PRIMARY KEY (`kd_agama`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`kd_jurusan`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `t_user_access_menu`
--
ALTER TABLE `t_user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user_menu`
--
ALTER TABLE `t_user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user_role`
--
ALTER TABLE `t_user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user_sub_menu`
--
ALTER TABLE `t_user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_user_access_menu`
--
ALTER TABLE `t_user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_user_menu`
--
ALTER TABLE `t_user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_user_role`
--
ALTER TABLE `t_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_user_sub_menu`
--
ALTER TABLE `t_user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
