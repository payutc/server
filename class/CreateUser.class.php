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
 * CreateUser.class
 * 
 * Classe créant des utilisateurs.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

class CreateUser {
	
	protected $db;
	
	public function __construct(){
		$this->db = Db_buckutt::getInstance();
	}
	
	/**
	 * Fonction qui crée un user temporaire pour juste une soirée par exemple, sans nom/prénom...
	 * 
	 * @return int $id_user
	 */
	public function createTemporaryUser(){	
		$this->db->query("INSERT INTO ts_user_usr (usr_temporary) VALUES ('1');", Array());			
		if ($this->db->affectedRows() == 1) {
			$this->usr_id = $this->db->insertId();
			return $this->usr_id;
		} else {
			return 0;
		}
	}

	/**
	 * Crée un utilisateur normal
	 * 
	 * @param string $usr_firstname
	 * @param string $usr_lastname
	 * @param string $usr_pwd
	 * @param string $usr_mail[optional]
	 * @param string $usr_nickname[optional]
	 * @param int $img_id[optional]
	 * @return $id
	 */
	public function createUser($usr_firstname, $usr_lastname, $usr_pwd, $usr_mail='', $usr_nickname='', $img_id=0){
		$this->db->query("INSERT INTO ts_user_usr (usr_pwd, usr_firstname, usr_lastname, usr_nickname, usr_mail, img_id) VALUES('%s', %s', %s', %s', %s', '%u');", Array($usr_pwd, $usr_firstname, $usr_lastname, $usr_nickname, $usr_mail, $img_id));			
		if ($this->db->affectedRows() == 1) {
			$this->usr_id = $this->db->insertId();
			return $this->usr_id;
		} else {
			return 0;
		}
	}
}
?>