-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 27 fév. 2018 à 21:15
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdfilms`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Action'),
(2, 'Drame'),
(3, 'Comedie'),
(4, 'Horreur'),
(5, 'Science Fiction');

-- --------------------------------------------------------

--
-- Structure de la table `tabfilms`
--

DROP TABLE IF EXISTS `tabfilms`;
CREATE TABLE `tabfilms` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `realisateur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` int(10) NOT NULL,
  `duree` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `pochette` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `tabfilms`
--

INSERT INTO `tabfilms` (`id`, `titre`, `realisateur`, `categorie`, `duree`, `prix`, `pochette`) VALUES
(1, 'aa', 'qq', 2, 11, '22', '18de31e39e00a8db46d08768bd03d28cdc29321d.jpe'),
(2, 'aa', 'ss', 3, 11, '22', '9335ad3731f278c2c40349daf6df4b9448628aee.jpe'),
(3, 'bb', 'bb', 1, 22, '33', '508604574269225144e48033f540e2396bc3243b.jpe'),
(4, 'Star War', 'George Lucas', 5, 133, '18', '0b5cecda608ecbb48a409cc163678480115441dc.jpe'),
(5, 'Star War2', 'George Lucas', 5, 133, '199', '0eb9482312733d9b94102d4397a70bb946e11835.jpe'),
(6, 'rr', 'tt', 1, 34, '67', '17edd4f79d5800eb32a77c0ae2a559c2b97d49b4.jpe'),
(7, 'Harry Porter', 'Rolling', 5, 200, '34', 'f6c0d2ce56621a5bde514591f923a10f00da265e.jpe'),
(8, 'aa', 'ww', 1, 11, '22', '8989cde27a4bba89e47b1c33921bef7e9012dc91.jpe');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
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
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `courriel`, `mdp`, `adresse`, `role`) VALUES
(3, 'user', 'user', 'user@film.com', '$2y$10$sjQGxxGiak1Mwwcen1/SgObaYsNZLEN2027QXLWut7yg4.2nrpoye', 'user', 1),
(2, 'admin', 'admin', 'admin@film.com', '$2y$10$u3o6uZ2/LxxkCt0mJy/BIugScCZykyK/7Epb26pdaw0fq.P6aKrHy', 'admin', 0),
(5, 'aa', 'aa', 'aaa@cc.com', '$2y$10$aEu3tspkKd6Z/95QVe/npeTYddrplqG5IU7b/UXGWWllQIgNyPd8.', 'aaa', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tabfilms`
--
ALTER TABLE `tabfilms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tabfilms`
--
ALTER TABLE `tabfilms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
