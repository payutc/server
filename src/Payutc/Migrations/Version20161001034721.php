<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20161001034721 extends AbstractMigration {
    public function up(Schema $schema) {
        $this->addSql("ALTER TABLE `ts_user_usr` ADD `usr_credit_ecocup` INT NOT NULL DEFAULT '0' AFTER `usr_credit` ");

    }

    public function down(Schema $schema) {
        $this->addSql("ALTER TABLE `ts_user_usr` DROP `usr_credit_ecocup`");

    }
}
