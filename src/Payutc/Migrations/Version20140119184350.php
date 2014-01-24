<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20140119184350 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_message_msg`
                DROP `msg_id`");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_message_msg`
                ADD `msg_id` INT IDENTITY");
                
        $this->addSql("ALTER TABLE `t_message_msg`
                ADD CONSTRAINT pk_t_message_msg
                PRIMARY KEY(`msg_id`)");
    }
}
