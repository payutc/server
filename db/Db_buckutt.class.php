<?php
/******************* db.class ***************************************
		Définition d'une interface générique vers les bases de données
	**********************************************************************/

/**
	* Db_gnung 
	* Couche d'abstraction vers les bases de données
	* 
	* @package 
	* @version $id$
	* @copyright Copyright ung
	* @author Sid ( CHATEAU Mathieu ) 
	* @license PHP Version 5.0 {@link http://www.php.net/license/5_0.txt}
	*/
require_once 'db/config.inc.php';

class Db_buckutt {
	public $dbType;
	public $type = '';
	public $host = '';
	public $pass = '';
	public $user = '';
	public $base = '';
	public $chronos = '';
	public static $instance;

	/**
		* Fonction Db
		* Constructeur de la classe, declare la classe qui va héritier de celle-ci
		*
		* @param $type type de la base utilisé. la classe correspondante doit exister (ex : mysql.class.inc)
		* @return boulean indique si le type est connu, true = type connu
		*/

	public final function  __construct ($type) {
		$this->type = $type;
		if(class_exists(strtolower($type))){
			$this->dbType = new $type();
			return true;
		}else{
			return false;
		}
	}
    
    /**
     * Recupere une instance de DB
     * @return object $instance
     */
    public function getInstance()
    {
	global $_SQL;
        if (! isset (self::$instance))
        {
            self::$instance = new Db_buckutt('mysql');
            self::$instance->connect($_SQL['host'], $_SQL['base'], $_SQL['user'], $_SQL['pass']);
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
	public final function __wakeup(){
					$this->__construct($this->type);
					$this->connect($this->host,$this->base,$this->user,$this->pass);
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

	public function  connect ($hostIn, $baseIn, $userIn, $passIn) {
		
		$this->host = $hostIn;
		$this->user = $userIn;
		$this->pass = $passIn;
		$this->base = $baseIn;
		return ($this->dbType->connect($this));
	}


	/*
	//Sélectionne une nouvelle base
	public function  selectDb ($query) {
	$result = $this->dbType->query($query);
	return $result;
	}
		*/


	/**
		* Fonction query
		* Execution d'une requete
		*
		* @param $query Requete SQL à executer
		* @param $debug Boulean qui indique si la requete doit etre affichée
		* @return resultset Résultat de la requete, false si echec
		*/

	public function  query ($query,$debugorarg=false ,$debug = false) {
		if (isset($_GET["profiler"])) {
			$this->chronos->start($query);
		}
		$result = $this->dbType->query($query, $debugorarg,$debug);
		if (isset($_GET["profiler"])) {
			$this->chronos->stop($query);
		}
		return $result;
	}

public function fetchQueryToString($query,$debugorarg=false ,$debug = false) {
		if (isset($_GET["profiler"])) {
			$this->chronos->start($query);
		}
		$result = $this->dbType->fetchQueryToString($query, $debugorarg,$debug);
		if (isset($_GET["profiler"])) {
			$this->chronos->stop($query);
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

	public function  result($result, $column=0) {

		if ($result && $result != null ) if(mysql_num_rows($result) != 0) return $this->dbType->result($result, $column);
	}

	/**
		* Fonction insertId
		* Retourne l'identifiant de l'enregistrement qui vient juste d'etre créé par un INSERT
		*
		* @return identifiant de l'enregistrement
		*/

	public function  insertId() {
		$result = $this->dbType->insertId();
		return $result;
	}


	/**
		* Fonction numRows
		* Retourne le nombre d'enregistrement d'une requete SELECT
		*
		* @param $result Resultat d'une requete
		* @return nombre d'enregistrements
		*/

	public function  numRows($result) {
		$result = $this->dbType->numRows($result);
		return $result;
	}

	/**
		* Fonction fetchArray
		* Repartit un enregistrement dans un tableau associatif et pass à l'enregistrement suivant
		*
		* @param $result résultat d'une requête SELECT
		* @return Array Tableau associatif comportant les valeurs de l'enregistrement courant. false si il n'y a plus d'enregistrement
		*/
	public function  fetchArray($result,$type='') {
		$result = $this->dbType->fetchArray($result,$type);
		return $result;
	}


	/**
		* Fonction affectedRows
		* Retourne le nombre de lignes affectées par une requete (UPDATE / DELETE)
		*
		* @return nombre de lignes
		*/

	public function  affectedRows() {
		$result = $this->dbType->affectedRows();
		return $result;
	}


	/**
		* Fonction escape_string
		* Protege une chaine  pour la passer a query
		* 
		* @param $str chaine a proteger
		* @return chaine protegee
		*/
	public function escapeString($str){
		$result = $this->dbType->escapeString($str);
		return $result;
	}

	public function  showChronos() {
		$this->chronos->display();
	}


	/**
		* Fonction close
		* Ferme la connection
		*
		* @return boulean indique si la deconnexion s'est bien effectuée
		*/

	public function  close() {
		$result = $this->dbType->close();
		return $result;
	}
}

?>
