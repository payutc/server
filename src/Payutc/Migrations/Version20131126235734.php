<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20131126235734 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_purchase_pur`
ADD `pur_reduction` FLOAT NULL DEFAULT NULL AFTER `pur_unit_price`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_purchase_pur`
DROP `pur_reduction`;");
    }
}