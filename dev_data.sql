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


--
-- Contenu de la table `ts_error_err`
--

INSERT INTO `ts_error_err` (`err_code`, `err_name`, `err_description`, `err_removed`) VALUES
(0, 'Vous n''avez pas suffisamment d''argent !', 'Impossible de dépenser plus d''argent que ce dont vous disposez...', 0),
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
(462, 'pas assez de sous', 'Désolé, pas assez d''argent pour acheter cela ! (sois gentil, explique lui comment recharger)', 0),
(463, 'fondation non chargee', 'La fondation n as pas ete chargee', 0),
(464, 'Petit malin', 'Se virer de l''argent à soi même n''a aucun sens... ', 0),
(465, 'Destinataire du virement inexistant', 'La personne à qui vous souhaitez verser de l''argent n''existe pas...', 0),
(466, 'Le vol d''argent n''est pas toléré ici !', 'Cette tentative à été enregistré...', 0),
(467, 'Utilisateur non cotisant', 'payutc est réservé aux cotisants du BDE, tu dois être cotisant pour recharger. Contacte le BDE pour savoir comment cotiser.', 0);


--
-- Contenu de la table `ts_mean_of_login_mol`
--

INSERT INTO `ts_mean_of_login_mol` (`mol_id`, `mol_name`, `mol_removed`) VALUES
(1, 'login etu', 0),
(2, 'id etudiant', 0),
(3, 'id buckutt', 0),
(4, 'carte_etu', 0),
(5, 'uid_carte_utc', 0);

--
-- Contenu de la table `ts_right_rig`
--

INSERT INTO `ts_right_rig` (`rig_id`, `rig_name`, `rig_description`, `rig_admin`, `rig_removed`) VALUES
(1, 'bloqueur', 'blockman et deblockman de compte of buckutt', 1, 0),
(2, 'fund_trezo', 'accede aux bilans financier de la fundation ! (id_fundation neccessaire)', 0, 0),
(4, 'reloader', 'le rechargeur qui a le droit de mettre des tunes !', 1, 0),
(5, 'droit_admin', 'le chef de buckutt qui peut donner ou retirer tout les droits de tout buckutt in all the universe !', 1, 0),
(6, 'fund_chef', 'le chef d''une fondation, ce droit donne le droit de donner des droits concernant sa propre fundation (donc liï¿½ï¿½un id_fundation)', 0, 0),
(7, 'buckutt_trezo', 'le tresorier de tout buckutt tout complet !', 1, 0),
(8, 'credit_admin', 'le mec qui fait ce qu''il veut sur les credits des gens, il mets et retire ï¿½l''oeil !', 1, 0),
(9, 'point_admin', 'le mec qui a le pouvoir d''ajouter et supprimer des points, c''est un truc au dessus des fundation', 1, 0),
(10, 'vente_admin', 'le mec qui a le droit d''ajouter/supprimer des objets, des categories, des prix et des ventes sur le compte de sa fundation (id_fundation neccessaire)', 0, 0),
(11, 'seller', 'le vendeur d''une fundation (id_point + id_fundation neccessaires)', 0, 0),
(13, 'resp_fundations', 'le monsieur qui dit qui a le droit de gerer quelle fundation (resp c&a du bde par exemple)', 1, 0),
(14, 'group_editor', 'le mec qui a le droit de creer des groupes pour le compte de sa fundation (liï¿½ï¿½un id_fundation) (ex le mec qui entre les cotisants bde)', 0, 0),
(15, 'mode_manuel', 'droit d''ajouter des id sur peggy sans badger', 1, 0);

--
-- Contenu de la table `t_recharge_type_rty`
--

INSERT INTO `t_recharge_type_rty` (`rty_id`, `rty_name`, `rty_type`, `rty_removed`) VALUES
(1, 'TPE', 'PBUY', 0),
(2, 'Espece', 'PBUY', 0),
(3, 'Internet', 'SBUY', 0),
(4, 'Cheque', 'PBUY', 0),
(5, 'Nature', NULL, 0),
(6, 'Ecocup', NULL, 0),
(7, 'Report', NULL, 0);

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
(NULL, NULL, "Il y a une vie après les cours");

--
-- Contenu de la table `t_point_poi`
--

INSERT INTO `t_point_poi` (`poi_id`, `poi_name`, `poi_removed`) VALUES
(1, 'PAYBOX', 0),
(46, 'Caisse Pic 1', 0),
(47, 'Caisse Pic 2', 0),
(48, 'Smartphone 1', 0),
(49, 'Smartphone 2', 0),
(50, 'Internet cotisation BDE', 0),
(51, 'Caisse du pic', 0);


--
-- Contenu de la table `t_object_obj`
--

INSERT INTO `t_object_obj` (`obj_id`, `obj_name`, `obj_type`, `obj_stock`, `obj_single`, `obj_tva`, `obj_alcool`, `img_id`, `fun_id`, `obj_removed`) VALUES
(1, 'Softs', 'category', NULL, 0, 0, 0, NULL, 2, 0),
(2, 'Coca', 'product', 20, 0, 0, 0, NULL, 2, 0);

--
-- Contenu de la table `tj_object_link_oli`
--

INSERT INTO `tj_object_link_oli` (`oli_id`, `obj_id_parent`, `obj_id_child`, `oli_step`, `oli_removed`) VALUES
(1, 1, 2, 0, 0);


--
-- Contenu de la table `t_price_pri`
--

INSERT INTO `t_price_pri` (`pri_id`, `obj_id`, `grp_id`, `per_id`, `pri_credit`, `pri_removed`) VALUES
(1, 2, NULL, NULL, 70, 0);


--
-- Contenu de la table `ts_user_usr`
--

INSERT INTO `ts_user_usr` (`usr_id`, `usr_pwd`, `usr_firstname`, `usr_lastname`, `usr_nickname`, `usr_adult`, `usr_mail`, `usr_credit`, `img_id`, `usr_temporary`, `usr_fail_auth`, `usr_blocked`, `usr_msg_perso`) VALUES
(9447, '81dc9bdb52d04dc20036dbd8313ed055', 'Matthieu', 'GUFFROY', 'mguffroy', 1, 'matthieu.guffroy@etu.utc.fr', 156, NULL, 0, 0, 0, 'Hello World Ceci est un message super long ...... Plus de 54caracteres il parrait !');


--
-- Contenu de la table `tj_usr_mol_jum`
--

INSERT INTO `tj_usr_mol_jum` (`usr_id`, `mol_id`, `jum_data`) VALUES
(9447, 1, 'mguffroy'),
(9447, 5, 'ABABABAB');

--
-- Contenu de la table `tj_usr_rig_jur`
--

INSERT INTO `tj_usr_rig_jur` (`jur_id`, `usr_id`, `rig_id`, `per_id`, `fun_id`, `poi_id`, `jur_removed`) VALUES
(1, 9447, 2, NULL, 2, NULL, 0),
(6, NULL, 7, NULL, 2, 51, 0),
(21, NULL, 7, NULL, 2, 46, 0),
(27, 9447, 5, NULL, 2, NULL, 0);


--
-- Contenu de la table `t_oldusr_osr`
--

INSERT INTO `t_oldusr_osr` (`osr_login`, `osr_credit`, `osr_date`) VALUES
('puyouart', 465, '2012-06-15 20:46:45');
