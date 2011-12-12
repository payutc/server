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
 * ObjectWithPrice.class
 * 
 * Classe qui asocie un  prix à un objet (sans notion de relation avec un object Price).
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'class/Object.class.php';

class ObjectWithPrice extends Object {
	
	protected $price;
	
    /**
     * Constructeur du groupe.
     * 
     * @param int $obj_id
     * @param string $obj_name
     * @param string $obj_type
     * @param int $obj_stock
     * @param int $fun_id
     * @param int $img_id
     * @param int $obj_single
     * @param int $pre_load
     * @param int $price
     * @return int $state;
     */	
	public function __construct($obj_id=0, $obj_name='', $obj_type='', $obj_stock=0, $fun_id=0, $img_id=0, $obj_single=0, $price=0) {
		
		$this->db = Db_buckutt::getInstance();
		
		$this->obj_id = $obj_id;
		$this->obj_name = $obj_name;
		$this->obj_type = $obj_type;
		$this->obj_stock = $obj_stock;
		$this->obj_single = $obj_single;
		$this->img_id = $img_id;
		$this->fun_id = $fun_id;
		$this->price = $price;
		$this->state = 1;
		
		return $this->state;
	}

	/**
	* Retourne $price.
	*
	* @return array $price
	*/
	public function getPrice() {
		return $this->price;
	}
	
	/**
	* Retourne quelques détails sur l'objet (nom, type, id_image)
	* (avant, retournait name / id_category, id_image)
	* 
	* @return array $Details
	*/
	public function getDetailsLight() {
		if ($this->state == 1)
			return array($this->obj_id, $this->obj_name, $this->obj_type, $this->img_id, $this->price);
		else
			return $this->state;
	}
	
	/**
	* Retourne tous les détails de l'objet
	* (avant : $arrayLight, array($this->isunique, $this->stock, $this->categorie->getNameFundation(), $this->date_end)
	* @return array $Details
	*/
	public function getDetails() {
		if ($this->state == 1) {
			$array = array($this->obj_id, $this->obj_name, $this->obj_type, $this->price, $this->obj_stock, $this->obj_single, $this->img_id, $this->fun_id);
			return $array;
		}
		else
			return $this->state;
	}
}