<?php

/**
 * UserRight.class
 * 
 * Gestion des droits User <=> Service (<=> Fundation)
 * Table: tj_usr_fun_ufu
 */

use \Payutc\Db\Dbal;
use \Payutc\Db\DbBuckutt;
use \Payutc\Bom\User;

class UserRight {
    protected $db;

    public function __construct() {
        $this->db = DbBuckutt::getInstance();        
    }
    
    /**
     * Verifie un tuple de droits.
     * Lorsque les droits n'existe pas throw an exception
     */
	public static function check($user_id, $service_name = false, $check_fundation = false, $fundation_id = NULL) {
        $db = DbBuckutt::getInstance();
        $req = "SELECT ufu.ufu_id FROM tj_usr_fun_ufu ufu 
                                WHERE ufu.usr_id = '%u' 
                                AND (ufu.ufu_service = '%s' OR ufu.ufu_service IS NULL) 
                                AND ufu.ufu_removed IS NULL ";

        if($check_fundation) {
            if($fundation_id) {
                $res = $db->query($req." AND (ufu.fun_id = '%u' OR ufu.fun_id IS NULL)", array($user_id, $service_name, $fundation_id));
            } else {
                $res = $db->query($req." AND ufu.fun_id IS NULL", array($user_id, $service_name)); 
            }
        } else {
            $res = $db->query($req, array($user_id, $service_name));
        }
        
		if ($db->affectedRows() == 0) {
            if($fundation_id)
	            throw new \Payutc\Exception\CheckRightException("Le user_id $user_id n'a pas les droits $service_name sur la fundation n°$fundation_id");
            else
                throw new \Payutc\Exception\CheckRightException("Le user_id $user_id n'a les droits $service_name sur aucune fundation");
	    }
        return true;
    }
    
    /**
     * Retourne les fundations ou l'user "user_id" à des droits sur "service_name"
     */
    public static function getFundations($user_id, $service_name) {
        $db = DbBuckutt::getInstance();
        $res = $db->query("SELECT fun.fun_id, fun.fun_name
					FROM t_fundation_fun fun, tj_usr_fun_ufu ufu
					WHERE (ufu.fun_id = fun.fun_id OR ufu.fun_id is NULL)
                        AND ufu.usr_id = '%u'
                        AND (ufu.ufu_service = '%s' OR ufu.ufu_service IS NULL)
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
        $db = DbBuckutt::getInstance();
        if($fun_id) {
            $res = $db->query("SELECT ufu.ufu_id, ufu.usr_id, ufu.fun_id, ufu.ufu_service, usr.usr_lastname, usr.usr_firstname, usr.usr_nickname
					    FROM tj_usr_fun_ufu ufu, ts_user_usr usr
					    WHERE usr.usr_id = ufu.usr_id
                            AND ufu.fun_id = '%u'
                            AND ufu.ufu_removed IS NULL;", array($fun_id));       
        } else {
            $res = $db->query("SELECT ufu.ufu_id, ufu.usr_id, ufu.fun_id, ufu.ufu_service, usr.usr_lastname, usr.usr_firstname, usr.usr_nickname
					    FROM tj_usr_fun_ufu ufu, ts_user_usr usr
					    WHERE usr.usr_id = ufu.usr_id
                            AND ufu.fun_id IS NULL
                            AND ufu.ufu_removed IS NULL;", array());
        }
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
    public static function setRight($usr_id, $service, $fun_id) {
        if (!User::userExistById($usr_id)) {
            throw new \Payutc\Exception\SetRightException("User #$usr_id does not exist");
        }
        $already_set = true;
        try {
            if($fun_id) {
                static::check($usr_id, $service, true, $fun_id);
            } else {
                static::check($usr_id, $service, false);
            }
        } catch (Exception $e) {
            $already_set = false;
        }
        if ($already_set) {
            throw new \Payutc\Exception\RightAlreadyExistsException("L'utilisateur à déjà ce droit.");
        }

        $conn = Dbal::conn();
        $insert = array(
            "usr_id" => $usr_id,
            "ufu_inserted" => new \DateTime()
        );
        $type = array("integer", "datetime");
        
        // Si fun_id = 0 ou false ou NULL alors c'est un passe partout
        if($fun_id) {
            $insert['fun_id'] = $fun_id;
        } else {
            $insert['fun_id'] = null;
        }
        $type[] = "integer";

        // Si $service = 0 ou false ou NULL alors c'est un passe partout
        if($service) {
            $insert['ufu_service'] = $service;
        } else {
            $insert['ufu_service'] = null;
        }
        $type[] = "string";

        $conn->insert('tj_usr_fun_ufu', $insert, $type);
        $ufu_id = $conn->lastInsertId();

        if (!$ufu_id) {
            throw new \Payutc\Exception\SetRightException("Une erreur s'est produite lors de l'ajout du droit.");
        }

        return $ufu_id;
    }

	/**
	* Supprimer le droit
	* 
	*/
	public static function removeRight($usr_id, $service, $fun_id) {
        $db = DbBuckutt::getInstance();
        $query = "UPDATE tj_usr_fun_ufu SET ufu_removed=NOW() WHERE usr_id='%u' ";
        $var = array($usr_id);

        if($fun_id) {
            $query .= "AND fun_id='%u' ";
            $var[] = $fun_id;
        } else {
            $query .= "AND fun_id IS NULL ";
        }            

        if($service) {
            $query .= "AND ufu_service='%s' ";
            $var[] = $service;
        } else {
            $query .= "AND ufu_service IS NULL ";
        }  

        $db->query($query, $var);
		if ($db->affectedRows() == 0) {
			throw new \Payutc\Exception\SetRightException("Une erreur s'est produite lors de la supression du droit.");
		}	
	}

}

