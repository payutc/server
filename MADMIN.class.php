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
 * MADMIN.class
 * 
 * Classe pour le WSDL utilisé sur les clients type Casper pour la gestion de son compte perso
 * @author BuckUTT <buckutt@utt.fr>, PAYUTC <payutc@utc.fr>
 * @version 3.0
 * @package payutc
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/WsdlBase.class.php';
require_once 'class/Buyer.class.php';
require_once 'class/User.class.php';
require_once 'class/ComplexData.class.php';
require_once 'class/Paybox.class.php';
require_once 'class/Cas.class.php';
require_once 'config.inc.php';
require_once 'class/Log.class.php';

class MADMIN extends WsdlBase {

    private  $User;
	private $loginToRegister;

    /**
     * Constructeur qui chope la conexion a la DB
     * @return
     */
    public function __construct() {
        $this->db = Db_buckutt::getInstance();
    }
    
    /**
	 * Connecter le user avec un ticket CAS.
	 * 
	 * @param String $ticket
	 * @param String $service
	 * @return array $state
	 */
    public function loginCas($ticket, $service) {
		$login = Cas::authenticate($ticket, $service);
        if ($login < 0) {
   			return array("error"=>-1, "error_msg"=>"Erreur de login CAS.");
        }
		$this->User = new User($login, 1, "", 0, 1, 0);
	
		$r = $this->User->getState();
		if($r == 405){
			$this->loginToRegister = $login;
			return array("error"=>$r, "error_msg"=>"Le user n'existe pas ici.");
		}
		elseif($r != 1) {
			return array("error"=>$r, "error_msg"=>"Le user n'a pas pu être chargé.");
		}
		else {
			return array("success"=>"ok");
		}
    }
	
