-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20 Feb 2019 pada 03.07
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
-- Database: `ta2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_data`
--

CREATE TABLE `t_data` (
  `id` int(11) NOT NULL,
  `jamBuka` datetime NOT NULL,
  `jamTutup` datetime NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_data`
--

INSERT INTO `t_data` (`id`, `jamBuka`, `jamTutup`, `keperluan`, `user_id`) VALUES
(2, '2019-01-12 08:40:00', '2019-01-15 09:45:00', 'ib', 3),
(4, '2019-01-07 05:25:00', '2019-01-18 15:45:00', 'adsfasfdsa', 3),
(5, '2019-02-22 15:30:00', '2019-02-21 10:50:00', 'TA', 10);

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
(2, 'client');

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
  `fullname` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `acces_token`, `auth_key`, `fullname`, `role_id`) VALUES
(1, 'admin', '$2y$13$8QcCmHIMq1.FloZf8yMHzem2CVv8Ik6Cy2z2Ci/.Kv9..LCHHfIAS', '', 'O6Eit0q5oXM_nlDXNAI1FY6lptlV3uJu', 'Admin terbaik', 1),
(2, 'client', '$2y$13$ToXEkGyObp/V/RVBNZCUDuDjcsVk11RNvFKVYSc6.1VeMzyVxw8.G', '', 'Gc954OMHPOx7lP3RqyHvtO8kLFmkluEP', 'client', 2),
(3, 'ce316030', '$2y$13$TFO/nbLFM/YPaeUyjiEzgur85h7OIlJBRRXhZZ/wALirDtHQpCk3e', '', 'gVvz1ykU-epHTC7MpSZMNQ_0sZ37s91j', 'Tumbur Simarmata', 2),
(6, 'axel', '$2y$13$iMKjUzfbHil.lZwSCT6AL.EFkrirVUgk7zjuLYera8mzrMa5CLrKq', '', 'dp1QviUjiu8eqpiHqM9SZY7ZjKqupZlN', 'Axel S', 2),
(9, 'baru', '$2y$13$ergjDrp9XO6QXmmwd1UJoOT/tmuWYXsyTjXVvZNMJq9CJjI73onwe', '', 'KmC-7O7L_AFkr69Ff0LGYPlo2MsFgCX9', 'baru', 2),
(10, 'ce316018', '$2y$13$bekfKpH5JdIOZBo5/TqeWuEDd1cvM/z.n9qpULe5N3As4X7qyNF0.', '', 'C0V_IVpW_KCivpkuOSVTEtl5s2jLZIDV', 'ce316018', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_data`
--
ALTER TABLE `t_data`
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT for table `t_data`
--
ALTER TABLE `t_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_data`
--
ALTER TABLE `t_data`
  ADD CONSTRAINT `t_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_role`
--
ALTER TABLE `t_role`
  ADD CONSTRAINT `t_role_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `t_user` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
