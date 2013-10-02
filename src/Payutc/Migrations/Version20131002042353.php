<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20131002042353 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `t_external_data_exd` (
              `exd_id` int(11) NOT NULL AUTO_INCREMENT,
              `fun_id` int(11) unsigned NOT NULL,
              `usr_id` int(11) unsigned,
              `exd_key` varchar(128) NOT NULL,
              `exd_val` varchar(1024) NOT NULL,
              `exd_inserted` datetime NOT NULL,
              `exd_removed` datetime,
              PRIMARY KEY (`exd_id`),
              KEY `fun_id` (`fun_id`),
              KEY `usr_id` (`usr_id`),
              KEY `exd_key` (`exd_key`(127))
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
        $this->addSql("            
            ALTER TABLE `t_external_data_exd`
              ADD CONSTRAINT `t_external_data_exd_ibfk_2` FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`),
              ADD CONSTRAINT `t_external_data_exd_ibfk_1` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE `t_external_data_exd`;");
    }
}