	 /**
	 * Enregistrer le user précédemment déclaré en CAS
	 * 
	 * @return array $state
	 */
    public function register() {
		global $_CONFIG;
		
		$this->User = new User($this->loginToRegister, 1, "", 0, 1, 0);
	
		$r = $this->User->getState();
		
		if($r != 405){
			return array("error"=>$r, "error_msg"=>"Le user existe déjà.");
		}
		
		// On vérifie que le user est bien cotisant @TODO
		if(!array_key_exists($this->loginToRegister, $_CONFIG['users_demo'])){
			return array("error"=>400, "error_msg"=>"Le user n'est pas cotisant.");
		}
		
		// On est là, on va pouvoir insérer
		$user = $_CONFIG['users_demo'][$this->loginToRegister];
		
        $this->db->query("INSERT INTO ts_user_usr (usr_pwd, usr_firstname, usr_lastname, usr_nickname, usr_mail) VALUES ('81dc9bdb52d04dc20036dbd8313ed055', '%s', '%s', '%s', '%s')", array($user[0], $user[1], $this->loginToRegister, $user[3]));
		$userid = $this->db->insertId();
		$this->db->query("INSERT INTO tj_usr_mol_jum (usr_id, mol_id, jum_data) VALUES (%d, 1, '%s')", array($userid, $this->loginToRegister));
		$this->db->query("INSERT INTO tj_usr_mol_jum (usr_id, mol_id, jum_data) VALUES (%d, 5, '%s')", array($userid, $user[2]));

		
        $this->db->query("INSERT INTO t_recharge_rec (rty_id, usr_id_buyer, usr_id_operator, poi_id, rec_date, rec_credit, rec_trace) VALUES ('%u', '%u', '%u', '%u', NOW(), '%u', '%s')", array(7, $userid, $userid, 1, $user[4], "Import demo"));
		$this->db->query("UPDATE ts_user_usr SET usr_credit = (usr_credit + '%u') WHERE usr_id = '%u';", Array($user[4], $userid));
		
		// Maintenant on devrait pouvoir se logguer
		$this->User = new User($this->loginToRegister, 1, "", 0, 1, 0);
	
		$r = $this->User->getState();
		if($r != 1) {
			return array("error"=>$r, "error_msg"=>"Le user n'a pas pu être chargé.");
		}
		else {
			return array("success"=>"ok");
		}
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
			return $txt->csvArrays();
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
			return $txt->csvArrays();
		}
    }

    /**
     * Fonction qui renvoie l'historique des virements emis de l'utilisateur entre 2 dates
     * 
     * @param int $date_start
     * @param int $date_end
     * @return string $csv
     */
    public function getHistoriqueVirementOut($date_start, $date_end) {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT UNIX_TIMESTAMP(vir.vir_date) AS vir_date, vir.vir_amount, usr_to.usr_firstname, usr_to.usr_lastname 
            FROM t_virement_vir vir, ts_user_usr usr_to  
            WHERE vir.usr_id_to = usr_to.usr_id AND UNIX_TIMESTAMP(vir.vir_date) >= '%u' AND UNIX_TIMESTAMP(vir.vir_date) < '%u' AND vir.usr_id_from = '%u' ORDER BY vir.vir_date DESC"
            , Array($date_start, $date_end, $this->User->getId()));
        if ($this->db->affectedRows() >= 1) {
            while ($don = $this->db->fetchArray($res)) {
                $txt->addLine(array($don['vir_date'], $don['vir_amount'], $don['usr_firstname'], $don['usr_lastname'], "out"));
            }
            return $txt->csvArrays();
        } else {
            return $txt->csvArrays();
        }
    }

    /**
     * Fonction qui renvoie l'historique des virements reçu par l'utilisateur entre 2 dates
     * 
     * @param int $date_start
     * @param int $date_end
     * @return string $csv
     */
    public function getHistoriqueVirementIn($date_start, $date_end) {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT UNIX_TIMESTAMP(vir.vir_date) AS vir_date, vir.vir_amount, usr_from.usr_firstname, usr_from.usr_lastname 
            FROM t_virement_vir vir, ts_user_usr usr_from  
            WHERE vir.usr_id_from = usr_from.usr_id AND UNIX_TIMESTAMP(vir.vir_date) >= '%u' AND UNIX_TIMESTAMP(vir.vir_date) < '%u' AND vir.usr_id_to = '%u' ORDER BY vir.vir_date DESC"
            , Array($date_start, $date_end, $this->User->getId()));
        if ($this->db->affectedRows() >= 1) {
            while ($don = $this->db->fetchArray($res)) {
                $txt->addLine(array($don['vir_date'], $don['vir_amount'], $don['usr_firstname'], $don['usr_lastname'], "in"));
            }
            return $txt->csvArrays();
        } else {
            return $txt->csvArrays();
        }
    }	

     /**
     * Renvoi le crédit du user.
     * 
     * @return int $credit
     */
    public function getCredit() {
        return $this->User->getCredit();
    }	

	/**
	* Retourne le firstname
	* 
	* @return string $firstname
	*/
	public function getFirstname() {
		return $this->User->getFirstname();
	}

	/**
	* Retourne le lastname
	* 
	* @return string $lastname
	*/
	public function getLastname() {
		return $this->User->getLastname();
	}

    /**
    * Fonction pour connaitre le montant minimum que l'on peut recharger
    * 
    * @return int $minimum
    */
    public function getMinReload() {
        global $_CONFIG;
        $Buyer_credit = $this->User->getCredit();
        $max = $_CONFIG['credit_max'] - $Buyer_credit;
        if($max < $_CONFIG['rechargement_min'])
            return 0;
        else
            return $_CONFIG['rechargement_min'];
    }

    /**
    * Fonction pour connaitre le montant maximum que l'on peut recharger
    * 
    * @return int $maximum
    */
    public function getMaxReload() {
        global $_CONFIG;
        $Buyer_credit = $this->User->getCredit();
        $max = $_CONFIG['credit_max'] - $Buyer_credit;
        if($max < $_CONFIG['rechargement_min'])
            return 0;
        else
            return $max;
    }

    /**
    * Fonction pour vérifier qu'un client peut recharger d'un certain montant
    * Il n'est pas obligatoire de l'appeler avant reload($amount)
    * Mais le retour de reload si on a pas le droit de recharger sera beaucoup moins "joli"
    * 
    * @param int $amount (en centimes)
    * @return int $code
    */
    public function canReload($amount) {
        global $_CONFIG;
        if($amount < $_CONFIG['rechargement_min'])
            return 452; // TODO : Créer un code d'erreur plus adapté !
        $Buyer_credit = $this->User->getCredit();
        if ($Buyer_credit >= $_CONFIG['credit_max'])
            return 450;
        if (($Buyer_credit + $amount) > $_CONFIG['credit_max'])
            return 451;
        return 1;
    }

	 /**
     * Fonction pour recharger un client.
     * 
     * @param int $amount (en centimes)
     * @param String $callbackUrl
     * @return String $page
     */
     
    public function reload($amount, $callbackUrl) {
			  // Peut-il se recharger d'un tel montant
			  $auth = $this->canReload($amount);
			  if($auth != 1)
					return "<error>".$this->getErrorDetail($auth)."</error>";

        $pb = new Paybox($this->User);
        return $pb->execute($amount, $callbackUrl);
    }
    
    /**
     * Fonction pour se blocker soi meme (en cas de perte/vol par exemple)
     * 1:Le compte a été changé
     * 440:L'utilisateur n'existe pas
     * @return int $state
     */
    public function blockMe() {
		if ($this->User->blockMe()) {
			$state = 1;
		} else { $state = 440; }    		
		return $state;
    }
    
    /**
     * Fonction pour se déblocker soi meme (en cas de perte/vol par exemple)
     * 1:Le compte a été changé
     * 440:L'utilisateur n'existe pas
     * @return int $state
     */
    public function deblock() {
		if ($this->User->deblock()) {
			$state = 1;
		} else { $state = 440; }    		
		return $state;
    }
	
    /**
    * Fonction pour connaitre l'état du compte (bloqué/débloqué)
    * 
    * @return int $valid
    */
    public function isBlocked() {
        return $this->User->isblocked();
    }
	
    /**
     * VIREMENT
     * 
     * @param int $amount montant du virement en centimes
     * @param int $userID Id de la personne a qui l'on vire de l'argent.
     * @return int $error (1 c'est que tout va bien sinon faut aller voir le code d'erreur)
     */
    public function transfert($amount, $userID) {
        if($amount < 0) {
            Log::write("TRANSFERT D'ARGENT : TENTATIVE DE FRAUDE... Montant négatif par l'userID ".$this->User->getId()." vers l'user ".$userID,10);
            return 466; //C'est pas fair play de voler de l'argent à ces petits camarades...
        } else if($this->getCredit() < $amount) {
            return 462; // PAS ASSEZ D'ARGENT
        } else if($this->User->getId() == $userID){
            return 464; // Petit malin, se virer de l'argent à soi même n'a aucun sens !
        } else {
            $this->db->query("UPDATE ts_user_usr SET usr_credit = (usr_credit + '%u') WHERE usr_id = '%u';", Array($amount, $userID));
            if ($this->db->affectedRows() != 1) {
                return 465; // il n'y a pas d'utilisateur à qui verser l'argent...
            } else {
                $this->db->query("UPDATE ts_user_usr SET usr_credit = (usr_credit - '%u') WHERE usr_id = '%u';", Array($amount, $this->User->getId()));
                $this->db->query(("INSERT INTO t_virement_vir (vir_date, vir_amount, usr_id_from, usr_id_to) VALUES (NOW(), '%u', '%u', '%u')"), array($amount, $this->User->getId(), $userID));
                return 1;
            }
        }
        return 401;
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
$name_class = 'MADMIN';
require('inc/wsdl.inc.php');

?>
