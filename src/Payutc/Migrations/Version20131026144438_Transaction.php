<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * This migration adds the transaction column to the purchase table
 */
class Version20131026144438_Transaction extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // Create the new transaction table
        $this->addSql("CREATE TABLE `t_transaction_tra` (
            `tra_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant de transaction',
            `tra_date` datetime NOT NULL COMMENT 'Date et heure de l''achat',
            `usr_id_buyer` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''acheteur',
            `usr_id_seller` int(11) unsigned NOT NULL COMMENT 'Identifiant du vendeur',
            `poi_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du point de vente',
            `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''organisme vendeur',
            `tra_ip` varchar(39) COLLATE utf8_general_ci NOT NULL COMMENT 'Adresse IP du poste de vente',
            `tra_removed` datetime DEFAULT NULL COMMENT 'Date de la suppression de la transaction',
            PRIMARY KEY (`tra_id`),
            KEY `fun_id` (`fun_id`),
            KEY `poi_id` (`poi_id`),
            KEY `usr_id_buyer` (`usr_id_buyer`),
            KEY `usr_id_seller` (`usr_id_seller`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Transactions (achats de plusieurs produits)';");
        
        // Create a transaction for each existing purchase
        $this->addSql("INSERT INTO `t_transaction_tra`
            (`tra_id`, `tra_date`, `usr_id_buyer`, `usr_id_seller`, `poi_id`, `fun_id`, `tra_ip`)
            SELECT `pur_id`, `pur_date`, `usr_id_buyer`, `usr_id_seller`, `poi_id`, `fun_id`, `pur_ip` FROM `t_purchase_pur`");
        
        // Add a transaction column in purchase
        $this->addSql("ALTER TABLE `t_purchase_pur`
            ADD `tra_id` INT(11) NOT NULL COMMENT 'Identifiant de la transaction' AFTER `pur_id`,
            ADD INDEX (`tra_id`);");

        // Point all our purchases to their newly created transactions (IDs match on the INSERT)
        $this->addSql("UPDATE `t_purchase_pur` SET `tra_id` = `pur_id`;");
        
        // Remove all the old columns from purchase
        $this->addSql("ALTER TABLE `t_purchase_pur`
            DROP `pur_date`,
            DROP `pur_type`,
            DROP `usr_id_buyer`,
            DROP `usr_id_seller`,
            DROP `poi_id`,
            DROP `fun_id`,
            DROP `pur_ip`;");
    }

    public function down(Schema $schema)
    {
        // Restore the columns in purchase
        $this->addSql("ALTER TABLE `t_purchase_pur`
            ADD `pur_date` datetime NOT NULL COMMENT 'Date et heure de l''achat',
            ADD `pur_type` enum('product','promotion') COLLATE utf8_general_ci NOT NULL DEFAULT 'product' COMMENT 'Type d''achat (produit ou promotion)',
            ADD `usr_id_buyer` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''acheteur',
            ADD `usr_id_seller` int(11) unsigned NOT NULL COMMENT 'Identifiant du vendeur',
            ADD `poi_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du point de vente',
            ADD `fun_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''organisme vendeur',
            ADD `pur_ip` varchar(15) COLLATE utf8_general_ci NOT NULL COMMENT 'Adresse IP du poste de vente',
            ADD KEY `fun_id` (`fun_id`),
            ADD KEY `poi_id` (`poi_id`),
            ADD KEY `usr_id_buyer` (`usr_id_buyer`),
            ADD KEY `usr_id_seller` (`usr_id_seller`);");
        
        // Set their values from the transaction table
        $this->addSql("UPDATE `t_purchase_pur` pur
            INNER JOIN `t_transaction_tra` tra ON tra.`tra_id` = pur.`tra_id`
            SET pur.`pur_date` = tra.`tra_date`,
            pur.`pur_type` = 'product',
            pur.`usr_id_buyer` = tra.`usr_id_buyer`,
            pur.`usr_id_seller` = tra.`usr_id_seller`,
            pur.`poi_id` = tra.`poi_id`,
            pur.`fun_id` = tra.`fun_id`,
            pur.`pur_ip` = tra.`tra_ip`;");
        
        // Remove the transaction id from purchases
        $this->addSql("ALTER TABLE `t_purchase_pur` DROP `tra_id`;");
        
        // Drop the transaction table
        $this->addSql("DROP TABLE `t_transaction_tra`");
    }
}
