<?php

/**
 * 
 * Gestion des articles
 * Table: t_object_obj | obj_type = 'product'
 */

namespace Payutc\Bom;
use \Db_buckutt;

class Product {

    /*
     * Transforme un fetchArray de la db, en quelque chose de potable
     */
    private static function fromDbArray($don) {
        return array(
            "id"=>$don['obj_id'],
            "name"=>$don['obj_name'],
            "categorie_id"=>$don['obj_id_parent'],
            "fundation_id"=>$don['fun_id'],
            "stock"=>$don['obj_stock'],
            "price"=>$don['pri_credit'],
            "alcool"=>$don['obj_alcool'],
            "image"=>$don['img_id']
        );
    } 

    /*
     * Retourne tous les produits
     */
    public static function getAll($fun_ids=null) {
        if(is_array($fun_ids)) {
            $fun_req = "AND o.fun_id IN (";
            foreach($fun_ids as $fun_id) {
                $fun_req .= "'%u', ";
            }
            $fun_req = substr($fun_req, 0, -2) . ")";
            $param = $fun_ids;
        } else {
            $fun_req = "";
            $param = array();
        }

        $query = "SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, o.obj_stock, o.obj_alcool, p.pri_credit, o.img_id
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id
WHERE
obj_removed = '0'
AND obj_type = 'product'
$fun_req
ORDER BY obj_name;";

		$res = Db_buckutt::getInstance()->query($query, $param);

        // Construction du resultat.
		$products = array();
        while ($don = Db_buckutt::getInstance()->fetchArray($res)) {
            $products[] = static::fromDbArray($don);
        }
        return $products;
    }


