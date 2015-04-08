-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 16 Décembre 2014 à 11:51
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `planning`
--

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `classes`
--

INSERT INTO `classes` (`id`, `classe`) VALUES
(1, 'Bachelor 1'),
(2, 'Bachelor 2'),
(3, 'Bachelor 3');

-- --------------------------------------------------------

--
-- Structure de la table `jours`
--

CREATE TABLE IF NOT EXISTS `jours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `jours`
--

INSERT INTO `jours` (`id`, `jour`) VALUES
(1, 'Lundi'),
(2, 'Mardi'),
(3, 'Mercredi'),
(4, 'Jeudi'),
(5, 'Vendredi');

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE IF NOT EXISTS `matieres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matiere` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `couleur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `matieres`
--

INSERT INTO `matieres` (`id`, `matiere`, `couleur`) VALUES
(1, 'Francais', '#3498db'),
(2, 'Mathematique', '#2ecc71'),
(3, 'Anglais', '#8e44ad'),
(4, 'Histoire', '#d35400');

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE IF NOT EXISTS `planning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horaire` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `semaine` int(11) NOT NULL,
  `id_jour` int(11) NOT NULL,
  `id_salle` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `planning`
--

INSERT INTO `planning` (`id`, `horaire`, `id_classe`, `id_prof`, `semaine`, `id_jour`, `id_salle`) VALUES
(1, 0, 2, 4, 21, 1, 2),
(2, 1, 2, 5, 21, 1, 1),
(3, 0, 2, 2, 21, 2, 5),
(4, 1, 2, 3, 21, 2, 2),
(5, 0, 2, 2, 21, 3, 3),
(6, 1, 2, 4, 21, 3, 4),
(11, 1, 2, 3, 21, 4, 1),
(12, 0, 2, 4, 21, 5, 5),
(13, 1, 2, 3, 21, 5, 3),
(14, 0, 2, 2, 21, 4, 2),
(15, 0, 1, 3, 1, 1, 1),
(16, 1, 1, 2, 1, 1, 3),
(17, 0, 1, 4, 1, 2, 3),
(18, 1, 1, 2, 1, 2, 4),
(19, 0, 1, 2, 1, 3, 5),
(20, 1, 1, 5, 1, 3, 1),
(21, 0, 1, 2, 1, 4, 5),
(22, 1, 1, 4, 1, 4, 5),
(23, 0, 1, 2, 1, 5, 4),
(24, 1, 1, 3, 1, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

CREATE TABLE IF NOT EXISTS `salles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `salles`
--

INSERT INTO `salles` (`id`, `salle`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'A3'),
(4, 'A4'),
(5, 'A5');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `classe` int(11) DEFAULT NULL,
  `id_matiere` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `type`, `email`, `pass`, `nom`, `prenom`, `classe`, `id_matiere`) VALUES
(1, 0, 'itnik.91@gmail.com', '703dd859e9d4ed34d5ad947a347ea946547b3c24', 'torres', 'guillaume', 2, NULL),
(2, 1, 'LeProfRelou@gmail.com', '703dd859e9d4ed34d5ad947a347ea946547b3c24', 'Denguir', 'Vincent', NULL, 2),
(3, 1, 'prof@gmail.com', '703dd859e9d4ed34d5ad947a347ea946547b3c24', 'Rocheleau', 'richard', NULL, 1),
(4, 1, 'autreprof@gmail.com', '703dd859e9d4ed34d5ad947a347ea946547b3c24', 'nguyen', 'Gabrielle ', NULL, 3),
(5, 1, 'paulo@gmail.com', '703dd859e9d4ed34d5ad947a347ea946547b3c24', 'Desaulniers', 'paul', NULL, 4),
(6, 0, 'eleve@gmail.com', '703dd859e9d4ed34d5ad947a347ea946547b3c24', 'Rochefort', 'David ', 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
