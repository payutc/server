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

class ServiceBase {
    protected $db;
    protected $user;
    protected $application;
    protected $service_name;  // Nom du service
	
    /**
    * Constructeur
    */   
    public function __construct() {
        $this->db = Db_buckutt::getInstance();
        $this->service_name = get_class($this);
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
   			return array("error"=> array( "message"=>"Erreur de login cas", "code" => -1));
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
            unset($this->application);
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
            $app = $this->application->toArray($key=0);
        else
            $app = null;
        if($this->user)
            $user = $this->user->getNickname();
        else
            $user = null;
        return array("application" => $app, "user" => $user);
    }

    /**
     * Verifie qu'un user et/ou une app ont les droits sur le service courant (et sur la fundation si précisé)
     * Par défaut vérifie et les droits de l'appli et les droits de l'user sur le service
     *
     * Dans les fonctions il faut l'utiliser ainsi:
     * La première ligne des fonctions exposé doit être:
     * $this->checkRight();
     * Si l'on ne veut pas checker l'application (cas d'un service autorisé à tout le monde, comme KEY par exemple on fait :)
     * $this->checkRight($app=false);
     * Si l'on ne veut pas checker le user (cas d'un service ne dépendant pas d'un user, comme un service permettant de lister les articles sur un site web par exemple)
     * $this->checkRight($user=false);
     * Si votre fonction est ouverte à tout le monde, ne rien mette ou mettre: $this->checkRight($user=false, $app=false) sera équivalent.
     * 
     * Lorsque votre fonction travaille sur une fundation, vous devez passer le $fun_id pour que l'on vérifie si l'user et/ou l'app ont les droits sur la fundations
     * Lorsque les droits ne sont pas satisfait cette fonction throw une exception et donc interromps l'execution de votre fonction proprement. 
     */
    public function checkRight($user=true, $app=true, $fun_id=false) {
        if($user)
        {
            if(!$this->user)
                throw new Exception("Vous devez connecter un utilisateur ! (method loginCas)");
            // Check if App_id <=> Fun_id <=> Service_name exists in ApplicationRight
            UserRight::check($user_id = $this->user->getId(),
                             $service_name = $this->service_name,
                             $fundation_id = $fun_id);
        }
        if($app)
        {
            if(!$this->application)
                throw new Exception("Vous devez connecter une application ! (method loginApp)");
            // Check if App_id <=> Fun_id <=> Service_name exists in ApplicationRight
            ApplicationRight::check($application_id = $this->application->getId(),
                                    $service_name = $this->service_name,
                                    $fundation_id = $fun_id);
        }
        return "ok";
    }

    /**
     * Retourne les fundations sur les quels on a les droits pour travailer
     * Selon tout les droit en vigueur
     * @return array()
     */
    public function getFundations() {
        // Verification sur le droits avant toute choses
        $this->checkRight();
        // On recupere les fundations pour l'user et l'application
        $fundations_for_user = UserRight::getFundations($this->user->getId(), 
                                                        $this->service_name);
        $fundations_for_app = ApplicationRight::getFundations($this->application->getId(),
                                                              $this->service_name);
        // On fait un ET logique entre les deux arrays
        $fundations = array();
        foreach($fundations_for_user as $fun_id => $fundation)
            if(array_key_exists($fun_id, $fundations_for_app))
                $fundations[$fun_id] = $fundation;
        return $fundations;
    }

    /**
     * Authentifie une clef d'application
     */
    public function loginApp($key) {
        $service = get_class($this);
        $application = new Application();
        $application->fromKey($key); // Throw an exception if Application doesn't exists...
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
