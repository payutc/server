<?php 
/**
	BuckUTT - Buckutt est un système de paiement avec porte-monnaie électronique.
	Copyright (C) 2011 BuckUTT <buckutt@utt.fr>
	Copyright (C) 2012 payutc <payutc@asso.utc.fr>

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
 * POSS.class
 * 
 * Classe pour le WSDL utilisé sur les clients type Peggy
 * @author payutc <payutc@asso.utc.fr>
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

class POSS extends Buy {

	protected $Seller;
	protected $Point;

	/**
	 * Charge le Seller sans mot de passe.
	 * 
	 * @param String $ticket
	 * @param int $service
	 * @param int poi_id
	 * @param String $ip
	 * @return int $state
	*/
	public function loadSeller($ticker, $service, $poi_id, $ip) {
		$login = new Cas::authenticate($ticker, $service);
		if ($login < 0) {
			return -1;
		}
		$this->Seller = new Seller($login, 1, '', $ip, True, $poi_id);
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
		if ($this->isLoadedSeller()) {
			$txt = new ComplexData($this->Seller->getIdentity());
			return $txt->csvArrays();
		} else {
			return 423;
		}
	}

	/**
	 * Savoir si le seller peut vendre sur ce point
	 * 
	 * @return int $state
	 */
	public function isSeller() {
		if ($this->isLoadedSeller()) {
			return $this->Seller->isSeller($this->Point->getId());
		} else {
			return 408;
		}
	}
	
	/**
	 * Récupérer un cvs avec les produits disponibles
	 * 
	 * @return String $csv
	 */
	public function getProposition() {
		if ($this->isLoadedSeller()) {
			if ($this->isSeller() == 1) {
				return parent::getProposition($this->Seller);
			} else {
				return $this->isSeller();
			}
		} else {
			return 408;
		}
	}
	

	/**
	 * Transaction complète,
	 * 		1. load le buyer
	 * 		2. multiselect
	 * 		3. endTransaction
	 * @param String $login
	 * @param int $meanOfLogin
	 * @param String $pass
	 * @param String ip
	 * @param String $obj_ids
	 * @param String $trace
	 * @return int $state
	 */
	public function transaction($login, $meanOfLogin, $pass, $ip, $obj_ids, $trace) {
		if ($this->isLoadedSeller()) {
			$trace .= "via PBUY";
			 $r = $this->loadBuyer($login, $meanOfLogin, $ip, $pass);
			 if ($r!=1) return $r;
			 $r = $this->multiselect($obj_ids, $trace);
			 if ($r!=1) return $r;
			 $r = $this->endTransaction();
			 if ($r!=1) return $r;
			 return 1;
		}
		else 
			return 409;
	}
}

/*SOAP-ISATION PAR CLASSE*/
$name_class = 'POSS';
require ('inc/wsdl.inc.php');

?>
