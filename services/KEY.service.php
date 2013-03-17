<?php 
/**
 * KEY.services.php
 * 
 * Ce service expose des méthodes pour déclarer des applications 
 *
 */
 require_once 'class/Application.class.php';
 require_once 'class/ServiceBase.class.php';
 
 class KEY extends ServiceBase {
	 
    public function __construct() {
        parent::__construct();
    }
     
	/**
	* Enregistre une application
	* @param array (array containing application information)
	* @return string la clef
	*/
	public function register_application($app_url, $app_name, $app_desc=null) {
        // Pour déclarer une nouvelle application on a besoin d'un user, mais pas d'être une application.
        $this->checkUserApp(true, false);
		$application = new Application();
		$application->from_array(Array(
            "app_id" => null,
            "app_url" => $app_url,
            "app_key" => null,
            "app_name" => $app_name,
            "app_desc" => $app_desc,
            "app_creator" => $this->user->getNickname(),
            "app_lastuse" => null,
            "app_created" => null
        ));
        $application->insert();
		return $application->to_array();
	}
	
	/**
	 * Obtenir la liste des applications pour l'user current
	 * 
	 * @return Array (liste d'applications)
	 */
	 public function get_current_user_applications() {
        // On a besoin d'avoir un user logged
        $this->checkUserApp(true, false);
        
		return "toto";
	 }
	
 }
