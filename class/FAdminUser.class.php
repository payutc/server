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
 * FAdmin.class
 *
 * Classe héritant de User spécifiant l'admin d'une fundation.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */
require_once 'class/User.class.php';

class FAdminUser extends User {
protected $fundation;
    /**
     * constructeur
     * @param string $data
     * @param int $meanOfLogin
     * @param string $pass
     * @param string $ip
     * @param int $noPass 1 si connexion sans mot de passe (badgeage simple au foyer)
     * @param int $fun_id
     */
    public final function __construct($data, $meanOfLogin, $pass, $ip = 0, $noPass = 0, $fun_id) {
        parent::__construct($data, $meanOfLogin, $pass, $ip, $noPass);
        $this->fundation = new Fundation($fun_id);
    }

    public function getFundation(){
       return $this->fundation;
    }
}

?>