<?php

/**
 * ApplicationRight.class
 * 
 * Gestion des droits Application <=> Service (<=> Fundation)
 * Table: tj_app_fun_afu
 */

use \Payutc\Db\Dbal;
use \Payutc\Db\DbBuckutt;

class ApplicationRight {
    protected $db;

    public function __construct() {
        $this->db = DbBuckutt::getInstance();        
    }
    
    /**
     * Verifie un tuple de droits.
     * Lorsque les droits n'existe pas throw an exception
     */
    public static function check($application_id, $service_name = false, $check_fundation = false, $fundation_id = NULL) {
        $db = DbBuckutt::getInstance();
        $req = "SELECT afu.afu_id FROM tj_app_fun_afu afu 
                            WHERE afu.app_id = '%u' 
                            AND (afu.afu_service = '%s' OR afu.afu_service IS NULL)
                            AND afu.afu_removed IS NULL ";

        if($check_fundation) {
            if($fundation_id) {
                $res = $db->query($req." AND (afu.fun_id = '%u' OR afu.fun_id IS NULL)", array($application_id, $service_name, $fundation_id));
            } else {
                $res = $db->query($req." AND afu.fun_id IS NULL", array($application_id, $service_name)); 
            }
        } else {
            $res = $db->query($req, array($application_id, $service_name));
        }

        if ($db->affectedRows() == 0) {
            if($fundation_id)
                throw new \Payutc\Exception\CheckRightException("L'application_id $application_id n'a pas les droits $service_name sur la fundation n°$fundation_id");
            else
                throw new \Payutc\Exception\CheckRightException("L'application_id $application_id n'a les droits $service_name sur aucune fundation");
        }
        return true;
    }

    /**
     * Retourne les fundations où l'application "application_id" à des droits sur "service_name"
     */
    public static function getFundations($application_id, $service_name) {
        $db = DbBuckutt::getInstance();
        $res = $db->query("SELECT fun.fun_id, fun.fun_name
                    FROM t_fundation_fun fun, tj_app_fun_afu afu
                    WHERE (afu.fun_id = fun.fun_id OR afu.fun_id is NULL)
                        AND afu.app_id = '%u'
                        AND (afu.afu_service = '%s' OR afu.afu_service IS NULL)
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
        $db = DbBuckutt::getInstance();
        if($fun_id) {
            $res = $db->query("SELECT afu.afu_id, afu.app_id, afu.fun_id, afu.afu_service
                        FROM tj_app_fun_afu afu
                        WHERE afu.fun_id = '%u'
                            AND afu.afu_removed is NULL;", array($fun_id));
        } else {
            $res = $db->query("SELECT afu.afu_id, afu.app_id, afu.fun_id, afu.afu_service
                        FROM tj_app_fun_afu afu
                        WHERE afu.fun_id IS NULL
                            AND afu.afu_removed is NULL;", array());
        }

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
        $allready_set = true;        
        try {
            if($app_id) {
                static::check($app_id, $service, true, $fun_id);
            } else {
                static::check($app_id, $service, false);
            }
        } catch (Exception $e) {
            $allready_set = false;
        }
        if($allready_set) {
            throw new Exception("L'application à déjà ce droit.");
        }

        $conn = Dbal::conn();
        $insert = array(
            "app_id" => $app_id,
            "afu_inserted" => new \DateTime()
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
            $insert['afu_service'] = $service;
        } else {
            $insert['afu_service'] = null;
        }
        $type[] = "string";

        $conn->insert('tj_app_fun_afu', $insert, $type);
        $afu_id = $conn->lastInsertId();

        if (!$afu_id) {
            throw new Exception("Une erreur s'est produite lors de l'ajout du droit.");
        }

        return $afu_id;
    }

    /**
    * Supprimer le droit
    * 
    */
    public static function removeRight($app_id, $service, $fun_id) {
        $db = DbBuckutt::getInstance();
        $query = "UPDATE tj_app_fun_afu SET afu_removed=NOW() WHERE app_id='%u' ";
        $var = array($app_id);

        if($fun_id) {
            $query .= "AND fun_id='%u' ";
            $var[] = $fun_id;
        } else {
            $query .= "AND fun_id IS NULL ";
        }            

        if($service) {
            $query .= "AND afu_service='%s' ";
            $var[] = $service;
        } else {
            $query .= "AND afu_service IS NULL ";
        }  

        $db->query($query, $var);
        if ($db->affectedRows() == 0) {
            throw new Exception("Une erreur s'est produite lors de la supression du droit.");
        }    
    }
}

