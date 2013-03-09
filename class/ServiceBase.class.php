<?php 
/**
*	payutc
*	Copyright (C) 2013 payutc <payutc@assos.utc.fr>
*
*	This file is part of payutc
*	
*	payutc is free software: you can redistribute it and/or modify
*	it under the terms of the GNU General Public License as published by
*	the Free Software Foundation, either version 3 of the License, or
*	(at your option) any later version.
*
*	payutc is distributed in the hope that it will be useful,
*	but WITHOUT ANY WARRANTY; without even the implied warranty of
*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*	GNU General Public License for more details.
*
*	You should have received a copy of the GNU General Public License
*	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
* ServiceBase.class
* 
* Classe comprenant des méthodes utiles à l'ensemble des services.
* @author payutc <payutc@assos.utc.fr>
* @version 1.0
* @package buckutt
*/

require_once 'config.inc.php';
require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/Image.class.php';
require_once 'class/Point.class.php';
require_once 'class/ComplexData.class.php';
require_once 'class/Cas.class.php';

class ServiceBase {
    protected $db;
	
    /**
    * Constructeur
    */   
    public function __construct() {
        $this->db = Db_buckutt::getInstance();
    }

    /**
    * Retourne la véritable IP du client
    * @return String $ip
    */
    protected function getRemoteIp() {
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return $ip[0];
        }
        elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }   
        else {
            return "";
        }
    }

    /**
    * Retourne l'url du CAS
    * @return String $url
    */
    public function getCasUrl() {
        return Cas::getUrl();
    }
}
