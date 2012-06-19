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

class SADMIN extends WsdlBase {

    private  $User;
    // TODO : mettre le maximum de credit dans la config.
    protected $MAX_CREDIT = 10000; //100 €

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
	 * @return int $state
	 */
    public function loginCas($ticket, $service) {
		$login = Cas::authenticate($ticket, $service);
		$this->User = new User($login, 1, "", 0, 1);
		$this->Point = new Point(1);
		return $this->User->getState();
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
	* Fonction pour vérifier qu'un client peut recharger d'un certain montant
	* Il n'est pas obligatoire de l'appeler avant reload($amount)
	* Mais le retour de reload si on a pas le droit de recharger sera beaucoup moins "joli"
	* 
	* @param int $amount (en centimes)
	* @return int $code
	*/
	public function canReload($amount) {
		$Buyer_credit = $this->User->getCredit(); //évite de faire 2 fois de suite la même requête
		if ($Buyer_credit >= $this->MAX_CREDIT)
			return 450;
		if (($Buyer_credit + $amount) > $this->MAX_CREDIT)
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
     * 441:Il ne s'agit pas du bon code PIN
     * @param String $pin
     * @return int $state
     */
    public function blockMe($pin) {
		if ($this->User->blockMe()) {
			$state = 1;
		} else { $state = 440; }    		
		return $state;
    }
    
    /**
     * Fonction pour se déblocker soi meme (en cas de perte/vol par exemple)
     * 1:Le compte a été changé
     * 440:L'utilisateur n'existe pas
     * 441:Il ne s'agit pas du bon code PIN
     * @param String $pin
     * @return int $state
     */
    public function deblock($pin) {
		if ($this->User->deblock()) {
			$state = 1;
		} else { $state = 440; }    		
		return $state;
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
