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
 * Price.class
 * 
 * Classe pour les prix.
 * Un prix est associé à un objet et un groupe.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/Group.class.php';
require_once 'class/Object.class.php';

class Price {
	
	protected $pri_id;
	protected $Object;
	protected $Group;
	protected $Period;
	protected $pri_credit;
	protected $db;
	protected $state;
	
	/**
	 * Constructeur du groupe.
	 * 
	 * @param int $pri_id
	 * @param object $Object
	 * @param object $Group
	 * @param int $pri_credit
	 * @return int $state;
	 */
	public function __construct($pri_id=0, &$Object=0, &$Group=0, &$Period, $pri_credit=0) {
		$this->db = Db_buckutt::getInstance();
		
		//Création de prix
		if ($pri_id == 0) {
			$this->db->query("INSERT INTO t_price_pri (obj_id, grp_id, per_id, pri_credit) VALUES('%u', '%u', '%u', '%u');", Array($Object->getId(), $Group->getId(), $Period->getId(), $pri_credit));
			if ($this->db->affectedRows() == 1) {
				$this->pri_id = $this->db->insertId();
				$this->Object = &$Object;
				$this->Group = &$Group;
				$this->Period = &$Period;
				$this->pri_credit = $pri_credit;
				$this->state = 1;
			} else {
				$this->state = 400;
			}		
		}
		//Lecture de prix
		else {
			$this->pri_id = $pri_id;
			$don = $this->db->fetchArray($this->db->query("SELECT obj_id, grp_id, pri_credit FROM t_price_pri WHERE pri_id = '%u' AND pri_removed = '0';", Array($this->pri_id)));		
			if ($this->db->affectedRows() == 1) {
				$this->Object = new Object($don['obj_id']);
				$this->Group = new Group($don['grp_id']);
				$this->pri_credit = $don['pri_credit'];
				$this->state = 1;
			} else {
				$this->state = 467;
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
	* Retourne $pri_id.
	* 
	* @return int $pri_id
	*/
	public function getId() {
		return $this->pri_id;
	}
	
	/**
	* Retourne $pri_credit.
	* 
	* @return int $pri_credit
	*/
	public function getCredit() {
		return $this->pri_credit;
	}	

	/**
	* Retourne $Group.
	* 
	* @return object $Group
	*/
	public function getGroup() {
		return $this->Group;
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
	* Retourne $Period.
	* 
	* @return object $Period
	*/
	public function getPeriod() {
		return $this->Period;
	}
	
	/**
	* Change le groupe.
	* 
	* @param object $Group
	* @return int $state
	*/
	public function setGroup($Group) {
		$this->db->query("UPDATE t_price_pri SET grp_id='%u' WHERE pri_id='%u';", Array($Group->getId(), $this->pri_id));
		if ($this->db->affectedRows() == 1) {
			$this->Group = $Group;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}

	/**
	* Change la période.
	* 
	* @param object $Period
	* @return int $state
	*/
	public function setPeriod($Period) {
		$this->db->query("UPDATE t_price_pri SET per_id='%u' WHERE pri_id='%u';", Array($Period->getId(), $this->pri_id));
		if ($this->db->affectedRows() == 1) {
			$this->Period = $Period;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}
	
	/**
	* Change le $pri_credit.
	* 
	* @param int $pri_credit
	* @return int $state
	*/
	public function setCredit($pri_credit) {
		$this->db->query("UPDATE t_price_pri SET pri_credit='%u' WHERE pri_id='%u';", Array($pri_credit, $this->pri_id));
		if ($this->db->affectedRows() == 1) {
			$this->pri_credit = $pri_credit;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}
	
	/**
	* Supprimer le prix
	* 
	* @return int $state
	*/
	public function remove() {
		$this->db->query("UPDATE t_price_pri SET pri_removed='1' WHERE pri_id='%u';", Array($this->pri_id));
		if ($this->db->affectedRows() == 1) {
			$this->state = 1;
		} else {
			$this->state = 400;
		}
		return $this->state;
	}	
	
	/**
	 * Vérifie si le prix est correct.
	 * 
	 * @param object $User
	 * @param object $Point
	 * @param object $Object
	 * @param int $credit
	 * @return int $state
	 */
	public static function checkPrice(&$User, &$Point, &$Object, $credit) {
		$db = Db_buckutt::getInstance();
		//TODO vérifier suite aux modifs sur la requere des propositions
		if ($db->numRows($creditBDD = $db->query("
SELECT 
MIN(pri.pri_credit) AS credit 

FROM
t_object_obj obj,
tj_obj_poi_jop jop,
tj_usr_grp_jug jug,
t_price_pri pri,
t_sale_sal sal,
t_period_per per1,
t_period_per per2,
t_period_per per3 

WHERE 
obj.obj_id = '%u' AND 
obj.obj_removed = '0' AND 
jug.jug_removed = '0' AND 
pri.pri_removed = '0' AND 
sal.sal_removed = '0' AND 
(obj.obj_stock > '0' OR obj.obj_stock = '-1') AND
jug.usr_id = '%u' AND 
(jug.grp_id = pri.grp_id OR pri.grp_id = '0') AND 
jop.poi_id = '%u' AND 
jop.obj_id = obj.obj_id AND 
pri.obj_id = obj.obj_id AND 
sal.obj_id = obj.obj_id AND 
per1.per_id = jug.per_id AND 
per2.per_id = pri.per_id AND 
per3.per_id = sal.per_id AND
per1.per_date_start <= NOW() AND 
per1.per_date_end >= NOW() AND 
per2.per_date_start <= NOW() AND 
per2.per_date_end >= NOW() AND 
per3.per_date_start <= NOW() AND 
per3.per_date_end >= NOW() 

GROUP BY obj.obj_id
		;", Array($Object->getId(), $User->getId(), $Point->getId()))) == 1) {
			$creditBDD = $db->result($creditBDD);
			if ($creditBDD == $credit)
				return 1;
			else
				return 0;
		} else {
			return 0;
		}
	}
}
?>