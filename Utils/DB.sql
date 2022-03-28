-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 28 mars 2022 à 13:13
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hypermedia-hamsek`
--
CREATE DATABASE IF NOT EXISTS `hypermedia-hamsek` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `hypermedia-hamsek`;

-- --------------------------------------------------------

--
-- Structure de la table `fichiers_upload`
--

DROP TABLE IF EXISTS `fichiers_upload`;
CREATE TABLE IF NOT EXISTS `fichiers_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `filename` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=237 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `fichiers_upload`
--

INSERT INTO `fichiers_upload` (`id`, `name`, `filename`, `type`, `size`) VALUES
(236, 'Halo-Infinite-donnez-du-style-a-votre-Spartan-avec-des', 'Halo-Infinite-donnez-du-style-a-votre-Spartan-avec-des.jpg', 'jpg', 50454);

-- --------------------------------------------------------

--
-- Structure de la table `user_list_hamsek`
--

DROP TABLE IF EXISTS `user_list_hamsek`;
CREATE TABLE IF NOT EXISTS `user_list_hamsek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(33) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user_list_hamsek`
--

INSERT INTO `user_list_hamsek` (`id`, `login`, `mdp`) VALUES
(12, 'coucou', '$2y$10$CyYjQyeg8tmgiTfnmha/KuiNrMpeJwM44FEG7FlIE1BC0FcbQ2M/y');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
