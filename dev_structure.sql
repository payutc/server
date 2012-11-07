-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 05 Octobre 2012 à 01:31
-- Version du serveur: 5.5.25
-- Version de PHP: 5.3.16-1~dotdeb.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `payutc_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_object_link_oli`
--

CREATE TABLE IF NOT EXISTS `tj_object_link_oli` (
  `oli_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du lien d''objets',
  `obj_id_parent` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet parent',
  `obj_id_child` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet enfant',
  `oli_step` int(3) unsigned NOT NULL COMMENT 'Étape (utile pour les promotions)',
  `oli_removed` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le lien d''objet a été supprimé',
  PRIMARY KEY (`oli_id`),
  KEY `obj_id_parent` (`obj_id_parent`),
  KEY `obj_id_child` (`obj_id_child`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Liens entre objets' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `tj_obj_poi_jop`
--

CREATE TABLE IF NOT EXISTS `tj_obj_poi_jop` (
  `obj_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet',
  `jop_priority` int(11) NOT NULL DEFAULT '100',
  `poi_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du point de vente',
  PRIMARY KEY (`obj_id`,`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Disponibilité du produit en fonction du point';

-- --------------------------------------------------------

--
-- Structure de la table `tj_usr_grp_jug`
--

CREATE TABLE IF NOT EXISTS `tj_usr_grp_jug` (
  `jug_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant',
  `usr_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `grp_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du groupe',
  `per_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de la période pour le groupe',
  `jug_removed` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le lien est supprimé',
  PRIMARY KEY (`jug_id`),
  KEY `per_id` (`per_id`),
  KEY `grp_id` (`grp_id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Liens d''appartenance des utilisateurs aux groupes' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tj_usr_mol_jum`
--

CREATE TABLE IF NOT EXISTS `tj_usr_mol_jum` (
  `usr_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `mol_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du mode de connexion (type de mean_of_login)',
  `jum_data` varchar(200) COLLATE utf8_general_ci NOT NULL COMMENT 'Identifiant concret de l''utilisateur (login, idEtu...)',
  PRIMARY KEY (`usr_id`,`mol_id`,`jum_data`),
  KEY `mol_id` (`mol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Différents identifiants des utilisateurs';

-- --------------------------------------------------------

--
-- Structure de la table `tj_usr_rig_jur`
--

CREATE TABLE IF NOT EXISTS `tj_usr_rig_jur` (
  `jur_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant',
  `usr_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant de l''utilisateur',
  `rig_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du droit',
  `per_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant de la période pour le droit',
  `fun_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant de l''organisme (optionnel)',
  `poi_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant du point (optionnel)',
  `jur_removed` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le droit est supprimé',
  PRIMARY KEY (`jur_id`),
  UNIQUE KEY `usr_id_2` (`usr_id`,`rig_id`,`fun_id`,`jur_removed`),
  UNIQUE KEY `rig_id_2` (`rig_id`,`fun_id`,`poi_id`,`jur_removed`),
  KEY `usr_id` (`usr_id`),
  KEY `rig_id` (`rig_id`),
  KEY `per_id` (`per_id`),
  KEY `fun_id` (`fun_id`),
  KEY `poi_id` (`poi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Liens entre utilisateurs et droits' AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_callback_cal`
--

CREATE TABLE IF NOT EXISTS `ts_callback_cal` (
  `cal_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du callback',
  `pro_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du produit acheté',
  `cal_request` varchar(250) COLLATE utf8_general_ci NOT NULL COMMENT 'Requête HTTP à effectuer lors de l''achat',
  `mol_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du moyen de connexion à envoyer',
  `cal_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le callback est supprimé',
  PRIMARY KEY (`cal_id`),
  KEY `pro_id` (`pro_id`),
  KEY `mol_id` (`mol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Callback à exécuter lors de l''achat de certains produits' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_error_err`
--

CREATE TABLE IF NOT EXISTS `ts_error_err` (
  `err_code` int(5) unsigned NOT NULL COMMENT 'Code de l''erreur',
  `err_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom de l''erreur',
  `err_description` text COLLATE utf8_general_ci NOT NULL COMMENT 'Description de l''erreur',
  `err_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''erreur est supprimée',
  PRIMARY KEY (`err_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Erreurs rencontrables lors de l''utilisation';

-- --------------------------------------------------------

--
-- Structure de la table `ts_image_img`
--

CREATE TABLE IF NOT EXISTS `ts_image_img` (
  `img_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''image',
  `img_mime` varchar(20) COLLATE utf8_general_ci NOT NULL COMMENT 'Format de l''image',
  `img_width` int(5) unsigned NOT NULL COMMENT 'Largeur de l''image',
  `img_length` int(5) unsigned NOT NULL COMMENT 'Longueur de l''image',
  `img_content` mediumblob NOT NULL COMMENT 'Contenu de l''image',
  `img_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''image est supprimée',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Images des utilisateurs et des produits' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_log_log`
--

CREATE TABLE IF NOT EXISTS `ts_log_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du log',
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de l''évènement',
  `log_gravity` tinyint(1) unsigned NOT NULL COMMENT 'Gravité de l''évènement',
  `log_message` text COLLATE utf8_general_ci NOT NULL COMMENT 'Contenu',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Journal des évènements' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_mean_of_login_mol`
--

CREATE TABLE IF NOT EXISTS `ts_mean_of_login_mol` (
  `mol_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du mode de connexion',
  `mol_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom du mode de connexion',
  `mol_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le mode de connexion est supprimé',
  PRIMARY KEY (`mol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Moyens de connexion' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_right_rig`
--

CREATE TABLE IF NOT EXISTS `ts_right_rig` (
  `rig_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du droit',
  `rig_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom du droit',
  `rig_description` text COLLATE utf8_general_ci NOT NULL COMMENT 'Description du droit',
  `rig_admin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 s''il s''agit d''un droit d''administrateur',
  `rig_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le droit est supprimé',
  PRIMARY KEY (`rig_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Droits des utilisateurs' AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_user_usr`
--

CREATE TABLE IF NOT EXISTS `ts_user_usr` (
  `usr_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant utilisateur',
  `usr_pwd` varchar(100) COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Mot de passe',
  `usr_firstname` varchar(40) COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Prénom',
  `usr_lastname` varchar(40) COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Nom',
  `usr_nickname` varchar(200) COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Surnom',
  `usr_adult` int(1) DEFAULT NULL,
  `usr_mail` varchar(200) COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Adresse mail de l''utilisateur',
  `usr_credit` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Crédit',
  `img_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant de l''image',
  `usr_temporary` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 s''il s''agit d''un utilisateur temporaire',
  `usr_fail_auth` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Nombre d''échec d''authentification depuis la dernière réussite',
  `usr_blocked` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''utilisateur est bloqué',
  `usr_msg_perso` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`usr_id`),
  KEY `img_id` (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Utilisateurs' AUTO_INCREMENT=10505 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_fundation_fun`
--

CREATE TABLE IF NOT EXISTS `t_fundation_fun` (
  `fun_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''organisme',
  `fun_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom de l''organisme',
  `fun_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''organisme est supprimé',
  PRIMARY KEY (`fun_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Organismes' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_group_grp`
--

CREATE TABLE IF NOT EXISTS `t_group_grp` (
  `grp_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du groupe',
  `grp_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom du groupe',
  `grp_open` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si un utilisateur peut s''y incrire tout seul',
  `grp_public` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 s''il est utilisable par tous les organismes',
  `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de son organisme',
  `grp_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le groupe est supprimé',
  PRIMARY KEY (`grp_id`),
  KEY `fun_id` (`fun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Groupes d''utilisateurs' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_object_obj`
--

CREATE TABLE IF NOT EXISTS `t_object_obj` (
  `obj_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''objet',
  `obj_name` varchar(100) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom de l''objet',
  `obj_type` enum('product','category','promotion') COLLATE utf8_general_ci NOT NULL COMMENT 'Type de l''objet',
  `obj_stock` int(11) DEFAULT NULL COMMENT 'Stock, NULL si indéfini',
  `obj_single` tinyint(1) unsigned NOT NULL COMMENT '1 si l''objet ne peut être acheté qu''une fois',
  `obj_tva` int(4) NOT NULL COMMENT 'Tva (pas en pourcent mais en pourmille)',
  `obj_alcool` int(1) NOT NULL COMMENT '0 = sans alcool ; 1 = avec alcool',
  `img_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant de son image',
  `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''organisme auquel il est rattaché',
  `obj_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''objet est supprimé',
  PRIMARY KEY (`obj_id`),
  KEY `img_id` (`img_id`),
  KEY `fun_id` (`fun_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Objets' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_oldusr_osr`
--

CREATE TABLE IF NOT EXISTS `t_oldusr_osr` (
  `osr_login` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `osr_credit` float DEFAULT NULL,
  `osr_date` datetime DEFAULT NULL,
  UNIQUE KEY `osr_login` (`osr_login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_paybox_pay`
--

CREATE TABLE IF NOT EXISTS `t_paybox_pay` (
  `pay_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PBX_CMD',
  `usr_id` int(5) NOT NULL COMMENT 'User',
  `pay_step` enum('W','A','V') CHARACTER SET latin1 NOT NULL COMMENT 'Waiting, Aborted, Validated',
  `pay_amount` int(5) NOT NULL COMMENT 'Montant de la transaction (en centimes)',
  `pay_date_create` datetime NOT NULL COMMENT 'Date de lancement de la transaction',
  `pay_date_retour` datetime DEFAULT NULL COMMENT 'Date de réception du retour paybox',
  `pay_auto` varchar(20) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Numéro d''autorisation',
  `pay_trans` varchar(20) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Identifiant de transaction',
  `pay_callback_url` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT 'Que a été la callback url ?',
  `pay_mobile` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=rechargement sur mobile',
  `pay_error` varchar(5) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Code erreur retourné par paubox',
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_period_per`
--

CREATE TABLE IF NOT EXISTS `t_period_per` (
  `per_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la période',
  `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''organisme propriétaire de la période',
  `per_name` text CHARACTER SET utf8 COMMENT 'Nom de la période (optionnel)',
  `per_date_start` datetime NOT NULL COMMENT 'Date et heure de début de la période',
  `per_date_end` datetime NOT NULL COMMENT 'Date et heure de fin de la période',
  `per_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si la période est supprimée',
  PRIMARY KEY (`per_id`),
  KEY `fun_id` (`fun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Périodes de vente' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_plage_pla`
--

CREATE TABLE IF NOT EXISTS `t_plage_pla` (
  `pla_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fun_id` int(11) NOT NULL,
  `poi_id` int(11) NOT NULL,
  `pla_start` int(4) NOT NULL,
  `pla_end` int(4) NOT NULL,
  `pla_name` varchar(100) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pla_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_point_poi`
--

CREATE TABLE IF NOT EXISTS `t_point_poi` (
  `poi_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du point',
  `poi_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom du point',
  `poi_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le point est supprimé',
  PRIMARY KEY (`poi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Points de vente' AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_price_pri`
--

CREATE TABLE IF NOT EXISTS `t_price_pri` (
  `pri_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du prix',
  `obj_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet auquel le prix est rattaché',
  `grp_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant du groupe auquel est rattaché ce prix (NULL si non rattaché)',
  `per_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant de la période durant laquelle ce prix est valable',
  `pri_credit` mediumint(8) unsigned NOT NULL COMMENT 'Valeur du prix',
  `pri_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le prix est supprimé',
  PRIMARY KEY (`pri_id`),
  KEY `obj_id` (`obj_id`),
  KEY `grp_id` (`grp_id`),
  KEY `per_id` (`per_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Prix des objets' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_purchase_pur`
--

CREATE TABLE IF NOT EXISTS `t_purchase_pur` (
  `pur_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''achat',
  `pur_date` datetime NOT NULL COMMENT 'Date et heure de l''achat',
  `pur_type` enum('product','promotion') COLLATE utf8_general_ci NOT NULL DEFAULT 'product' COMMENT 'Type d''achat (produit ou promotion)',
  `obj_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet acheté',
  `pur_price` int(8) unsigned NOT NULL COMMENT 'Prix d''achat',
  `usr_id_buyer` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''acheteur',
  `usr_id_seller` int(11) unsigned NOT NULL COMMENT 'Identifiant du vendeur',
  `poi_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du point de vente',
  `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''organisme vendeur',
  `pur_ip` varchar(15) COLLATE utf8_general_ci NOT NULL COMMENT 'Adresse IP du poste de vente',
  `pur_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''achat a été supprimé',
  PRIMARY KEY (`pur_id`),
  KEY `fun_id` (`fun_id`),
  KEY `poi_id` (`poi_id`),
  KEY `usr_id_buyer` (`usr_id_buyer`),
  KEY `usr_id_seller` (`usr_id_seller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Achats de produits' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_recharge_rec`
--

CREATE TABLE IF NOT EXISTS `t_recharge_rec` (
  `rec_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du rechargement',
  `rty_id` tinyint(3) unsigned NOT NULL COMMENT 'Identifiant du type de rechargement',
  `usr_id_buyer` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''utilisateur qui a été rechargé',
  `usr_id_operator` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''utilisateur qui a procédé au rechargement',
  `poi_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du point de rechargement sur lequel le rechargement a été effectué',
  `rec_date` datetime NOT NULL COMMENT 'Date et heure du rechargement',
  `rec_credit` smallint(5) unsigned NOT NULL COMMENT 'Montant du rechargement',
  `rec_trace` varchar(250) COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Trace comme n° du transfert sherlock''s ou poste client',
  `rec_removed` tinyint(1) unsigned NOT NULL COMMENT '1 si le rechargement est supprimé',
  PRIMARY KEY (`rec_id`),
  KEY `rty_id` (`rty_id`),
  KEY `poi_id` (`poi_id`),
  KEY `usr_id_buyer` (`usr_id_buyer`),
  KEY `usr_id_operator` (`usr_id_operator`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Rechargements' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_recharge_type_rty`
--

CREATE TABLE IF NOT EXISTS `t_recharge_type_rty` (
  `rty_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du type de rechargement',
  `rty_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom du type de rechargement',
  `rty_type` enum('PBUY','SBUY') COLLATE utf8_general_ci DEFAULT NULL COMMENT 'WSDL auquel est rattaché ce type de rechargement',
  `rty_removed` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 si le type de rechargement a été supprimé',
  PRIMARY KEY (`rty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Type de rechargement' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_sale_sal`
--

CREATE TABLE IF NOT EXISTS `t_sale_sal` (
  `sal_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la vente',
  `sal_name` varchar(100) COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Nom de la vente',
  `per_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de la période de vente',
  `obj_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet en vente',
  `sal_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si la vente est supprimée',
  PRIMARY KEY (`sal_id`),
  KEY `per_id` (`per_id`),
  KEY `obj_id` (`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Ventes de produits ou de promotions' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_sherlocks_she`
--

CREATE TABLE IF NOT EXISTS `t_sherlocks_she` (
  `she_id` int(5) NOT NULL AUTO_INCREMENT,
  `usr_id` int(5) NOT NULL,
  `she_step` tinyint(1) NOT NULL,
  `she_amount` int(5) NOT NULL,
  `she_date` datetime NOT NULL,
  `she_parent_id` int(5) DEFAULT NULL,
  `she_state` int(5) NOT NULL,
  `she_trace` text COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`she_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Logs sherlocks' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_virement_vir`
--

CREATE TABLE IF NOT EXISTS `t_virement_vir` (
  `vir_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vir_date` datetime NOT NULL,
  `vir_amount` int(5) NOT NULL,
  `usr_id_from` int(11) NOT NULL,
  `usr_id_to` int(11) NOT NULL,
  PRIMARY KEY (`vir_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Virements entre utilisateurs' AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tj_usr_mol_jum`
--
ALTER TABLE `tj_usr_mol_jum`
  ADD CONSTRAINT `tj_usr_mol_jum_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_mol_jum_ibfk_2` FOREIGN KEY (`mol_id`) REFERENCES `ts_mean_of_login_mol` (`mol_id`) ON DELETE CASCADE ON UPDATE CASCADE;
