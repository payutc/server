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
 * PBUY.class
 * 
 * Classe pour le WSDL utilisé sur les clients type Peggy
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/Buy.class.php';
require_once 'class/Point.class.php';
require_once 'class/Seller.class.php';
require_once 'class/Buyer.class.php';
require_once 'class/Log.class.php';

class PBUY extends Buy {

	protected $Seller;
	protected $Point;

	/**
	 * Charge le Seller sans mot de passe.
	 * 
	 * @param String $data
	 * @param int $meanOfLogin
	 * @param String $ip
	 * @param int $poi_id
	 * @return int $state
	*/
	public function loadSeller($data, $meanOfLogin, $ip, $poi_id) {				
		$this->Seller = new Seller($data, $meanOfLogin, '', $ip, 1, $poi_id);
		$this->Point = new Point($poi_id);
		return $this->Seller->getState();
	}
	
	
	/**
	 * Check si le user est loggué
	 * 
	 * @return int $state
	 */
	public function isLoadedSeller() {
		if (isset($this->Seller))
			return 1;
		else
			return 0;
	}
	
	/**
	* Récupérer les infos sur le Seller
	* 
	* @return string $csv
	*/
	public function getSellerIdentity() {
		if (isset($this->Seller)) {
			$txt = new ComplexData($this->Seller->getIdentity());
			return $txt->csvArrays();
		} else {
			return 423;
		}
	}
	
	/**
	 * Vérifie le mot de passe.
	 * 
	 * @param String $password
	 * @return int $state
	*/
	public function checkPasswordSeller($password) {
		return $this->Seller->checkPass($password);
	}

	/**
	 * Savoir si le seller peut changer le client de point
	 * 
	 * @return int $state
	 */
	public function isPointMan() {
		if (isset($this->Seller)) {
			return $this->Seller->isPointMan();
		} else {
			return 408;
		}
	}

	/**
	 * Savoir si le seller peut vendre sur ce point
	 * 
	 * @return int $state
	 */
	public function isSeller() {
		if (isset($this->Seller)) {
			return $this->Seller->isSeller($this->Point->getId());
		} else {
			return 408;
		}
	}

	/**
	 * Savoir si le seller peut recharger sur ce point
	 * 
	 * @return int $state
	 */
	public function isReloader() {
		if (isset($this->Seller)) {
			return $this->Seller->isReloader();
		} else {
			return 408;
		}
	}
	
	/**
	 * Savoir si le seller peut vendre sur ce point
	 * 
	 * @return int $state
	 */
	public function isModeManuel() {
		if (isset($this->Seller)) {
			return $this->Seller->isModeManuel();
		} else {
			return 457;
		}
	}
	
	/**
	 * Changer de point client.
	 * 
	 * @param int $poi_id
	 * @return int $state
	 */
	public function setPoint($poi_id) {
		if (isset($this->Seller)) {
			if ($this->Seller->isPointMan() == 1) {
				unset($this->Point);
				$this->Point = new Point($poi_id);
				return $this->Point->getState();
			} else {
				return $this->Seller->isPointMan();
			}
		} else {
			return 408;
		}
	}

	/**
     * Renvoyer la liste des types de recharges.
     * 
     * @return String $csv
     */
    public function getTypeRecharge() {
    	return parent::getTypeRecharge('PBUY');
	}
	
	/**
	 * Charge le Buyer.
	 * 
	 * @param String $data
	 * @param int $meanOfLogin
	 * @param String $ip
	 * @return int $state
	*/
	public function loadBuyer($data, $meanOfLogin, $ip) {
		if (isset($this->Seller)) {
			return parent::loadBuyer($data, $meanOfLogin, '', $ip, 1);
		} else {
			return 408;
		}
	}
			
	/**
	 * Recharger un buyer.
	 * 
	 * @param int $amount
	 * @param int $rty_id
	 * @param String $trace
	 * @return int $state
	 */
	public function reload($amount, $rty_id, $trace) {
		if($this->isReloader() != 1)
			return $this->isReloader();
		if (isset($this->Buyer)) {
			$trace .= " via PBUY";
			return parent::reload($amount, $rty_id, $trace, $this->Seller->getId());
		}
		else
			return 409;
	}
	
	/**
	 * Récupérer un cvs avec les produits disponibles
	 * 
	 * @return String $csv
	 */
	public function getProposition() {
		if (isset($this->Seller)) {
			if (isset($this->Buyer)) {
				if ($this->isSeller() == 1) {
					return parent::getProposition($this->Seller);
				} else {
					return $this->isSeller();
				}
			} else {
				return 409;
			}
		} else {
			return 408;
		}
	}
	
	/**
	 * Acheter ou sélectionner un objet.
	 * 
	 * @param int $obj_id
	 * @param int $obj_credit
	 * @param String $trace
	 * @return int $state
	 */
	public function select($obj_id, $obj_credit, $trace) {		
		if (isset($this->Buyer)) {
			$trace .= " via PBUY";
			return parent::select($obj_id, $obj_credit, $trace, $this->Seller->getId());
		}
		else
			return 409;
	}
}

/*SOAP-ISATION PAR CLASSE*/
$name_class = 'PBUY';
require ('inc/wsdl.inc.php');

?>
