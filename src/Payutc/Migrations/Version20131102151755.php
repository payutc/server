<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Remove tables for PlageHoraire class
 */
class Version20131102151755 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("DROP TABLE `t_plage_pla`;");
    }

    public function down(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `t_plage_pla` (
          `pla_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `fun_id` int(11) NOT NULL,
          `poi_id` int(11) NOT NULL,
          `pla_start` int(4) NOT NULL,
          `pla_end` int(4) NOT NULL,
          `pla_name` varchar(100) COLLATE utf8_general_ci NOT NULL,
          PRIMARY KEY (`pla_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");
    }
}
