<?php

/**
 * UserRight.class
 * 
 * Gestion des droits User <=> Service (<=> Fundation)
 * Table: tj_usr_fun_ufu
 */

class UserRight {
    protected $db;

    public function __construct() {
        $this->db = Db_buckutt::getInstance();        
    }
    
    /**
     * Verifie un tuple de droits.
     * Lorsque les droits n'existe pas throw an exception
     */
	public static function check($user_id = false, $service_name = false, $fundation_id = false) {
        $db = Db_buckutt::getInstance();
        $req = "SELECT ufu.ufu_id FROM tj_usr_fun_ufu ufu 
                                WHERE ufu.usr_id = '%u' 
                                AND (ufu.ufu_service = '%s' OR ufu.ufu_service = 'ALL') 
                                AND ufu.ufu_removed IS NULL ";
        if($fundation_id)
            $res = $db->query($req." AND (ufu.fun_id = '%u' OR ufu.fun_id IS NULL)", array($user_id, $service_name, $fundation_id));
        else
            $res = $db->query($req, array($user_id, $service_name));
		if ($db->affectedRows() == 0) {
            if($fundation_id)
	            throw new \Exception("Le user_id $user_id n'a pas les droits $service_name sur la fundation n°$fundation_id");
            else
                throw new \Exception("Le user_id $user_id n'a les droits $service_name sur aucune fundation");
	    }
        return "ok";
    }
    
    /**
     * Retourne les fundations ou l'user "user_id" à des droits sur "service_name"
     */
    public static function getFundations($user_id, $service_name) {
        $db = Db_buckutt::getInstance();
        $res = $db->query("SELECT fun.fun_id, fun.fun_name
					FROM t_fundation_fun fun, tj_usr_fun_ufu ufu
					WHERE (ufu.fun_id = fun.fun_id OR ufu.fun_id is NULL)
                        AND ufu.usr_id = '%u'
                        AND (ufu.ufu_service = '%s' OR ufu.ufu_service = 'ALL')
                        AND ufu.ufu_removed IS NULL", array($user_id, $service_name));
        $fundations = array();
        if ($db->affectedRows() >= 1) {
			while ($don = $db->fetchArray($res)) {
                $fundations[$don["fun_id"]] = $don["fun_name"]; 
			}
        }
        return $fundations;
    }

    /**
     * Retourne les droits pour une fundation donné
     */
    public static function getRights($fun_id) {
        $db = Db_buckutt::getInstance();
        $res = $db->query("SELECT ufu.ufu_id, ufu.usr_id, ufu.fun_id, ufu.ufu_service, usr.usr_lastname, usr.usr_firstname, usr.usr_nickname
					FROM tj_usr_fun_ufu ufu, ts_user_usr usr
					WHERE usr.usr_id = ufu.usr_id
                        AND ufu.fun_id = '%u'
                        AND ufu.ufu_removed IS NULL;", array($fun_id));
        $rights = array();
        if ($db->affectedRows() >= 1) {
			while ($don = $db->fetchArray($res)) {
                if(!array_key_exists($don["usr_id"], $rights))
                {
                    $rights[$don["usr_id"]] = array();
                    $rights[$don["usr_id"]]["usr_id"]  = $don["usr_id"];
                    $rights[$don["usr_id"]]["usr_login"]  = $don["usr_nickname"];
                    $rights[$don["usr_id"]]["usr_firstname"]  = $don["usr_firstname"];
                    $rights[$don["usr_id"]]["usr_lastname"]  = $don["usr_lastname"];
                    $rights[$don["usr_id"]]["fun_id"]  = $don["fun_id"];
                    $rights[$don["usr_id"]]["service"] = array();
                } 
                $rights[$don["usr_id"]]["service"][] = array("service" => $don["ufu_service"], "id" => $don["ufu_id"]);
			}
        }
        return $rights;
    }

    /**
     * Donne les droits à un user sur un service et une fundation
     */
    public static function setRight($usr_login, $service, $fun_id) {
        $db = Db_buckutt::getInstance();
        // STEP 1, get userid from login
        $usr_id = $db->result($db->query("SELECT usr_id FROM ts_user_usr WHERE usr_nickname='%s';", Array($usr_login)),0);
		if ($db->affectedRows() != 1) {
			throw new Exception("Le login \"$usr_login\" n'a donné aucun resultat.");
		}
        // STEP2, insert
        $db->query("INSERT INTO tj_usr_fun_ufu (usr_id, fun_id, ufu_service) VALUES('%u', '%u', '%s');", Array($usr_id, $fun_id, $service));
        if ($db->affectedRows() != 1) {
			throw new Exception("Le droit n'a pas pu être ajouté pour une raison inconnu.");
		}
        return $db->insertId();
    }

	/**
	* Supprimer le droit
	* 
	*/
	public function removeRight($usr_id, $service, $fun_id) {
        $db = Db_buckutt::getInstance();
		$db->query("UPDATE tj_usr_fun_ufu SET ufu_removed=NOW() WHERE fun_id='%u' AND usr_id='%u' AND ufu_service='%s';", Array($fun_id, $usr_id, $service));
		if ($db->affectedRows() == 0) {
			throw new Exception("Le droit n'a pas pu être supprimé pour une raison inconnu.");
		}	
	}

}

