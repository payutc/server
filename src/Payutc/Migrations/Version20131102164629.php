<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Remove t_recharge_type_rty
 * This only migrates rty_id Internet (3) and Report (7)
 * If you have other types, you will need to do some manual work
 */
class Version20131102164629 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_recharge_rec`
            ADD `rec_type` ENUM('Internet', 'Report') NOT NULL COMMENT 'Type de rechargement' AFTER `rty_id`");
        
        $this->addSql("UPDATE `t_recharge_rec` SET `rec_type` = 'Internet' WHERE `rty_id` = 3");
        $this->addSql("UPDATE `t_recharge_rec` SET `rec_type` = 'Report' WHERE `rty_id` = 7");
        
        $this->addSql("ALTER TABLE `t_recharge_rec` DROP `rty_id`");
        
        $this->addSql("DROP TABLE `t_recharge_type_rty`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `t_recharge_type_rty` (
          `rty_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du type de rechargement',
          `rty_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom du type de rechargement',
          `rty_type` enum('PBUY','SBUY') COLLATE utf8_general_ci DEFAULT NULL COMMENT 'WSDL auquel est rattaché ce type de rechargement',
          `rty_removed` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 si le type de rechargement a été supprimé',
          PRIMARY KEY (`rty_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Type de rechargement';");

        $this->addSql("ALTER TABLE `t_recharge_rec`
            ADD `rty_id` tinyint(3) unsigned NOT NULL COMMENT 'Identifiant du type de rechargement' AFTER `rec_type`");

        $this->addSql("INSERT INTO `t_recharge_type_rty` (`rty_id`, `rty_name`, `rty_type`, `rty_removed`) VALUES
            (3, 'Internet', 'SBUY', 0),
            (7, 'Report', NULL, 0)");

        $this->addSql("UPDATE `t_recharge_rec` SET `rty_id` = 3 WHERE `rec_type` LIKE 'Internet'");
        $this->addSql("UPDATE `t_recharge_rec` SET `rty_id` = 7 WHERE `rec_type` LIKE 'Report'");
        
        $this->addSql("ALTER TABLE `t_recharge_rec` DROP `rec_type`");

    }
}
