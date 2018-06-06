<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20180606180000 extends AbstractMigration {
    public function up(Schema $schema) {
        $this->addSql("ALTER TABLE `t_object_obj` ADD `obj_service` VARCHAR(20) AFTER `obj_type` ");

    }

    public function down(Schema $schema) {
        $this->addSql("ALTER TABLE `t_object_obj` DROP `obj_service`");

    }
}
