<?php 

namespace Payutc\Service;

/**
 * CATALOG.php
 * 
 * Ce service permet de récupérer le catalogue des produits (bieres, snacks, softs) sans connexion user juste avec une connexion app
 *
 */
class CATALOG extends \ServiceBase {
    
    /**
    * Retourne les categories
    * @param $fun_ids = array de fun_id (a passer en json), ou null
    * Si $fun_ids == NULL renvoit toutes les catégories (ou l'on a les droits)
    * Sinon renvoit les catégories des fundations demandés.
    * @return array $categories
    */
    public function getCategories($fun_ids = null) {
        $fun_ids = json_decode($fun_ids);
        if(is_array($fun_ids)) {
            // Checker les droits sur chaque fundation donné.
            foreach($fun_ids as $fun_id) {
                $this->checkRight(false, true, true, $fun_id);
            }
        } else {
            // Verifie qu'on a des droits sur le service (sans checker de fundation)
            $this->checkRight(false, true, false, null); 
            $fundations = $this->getFundations();
            $fun_ids = array();
            foreach($fundations as $fun) {
                if($fun['fun_id'])
                    $fun_ids[] = $fun['fun_id'];
            }
        }
        return \Payutc\Bom\Category::getAll($fun_ids);
    }

    /**
    * Retourne une categorie
    *
    * @param fun_id pour checker les droits, on doit donner la fun_id en plus de la categorie id
    */
    public function getCategory($obj_id, $fun_id = null) {
        $this->checkRight(false, true, true, $fun_id);
        return \Payutc\Bom\Category::getOne($obj_id, $fun_id);
    }

    /**
    * Retourne les articles
    * @param $fun_ids = array de fun_id (a passer sous forme de json), ou null
    * Si $fun_ids == NULL renvoit tous les articles (ou l'on a les droits)
    * Sinon renvoit les catégories des fundations demandés.
    * @return array $products
    */
    public function getProducts($fun_ids = null) {
        $fun_ids = json_decode($fun_ids);
        if(is_array($fun_ids)) {
            // Checker les droits sur chaque fundation donné.
            foreach($fun_ids as $fun_id) {
                $this->checkRight(false, true, true, $fun_id);
            }
        } else {
            // Verifie qu'on a des droits sur le service (sans checker de fundation)
            $this->checkRight(false, true, false, null); 
            // Et selectione toute les fundations ou on a les droits
            $fundations = $this->getFundations();
            $fun_ids = array();
            foreach($fundations as $fun) {
                if($fun['fun_id'])
                    $fun_ids[] = $fun['fun_id'];
            }
        }
        return \Payutc\Bom\Product::getAll($fun_ids);
    }

    /**
    * Retourne les articles classés par catégories
    * @param $fun_ids = array de fun_id (a passer sous forme de json), ou null
    * Si $fun_ids == NULL renvoit tous les articles (ou l'on a les droits)
    * Sinon renvoit les catégories des fundations demandés.
    * @return array $products
    */
    public function getProductsByCategories($fun_ids = null) {
        $categories = $this->getCategories($fun_ids);
        $products = $this->getProducts($fun_ids);

        foreach ($categories as $c_num => $cat) {
            foreach ($products as $p_num => $prod) {
                if($cat->id == $prod->categorie_id)
                    $categories[$c_num]['products'][] = $prod;
            }
        }

        return $categories;
    }

    /**
    * Retourne un article
    *
    * @param fun_id pour checker les droits, on doit donner la fun_id en plus de l'objet id
    */
    public function getProduct($obj_id, $fun_id = null) {
        $this->checkRight(false, true, true, $fun_id);
        $p = \Payutc\Bom\Product::getOne($obj_id, $fun_id);
        if ($p === null) {
            return array("error"=>400, "error_msg"=>"Cet article ($obj_id, $fun_id) n'existe pas, ou vous n'avez pas les droits dessus.");
        }
        else {
            return array("success" => $p);
        }
    }
}
