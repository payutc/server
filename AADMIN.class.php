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
	* @return array $fundation
	*/
	public function add_fundation($nom) {
		// TODO CHECK RIGHT ADD A FUNDATION
		$fundation_id = $this->db->insertId(
              $this->db->query(
                  "INSERT INTO  t_fundation_fun (`fun_id` ,`fun_name` ,`fun_removed`)VALUES (NULL ,  '%s',  '0');", 
                  array($nom)));
		return array("success"=>$fundation_id);
	}	

	/**
	* Récuperer les fundations
	* 
	* @return array $fundations
	*/
	public function get_fundations() {
		// TODO CHECK RIGHT ON FUNDATIONS 
		$fundations = array();
		$res = $this->db->query("SELECT fun_id, fun_name FROM t_fundation_fun WHERE fun_removed = '0';");
        while ($don = $this->db->fetchArray($res)) {
            $fundations[]=array(
            	"id"=>$don['fun_id'], 
            	"name"=>$don['fun_name']);
        }
        return array("success"=>$fundations);
	}

	/**
	* Récuperer les fundations
	* 
	* @param int $id
	* @return array $fundation
	*/
	public function get_fundation($id) {
		// TODO CHECK RIGHT GET FUNDATION 
		$res = $this->db->query("SELECT fun_id, fun_name FROM t_fundation_fun WHERE fun_removed = '0' AND fun_id = '%u';", array($id));
        if ($this->db->affectedRows() >= 1) {
        	$don = $this->db->fetchArray($res);
	        return array("success" => 
	        	array(
            		"id"=>$don['fun_id'], 
            		"name"=>$don['fun_name'])
	        	);
        } else {
        	return array("error"=>421);
        }
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
	* @return array $categorie
	*/
	public function add_categorie($nom, $parent, $fundation) {
		// 1. CHECK THE PARENT (AND IF TRUE SELECT THE TRUTH FUNDATION)
		if($parent != null) {
			$res = $this->db->query("SELECT fun_id FROM t_object_obj WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u';", array($parent));
        	if ($this->db->affectedRows() >= 1) {
        		$don = $this->db->fetchArray($res);
	        	$fundation=$don['fun_id'];
	        } else {
	        	return array("error"=>400, "error_msg"=>"Le parent n'a pas été trouvé !");
	        }
		}

		// 2. TODO CHECK RIGHT TO ADD CATEGORIE IN THIS FUNDATION


		// 3. INSERTION DE LA CATEGORIE
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

		return array("success"=>$categorie_id);
	}	


	/**
	* Edite une categorie
	*
	* @param int $id
	* @param string $nom
	* @param int $parent
	* @return array $categorie
	*/
	public function edit_categorie($id, $nom, $parent) {
		// 1. GET THE CATEGORIE
		$res = $this->db->query("SELECT obj_id_parent, fun_id FROM t_object_obj LEFT JOIN tj_object_link_oli ON obj_id = obj_id_child WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u';", array($id));
        	if ($this->db->affectedRows() >= 1) {
        		$don = $this->db->fetchArray($res);
	        	$fundation=$don['fun_id'];
	        	$old_parent=$don['obj_id_parent'];
	        } else {
	        	return array("error"=>400, "error_msg"=>"La catégorie à modifier n'existe pas !");
	       }		


		// 2. TODO CHECK RIGHT TO EDIT CATEGORIE IN THIS FUNDATION

	    // 3. CHECK SI LE CHANGEMENT DE PARENT EST REALISABLE
	    if($old_parent != $parent)
	    {
	    	if($parent == $id) {
	    		return array("error"=>400, "error_msg"=>"Le parent ne peut pas être ta catégorie...");
	    	}
	    	$res = $this->db->query("SELECT fun_id FROM t_object_obj WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u';", array($parent));
        	if ($this->db->affectedRows() >= 1) {
        		$don = $this->db->fetchArray($res);
	        	$new_fundation=$don['fun_id'];
	        } else {
	        	return array("error"=>400, "error_msg"=>"Le nouveau parent n'a pas été trouvé !");
	        }
	        if($new_fundation != $fundation) {
	        	return array("error"=>400, "error_msg"=>"Impossible de mettre une catégorie dans une autre fundation...");
	        }
	    }

		// 4. EDIT THE PARENT IF NECESSARY
	    if($old_parent != $parent)
	    {
			return array("error"=>400, "error_msg"=>"Le changement de parent n'est pas encore codé !");
		}

	    // 5. EDIT THE CATEGORY
	    $this->db->query("UPDATE t_object_obj SET  `obj_name` =  '%s' WHERE  `obj_id` = '%u';",array($nom, $id));

		return array("success"=>$id);
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
            	"fundation_id"=>$don['fun_id']);
        }
        return array("success"=>$categories);
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
	        return array("success"=>array(
            	"id"=>$don['obj_id'], 
            	"name"=>$don['obj_name'],
            	"parent_id"=>$don['obj_id_parent'],
            	"fundation_id"=>$don['fun_id']));
		} else {
			return array("error"=>"Cette catégorie ($nb) n'existe pas.");
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
			return array("success"=>$article_id);


		} else {
			// LE PARENT N'EXISTE PAS
			return array("error"=>"Le parent demandé n'existe pas.");
		}
	}	

	/**
	* Edite un article
	*
	* @param int $id
	* @param string $nom
	* @param int $parent
	* @param int $prix
	* @param int $stock
	* @return array $categorie
	*/
	public function edit_article($id, $nom, $parent, $prix, $stock) {
		// 1. GET THE ARTICLE
		$res = $this->db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, p.pri_credit
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child 
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id  WHERE o.obj_removed = '0' AND o.obj_type = 'product' AND o.obj_id = '%u';", array($id));
        	if ($this->db->affectedRows() >= 1) {
        		$don = $this->db->fetchArray($res);
	        	$fundation=$don['fun_id'];
	        	$old_parent=$don['obj_id_parent'];
	        	$old_price=$don['pri_credit'];
	        } else {
	        	return array("error"=>400, "error_msg"=>"L'article à modifier n'existe pas !");
	       }		


		// 2. TODO CHECK RIGHT TO EDIT ARTICLE IN THIS FUNDATION

	    // 3. CHECK SI LE CHANGEMENT DE PARENT EST REALISABLE
	    if($old_parent != $parent)
	    {
	    	$res = $this->db->query("SELECT fun_id FROM t_object_obj WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u';", array($parent));
        	if ($this->db->affectedRows() >= 1) {
        		$don = $this->db->fetchArray($res);
	        	$new_fundation=$don['fun_id'];
	        } else {
	        	return array("error"=>400, "error_msg"=>"Le nouveau parent n'a pas été trouvé !");
	        }
	        if($new_fundation != $fundation) {
	        	return array("error"=>400, "error_msg"=>"Impossible de mettre un article dans une autre fundation...");
	        }
	    }

		// 4. EDIT THE PARENT IF NECESSARY
	    if($old_parent != $parent)
	    {
			return array("error"=>400, "error_msg"=>"Le changement de parent n'est pas encore codé !");
		}

		// 5. EDIT THE PRICE IF NECESSARY
		if($old_price != $prix)
		{
			return array("error"=>400, "error_msg"=>"Le changement de prix n'est pas encore codé !");
		}

	    // 6. EDIT THE ARTICLE NAME AND STOCK
	    $this->db->query("UPDATE t_object_obj SET  `obj_name` =  '%s', `obj_stock` = '%u' WHERE  `obj_id` = '%u';",array($nom, $stock, $id));

		return array("success"=>$id);
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
            	"fundation_id"=>$don['fun_id'],
            	"stock"=>$don['obj_stock'],
            	"price"=>$don['pri_credit']);
        }
        return array("success"=>$articles);
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
ORDER BY obj_name;", Array($id));
        if ($this->db->affectedRows() >= 1) {
        	$don = $this->db->fetchArray($res);
	        return array("success"=>array(
            	"id"=>$don['obj_id'], 
            	"name"=>$don['obj_name'], 
            	"parent_id"=>$don['obj_id_parent'],
            	"fundation_id"=>$don['fun_id'],
            	"stock"=>$don['obj_stock'],
            	"price"=>$don['pri_credit']));
		} else {
			return array("error"=>"Cet article ($id) n'existe pas.");
		}
	}



}


$name_class = 'AADMIN';
require('inc/wsdl.inc.php');
?>
