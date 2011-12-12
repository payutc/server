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
 * Buy.class
 * 
 * Classe pour les Buy, qui sera parent de SBUY et PBUY.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/WsdlBase.class.php';
require_once 'class/Proposition.class.php';
require_once 'class/Buyer.class.php';
require_once 'class/Point.class.php';
require_once 'class/ComplexData.class.php';
require_once 'class/Price.class.php';
require_once 'class/Object.class.php';

class Buy extends WsdlBase {
	
	protected $Proposition;
	protected $Buyer;
	protected $Point;
	protected $Object = Array();
	protected $MAX_CREDIT = 10000; //100 €
	protected $SelectObject; //objet sélectionné (promo, catégory)
	protected $promo_step;
	
	/**
	 * Constructeur.
	 */
	public function __construct() {
		$this->db = Db_buckutt::getInstance();
	}
	
	/**
	 * Charge le Buyer.
	 * 
	* @param string $data
	* @param int $meanOfLogin
	* @param string $pass
	* @param string $ip[optional]
	* @param int $noPass[optional] 1 si connexion sans mot de passe (badgeage simple au foyer)
	 * @return int $state
	*/
	public function loadBuyer($data, $meanOfLogin, $pass,  $ip = 0, $noPass = 0) {				
		$this->Buyer = new Buyer($data, $meanOfLogin, $pass, $ip, $noPass);
		return $this->Buyer->getState();
	}
	
	/**
	* Récupérer les infos sur le Buyer
	* 
	* @return string $csv
	*/
	public function getBuyerIdentity() {
		if (isset($this->Buyer)) {
			$txt = new ComplexData($this->Buyer->getIdentity());
			return $txt->csvArrays();
		} else {
			return 423;
		}
	}
	
