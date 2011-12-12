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
 * Fundation.class
 * 
 * Classe pour les objets Fundation.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';

class Fundation {

	protected $id; 
	protected $name;
	protected $state;

	/**
	* Retourne un organisme existant si juste un Id envoyé en paramètre. Crée un organisme si 0 et name envoyé.
	*
	* @param int $id
	* @param string $name
	* @return int $state
	*/
	public function __construct($id, $name = '') {
		$this->db = Db_buckutt::getInstance();
		
		//Création d'organisme
		if ($id == 0) {
			$this->db->query("INSERT INTO t_fundation_fun (fun_name) VALUES('%s');", Array($name));
			if ($this->db->affectedRows() == 1) {
				$this->id = $this->db->insertId();
				$this->name = $name;
				$this->state = 1;
			} else {
				$this->state = 400;
			}		
		}
		//Lecture d'organisme
		else {
			if ($this->db->numRows($name = $this->db->query("SELECT fun_name FROM t_fundation_fun WHERE fun_id = '%u';", Array($id))) == 1) {
				$this->name = $this->db->result($name);
				$this->id = $id;
				$this->state = 1;
			} else {
				$this->state = 421;
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
	* Retourne $id.
	* 
	* @return int $id
	*/
	public function getId() {
		return $this->id;
	}
	
	/**
	* Retourne $name.
	* 
	* @return string $name
	*/
	public function getName() {
		return $this->name;
	}
	
	/**
	* Change le $name d'un organisme.
	* 
	* @param string $name
	* @return int $state
	*/
	public function setName($name) {
		$this->db->query("UPDATE t_fundation_fun SET fun_name='%s' WHERE fun_id='%u';", Array($name, $this->id));
		if ($this->db->affectedRows() == 1) {
			$this->name = $name;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}
	
	/**
	* Supprimer l'organisme
	* 
	* @return int $state
	*/
	public function remove() {
		$this->db->query("UPDATE t_fundation_fun SET fun_removed='1' WHERE fun_id='%u';", Array($this->id));
		if ($this->db->affectedRows() == 1) {
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}
}
?>