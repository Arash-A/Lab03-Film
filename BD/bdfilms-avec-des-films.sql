-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2018 at 04:03 AM
-- Server version: 5.7.17
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


--
-- Database: `bdfilms`
--
CREATE DATABASE IF NOT EXISTS `bdfilms` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bdfilms`
-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Action'),
(2, 'Drame'),
(3, 'Comedie'),
(4, 'Horreur'),
(5, 'Science Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `tabfilms`
--

CREATE TABLE `tabfilms` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `realisateur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` int(10) NOT NULL,
  `duree` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `pochette` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publier` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tabfilms`
--

INSERT INTO `tabfilms` (`id`, `titre`, `realisateur`, `categorie`, `duree`, `prix`, `pochette`, `video_link`, `publier`) VALUES
(1, 'Avatar', 'James Cameron', 5, 110, '22', 'd02a635a1d123077aab0e3e47b28167110cf4478.jpe', 'https://www.youtube.com/watch?v=5PSNL1qE6VY', 1),
(2, 'Roi lion', 'walt disney', 3, 120, '22', 'f44dbb9cf21c846ef5af2ded1e312cf32323746e.jpe', 'https://www.youtube.com/watch?v=4sj1MT05lAA', 1),
(5, 'Star War2', 'George Lucas', 5, 133, '99', '42cd8b00b871ce7defb8fd0c4401c25d266c3600.jpe', 'https://www.youtube.com/watch?v=gYbW1F_c9eM', 1),
(6, 'L\'enfant loup', 'Gerardo Olivares', 2, 90, '20', '57c65c394b0435429a9e76b2e447af2d42e24a2c.jpe', 'https://www.youtube.com/watch?v=bGyLPT6pQs8', 1),
(7, 'Harry Porter', 'Rolling', 5, 200, '34', 'efc8fb7516b9e15cd176c375977f307e68d9ce79.jpe', 'https://www.youtube.com/watch?v=VyHV0BRtdxo', 1),
(17, 'Hunger games', 'Jenifer Lawrence', 5, 125, '125', 'ec7b1ffca41846822e408aec988ccb38c4e57766.jpg', 'https://www.youtube.com/watch?v=mfmrPu43DF8', 1),
(18, '100 Years', 'Robert rodriguez', 1, 90, '45', 'bf8498df3d76698b92e04401c8ce63927b65eb51.jpg', 'https://www.youtube.com/watch?v=T1ka20sR-o8', 1),
(19, 'Vendus', 'ragia', 1, 120, '12', '83430b3e9b6f1bdab523dcbe8b08b8cee4bccf03.jpe', 'https://www.youtube.com/watch?v=15FSZYJCSzE', 1),
(20, 'Gladiator', 'Ridley Scott', 1, 90, '13', '6da28fd0497295fe395a4c2f0b709db4269a3f0a.jpe', 'https://www.youtube.com/watch?v=do9zep1n8cU', 1),
(21, 'Guerrier', 'Gavin O\'Connor', 1, 90, '10', 'fa50a56c2d32b69cbec96f0055abf2f9afb89fff.jpe', 'https://www.youtube.com/watch?v=7O51IsNzZ1I', 1),
(22, 'Le petit rince', 'Mark Osborne', 2, 90, '12', '6f4d26b55b1c08a8e7c997c43e2cd0534e9f6cd2.jpe', 'https://www.youtube.com/watch?v=-dEHr3ivwCc', 1),
(23, 'Unthinkable', 'jim', 1, 80, '10', 'c390ff2987cfbb1b421fe2b7ad6bdeca39c62429.jpe', 'https://www.youtube.com/watch?v=jWFrW7HGR6g', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `courriel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(20000) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `courriel`, `mdp`, `adresse`, `role`) VALUES
(3, 'user', 'user', 'user@film.com', '$2y$10$u3o6uZ2/LxxkCt0mJy/BIugScCZykyK/7Epb26pdaw0fq.P6aKrHy', 'user', 1),
(2, 'admin', 'admin', 'admin@film.com', '$2y$10$u3o6uZ2/LxxkCt0mJy/BIugScCZykyK/7Epb26pdaw0fq.P6aKrHy', 'admin', 0),
(5, 'aa', 'aa', 'aaa@cc.com', '$2y$10$aEu3tspkKd6Z/95QVe/npeTYddrplqG5IU7b/UXGWWllQIgNyPd8.', 'aaa', 1),
(6, '', '', '', '$2y$10$r/56.hqkIemmwvvsheZnpuktK59l/.OAti79cIe2NBGZjVKKTKPWu', '', 1),
(7, '12', 'Arash', 'amiri2281@gmail.com', '$2y$10$aqJaSwxiO8hm9fhSGP7FVOyd4fqlkgDoRD4FXov44OULZf5RNGLSq', '1595 Rachel E', 1),
(8, 'Amiri', 'Arash', 'a@a.com', '$2y$10$EEal9D1ji48glKbjRAWimOL5QrR4Nl9f1bsPoL8YZCOCnGSLXZnfO', '1595 Rachel E', 1),
(9, 'Amiri', 'Arash', 'amir2281@gmail.com', '$2y$10$Gk3P24l7R5tex8nzAmlrqerZPoG.kkMU0gNuJdniUnIrWDP3jV/im', '1595 Rachel E', 1),
(10, 'Amiri', 'Arash', 'amiri281@gmail.com', '$2y$10$rCXPiDnWEHmKORyTqxjNteRe825PYDmilnI85seewRZFBjqOzTv2u', '1595 Rachel E', 1),
(11, 'Amiri', 'Arash', 'miri2281@gmail.com', '$2y$10$oM/e2YPEkXoUL477hVyE2ecPdXp4pWIHMRea8mf2990dC1rt3LKSC', '1595 Rachel E', 1),
(12, 'Amiri', 'Arash', 'amiri81@gmail.com', '$2y$10$mI6xocFhrp958mXSlLJ0G.O73Fut/NPZthqptlINO.HWac9KYB4GC', '1595 Rachel E', 1),
(13, 'Amiri', 'Arash', 'amiri2281@ail.com', '$2y$10$I.wJMM.TTrOQ15KjWEXtF.kXqZ4501SpWcdMw540JkzuBtW6gYNB2', '1595 Rachel E', 1),
(14, 'Amiri', 'Arash', 'amiri2281@gil.com', '$2y$10$PqZsC9Xu.vz1DCB26x0gN.UUzQJy6wIlL.VYP/R0HhU7YYxifq3Sm', '1595 Rachel E', 1),
(15, 'Amiri', 'Arash', 'amiri2281@gmail.c', '$2y$10$zaU33g3vMjWGi6RPnpReLuHIzUvdNIMP371raEXm7j4Swj5AqnuZ2', '1595 Rachel E', 1),
(16, 'Amiri', 'Arash', 'amir81@gmail.c', '$2y$10$64S2TSy9/6FvCsbpoTY7Ne3CdBymaX87nEjIGGMtXpzDe4H1RZyyu', '1595 Rachel E', 1),
(17, 'Amiri', 'Arash', 'am1@gail.c', '$2y$10$skeavpSvb7oV2DEtn89qAuCO6l0xL5R0FK8pD0O8eB2.3IxRGCA9S', '1595 Rachel E', 1),
(18, '000000000', '11111', '2121@szdddddddddd', '$2y$10$6Rd5DUovIesq/E4fLtdkz.qXa/4ToD6HUnbrnVKcDMTOVvj4Q8Qni', 'lokj', 1),
(19, 'Amiri', 'Arash', 'am@gmail.com', '$2y$10$t0FNL.pWJZgKUxvpS0kK6OggXcp.Z6rCLm2caMqO7mWNr7FqAK54G', '1595 Rachel E', 1),
(20, 'Amiri', 'Arash', 'a@film.com', '$2y$10$mvs/Pth18ROSBaK5rjmRg.i.hetAlRQhXwF4TDaaOeTK2wFqO.xUq', '1595 Rachel E', 1),
(21, 'Amiri', 'Arash', 'amiri2281@film.com', '$2y$10$SFSrZFiX3vfwEMMn4dfcLuW3.P.knEKTFmf71Qm8y5Nu9qGkxAoZy', '1595 Rachel E', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabfilms`
--
ALTER TABLE `tabfilms`
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
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tabfilms`
--
ALTER TABLE `tabfilms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