    public static function getOne($obj_id, $fun_id=null) {

		// OBTENIR QUE LES ARTICLES DES FONDATIONS SUR LES QUELS J'AI LES DROITS
        $res = Db_buckutt::getInstance()->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, o.obj_stock, o.obj_alcool, p.pri_credit, o.img_id
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id
WHERE
obj_removed = '0'
AND o.obj_type = 'product'
AND o.obj_id = '%u'
AND o.fun_id = '%u'
ORDER BY obj_name;", array($obj_id, $fun_id));
        if (Db_buckutt::getInstance()->affectedRows() >= 1) {
        	$don = Db_buckutt::getInstance()->fetchArray($res);
	        return array("success" => static::fromDbArray($don));
		} else {
			return array("error"=>400, "error_msg"=>"Cet article ($obj_id, $fun_id) n'existe pas, ou vous n'avez pas les droits dessus.");
		}
    }

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
	public static function add($nom, $parent, $prix, $stock, $alcool, $image, $fun_id) {
        $db = Db_buckutt::getInstance();
		// 1. Verification que le parent existe (et qu'il est bien dans la fundation indiqué (vu qu'on a vérifié les droits grâce à ça)
		$res = $db->query("SELECT fun_id FROM t_object_obj LEFT JOIN tj_object_link_oli ON obj_id = obj_id_child WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u' AND fun_id = '%u' LIMIT 0,1;", array($parent, $fun_id));
        if ($db->affectedRows() >= 1) {
            $don = $db->fetchArray($res);

            // 2. AJOUT DE L'ARTICLE
            $image = intval($image);
            if(empty($image)){
                $image = "NULL";
            }

            $article_id = $db->insertId(
              $db->query(
                  "INSERT INTO t_object_obj (`obj_id`, `obj_name`, `obj_type`, `obj_stock`, `obj_single`, `img_id`, `fun_id`, `obj_removed`, `obj_alcool`)
                  VALUES (NULL, '%s', 'product', '%d', '0',  %s, '%u', '0', '%u');",
                  array($nom, $stock, $image, $fun_id, $alcool)));

            // 3. CREATION DU LIEN SUR LE PARENT
            $db->query(
                  "INSERT INTO tj_object_link_oli (`oli_id`, `obj_id_parent`, `obj_id_child`, `oli_step`, `oli_removed`) VALUES (NULL, '%u', '%u', '0', '0');",
                  array($parent, $article_id));

            // 4. AJOUT DU PRIX
            $db->query(
                  "INSERT INTO t_price_pri (`pri_id`, `obj_id`, `grp_id`, `per_id`, `pri_credit`, `pri_removed`) VALUES ( NULL ,  '%u', NULL , NULL ,  '%u',  '0');",
                  array($article_id, $prix));

            // ON RETOURNE L'ID D'ARTICLE
            return array("success"=>$article_id);

		} else {
			// LE PARENT N'EXISTE PAS
			return array("error"=>"Le parent demandé ($parent, $fun_id) n'existe pas. (Ou tu n'as pas les droits nécessaires)");
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
	public static function edit($id, $nom, $parent, $prix, $stock, $alcool, $image, $fun_id) {
        $db = Db_buckutt::getInstance();
        // 1. GET THE ARTICLE
        $res = $db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, p.pri_credit, o.img_id, oli_id
        FROM t_object_obj o
        LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child
        LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id  WHERE o.obj_removed = '0' AND o.obj_type = 'product' AND o.obj_id = '%u' AND o.fun_id = '%u';", array($id, $fun_id));
        if ($db->affectedRows() >= 1) {
            $don = $db->fetchArray($res);
            $fundation=$don['fun_id'];
            $old_parent=$don['obj_id_parent'];
            $old_price=$don['pri_credit'];
            $old_img_id=$don['img_id'];
            $oli_id=$don['oli_id'];
        } else {
            return array("error"=>400, "error_msg"=>"L'article à modifier n'existe pas ! (Ou vous n'en avez pas les droits)");
        }

        // 2. Remove old image si necessaire
        $image = intval($image);
        if($image != 0 and $old_img_id != null and $old_img_id != $image) {
            \Image::remove($old_img_id);
        }

        // 3. CHECK SI LE CHANGEMENT DE PARENT EST REALISABLE
        if($old_parent != $parent)
        {
	        $res = $db->query("SELECT fun_id FROM t_object_obj WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u';", array($parent));
	        if ($db->affectedRows() >= 1) {
		        $don = $db->fetchArray($res);
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
            if($old_parent != null and $parent != null) {
	    	    $db->query("UPDATE tj_object_link_oli SET  `obj_id_parent` =  '%u' WHERE  `oli_id` = '%u';",array($parent, $oli_id));
            } else if($old_parent == null and $parent != null) {
                $db->query(
                  "INSERT INTO tj_object_link_oli (`oli_id`, `obj_id_parent`, `obj_id_child`, `oli_step`, `oli_removed`) VALUES (NULL, '%u', '%u', '0', '0');",
                  array($parent, $id));
            } else {
                $db->query("UPDATE tj_object_link_oli SET  `oli_removed` =  '1' WHERE  `oli_id` = '%u';",array($oli_id));
            }
		}

        // 5. EDIT THE PRICE IF NECESSARY
        if($old_price != $prix)
        {
	        return array("error"=>400, "error_msg"=>"Le changement de prix n'est pas encore codé ! $old_price => $prix");
        }

        // 6. EDIT THE ARTICLE NAME AND STOCK
        if($image == 0) {
          $image = "`img_id`";
        } else if ($image == -1) {
          $image = "NULL";
        }
        $db->query("UPDATE t_object_obj SET  `obj_name` =  '%s', `obj_stock` = '%d', `obj_alcool` = '%u', `img_id` = %s WHERE `obj_id` = '%u';",array($nom, $stock, $alcool, $image, $id));

        return array("success"=>$id);
	}

	/**
	* Supprime un article
	*
	* @param int $id
	* @return array $result
	*/
	public static function delete($id, $fun_id) {
        $db = Db_buckutt::getInstance();
        // 1. GET THE ARTICLE
        $res = $db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id, p.pri_credit
        FROM t_object_obj o
            LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child
            LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id  
        WHERE 
            o.obj_removed = '0' AND 
            o.obj_type = 'product' AND 
            o.obj_id = '%u' AND
            o.fun_id = '%u';", array($id, $fun_id));
        if ($db->affectedRows() >= 1) {
	        $don = $db->fetchArray($res);
        	$fundation=$don['fun_id'];
        } else {
        	return array("error"=>400, "error_msg"=>"L'article à supprimer n'existe pas ! (Ou vous n' avez pas les droits pour le supprimer).");
        }

        // 2. REMOVE THE ARTICLE
        $db->query("UPDATE t_object_obj SET  `obj_removed` = '1' WHERE  `obj_id` = '%u';",array($id));

        // 3. DELETE PRICE
        // TODO !!

        return array("success"=>"ok");
	}


}

