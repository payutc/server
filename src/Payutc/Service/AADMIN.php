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

namespace Payutc\Service;

use \Cas;
use \Payutc\Bom\User;
use \Image;
use \ComplexData;
use \Payutc\Db\DbBuckutt;
use \PlageHoraire;

/**
 * AAdmin.class
 *
 * Classe permettant de tout administrer
 * @author BuckUTT <buckutt@utt.fr>, payutc <payutc@assos.utc.fr>
 * @version 3.0
 * @package buckutt
 */

class AADMIN {

    // C'est moche mais AADMIN sera dans très peu de temps DEPRECATED...
	static $right_admin = array(1, 2);
	static $right_fundation = array(2, 4, 5, 6);
	static $right_fundation_name = array("ADMIN", "GESARTICLE", "VENDRE", "TRESO");
	static $right_name_to_id = array("ADMIN"=>2, "GESARTICLE"=>6, "VENDRE"=>5, "TRESO"=>4, "POI-FUNDATION"=>7);
	static $right_id_to_name = array(2=>"ADMIN", 6=>"GESARTICLE", 5=>"VENDRE", 4=>"TRESO", 7=>"POI-FUNDATION");

	protected $db;
	protected $user;

	/**
	 * Constructeur.
	 */
	public function __construct() {
		$this->db = DbBuckutt::getInstance();
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


	/**
	 * Connecter le user avec un ticket CAS.
	 *
	 * @param String $ticket
	 * @param String $service
	 * @return int $state
	 */
    public function loginCas($ticket, $service) {
        try {
            $this->user = User::getUserFromCas($ticket, $service);
        }
        catch(\Exception $ex){
            return -1;
        }

		return 1;
    }

	/**
	* Récupérer un id d'utilisateur à partir d'un login
	*
	* @param string $login
	* @return array $return
	*/
	public function getUserIDfromLogin($login) {
		$idUser = $this->db->result($this->db->query("SELECT usr_id FROM tj_usr_mol_jum WHERE jum_data='%s' AND mol_id='%u';", Array($login, 1)),0);
		if ($this->db->affectedRows() == 1) {
			return array("success"=>$idUser);
		} else {
			return array("error"=>400, "error_msg"=>"Le login $login n'a donné aucun resultat.");
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
	* Récuperer les fundations (ne nécessite pas de droit)
	*
	* @return array $fundations
	*/
	public function get_fundations() {
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
	* Récuperer une fundation (ne nécessite pas de droit)
	*
	* @param int $id
	* @return array $fundation
	*/
	public function get_fundation($id) {
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

	/**
	* Récuperer les fundations ou j'ai le droit de faire...
	*
	* @param string $right
	* @return array $fundation
	*/
	public function get_fundations_with_right($right) {
        $right_fundation_name = AADMIN::$right_fundation_name;
        $right_name_to_id = AADMIN::$right_name_to_id;

		$fundations = array();

		if(in_array($right, $right_fundation_name)) {
			$res = $this->db->query("SELECT f.fun_id, f.fun_name
					FROM t_fundation_fun f, tj_usr_rig_jur r
					WHERE f.fun_id = r.fun_id AND r.usr_id = '%u' AND rig_id = '%u' GROUP BY f.fun_id, f.fun_name;", array($this->user->getId(), $right_name_to_id[$right]));
		} else {
			return array("error"=>400, "error_msg"=>"Le droit demandé n'a pas été reconnu.");
		}

        while ($don = $this->db->fetchArray($res)) {
            $fundations[]=array(
            	"id"=>$don['fun_id'],
            	"name"=>$don['fun_name']);
        }
        return array("success"=>$fundations);
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
		$right_name_to_id = AADMIN::$right_name_to_id;

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

		// 2. CHECK RIGHT TO ADD CATEGORIE IN THIS FUNDATION
		$res = $this->db->query("SELECT f.fun_id, f.fun_name
					FROM t_fundation_fun f, tj_usr_rig_jur r
					WHERE f.fun_id = r.fun_id AND r.usr_id = '%u' AND rig_id = '%u' AND f.fun_id = '%u';", array($this->user->getId(), $right_name_to_id["GESARTICLE"], $fundation));
		if ($this->db->affectedRows() == 0) {
	        return array("error"=>400, "error_msg"=>"Tu ne sembles pas avoir les droits pour ajouter une catégorie dans cette fundation !");
	    }


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
		$right_name_to_id = AADMIN::$right_name_to_id;
		// 1. GET THE CATEGORIE
		$res = $this->db->query("SELECT obj_id_parent, fun_id, oli_id FROM t_object_obj LEFT JOIN tj_object_link_oli ON obj_id = obj_id_child WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u';", array($id));
        	if ($this->db->affectedRows() >= 1) {
        		$don = $this->db->fetchArray($res);
	        	$fundation=$don['fun_id'];
	        	$old_parent=$don['obj_id_parent'];
	        	$oli_id=$don['oli_id'];
	        } else {
	        	return array("error"=>400, "error_msg"=>"La catégorie à modifier n'existe pas !");
	       }


		// 2. CHECK RIGHT TO EDIT CATEGORIE IN THIS FUNDATION
		$res = $this->db->query("SELECT f.fun_id, f.fun_name
					FROM t_fundation_fun f, tj_usr_rig_jur r
					WHERE f.fun_id = r.fun_id AND r.usr_id = '%u' AND rig_id = '%u' AND f.fun_id = '%u';", array($this->user->getId(), $right_name_to_id["GESARTICLE"], $fundation));
		if ($this->db->affectedRows() == 0) {
	        return array("error"=>400, "error_msg"=>"Tu ne sembles pas avoir les droits pour éditer une catégorie dans cette fundation !");
	    }

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
	    	$this->db->query("UPDATE tj_object_link_oli SET  `obj_id_parent` =  '%u' WHERE  `oli_id` = '%u';",array($parent, $oli_id));
		}

	    // 5. EDIT THE CATEGORY
	    $this->db->query("UPDATE t_object_obj SET  `obj_name` =  '%s' WHERE  `obj_id` = '%u';",array($nom, $id));

		return array("success"=>$id);
	}

	/**
	* Supprime une categorie
	*
	* @param int $id
	* @return array $result
	*/
	public function delete_categorie($id) {
		$right_name_to_id = AADMIN::$right_name_to_id;
		// 1. GET THE ARTICLE
		$res = $this->db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, p.pri_credit
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id  WHERE o.obj_removed = '0' AND o.obj_type = 'category' AND o.obj_id = '%u';", array($id));
        	if ($this->db->affectedRows() >= 1) {
        		$don = $this->db->fetchArray($res);
	        	$fundation=$don['fun_id'];
	        } else {
	        	return array("error"=>400, "error_msg"=>"La categorie à supprimer n'existe pas !");
	       }

		// 2. CHECK RIGHT "GESARTICLE" IN THIS FUNDATION
		$res = $this->db->query("SELECT f.fun_id, f.fun_name
					FROM t_fundation_fun f, tj_usr_rig_jur r
					WHERE f.fun_id = r.fun_id AND r.usr_id = '%u' AND rig_id = '%u' AND f.fun_id = '%u';", array($this->user->getId(), $right_name_to_id["GESARTICLE"], $fundation));
		if ($this->db->affectedRows() == 0) {
	        return array("error"=>400, "error_msg"=>"Tu ne sembles pas avoir les droits pour supprimer une catégorie dans cette fundation !");
	    }

	    // 3. CHECK THERE IS NO CHILDREN
		$res = $this->db->query("SELECT o.obj_id
FROM t_object_obj o, tj_object_link_oli WHERE o.obj_id = obj_id_child
AND o.obj_removed = '0' AND obj_id_parent = '%u';", array($id));
        	if ($this->db->affectedRows() >= 1) {
	        	return array("error"=>400, "error_msg"=>"La categorie à encore des enfants!");
	       }


	    // 4. REMOVE THE CATEGORY
	    $this->db->query("UPDATE t_object_obj SET  `obj_removed` = '1' WHERE  `obj_id` = '%u';",array($id));

		return array("success"=>"ok");
	}

	/**
	* Retourne les categories
	*
	*
	* @return array $categories
	*/
	public function get_categories() {
		$right_name_to_id = AADMIN::$right_name_to_id;
		// OBTENIR QUE LES CATEGORIES DES FONDATIONS SUR LES QUELS J'AI LES DROITS
		$categories = array();
		$res = $this->db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id
FROM tj_usr_rig_jur tj, t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child
WHERE
tj.fun_id = o.fun_id
AND obj_removed = '0'
AND obj_type = 'category'
AND tj.rig_id = '%u'
AND usr_id = '%u'
ORDER BY obj_name;", array($right_name_to_id["GESARTICLE"] ,$this->user->getId()));
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
	* Retourne les categories d'un fundation
	*
	* @param int $fun_id
	* @param int $onlyFirstLevel
	* @return array $categories
	*/
	public function get_categories_by_fundation_id($fun_id, $onlyFirstLevel) {
		$right_name_to_id = AADMIN::$right_name_to_id;
		$categories = array();
		$level="";
		if($onlyFirstLevel == 1) { $level = "AND oli.obj_id_parent IS NULL "; }
		$res = $this->db->query("SELECT o.obj_id, o.obj_name, oli.obj_id_parent, o.fun_id
FROM tj_usr_rig_jur tj, t_object_obj o
LEFT JOIN tj_object_link_oli oli ON o.obj_id = obj_id_child
WHERE
tj.fun_id = o.fun_id
AND obj_removed = '0'
AND obj_type = 'category'
AND tj.rig_id = '%u'
AND usr_id = '%u'
AND o.fun_id = '%u'
$level
ORDER BY obj_name;", array($right_name_to_id["GESARTICLE"] ,$this->user->getId(), $fun_id));
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
		$right_name_to_id = AADMIN::$right_name_to_id;
		// OBTENIR QUE LES CATEGORIES DES FONDATIONS SUR LES QUELS J'AI LES DROITS
$res = $this->db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id
FROM tj_usr_rig_jur tj, t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child
WHERE
tj.fun_id = o.fun_id
AND obj_removed = '0'
AND obj_type = 'category'
AND tj.rig_id = '%u'
AND usr_id = '%u'
AND o.obj_id = '%u';", array($right_name_to_id["GESARTICLE"] ,$this->user->getId(), $nb));
        if ($this->db->affectedRows() >= 1) {
        	$don = $this->db->fetchArray($res);
	        return array("success"=>array(
            	"id"=>$don['obj_id'],
            	"name"=>$don['obj_name'],
            	"parent_id"=>$don['obj_id_parent'],
            	"fundation_id"=>$don['fun_id']));
		} else {
			return array("error"=>400, "error_msg"=>"Cette catégorie ($nb) n'existe pas, ou vous n'avez pas les droits dessus.");
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
	* @param int $image
	* @return array $categorie
	*/
	public function add_article($nom, $parent, $prix, $stock, $alcool, $image = 0) {
		$right_name_to_id = AADMIN::$right_name_to_id;
		// 1. GET THE PARENT
		$res = $this->db->query("SELECT fun_id FROM t_object_obj LEFT JOIN tj_object_link_oli ON obj_id = obj_id_child WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u' ORDER BY obj_name;", array($parent));
        if ($this->db->affectedRows() >= 1) {
        	$don = $this->db->fetchArray($res);
	        $fun_id=$don['fun_id'];

	        // CHECK IF USER HAD THE RIGHT TO ADD ARTICLE ON THIS FUNDATION
			$res = $this->db->query("SELECT f.fun_id, f.fun_name
						FROM t_fundation_fun f, tj_usr_rig_jur r
						WHERE f.fun_id = r.fun_id AND r.usr_id = '%u' AND rig_id = '%u' AND f.fun_id = '%u';", array($this->user->getId(), $right_name_to_id["GESARTICLE"], $fun_id));
			if ($this->db->affectedRows() == 0) {
		        return array("error"=>400, "error_msg"=>"Tu ne sembles pas avoir les droits pour ajouter un article dans cette fundation !");
		    }

	        // 2. AJOUT DE L'ARTICLE
	        // TODO : GERER QUAND LE STOCK EST A NULL ne pas mettre 0 mais NULL.
          $image = intval($image);
          if(empty($image)){
            $image = "NULL";
          }

	        $article_id = $this->db->insertId(
              $this->db->query(
                  "INSERT INTO t_object_obj (`obj_id`, `obj_name`, `obj_type`, `obj_stock`, `obj_single`, `img_id`, `fun_id`, `obj_removed`, `obj_alcool`)
                  VALUES (NULL, '%s', 'product', '%d', '0',  %s, '%u', '0', '%u');",
                  array($nom, $stock, $image, $fun_id, $alcool)));

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
	* @param int $image 0 pour conserver la valeur actuelle, -1 pour la supprimer, id dans la table image sinon
	* @return array $categorie
	*/
	public function edit_article($id, $nom, $parent, $prix, $stock, $alcool, $image = 0) {
		$right_name_to_id = AADMIN::$right_name_to_id;
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


		// 2. CHECK RIGHT TO EDIT ARTICLE IN THIS FUNDATION
		$res = $this->db->query("SELECT f.fun_id, f.fun_name
					FROM t_fundation_fun f, tj_usr_rig_jur r
					WHERE f.fun_id = r.fun_id AND r.usr_id = '%u' AND rig_id = '%u' AND f.fun_id = '%u';", array($this->user->getId(), $right_name_to_id["GESARTICLE"], $fundation));
		if ($this->db->affectedRows() == 0) {
	        return array("error"=>400, "error_msg"=>"Tu ne sembles pas avoir les droits pour editer un article dans cette fundation !");
	    }

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
			return array("error"=>400, "error_msg"=>"Le changement de prix n'est pas encore codé ! $old_price => $prix");
		}

	    // 6. EDIT THE ARTICLE NAME AND STOCK
        $image = intval($image);
        if($image == 0) {
          $image = "`img_id`";
        } else if ($image == -1) {
          $image = "NULL";
        }
        $this->db->query("UPDATE t_object_obj SET  `obj_name` =  '%s', `obj_stock` = '%d', `obj_alcool` = '%u', `img_id` = %s WHERE `obj_id` = '%u';",array($nom, $stock, $alcool, $image, $id));

		return array("success"=>$id);
	}

	/**
	* Supprime un article
	*
	* @param int $id
	* @return array $result
	*/
	public function delete_article($id) {
		$right_name_to_id = AADMIN::$right_name_to_id;
		// 1. GET THE ARTICLE
		$res = $this->db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, p.pri_credit
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id  WHERE o.obj_removed = '0' AND o.obj_type = 'product' AND o.obj_id = '%u';", array($id));
        	if ($this->db->affectedRows() >= 1) {
        		$don = $this->db->fetchArray($res);
	        	$fundation=$don['fun_id'];
	        } else {
	        	return array("error"=>400, "error_msg"=>"L'article à supprimer n'existe pas !");
	       }

		// 2. CHECK RIGHT TO DELETE ARTICLE IN THIS FUNDATION
		$res = $this->db->query("SELECT f.fun_id, f.fun_name
					FROM t_fundation_fun f, tj_usr_rig_jur r
					WHERE f.fun_id = r.fun_id AND r.usr_id = '%u' AND rig_id = '%u' AND f.fun_id = '%u';", array($this->user->getId(), $right_name_to_id["GESARTICLE"], $fundation));
		if ($this->db->affectedRows() == 0) {
	        return array("error"=>400, "error_msg"=>"Tu ne sembles pas avoir les droits pour supprimer un article dans cette fundation !");
	    }

	    // 3. REMOVE THE ARTICLE
	    $this->db->query("UPDATE t_object_obj SET  `obj_removed` = '1' WHERE  `obj_id` = '%u';",array($id));

		return array("success"=>"ok");
	}

	/**
	* Retourne les articles
	*
	* @return array $articles
	*/
	public function get_articles() {
		$right_name_to_id = AADMIN::$right_name_to_id;
		// OBTENIR QUE LES ARTICLES DES FONDATIONS SUR LES QUELS J'AI LES DROITS
		$articles = array();
		$res = $this->db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, o.obj_stock, o.obj_alcool, p.pri_credit
FROM tj_usr_rig_jur tj, t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id
WHERE
tj.fun_id = o.fun_id
AND obj_removed = '0'
AND obj_type = 'product'
AND tj.rig_id = '%u'
AND usr_id = '%u'
ORDER BY obj_name;", array($right_name_to_id["GESARTICLE"] ,$this->user->getId()));
        while ($don = $this->db->fetchArray($res)) {
            $articles[]=array(
            	"id"=>$don['obj_id'],
            	"name"=>$don['obj_name'],
            	"categorie_id"=>$don['obj_id_parent'],
            	"fundation_id"=>$don['fun_id'],
            	"stock"=>$don['obj_stock'],
            	"price"=>$don['pri_credit'],
            	"alcool"=>$don['obj_alcool']);
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
		$right_name_to_id = AADMIN::$right_name_to_id;
		// OBTENIR QUE LES ARTICLES DES FONDATIONS SUR LES QUELS J'AI LES DROITS
        $res = $this->db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, o.obj_stock, o.obj_alcool, p.pri_credit, o.img_id
FROM tj_usr_rig_jur tj, t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id
WHERE tj.fun_id = o.fun_id
AND obj_removed = '0'
AND o.obj_type = 'product'
AND o.obj_id = '%u'
AND tj.rig_id = '%u'
AND usr_id = '%u'
ORDER BY obj_name;", Array($id, $right_name_to_id["GESARTICLE"], $this->user->getId()));
        if ($this->db->affectedRows() >= 1) {
        	$don = $this->db->fetchArray($res);
	        return array("success"=>array(
            	"id"=>$don['obj_id'],
            	"name"=>$don['obj_name'],
            	"categorie_id"=>$don['obj_id_parent'],
            	"fundation_id"=>$don['fun_id'],
            	"stock"=>$don['obj_stock'],
            	"price"=>$don['pri_credit'],
            	"alcool"=>$don['obj_alcool'],
            	"image"=>$don['img_id']));
		} else {
			return array("error"=>400, "error_msg"=>"Cet article ($id) n'existe pas, ou vous n'avez pas les droits dessus.");
		}
	}


	/*
	ICI LES FONCTIONS LIES AUX DROITS
	*/

	/**
	* Donner un droit liant un user à une fundation.
	*
	* @param int $user_id
	* @param string $right
	* @param int $fun_id
	* @return array $result
	*/
	public function set_right_fundation($user_id, $right, $fun_id){
        $right_fundation_name = AADMIN::$right_fundation_name;
        $right_name_to_id = AADMIN::$right_name_to_id;
		// 1. CHECK THE RIGHT CAN BE GIVEN BY THIS FUNCTION
		if(!in_array($right, $right_fundation_name)) {
		    return array("error"=>400, "error_msg"=>"Vous ne pouvez pas donner ce type de droit avec cette fonction.");
		}
		$right_id = $right_name_to_id[$right];

		// 2. CHECK USER IS ADMIN-FUNDATION OR ADMIN-PAYUTC
		$res = $this->db->query("SELECT jur_id FROM tj_usr_rig_jur WHERE usr_id = '%u' AND (rig_id = '1' OR (rig_id = '2' AND fun_id = '%u'));", array($this->user->getId(), $fun_id));
    	if ($this->db->affectedRows() == 0) {
        	return array("error"=>400, "error_msg"=>"Vous n'avez pas le droit de donner ce droit.");
        }

        // 3. TODO :: VERIFIER QUE L'USER EXISTE ? (Si la DB check les foreign key, y'a pas besoin de le faire ici...)

        // 4. Puisqu'on a le droit donnons le droit ^^
		$jur_id = $this->db->insertId(
              $this->db->query(
                  "INSERT INTO tj_usr_rig_jur (`jur_id`, `usr_id`, `rig_id`, `per_id`, `fun_id`, `poi_id`, `jur_removed`)
                  VALUES (NULL, '%u', '%u', NULL, '%u', NULL, '0');",
                  array($user_id, $right_id, $fun_id)));

		return array("success"=>$jur_id);
	}

	/**
	* Supprimer un droit
	*
	* @param int $user_id
	* @param string $right
	* @param int $fun_id
	* @return array $result
	*/
	public function remove_right_fundation($user_id, $right, $fun_id){
		$right_fundation_name = AADMIN::$right_fundation_name;
        $right_name_to_id = AADMIN::$right_name_to_id;
		// 1. CHECK THE RIGHT CAN BE REMOVED BY THIS FUNCTION
		if(!in_array($right, $right_fundation_name)) {
		    return array("error"=>400, "error_msg"=>"Vous ne pouvez pas retirer ce type de droit avec cette fonction.");
		}

		$right_id = $right_name_to_id[$right];
		// 2. CHECK USER IS ADMIN-FUNDATION OR ADMIN-PAYUTC
		$res = $this->db->query("SELECT jur_id FROM tj_usr_rig_jur WHERE usr_id = '%u' AND (rig_id = '1' OR (rig_id = '2' AND fun_id = '%u'));", array($this->user->getId(), $fun_id));
    	if ($this->db->affectedRows() == 0) {
        	return array("error"=>400, "error_msg"=>"Vous n'avez pas le droit de retirer ce droit.");
        }

        // 4. Puisqu'on a le droit retirons le droit ^^
		$jur_id = $this->db->insertId(
              $this->db->query(
                  "DELETE FROM tj_usr_rig_jur WHERE `usr_id` = '%u' AND `rig_id` = '%u' AND `fun_id` = '%u';",
                  array($user_id, $right_id, $fun_id)));

		return array("success"=>"deleted");
	}

	/**
	* Récupérer les droits sur une fundation donné
	*
	* @param int $fun_id
	* @return array $result
	*/
	public function get_rights_fundation($fun_id){
        $right_fundation_name = AADMIN::$right_fundation_name;
        $right_name_to_id = AADMIN::$right_name_to_id;
        $right_id_to_name = AADMIN::$right_id_to_name;
		// 1. CHECK USER IS ADMIN-FUNDATION OR ADMIN-PAYUTC
		$res = $this->db->query("SELECT jur_id FROM tj_usr_rig_jur WHERE usr_id = '%u' AND (rig_id = '1' OR (rig_id = '2' AND fun_id = '%u'));", array($this->user->getId(), $fun_id));
    	if ($this->db->affectedRows() == 0) {
        	return array("error"=>400, "error_msg"=>"Vous n'avez pas le droit de demander ça.");
        }

        // 2. Puisqu'on a le droit, au travail
		$rights = array();
        $res = $this->db->query("SELECT u.usr_id, u.usr_firstname, u.usr_lastname, u.usr_nickname, j.rig_id, j.fun_id
FROM tj_usr_rig_jur j, ts_user_usr u
WHERE j.usr_id=u.usr_id AND fun_id = '%u' AND j.usr_id IS NOT NULL ORDER BY j.rig_id;", Array($fun_id));
        while ($don = $this->db->fetchArray($res)) {
            $rights[]=array(
            	"usr_id"=>$don['usr_id'],
            	"usr_firstname"=>$don['usr_firstname'],
            	"usr_lastname"=>$don['usr_lastname'],
            	"usr_login"=>$don['usr_nickname'],
            	"rig_id"=>$right_id_to_name[$don['rig_id']]);
        }
        return array("success"=>$rights);
	}

	/*
	ICI LES FONCTIONS LIES AUX POIS
	*/

	/**
	* Obtenir les pois d'une fundation
	* @param int $fun_id
	* @return array $result
	*/
	public function get_pois_fundation($fun_id)
	{
        $right_fundation_name = AADMIN::$right_fundation_name;
        $right_name_to_id = AADMIN::$right_name_to_id;
        $right_id_to_name = AADMIN::$right_id_to_name;

        $pois = array();
        $res = $this->db->query("SELECT poi.poi_id, poi.poi_name
FROM t_point_poi poi, tj_usr_rig_jur jur
WHERE poi.poi_id = jur.poi_id AND fun_id = '%u' AND poi_removed = '0' AND jur.rig_id = '%u' ORDER BY poi_name;", Array($fun_id, $right_name_to_id["POI-FUNDATION"]));
        while ($don = $this->db->fetchArray($res)) {
            $pois[]=array(
                "id"=>$don['poi_id'],
                "name"=>$don['poi_name']);
        }
        return array("success"=>$pois);
	}

	/*
	ICI LES FONCTIONS LIES AUX PLAGE HORAIRE
	*/

	/**
	* Ajouter une plage horaire
	*
	* @param int $time_start
	* @param int $time_end
	* @param int $poi_id
	* @param int $fun_id
	* @param string $name
	* @return array $result
	*/
	public function add_plage_horaire($time_start, $time_end, $poi_id, $fun_id, $name)
	{
		$plage = new PlageHoraire($this->user, null, $time_start, $time_end, $poi_id, $fun_id, $name);
		return $plage->insert();
	}

	/**
	* Edite une plage horaire
	*
	* @param int $time_start
	* @param int $time_end
	* @param string $name
	* @return array $result
	*/
	// TODO V0.2 ou V0.3 ...
	/*public function edit_plage_horaire($id, $time_start, $time_end, $name)
	{
		$plage = new PlageHoraire($this->user, $id, $time_start, $time_end, NULL, NULL, $name);
		return $plage->edit();
	}*/

	/**
	* Supprime une plage horaire
	* @param int $id
	* @return array $result
	*/
	public function rm_plage_horaire($id)
	{
		$plage = new PlageHoraire($this->user, $id, NULL, NULL, NULL, NULL, NULL);
		return $plage->rm();
	}


	/**
	* Obtenir les plages horaires d'une fundation
	* @param int $fun_id
	* @return array $result
	*/
	public function get_plages_horaire_fundation($fun_id)
	{
		$plage = new PlageHoraire($this->user, NULL, NULL, NULL, NULL, NULL, NULL);
		return $plage->get_all_fundation($fun_id);
	}

	/**
	* Retourne pour chaque jour de chaque mois chaque produit avec
	* l'argent qu'il a rapporté, sa catégorie, sa fondation etc...
	*
	* @return array $data
	*/
	public function get_CA_period($day, $month, $year, $day2, $month2, $year2, $fundation_id) {
        $right_fundation_name = AADMIN::$right_fundation_name;
        $right_name_to_id = AADMIN::$right_name_to_id;
        $right_id_to_name = AADMIN::$right_id_to_name;

		// 2. CHECK RIGHT TO TRESO for this particular fundation
		$res = $this->db->query("SELECT f.fun_id, f.fun_name
					FROM t_fundation_fun f, tj_usr_rig_jur r
					WHERE f.fun_id = r.fun_id 
					AND r.usr_id = '%u' 
					AND rig_id = '%u' 
					AND f.fun_id = '%u';", 
					array($this->user->getId(), $right_name_to_id["TRESO"], $fundation_id));
		
		if ($this->db->affectedRows() == 0) {
	        return array("error"=>400, 
	        			 "error_msg"=>"Tu ne sembles pas avoir les droits pour regarder la trésorerie pour cette fondation !");
	    }

		$query = "
		SELECT t.obj_id,
			   o.obj_name, parent.obj_name as categorie,
			   o.obj_removed as objet_deleted, COUNT(*) as nombre,
			   SUM(pur_price) as montant_total, fun.fun_name,

			   DAY(pur_date) as jour,
			   MONTH(pur_date) as mois,
			   WEEK(pur_date) as semaine,
			   YEAR(pur_date) as annee

		FROM t_purchase_pur t, t_object_obj o, t_object_obj parent, tj_object_link_oli link, t_fundation_fun fun
		WHERE t.obj_id = o.obj_id
		AND fun.fun_id = t.fun_id
		AND link.obj_id_child = o.obj_id
		AND link.obj_id_parent = parent.obj_id
		AND link.oli_removed = 0
		AND pur_removed = 0
		AND DATE(pur_date) BETWEEN '%u-%u-%u' AND '%u-%u-%u'
		AND t.fun_id = %u
		GROUP BY obj_id
		ORDER BY fun_name, mois, jour ASC";

        $pois = Array();
        $res = $this->db->query($query, Array($year, $month, $day, $year2, $month2, $day2, $fundation_id));
        while ($don = $this->db->fetchArray($res)) {
            $pois[]=$don;
        }

        return array("success"=>$pois);
	}

	/**
	* Retourne pour chaque jour de chaque mois chaque produit avec
	* l'argent qu'il a rapporté, sa catégorie, sa fondation etc...
	*
	* @return array $data
	*/
	public function get_CA($day, $month, $year, $fundation_id) {
		return $this->get_CA_period($day, $month, $year, $day, $month, $year, $fundation_id);
	}
  
	/**
	* Ajouter l'image d'un article
	*
	* @param string $image
	* @return int $result
	*/
  public function uploadImage($image){
    $oldgd = imagecreatefromstring(base64_decode($image));
    
    ob_start();
    imagepng($oldgd);
    $imagedata = ob_get_contents();
    ob_end_clean();
    
    $img = new Image(0, "image/png", imagesx($oldgd), imagesy($oldgd), $imagedata);
    
    if($img->getState() != 1){
      return $img->getState();
    }
    
    return $img->getId();
  }

}

