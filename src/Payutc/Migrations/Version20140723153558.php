<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Add a column to know if an article is exclusively open to cotisant
 */
class Version20140723153558 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_object_obj`
            ADD `obj_cotisant` INT(1) NOT NULL DEFAULT '1' COMMENT 'Is this object cotisant only' AFTER `obj_alcool`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_object_obj`
            DROP `obj_cotisant`");
    }
}
