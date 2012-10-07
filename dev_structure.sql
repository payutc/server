-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Dim 07 Octobre 2012 à 13:50
-- Version du serveur: 5.5.24
-- Version de PHP: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `payutc`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_object_link_oli`
--

CREATE TABLE IF NOT EXISTS `tj_object_link_oli` (
  `oli_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `obj_id_parent` int(11) unsigned NOT NULL,
  `obj_id_child` int(11) unsigned NOT NULL,
  `oli_step` int(3) unsigned NOT NULL,
  `oli_removed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`oli_id`),
  KEY `obj_id_parent` (`obj_id_parent`),
  KEY `obj_id_child` (`obj_id_child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `tj_object_link_oli`:
--   `obj_id_child`
--       `t_object_obj` -> `obj_id`
--   `obj_id_parent`
--       `t_object_obj` -> `obj_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_obj_poi_jop`
--

CREATE TABLE IF NOT EXISTS `tj_obj_poi_jop` (
  `obj_id` int(11) unsigned NOT NULL,
  `jop_priority` int(11) NOT NULL DEFAULT '100',
  `poi_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`obj_id`,`poi_id`),
  KEY `poi_id` (`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS POUR LA TABLE `tj_obj_poi_jop`:
--   `poi_id`
--       `t_point_poi` -> `poi_id`
--   `obj_id`
--       `t_object_obj` -> `obj_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_usr_grp_jug`
--

CREATE TABLE IF NOT EXISTS `tj_usr_grp_jug` (
  `jug_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) unsigned NOT NULL,
  `grp_id` int(11) unsigned NOT NULL,
  `per_id` int(11) unsigned NOT NULL,
  `jug_removed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`jug_id`),
  KEY `per_id` (`per_id`),
  KEY `grp_id` (`grp_id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `tj_usr_grp_jug`:
--   `per_id`
--       `t_period_per` -> `per_id`
--   `usr_id`
--       `ts_user_usr` -> `usr_id`
--   `grp_id`
--       `t_group_grp` -> `grp_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_usr_mol_jum`
--

CREATE TABLE IF NOT EXISTS `tj_usr_mol_jum` (
  `usr_id` int(11) unsigned NOT NULL,
  `mol_id` int(11) unsigned NOT NULL,
  `jum_data` varchar(200) NOT NULL,
  PRIMARY KEY (`usr_id`,`mol_id`,`jum_data`),
  KEY `mol_id` (`mol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS POUR LA TABLE `tj_usr_mol_jum`:
--   `usr_id`
--       `ts_user_usr` -> `usr_id`
--   `mol_id`
--       `ts_mean_of_login_mol` -> `mol_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_usr_rig_jur`
--

CREATE TABLE IF NOT EXISTS `tj_usr_rig_jur` (
  `jur_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) unsigned DEFAULT NULL,
  `rig_id` int(11) unsigned NOT NULL,
  `per_id` int(11) unsigned DEFAULT NULL,
  `fun_id` int(11) unsigned DEFAULT NULL,
  `poi_id` int(11) unsigned DEFAULT NULL,
  `jur_removed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`jur_id`),
  UNIQUE KEY `usr_id_2` (`usr_id`,`rig_id`,`fun_id`,`jur_removed`),
  UNIQUE KEY `rig_id_2` (`rig_id`,`fun_id`,`poi_id`,`jur_removed`),
  KEY `usr_id` (`usr_id`),
  KEY `rig_id` (`rig_id`),
  KEY `per_id` (`per_id`),
  KEY `fun_id` (`fun_id`),
  KEY `poi_id` (`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `tj_usr_rig_jur`:
--   `per_id`
--       `t_period_per` -> `per_id`
--   `usr_id`
--       `ts_user_usr` -> `usr_id`
--   `rig_id`
--       `ts_right_rig` -> `rig_id`
--   `fun_id`
--       `t_fundation_fun` -> `fun_id`
--   `poi_id`
--       `t_point_poi` -> `poi_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `ts_callback_cal`
--

CREATE TABLE IF NOT EXISTS `ts_callback_cal` (
  `cal_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) unsigned NOT NULL,
  `cal_request` varchar(250) NOT NULL,
  `mol_id` int(11) unsigned NOT NULL,
  `cal_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cal_id`),
  KEY `pro_id` (`pro_id`),
  KEY `mol_id` (`mol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `ts_callback_cal`:
--   `mol_id`
--       `ts_mean_of_login_mol` -> `mol_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `ts_error_err`
--

CREATE TABLE IF NOT EXISTS `ts_error_err` (
  `err_code` int(5) unsigned NOT NULL,
  `err_name` varchar(40) NOT NULL,
  `err_description` text NOT NULL,
  `err_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`err_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ts_image_img`
--

CREATE TABLE IF NOT EXISTS `ts_image_img` (
  `img_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `img_mime` varchar(20) NOT NULL,
  `img_width` int(5) unsigned NOT NULL,
  `img_length` int(5) unsigned NOT NULL,
  `img_content` longblob NOT NULL,
  `img_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_log_log`
--

CREATE TABLE IF NOT EXISTS `ts_log_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_gravity` tinyint(1) unsigned NOT NULL,
  `log_message` text NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_mean_of_login_mol`
--

CREATE TABLE IF NOT EXISTS `ts_mean_of_login_mol` (
  `mol_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mol_name` varchar(40) NOT NULL,
  `mol_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_right_rig`
--

CREATE TABLE IF NOT EXISTS `ts_right_rig` (
  `rig_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rig_name` varchar(40) NOT NULL,
  `rig_description` text NOT NULL,
  `rig_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rig_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rig_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_user_usr`
--

CREATE TABLE IF NOT EXISTS `ts_user_usr` (
  `usr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usr_pwd` varchar(100) DEFAULT NULL,
  `usr_firstname` varchar(40) DEFAULT NULL,
  `usr_lastname` varchar(40) DEFAULT NULL,
  `usr_nickname` varchar(200) DEFAULT NULL,
  `usr_adult` int(1) DEFAULT NULL,
  `usr_mail` varchar(200) DEFAULT NULL,
  `usr_credit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `img_id` int(11) unsigned DEFAULT NULL,
  `usr_temporary` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `usr_fail_auth` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `usr_blocked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `usr_msg_perso` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usr_id`),
  KEY `img_id` (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `ts_user_usr`:
--   `img_id`
--       `ts_image_img` -> `img_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_fundation_fun`
--

CREATE TABLE IF NOT EXISTS `t_fundation_fun` (
  `fun_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fun_name` varchar(40) NOT NULL,
  `fun_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_group_grp`
--

CREATE TABLE IF NOT EXISTS `t_group_grp` (
  `grp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `grp_name` varchar(40) NOT NULL,
  `grp_open` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `grp_public` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `fun_id` int(11) unsigned NOT NULL,
  `grp_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`grp_id`),
  KEY `fun_id` (`fun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_group_grp`:
--   `fun_id`
--       `t_fundation_fun` -> `fun_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_object_obj`
--

CREATE TABLE IF NOT EXISTS `t_object_obj` (
  `obj_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `obj_name` varchar(100) NOT NULL,
  `obj_type` enum('product','category','promotion') NOT NULL,
  `obj_stock` int(11) DEFAULT NULL,
  `obj_single` tinyint(1) unsigned NOT NULL,
  `obj_tva` int(4) NOT NULL,
  `obj_alcool` int(1) NOT NULL,
  `img_id` int(11) unsigned DEFAULT NULL,
  `fun_id` int(11) unsigned NOT NULL,
  `obj_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`obj_id`),
  KEY `img_id` (`img_id`),
  KEY `fun_id` (`fun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_object_obj`:
--   `fun_id`
--       `t_fundation_fun` -> `fun_id`
--   `img_id`
--       `ts_image_img` -> `img_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_oldusr_osr`
--

CREATE TABLE IF NOT EXISTS `t_oldusr_osr` (
  `osr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `osr_login` varchar(255) DEFAULT NULL,
  `osr_credit` float DEFAULT NULL,
  `osr_date` datetime DEFAULT NULL,
  PRIMARY KEY (`osr_id`),
  UNIQUE KEY `osr_login` (`osr_login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_paybox_pay`
--

CREATE TABLE IF NOT EXISTS `t_paybox_pay` (
  `pay_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usr_id` int(11) unsigned NOT NULL,
  `pay_step` enum('W','A','V') NOT NULL,
  `pay_amount` int(5) NOT NULL,
  `pay_date_create` datetime NOT NULL,
  `pay_date_retour` datetime DEFAULT NULL,
  `pay_auto` varchar(20) DEFAULT NULL,
  `pay_trans` varchar(20) DEFAULT NULL,
  `pay_callback_url` varchar(255) NOT NULL,
  `pay_mobile` tinyint(1) NOT NULL DEFAULT '0',
  `pay_error` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`pay_id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_paybox_pay`:
--   `usr_id`
--       `ts_user_usr` -> `usr_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_period_per`
--

CREATE TABLE IF NOT EXISTS `t_period_per` (
  `per_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fun_id` int(11) unsigned NOT NULL,
  `per_name` text,
  `per_date_start` datetime NOT NULL,
  `per_date_end` datetime NOT NULL,
  `per_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`per_id`),
  KEY `fun_id` (`fun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_period_per`:
--   `fun_id`
--       `t_fundation_fun` -> `fun_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_plage_pla`
--

CREATE TABLE IF NOT EXISTS `t_plage_pla` (
  `pla_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fun_id` int(11) unsigned NOT NULL,
  `poi_id` int(11) unsigned NOT NULL,
  `pla_start` int(4) NOT NULL,
  `pla_end` int(4) NOT NULL,
  `pla_name` varchar(100) NOT NULL,
  PRIMARY KEY (`pla_id`),
  KEY `fun_id` (`fun_id`),
  KEY `poi_id` (`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_plage_pla`:
--   `poi_id`
--       `t_point_poi` -> `poi_id`
--   `fun_id`
--       `t_fundation_fun` -> `fun_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_point_poi`
--

CREATE TABLE IF NOT EXISTS `t_point_poi` (
  `poi_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `poi_name` varchar(40) NOT NULL,
  `poi_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_price_pri`
--

CREATE TABLE IF NOT EXISTS `t_price_pri` (
  `pri_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `obj_id` int(11) unsigned NOT NULL,
  `grp_id` int(11) unsigned DEFAULT NULL,
  `per_id` int(11) unsigned DEFAULT NULL,
  `pri_credit` mediumint(8) unsigned NOT NULL,
  `pri_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pri_id`),
  KEY `obj_id` (`obj_id`),
  KEY `grp_id` (`grp_id`),
  KEY `per_id` (`per_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_price_pri`:
--   `per_id`
--       `t_period_per` -> `per_id`
--   `obj_id`
--       `t_object_obj` -> `obj_id`
--   `grp_id`
--       `t_group_grp` -> `grp_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_purchase_pur`
--

CREATE TABLE IF NOT EXISTS `t_purchase_pur` (
  `pur_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pur_date` datetime NOT NULL,
  `pur_type` enum('product','promotion') NOT NULL DEFAULT 'product',
  `obj_id` int(11) unsigned NOT NULL,
  `pur_price` int(8) unsigned NOT NULL,
  `usr_id_buyer` int(11) unsigned NOT NULL,
  `usr_id_seller` int(11) unsigned NOT NULL,
  `poi_id` int(11) unsigned NOT NULL,
  `fun_id` int(11) unsigned NOT NULL,
  `pur_ip` varchar(15) NOT NULL,
  `pur_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pur_id`),
  KEY `fun_id` (`fun_id`),
  KEY `poi_id` (`poi_id`),
  KEY `usr_id_buyer` (`usr_id_buyer`),
  KEY `usr_id_seller` (`usr_id_seller`),
  KEY `obj_id` (`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_purchase_pur`:
--   `obj_id`
--       `t_object_obj` -> `obj_id`
--   `usr_id_buyer`
--       `ts_user_usr` -> `usr_id`
--   `usr_id_seller`
--       `ts_user_usr` -> `usr_id`
--   `poi_id`
--       `t_point_poi` -> `poi_id`
--   `fun_id`
--       `t_fundation_fun` -> `fun_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_recharge_rec`
--

CREATE TABLE IF NOT EXISTS `t_recharge_rec` (
  `rec_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rty_id` tinyint(3) unsigned NOT NULL,
  `usr_id_buyer` int(11) unsigned NOT NULL,
  `usr_id_operator` int(11) unsigned NOT NULL,
  `poi_id` int(11) unsigned NOT NULL,
  `rec_date` datetime NOT NULL,
  `rec_credit` smallint(5) unsigned NOT NULL,
  `rec_trace` varchar(250) DEFAULT NULL,
  `rec_removed` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`rec_id`),
  KEY `rty_id` (`rty_id`),
  KEY `poi_id` (`poi_id`),
  KEY `usr_id_buyer` (`usr_id_buyer`),
  KEY `usr_id_operator` (`usr_id_operator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_recharge_rec`:
--   `poi_id`
--       `t_point_poi` -> `poi_id`
--   `rty_id`
--       `t_recharge_type_rty` -> `rty_id`
--   `usr_id_buyer`
--       `ts_user_usr` -> `usr_id`
--   `usr_id_operator`
--       `ts_user_usr` -> `usr_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_recharge_type_rty`
--

CREATE TABLE IF NOT EXISTS `t_recharge_type_rty` (
  `rty_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `rty_name` varchar(40) NOT NULL,
  `rty_type` enum('PBUY','SBUY') DEFAULT NULL,
  `rty_removed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_sale_sal`
--

CREATE TABLE IF NOT EXISTS `t_sale_sal` (
  `sal_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sal_name` varchar(100) DEFAULT NULL,
  `per_id` int(11) unsigned NOT NULL,
  `obj_id` int(11) unsigned NOT NULL,
  `sal_removed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`sal_id`),
  KEY `per_id` (`per_id`),
  KEY `obj_id` (`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_sale_sal`:
--   `obj_id`
--       `t_object_obj` -> `obj_id`
--   `per_id`
--       `t_period_per` -> `per_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_sherlocks_she`
--

CREATE TABLE IF NOT EXISTS `t_sherlocks_she` (
  `she_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` int(10) unsigned NOT NULL,
  `she_step` tinyint(1) NOT NULL,
  `she_amount` int(5) NOT NULL,
  `she_date` datetime NOT NULL,
  `she_parent_id` int(11) DEFAULT NULL,
  `she_state` int(5) NOT NULL,
  `she_trace` text NOT NULL,
  PRIMARY KEY (`she_id`),
  KEY `usr_id` (`usr_id`),
  KEY `she_parent_id` (`she_parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_sherlocks_she`:
--   `usr_id`
--       `ts_user_usr` -> `usr_id`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_virement_vir`
--

CREATE TABLE IF NOT EXISTS `t_virement_vir` (
  `vir_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vir_date` datetime NOT NULL,
  `vir_amount` int(5) NOT NULL,
  `usr_id_from` int(11) unsigned NOT NULL,
  `usr_id_to` int(11) unsigned NOT NULL,
  PRIMARY KEY (`vir_id`),
  KEY `usr_id_from` (`usr_id_from`),
  KEY `usr_id_to` (`usr_id_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `t_virement_vir`:
--   `usr_id_to`
--       `ts_user_usr` -> `usr_id`
--   `usr_id_from`
--       `ts_user_usr` -> `usr_id`
--

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tj_object_link_oli`
--
ALTER TABLE `tj_object_link_oli`
  ADD CONSTRAINT `tj_object_link_oli_ibfk_6` FOREIGN KEY (`obj_id_child`) REFERENCES `t_object_obj` (`obj_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_object_link_oli_ibfk_5` FOREIGN KEY (`obj_id_parent`) REFERENCES `t_object_obj` (`obj_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `tj_obj_poi_jop`
--
ALTER TABLE `tj_obj_poi_jop`
  ADD CONSTRAINT `tj_obj_poi_jop_ibfk_6` FOREIGN KEY (`poi_id`) REFERENCES `t_point_poi` (`poi_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_obj_poi_jop_ibfk_5` FOREIGN KEY (`obj_id`) REFERENCES `t_object_obj` (`obj_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `tj_usr_grp_jug`
--
ALTER TABLE `tj_usr_grp_jug`
  ADD CONSTRAINT `tj_usr_grp_jug_ibfk_3` FOREIGN KEY (`per_id`) REFERENCES `t_period_per` (`per_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_grp_jug_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_grp_jug_ibfk_2` FOREIGN KEY (`grp_id`) REFERENCES `t_group_grp` (`grp_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `tj_usr_mol_jum`
--
ALTER TABLE `tj_usr_mol_jum`
  ADD CONSTRAINT `tj_usr_mol_jum_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_mol_jum_ibfk_2` FOREIGN KEY (`mol_id`) REFERENCES `ts_mean_of_login_mol` (`mol_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `tj_usr_rig_jur`
--
ALTER TABLE `tj_usr_rig_jur`
  ADD CONSTRAINT `tj_usr_rig_jur_ibfk_5` FOREIGN KEY (`per_id`) REFERENCES `t_period_per` (`per_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_rig_jur_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_rig_jur_ibfk_2` FOREIGN KEY (`rig_id`) REFERENCES `ts_right_rig` (`rig_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_rig_jur_ibfk_3` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_rig_jur_ibfk_4` FOREIGN KEY (`poi_id`) REFERENCES `t_point_poi` (`poi_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `ts_callback_cal`
--
ALTER TABLE `ts_callback_cal`
  ADD CONSTRAINT `ts_callback_cal_ibfk_1` FOREIGN KEY (`mol_id`) REFERENCES `ts_mean_of_login_mol` (`mol_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `ts_user_usr`
--
ALTER TABLE `ts_user_usr`
  ADD CONSTRAINT `ts_user_usr_ibfk_1` FOREIGN KEY (`img_id`) REFERENCES `ts_image_img` (`img_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_group_grp`
--
ALTER TABLE `t_group_grp`
  ADD CONSTRAINT `t_group_grp_ibfk_2` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_object_obj`
--
ALTER TABLE `t_object_obj`
  ADD CONSTRAINT `t_object_obj_ibfk_3` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_object_obj_ibfk_1` FOREIGN KEY (`img_id`) REFERENCES `ts_image_img` (`img_id`);

--
-- Contraintes pour la table `t_paybox_pay`
--
ALTER TABLE `t_paybox_pay`
  ADD CONSTRAINT `t_paybox_pay_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`);

--
-- Contraintes pour la table `t_period_per`
--
ALTER TABLE `t_period_per`
  ADD CONSTRAINT `t_period_per_ibfk_1` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_plage_pla`
--
ALTER TABLE `t_plage_pla`
  ADD CONSTRAINT `t_plage_pla_ibfk_2` FOREIGN KEY (`poi_id`) REFERENCES `t_point_poi` (`poi_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_plage_pla_ibfk_1` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_price_pri`
--
ALTER TABLE `t_price_pri`
  ADD CONSTRAINT `t_price_pri_ibfk_3` FOREIGN KEY (`per_id`) REFERENCES `t_period_per` (`per_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_price_pri_ibfk_1` FOREIGN KEY (`obj_id`) REFERENCES `t_object_obj` (`obj_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_price_pri_ibfk_2` FOREIGN KEY (`grp_id`) REFERENCES `t_group_grp` (`grp_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_purchase_pur`
--
ALTER TABLE `t_purchase_pur`
  ADD CONSTRAINT `t_purchase_pur_ibfk_5` FOREIGN KEY (`obj_id`) REFERENCES `t_object_obj` (`obj_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_purchase_pur_ibfk_1` FOREIGN KEY (`usr_id_buyer`) REFERENCES `ts_user_usr` (`usr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_purchase_pur_ibfk_2` FOREIGN KEY (`usr_id_seller`) REFERENCES `ts_user_usr` (`usr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_purchase_pur_ibfk_3` FOREIGN KEY (`poi_id`) REFERENCES `t_point_poi` (`poi_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_purchase_pur_ibfk_4` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_recharge_rec`
--
ALTER TABLE `t_recharge_rec`
  ADD CONSTRAINT `t_recharge_rec_ibfk_8` FOREIGN KEY (`poi_id`) REFERENCES `t_point_poi` (`poi_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_recharge_rec_ibfk_5` FOREIGN KEY (`rty_id`) REFERENCES `t_recharge_type_rty` (`rty_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_recharge_rec_ibfk_6` FOREIGN KEY (`usr_id_buyer`) REFERENCES `ts_user_usr` (`usr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_recharge_rec_ibfk_7` FOREIGN KEY (`usr_id_operator`) REFERENCES `ts_user_usr` (`usr_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_sale_sal`
--
ALTER TABLE `t_sale_sal`
  ADD CONSTRAINT `t_sale_sal_ibfk_2` FOREIGN KEY (`obj_id`) REFERENCES `t_object_obj` (`obj_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_sale_sal_ibfk_1` FOREIGN KEY (`per_id`) REFERENCES `t_period_per` (`per_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_sherlocks_she`
--
ALTER TABLE `t_sherlocks_she`
  ADD CONSTRAINT `t_sherlocks_she_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_virement_vir`
--
ALTER TABLE `t_virement_vir`
  ADD CONSTRAINT `t_virement_vir_ibfk_2` FOREIGN KEY (`usr_id_to`) REFERENCES `ts_user_usr` (`usr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_virement_vir_ibfk_1` FOREIGN KEY (`usr_id_from`) REFERENCES `ts_user_usr` (`usr_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
