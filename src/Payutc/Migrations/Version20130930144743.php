<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130930144743 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("DROP TABLE `t_oldusr_osr`");
    }

    public function down(Schema $schema)
    {
      $this->addSql("CREATE TABLE IF NOT EXISTS `t_oldusr_osr` (
        `osr_login` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
        `osr_credit` float DEFAULT NULL,
        `osr_date` datetime DEFAULT NULL,
        UNIQUE KEY `osr_login` (`osr_login`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");
    }
}
