<?php 
/**
    BuckUTT - Buckutt est un système de paiement avec porte-monnaie électronique.
    Copyright (C) 2011 BuckUTT <buckutt@utt.fr>

	This file is part of BuckUTT
	
    BuckUTT is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    BuckUTT is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
 * AAdmin.class
 * 
 * Classe permettant de tout administrer
 * @author BuckUTT <buckutt@utt.fr>, payutc <payutc@assos.utc.fr>
 * @version 3.0
 * @package buckutt
 */

require_once 'config.inc.php';
require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/Image.class.php';
require_once 'class/Point.class.php';
require_once 'class/ComplexData.class.php';
require_once 'class/Cas.class.php';
require_once 'class/User.class.php';
require_once 'class/User.class.php';

class AAdmin {
	
	protected $db;
	protected $user;
	
	/**
	 * Constructeur.
	 */   
	public function __construct() {
		$this->db = Db_buckutt::getInstance();
	}

	protected function getRemoteIp() {
		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	 * Retourne l'url du CAS
	 * @return String $url
	 */
	public function getCasUrl() {
	 return Cas::getUrl();
	}

	/**
	 * Connecter le user avec un ticket CAS.
	 * 
	 * @param String $ticket
	 * @param String $service
	 * @return int $state
	 */
    public function loginCas($ticket, $service) {
		$login = Cas::authenticate($ticket, $service);
		if ($login < 0) {
			return -1;
		}
		$this->user = new User($login, 1, "", 0, 1, 0);
		return $this->user->getState();
    }
	
	/**
	* Récupérer les informations sur une erreur à partir de son id.
	*
	* @param int $id
	* @return String $csv
	*/
	public function getErrorDetail($id) {
		if (is_array($don = $this->db->fetchArray($this->db->query("SELECT err_code, err_name, err_description FROM ts_error_err WHERE err_code = '%u';", Array($id))))) {
			$txt = new ComplexData(array($don['err_code'],$don['err_name'],$don['err_description']));
			return $txt->csvArrays();
		} else {
			return "430";
		}
	}


	/*

	ICI LES FONCTIONS LIES A l'USER

	*/

	/**
	* Retourne le firstname
	* 
	* @return string $firstname
	*/
	public function getFirstname() {
		return $this->user->getFirstname();
	}

	/**
	* Retourne le lastname
	* 
	* @return string $lastname
	*/
	public function getLastname() {
		return $this->user->getLastname();
	}


	/*

	ICI LES FONCTIONS LIES AUX FUNDATIONS

	*/

	/**
	* Ajoute une fundation
	*
	* @param string $nom
	* @return int $fundation
	*/
	public function add_fundation($nom) {
		// TODO CHECK RIGHT ADD A FUNDATION
		$fundation_id = $this->db->insertId(
              $this->db->query(
                  "INSERT INTO  t_fundation_fun (`fun_id` ,`fun_name` ,`fun_removed`)VALUES (NULL ,  '%s',  '0');", 
                  array($nom)));
		return $fundation_id;
	}	

	/**
	* Récuperer les fundations
	* 
	* @return array $fundation
	*/
	public function get_fundations() {
		// TODO CHECK RIGHT GET FUNDATIONS (Jusqu'a preuve du contraire ce droit est universel...)
		$fundations = array();
		$res = $this->db->query("SELECT fun_id, fun_name FROM t_fundation_fun WHERE fun_removed = '0';");
        while ($don = $this->db->fetchArray($res)) {
            $fundations[]=array(
            	"id"=>$don['fun_id'], 
            	"name"=>$don['fun_name']);
        }
        return $fundations;
	}

	/**
	* Récuperer mes fundations (au sens de fundations sur les quels j'ai des droits)
	* 
	* @return array $fundation
	*/
	public function get_my_fundations() {
		// TODO CHECK RIGHT GET FUNDATIONS
		$fundations = array();
		$res = $this->db->query("SELECT fun_id, fun_name FROM t_fundation_fun WHERE fun_removed = '0';");
        while ($don = $this->db->fetchArray($res)) {
            $fundations[]=array(
            	"id"=>$don['fun_id'], 
            	"name"=>$don['fun_name']);
        }
        return $fundations;
	}


	/*

	ICI LES FONCTIONS LIES AUX CATEGORIES

	*/

	/**
	* Ajoute une categorie
	*
	* @param string $nom
	* @param int $parent
	* @param int $fundation
	* @return int $categorie
	*/
	public function add_categorie($nom, $parent, $fundation) {
		// TODO CHECK RIGHT ADD CATEGORIE ON FUNDATION
		// TODO CHECK IF PARENT EXIST OR IF IT IS NULL
		$categorie_id = $this->db->insertId(
              $this->db->query(
                  "INSERT INTO t_object_obj (`obj_id`, `obj_name`, `obj_type`, `obj_stock`, `obj_single`, `img_id`, `fun_id`, `obj_removed`) 
                  VALUES (NULL, '%s', 'category', NULL, '0', NULL, '%u', '0');", 
                  array($nom, $fundation)));
		if($parent != NULL) {
			$this->db->query(
                  "INSERT INTO tj_object_link_oli (`oli_id`, `obj_id_parent`, `obj_id_child`, `oli_step`, `oli_removed`) VALUES (NULL, '%u', '%u', '0', '0');", 
                  array($parent, $categorie_id));
		}
		return $categorie_id;
	}	


	/**
	* Retourne les categories
	* 
	* 
	* @return array $categories
	*/
	public function get_categories() {
		// TODO : OBTENIR QUE LES CATEGORIES DES FONDATIONS SUR LES QUELS J'AI LES DROITS
		$categories = array();
		$res = $this->db->query("SELECT obj_id, obj_name, obj_id_parent, fun_id FROM t_object_obj LEFT JOIN tj_object_link_oli ON obj_id = obj_id_child WHERE obj_removed = '0' AND obj_type = 'category' ORDER BY obj_name;");
        while ($don = $this->db->fetchArray($res)) {
            $categories[]=array(
            	"id"=>$don['obj_id'], 
            	"name"=>$don['obj_name'],
            	"parent_id"=>$don['obj_id_parent'],
            	"fun_id"=>$don['fun_id']);
        }
        return $categories;
	}

	/**
	* Retourne la categorie $nb
	* 
	* @param int $nb
	* @return array $categories
	*/
	public function get_categorie($nb) {
		// TODO : OBTENIR QUE LES CATEGORIES DES FONDATIONS SUR LES QUELS J'AI LES DROITS
		$res = $this->db->query("SELECT obj_id, obj_name, obj_id_parent, fun_id FROM t_object_obj LEFT JOIN tj_object_link_oli ON obj_id = obj_id_child WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u' ORDER BY obj_name;", array($nb));
        if ($this->db->affectedRows() >= 1) {
        	$don = $this->db->fetchArray($res);
	        return array(
            	"id"=>$don['obj_id'], 
            	"name"=>$don['obj_name'],
            	"parent_id"=>$don['obj_id_parent'],
            	"fun_id"=>$don['fun_id']);
		} else {
			return 402;
		}
	}

	/*

	ICI LES FONCTIONS LIES AUX ARTICLES

	*/

	/**
	* Ajoute un article
	*
	* @param string $nom
	* @param int $stock
	* @param int $parent
	* @param int $prix
	* @return int $categorie
	*/
	public function add_article($nom, $stock, $parent, $prix) {
		// 1. GET THE PARENT
		$res = $this->db->query("SELECT fun_id FROM t_object_obj LEFT JOIN tj_object_link_oli ON obj_id = obj_id_child WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u' ORDER BY obj_name;", array($parent));
        if ($this->db->affectedRows() >= 1) {
        	$don = $this->db->fetchArray($res);
	        $fun_id=$don['fun_id'];
	        // TODO CHECK IF USER HAD THE RIGHT TO ADD ARTICLE ON THIS FUNDATION

	        // 2. AJOUT DE L'ARTICLE
	        // TODO : GERER QUAND LE STOCK EST A NULL ne pas mettre 0 mais NULL.
	        $article_id = $this->db->insertId(
              $this->db->query(
                  "INSERT INTO t_object_obj (`obj_id`, `obj_name`, `obj_type`, `obj_stock`, `obj_single`, `img_id`, `fun_id`, `obj_removed`) 
                  VALUES (NULL, '%s', 'product', '%u', '0', NULL, '%u', '0');", 
                  array($nom, $stock, $fun_id)));

	        // 3. CREATION DU LIEN SUR LE PARENT
			$this->db->query(
                  "INSERT INTO tj_object_link_oli (`oli_id`, `obj_id_parent`, `obj_id_child`, `oli_step`, `oli_removed`) VALUES (NULL, '%u', '%u', '0', '0');", 
                  array($parent, $article_id));

			// 4. AJOUT DU PRIX
			$this->db->query(
                  "INSERT INTO  t_price_pri (`pri_id`, `obj_id`, `grp_id`, `per_id`, `pri_credit`, `pri_removed`) VALUES ( NULL ,  '%u', NULL , NULL ,  '%u',  '0');", 
                  array($article_id, $prix));

			// ON RETOURNE L'ID D'ARTICLE
			return $article_id;


		} else {
			// LE PARENT N'EXISTE PAS
			return 402;
		}
	}	

	/**
	* Retourne les articles
	* 
	* @return array $articles
	*/
	public function get_articles() {
		$articles = array();
        $res = $this->db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, o.obj_stock, p.pri_credit
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child 
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id 
WHERE obj_removed = '0' AND obj_type = 'product' 
ORDER BY obj_name;", Array());
        while ($don = $this->db->fetchArray($res)) {
            $articles[]=array(
            	"id"=>$don['obj_id'], 
            	"name"=>$don['obj_name'], 
            	"parent_id"=>$don['obj_id_parent'],
            	"fun_id"=>$don['fun_id'],
            	"stock"=>$don['obj_stock'],
            	"price"=>$don['pri_credit']);
        }
        return $articles;
	}

	/**
	* Retourne un article
	* 
	* @param int $id
	* @return array $article
	*/
	public function get_article($id) {
		// TODO : OBTENIR QUE LES ARTICLES DES FONDATIONS SUR LES QUELS J'AI LES DROITS
        $res = $this->db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, o.obj_stock, p.pri_credit
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child 
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id 
WHERE obj_removed = '0' AND o.obj_type = 'product' AND o.obj_id = '%u'
ORDER BY obj_name;", Array($id));        if ($this->db->affectedRows() >= 1) {
        	$don = $this->db->fetchArray($res);
	        return array(
            	"id"=>$don['obj_id'], 
            	"name"=>$don['obj_name'], 
            	"parent_id"=>$don['obj_id_parent'],
            	"fun_id"=>$don['fun_id'],
            	"stock"=>$don['obj_stock'],
            	"price"=>$don['pri_credit']);
		} else {
			return 402;
		}
	}



}


$name_class = 'AADMIN';
require('inc/wsdl.inc.php');
?>
