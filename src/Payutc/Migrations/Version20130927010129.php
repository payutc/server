<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130927010129 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE  `t_paybox_pay` ADD  `pay_token` VARCHAR( 40 ) NULL DEFAULT NULL COMMENT  'Token payline pour connaitre l etat de la transaction' AFTER  `pay_date_retour`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_paybox_pay` DROP `pay_token`");
    }
}
