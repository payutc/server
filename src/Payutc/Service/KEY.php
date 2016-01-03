<?php

namespace Payutc\Service;

use \Application;
use \ApplicationList;
use \UserRightsList;
use \Payutc\Log;

/**
 * KEY.services.php
 * 
 * Ce service expose des méthodes pour déclarer des applications 
 *
 */
 
 class KEY extends \ServiceBase {
	 
    public function __construct() {
        parent::__construct();
    }
     
	/**
	* Enregistre une application
	* @param array (array containing application information)
	* @return string la clef
	*/
	public function registerApplication($app_url, $app_name, $app_desc=null) {
        // Pour déclarer une nouvelle application on a besoin d'un user, mais pas d'être une application.
        if(!$this->user()) {
            Log::info("registerApplication($app_url, $app_name, $app_desc) : User not connected");
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur ! (method loginCas)");
        }

		$application = new Application();
		$application->fromArray(Array(
            "app_id" => null,
            "app_url" => $app_url,
            "app_key" => null,
            "app_name" => $app_name,
            "app_desc" => $app_desc,
            "app_creator" => $this->user()->getNickname(),
            "app_lastuse" => null,
            "app_created" => null
        ));
            $application->insert();
            Log::info("registerApplication($app_url, $app_name, $app_desc) : OK");
            return $application->toArray(1);
	
        }
	
    /**
     * Obtenir la liste des applications pour l'user current
     * 
     * @return Array (liste d'applications)
     */
     public function getCurrentUserApplications() {
        // On a besoin d'avoir un user logged
        if(!$this->user()) {
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur ! (method loginCas)");
        }
        $application_list = new ApplicationList();
        $application_list->fromLogin($this->user()->getNickname());
        // On retourne la liste d'applications (mais sans la clef, car on ne ne veut pas qu'un service "malintentioné" puisse récupérer les clefs d'un user).
                Log::info("getCurrentApplication() : OK");
                return $application_list->toArray(0);
    }

	/** l'utilisateur a-t-il des droits d'admin ? superadmin ? */
	 public function hasUserAdminRights() {
        // On a besoin d'avoir un user logged
        if(!$this->user()) {
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur ! (method loginCas)");
        }

        $userRights = \UserRightsList::getUserAdminRights($this->user()->getId());
        $userSuperAdmin = false;
        $userAdmin = false;
        $auMoinsIlAdesDroits = (count($userRights))?1:0;
        foreach ($userRights as $right) {
            if ($right['ufu_service'] == "ADMINRIGHT" || $right['ufu_service'] == null ) {
                $userAdmin = true;
            }
            if ($right['fun_id'] == null && ($right['ufu_service'] == "ADMINRIGHT" || $right['ufu_service'] == null)) {
                $userSuperAdmin = true;
            }
        }
        return ($userSuperAdmin)?3: (($userAdmin)?2: (($auMoinsIlAdesDroits)?1:0) );
	}
	
 }
