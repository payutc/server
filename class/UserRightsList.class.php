<?php

/**
 * UserRightsList.class
 * 
 * Classe permettant de récupérer plusieurs applications en même temps
 */

use \Payutc\Db\DbBuckutt;

class UserRightsList {

    /**
     * Get applications for a given user
     */
	public static function getUserAdminRights($usr_id) {
        $db = DbBuckutt::getInstance();   
        $apps = array();
        $query = $db->query("SELECT * FROM `tj_usr_fun_ufu` ufu
                                      LEFT JOIN t_fundation_fun fun ON fun.fun_id = ufu.fun_id
                                   WHERE ISNULL(ufu_removed) AND ufu.usr_id = %s;", 
                                Array($usr_id));	
        if ($db->affectedRows() >= 1) {
			while ($don = $db->fetchAssoc($query)) {
				array_push($apps, $don);
			}
        }
        return $apps;
    }
	
}

