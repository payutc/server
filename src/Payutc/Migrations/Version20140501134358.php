<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20140501134358 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `t_purchase_pur` ADD  `pur_tva` DECIMAL( 5, 2 ) NOT NULL DEFAULT  '0' AFTER  `pur_price` ,
ADD  `pur_amount_tva` INT( 8 ) NOT NULL DEFAULT  '0' AFTER  `pur_tva`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_purchase_pur` DROP `pur_tva`, `pur_amount_tva`;");
    }
}
