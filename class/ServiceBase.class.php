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

use \Payutc\Mapping\Services;
use \Payutc\Exception\LoginError;
use \Payutc\Exception\UserNotFound;
use \Payutc\Exception\UserError;

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
        $this->service_name = end(explode("\\", get_class($this)));
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
        if ($login === -1) {
            throw new LoginError("Erreur de login cas", -1);
        }
        $this->user = new User($login, 1, "", 0, 1, 0);

        $r = $this->user->getState();
        if($r == 405){
            $this->loginToRegister = $login;
            throw new UserNotFound("Le user n'existe pas ici", $r);
        }
        else if($r != 1) {
            throw new UserError("Le user n'a pas pu être chargé.", $r);
        }

        return true;
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
        return true;
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
            $app = $this->application->toArray(0);
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
     * $this->checkRight(false);
     * Si l'on ne veut pas checker le user (cas d'un service ne dépendant pas d'un user, comme un service permettant de lister les articles sur un site web par exemple)
     * $this->checkRight(true, false);
     * Si votre fonction est ouverte à tout le monde, ne rien mette ou mettre: $this->checkRight(false, false) sera équivalent.
     * 
     * Lorsque votre fonction travaille sur une fundation, vous devez passer $fun_check à true pour indiquer que vous tenez à la verification des droits sur le fun_id
     * et bien sur fun_id == NULL sera refusé
     */
    public function checkRight($user=true, $app=true, $fun_check=false, $fun_id=NULL) {
        if($fun_id == NULL && $fun_check == true) {
            throw new Exception("fun_id cannot be 'NULL' !");
        }
        if($user)
        {
            if(!$this->user)
                throw new Exception("Vous devez connecter un utilisateur ! (method loginCas)");
            // Check if App_id <=> Fun_id <=> Service_name exists in ApplicationRight
            UserRight::check($this->user->getId(),
                             $this->service_name,
                             $fun_id);
        }
        if($app)
        {
            if(!$this->application)
                throw new Exception("Vous devez connecter une application ! (method loginApp)");
            // Check if App_id <=> Fun_id <=> Service_name exists in ApplicationRight
            ApplicationRight::check($this->application->getId(),
                                    $this->service_name,
                                    $fun_id);
        }
        return true;
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
        $application = new Application();
        $application->fromKey($key); // Throw an exception if Application doesn't exists...
        $this->application = $application;
        return true;
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
    * Renvoie une liste d'utilisateurs correspondant à la recherche
    * Un utilisateur et une application doivent être authentifié et autorisé sur le service
    * 
    * @return Array $userList
    */
    public function userAutocomplete($queryString) {
        // Verification sur le droits avant toute choses
        $this->checkRight();
        $res = $this->db->query("SELECT usr_id, usr_firstname, usr_lastname
            FROM ts_user_usr WHERE (UPPER(usr_firstname) LIKE '%s%%' OR UPPER(usr_lastname) LIKE '%s%%')
            ORDER BY usr_lastname ASC LIMIT 10;", array(strtoupper($queryString), strtoupper($queryString)));
        $return = array();
        if ($this->db->affectedRows() >= 1) {
            while ($don = $this->db->fetchArray($res)) {
                $return[] = array(
                    "id" => $don['usr_id'],
                    "name" => $don['usr_firstname']." ".$don['usr_lastname']
                );
            }
        }
        return $return;
    }
    
    public function getServices() {
        return Services::getServices();
    }
}
