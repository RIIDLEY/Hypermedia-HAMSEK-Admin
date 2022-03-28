-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 22 mars 2022 à 13:36
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
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `fichiers_upload`
--

INSERT INTO `fichiers_upload` (`id`, `name`, `filename`, `type`, `size`) VALUES
(185, 'Halo-Infinite-donnez-du-style-a-votre-Spartan-avec-des', 'Halo-Infinite-donnez-du-style-a-votre-Spartan-avec-des.jpg', 'jpg', 50454);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
