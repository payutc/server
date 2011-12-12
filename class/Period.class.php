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
 * Period.class
 * 
 * Classe gérant les périodes.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';

class Period {

    protected $id;
	protected $idFundation;
	protected $name;
	protected $date_start;
	protected $date_end;
	protected $db;
	protected $state;

    /**
     * Constructeur.
     * 
     * @param int $id
     * @param int $idFundation
	 * @param string $name
	 * @param int $date_start
	 * @param int $date_end
	 * @return int $state
     */
    public function __construct($id = 0, $idFundation = 0, $name = 0, $date_start = 0, $date_end = 0)
    {
        $this->db = Db_buckutt::getInstance();
		
		//Création de période
		if ($id == 0) {
			$this->db->query("INSERT INTO t_period_per (fun_id, per_name, per_date_start, per_date_end) VALUES('%u', '%s', FROM_UNIXTIME(%u), FROM_UNIXTIME(%u));", Array($idFundation, $name, $date_start, $date_end));			
			if ($this->db->affectedRows() == 1) {
				$this->id = $this->db->insertId();
				$this->idFundation = $idFundation;
				$this->name = $name;
				$this->date_start = $date_start;
				$this->date_end = $date_end;
				$this->state = 1;
			} else {
				$this->state = 400;
			}		
		}
		//Chargement de période
		else {
			$this->id = $id;
			$don = $this->db->fetchArray($this->db->query("SELECT fun_id, per_name, UNIX_TIMESTAMP(per_date_start) as per_date_start, UNIX_TIMESTAMP(per_date_end) as per_date_end FROM t_period_per WHERE per_id = '%u' AND per_removed = '0';", Array($this->id)));
			if ($this->db->affectedRows() == 1) {
				$this->idFundation = $don['fun_id'];
				$this->name = $don['per_name'];
				$this->date_start = $don['per_date_start'];
				$this->date_end = $don['per_date_end'];
				$this->state = 1;
			} else {
				$this->state = 463;
			}				
		}
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
	* Retourne $idFundation.
	* 
	* @return int $idFundation
	*/
	public function getIdFundation() {
		return $this->idFundation;
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
	* Retourne $date_start.
	* 
	* @return int $date_start
	*/
	public function getDateStart() {
		return $this->date_start;
	}
	
	/**
	* Retourne $date_end.
	* 
	* @return int $date_end
	*/
	public function getDateEnd() {
		return $this->date_end;
	}
}
?>