<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130829233731 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_purchase_pur`
          ADD `pur_qte` INT UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Nombre d''object acheté' AFTER `obj_id` ,
          ADD `pur_unit_price` INT UNSIGNED NOT NULL COMMENT 'Prix unitaire de l''object acheté' AFTER `pur_qte`");
        $this->addSql("UPDATE `t_purchase_pur` SET `pur_unit_price` = `pur_price`, pur_qte = 1 WHERE pur_unit_price = 0");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_purchase_pur2`
          DROP `pur_qte`,
          DROP `pur_unit_price`;");
    }
}
