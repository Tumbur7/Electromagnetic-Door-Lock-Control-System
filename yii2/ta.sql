-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 Jun 2019 pada 14.28
-- Versi Server: 10.1.24-MariaDB
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_daftarruangan`
--

CREATE TABLE `t_daftarruangan` (
  `ruangan_id` int(11) NOT NULL,
  `ruangan_name` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `ip_device` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_daftarruangan`
--

INSERT INTO `t_daftarruangan` (`ruangan_id`, `ruangan_name`, `status`, `ip_device`) VALUES
(1, 'Ruangan 513', 'Tertutup', NULL),
(2, 'Ruangan 514', 'Tertutup', NULL),
(3, 'Ruangan 515', 'Tertutup', NULL),
(5, 'Duktek', 'Tertutup', NULL),
(6, '524', '', 'http://192.168.43.49/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_data`
--

CREATE TABLE `t_data` (
  `data_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'Menunggu',
  `status_request` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_data`
--

INSERT INTO `t_data` (`data_id`, `start_time`, `end_time`, `ruangan_id`, `user_id`, `status`, `status_request`) VALUES
(1, '2019-02-22 10:00:00', '2019-02-22 18:00:00', 3, 1, '2', ''),
(2, '2019-02-22 11:15:00', '2019-02-14 10:50:00', 1, 1, '2', ''),
(3, '2019-02-22 11:55:00', '2019-02-23 07:35:00', 3, 1, '3', ''),
(4, '2019-02-16 15:55:00', '2019-02-08 11:55:00', 3, 2, '2', ''),
(5, '2019-02-26 10:45:00', '2019-02-26 22:45:00', 2, 2, '1', ''),
(6, '2019-03-19 13:30:00', '2019-03-12 09:45:00', 1, 1, '0', ''),
(7, '2019-03-15 11:55:00', '2019-03-16 07:35:00', 3, 1, '0', ''),
(8, '2019-03-08 11:55:00', '2019-03-23 15:55:00', 1, 9, '0', ''),
(9, '2019-03-16 16:50:00', '2019-03-23 11:30:00', 2, 9, '0', ''),
(10, '2019-03-06 09:45:00', '2019-03-20 14:35:00', 2, 8, '0', ''),
(11, '2019-03-16 13:20:00', '2019-03-18 13:20:00', 1, 12, '1', ''),
(12, '2019-03-29 10:30:00', '2019-03-29 19:35:00', 1, 7, '0', ''),
(13, '2019-03-30 09:00:00', '2019-03-30 14:25:00', 3, 7, '0', ''),
(17, '2019-03-15 13:02:00', '2019-03-15 13:05:00', 1, 1, 'Tertutup', 'Accepted'),
(18, '2019-03-29 16:20:00', '2019-03-28 16:45:00', 1, 1, 'Menunggu', 'Pending'),
(19, '2019-03-30 10:50:00', '2019-03-30 19:20:00', 1, 7, 'Menunggu', 'Accepted'),
(20, '2019-03-29 09:30:00', '2019-03-31 09:25:00', 1, 13, 'Menunggu', 'Accepted'),
(21, '2019-03-30 10:45:00', '2019-03-31 18:05:00', 2, 2, 'Menunggu', 'Accepted'),
(22, '2019-04-04 15:00:00', '2019-04-04 16:00:00', 1, 2, 'Menunggu', 'Pending'),
(23, '2019-04-04 16:00:00', '2019-04-04 17:00:00', 1, 2, 'Menunggu', 'Pending'),
(24, '2019-04-09 09:45:00', '2019-04-11 10:50:00', 2, 2, 'Menunggu', 'Pending'),
(25, '2019-04-09 05:25:00', '2019-04-10 10:50:00', 3, 2, '', 'Pending'),
(26, '2019-04-10 10:25:00', '2019-04-11 10:50:00', 2, 2, 'Menunggu', 'Pending'),
(27, '2019-04-10 10:50:00', '2019-04-11 06:30:00', 3, 2, '', 'Pending'),
(28, '2019-04-10 10:30:00', '2019-04-11 10:50:00', 1, 2, 'Menunggu', 'Pending'),
(29, '2019-04-11 10:50:00', '2019-04-11 23:40:00', 2, 2, 'Menunggu', 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_role`
--

CREATE TABLE `t_role` (
  `role_id` int(11) NOT NULL,
  `access_page` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_role`
--

INSERT INTO `t_role` (`role_id`, `access_page`) VALUES
(1, 'admin'),
(2, 'pemilik'),
(3, 'user'),
(4, 'satpam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `acces_token` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `acces_token`, `auth_key`, `fullname`, `role_id`) VALUES
(1, 'admin', '$2y$13$8QcCmHIMq1.FloZf8yMHzem2CVv8Ik6Cy2z2Ci/.Kv9..LCHHfIAS', '', 'O6Eit0q5oXM_nlDXNAI1FY6lptlV3uJu', 'Admin', 1),
(2, 'ce316030', '$2y$13$TFO/nbLFM/YPaeUyjiEzgur85h7OIlJBRRXhZZ/wALirDtHQpCk3e', '', 'gVvz1ykU-epHTC7MpSZMNQ_0sZ37s91j', 'Ce316030', 2),
(5, 'userPintu', '$2y$13$.M40Vfk0zGqL2evCb88kkuwvDEouuFeEVXv0nA78zpFrrmvFqY23m', '', '4yXGTsNH07tqknjrQEl2Z4YrLBlTE2hO', 'userPintu', 2),
(6, 'Anwar', '$2y$13$eLVSLo2gzC8XavwvipQ54etl8tt6NpsngjpYI9FqPtngHrttYvPvC', '', 'iv-tDeFG2B4tN5aCm60iXRvGLH76M-lG', 'Anwar', 4),
(7, 'Perdana Situmorang', '$2y$13$2Ob3vf5/9d6RDhMMWMbA0OggdGfHShYAOhFqix3DDAQ6d6//C49Hy', '', 'bHcpikIxH9h_Xl3y8PbO_NrD8Jn4kUcD', 'Perdana Situmorang', 2),
(8, 'ce316031', '$2y$13$Xvcl2ubyH0F.zWClI/F7Y.kNsruMI.DUhyMRcFJONvlflK.S/ja5u', '', '392bs1BP5vBIOPKoK29AhqFi4Ed6q5yu', 'ce316031', 3),
(9, 'userlppm', '$2y$13$Gp2zfDzv79GiL1jFmYiF4OSTddq/F36Iog4ghtSyM.dRgm3UeUsMa', '', 'hOoeh9m5ITt_FTurk7EMt7Xyn7ITKD-P', 'userlppm', 2),
(10, 'userlppm', '$2y$13$4DZtjh4HGNwsSZTGONqIoeHJz6BiPlxLJ33SLrr79YP2I831kU896', '', 'ekOvyR4PzbMFVhIO8Zl_LIdY6_DE8iPb', 'userlppm', 1),
(11, 'tumbur', '$2y$13$VOSiUtXbXF/qmBBaCKGzceE6Hb78b/n.xDB3OtIFdJ7ZVYzK6mIAC', '', 'XrwD_HQ0QYFTaeUJeqi5mTHisfGMbd3t', 'tumbur', 2),
(12, 'ojak', '$2y$13$DqtwXKCBgq3sMbdIqky8deP5F12ymlkvGEtn7PrD0x8ijfS5yw/Gq', '', 'MtW_WUk9YoyiVVvdhIyMmo2OalUbouMH', 'ojak', 2),
(13, 'ce316001', '$2y$13$MppkxI8i.nP4e2CtF0iOJ.vPKc2SURJzvD5D/FZk.vgFZx3Bbb.5O', '', '0iwQ4y7ATbFcgJZwACIg-w92HIFP4uNE', 'ce316001', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_daftarruangan`
--
ALTER TABLE `t_daftarruangan`
  ADD PRIMARY KEY (`ruangan_id`);

--
-- Indexes for table `t_data`
--
ALTER TABLE `t_data`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `ruangna_id` (`ruangan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_daftarruangan`
--
ALTER TABLE `t_daftarruangan`
  MODIFY `ruangan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `t_data`
--
ALTER TABLE `t_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_data`
--
ALTER TABLE `t_data`
  ADD CONSTRAINT `t_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_data_ibfk_2` FOREIGN KEY (`ruangan_id`) REFERENCES `t_daftarruangan` (`ruangan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD CONSTRAINT `t_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `t_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
