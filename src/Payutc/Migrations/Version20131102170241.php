<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Delete t_point_poi
 */
class Version20131102170241 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("DROP TABLE `t_point_poi`;");
    }

    public function down(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `t_point_poi` (
          `poi_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du point',
          `poi_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom du point',
          `poi_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le point est supprimé',
          PRIMARY KEY (`poi_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Points de vente';");
    }
}
