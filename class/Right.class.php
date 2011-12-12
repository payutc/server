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
 * Right.class
 * 
 * Classe gérant les droits.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/Period.class.php';

class Right {

    protected $id;
	protected $name;
	protected $description;
	protected $admin;
	protected $db;
	protected $state;

    /**
     * Constructeur.
     * 
     * @param int $id
	 * @param string $name
	 * @param string $description
	 * @param int $admin
	 * @return int $state
     */
    public function __construct($id = 0, $name = 0, $description = 0, $admin = 0)
    {
        $this->db = Db_buckutt::getInstance();
		
		//Création de droit
		if ($id == 0) {
			$this->db->query("INSERT INTO ts_right_rig (rig_name, rig_description, rig_admin) VALUES('%s', '%s', '%u');", Array($name, $description, $admin));			
			if ($this->db->affectedRows() == 1) {
				$this->id = $this->db->insertId();
				$this->name = $name;
				$this->description = $description;
				$this->admin = $admin;
				$this->state = 1;
			} else {
				$this->state = 400;
			}		
		}
		//Chargement de droit
		else {
			$this->id = $id;
			$don = $this->db->fetchArray($this->db->query("SELECT rig_name, rig_description, rig_admin FROM ts_right_rig WHERE rig_id = '%u' AND rig_removed = '0';", Array($this->id)));		
			if ($this->db->affectedRows() == 1) {
				$this->name = $don['rig_name'];
				$this->description = $don['rig_description'];
				$this->admin = $don['rig_admin'];
				$this->state = 1;
			} else {
				$this->state = 453;
			}				
		}
    }

    /**
     * Retourne $id.
     * 
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Retourne $name.
     * 
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Retourne $description.
     * 
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Retourne $admin.
     * 
     * @return int $admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }	
	
	/**
	* Change la description. 
	* 
	* @param string $description
	* @return int $state
	*/
	public function setDescription($description) {
		$this->db->query("UPDATE ts_right_rig SET rig_description='%s' WHERE rig_id='%u';", Array($name, $this->id));
		if ($this->db->affectedRows() == 1) {
			$this->description = $description;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}
	
	/**
	* Change le mode admin. 
	* 
	* @param int $admin
	* @return int $state
	*/
	public function setAdmin($admin) {
		$this->db->query("UPDATE ts_right_rig SET rig_admin='%u' WHERE rig_id='%u';", Array($admin, $this->id));
		if ($this->db->affectedRows() == 1) {
			$this->admin = $admin;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}

	/**
	* Supprimer le droit
	* 
	* @return int $state
	*/
	public function remove() {
		$this->db->query("UPDATE ts_right_rig SET rig_removed='1' WHERE rig_id='%u';", Array($this->id));
		if ($this->db->affectedRows() == 1) {
			$this->state = 1;
		} else {
			$this->state = 400;			
		}
		return $this->state;	
	}
	
	//TODO actuellement, la période est gérée de façon transparente pour pas avoir trop de changements sur fantomette
	//TODO pas de gestion de l'appartenance fondation du coup pour la période
    /**
     * Ajoute un droit à un user entre 2 dates.
     * 
     * @param int  $id_user
     * @param int  $date_start
     * @param int  $date_end
     * @param int  $point
     * @param int  $fundation
     * @return int $state
     */
    public function addUserToDroit($id_user, $date_start, $date_end, $point=0, $fundation=0) {
    	$Period = new Period(0, 1, '', $date_start, $date_end);
		$per_id = $Period->getId();
		
    	if(($point == 0) && ($fundation == 0)){
    		$this->db->query("INSERT INTO tj_usr_rig_jur (usr_id, rig_id, per_id) VALUES ('%u', '%u', '%u')",Array($id_user, $this->id, $Period->getId()));
		}  elseif($point == 0){
			$this->db->query("INSERT INTO tj_usr_rig_jur (usr_id, rig_id, per_id, fun_id) VALUES ('%u', '%u', '%u', '%u')",Array($id_user, $this->id, $Period->getId(), $fundation));
		} elseif($fundation == 0){
			$this->db->query("INSERT INTO tj_usr_rig_jur (usr_id, rig_id, per_id, poi_id) VALUES ('%u', '%u', '%u', '%u')",Array($id_user, $this->id, $Period->getId(), $point));
		} else {
			$this->db->query("INSERT INTO tj_usr_rig_jur (usr_id, rig_id, per_id, fun_id, poi_id) VALUES ('%u', '%u', '%u', '%u', '%u')",Array($id_user, $this->id, $Period->getId(), $fundation, $point));
		}
		if ($this->db->affectedRows() == 1)
			return 1;
		else
			return 400;
    }
	
    /**
     * Fait disparaitre l'inscription d'un user a un droit.
     * 
     * @param int $id_link
     * @return int $state
     */
    public function removeUserFromDroit($id_link) {
        $this->db->query("UPDATE tj_usr_rig_jur SET jur_removed='1' WHERE jur_id='%u'",Array($id_link));
        if ($this->db->affectedRows() == 1) {
            return 1;
        } else {
            return 400;
        }
    }
}
?>