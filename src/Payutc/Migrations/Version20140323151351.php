<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20140323151351 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_price_pri` DROP `grp_id`, DROP `per_id`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_price_pri`
          ADD `grp_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant du groupe auquel est rattaché ce prix (NULL si non rattaché)' AFTER  `obj_id`,
          ADD `per_id` int(11) unsigned DEFAULT NULL COMMENT 'Identifiant de la période durant laquelle ce prix est valable' AFTER `grp_id`
        ");
        
    }
}
