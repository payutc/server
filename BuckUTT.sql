-- phpMyAdmin SQL Dump
-- version 3.4.7.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 13 Décembre 2011 à 11:35
-- Version du serveur: 5.1.58
-- Version de PHP: 5.3.8-1+b1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `buckutt`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Liens entre objets' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tj_obj_poi_jop`
--

CREATE TABLE IF NOT EXISTS `tj_obj_poi_jop` (
  `obj_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet',
  `jop_priority` int(11) NOT NULL DEFAULT '100',
  `poi_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du point de vente',
  PRIMARY KEY (`obj_id`,`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Disponibilité du produit en fonction du point';

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Liens d''appartenance des utilisateurs aux groupes' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tj_usr_mol_jum`
--

CREATE TABLE IF NOT EXISTS `tj_usr_mol_jum` (
  `usr_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `mol_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du mode de connexion (type de mean_of_login)',
  `jum_data` varchar(200) COLLATE utf8_bin NOT NULL COMMENT 'Identifiant concret de l''utilisateur (login, idEtu...)',
  PRIMARY KEY (`usr_id`,`mol_id`,`jum_data`),
  KEY `mol_id` (`mol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Différents identifiants des utilisateurs';

-- --------------------------------------------------------

--
-- Structure de la table `tj_usr_rig_jur`
--

CREATE TABLE IF NOT EXISTS `tj_usr_rig_jur` (
  `jur_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant',
  `usr_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''utilisateur',
  `rig_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du droit',
  `per_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de la période pour le droit',
  `fun_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant de l''organisme (optionnel)',
  `poi_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant du point (optionnel)',
  `jur_removed` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le droit est supprimé',
  PRIMARY KEY (`jur_id`),
  KEY `usr_id` (`usr_id`),
  KEY `rig_id` (`rig_id`),
  KEY `per_id` (`per_id`),
  KEY `fun_id` (`fun_id`),
  KEY `poi_id` (`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Liens entre utilisateurs et droits' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_callback_cal`
--

CREATE TABLE IF NOT EXISTS `ts_callback_cal` (
  `cal_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du callback',
  `pro_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du produit acheté',
  `cal_request` varchar(250) COLLATE utf8_bin NOT NULL COMMENT 'Requête HTTP à effectuer lors de l''achat',
  `mol_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du moyen de connexion à envoyer',
  `cal_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le callback est supprimé',
  PRIMARY KEY (`cal_id`),
  KEY `pro_id` (`pro_id`),
  KEY `mol_id` (`mol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Callback à exécuter lors de l''achat de certains produits' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_error_err`
--

CREATE TABLE IF NOT EXISTS `ts_error_err` (
  `err_code` int(5) unsigned NOT NULL COMMENT 'Code de l''erreur',
  `err_name` varchar(40) COLLATE utf8_bin NOT NULL COMMENT 'Nom de l''erreur',
  `err_description` text COLLATE utf8_bin NOT NULL COMMENT 'Description de l''erreur',
  `err_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''erreur est supprimée',
  PRIMARY KEY (`err_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Erreurs rencontrables lors de l''utilisation';

--
-- Contenu de la table `ts_error_err`
--

INSERT INTO `ts_error_err` (`err_code`, `err_name`, `err_description`, `err_removed`) VALUES
(400, 'erreur inconue', 'euhhh erreur trop compliquée pour qu''on ai envie de la résoudre', 0),
(401, 'erreur fatale', 'erreur qui normalement on a absolument jamais (genre un truc qui doit marcher à tout les coups mais ça marche pas ou autre)', 0),
(402, 'proposition inexistante', 'proposition donnée pour buy n''existe pas en fait, erreur de traitement coté client ou probleme de session => regenerer les propositions avec getxxxpropositions', 0),
(403, 'utilisateur bloque', 'Utilisateur bloqué (3 codes faux ou blocage volontaire sur le site étu). Déblocage possible au BDE.', 0),
(404, 'seller pas le droit', 'Désolé, tu n''es pas autorisé à vendre ici.', 0),
(405, 'utilisateur non trouvé', 'Utilisateur non trouvé ou carte non reconnue.', 0),
(406, 'password faux', 'Mot de passe incorrect.', 0),
(407, 'droits buckutt absents', 't''as cru que t''etais buckutt_admin mais en fait non !', 0),
(408, 'seller pas chargé', 'Délai d''inactivité dépassé. Il faut te reconnecter ! (bref, le seller est pas isset, donc, ça marche pô)', 0),
(409, 'pas de buyer', 'Acheteur perdu. Il faut repasser sa carte.', 0),
(410, 'promo objets deja liste', 'on demande les objets du step suivant de la promo alors qu''on les a déjà tous fait !', 0),
(411, 'promo corrompue', 'la promo est corrompue, ya ni objet ni categorie mais ya bien un step', 0),
(412, 'pruduit absent de la promo', 'c con, ya des trucs mais à ce point là ya rien de dispo (c pas forcement une mauvaise config, ex : pu du tout de canette au foyer mais promo à 1€ encore visible et à gerer ça serait bien trop lourd)', 0),
(413, 'erreur sql dans une promo', 'erreur sql zarb dans getObjects de promo', 0),
(414, 'action pas terminee', 'Tu dois terminer de saisir les produits de la promo avant de cliquer sur terminer!', 0),
(415, 'pu de stock pour promo', 'ya une etape dans la promo où ya pu rien du tout et du coup ça peut pas marche', 0),
(419, 'pas de stock', 'Plus de produit en stock, désolé !', 0),
(420, 'point inexistant', 'le point il existe pas chez moi !', 0),
(421, 'fundation inexistante', 'la fundation elle existe pas chez moi !', 0),
(422, 'Image inexistante', 'L''image n''existe pas chez moi !', 0),
(423, 'preseller pas chargé', 'ça sert à rien de le reclamer, il a pas été loadé le preseller !', 0),
(424, 'seller ne peut recharger', 'le seller n''est pas capable de reloader alors fuck !', 0),
(430, 'erreur non repertoriée !', 'va falloir appeller un buckutt admin !', 0),
(440, 'L''utilisateur n''existe pas', 'L''utilisateur n''existe pas', 0),
(441, 'Il ne s''agit pas du bon code PIN', 'Code PIN incorrect !', 0),
(450, 'compte deja max', 'Le plafond maximum autorisé est atteint.', 0),
(451, 'rechargement trop important', 'Impossible de recharger autant, tu dépasserais le plafond maximum.', 0),
(452, 'type recharge inexistant', 'on veut recharger par un moyen qui n''existe pas alors moi je dis tu bluff !', 0),
(453, 'droit inexistant', 'ce droit n''est pas un droit ! c''est pas que le mec ne l''a pas c''est plutôt qu''on sait même pas ce que c''est !!', 0),
(454, 'nest pas reloader', 'Tu n''as pas le droit de recharger des comptes.', 0),
(455, 'pas point manager', 'ne peut pas bouger de point, il n''en a pas le droit', 0),
(456, 'nest pas autorisé ici', 'Aucun accès BuckUTT pour ce point.', 0),
(457, 'pas mode manuel', 'n''a pas le droit d''ajouter des id manuellement', 0),
(459, 'promo en cours', 'Tu dois finir de sélectionner les produits de la promo.', 0),
(460, 'Instance déjà existante', 'L''objet, vente, groupe, prix, catégorie... en création existe déjà.', 0),
(461, 'prix pu dactualite', 'Le prix a changé depuis tout à l''heure.', 0),
(462, 'pas assez de sous', 'Désolé, pas assez d''argent pour acheter cela ! (sois gentil, explique lui comment recharger)', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ts_image_img`
--

CREATE TABLE IF NOT EXISTS `ts_image_img` (
  `img_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''image',
  `img_mime` varchar(20) COLLATE utf8_bin NOT NULL COMMENT 'Format de l''image',
  `img_width` int(5) unsigned NOT NULL COMMENT 'Largeur de l''image',
  `img_length` int(5) unsigned NOT NULL COMMENT 'Longueur de l''image',
  `img_content` mediumblob NOT NULL COMMENT 'Contenu de l''image',
  `img_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''image est supprimée',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Images des utilisateurs et des produits' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_log_log`
--

CREATE TABLE IF NOT EXISTS `ts_log_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du log',
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de l''évènement',
  `log_gravity` tinyint(1) unsigned NOT NULL COMMENT 'Gravité de l''évènement',
  `log_message` text COLLATE utf8_bin NOT NULL COMMENT 'Contenu',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Journal des évènements' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_mean_of_login_mol`
--

CREATE TABLE IF NOT EXISTS `ts_mean_of_login_mol` (
  `mol_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du mode de connexion',
  `mol_name` varchar(40) COLLATE utf8_bin NOT NULL COMMENT 'Nom du mode de connexion',
  `mol_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le mode de connexion est supprimé',
  PRIMARY KEY (`mol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Moyens de connexion' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_right_rig`
--

CREATE TABLE IF NOT EXISTS `ts_right_rig` (
  `rig_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du droit',
  `rig_name` varchar(40) COLLATE utf8_bin NOT NULL COMMENT 'Nom du droit',
  `rig_description` text COLLATE utf8_bin NOT NULL COMMENT 'Description du droit',
  `rig_admin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 s''il s''agit d''un droit d''administrateur',
  `rig_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le droit est supprimé',
  PRIMARY KEY (`rig_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Droits des utilisateurs' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ts_user_usr`
--

CREATE TABLE IF NOT EXISTS `ts_user_usr` (
  `usr_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant utilisateur',
  `usr_pwd` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'Mot de passe',
  `usr_firstname` varchar(40) COLLATE utf8_bin DEFAULT NULL COMMENT 'Prénom',
  `usr_lastname` varchar(40) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nom',
  `usr_nickname` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT 'Surnom',
  `usr_mail` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT 'Adresse mail de l''utilisateur',
  `usr_credit` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Crédit',
  `img_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant de l''image',
  `usr_temporary` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 s''il s''agit d''un utilisateur temporaire',
  `usr_fail_auth` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Nombre d''échec d''authentification depuis la dernière réussite',
  `usr_blocked` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''utilisateur est bloqué',
  PRIMARY KEY (`usr_id`),
  KEY `img_id` (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Utilisateurs' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_fundation_fun`
--

CREATE TABLE IF NOT EXISTS `t_fundation_fun` (
  `fun_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''organisme',
  `fun_name` varchar(40) COLLATE utf8_bin NOT NULL COMMENT 'Nom de l''organisme',
  `fun_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''organisme est supprimé',
  PRIMARY KEY (`fun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Organismes' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_group_grp`
--

CREATE TABLE IF NOT EXISTS `t_group_grp` (
  `grp_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du groupe',
  `grp_name` varchar(40) COLLATE utf8_bin NOT NULL COMMENT 'Nom du groupe',
  `grp_open` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si un utilisateur peut s''y incrire tout seul',
  `grp_public` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 s''il est utilisable par tous les organismes',
  `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de son organisme',
  `grp_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le groupe est supprimé',
  PRIMARY KEY (`grp_id`),
  KEY `fun_id` (`fun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Groupes d''utilisateurs' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_object_obj`
--

CREATE TABLE IF NOT EXISTS `t_object_obj` (
  `obj_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''objet',
  `obj_name` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Nom de l''objet',
  `obj_type` enum('product','category','promotion') COLLATE utf8_bin NOT NULL COMMENT 'Type de l''objet',
  `obj_stock` int(11) NOT NULL COMMENT 'Stock, -1 si indéfini',
  `obj_single` tinyint(1) unsigned NOT NULL COMMENT '1 si l''objet ne peut être acheté qu''une fois',
  `img_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant de son image',
  `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''organisme auquel il est rattaché',
  `obj_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''objet est supprimé',
  PRIMARY KEY (`obj_id`),
  KEY `img_id` (`img_id`),
  KEY `fun_id` (`fun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Objets' AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Périodes de vente' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_point_poi`
--

CREATE TABLE IF NOT EXISTS `t_point_poi` (
  `poi_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du point',
  `poi_name` varchar(40) COLLATE utf8_bin NOT NULL COMMENT 'Nom du point',
  `poi_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le point est supprimé',
  PRIMARY KEY (`poi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Points de vente' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_price_pri`
--

CREATE TABLE IF NOT EXISTS `t_price_pri` (
  `pri_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du prix',
  `obj_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet auquel le prix est rattaché',
  `grp_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant du groupe auquel est rattaché ce prix (NULL si non rattaché)',
  `per_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de la période durant laquelle ce prix est valable',
  `pri_credit` mediumint(8) unsigned NOT NULL COMMENT 'Valeur du prix',
  `pri_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le prix est supprimé',
  PRIMARY KEY (`pri_id`),
  KEY `obj_id` (`obj_id`),
  KEY `grp_id` (`grp_id`),
  KEY `per_id` (`per_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Prix des objets' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_purchase_pur`
--

CREATE TABLE IF NOT EXISTS `t_purchase_pur` (
  `pur_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de l''achat',
  `pur_date` datetime NOT NULL COMMENT 'Date et heure de l''achat',
  `pur_type` enum('product','promotion') COLLATE utf8_bin NOT NULL DEFAULT 'product' COMMENT 'Type d''achat (produit ou promotion)',
  `obj_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet acheté',
  `pur_price` int(8) unsigned NOT NULL COMMENT 'Prix d''achat',
  `usr_id_buyer` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''acheteur',
  `usr_id_seller` int(11) unsigned NOT NULL COMMENT 'Identifiant du vendeur',
  `poi_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du point de vente',
  `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''organisme vendeur',
  `pur_ip` varchar(15) COLLATE utf8_bin NOT NULL COMMENT 'Adresse IP du poste de vente',
  `pur_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''achat a été supprimé',
  PRIMARY KEY (`pur_id`),
  KEY `fun_id` (`fun_id`),
  KEY `poi_id` (`poi_id`),
  KEY `usr_id_buyer` (`usr_id_buyer`),
  KEY `usr_id_seller` (`usr_id_seller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Achats de produits' AUTO_INCREMENT=1 ;

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
  `rec_trace` varchar(250) COLLATE utf8_bin DEFAULT NULL COMMENT 'Trace comme n° du transfert sherlock''s ou poste client',
  `rec_removed` tinyint(1) unsigned NOT NULL COMMENT '1 si le rechargement est supprimé',
  PRIMARY KEY (`rec_id`),
  KEY `rty_id` (`rty_id`),
  KEY `poi_id` (`poi_id`),
  KEY `usr_id_buyer` (`usr_id_buyer`),
  KEY `usr_id_operator` (`usr_id_operator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Rechargements' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_recharge_type_rty`
--

CREATE TABLE IF NOT EXISTS `t_recharge_type_rty` (
  `rty_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du type de rechargement',
  `rty_name` varchar(40) COLLATE utf8_bin NOT NULL COMMENT 'Nom du type de rechargement',
  `rty_type` enum('PBUY','SBUY') COLLATE utf8_bin DEFAULT NULL COMMENT 'WSDL auquel est rattaché ce type de rechargement',
  `rty_removed` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 si le type de rechargement a été supprimé',
  PRIMARY KEY (`rty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Type de rechargement' AUTO_INCREMENT=7 ;

--
-- Contenu de la table `t_recharge_type_rty`
--

INSERT INTO `t_recharge_type_rty` (`rty_id`, `rty_name`, `rty_type`, `rty_removed`) VALUES
(1, 'TPE', 'PBUY', 0),
(2, 'Espece', 'PBUY', 0),
(3, 'Internet', 'SBUY', 0),
(4, 'Cheque', 'PBUY', 0),
(5, 'Nature', NULL, 0),
(6, 'Ecocup', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `t_sale_sal`
--

CREATE TABLE IF NOT EXISTS `t_sale_sal` (
  `sal_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la vente',
  `sal_name` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nom de la vente',
  `per_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de la période de vente',
  `obj_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet en vente',
  `sal_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si la vente est supprimée',
  PRIMARY KEY (`sal_id`),
  KEY `per_id` (`per_id`),
  KEY `obj_id` (`obj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Ventes de produits ou de promotions' AUTO_INCREMENT=1 ;

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
  `she_trace` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`she_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Logs sherlocks' AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tj_usr_mol_jum`
--
ALTER TABLE `tj_usr_mol_jum`
  ADD CONSTRAINT `tj_usr_mol_jum_ibfk_2` FOREIGN KEY (`mol_id`) REFERENCES `ts_mean_of_login_mol` (`mol_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_mol_jum_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tj_usr_rig_jur`
--
ALTER TABLE `tj_usr_rig_jur`
  ADD CONSTRAINT `tj_usr_rig_jur_ibfk_5` FOREIGN KEY (`rig_id`) REFERENCES `ts_right_rig` (`rig_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_rig_jur_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_rig_jur_ibfk_2` FOREIGN KEY (`per_id`) REFERENCES `t_period_per` (`per_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_rig_jur_ibfk_3` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tj_usr_rig_jur_ibfk_4` FOREIGN KEY (`poi_id`) REFERENCES `t_point_poi` (`poi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ts_user_usr`
--
ALTER TABLE `ts_user_usr`
  ADD CONSTRAINT `ts_user_usr_ibfk_1` FOREIGN KEY (`img_id`) REFERENCES `ts_image_img` (`img_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `t_group_grp`
--
ALTER TABLE `t_group_grp`
  ADD CONSTRAINT `t_group_grp_ibfk_1` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_object_obj`
--
ALTER TABLE `t_object_obj`
  ADD CONSTRAINT `t_object_obj_ibfk_1` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_period_per`
--
ALTER TABLE `t_period_per`
  ADD CONSTRAINT `t_period_per_ibfk_1` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_sale_sal`
--
ALTER TABLE `t_sale_sal`
  ADD CONSTRAINT `t_sale_sal_ibfk_2` FOREIGN KEY (`per_id`) REFERENCES `t_period_per` (`per_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_sale_sal_ibfk_1` FOREIGN KEY (`obj_id`) REFERENCES `t_object_obj` (`obj_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
