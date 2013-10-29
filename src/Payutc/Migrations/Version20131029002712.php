<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Allow handling of transactions for WEBSALE
 */
class Version20131029002712 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_transaction_tra`
            ADD `tra_status` ENUM('W', 'V', 'A') NOT NULL DEFAULT 'W' COMMENT 'Transaction status' AFTER `fun_id`,
            ADD `tra_callback_url` VARCHAR(200) NULL COMMENT 'URL to call when status changes' AFTER `tra_status`,
            ADD `tra_return_url` VARCHAR(200) NULL COMMENT 'Return URL at the end of the transaction' AFTER `tra_callback_url`,
            ADD `tra_token` VARCHAR(32) NULL COMMENT 'Transaction token for WEBSALE' AFTER `tra_return_url`,
            ADD INDEX (`tra_status`)");
        
        $this->addSql("ALTER TABLE `t_paybox_pay`
            ADD `tra_id` INT(11) UNSIGNED NULL COMMENT 'Transaction ID the payment should trigger a transaction confirmation' AFTER `usr_id`,
            CHANGE `usr_id` `usr_id` INT(11) UNSIGNED NULL COMMENT 'User',
            ADD INDEX (`usr_id`),
            ADD INDEX (`tra_id`)");
            
        $this->addSql("ALTER TABLE `t_paybox_pay` ADD CONSTRAINT `t_paybox_pay_ibfk_1`
            FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`)
            ON DELETE RESTRICT ON UPDATE RESTRICT");    
        $this->addSql("ALTER TABLE `t_paybox_pay` ADD CONSTRAINT `t_paybox_pay_ibfk_2`
            FOREIGN KEY (`tra_id`) REFERENCES `t_transaction_tra` (`tra_id`)
            ON DELETE RESTRICT ON UPDATE RESTRICT");
        
        $this->addSql("UPDATE `t_transaction_tra` SET `tra_status` = 'V'");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE `t_paybox_pay` DROP FOREIGN KEY `t_paybox_pay_ibfk_1`");
        $this->addSql("ALTER TABLE `t_paybox_pay` DROP FOREIGN KEY `t_paybox_pay_ibfk_2`");
        
        $this->addSql("ALTER TABLE `t_paybox_pay`
            DROP INDEX `usr_id`,
            DROP INDEX `tra_id`,
            CHANGE `usr_id` `usr_id` INT(5) NOT NULL COMMENT 'User',
            DROP `tra_id`");
        
        $this->addSql("ALTER TABLE `t_transaction_tra`
            DROP INDEX `tra_status`,
            DROP `tra_status`,
            DROP `tra_callback_url`,
            DROP `tra_return_url`,
            DROP `tra_token`");
    }
}
