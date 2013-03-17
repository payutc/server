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
require_once 'class/User.class.php';
require_once 'class/Cas.class.php';
require_once 'class/Application.class.php';
require_once 'class/User.class.php';

class ServiceBase {
    protected $db;
    protected $user;
    protected $application;
	
    /**
    * Constructeur
    */   
    public function __construct() {
        $this->db = Db_buckutt::getInstance();
    }

    /**
	 * Connecter le user avec un ticket CAS.
	 * 
	 * @param String $ticket
	 * @param String $service
	 * @return array $state
	 */
    public function loginCas($ticket, $service) {
		$login = Cas::authenticate($ticket, $service);
        if ($login < 0) {
   			return array("error"=>-1, "error_msg"=>"Erreur de login CAS.");
        }
		$this->user = new User($login, 1, "", 0, 1, 0);

		$r = $this->user->getState();
		if($r == 405){
			$this->loginToRegister = $login;
			return array("error"=> array( "message"=>"Le user n'existe pas ici.", "code" => $r));
		}
		elseif($r != 1) {
			return array("error"=> array( "message"=>"Le user n'a pas pu être chargé.", "code" => $r));
		}
		else {
			return array("success"=>"ok");
		}
    }

	/**
	* Deconnexion
	*
	* @return array $state
	*/
	public function logout() {
        if($this->user)
			unset($this->user);
        if($this->app)
            unset($this->app);
        session_destroy();
        return "ok";
	}


    /**
    * Retourne l'url du CAS
    * @return String $url
    */
    public function getCasUrl() {
        return Cas::getUrl();
    }

    /**
    * Recupere le statut de la connexion courante
    * @return array $status
    */
    public function getStatus() {
        if($this->application)
            $app = $this->application->to_array();
        else
            $app = null;
        if($this->user)
            $user = $this->user->getNickname();
        else
            $user = null;
        return array("application" => $app, "user" => $user);
    }

    /**
     * Verifie qu'un user et/ou une app ont été loggé
     * Sinon throw une exception 
     */
    protected function checkUserApp($user=true, $app=true) {
        if($user && !$this->user)
            throw new Exception("Vous devez connecter un utilisateur ! (method loginCas)");
        if($app && !$this->application)
            throw new Exception("Vous devez connecter une application ! (method loginApp)");
    }

    /**
     * Authentifie une clef d'application
     */
    public function loginApp($key) {
        $service = get_class($this);
        $application = new Application();
        $application->from_key($key); // Throw an exception if Application doesn't exists...
        $this->application = $application;
        return "ok";
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
}
