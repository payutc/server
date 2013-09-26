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
use \Payutc\Bom\User;
use \Payutc\Log;

/**
* ServiceBase.class
* 
* Classe comprenant des méthodes utiles à l'ensemble des services.
* @author payutc <payutc@assos.utc.fr>
* @version 1.0
* @package buckutt
*/

use \Payutc\Db\DbBuckutt;

class ServiceBase {
    protected $db;
    protected $service_name;  // Nom du service
	
    /**
    * Constructeur
    */   
    public function __construct() {
        // DEPRECATED
        // Comme on vise à virer les requetes SQL dans les services le $this->db
        // devrait bientôt disparaitre.
        $this->db = DbBuckutt::getInstance();

        $classdesc = explode("\\", get_class($this));
        $this->service_name = end($classdesc);
        
        if(!array_key_exists('ServiceBase', $_SESSION)) {
            $_SESSION['ServiceBase'] = array(
                "user" => null,
                "application" => null            
            );
        }
    }

    /**
    * Un jour les services ne seront plus en session, et le constructeur sera appelé à chaque
    * requete. Mais en ce moment la classe est sérializé, donc c'est wakeup et pas contruct qui
    * est appelé.
    */
    public function __wakeup() {
        self::__construct();
    }

    /**
    * Retourne l'utilisateur actuellement connecté (ou null sinon)
    */
    protected function user() {
        return $_SESSION['ServiceBase']['user'];
    }

    /**
    * Retourne l'application actuellement connecté (ou null sinon)
    */
    protected function application() {
        return $_SESSION['ServiceBase']['application'];
    }

    /**
	 * Connecter le user avec un ticket CAS.
	 * 
	 * @param String $ticket
	 * @param String $service
	 * @return bool $success
	 */
    public function loginCas($ticket, $service) {
        Log::debug("loginCas($ticket, $service)");
        // Unlog previous user if any
        $_SESSION['ServiceBase']['user'] = NULL;

        $user = User::getUserFromCas($ticket, $service);
        
        // Save user in session for all service
        $_SESSION['ServiceBase']['user'] = $user;
        return $user->getNickname();
    }

