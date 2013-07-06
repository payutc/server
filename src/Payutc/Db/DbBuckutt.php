<?php
namespace Payutc\Db;

use \Payutc\Config;
use \Payutc\Log;

/**
* 
* Couche d'abstraction vers les bases de données
* 
* @package 
* @version $id$
* @copyright Copyright ung
* @author Sid ( CHATEAU Mathieu ) 
* @license PHP Version 5.0 {@link http://www.php.net/license/5_0.txt}
*/

class DbBuckutt {
    public static $instance;    
    private $connexion;
    
    /**
    * Recupere une instance de DB
    * @return object $instance
    */
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new DbBuckutt();
            self::$instance->connect(Config::get('sql_host'), Config::get('sql_db'), Config::get('sql_user'), Config::get('sql_pass'));
        }
        
        return self::$instance;
    }

    /**
    * __wakeup Fonction de reveil de la serialization ! recre la conextion
    * Utile en soap ;)
    * 
    * @final
    * @access public
    * @return void
    */
    public final function __wakeup()
    {
        $this->connect(Config::get('sql_host'), Config::get('sql_db'), Config::get('sql_user'), Config::get('sql_pass'));
    }

    /**
    * Fonction connect
    * Connection à la base
    *
    * @param $hostin nom de l'hote
    * @param $hostin nom de la base
    * @param $hostin nom de l'utilisateur
    * @param $hostin mot de passe
    * @return boulean etat de la connection : true = connecté
    */
    public function connect($host, $base, $user, $pass)
    {
        if (!$this->connexion = mysql_connect($host, $user, $pass))
        {
            $this->error();
            exit();
        }
        if (!$result = mysql_select_db($base, $this->connexion))
        {
            $this->error();
            exit();
        }
		
        mysql_set_charset("utf8", $this->connexion);
		
        return $result;
    }

    /**
    * Fonction query
    * Execution d'une requete
    *
    * @param $query Requete SQL à executer
    * @param $args Valeurs des paramètres de la requête
    * @return resultset Résultat de la requete, false si echec
    */
    public function query($query, $args = false) {
        if(!empty($args)){
            foreach($args as &$parametre){
                $parametre = mysql_real_escape_string($parametre, $this->connexion);
            }
        }

        if(!$result = mysql_query(vsprintf($query, $args), $this->connexion)) {
            $this->error();
        }

        return $result;
    }
    
    /**
    * Fonction result
    * Récupération d'un champs d'un resultset
    *
    * @param $result resultset provennant d'une requete
    * @param $column nom ou numero de la colonne souhaitée
    * @return valeur de la colonne
    */
    public function result($result, $column = 0)
    {
        if ($result && mysql_num_rows($result) != 0)
        {
            return mysql_result($result, $column);
        }
        
        return false;        
    }

    /**
    * Fonction insertId
    * Retourne l'identifiant de l'enregistrement qui vient juste d'etre créé par un INSERT
    *
    * @return identifiant de l'enregistrement
    */
    public function insertId()
    {
        return mysql_insert_id();
    }

    /**
    * Fonction numRows
    * Retourne le nombre d'enregistrement d'une requete SELECT
    *
    * @param $result Resultat d'une requete
    * @return nombre d'enregistrements
    */
    public function numRows($result)
    {
        if($result)
        {
            return mysql_num_rows($result);;
        }
        
        return 0;
    }

    /**
    * Fonction fetchArray
    * Repartit un enregistrement dans un tableau associatif et pass à l'enregistrement suivant
    *
    * @param $result résultat d'une requête SELECT
    * @return Array Tableau associatif comportant les valeurs de l'enregistrement courant. false si il n'y a plus d'enregistrement
    */
    public function fetchArray($result, $type = '')
    {
        if ($type != '')
        {
            return mysql_fetch_array($result, $type);
        }
        
        return mysql_fetch_array($result);
    }

    /**
    * Fonction affectedRows
    * Retourne le nombre de lignes affectées par une requete (UPDATE / DELETE)
    *
    * @return nombre de lignes
    */
    public function affectedRows()
    {
        return mysql_affected_rows($this->connexion);
    }

    /**
    * Fonction close
    * Ferme la connection
    *
    * @return boulean indique si la deconnexion s'est bien effectuée
    */
    public function close()
    {
        return mysql_close($this->connexion);
    }
    
    /**
    * Fonction error
    * Log une erreur SQL
    *
    */
    function error()
    {
        Log::error("Erreur SQL #".mysql_errno().": ". mysql_error());
    }
    
}
