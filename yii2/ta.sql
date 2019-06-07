-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25 Feb 2019 pada 04.52
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
  `ruangan_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_daftarruangan`
--

INSERT INTO `t_daftarruangan` (`ruangan_id`, `ruangan_name`) VALUES
(1, 'Gedung-513'),
(2, 'Gedung-514'),
(3, 'Gedung-4'),
(4, 'Gedung-6');

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
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_data`
--

INSERT INTO `t_data` (`data_id`, `start_time`, `end_time`, `ruangan_id`, `user_id`, `status`) VALUES
(1, '2019-02-22 10:00:00', '2019-02-22 18:00:00', 3, 1, 1),
(2, '2019-02-22 11:15:00', '2019-02-14 10:50:00', 1, 1, 2),
(3, '2019-02-22 11:55:00', '2019-02-23 07:35:00', 3, 1, 3),
(4, '2019-02-16 15:55:00', '2019-02-08 11:55:00', 3, 2, 2),
(5, '2019-02-26 10:45:00', '2019-02-26 22:45:00', 2, 2, 1);

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
(3, 'client'),
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
(4, 'maha', '$2y$13$9S/db.Rh8GAC1UmZXXQsReQ1eW1/IQAEzgftTiMLhvlGpb5gCZyqC', '', 'sxxGw-AukwD8VsTeWkgjKkH60i_zmjg5', 'maha', 3);

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
  MODIFY `ruangan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_data`
--
ALTER TABLE `t_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
