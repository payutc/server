<?php

/**
 * Blocked.class
 * 
 * Gestion des blocages
 * Table: tj_usr_fun_blocked_blo
 */

namespace Payutc\Bom;
use \Payutc\Exception\UserIsBlockedException;
use \Payutc\Db\DbBuckutt;
use \Payutc\Db\Dbal;

class Blocked {
    protected $db;

    public function __construct() {
        $this->db = DbBuckutt::getInstance();        
    }
    
    /**
     * Verifie si un utilisateur est bloqué ou non
     * (Si l'utilisateur est bloqué plusieurs fois en meme temps, seul un des blocages sera retournés).
     * Si un user est bloqué return array ("blo_id", "blo_raison", "blo_insert", "blo_removed", "fun_id")
     * sinon return false
     */
	public static function userIsBlocked($usr_id, $fun_id=NULL) {
        $qb = Dbal::createQueryBuilder();
        
        $qb->select('blo.blo_id', 'blo.blo_raison', 'blo.blo_insert', 'blo.blo_removed', 'blo.fun_id')
            ->from('tj_usr_fun_blocked_blo', 'blo')
            ->where('blo.usr_id = :usr_id')
            ->andWhere($qb->expr()->orX(
                $qb->expr()->gt('blo.blo_removed', 'NOW()'),
                $qb->expr()->isNull('blo.blo_removed')
            ))
            ->andWhere('blo.blo_insert < NOW()')
            ->setParameter('usr_id', $usr_id)
            ->setMaxResults(1);
        
        if($fun_id != NULL) {
            $qb->andWhere($qb->expr()->orX(
                    $qb->expr()->eq('blo.fun_id', ':fun_id'),
                    $qb->expr()->isNull('blo.fun_id')
                ))
                ->setParameter('fun_id', $fun_id);
        }
        
        $result = $qb->execute()->fetch();
		return $result;
    }

    /**
     * Renvoie une Exception si l'usr est bloqué
     */
    public static function checkUsrNotBlocked($usr_id, $fun_id=NULL) {
        $temp = Blocked::userIsBlocked($usr_id, $fun_id);   
        if($temp != false) {
            throw new UserIsBlockedException("L'utilisateur à été bloqué pour le motif suivant: " . $temp["blo_raison"]);
        }
    }
    
    /**
     * Bloque un utilisateur
     */
    public static function block($usr_id, $fun_id, $raison, $fin=NULL, $debut=NULL) {
        $db     = DbBuckutt::getInstance();
        $insert_data = array();
        // Construction de la requete
        $req    = "INSERT INTO tj_usr_fun_blocked_blo ";
        $req   .= "(usr_id, fun_id, blo_raison, blo_insert, blo_removed) VALUES (";
        $req   .= "'%u', ";     $insert_data[] = $usr_id;
        if($fun_id == NULL) {
            $req .= "NULL, ";
        } else {
            $req .= "'%u', ";   $insert_data[] = $fun_id;
        }
        $req   .= "'%s', ";     $insert_data[] = $raison;
        if($debut == NULL) {
            $req .= "NOW(), ";
        } else {
            $req .= "'%s', ";   $insert_data[] = $debut->format("Y-m-d H:i:s");
        }
        if($fin == NULL) {
            $req .= "NULL ";
        } else {
            $req .= "'%s' ";    $insert_data[] = $fin->format("Y-m-d H:i:s");
        }        
        $req   .= ")";
        $db->query($req, $insert_data);
        if ($db->affectedRows() != 1) {
			throw new Exception("Une erreur s'est produite lors du blocage de l'utilisateur.");
		}
        return $db->insertId();
    }

    /**
     * Retourne les blocages
     */
    public static function getAll($fun_id=NULL, $usr_id=NULL) {
        $db = DbBuckutt::getInstance();
        $req = "SELECT blo.* , usr.usr_firstname, usr.usr_lastname, usr.usr_nickname AS login
FROM tj_usr_fun_blocked_blo blo, ts_user_usr usr
WHERE blo.usr_id = usr.usr_id ";
        $param = array();
        if($fun_id != NULL) {
            $req .= " AND blo.fun_id = '%u' ";
            $param[] = $fun_id;
        } else {
            $req .= " AND blo.fun_id IS NULL ";
        }
        if($usr_id != NULL) {
            $req .= " AND blo.usr_id = '%u' ";
            $param[] = $usr_id;
        } else {
            $req .= " AND (blo.blo_removed > NOW() OR blo.blo_removed IS NULL) ";
        }
        $req .= " ORDER BY blo.blo_insert ASC ";
        $res = $db->query($req, $param);
        $result = array();
        if ($db->affectedRows() >= 1) {
			while ($don = $db->fetchArray($res)) {
                $result[$don["blo_id"]] = array(); 
                // On ne retourne pas directement $don pour éviter de transférer les données en double (il y'a l'index numérique et l'index textuel)
                $result[$don["blo_id"]]["blo_id"] = $don["blo_id"];
                $result[$don["blo_id"]]["blo_raison"] = $don["blo_raison"];
                $result[$don["blo_id"]]["blo_insert"] = $don["blo_insert"];
                $result[$don["blo_id"]]["blo_removed"] = $don["blo_removed"];
                $result[$don["blo_id"]]["fun_id"] = $don["fun_id"];
                $result[$don["blo_id"]]["usr_firstname"] = $don["usr_firstname"];
                $result[$don["blo_id"]]["usr_lastname"] = $don["usr_lastname"];
                $result[$don["blo_id"]]["login"] = $don["login"];
			}
        }
        return $result;
    }

    /**
     * Edite un blocage
     * On ne peut pas modifier la fun_id, mais quand le parametre est passé il est pris en compte dans le where
     * Ainsi la gestion des droits en ammonts peut verifier que l'on a bien le droit d'agir sur cette fundation la
     * Et nous on s'assure que le blo_id donné appartient bien à la fundation qui le concerne.
     *
     * On ne peut pas modifier les blo_id dont blo_removed < NOW() (Dans le but de ne pas pouvoir altérer l'historique)
     * La modification permet de déclarer une date de fin 
     */
    public static function edit($blo_id, $fun_id=NULL, $raison=NULL, $fin=NULL) {
        $db = DbBuckutt::getInstance();
        $param = array();
        $req = "UPDATE tj_usr_fun_blocked_blo SET ";
        if($raison != NULL) {
            $req .= "blo_raison = '%s', ";
            $param[] = $raison;
        }
        if($fin != NULL) {
            $req .= "blo_removed = '%s' ";
            $param[] = $fin->format("Y-m-d H:i:s");
        }
        $req .= " WHERE blo_id = '%u' AND (blo_removed < NOW() OR blo_removed IS NULL) ";
        $param[] = $blo_id;
        if($fun_id != NULL) {
            $req .= " AND fun_id = '%u' ";
            $param[] = $fun_id;
        }
        //return $req." ".print_r($param, true);
        $db->query($req, $param);
        if ($db->affectedRows() != 1) {
			throw new Exception("Une erreur s'est produite lors de l'edition du blocage utilisateur.");
		}
        return true;
    }

}

