<?php 
/**
    BuckUTT - Buckutt est un système de paiement avec porte-monnaie électronique.
    Copyright (C) 2011 BuckUTT <buckutt@utt.fr>

	This file is part of BuckUTT
	
    BuckUTT is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    BuckUTT is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * BADMIN.class
 * 
 * Classe pour le WSDL utilisé sur les clients type Fantomette
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */
 
require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';

require_once 'class/WsdlBase.class.php';
require_once 'class/ComplexData.class.php';
require_once 'class/Fundation.class.php';
require_once 'class/User.class.php';
require_once 'class/Right.class.php';
require_once 'class/Point.class.php';



require_once 'class/Right.class.php'; //TODO Be careful : Right maintenant

class BADMIN extends WsdlBase {
	
	protected $User;
    
    /**
     * Constructeur qui chope la conexion a la DB
     * @return
     */
    public function __construct() {
        $this->db = Db_buckutt::getInstance();
    }
    
	/**
	 * Connecter le user.
	 * 
	 * @param String $data
	 * @param String $passwd
	 * @param int $meanOfLogin
	 * @param String $ip
	 * @return int $state
	 */
    public function login($data, $meanOfLogin, $pass, $ip) {
    	unset($this->User);
        $this->User = new User($data, $meanOfLogin, $pass, $ip);
        return $this->User->getState();
    }
	    
    /**
     * Retourne la liste de toutes les fondations actives
     * @return String $txt
     */
    public function getAllFundations() {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT fun_id, fun_name FROM t_fundation_fun WHERE fun_removed='0' ORDER BY fun_name ASC");
        if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['fun_id'], $don['fun_name']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }
	
    /**
     * Ajouter un organisme
     * @return int $id
     * @param String $name
     */
    public function addFundation($name) {
    	if($this->User->isRespFundations() != 1)
			return 400;	  

        $Fundation = new Fundation(0, html_entity_decode($name));
        return $Fundation->getState();
    }
    /**
     * Edite le nom d'un organisme
     * @return bool $state
     * @param int $id_fundation
     * @param String $name_fundation
     */
    public function editFundationName($id_fundation, $name) {
    	if($this->User->isRespFundations() != 1)
			return 400;	  

    	$Fundation = new Fundation($id_fundation);
		$Fundation->setName(html_entity_decode($name));
		return $Fundation->getState();
    }
	
    /**
     * Supprime un organisme
     * @return int $state
     * @param int $id_droit
     */
    public function deleteFundation($id_fundation) {
    	if($this->User->isRespFundations() != 1)
			return 400;	  

        $Fundation = new Fundation($id_fundation);
		$Fundation->remove();
		return $Fundation->getState();
    }
	
    /**
     * Retourne la liste de tous les points actifs
     * @return String $txt
     */
    public function getAllPoints() {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT poi_id, poi_name FROM t_point_poi WHERE poi_removed='0' ORDER BY poi_name ASC");
        if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['poi_id'], $don['poi_name']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }
	
    /**
     * Ajouter un point
     * @return int $id
     * @param String $name
     */
    public function addPoint($name) {
    	if($this->User->isPointAdmin() != 1)
			return 400;	  

        $Point = new Point(0, html_entity_decode($name));
        return $Point->getState();
    }
    /**
     * Edite le nom d'un point
     * @return bool $state
     * @param int $id_point
     * @param String $name
     */
    public function editPointName($id_point, $name) {
    	if($this->User->isPointAdmin() != 1)
			return 400;	  

    	$Point = new Point($id_point);
		$Point->setName(html_entity_decode($name));
		return $Point->getState();
    }
    /**
     * Supprime un point
     * @return bool $state
     * @param int $id_point
     */
    public function deletePoint($id_point) {
    	if($this->User->isPointAdmin() != 1)
			return 400;	    	
		    	
		$Point = new Point($id_point);
		$Point->remove();
		return $Point->getState();
    }
	
    /**
     * Retourne la liste de toutes les droits actifs
     * @return String $txt
     */
    public function getAllRights() {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT rig_name, rig_description, rig_admin FROM ts_right_rig WHERE rig_removed='0' ORDER BY rig_name ASC");
        if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['rig_name'], $don['rig_description'], $don['rig_admin']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }	
	
    /**
     * Retourne la liste de toutes les droits actifs sans détails
     * @return String $txt
     */
    public function getAllRightsAdminLight() {
    	if($this->User->isDroitAdmin() != 1)
			return 400;	    	
		
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT rig_id, rig_name, rig_admin FROM ts_right_rig WHERE rig_removed='0' ORDER BY rig_name ASC");
        if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['rig_id'], $don['rig_name']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
	}	
	
