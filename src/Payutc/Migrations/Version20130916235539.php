<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130916235539 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `ts_user_usr`
                        ADD `usr_nb_ecocups` INT NOT NULL DEFAULT '0'
                        AFTER `usr_msg_perso`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `ts_user_usr` DROP `usr_nb_ecocups`;");
    }
}
