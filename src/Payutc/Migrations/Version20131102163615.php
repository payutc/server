<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Clean old tables storing static data
 */
class Version20131102163615 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("DROP TABLE `ts_error_err`;");
        $this->addSql("DROP TABLE `ts_right_rig`;");        
        $this->addSql("DROP TABLE `ts_mean_of_login_mol`;");
    }

    public function down(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `ts_error_err` (
          `err_code` int(5) unsigned NOT NULL COMMENT 'Code de l''erreur',
          `err_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom de l''erreur',
          `err_description` text COLLATE utf8_general_ci NOT NULL COMMENT 'Description de l''erreur',
          `err_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si l''erreur est supprimée',
          PRIMARY KEY (`err_code`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Erreurs rencontrables lors de l''utilisation';");

        $this->addSql("CREATE TABLE IF NOT EXISTS `ts_right_rig` (
          `rig_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du droit',
          `rig_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom du droit',
          `rig_description` text COLLATE utf8_general_ci NOT NULL COMMENT 'Description du droit',
          `rig_admin` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 s''il s''agit d''un droit d''administrateur',
          `rig_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le droit est supprimé',
          PRIMARY KEY (`rig_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Droits des utilisateurs';");

        $this->addSql("CREATE TABLE IF NOT EXISTS `ts_mean_of_login_mol` (
          `mol_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du mode de connexion',
          `mol_name` varchar(40) COLLATE utf8_general_ci NOT NULL COMMENT 'Nom du mode de connexion',
          `mol_removed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 si le mode de connexion est supprimé',
          PRIMARY KEY (`mol_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Moyens de connexion';");
    }
}
