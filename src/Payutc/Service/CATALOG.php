<?php 

namespace Payutc\Service;

use \Payutc\Bom\Category;
use \Payutc\Bom\Product;
use \Payutc\Exception\ProductNotFoundException;
use \Payutc\Exception\CategoryNotFoundException;

/**
 * CATALOG.php
 * Ce service permet de récupérer le catalogue des produits (bieres, snacks, softs) sans connexion user juste avec une connexion app
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
        //On passe en paramètres $user, $app, $fun_ids
        //Les deux premiers sont pour le checkRight qui sera appelé par getFundations lui même appelé par checkFundationIds si fun_ids est NULL
        $fun_ids = $this->checkFundationIds(false,true,$fun_ids);
        return Category::getAll($fun_ids);
    }

    /**
    * Retourne une categorie
    *
    * @param fun_id pour checker les droits, on doit donner la fun_id en plus de la categorie id
    */
    public function getCategory($obj_id, $fun_id = null) {
        $this->checkRight(false, true, true, $fun_id);
        $c = Category::getOne($obj_id, $fun_id);
        if ($c === null) {
            throw new CategoryNotFoundException("Cette categorie ($obj_id, $fun_id) n'existe pas, ou vous n'avez pas les droits dessus.");
        }else {
            return array("success" => $c);
        }
    }

    /**
    * Retourne les articles
    * @param $fun_ids = array de fun_id (a passer sous forme de json), ou null
    * Si $fun_ids == NULL renvoit tous les articles (ou l'on a les droits)
    * Sinon renvoit les catégories des fundations demandés.
    * @return array $products
    */
    public function getProducts($fun_ids = null) {
        //On passe en paramètres $user, $app, $fun_ids
        //Les deux premiers sont pour le checkRight qui sera appelé par getFundations lui même appelé par checkFundationIds si fun_ids est NULL
        $fun_ids = $this->checkFundationIds(false,true,$fun_ids);
        return Product::getAll($fun_ids);
    }

    /**
    * Retourne les articles classés par catégories
    * @param $fun_ids = array de fun_id (a passer sous forme de json)
    * @return array $productsByCategories
    */
    public function getProductsByCategories($fun_ids = null) {
        $categories = $this->getCategories($fun_ids);
        $products = $this->getProducts($fun_ids);
        $productsByCategories = array();

        foreach ($categories as $c_num => $cat) {

            $productsByCategories[$c_num] = $cat;

            foreach ($products as $p_num => $prod) {
                if($cat['id'] == $prod['categorie_id']){
                    $productsByCategories[$c_num]['products'][$p_num] = $prod;
                }
            }
        }

        return $productsByCategories;
    }

    /**
    * Retourne un article
    *
    * @param fun_id pour checker les droits, on doit donner la fun_id en plus de l'objet id
    */
    public function getProduct($obj_id, $fun_id = null) {
        $this->checkRight(false, true, true, $fun_id);
        $p = Product::getOne($obj_id, $fun_id);
        if ($p === null) {
            throw new ProductNotFoundException("Cet article ($obj_id, $fun_id) n'existe pas, ou vous n'avez pas les droits dessus.");
        }else {
            return array("success" => $p);
        }
    }
}
