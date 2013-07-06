<?php

/**
 * 
 * Gestion des categories
 * Table: t_object_obj | obj_type = 'category'
 */

namespace Payutc\Bom;
use \Payutc\Db\DbBuckutt;

class Category {

    /*
     * Transforme un fetchArray de la db, en quelque chose de potable
     */
    private static function fromDbArray($don) {
        return array(
                "id"=>$don['obj_id'],
                "name"=>$don['obj_name'],
                "parent_id"=>$don['obj_id_parent'],
                "fundation_id"=>$don['fun_id']);
    }

    /*
     * Retourne toutes les categories
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

        $query = "SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child AND oli_removed = 0
WHERE
obj_removed = '0'
AND obj_type = 'category'
$fun_req
ORDER BY obj_name;";

        $res = DbBuckutt::getInstance()->query($query, $param);

        // Construction du resultat.
        $categories = array();
        while ($don = DbBuckutt::getInstance()->fetchArray($res)) {
            $categories[]=static::fromDbArray($don);
        }
        return $categories;
    }

    public static function getOne($obj_id, $fun_id=null) {
        $res = DbBuckutt::getInstance()->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child AND oli_removed = 0
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id
WHERE
obj_removed = '0'
AND o.obj_type = 'category'
AND o.obj_id = '%u'
AND o.fun_id = '%u'
ORDER BY obj_name;", array($obj_id, $fun_id));
        if (DbBuckutt::getInstance()->affectedRows() >= 1) {
            $don = DbBuckutt::getInstance()->fetchArray($res);
            return array("success" => static::fromDbArray($don));
        } else {
            return array("error"=>400, "error_msg"=>"Cet article ($obj_id, $fun_id) n'existe pas, ou vous n'avez pas les droits dessus.");
        }
    }


    /**
    * Ajoute une categorie
    *
    */
    public static function add($nom, $parent, $fundation) {
        $db = DbBuckutt::getInstance();
        // 1. CHECK THE PARENT (AND IF TRUE SELECT THE TRUTH FUNDATION)
        if($parent != null) {
            $res = $db->query("SELECT fun_id FROM t_object_obj 
                WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u' AND fun_id = '%u';", array($parent, $fundation));
            if ($db->affectedRows() >= 1) {
                $don = $db->fetchArray($res);
                $fundation=$don['fun_id'];
            } else {
                return array("error"=>400, "error_msg"=>"Le parent n'a pas été trouvé !");
            }
        }

        // 3. INSERTION DE LA CATEGORIE
        $categorie_id = $db->insertId(
              $db->query(
                  "INSERT INTO t_object_obj (`obj_id`, `obj_name`, `obj_type`, `obj_stock`, `obj_single`, `img_id`, `fun_id`, `obj_removed`)
                  VALUES (NULL, '%s', 'category', NULL, '0', NULL, '%u', '0');",
                  array($nom, $fundation)));
        if($parent != NULL) {
            $db->query(
                  "INSERT INTO tj_object_link_oli (`oli_id`, `obj_id_parent`, `obj_id_child`, `oli_step`, `oli_removed`) VALUES (NULL, '%u', '%u', '0', '0');",
                  array($parent, $categorie_id));
        }

        return array("success"=>$categorie_id);
    }


    /**
    * Edite une categorie
    *
    */
    public static function edit($id, $nom, $parent, $fun_id) {
        $db = DbBuckutt::getInstance();
        // 1. GET THE CATEGORIE
        $res = $db->query("SELECT obj_id_parent, fun_id, oli_id 
            FROM t_object_obj 
            LEFT JOIN tj_object_link_oli ON obj_id = obj_id_child AND oli_removed = 0 
            WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u' AND fun_id = '%u';", array($id, $fun_id));
            if ($db->affectedRows() >= 1) {
                $don = $db->fetchArray($res);
                $fundation=$don['fun_id'];
                $old_parent=$don['obj_id_parent'];
                $oli_id=$don['oli_id'];
            } else {
                return array("error"=>400, "error_msg"=>"La catégorie à modifier n'existe pas !");
           }

        // 3. CHECK SI LE CHANGEMENT DE PARENT EST REALISABLE
        if($parent != null and $old_parent != $parent)
        {
            if($parent == $id) {
                return array("error"=>400, "error_msg"=>"Le parent ne peut pas être ta catégorie...");
            }
            $res = $db->query("SELECT fun_id FROM t_object_obj WHERE obj_removed = '0' AND obj_type = 'category' AND obj_id = '%u';", array($parent));
            if ($db->affectedRows() >= 1) {
                $don = $db->fetchArray($res);
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

        // 5. EDIT THE CATEGORY
        $db->query("UPDATE t_object_obj SET  `obj_name` =  '%s' WHERE  `obj_id` = '%u';",array($nom, $id));

        return array("success"=>$id);
    }

    /**
    * Supprime une categorie
    *
    */
    public static function delete($id, $fun_id) {
        $db = DbBuckutt::getInstance();
        // 1. GET THE ARTICLE
        $res = $db->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.fun_id
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child AND oli_removed = '0'
WHERE o.obj_removed = '0' AND o.obj_type = 'category' AND o.obj_id = '%u' AND fun_id = '%u';", array($id, $fun_id));
            if ($db->affectedRows() >= 1) {
                $don = $db->fetchArray($res);
                $fundation=$don['fun_id'];
            } else {
                return array("error"=>400, "error_msg"=>"La categorie à supprimer n'existe pas !");
           }

        // 3. CHECK THERE IS NO CHILDREN
        $res = $db->query("SELECT o.obj_id
FROM t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child AND oli_removed = '0'
WHERE o.obj_id = obj_id_child
AND o.obj_removed = '0' AND obj_id_parent = '%u';", array($id));
            if ($db->affectedRows() >= 1) {
                return array("error"=>400, "error_msg"=>"La categorie à encore des enfants!");
           }


        // 4. REMOVE THE CATEGORY (AND link if any)
        $db->query("UPDATE t_object_obj SET  `obj_removed` = '1' WHERE  `obj_id` = '%u';",array($id));
        $db->query("UPDATE tj_object_link_oli SET  `oli_removed` = '1' WHERE  `obj_id_child` = '%u';",array($id));

        return array("success"=>"ok");
    }

}