	/**
	* Deconnexion
	*
	* @return true
	*/
	public function logout() {
        unset($_SESSION['ServiceBase']);
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
        if($this->application())
            $app = $this->application()->toArray(0);
        else
            $app = null;
        if($this->user())
            $user = $this->user()->getNickname();
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
     * et bien sur fun_id == NULL ne sera authorisé que si l'utilisateur est "super admin" sur le droit en question.
     */
    public function checkRight($user=true, $app=true, $fun_check=false, $fun_id=NULL) {
        if($user)
        {
            if(!$this->user()) {
                throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur ! (method loginCas)");
            }
            // Check if App_id <=> Fun_id <=> Service_name exists in ApplicationRight
            UserRight::check($this->user()->getId(),
                             $this->service_name,
                             $fun_check,
                             $fun_id);
        }
        if($app)
        {
            if(!$this->application()) {
                throw new \Payutc\Exception\CheckRightException("Vous devez connecter une application ! (method loginApp)");
            }
            // Check if App_id <=> Fun_id <=> Service_name exists in ApplicationRight
            ApplicationRight::check($this->application()->getId(),
                                    $this->service_name,
                                    $fun_check,
                                    $fun_id);
        }
    }
    
    /*
     * Return true if current user is admin (=> Have right on this service with fun_id = NULL)
     */
    public function isAdmin() {
        try {
            $this->checkRight(true, true, true, NULL);
            return true;
        } catch (\Payutc\Exception\CheckRightException $e) {
            return false;
        }
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
        $fundations_for_user = UserRight::getFundations($this->user()->getId(), 
                                                        $this->service_name);
        $fundations_for_app = ApplicationRight::getFundations($this->application()->getId(),
                                                              $this->service_name);

        // Si on est admin, le premier item permet d'indiquer une fundation "fantome" qui representent toutes les autres.
        if($this->isAdmin()) {
            $fundations = array(array("fun_id" => null, "name" => "Toutes les fundations"));
        } else {
            $fundations = array();
        }

        // On fait un ET logique entre les deux arrays
        foreach($fundations_for_user as $fun_id => $fundation) {
            if(array_key_exists($fun_id, $fundations_for_app)) {
                $fundations[] = array("fun_id" => $fun_id, "name" => $fundation);
            }
        }

        return $fundations;
    }

    /**
     * Authentifie une clef d'application
     */
    public function loginApp($key) {
        // Unload previous application registered
        $_SESSION['ServiceBase']['application'] = NULL;

        $application = new Application();
        $application->fromKey($key); // Throw an exception if Application doesn't exists...
        $application->registerUse(); // Update the app_lastuse field to now
        $_SESSION['ServiceBase']['application'] = $application;
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
    
    /**
    * Renvoie la liste des services pour lesquels l'utilisateur et l'application courante
    * ont des droits pour y accéder
    */
    public function getEnabledServices() {
        $services = Services::getServices();
        $result = array();
        foreach($services as $service) {
            $this->service_name = $service;
            try {
                $this->checkRight();
                $result[] = $service;            
            } 
            catch(\Payutc\Exception\CheckRightException $e) { /* no right for this service */ }
        }
        // put back the correct $this->service_name
        $classdesc = explode("\\", get_class($this));
        $this->service_name = end($classdesc);
        return $result;
    }

	/**
	 * Récupérer les infos sur une image.
	 * 
	 * @param int $img_id
	 * @param int $outw Largeur de l'image
	 * @param int $outh Hauteur de l'image
	 * @return array $csv
	 */
	public function getImage64($img_id, $outw = 0, $outh = 0) {
        // A partir du moment ou l'on a les droits sur le service courant on peut récupérer les images        
        $this->checkRight();

		// Récupération de l'objet image
		$image = new \Image($img_id);

        // Vérifie que l'image existe bien
        if($image->getState() != 1) {
			Log::warn("getImage64($img_id, $outw, $outh) : No image found");
            return array("error"=>400, "error_msg"=>"Image non trouvée.");
        }
		
		// Création de l'image GD originale
		$oldgd = imagecreatefromstring($image->getContent());
		
        $width_orig = imagesx($oldgd);
        $height_orig = imagesy($oldgd);

		// Handle no resize
		if($outw == 0)
			$outw = $width_orig;
		if($outh == 0)
			$outh = $height_orig;

        $ratio_orig = $width_orig/$height_orig;

        if ($outw/$outh > $ratio_orig) {
           $outw = $outh*$ratio_orig;
        } else {
           $outh = $outw/$ratio_orig;
        }
		
		// Création de l'image GD à sortir
		$newgd = imagecreatetruecolor($outw, $outh);
		
		// Redimensionnement
		imagecopyresampled($newgd, $oldgd, 0, 0, 0, 0, $outw, $outh, $width_orig, $height_orig);
		
		// Récupération et encodage en base64
		ob_start();
		imagepng($newgd);
		$output = base64_encode(ob_get_contents());
		ob_end_clean();
		
		// Retour s'il y a une image correcte
		if($output != false)
			return array("success"=> $output);
		else {
			Log::warn("getImage64($img_id, $outw, $outh) : No image found");
			return array("error"=>400, "error_msg"=>"Image non trouvée.");
		}
	}
    
    /**
     * Renvoie l'id d'un utilisateur à partir de son login UTC
     */
    public function getUserId($login) {
        $this->checkRight();
        $user = new User($login);
        return $user->getId();
    }

    protected function &getSession() {
        if (!isset($_SESSION[get_class($this)])) {
            $_SESSION[get_class($this)] = array();
        }
        return $_SESSION[get_class($this)];
    }
    
    protected function destroySession() {
        unset($_SESSION[get_class($this)]);
    }
    
    protected function sessionSet($key, $val) {
        $session =& $this->getSession();
        $session[$key] = $val;
    }
    
    protected function sessionGet($key, $default = null) {
        $session =& $this->getSession();
        if (!isset($session[$key])) {
            return $default;
        }
        else {
            return $session[$key];
        }
    }
}





