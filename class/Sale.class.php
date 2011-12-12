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
 * Sale.class
 * 
 * Classe pour les ventes.
 * Pour qu'un objet soit visible, il doit être associé à une vente en cours.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/Period.class.php';
require_once 'class/Object.class.php';

class Sale {
	
	protected $sal_id;
	protected $sal_name;
	protected $Object;
	protected $Period;
	protected $db;
	protected $state;

	/**
     * Constructeur de sale.
     * 
     * @return int $state;
     */
	public function __construct($sal_id=0, &$Object=0, &$Period=0, $sal_name='') {
		$this->db = Db_buckutt::getInstance();
		
		//Création de vente
		if ($sal_id == 0) {
			$this->db->query("INSERT INTO t_sale_sal (sal_name, per_id, obj_id) VALUES('%s', '%u', '%u');", Array($sal_name, $Period->getId(), $Object->getId()));
			if ($this->db->affectedRows() == 1) {
				$this->sal_id = $this->db->insertId();
				$this->sal_name = $sal_name;
				$this->Object = &$Object;
				$this->Period = &$Period;
				$this->state = 1;
			} else {
				$this->state = 400;
			}		
		}
		//Lecture de vente
		else {
			$this->sal_id = $sal_id;
			$don = $this->db->fetchArray($this->db->query("SELECT sal_name, per_id, obj_id FROM t_sale_sal WHERE sal_id = '%u' AND sal_removed = '0';", Array($this->sal_id)));		
			if ($this->db->affectedRows() == 1) {
				$this->sal_name = $don['sal_name'];
				$this->Object = new Object($don['obj_id']);
				$this->Period = new Period($don['per_id']);
				$this->state = 1;
			} else {
				$this->state = 466;
			}				
		}		
		return $this->state;
	}	
	
	/**
	* Retourne $state.
	*
	* @return int $state
	*/
	public function getState() {
		return $this->state;
	}
	
	/**
	* Retourne $sal_id.
	* 
	* @return int $sal_id
	*/
	public function getId() {
		return $this->sal_id;
	}
	
	/**
	* Retourne $sal_name.
	* 
	* @return string $sal_name
	*/
	public function getName() {
		return $this->sal_name;
	}	

	/**
	* Retourne $Period.
	* 
	* @return object $Period
	*/
	public function getPeriod() {
		return $this->Period;
	}	

	/**
	* Retourne $Object.
	* 
	* @return object $Object
	*/
	public function getObject() {
		return $this->Object;
	}
	
	/**
	* Change la période.
	* 
	* @param object $Period
	* @return int $state
	*/
	public function setPeriod($Period) {
		$this->db->query("UPDATE t_sale_sal SET per_id='%u' WHERE sal_id='%u';", Array($Period->getId(), $this->sal_id));
		if ($this->db->affectedRows() == 1) {
			$this->Period = $Period;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}
	
	/**
	* Change le $sal_name.
	* 
	* @param string $sal_name
	* @return int $state
	*/
	public function setName($sal_name) {
		$this->db->query("UPDATE t_sale_sal SET sal_name='%s' WHERE sal_id='%u';", Array($sal_name, $this->sal_id));
		if ($this->db->affectedRows() == 1) {
			$this->sal_name = $sal_name;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}	
	
	/**
	* Supprimer la vente
	* 
	* @return int $state
	*/
	public function remove() {
		$this->db->query("UPDATE t_sale_sal SET sal_removed='1' WHERE sal_id='%u';", Array($this->sal_id));
		if ($this->db->affectedRows() == 1) {
			$this->state = 1;
		} else {
			$this->state = 400;
		}
		return $this->state;
	}
}
?>