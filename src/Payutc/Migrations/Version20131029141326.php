<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Add email field in t_transaction_tra
 */
class Version20131029141326 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_transaction_tra`
            ADD `tra_email` VARCHAR(50) NULL COMMENT 'Email of buyer if usr_id_seller is NULL' AFTER `usr_id_seller`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_transaction_tra`
            DROP `tra_email`");
    }
}
