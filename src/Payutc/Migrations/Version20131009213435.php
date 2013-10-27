<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20131009213435 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("DROP TABLE `ts_callback_cal`");
        $this->addSql("DROP TABLE `tj_obj_poi_jop`");
        $this->addSql("DROP TABLE `tj_usr_grp_jug`");
        $this->addSql("DROP TABLE `ts_log_log`");
        $this->addSql("DROP TABLE `t_group_grp`");
        $this->addSql("DROP TABLE `t_period_per`");
        $this->addSql("DROP TABLE `t_sale_sal`");
        $this->addSql("DROP TABLE `t_sherlocks_she`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `ts_callback_cal` (
          `cal_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du callback',
          `pro_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du produit acheté',
          `cal_request` varchar(250) COLLATE utf8_general_ci NOT NULL COMMENT 'Requête HTTP à effectuer lors de l''achat',
          `mol_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du moyen de connexion à envoyer',
          `cal_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le callback est supprimé',
          PRIMARY KEY (`cal_id`),
          KEY `pro_id` (`pro_id`),
          KEY `mol_id` (`mol_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Callback à exécuter lors de l''achat de certains produits';");
        
        $this->addSql("CREATE TABLE IF NOT EXISTS `tj_obj_poi_jop` (
          `obj_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet',
          `jop_priority` int(11) NOT NULL DEFAULT '100',
          `poi_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du point de vente',
          PRIMARY KEY (`obj_id`,`poi_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Disponibilité du produit en fonction du point';");
        
        $this->addSql("CREATE TABLE IF NOT EXISTS `tj_usr_grp_jug` (
          `jug_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant',
          `usr_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''utilisateur',
          `grp_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du groupe',
          `per_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de la période pour le groupe',
          `jug_removed` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le lien est supprimé',
          PRIMARY KEY (`jug_id`),
          KEY `per_id` (`per_id`),
          KEY `grp_id` (`grp_id`),
          KEY `usr_id` (`usr_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Liens d''appartenance des utilisateurs aux groupes';");
        
        $this->addSql("CREATE TABLE IF NOT EXISTS `ts_log_log` (
          `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du log',
          `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date et heure de l''évènement',
          `log_gravity` tinyint(1) unsigned NOT NULL COMMENT 'Gravité de l''évènement',
          `log_message` text COLLATE utf8_general_ci NOT NULL COMMENT 'Contenu',
          PRIMARY KEY (`log_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Journal des évènements';");
        
        $this->addSql("CREATE TABLE IF NOT EXISTS `t_group_grp` (
          `grp_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du groupe',
          `grp_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom du groupe',
          `grp_open` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si un utilisateur peut s''y incrire tout seul',
          `grp_public` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 s''il est utilisable par tous les organismes',
          `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de son organisme',
          `grp_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le groupe est supprimé',
          PRIMARY KEY (`grp_id`),
          KEY `fun_id` (`fun_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Groupes d''utilisateurs';");
        
        $this->addSql("CREATE TABLE IF NOT EXISTS `t_period_per` (
          `per_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la période',
          `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''organisme propriétaire de la période',
          `per_name` text CHARACTER SET utf8 COMMENT 'Nom de la période (optionnel)',
          `per_date_start` datetime NOT NULL COMMENT 'Date et heure de début de la période',
          `per_date_end` datetime NOT NULL COMMENT 'Date et heure de fin de la période',
          `per_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si la période est supprimée',
          PRIMARY KEY (`per_id`),
          KEY `fun_id` (`fun_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Périodes de vente';");
        
        $this->addSql("CREATE TABLE IF NOT EXISTS `t_sale_sal` (
          `sal_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de la vente',
          `sal_name` varchar(100) COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Nom de la vente',
          `per_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de la période de vente',
          `obj_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''objet en vente',
          `sal_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si la vente est supprimée',
          PRIMARY KEY (`sal_id`),
          KEY `per_id` (`per_id`),
          KEY `obj_id` (`obj_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Ventes de produits ou de promotions';");
        
        $this->addSql("CREATE TABLE IF NOT EXISTS `t_sherlocks_she` (
          `she_id` int(5) NOT NULL AUTO_INCREMENT,
          `usr_id` int(5) NOT NULL,
          `she_step` tinyint(1) NOT NULL,
          `she_amount` int(5) NOT NULL,
          `she_date` datetime NOT NULL,
          `she_parent_id` int(5) DEFAULT NULL,
          `she_state` int(5) NOT NULL,
          `she_trace` text COLLATE utf8_general_ci NOT NULL,
          PRIMARY KEY (`she_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Logs sherlocks';");
    }
}
