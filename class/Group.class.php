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
 * Group.class
 * 
 * Classe gérant les groupes.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/Period.class.php';

class Group {

    protected $id;
    protected $name;
    protected $open;
    protected $isPublic;
    protected $db;
	protected $state;
	
	//TODO vérifier la pertinence dans le reste du code d'utiliser un objet Fundation et pas un id direct
    /**
     * Constructeur du groupe.
     * 
     * @param int $id
     * @param object $Fundation
     * @param string $name
     * @param int $open
     * @param int $public
     */
	public function __construct($id=0, &$Fundation=0, $name=0, $open=0, $isPublic=0) {
		$this->db = Db_buckutt::getInstance();

		//Création de groupe
		if ($id == 0) {
			$this->db->query("INSERT INTO t_group_grp (grp_name, grp_open, grp_public, fun_id) VALUES('%s', '%u', '%u', '%u');", Array($name, $open, $isPublic, $Fundation->getId()));
			if ($this->db->affectedRows() == 1) {
				$this->id = $this->db->insertId();
				$this->name = $name;
				$this->open = $open;
				$this->isPublic = $isPublic;
				$this->state = 1;
			} else {
				$this->state = 400;
			}		
		}
		//Lecture de groupe
		else {
			$this->id = $id;
			$don = $this->db->fetchArray($this->db->query("SELECT grp_name, grp_open, grp_public FROM t_group_grp WHERE grp_id = '%u' AND grp_removed = '0';", Array($this->id)));		
			if ($this->db->affectedRows() == 1) {
				$this->name = $don['grp_name'];
				$this->open = $don['grp_open'];
				$this->isPublic = $don['grp_public'];
				$this->state = 1;
			} else {
				$this->state = 464;
			}				
			return $this->state;
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
	* Retourne $name.
	* 
	* @return string $name
	*/
	public function getName() {
		return $this->name;
	}	
	
	/**
	* Retourne $open.
	* 
	* @return string $open
	*/
	public function getOpen() {
		return $this->open;
	}
	
	/**
	* Retourne $isPublic.
	* 
	* @return string $isPublic
	*/
	public function getIsPublic() {
		return $this->isPublic;
	}

	/**
	* Change le nom. 
	* 
	* @param string $name
	* @return int $state
	*/
	public function setName($name) {
		$this->db->query("UPDATE t_group_grp SET grp_name='%s' WHERE grp_id='%u';", Array($name, $this->id));
		if ($this->db->affectedRows() == 1) {
			$this->name = $name;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}
	
	/**
	* Change le open. 
	* 
	* @param int $open
	* @return int $state
	*/
	public function setOpen($open) {
		$this->db->query("UPDATE t_group_grp SET grp_open='%u' WHERE grp_id='%u';", Array($open, $this->id));
		if ($this->db->affectedRows() == 1) {
			$this->open = $open;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}
	
	/**
	* Change le isPublic. 
	* 
	* @param int $isPublic
	* @return int $state
	*/
	public function setIsPublic($isPublic) {
		$this->db->query("UPDATE t_group_grp SET grp_public='%u' WHERE grp_id='%u';", Array($isPublic, $this->id));
		if ($this->db->affectedRows() == 1) {
			$this->isPublic = $isPublic;
			$this->state = 1;
		} else {
			$this->state = 400;
		}	
	}
	
	/**
	* Supprimer le groupe
	* 
	* @return int $state
	*/
	public function remove() {
		$this->db->query("UPDATE t_group_grp SET grp_removed='1' WHERE grp_id='%u';", Array($this->id));
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
     * Ajoute un groupe à un user entre 2 dates.
     * 
     * @param int  $id_user
     * @param int  $date_start
     * @param int  $date_end
     * @return int $state
     */
    public function addUserToGroup($id_user, $date_start, $date_end) {
    	$Period = new Period(0, 1, '', $date_start, $date_end);
		$per_id = $Period->getId();
		
    	$this->db->query("INSERT INTO tj_usr_grp_jug (usr_id, grp_id, per_id) VALUES ('%u', '%u', '%u')",Array($id_user, $this->id, $Period->getId()));
		if ($this->db->affectedRows() == 1)
			return 1;
		else
			return 400;
    }
	
    /**
     * Fait disparaitre l'inscription d'un user a un groupe.
     * 
     * @param int $id_link
     * @return int $state
     */
    public function removeUserFromGroup($id_link) {
        $this->db->query("UPDATE tj_usr_grp_jug SET jug_removed='1' WHERE jug_id='%u'",Array($id_link));
        if ($this->db->affectedRows() == 1) {
            return 1;
        } else {
            return 400;
        }
    }
}
?>