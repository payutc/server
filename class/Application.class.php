<?php

/**
 * Application.class
 * 
 * Classe gérant les Applications
 */

use \Payutc\Db\Dbal;
use \Payutc\Db\DbBuckutt;

class Application {
    protected $db;
    protected $app_id;
    protected $app_url;     // URL du service CAS, doit correspondre pour l'auth CAS.
    protected $app_key;     // Clef d'application, ne peut pas être changé
    protected $app_name;    // Nom de l'application
    protected $app_desc;    // Description de l'application
    protected $app_creator; // Login utc du createur de l'application
    protected $app_lastuse; // Dernière utilisation de l'application
    protected $app_created; // Date de création de l'application


    public function __construct() {
        $this->db = DbBuckutt::getInstance();        
    }
    
    /**
     * Get ID
     */
    public function getId() {
        return $this->app_id;
    }

    /**
     * Init the application from DB for a given key
     */
	public function fromKey($key) {
        $this->app_key = $key;
        $query = $this->db->query("SELECT app_id, app_url, app_key, app_name, app_desc, app_creator, app_lastuse, 
                                app_created FROM t_application_app WHERE app_key = '%s' and app_removed is NULL;", 
                                Array($this->app_key));		
        $row = $this->db->fetchArray($query);
        if ($this->db->affectedRows() != 1) {
            throw new Exception("La clef d'application n'a pas été reconnu !");
        }
        $this->fromArray($row);
    }
    
    /*
     * Init the application from a given id
     */
    public function fromId($id) {
        $this->app_id = $id;
        $query = $this->db->query("SELECT app_id, app_url, app_key, app_name, app_desc, app_creator, app_lastuse, 
                                app_created FROM t_application_app WHERE app_id = '%u' and app_removed is NULL;", 
                                Array($this->app_id));		
        $row = $this->db->fetchArray($query);
        if ($this->db->affectedRows() != 1) {
            throw new Exception("Il n'existe pas d'application correspondant à cet ID !");
        }
        $this->fromArray($row);
    }
    
    /*
     * For a given row, instantiate the Application attributes
     */
    public function fromArray($row) {
        $this->app_id = $row['app_id'];
        $this->app_url = $row['app_url'];
        $this->app_key = $row['app_key'];
        $this->app_name = $row['app_name'];
        $this->app_desc = $row['app_desc'];
        $this->app_creator = $row['app_creator'];
        $this->app_lastuse = $row['app_lastuse'];
        $this->app_created = $row['app_created'];
    }
    
    
    /*
     * Function for creating a key...
     */
    private function randSha1($length) {
        $max = ceil($length / 40);
        $random = '';
        for ($i = 0; $i < $max; $i ++) {
            $random .= sha1(microtime(true).mt_rand(10000,90000));
        }
        return substr($random, 0, $length);
    }

    /*
     * Insert a key
     */
    public function insert()
    {
        // Calculate a key
        $this->app_key = $this->randSha1(32);
        $this->db->query("INSERT INTO t_application_app (app_url, app_key, app_name, app_desc, app_creator, app_created) VALUES('%s', '%s', '%s', '%s', '%s', NOW());", 
                         Array($this->app_url, $this->app_key, $this->app_name, $this->app_desc, $this->app_creator));
		if ($this->db->affectedRows() != 1)
            throw Exception("DB ERROR !");
        // Update app_id
        $this->app_id = $this->db->insertId();
    }
    
    /*
     * toArray()
     * key represent if we want or not output the key.
     * by default we don't want !
     */
    public function toArray($key=0)
    {
        $application = Array(
            "app_id" => $this->app_id,
            "app_url" => $this->app_url,
            "app_name" => $this->app_name,
            "app_desc" => $this->app_desc,
            "app_creator" => $this->app_creator,
            "app_lastuse" => $this->app_lastuse,
            "app_created" => $this->app_created);
        if($key)
            $application["app_key"] = $this->app_key;
        return $application;
    }

    /*
     * Update last app_lastuse field
     */
    public function registerUse() {
        $qb = Dbal::createQueryBuilder();
        $qb->update('t_application_app', 'app')
            ->set('app.app_lastuse', 'NOW()')
            ->where('app.app_id = :app_id')
            ->setParameter('app_id', $this->app_id);

        $qb->execute();
    }

    /*
     * getAll()
     * 
     * Return all applications under array format
     */
    public static function getAll($key=0)
    {
        $apps = array();
        $db = DbBuckutt::getInstance();
        $query = $db->query("SELECT app_id, app_url, app_key, app_name, app_desc, app_creator, app_lastuse, 
                                app_created FROM t_application_app WHERE app_removed is NULL;");	
        if ($db->affectedRows() >= 1) {
			while ($don = $db->fetchArray($query)) {
                $app = new Application();
                $app->fromArray($don);
				array_push($apps, $app);
			}
        }
        $result = array();
        foreach($apps as $app)
        {
            array_push($result, $app->toArray($key=$key));
        }
        return $result;
    }

	
}

