-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 29 Septembre 2011 à 15:16
-- Version du serveur: 5.5.9
-- Version de PHP: 5.3.6

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `Bowling`
--

-- --------------------------------------------------------

--
-- Structure de la table `bowling`
--

DROP TABLE IF EXISTS `bowling`;
CREATE TABLE `bowling` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `bowling`
--
INSERT INTO `bowling` VALUES(1, 'Boule qui roule', 'Hello');

-- --------------------------------------------------------

--
-- Structure de la table `coup`
--

DROP TABLE IF EXISTS `move`;
CREATE TABLE `move` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `player_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_move_game1` (`game_id`),
  KEY `fk_move_player1` (`player_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `move`
--

INSERT INTO `move` VALUES(1, 1, 1, 1);
INSERT INTO `move` VALUES(2, 2, 1, 1);
INSERT INTO `move` VALUES(3, 1, 1, 2);
INSERT INTO `move` VALUES(4, 2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE `player` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(150) DEFAULT NULL,
  `pseudo_url` varchar(150) DEFAULT '',
  `name` varchar(150) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `player`
--

INSERT INTO `player` VALUES(1, 'romain', 'romain', 'Bessuges', 'Romain');
INSERT INTO `player` VALUES(2, 'cyril', 'cyril', 'Aknine', 'Cyril');


-- --------------------------------------------------------

--
-- Structure de la table `lancer`
--

DROP TABLE IF EXISTS `shoot`;
CREATE TABLE `shoot` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `move_id` int(11) DEFAULT NULL,
  `index` tinyint(1) DEFAULT NULL,
  `score` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shoot_move1` (`move_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `shoot`
--

INSERT INTO `shoot` VALUES(1, 1, 1, 3);
INSERT INTO `shoot` VALUES(2, 1, 2, 5);
INSERT INTO `shoot` VALUES(4, 2, 1, 10);
INSERT INTO `shoot` VALUES(5, 3, 1, 6);
INSERT INTO `shoot` VALUES(6, 3, 1, 1);
INSERT INTO `shoot` VALUES(7, 4, 1, 0);
INSERT INTO `shoot` VALUES(8, 4, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `team_player`
--

DROP TABLE IF EXISTS `team_player`;
CREATE TABLE `team_player` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `player_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `player_alias` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_team_player_player1` (`player_id`),
  KEY `fk_team_player_team1` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `team_player`
--

INSERT INTO `team_player` VALUES(1, 1, 1, 'RB');
INSERT INTO `team_player` VALUES(2, 2, 1, 'CA');

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_game_team1` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `game`
--

INSERT INTO `game` VALUES(1, 1, '2011-09-18 22:22:17');
INSERT INTO `game` VALUES(2, 1, '2011-09-18 22:42:27');
INSERT INTO `game` VALUES(3, 1, '2011-09-18 23:00:43');

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bowling_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_team_bowling` (`bowling_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `team`
--

INSERT INTO `team` VALUES(1, 1, '2011-09-17 23:10:47');


-- --------------------------------------------------------

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `move`
--
ALTER TABLE `move`
  ADD CONSTRAINT `fk_move_game1` FOREIGN KEY (`game_id`) REFERENCES `mydb`.`game` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_move_player1` FOREIGN KEY (`player_id`) REFERENCES `mydb`.`player` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `shoot`
--
ALTER TABLE `shoot`
  ADD CONSTRAINT `fk_shoot_move1` FOREIGN KEY (`move_id`) REFERENCES `mydb`.`move` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `team_player`
--
ALTER TABLE `team_player`
  ADD CONSTRAINT `fk_team_player_player1` FOREIGN KEY (`player_id`) REFERENCES `mydb`.`player` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_team_player_team1` FOREIGN KEY (`team_id`) REFERENCES `mydb`.`team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `fk_game_team1` FOREIGN KEY (`team_id`) REFERENCES `mydb`.`team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`id`) REFERENCES `bowling` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
