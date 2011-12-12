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


class Seller extends User {
	
	protected $poi_id;
	
	/**
	* Constructeur
	* 
	* @param string $data
	* @param int $meanOfLogin
	* @param string $pass
	* @param string $ip[optional]
	* @param int $noPass[optional] 1 si connexion sans mot de passe (badgeage simple au foyer)
	* @param int $poi_id
	*/
	public final function __construct($data, $meanOfLogin, $pass,  $ip = 0, $noPass = 0, $poi_id)
    {
        parent::__construct($data, $meanOfLogin, $pass, $ip, $noPass);
				
		$this->poi_id = $poi_id;
				
		if ($this->getState() == 1) {
			$this->state = $this->isAllowedOnPoint($this->poi_id);
		}
	}
	
	/**
	* Renvoie 1 si le User peut faire quelque chose en admin à ce point
	* 
	* @return int $state
	*/
	public function isAllowedOnPoint() {
		if ($this->isSeller($this->poi_id) == 1 || $this->isReloader() == 1 || $this->isPointMan() == 1)
			return 1;
		else
			return 456;
	}
	
	/**
	* Renvoie 1 si le User est reloader
	* 
	* @return int $state
	*/ 
	public function isReloader() {
		return $this->hasDroit("reloader", 0, $this->poi_id);
	}
	
	/**
	* Renvoie 1 si le User est pointMan
	* 
	* @return int $state
	*/ 
	public function isPointMan() {
		return $this->hasDroit("point_admin");
	}
	
	/**
	* Renvoie 1 si le User est mode manuel
	* 
	* @return int $state
	*/ 
	public function isModeManuel() {
		return $this->hasDroit("mode_manuel");
	}
	
}
?>