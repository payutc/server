<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20140501131011 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_price_pri` ADD  `pri_tva` DECIMAL( 5, 2 ) NOT NULL DEFAULT  '0' AFTER  `pri_credit`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_price_pri` DROP `pri_tva`;");
    }
}
