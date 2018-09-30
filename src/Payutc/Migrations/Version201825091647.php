<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Ajouter des valeurs par défauts à certains champs
 */
class Version201825091647 extends AbstractMigration {
    public function up(Schema $schema) {
        $this->addSql("ALTER TABLE `t_object_obj` CHANGE `obj_tva` `obj_tva` INT(4) NULL DEFAULT '0' COMMENT 'Tva (pas en pourcent mais en pourmille)';
            ALTER TABLE `t_application_app` CHANGE `app_lastuse` `app_lastuse` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de la dernière utilisation de cette clef.';
            ALTER TABLE `t_transaction_tra` CHANGE `tra_ip` `tra_ip` VARCHAR(39) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'Adresse IP du poste de vente';
            ALTER TABLE `ts_image_img` DROP `img_mime`, DROP `img_width`, DROP `img_length`, DROP `img_content`;
            ALTER TABLE `ts_image_img` ADD `img_path` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `img_removed`;");

    }

    public function down(Schema $schema) {
        $this->addSql("ALTER TABLE `t_object_obj` CHANGE `obj_tva` `obj_tva` INT(4) NULL COMMENT 'Tva (pas en pourcent mais en pourmille)';
            ALTER TABLE `t_application_app` CHANGE `app_lastuse` `app_lastuse` DATETIME NOT NULL COMMENT 'Date de la dernière utilisation de cette clef.';
            ALTER TABLE `t_transaction_tra` CHANGE `tra_ip` `tra_ip` VARCHAR(39) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'Adresse IP du poste de vente';
            ALTER TABLE `ts_image_img` DROP `img_path`
            ALTER TABLE `ts_image_img` ADD `img_mime` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'Format de l\'image' AFTER `img_path`, ADD `img_width` INT(5) UNSIGNED NOT NULL COMMENT 'Largeur de l\'image' AFTER `img_mime`, ADD `img_length` INT(5) UNSIGNED NOT NULL COMMENT 'Longueur de l\'image' AFTER `img_width`, ADD `img_content` MEDIUMBLOB NOT NULL COMMENT 'Contenu de l\'image' AFTER `img_id`;");

    }
}
