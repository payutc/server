<?php

namespace Payutc\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Delete old table tj_usr_mol_jum
 */
class Version20131102163041 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("DROP TABLE `tj_usr_mol_jum`;");
    }

    public function down(Schema $schema)
    {
        $this->addSql("CREATE TABLE IF NOT EXISTS `tj_usr_mol_jum` (
          `usr_id` int(11) unsigned NOT NULL COMMENT 'Identifiant de l''utilisateur',
          `mol_id` int(11) unsigned NOT NULL COMMENT 'Identifiant du mode de connexion (type de mean_of_login)',
          `jum_data` varchar(200) COLLATE utf8_general_ci NOT NULL COMMENT 'Identifiant concret de l''utilisateur (login, idEtu...)',
          PRIMARY KEY (`usr_id`,`mol_id`,`jum_data`),
          KEY `mol_id` (`mol_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Différents identifiants des utilisateurs';");

        $this->addSql("ALTER TABLE `tj_usr_mol_jum`
          ADD CONSTRAINT `tj_usr_mol_jum_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `ts_user_usr` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
          ADD CONSTRAINT `tj_usr_mol_jum_ibfk_2` FOREIGN KEY (`mol_id`) REFERENCES `ts_mean_of_login_mol` (`mol_id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    }
}
