-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 02 Novembre 2013 à 17:07
-- Version du serveur: 5.5.25
-- Version de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Contenu de la table `tj_object_link_oli`
--

INSERT INTO `tj_object_link_oli` (`oli_id`, `obj_id_parent`, `obj_id_child`, `oli_step`, `oli_removed`) VALUES
(1, 1, 2, 0, 0);

--
-- Contenu de la table `ts_user_usr`
--

INSERT INTO `ts_user_usr` (`usr_id`, `usr_pwd`, `usr_firstname`, `usr_lastname`, `usr_nickname`, `usr_adult`, `usr_mail`, `usr_credit`, `img_id`, `usr_temporary`, `usr_fail_auth`, `usr_blocked`, `usr_msg_perso`) VALUES
(9447, '81dc9bdb52d04dc20036dbd8313ed055', 'Matthieu', 'GUFFROY', 'mguffroy', 1, 'matthieu.guffroy@etu.utc.fr', 156, NULL, 0, 0, 0, 'Hello World Ceci est un message super long ...... Plus de 54caracteres il parrait !');

--
-- Contenu de la table `t_fundation_fun`
--

INSERT INTO `t_fundation_fun` (`fun_id`, `fun_name`, `fun_removed`) VALUES
(1, 'BDE UTC', 0),
(2, 'PICASSO', 0),
(3, 'POLAR', 0);

--
-- Contenu de la table `t_message_msg`
--

INSERT INTO `t_message_msg` (`usr_id`, `fun_id`, `msg_perso`) VALUES
(NULL, NULL, 'Il y a une vie après les cours');

--
-- Contenu de la table `t_object_obj`
--

INSERT INTO `t_object_obj` (`obj_id`, `obj_name`, `obj_type`, `obj_stock`, `obj_single`, `obj_tva`, `obj_alcool`, `img_id`, `fun_id`, `obj_removed`) VALUES
(1, 'Softs', 'category', NULL, 0, 0, 0, NULL, 2, 0),
(2, 'Coca', 'product', 20, 0, 0, 0, NULL, 2, 0);

--
-- Contenu de la table `t_price_pri`
--

INSERT INTO `t_price_pri` (`pri_id`, `obj_id`, `grp_id`, `per_id`, `pri_credit`, `pri_removed`) VALUES
(1, 2, NULL, NULL, 70, 0);