	/**
     * Renvoyer la liste des types de recharges.
     * 
     * @param String $type
     * @return String $csv
     */
    public function getTypeRecharge($type = '') {
        $txt = new ComplexData(array());
		
		if ($type == '')
			$res = $this->db->query("SELECT rty_id, rty_name FROM t_recharge_type_rty WHERE rty_removed = '0' ORDER BY rty_id ASC;");
		else
        	$res = $this->db->query("SELECT rty_id, rty_name FROM t_recharge_type_rty WHERE rty_removed = '0' AND rty_type = '%s' ORDER BY rty_id ASC;", Array($type));
		
		if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$txt->addLine(array($don['rty_id'], $don['rty_name']));
			}
			return $txt->csvArrays();
		} else {
			return 400;
		}
    }
	
	/**
	 * Récupérer un cvs avec les produits disponibles
	 *
         * @param object $Seller
	 * @return String $csv
	 */
	public function getProposition(&$Seller) {
		
		if (isset($this->SelectObject) AND ($this->SelectObject->getType() == 'category'))
			$Proposition = new Proposition($this->Seller, $this->Buyer, $this->Point, $this->SelectObject);
		else if (isset($this->SelectObject) AND ($this->SelectObject->getType() == 'promotion'))
			$Proposition = new Proposition($this->Seller, $this->Buyer, $this->Point, $this->SelectObject, $this->promo_step);
		else
			$Proposition = new Proposition($this->Seller, $this->Buyer, $this->Point);
			
		if ($Proposition->getEndPromo() == 1)
		{
			unset($this->SelectObject);
			$this->promo_step = 0;
		}
		
		return $Proposition->getObjectCsvLight();
	}
	
	/**
	 * Recharger un buyer.
	 * 
	 * @param int $amount
	 * @param int $rty_id
	 * @param String $trace
	 * @param int $id_operator si SBUY, c'est le meme que buyer
	 * @return int $state
	 */
	protected function reload($amount, $rty_id, $trace, $id_operator) {
		//test si ce type de recharge existe
		if ($this->db->numRows($this->db->query("SELECT rty_id FROM t_recharge_type_rty WHERE rty_id = '%u' AND rty_removed = '0';", Array($rty_id))) != 1)
			return 452;
		//test si il n'a pas dépassé le seuil max
		$Buyer_credit = $this->Buyer->getCredit(); //évite de faire 2 fois de suite la même requête
		if ($Buyer_credit >= $this->MAX_CREDIT)
			return 450;
		if (($Buyer_credit + $amount) > $this->MAX_CREDIT)
			return 451;
			
		//si on est encore dans la fonction, on peut recharger
		$trace .= " via BUY";
		$this->db->query("UPDATE ts_user_usr SET usr_credit = (usr_credit + '%u') WHERE usr_id = '%u';", Array($amount, $this->Buyer->getId()));
		$this->db->query(("INSERT INTO t_recharge_rec (rty_id, usr_id_buyer, usr_id_operator, poi_id, rec_date, rec_credit, rec_trace) VALUES ('%u', '%u', '%u', '%u', NOW(), '%u', '%s')"), array($rty_id, $this->Buyer->getId(), $id_operator, $this->Point->getId(), $amount, $trace));

		return 1;
	}
	
	//TODO Attention, l'achat si on n'a plus de tune n'est pas géré.
	/**
	 * Acheter ou sélectionner un objet.
	 * 
	 * @param int $obj_id
	 * @param int $obj_credit
	 * @param String $trace
	 * @param int $operator_id
	 * @return int $state
	 */
	public function select($obj_id, $obj_credit, $trace, $operator_id) {		
		$Object = new Object($obj_id);
			
		if (isset($this->SelectObject) AND $this->SelectObject->getType() == 'promotion' AND $obj_credit == 0) {
			//on conserve la promo dans SelectObject et on incrémente la step
			$this->promo_step++;
		} else if ($Object->getType() == 'promotion') {
			//on isset SelectIbject et on met la step à 1
			$this->SelectObject = $Object;
			$this->promo_step = 1;
		} else if ($Object->getType() == 'category') {
			$this->SelectObject = $Object;
		} else {
			unset($this->SelectObject);
		}
		
		if ($Object->getType() == 'product' OR $Object->getType() == 'promotion') {
			//on vérifie le prix
			if (($obj_credit == 0 AND isset($this->SelectObject)) OR (Price::checkPrice($this->Buyer, $this->Point, $Object, $obj_credit) == 1)) {
				//on vérifie que le Buyer a l'argent
				if ($this->Buyer->getCredit() >= $obj_credit) {
					if ($Object->decStock()) { //on décrémente le stock
						//on encaisse
						if ($obj_credit == 0) {
							//promo... on décaisse juste le produit
							$trace .= " via BUY";
							$this->db->query(("INSERT INTO t_purchase_pur (pur_date, pur_type, obj_id, pur_price, usr_id_buyer, usr_id_seller, poi_id, fun_id, pur_ip) VALUES (NOW(), '%s', '%u', '0', '%u', '%u', '%u', '%u', '%s')"), array($Object->getType(), $Object->getId(), $this->Buyer->getId(), $operator_id, $this->Point->getId(), $Object->getFunId(), $trace));
							$purchase_id = $this->db->insertId();
							$this->Buyer->addToCart($Object, 0, $purchase_id);
							return 1;
						} else if ($this->Buyer->decCredit($obj_credit) == 1) {
							//on enregistre
							$trace .= " via BUY";
							$this->db->query(("INSERT INTO t_purchase_pur (pur_date, pur_type, obj_id, pur_price, usr_id_buyer, usr_id_seller, poi_id, fun_id, pur_ip) VALUES (NOW(), '%s', '%u', '%u', '%u', '%u', '%u', '%u', '%s')"), array($Object->getType(), $Object->getId(), $obj_credit, $this->Buyer->getId(), $operator_id, $this->Point->getId(), $Object->getFunId(), $trace));
							$purchase_id = $this->db->insertId();
							$this->Buyer->addToCart($Object, $obj_credit, $purchase_id);
							return 1;
						}
						else
							return 400;
					} else
						return 400;
				} else {
					//on annule l'éventuelle promo
					unset($this->SelectObject);
					return 462;
				}
			} else
				return 402; 
		} else
			return 1;
	}
	
	/**
	 * Vider le panier.
	 * 
	 * @return int $state 
	 */
	public function cancelCart() {
		$this->Buyer->cancelCart();
		unset($this->SelectObject);
		$this->promo_step = 0;
		return 1;
	}
	
	/**
	 * Récuperer le panier en csv.
	 * 
	 * @return String $cart 
	 */
	public function getCartCsv() {
		return $this->Buyer->getCartCsv();
	}
	
	/**
	 * 
	 * @return int $MAX_CREDIT 
	 */
	public function getMaxCredit() {
		return $this->MAX_CREDIT;
	}
	
	/**
	 * 
	 * @return int $state
	 */
	public function endTransaction() {
		
		if ((isset($this->SelectObject)) OR ($this->promo_step != 0))
			return 414;
			
		unset($this->Buyer);
		unset($this->SelectObject);
		$this->promo_step = 0;
		return 1;
	}
}
?>