    /**
     * Retourne la liste de tous les users ayant ce droit
     * @param int $id_droit
     * @return String $txt
     */
    public function getAllUsersFromRight($rig_id) {
    	if($this->User->isDroitAdmin() != 1)
			return 400;	    	
		
        $txt = new ComplexData(array());
        $res = $this->db->query("
SELECT 
jur.jur_id, usr.usr_id, usr.usr_firstname, usr.usr_lastname, 
UNIX_TIMESTAMP(per.per_date_start) AS per_date_start,  UNIX_TIMESTAMP(per.per_date_end) AS per_date_end, 
poi.poi_id, poi.poi_name, 
fun.fun_id, fun.fun_name 

FROM 
  tj_usr_rig_jur jur 

    INNER JOIN ts_user_usr usr 
      ON jur.usr_id = usr.usr_id 

    INNER JOIN t_period_per per 
      ON jur.per_id = per.per_id 

    LEFT JOIN t_point_poi poi
      ON jur.poi_id = poi.poi_id 

    LEFT JOIN t_fundation_fun fun
      ON jur.fun_id = fun.fun_id 

WHERE 
jur.jur_removed = '0' AND 
per.per_date_start <= NOW() AND 
per.per_date_end >= NOW() AND 
jur.rig_id = '%u'

ORDER BY fun.fun_name, usr.usr_lastname", Array($rig_id));
        if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				if(empty($don['poi_id']))
	        		$don['poi_name'] = "Aucun";
				if(empty($don['fun_id']))
	        		$don['fun_name'] = "Aucune";
				$txt->addLine(array($don['jur_id'], $don['usr_id'], $don['usr_firstname'], $don['usr_lastname'], $don['per_date_start'], $don['per_date_end'], $don['poi_id'], $don['poi_name'], $don['fun_id'], $don['fun_name']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }
	
    /**
     * Ajoute un droit à un mec entre 2 dates !
     * @return bool $state
     * @param int  $id_droit
     * @param int  $id_user
     * @param int  $date_start
     * @param int  $date_end
     * @param int  $point
     * @param int  $fundation
     */
    public function addUserToRight($id_droit, $id_user, $date_start, $date_end, $point, $fundation) {
    	if($this->User->isDroitAdmin() != 1)
			return 400;	    	
		
		$Right = new Right($id_droit);
        $state = $Right->addUserToDroit($id_user, $date_start, $date_end, $point, $fundation);
        return $state;
    }
	
    /**
     * Detruit les inscription d'un user a un droit si celle ci termine apres now
     * Renvoi le nombre d'inscription ainssi detrouite (des inscription a des groupes peuvent se chevaucher)
     * @return int $affected
     * @param int $id_droit
     * @param int $id_link
     */
    public function deleteUserFromRight($id_droit, $id_link) {
    	if($this->User->isDroitAdmin() != 1)
			return 400;	    	
		
        $Right = new Right($id_droit);
        $state = $Right->removeUserFromDroit($id_link);
        return $state;
    }
	
    /**
     * Retourne la liste de tous les utilisateurs bloqués
     * @return String $txt
     */
    public function getAllBlockedUsers() {
    	if($this->User->isBloqueur() != 1)
			return 400;	    	

        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT usr_id, usr_firstname, usr_lastname FROM ts_user_usr WHERE usr_blocked='1' ORDER BY usr_lastname ASC");
        if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['usr_id'], $don['usr_firstname'], $don['usr_lastname']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }	
	
	/**
	 * Débloquer qqn
	 * 
	 * @return int $state
	 * @param int $usr_id
	 */
	public function deblockUser($usr_id) {
    	if($this->User->isBloqueur() != 1)
			return 400;			
		
		$User = new User($usr_id, 3, '', '', 1);
		$User->deblock();
		return $User->getState();
	}
	
	/**
	 * Bloquer qqn
	 * 
	 * @return int $state
	 * @param int $usr_id
	 */
	public function blockUser($usr_id) {
    	if($this->User->isBloqueur() != 1)
			return 400;		
		
		$User = new User($usr_id, 3, '', '', 1);
		$User->blockMe();
		return $User->getState();
	}	
	

    /**
     * Fonction qui renvoie les rechargements entre 2 dates
     * 
     * @param int $date_start
     * @param int $date_end
     * @return string $csv
     */
    public function getRecharge($date_start, $date_end) {
    	if($this->User->isBuckuttTrezo() != 1)
			return 400;
			
		$txt = new ComplexData(array());
        $res = $this->db->query("SELECT rty_name, sum(rec_credit) AS total, poi_name FROM t_recharge_rec rec, t_recharge_type_rty rty, t_point_poi poi WHERE rec.poi_id = poi.poi_id AND rec.rty_id = rty.rty_id AND rty.rty_removed = '0' AND UNIX_TIMESTAMP(rec.rec_date) >= '%u' AND UNIX_TIMESTAMP(rec.rec_date) < '%u' GROUP BY rec.rty_id, rec.poi_id ORDER BY rty.rty_name", Array($date_start, $date_end));
		if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['rty_name'], $don['total'], $don['poi_name']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }		
	
    /**
     * Fonction qui renvoie les ventes entre 2 dates
     * 
     * @param int $date_start
     * @param int $date_end
     * @return string $csv
     */
    public function getPurchase($date_start, $date_end) {
    	if($this->User->isBuckuttTrezo() != 1)
			return 400;    	
		
		$txt = new ComplexData(array());
        $res = $this->db->query("SELECT fun_name, sum(pur_price) AS total, poi_name FROM t_purchase_pur pur, t_fundation_fun fun, t_point_poi poi WHERE pur.poi_id = poi.poi_id AND pur.fun_id = fun.fun_id AND pur.pur_removed = '0' AND UNIX_TIMESTAMP(pur.pur_date) >= '%u' AND UNIX_TIMESTAMP(pur.pur_date) < '%u' GROUP BY pur.fun_id ORDER BY fun.fun_name", Array($date_start, $date_end));
		if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['fun_name'], $don['total'], $don['poi_name']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }		
	
    /**
     * Fonction qui renvoie l'épargne actuelle...
     * 
     * @return int $amount
     */
    public function getEpargne() {
    	if($this->User->isBuckuttTrezo() != 1)
			return 400;
		
		if ($this->db->numRows($amount = $this->db->query("SELECT sum(usr_credit) AS total FROM ts_user_usr;")) == 1) {
			return $this->db->result($amount);
		} else {
			return 400;
		}	
    }		
}

/*SOAP-ISATION PAR CLASSE*/
$name_class = 'BADMIN';
require ('inc/wsdl.inc.php');

?>
