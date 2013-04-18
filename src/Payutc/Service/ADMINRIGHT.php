<?php

namespace Payutc\Service;

use \User;
use \UserRight;
use \ApplicationRight;
use \Application;

/**
 * ADMINRIGHT.services.php
 * 
 * Ce service permet de gérer les droits.
 * Seul les utilisateurs ayant le droit ADMINRIGHT peuvent venir ici.
 *
 */
 
 class ADMINRIGHT extends \ServiceBase {
	 
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Recuperer la liste des droits attribuables (les noms de service en fait)
     * Comme on ne veut pas forcément lister tout les services possibles et que l'ont veut leur donner un petit nom sympa et une description
     * ils sont hardcodé
     *
     * clef "name" => Nom du droit
     * clef "desc" => Descriptions du droit
     * clef "user" => doit on pouvoir donner ce droit à un user
     * clef "app" => doit on pouvoir donner ce droit à une app (en soit c'est toujours le cas, mais veut on le faire apparaitre par défaut dans les menus)
     *
     * Pour les clefs user et app, ce n'est que pour l'ergonomie de l'interface utilisateur. 
     * @return array $services
     */
    public function getServices() {
        return array(
            "ADMINRIGHT"    => array("name" => "Administrateur de fondation", 
                                     "desc" => "Permet la gestion des droits pour les utilisateurs de la fondations",
                                     "user" => true,
                                     "app"  => false),
            "VENTEBADGE"    => array("name" => "Vente physique",
                                     "desc" => "Permet la vente par badge",
                                     "user" => true,
                                     "app"  => true),
            "VENTEWEB"      => array("name" => "Vente en ligne",
                                     "desc" => "Permet la vente depuis une application",
                                     "user" => false,
                                     "app"  => true),
            "ALL"           => array("name" => "Tout les droits",
                                     "desc" => "Donne les droits à l'utilisateur ou à l'application sur tous les services",
                                     "user" => true,
                                     "app"  => true),
            "BLOCKED"       => array("name" => "Blocage",
                                     "desc" => "Donne les droits à l'utilisateur ou à l'application de bloquer/débloquer un utilisateur",
                                     "user" => true,
                                     "app"  => true)
                                        
        );
    }
     
	/**
	* Donner un droit liant un user à une fundation.
	*
	* @param string $usr_login
	* @param string $service
	* @param int $fun_id
	* @return array $result
	*/
	public function setUserRight($usr_login, $service, $fun_id){
        $this->checkRight(true, true, true, $fun_id);
        // L'utilisateur à les droits de donner ce droit :)
        return UserRight::setRight($usr_login, $service, $fun_id);
	}

	/**
	* Donner un droit liant une application à une fundation.
	*
	* @param int $app_id
	* @param string $service
	* @param int $fun_id
	* @return array $result
	*/
	public function setApplicationRight($app_id, $service, $fun_id){
        $this->checkRight(true, true, true, $fun_id);
        // L'utilisateur à les droits de donner ce droit :)
        ApplicationRight::setRight($app_id, $service, $fun_id);
	}

	/**
	* Supprimer un droit liant un user à une fundation.
	*
	* @param int $usr_id
	* @param string $service
	* @param int $fun_id
	* @return array $result
	*/
	public function removeUserRight($usr_id, $service, $fun_id){
        $this->checkRight(true, true, true, $fun_id);
        // L'utilisateur à les droits de retirer ce droit :)
        UserRight::removeRight($usr_id, $service, $fun_id);
	}

	/**
	* Supprimer un droit liant une application à une fundation.
	*
	* @param int $app_id
	* @param string $service
	* @param int $fun_id
	* @return array $result
	*/
	public function removeApplicationRight($app_id, $service, $fun_id){
        $this->checkRight(true, true, true, $fun_id);
        // L'utilisateur à les droits de retirer ce droit :)
        ApplicationRight::removeRight($app_id, $service, $fun_id);
	}

	/**
	* Obtenir les droits liant des user à une fundation.
	*
	* @param int $fun_id
	* @return array $result
	*/
	public function getUserRights($fun_id){
        $this->checkRight(true, true, true, $fun_id);
        // L'utilisateur à les droits de regarder ces droits :)
        return UserRight::getRights($fun_id);
	}

	/**
	* Obtenir les droits liant des applications à une fundation.
	*
	* @param int $fun_id
	* @return array $result
	*/
	public function getApplicationRights($fun_id){
        $this->checkRight(true, true, true, $fun_id);
        // L'utilisateur à les droits de regarder ces droits :)
        return ApplicationRight::getRights($fun_id);
	}
	
	/**
	* Obtenir les applications déclarés (pour l'interface utilisateur des droits)
	*
	* @return array $result
	*/
	public function getApplications(){
        $this->checkRight();
        // L'utilisateur à les droits de regarder la liste des applications
        return Application::getAll();
	}

 }
