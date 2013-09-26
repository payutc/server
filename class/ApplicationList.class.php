<?php

/**
 * ApplicationList.class
 * 
 * Classe permettant de récupérer plusieurs applications en même temps
 */


use \Payutc\Db\DbBuckutt;

class ApplicationList {
    protected $db;
    protected $apps;

    public function __construct() {
        $this->db = DbBuckutt::getInstance();        
    }
    
    /**
     * Get applications for a given user
     */
	public function fromLogin($login) {
        $apps = array();
        $query = $this->db->query("SELECT app_id, app_url, app_key, app_name, app_desc, app_creator, app_lastuse, 
                                app_created FROM t_application_app WHERE app_creator = '%s' and app_removed is NULL;", 
                                Array($login));	
        if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($query)) {
                $app = new Application();
                $app->fromArray($don);
				array_push($apps, $app);
			}
        }
        $this->apps = $apps;
    }
    
    /**
     * Extract Application under an array format
     */
    public function toArray($key=0) {
        $return = array();
        foreach($this->apps as $app)
        {
            array_push($return, $app->toArray($key=$key));
        }
        return $return;
    }

	
}

