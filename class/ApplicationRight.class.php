<?php

/**
 * ApplicationRight.class
 * 
 * Gestion des droits Application <=> Service (<=> Fundation)
 * Table: tj_app_fun_afu
 */


class ApplicationRight {
    protected $db;

    public function __construct() {
        $this->db = Db_buckutt::getInstance();        
    }
    
    /**
     * Verifie un tuple de droits.
     * Lorsque les droits n'existe pas throw an exception
     */
	public static function check($application_id = false, $service_name = false, $fundation_id = false) {
        $db = Db_buckutt::getInstance();
        $req = "SELECT afu.afu_id FROM tj_app_fun_afu afu 
                            WHERE afu.app_id = '%u' 
                            AND (afu.afu_service = '%s' OR afu.afu_service = 'ALL')
                            AND afu.afu_removed IS NULL ";
        if($fundation_id)
            $res = $db->query($req." AND (afu.fun_id = '%u' OR afu.fun_id IS NULL)", array($application_id, $service_name, $fundation_id));
        else
            $res = $db->query($req, array($application_id, $service_name));

		if ($db->affectedRows() == 0) {
            if($fundation_id)
	            throw new \Exception("L'application_id $application_id n'a pas les droits $service_name sur la fundation n°$fundation_id");
            else
                throw new \Exception("L'application_id $application_id n'a les droits $service_name sur aucune fundation");
	    }
        return true;
    }

    /**
     * Retourne les fundations où l'application "application_id" à des droits sur "service_name"
     */
    public static function getFundations($application_id, $service_name) {
        $db = Db_buckutt::getInstance();
        $res = $db->query("SELECT fun.fun_id, fun.fun_name
					FROM t_fundation_fun fun, tj_app_fun_afu afu
					WHERE (afu.fun_id = fun.fun_id OR afu.fun_id is NULL)
                        AND afu.app_id = '%u'
                        AND (afu.afu_service = '%s' OR afu.afu_service = 'ALL')
                        AND afu.afu_removed is NULL;", array($application_id, $service_name));
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
        $res = $db->query("SELECT afu.afu_id, afu.app_id, afu.fun_id, afu.afu_service
					FROM tj_app_fun_afu afu
					WHERE afu.fun_id = '%u'
                        AND afu.afu_removed is NULL;", array($fun_id));
        $rights = array();
        if ($db->affectedRows() >= 1) {
			while ($don = $db->fetchArray($res)) {
                if(!array_key_exists($don["app_id"], $rights))
                {
                    $rights[$don["app_id"]] = array();
                    $rights[$don["app_id"]]["app_id"]  = $don["app_id"];
                    $rights[$don["app_id"]]["fun_id"]  = $don["fun_id"];
                    $rights[$don["app_id"]]["service"] = array();
                } 
                $rights[$don["app_id"]]["service"][] = array("service" => $don["afu_service"], "id" => $don["afu_id"]);
			}
        }
        return $rights;
    }
	
    /**
     * Donne les droits à une application sur un service et une fundation
     */
    public static function setRight($app_id, $service, $fun_id) {
        $db = Db_buckutt::getInstance();
        $db->query("INSERT INTO tj_app_fun_afu (app_id, fun_id, afu_service) VALUES('%u', '%u', '%s');", Array($app_id, $fun_id, $service));
        if ($db->affectedRows() != 1) {
			throw new Exception("Une erreur s'est produite lors de l'ajout du droit.");
		}
        return $db->insertId();
    }

	/**
	* Supprimer le droit
	* 
	*/
	public static function removeRight($app_id, $service, $fun_id) {
        $db = Db_buckutt::getInstance();
		$db->query("UPDATE tj_app_fun_afu SET afu_removed=NOW() WHERE fun_id='%u' AND app_id='%u' AND afu_service='%s';", Array($fun_id, $app_id, $service));
		if ($db->affectedRows() == 0) {
			throw new Exception("Une erreur s'est produite lors de la supression du droit.");
		}	
	}
}

