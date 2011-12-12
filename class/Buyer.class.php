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
 * Buyer.class
 * 
 * Classe héritant de User spécifiant le Buyer.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

//TODO tester dans chaque méthode si state = 1, sinon on poutre

require_once 'class/User.class.php';

class Buyer extends User {
	
    protected $Cart = array(); //panier
    protected $Purchase_id = array();
	//TODO vérifier que le passsage du crédit en protected dans la classe mère n'est pas un problème pour les autres classes

    /**
     * constructeur
	* @param string $data
	* @param int $meanOfLogin
	* @param string $pass
	* @param string $ip
	* @param int $noPass 1 si connexion sans mot de passe (badgeage simple au foyer)
     */

    public final function __construct($data, $meanOfLogin, $pass,  $ip = 0, $noPass = 0)
    {
        parent::__construct($data, $meanOfLogin, $pass, $ip, $noPass);
		
        $this->loadGroups();
    }
		
	//TODO Vérifier si c'est utile de checker si le crédit est suffisant
	/**
	 * Débite du crédit la somme envoyée en paramètre.
	 * 
	 * @param int $somme
	 * @return int $state
	 */
	public function decCredit($somme) {
		$this->db->query("UPDATE ts_user_usr SET usr_credit = (usr_credit - '%u') WHERE usr_id='%u';", Array($somme, $this->idUser));
		if ($this->db->affectedRows() == 1) {
			$this->credit -= $somme;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
		return $this->state;
	}
	
	/**
	 * Ajouter un produit au panier.
	 *  
	 * @param object $Object
	 */
	public function addToCart(&$Object, $credit, $purchase_id) {
		$this->Purchase_id[] = $purchase_id;
		if (array_key_exists($Object->getId(), $this->Cart)) {
			$this->Cart[$Object->getId()][quantity]++;
			$this->Cart[$Object->getId()][credit] += $credit;
		} else {
			$this->Cart[$Object->getId()][quantity] = 1;
			$this->Cart[$Object->getId()][name] = $Object->getName();
			$this->Cart[$Object->getId()][credit] = $credit;
		}
		
		return 1;
	}
	
	/**
	 * Récupérer un csv du panier.
	 * 
	 * @return int $state
	 */
	public function getCartCsv() {
		$txt = new ComplexData(array());
		
		foreach ($this->Cart as $key => $value) {
		    $txt->addLine(array($value['name'], $value['quantity'], $value['credit']));
		}
		return $txt->csvArrays();
	}
	
	/**
	 * Vider le panier et recréditer le Buyer
	 * 
	 * @return int $state
	 */
	public function cancelCart() {
		$total = 0;
		foreach ($this->Purchase_id as $value) {
			$total += $this->db->result($this->db->query("SELECT pur_price FROM t_purchase_pur WHERE pur_id = %u",array($value)),0);
			$this->db->query("UPDATE t_purchase_pur SET pur_removed='1' WHERE pur_id='%u';", Array($value));
		}
		$this->db->query("UPDATE ts_user_usr SET usr_credit = (usr_credit + '%u') WHERE usr_id='%u';", Array($total, $this->idUser));
		
		$this->Cart = array();
		$this->Purchase_id = array();
		
		//dur de faire des tests si les requêtes se sont bien passées
		return 1;
	}
}
?>