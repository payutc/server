<?php

/**
 * 
 * Gestion des articles
 * Table: t_object_obj | obj_type = 'product'
 */

namespace Payutc\Bom;
use \Payutc\Db\Dbal;
use \Payutc\Db\DbBuckutt;

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
     * $params['fun_ids']
     * $params['obj_ids']
     */
    public static function getAll($params = array()) {
        $default = array(
            'fun_ids' => null,
            'itm_ids' => null,
        );
        $params = array_merge($default, $params);
        $fun_ids = $params['fun_ids'];
        $itm_ids = $params['itm_ids'];
        
        $qb = Dbal::createQueryBuilder();
        $qb->select('itm.obj_id', 'itm.obj_name', 'oli.obj_id_parent', 
                    'itm.fun_id', 'itm.obj_stock', 'itm.obj_alcool', 
                    'pri.pri_credit', 'itm.img_id')
            ->from('t_object_obj', 'itm')
            ->leftjoin('itm', 't_price_pri', 'pri', 'pri.obj_id = itm.obj_id')
            ->leftjoin('itm', 'tj_object_link_oli', 'oli', 'oli.obj_id_child = itm.obj_id')
            ->where('itm.obj_type = :obj_type')
            ->andWhere('itm.obj_removed = :removed')
            ->setParameters(array(
                'removed' => 0,
                'obj_type' => 'product'
            ));
        
        if ($fun_ids !== null) {
           $qb->andWhere('itm.fun_id IN (:fun_ids)')
                ->setParameter('fun_ids', $fun_ids, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
        }
        if ($itm_ids !== null) {
           $qb->andWhere('itm.obj_id IN (:ids)')
                ->setParameter('ids', $itm_ids, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
        }
        
        $res = $qb->execute();
        
        $products = array();
        while ($don = $res->fetch()) {
            $products[] = static::fromDbArray($don);
        }
        
        return $products;
    }


    public static function getOne($obj_id, $fun_id=null, $removed=0) {
        $qb = Dbal::createQueryBuilder();
        $qb->select('obj.obj_id', 'obj.obj_name', 'oli.obj_id_parent', 'obj.fun_id', 
                    'obj.obj_stock', 'obj.obj_alcool', 'pri.pri_credit', 'obj.img_id')
           ->from('t_object_obj', 'obj')
           ->leftjoin('obj', 'tj_object_link_oli', 'oli', 'oli.obj_id_child = obj.obj_id')
           ->leftjoin('obj', 't_price_pri', 'pri', 'pri.obj_id = obj.obj_id')
           ->where('obj.obj_removed = :removed')
           ->andWhere('obj.obj_type = :obj_type')
           ->andWhere('obj.obj_id = :obj_id')
           ->setParameters(array(
                'removed' => $removed,
                'obj_type' => "product",
                'obj_id' => $obj_id,
               ));
        if($fun_id !== null) {
           $qb->andWhere('obj.fun_id = :fun_id')
                ->setParameter('fun_id', $fun_id);
        }

        $res = $qb->execute();
        
        $don = $res->fetch();
        if($don != false) {        
            return static::fromDbArray($don);
        } else {
            return null;            
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
        $db = DbBuckutt::getInstance();
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
        $db = DbBuckutt::getInstance();
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
            $db->query(
                  "UPDATE t_price_pri SET `pri_credit` = '%u' WHERE `obj_id` = '%u' and `pri_removed` = '0';",
                  array($prix, $id));
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
        $db = DbBuckutt::getInstance();
        // 1. GET THE ARTICLE
        $res = $db->query("
        SELECT 
            o.obj_id, o.obj_name, obj_id_parent, o.fun_id, o.img_id,
            p.pri_credit
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
        } else {
            return array("error"=>400, "error_msg"=>"L'article à supprimer n'existe pas ! (Ou vous n' avez pas les droits pour le supprimer).");
        }
        
        // start transaction
        $conn = Dbal::conn();
        $conn->beginTransaction();
        
        try {
            // 2. remove article
            $db->query("UPDATE t_object_obj SET  `obj_removed` = '1' WHERE  `obj_id` = '%u';",array($id));

            // 3. remove prices
            $qb = Dbal::createQueryBuilder();
            $qb->update('t_price_pri', 'pri')
                ->where('obj_id = :id')
                ->set('pri_removed', 1)
                ->setParameter('id', $id);
            $qb->execute();
            
            // 4. delete image
            $conn->delete('ts_image_img', array('img_id' => $don['img_id']));
            
            // commit
            $conn->commit();
        }
        catch (Exception $e) {
            $conn->rollback();
            return array("error"=>400, "error_msg"=>"Erreur lors de la suppression de l'objet $id.");
        }
        

        return array("success"=>"ok");
    }


    protected static function _baseUpdateQueryById($itm_id)
    {
        $qb = Dbal::createQueryBuilder();
        $qb->update('t_object_obj', 'itm')
            ->where('obj_id = :itm_id')
            ->setParameter('itm_id', $itm_id);
        return $qb;
    }
    
    public static function incStockById($itm_id, $val)
    {
        $qb = static::_baseUpdateQueryById($itm_id);
        $qb->set('obj_stock', 'obj_stock + :val')
            ->setParameter('val', $val);
        $qb->execute();
    }
    
    public static function decStockById($itm_id, $val)
    {
        $qb = static::_baseUpdateQueryById($itm_id);
        $qb->set('obj_stock', 'obj_stock - :val')
            ->setParameter('val', $val);
        $qb->execute();
    }

}

