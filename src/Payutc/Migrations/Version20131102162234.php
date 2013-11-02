<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Remove tables for old rights
 */
class Version20131102162234 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("DROP TABLE `tj_usr_rig_jur`;");
    }

    public function down(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `tj_usr_rig_jur` (
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
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Liens entre utilisateurs et droits';");
    }
}
