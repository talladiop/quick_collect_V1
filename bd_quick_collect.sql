-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 11 Décembre 2012 à 19:27
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bd_quick_collect`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `CAT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CAT_LIB` varchar(50) NOT NULL,
  `CAT_ETAT` int(1) NOT NULL DEFAULT '1' COMMENT '1 pour actif, 0 pour inactif',
  PRIMARY KEY (`CAT_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`CAT_ID`, `CAT_LIB`, `CAT_ETAT`) VALUES
(1, 'Education', 1),
(2, 'Santé', 1),
(3, 'Sport', 1),
(5, 'Environnement', 1);

-- --------------------------------------------------------

--
-- Structure de la table `enquete`
--

CREATE TABLE IF NOT EXISTS `enquete` (
  `CHILD_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PAR_ID` int(11) NOT NULL,
  `RUB_RANG` int(11) DEFAULT NULL,
  `SOC_ID` int(11) DEFAULT NULL,
  `LIB` varchar(100) DEFAULT NULL,
  `CAT_ID` int(11) NOT NULL,
  PRIMARY KEY (`CHILD_ID`),
  KEY `DEMANDER_FK` (`SOC_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `enquete`
--

INSERT INTO `enquete` (`CHILD_ID`, `PAR_ID`, `RUB_RANG`, `SOC_ID`, `LIB`, `CAT_ID`) VALUES
(1, 0, NULL, 1, 'Enquete 1', 1),
(2, 0, 0, 2, 'ENQUETE 2', 1),
(3, 1, 1, NULL, 'rub1 enq 1', 0),
(4, 1, 2, NULL, 'rub 2 enq 1', 0),
(5, 1, 3, NULL, 'rub 3 enq 1', 0),
(6, 2, 1, NULL, 'rub1 enq 2', 0),
(7, 2, 2, NULL, 'rub 2 enq 2', 0);

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

CREATE TABLE IF NOT EXISTS `fonction` (
  `FONC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FONC_LIB` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`FONC_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `fonction`
--


-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
  `PERS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FONC_ID` varchar(100) DEFAULT NULL,
  `PERS_NOM` varchar(50) DEFAULT NULL,
  `PERS_PRENOM` varchar(100) NOT NULL,
  `PERS_TEL` varchar(13) DEFAULT NULL,
  `PERS_ADDR` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`PERS_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `personnel`
--


-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `QUES_ID` int(10) NOT NULL AUTO_INCREMENT,
  `CHILD_ID` int(10) NOT NULL,
  `TYPE_QUES_ID` int(10) NOT NULL DEFAULT '1',
  `QUES_LIB` varchar(255) DEFAULT NULL,
  `QUES_RANG` int(10) DEFAULT NULL,
  `QUES_PARENT_ID` int(10) DEFAULT NULL,
  `QUES_AIDE` varchar(255) DEFAULT NULL,
  `OBL` int(11) NOT NULL DEFAULT '0' COMMENT 'vaut 1 si la question est obligatoire, 0 sinon',
  PRIMARY KEY (`QUES_ID`),
  KEY `CENCERNER2_FK` (`CHILD_ID`),
  KEY `ETRE_FK` (`TYPE_QUES_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`QUES_ID`, `CHILD_ID`, `TYPE_QUES_ID`, `QUES_LIB`, `QUES_RANG`, `QUES_PARENT_ID`, `QUES_AIDE`, `OBL`) VALUES
(1, 3, 1, 'ques1 rub 1', 1, NULL, NULL, 0),
(2, 3, 1, 'ques 2 rub 1', 2, NULL, NULL, 0),
(3, 4, 2, 'ques 1 rub 2', 1, NULL, NULL, 0),
(4, 3, 1, 'Nouvelle Question', NULL, NULL, NULL, 0),
(5, 3, 1, 'Nouvelle Question', NULL, NULL, NULL, 0),
(6, 3, 1, 'Nouvelle Question', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `REP_ID` int(10) NOT NULL AUTO_INCREMENT,
  `QUES_ID` int(10) NOT NULL,
  `REP_LIB` varchar(100) DEFAULT NULL,
  `REP_RANG` int(10) DEFAULT NULL,
  `REP_QUES_SUIV` int(10) DEFAULT NULL,
  PRIMARY KEY (`REP_ID`),
  KEY `AVOIR_FK` (`QUES_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`REP_ID`, `QUES_ID`, `REP_LIB`, `REP_RANG`, `REP_QUES_SUIV`) VALUES
(3, 1, 'rep1', 1, NULL),
(4, 2, 'rep2', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

CREATE TABLE IF NOT EXISTS `rubrique` (
  `RUB_ID` int(10) NOT NULL AUTO_INCREMENT,
  `ENQ_ID` int(10) NOT NULL,
  `RUB_LIB` varchar(100) DEFAULT NULL,
  `RUB_RANG` int(10) DEFAULT NULL,
  PRIMARY KEY (`RUB_ID`),
  KEY `CONCERNER1_FK` (`ENQ_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `rubrique`
--

INSERT INTO `rubrique` (`RUB_ID`, `ENQ_ID`, `RUB_LIB`, `RUB_RANG`) VALUES
(1, 1, 'rub1 enq 1', 1),
(2, 1, 'rub 2 enq 1', 2),
(3, 2, 'rub 1 enq 2', 1),
(4, 2, 'rub 2 enq 2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE IF NOT EXISTS `societe` (
  `SOC_ID` int(10) NOT NULL AUTO_INCREMENT,
  `SOC_LIB` varchar(100) DEFAULT NULL,
  `SOC_TEL` varchar(13) DEFAULT NULL,
  `SOC_ADDR` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SOC_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `societe`
--

INSERT INTO `societe` (`SOC_ID`, `SOC_LIB`, `SOC_TEL`, `SOC_ADDR`) VALUES
(1, 'idev', NULL, NULL),
(2, 'idev', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_question`
--

CREATE TABLE IF NOT EXISTS `type_question` (
  `TYPE_QUES_ID` int(10) NOT NULL AUTO_INCREMENT,
  `TYPE_QUES_LIB` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`TYPE_QUES_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `type_question`
--

INSERT INTO `type_question` (`TYPE_QUES_ID`, `TYPE_QUES_LIB`) VALUES
(1, 'Texte'),
(2, 'Paragraphe'),
(3, 'Choix multiple'),
(4, 'Case à cocher'),
(5, 'Sélectionner dans une liste'),
(6, 'Intervalle'),
(7, 'Tableaux');

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

CREATE TABLE IF NOT EXISTS `type_utilisateur` (
  `type_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_user_lib` varchar(10) NOT NULL,
  PRIMARY KEY (`type_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`type_user_id`, `type_user_lib`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `login` varchar(20) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `type_user` int(11) NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `mdp`, `type_user`) VALUES
('admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Structure de la table `valeur`
--

CREATE TABLE IF NOT EXISTS `valeur` (
  `VAL_ID` varchar(10) NOT NULL,
  `REP_ID` int(10) DEFAULT NULL,
  `PERS_ID` char(10) NOT NULL,
  `VAL_DATE` int(10) DEFAULT NULL,
  `VAL_REP_TEXT` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`VAL_ID`),
  KEY `CONCERNER4_FK` (`REP_ID`),
  KEY `CONCERNER6_FK` (`PERS_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `valeur`
--

