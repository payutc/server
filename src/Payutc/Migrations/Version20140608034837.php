<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Tâches â exécuter hors du process web : 
 */
class Version20140608034837 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE t_task_tas (
            `tas_id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
            `tas_created_at` DATETIME NOT NULL DEFAULT NOW(),
            `tas_type` VARCHAR(15) NOT NULL COMMENT 'Type de la tâche',
            `tas_message` VARCHAR(255) COLLATE utf8_general_ci,
            `tas_user` INT(11) unsigned,
            `tas_url` VARCHAR(255) COMMENT 'Url de callback à appeler',
            PRIMARY KEY (`tas_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Tâches à exécuter';");
        $this->addSql("ALTER TABLE t_task_tas ADD CONSTRAINT `t_task_tas_ibfk_1` FOREIGN KEY (`tas_user`) REFERENCES `ts_user_usr` (`usr_id`);");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE t_task_tas;");
    }
}
