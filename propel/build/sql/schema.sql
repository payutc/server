
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- t_fundation_fun
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_fundation_fun`;

CREATE TABLE `t_fundation_fun`
(
    `fun_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `fun_name` VARCHAR(40) NOT NULL,
    `fun_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`fun_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_group_grp
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_group_grp`;

CREATE TABLE `t_group_grp`
(
    `grp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `grp_name` VARCHAR(40) NOT NULL,
    `grp_open` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `grp_public` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `fun_id` int(11) unsigned NOT NULL,
    `grp_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`grp_id`),
    INDEX `fun_id` (`fun_id`),
    CONSTRAINT `t_group_grp_ibfk_2`
        FOREIGN KEY (`fun_id`)
        REFERENCES `t_fundation_fun` (`fun_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_object_obj
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_object_obj`;

CREATE TABLE `t_object_obj`
(
    `obj_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `obj_name` VARCHAR(100) NOT NULL,
    `obj_type` enum('product','category','promotion') NOT NULL,
    `obj_stock` INTEGER,
    `obj_single` tinyint(1) unsigned NOT NULL,
    `obj_tva` INTEGER(4) NOT NULL,
    `obj_alcool` INTEGER(1) NOT NULL,
    `img_id` int(11) unsigned,
    `fun_id` int(11) unsigned NOT NULL,
    `obj_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`obj_id`),
    INDEX `img_id` (`img_id`),
    INDEX `fun_id` (`fun_id`),
    CONSTRAINT `t_object_obj_ibfk_3`
        FOREIGN KEY (`fun_id`)
        REFERENCES `t_fundation_fun` (`fun_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_object_obj_ibfk_1`
        FOREIGN KEY (`img_id`)
        REFERENCES `ts_image_img` (`img_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_oldusr_osr
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_oldusr_osr`;

CREATE TABLE `t_oldusr_osr`
(
    `osr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `osr_login` VARCHAR(255),
    `osr_credit` FLOAT,
    `osr_date` DATETIME,
    PRIMARY KEY (`osr_id`),
    UNIQUE INDEX `osr_login` (`osr_login`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_paybox_pay
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_paybox_pay`;

CREATE TABLE `t_paybox_pay`
(
    `pay_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `usr_id` int(11) unsigned NOT NULL,
    `pay_step` enum('W','A','V') NOT NULL,
    `pay_amount` INTEGER(5) NOT NULL,
    `pay_date_create` DATETIME NOT NULL,
    `pay_date_retour` DATETIME,
    `pay_auto` VARCHAR(20),
    `pay_trans` VARCHAR(20),
    `pay_callback_url` VARCHAR(255) NOT NULL,
    `pay_mobile` TINYINT(1) DEFAULT 0 NOT NULL,
    `pay_error` VARCHAR(5),
    PRIMARY KEY (`pay_id`),
    INDEX `usr_id` (`usr_id`),
    CONSTRAINT `t_paybox_pay_ibfk_1`
        FOREIGN KEY (`usr_id`)
        REFERENCES `ts_user_usr` (`usr_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_period_per
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_period_per`;

CREATE TABLE `t_period_per`
(
    `per_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `fun_id` int(11) unsigned NOT NULL,
    `per_name` TEXT,
    `per_date_start` DATETIME NOT NULL,
    `per_date_end` DATETIME NOT NULL,
    `per_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`per_id`),
    INDEX `fun_id` (`fun_id`),
    CONSTRAINT `t_period_per_ibfk_1`
        FOREIGN KEY (`fun_id`)
        REFERENCES `t_fundation_fun` (`fun_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_plage_pla
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_plage_pla`;

CREATE TABLE `t_plage_pla`
(
    `pla_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `fun_id` int(11) unsigned NOT NULL,
    `poi_id` int(11) unsigned NOT NULL,
    `pla_start` INTEGER(4) NOT NULL,
    `pla_end` INTEGER(4) NOT NULL,
    `pla_name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`pla_id`),
    INDEX `fun_id` (`fun_id`),
    INDEX `poi_id` (`poi_id`),
    CONSTRAINT `t_plage_pla_ibfk_2`
        FOREIGN KEY (`poi_id`)
        REFERENCES `t_point_poi` (`poi_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_plage_pla_ibfk_1`
        FOREIGN KEY (`fun_id`)
        REFERENCES `t_fundation_fun` (`fun_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_point_poi
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_point_poi`;

CREATE TABLE `t_point_poi`
(
    `poi_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `poi_name` VARCHAR(40) NOT NULL,
    `poi_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`poi_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_price_pri
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_price_pri`;

CREATE TABLE `t_price_pri`
(
    `pri_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `obj_id` int(11) unsigned NOT NULL,
    `grp_id` int(11) unsigned,
    `per_id` int(11) unsigned,
    `pri_credit` mediumint(8) unsigned NOT NULL,
    `pri_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`pri_id`),
    INDEX `obj_id` (`obj_id`),
    INDEX `grp_id` (`grp_id`),
    INDEX `per_id` (`per_id`),
    CONSTRAINT `t_price_pri_ibfk_3`
        FOREIGN KEY (`per_id`)
        REFERENCES `t_period_per` (`per_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_price_pri_ibfk_1`
        FOREIGN KEY (`obj_id`)
        REFERENCES `t_object_obj` (`obj_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_price_pri_ibfk_2`
        FOREIGN KEY (`grp_id`)
        REFERENCES `t_group_grp` (`grp_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_purchase_pur
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_purchase_pur`;

CREATE TABLE `t_purchase_pur`
(
    `pur_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `pur_date` DATETIME NOT NULL,
    `pur_type` enum('product','promotion') DEFAULT 'product' NOT NULL,
    `obj_id` int(11) unsigned NOT NULL,
    `pur_price` int(8) unsigned NOT NULL,
    `usr_id_buyer` int(11) unsigned NOT NULL,
    `usr_id_seller` int(11) unsigned NOT NULL,
    `poi_id` int(11) unsigned NOT NULL,
    `fun_id` int(11) unsigned NOT NULL,
    `pur_ip` VARCHAR(15) NOT NULL,
    `pur_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`pur_id`),
    INDEX `fun_id` (`fun_id`),
    INDEX `poi_id` (`poi_id`),
    INDEX `usr_id_buyer` (`usr_id_buyer`),
    INDEX `usr_id_seller` (`usr_id_seller`),
    INDEX `obj_id` (`obj_id`),
    CONSTRAINT `t_purchase_pur_ibfk_5`
        FOREIGN KEY (`obj_id`)
        REFERENCES `t_object_obj` (`obj_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_purchase_pur_ibfk_1`
        FOREIGN KEY (`usr_id_buyer`)
        REFERENCES `ts_user_usr` (`usr_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_purchase_pur_ibfk_2`
        FOREIGN KEY (`usr_id_seller`)
        REFERENCES `ts_user_usr` (`usr_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_purchase_pur_ibfk_3`
        FOREIGN KEY (`poi_id`)
        REFERENCES `t_point_poi` (`poi_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_purchase_pur_ibfk_4`
        FOREIGN KEY (`fun_id`)
        REFERENCES `t_fundation_fun` (`fun_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_recharge_rec
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_recharge_rec`;

CREATE TABLE `t_recharge_rec`
(
    `rec_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `rty_id` tinyint(3) unsigned NOT NULL,
    `usr_id_buyer` int(11) unsigned NOT NULL,
    `usr_id_operator` int(11) unsigned NOT NULL,
    `poi_id` int(11) unsigned NOT NULL,
    `rec_date` DATETIME NOT NULL,
    `rec_credit` smallint(5) unsigned NOT NULL,
    `rec_trace` VARCHAR(250),
    `rec_removed` tinyint(1) unsigned NOT NULL,
    PRIMARY KEY (`rec_id`),
    INDEX `rty_id` (`rty_id`),
    INDEX `poi_id` (`poi_id`),
    INDEX `usr_id_buyer` (`usr_id_buyer`),
    INDEX `usr_id_operator` (`usr_id_operator`),
    CONSTRAINT `t_recharge_rec_ibfk_8`
        FOREIGN KEY (`poi_id`)
        REFERENCES `t_point_poi` (`poi_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_recharge_rec_ibfk_5`
        FOREIGN KEY (`rty_id`)
        REFERENCES `t_recharge_type_rty` (`rty_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_recharge_rec_ibfk_6`
        FOREIGN KEY (`usr_id_buyer`)
        REFERENCES `ts_user_usr` (`usr_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_recharge_rec_ibfk_7`
        FOREIGN KEY (`usr_id_operator`)
        REFERENCES `ts_user_usr` (`usr_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_recharge_type_rty
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_recharge_type_rty`;

CREATE TABLE `t_recharge_type_rty`
(
    `rty_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
    `rty_name` VARCHAR(40) NOT NULL,
    `rty_type` enum('PBUY','SBUY'),
    `rty_removed` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`rty_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_sale_sal
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_sale_sal`;

CREATE TABLE `t_sale_sal`
(
    `sal_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `sal_name` VARCHAR(100),
    `per_id` int(11) unsigned NOT NULL,
    `obj_id` int(11) unsigned NOT NULL,
    `sal_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`sal_id`),
    INDEX `per_id` (`per_id`),
    INDEX `obj_id` (`obj_id`),
    CONSTRAINT `t_sale_sal_ibfk_2`
        FOREIGN KEY (`obj_id`)
        REFERENCES `t_object_obj` (`obj_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_sale_sal_ibfk_1`
        FOREIGN KEY (`per_id`)
        REFERENCES `t_period_per` (`per_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_sherlocks_she
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_sherlocks_she`;

CREATE TABLE `t_sherlocks_she`
(
    `she_id` INTEGER NOT NULL AUTO_INCREMENT,
    `usr_id` int(10) unsigned NOT NULL,
    `she_step` TINYINT(1) NOT NULL,
    `she_amount` INTEGER(5) NOT NULL,
    `she_date` DATETIME NOT NULL,
    `she_parent_id` INTEGER,
    `she_state` INTEGER(5) NOT NULL,
    `she_trace` TEXT NOT NULL,
    PRIMARY KEY (`she_id`),
    INDEX `usr_id` (`usr_id`),
    INDEX `she_parent_id` (`she_parent_id`),
    CONSTRAINT `t_sherlocks_she_ibfk_1`
        FOREIGN KEY (`usr_id`)
        REFERENCES `ts_user_usr` (`usr_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- t_virement_vir
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `t_virement_vir`;

CREATE TABLE `t_virement_vir`
(
    `vir_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `vir_date` DATETIME NOT NULL,
    `vir_amount` INTEGER(5) NOT NULL,
    `usr_id_from` int(11) unsigned NOT NULL,
    `usr_id_to` int(11) unsigned NOT NULL,
    PRIMARY KEY (`vir_id`),
    INDEX `usr_id_from` (`usr_id_from`),
    INDEX `usr_id_to` (`usr_id_to`),
    CONSTRAINT `t_virement_vir_ibfk_2`
        FOREIGN KEY (`usr_id_to`)
        REFERENCES `ts_user_usr` (`usr_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `t_virement_vir_ibfk_1`
        FOREIGN KEY (`usr_id_from`)
        REFERENCES `ts_user_usr` (`usr_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tj_obj_poi_jop
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tj_obj_poi_jop`;

CREATE TABLE `tj_obj_poi_jop`
(
    `obj_id` int(11) unsigned NOT NULL,
    `jop_priority` INTEGER DEFAULT 100 NOT NULL,
    `poi_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`obj_id`,`poi_id`),
    INDEX `poi_id` (`poi_id`),
    CONSTRAINT `tj_obj_poi_jop_ibfk_6`
        FOREIGN KEY (`poi_id`)
        REFERENCES `t_point_poi` (`poi_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `tj_obj_poi_jop_ibfk_5`
        FOREIGN KEY (`obj_id`)
        REFERENCES `t_object_obj` (`obj_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tj_object_link_oli
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tj_object_link_oli`;

CREATE TABLE `tj_object_link_oli`
(
    `oli_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `obj_id_parent` int(11) unsigned NOT NULL,
    `obj_id_child` int(11) unsigned NOT NULL,
    `oli_step` int(3) unsigned NOT NULL,
    `oli_removed` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`oli_id`),
    INDEX `obj_id_parent` (`obj_id_parent`),
    INDEX `obj_id_child` (`obj_id_child`),
    CONSTRAINT `tj_object_link_oli_ibfk_6`
        FOREIGN KEY (`obj_id_child`)
        REFERENCES `t_object_obj` (`obj_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `tj_object_link_oli_ibfk_5`
        FOREIGN KEY (`obj_id_parent`)
        REFERENCES `t_object_obj` (`obj_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tj_usr_grp_jug
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tj_usr_grp_jug`;

CREATE TABLE `tj_usr_grp_jug`
(
    `jug_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `usr_id` int(11) unsigned NOT NULL,
    `grp_id` int(11) unsigned NOT NULL,
    `per_id` int(11) unsigned NOT NULL,
    `jug_removed` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`jug_id`),
    INDEX `per_id` (`per_id`),
    INDEX `grp_id` (`grp_id`),
    INDEX `usr_id` (`usr_id`),
    CONSTRAINT `tj_usr_grp_jug_ibfk_3`
        FOREIGN KEY (`per_id`)
        REFERENCES `t_period_per` (`per_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `tj_usr_grp_jug_ibfk_1`
        FOREIGN KEY (`usr_id`)
        REFERENCES `ts_user_usr` (`usr_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `tj_usr_grp_jug_ibfk_2`
        FOREIGN KEY (`grp_id`)
        REFERENCES `t_group_grp` (`grp_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tj_usr_mol_jum
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tj_usr_mol_jum`;

CREATE TABLE `tj_usr_mol_jum`
(
    `usr_id` int(11) unsigned NOT NULL,
    `mol_id` int(11) unsigned NOT NULL,
    `jum_data` VARCHAR(200) NOT NULL,
    PRIMARY KEY (`usr_id`,`mol_id`,`jum_data`),
    INDEX `mol_id` (`mol_id`),
    CONSTRAINT `tj_usr_mol_jum_ibfk_1`
        FOREIGN KEY (`usr_id`)
        REFERENCES `ts_user_usr` (`usr_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `tj_usr_mol_jum_ibfk_2`
        FOREIGN KEY (`mol_id`)
        REFERENCES `ts_mean_of_login_mol` (`mol_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tj_usr_rig_jur
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tj_usr_rig_jur`;

CREATE TABLE `tj_usr_rig_jur`
(
    `jur_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `usr_id` int(11) unsigned,
    `rig_id` int(11) unsigned NOT NULL,
    `per_id` int(11) unsigned,
    `fun_id` int(11) unsigned,
    `poi_id` int(11) unsigned,
    `jur_removed` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`jur_id`),
    UNIQUE INDEX `usr_id_2` (`usr_id`, `rig_id`, `fun_id`, `jur_removed`),
    UNIQUE INDEX `rig_id_2` (`rig_id`, `fun_id`, `poi_id`, `jur_removed`),
    INDEX `usr_id` (`usr_id`),
    INDEX `rig_id` (`rig_id`),
    INDEX `per_id` (`per_id`),
    INDEX `fun_id` (`fun_id`),
    INDEX `poi_id` (`poi_id`),
    CONSTRAINT `tj_usr_rig_jur_ibfk_5`
        FOREIGN KEY (`per_id`)
        REFERENCES `t_period_per` (`per_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `tj_usr_rig_jur_ibfk_1`
        FOREIGN KEY (`usr_id`)
        REFERENCES `ts_user_usr` (`usr_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `tj_usr_rig_jur_ibfk_2`
        FOREIGN KEY (`rig_id`)
        REFERENCES `ts_right_rig` (`rig_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `tj_usr_rig_jur_ibfk_3`
        FOREIGN KEY (`fun_id`)
        REFERENCES `t_fundation_fun` (`fun_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `tj_usr_rig_jur_ibfk_4`
        FOREIGN KEY (`poi_id`)
        REFERENCES `t_point_poi` (`poi_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ts_callback_cal
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ts_callback_cal`;

CREATE TABLE `ts_callback_cal`
(
    `cal_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `pro_id` int(11) unsigned NOT NULL,
    `cal_request` VARCHAR(250) NOT NULL,
    `mol_id` int(11) unsigned NOT NULL,
    `cal_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`cal_id`),
    INDEX `pro_id` (`pro_id`),
    INDEX `mol_id` (`mol_id`),
    CONSTRAINT `ts_callback_cal_ibfk_1`
        FOREIGN KEY (`mol_id`)
        REFERENCES `ts_mean_of_login_mol` (`mol_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ts_error_err
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ts_error_err`;

CREATE TABLE `ts_error_err`
(
    `err_code` int(5) unsigned NOT NULL,
    `err_name` VARCHAR(40) NOT NULL,
    `err_description` TEXT NOT NULL,
    `err_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`err_code`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ts_image_img
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ts_image_img`;

CREATE TABLE `ts_image_img`
(
    `img_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `img_mime` VARCHAR(20) NOT NULL,
    `img_width` int(5) unsigned NOT NULL,
    `img_length` int(5) unsigned NOT NULL,
    `img_content` LONGBLOB NOT NULL,
    `img_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`img_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ts_log_log
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ts_log_log`;

CREATE TABLE `ts_log_log`
(
    `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `log_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `log_gravity` tinyint(1) unsigned NOT NULL,
    `log_message` TEXT NOT NULL,
    PRIMARY KEY (`log_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ts_mean_of_login_mol
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ts_mean_of_login_mol`;

CREATE TABLE `ts_mean_of_login_mol`
(
    `mol_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `mol_name` VARCHAR(40) NOT NULL,
    `mol_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`mol_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ts_right_rig
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ts_right_rig`;

CREATE TABLE `ts_right_rig`
(
    `rig_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `rig_name` VARCHAR(40) NOT NULL,
    `rig_description` TEXT NOT NULL,
    `rig_admin` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `rig_removed` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    PRIMARY KEY (`rig_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ts_user_usr
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ts_user_usr`;

CREATE TABLE `ts_user_usr`
(
    `usr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `usr_pwd` VARCHAR(100),
    `usr_firstname` VARCHAR(40),
    `usr_lastname` VARCHAR(40),
    `usr_nickname` VARCHAR(200),
    `usr_adult` INTEGER(1),
    `usr_mail` VARCHAR(200),
    `usr_credit` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `img_id` int(11) unsigned,
    `usr_temporary` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `usr_fail_auth` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `usr_blocked` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `usr_msg_perso` VARCHAR(255),
    PRIMARY KEY (`usr_id`),
    INDEX `img_id` (`img_id`),
    CONSTRAINT `ts_user_usr_ibfk_1`
        FOREIGN KEY (`img_id`)
        REFERENCES `ts_image_img` (`img_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
