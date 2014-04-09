<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20140405145243 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `t_reversement_rev` (
          `rev_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du reversement',
          `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de la fundation',
          `rev_step` enum('W','A','V') NOT NULL COMMENT 'Waiting, Aborted, Validated',
          `rev_date_created` datetime DEFAULT NULL,
          `rev_date_updated` datetime DEFAULT NULL,
          `usr_id_ask` int(11) NOT NULL,
          `usr_id_done` int(11) DEFAULT NULL,
          `rev_amount` int(9) DEFAULT NULL,
          `rev_taux` int(4) DEFAULT NULL,
          `rev_frais` int(9) DEFAULT NULL,

          PRIMARY KEY (`rev_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Reversement';");

		$this->addSql("ALTER TABLE `t_reversement_rev`
          ADD CONSTRAINT `tj_fun_rev_jum_ibfk` FOREIGN KEY (`fun_id`) REFERENCES `t_fundation_fun` (`fun_id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE `t_reversement_rev`;");
    }
}
