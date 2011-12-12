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
 * SADMIN.class
 * 
 * Classe pour le WSDL utilisé sur les clients type Fantomette pour la gestion de son compte perso
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/WsdlBase.class.php';
require_once 'class/Buyer.class.php';
require_once 'class/User.class.php';
require_once 'class/ComplexData.class.php';

class SADMIN extends WsdlBase {

    private  $User;

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
        $this->User = new User($data, $meanOfLogin, $pass, $ip);
        $this->Point = new Point(1);
        return $this->User->getState();
    }

	/**
	 * Teste si le user appartient à un groupe donné.
	 * 
	 * @param String $data
	 * @param int $meanOfLogin
	 * @param String $ip
	 * @param int $grp_id
	 * @return int $state
	 */
    public function isInGroup($data, $meanOfLogin, $ip, $grp_id) {
        $User = new User($data, $meanOfLogin, '', $ip, 1);
        $User->loadGroups();
        return $User->isInGroup($grp_id);
    }

    /**
     * Fonction qui renvoie l'historique des achats de l'utilisateur entre 2 dates
     * 
     * @param int $date_start
     * @param int $date_end
     * @return string $csv
     */
    public function getHistoriqueAchats($date_start, $date_end) {
		$txt = new ComplexData(array());
        $res = $this->db->query("SELECT UNIX_TIMESTAMP(pur.pur_date) AS pur_date, obj.obj_name, usr.usr_firstname, usr.usr_lastname, poi.poi_name, fun.fun_name, pur.pur_price FROM t_purchase_pur pur, t_object_obj obj, t_point_poi poi, ts_user_usr usr, t_fundation_fun fun WHERE pur.obj_id = obj.obj_id AND pur.poi_id = poi.poi_id AND pur.usr_id_seller = usr.usr_id AND pur.fun_id = fun.fun_id AND UNIX_TIMESTAMP(pur.pur_date) >= '%u' AND UNIX_TIMESTAMP(pur.pur_date) < '%u' AND usr_id_buyer = '%u' AND pur.pur_removed = '0' ORDER BY pur.pur_date DESC", Array($date_start, $date_end, $this->User->getId()));
		if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['pur_date'], $don['obj_name'], $don['usr_firstname'], $don['usr_lastname'], $don['poi_name'], $don['fun_name'], $don['pur_price']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }

    /**
     * Fonction qui renvoie l'historique des achats de l'utilisateur entre 2 dates
     * 
     * @param int $date_start
     * @param int $date_end
     * @return string $csv
     */
    public function getHistoriqueRecharge($date_start, $date_end) {
		$txt = new ComplexData(array());
        $res = $this->db->query("SELECT UNIX_TIMESTAMP(rec.rec_date) AS rec_date, rty.rty_name, usr.usr_firstname, usr.usr_lastname, poi.poi_name, rec.rec_credit FROM t_recharge_rec rec, t_recharge_type_rty rty, t_point_poi poi, ts_user_usr usr WHERE rec.rty_id = rty.rty_id AND rec.poi_id = poi.poi_id AND rec.usr_id_operator = usr.usr_id AND UNIX_TIMESTAMP(rec.rec_date) >= '%u' AND UNIX_TIMESTAMP(rec.rec_date) < '%u' AND rec.usr_id_buyer = '%u' AND rec.rec_removed = '0' ORDER BY rec.rec_date DESC", Array($date_start, $date_end, $this->User->getId()));
		if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['rec_date'], $don['rty_name'], $don['usr_firstname'], $don['usr_lastname'], $don['poi_name'], $don['rec_credit']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }	

    /**
     * Fonction pour se blocker soi meme (en cas de perte/vol par exemple)
     * 1:Le compte a été changé
     * 440:L'utilisateur n'existe pas
     * 441:Il ne s'agit pas du bon code PIN
     * @param String $pin
     * @return int $state
     */
    public function blockMe($pin) {
    	if($this->User->checkPass($pin) == 1) {
            if ($this->User->blockMe()) {
                $state = 1;
            } else { $state = 440; }    		
    	 } else {
            $state = 441;
        }
		return $state;
    }
	
    /**
     * Changer son propre mot de passe avec toutes les vérifications de sécurité
     * 1:Le mot de passe a été changé
     * -1:Tous les champs ne sont pas remplis
     * -2:Les newKey sont différents
     * -3:La newKey n'est pas un chiffre ou n'a pas une longueur de 4 chiffres
     * -4:La newKey est trop simple
     * -5:$oldKey n'est pas le bon
     * @return int $state
     * @param String $oldKey
     * @param String $newKey1
     * @param String $newKey2
     */
    public function changeKeySecure($oldKey, $newKey1, $newKey2) {
        if (!empty($oldKey) && !empty($newKey1) && !empty($newKey2)) {
            if ($newKey1 === $newKey2) {
                if (is_int($newKey1) || strlen($newKey1) === 4) {
                // On vérifie si ce n'est ni une quadruplé ni une suite
                    if (!($newKey1[0] == $newKey1[1] && $newKey1[1] == $newKey1[2] && $newKey1[2] == $newKey1[3]) ||
                        !($newKey1[0] == $newKey1[1]+1 && $newKey1[1]+1 == $newKey1[2]+2 && $newKey1[2]+2 == $newKey1[3]+3) ||
                        !($newKey1[0] == $newKey1[1]-1 && $newKey1[1]-1 == $newKey1[2]-2 && $newKey1[2]-2 == $newKey1[3]-3)) {
                         if($this->User->checkPass($oldKey) == 1) {
				            if ($this->User->setPass($oldKey, $newKey1)) {
				                $state = 1;
				            } 
				    	 }
						 else { 
							$state = -5; 
						}    		
                    } else {  $state = -4; }
                } else { $state = -3; }
            } else { $state = -2; }
        } else { $state = -1; }
        return $state;
    }
	
    /**
     * Reset son propre mot de passe et l'envoi par mail
     * 0:Ok sa marche
     * 1:Pas d'email
     * 2:pas d'user
     * 3:Modif du pass impossible
     * 4:mail pas partie
     * @return int $state
     * @param String $usr_id
     * @param String $email
     */
    public function resetKey($usr_id, $email) {
        $rand=rand(0, 9999);
        if ($rand < 100){
                $rand="00".$rand;
        }else if ($rand <1000){
                $rand="0".$rand;
        }
        if(empty($email)){
            return 1;
        }elseif(empty($usr_id)){
            return 2;
        }
        $Buyer=new Buyer($usr_id, 1, '', '', 1);
        $this->db->query("UPDATE ts_user_usr SET usr_pwd='%s' WHERE usr_id='%u'", Array(md5($rand), $Buyer->getId()));
        $nb = $this->db->affectedRows();
        if($nb != 1) {
            return 3;
        }
        $subject = 'Changement code PIN BuckUTT';
        $message = "<p>Bonjour,</p>
        <p>Tu as demandé un nouveau code PIN et bah le voila</p>
		<p>CODE PIN = $rand</p>";
        $headers = 'From: buckutt@utt.fr' . "\r\n" .
	'Content-Type: text/html; charset="UTF-8"'."\r\n" .
        'Reply-To: buckutt@utt.fr' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        $err=mail($email, $subject, $message, $headers);
        if (!$err){
            return 4;
        }else{
	    $this->db->query("UPDATE ts_user_usr SET usr_blocked=0 WHERE usr_id='".$Buyer->getId()."'");
            $nb = $this->db->affectedRows();
	  //  if($nb != 1){
	//	return 5;
	  //  }
            return 0;
        }
    }	
	
    /**
     * Retourne si oui ou non l'user est admin d'une partie de buckutt
     * @return int $state
     */
    public function isAdminBuckutt() {
        if (isset($this->User)) {
            return $this->User->isAdminBuckutt();
        } else {
            return 409;
        }
    }
	
    /**
     * Retourne si l'user à le droit de bloquer ou débloquer un autre user
     * @return int $state
     */
    public function isBloqueur() {
        if (isset($this->User)) {
            return $this->User->isBloqueur();
        } else {
            return 409;
        }
	}
	
    /**
     * Retourne si l'user à le droit de donner des droits à tous
     * @return int $state
     */
    public function isDroitAdmin() {
        if (isset($this->User)) {
            return $this->User->isDroitAdmin();
        } else {
            return 409;
        }
	}
	
    /**
     * Retourne si l'user à le droit de consulter la tréso de buckutt
     * @return int $state
     */
    public function isBuckuttTrezo() {
        if (isset($this->User)) {
            return $this->User->isBuckuttTrezo();
        } else {
            return 409;
        }
	}
		
    /**
     * Retourne si l'user à le droit de gérer les fundations
     * @return int $state
     */
    public function isRespFundations() {
        if (isset($this->User)) {
            return $this->User->isRespFundations();
        } else {
            return 409;
        }
	}
	
    /**
     * Retourne si l'user à le droit de gérer les ventes dans sa fundation
     * @param int $id_fundation
     * @return int $state
     */
    public function isVenteAdmin($id_fundation) {
        if (isset($this->User)) {
            return $this->User->isVenteAdmin($id_fundation);
        } else {
            return 409;
        }
	}
	
    /**
     * Retourne si l'user à le droit de gérer les fundations
     * @return int $state
     */
    public function isPointAdmin() {
        if (isset($this->User)) {
            return $this->User->isPointAdmin();
        } else {
            return 409;
        }
	}	
	
    /**
     * Retourne si l'user à le droit de gérer les groupes dans sa fundation
     * @param int $id_fundation
     * @return int $state
     */
    public function isGroupEditor($id_fundation) {
        if (isset($this->User)) {
            return $this->User->isGroupEditor($id_fundation);
        } else {
            return 409;
        }
	}
	
    /**
     * Retourne si l'user à le droit de gérer la trésorerie dans sa fundation
     * @param int $id_fundation
     * @return int $state
     */
    public function isFundTrezo($id_fundation) {
        if (isset($this->User)) {
            return $this->User->isFundTrezo($id_fundation);
        } else {
            return 409;
        }
	}	
	
	/**
	* Retourne $droits.
	* 
	* @return array $droits
	*/
	public function getUserDroits() {
		return $this->User->getDroits();
	}		
	
    /**
     * Retourne un csv qui contient les id_fundation et les name_fundation dont l'user à des droits
     * @return String $txt
     */
    public function hasDroitsInFundations() {
        if (isset($this->User)) {
	        $txt = new ComplexData(array());
	        $array = array();
        	foreach ($this->User->getDroits() as $value) {
        		if($value['fun_id'] != 0)
					$array[$value['fun_id']] = $value['fun_name'];
       		}
			foreach ($array as $key => $value) {
        		$txt->addLine(array($key, $value));
       		}
      		return $txt->csvArrays();
        } else {
            return 409;
        }
    }	
	
	
	
	
	
	
	






























    /**
     * Retourne un csv qui contient les id_fundation, id_point en fonction de ses droits
     * @param String $droit [optional]
     * @return String $txt
     */    
    public function getDroits($droit = '') {
        if (isset($this->user)) {
	        $txt = new ComplexData(array());
	        if ($droit == '') {
               	foreach ($this->user->getDroits() as $don) {
		            $txt->addLine(array($don['droit'], $don['fundation']->getId(), $don['fundation']->getName(), $don['id_point']));
	            }
	        } else {
	        	foreach ($this->user->getDroits() as $i => $don) {
    	    		$key = in_array($droit, $don);
    	    		if ($key) {
    	    			$txt->addLine(array($don['fundation']->getId(), $don['fundation']->getName(), $don['id_point']));
    	    		}
        		}
        	}
      		return $txt->csvArrays();
        } else {
            return 409;
        }
    }
	

	








}



/*TEST DE SOAP-ISATION PAR CLASSE*/
$name_class = 'SADMIN';
require('inc/wsdl.inc.php');

?>
