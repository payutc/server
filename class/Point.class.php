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
 * Point.class
 * 
 * Classe pour les objets Point.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';

class Point {

	protected $id; 
	protected $name;
	protected $db;
	protected $state;

	/**
	* Retourne un point existant si juste un Id envoyé en paramètre. Crée un point si 0 et name envoyé.
	*
	* @param int $id
	* @param string $name
	* @return int $state
	*/
	public function __construct($id, $name = '') {
		$this->db = Db_buckutt::getInstance();
		
		//Création de point
		if ($id == 0) {
			$this->db->query("INSERT INTO t_point_poi (poi_name) VALUES('%s');", Array($name));
			if ($this->db->affectedRows() == 1) {
				$this->id = $this->db->insertId();
				$this->name = $name;
				$this->state = 1;
			} else {
				$this->state = 400;
			}		
		}
		//Lecture de point
		else {
			if ($this->db->numRows($name = $this->db->query("SELECT poi_name FROM t_point_poi WHERE poi_id = '%u' AND poi_removed = '0';", Array($id))) == 1) {
				$this->name = $this->db->result($name);
				$this->id = $id;
				$this->state = 1;
			} else {
				$this->state = 420;
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
	* Change le $name d'un point.
	* 
	* @param string $name
	* @return int $state
	*/
	public function setName($name) {
		$this->db->query("UPDATE t_point_poi SET poi_name='%s' WHERE poi_id='%u';", Array($name, $this->id));
		if ($this->db->affectedRows() == 1) {
			$this->name = $name;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}

	/**
	* Supprimer le point
	* 
	* @return int $state
	*/
	public function remove() {
		$this->db->query("UPDATE t_point_poi SET poi_removed='1' WHERE poi_id='%u';", Array($this->id));
		if ($this->db->affectedRows() == 1) {
			$this->state = 1;
		} else {
			$this->state = 400;
		}
		return $this->state;
	}
	
	/**
	* Ajoute un objet à ce point.
	* 
	* @param object $Object
	* @return int $state
	*/
	public function addObject($Object) {
		$this->db->query("INSERT INTO tj_obj_poi_jop (obj_id, poi_id) VALUES('%u', '%u');", Array($Object->getId(), $this->getId()));
		if ($this->db->affectedRows() == 1) {
			return 1;
		} else {
			return 0;
		}
	}
	
	/**
	* Supprime l'objet du point de vente.
	* 
	* @param object $Object
	* @return int $state
	*/
	public function deleteObject($Object) {
		$this->db->query("DELETE FROM tj_obj_poi_jop WHERE obj_id = '%u' AND poi_id = '%u');", Array($Object->getId(), $this->getId()));
		if ($this->db->affectedRows() == 1) {
			return 1;
		} else {
			return 0;
		}
	}
}
?>