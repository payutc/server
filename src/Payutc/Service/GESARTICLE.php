<?php

/**
 * GESARTICLE.php
 * 
 * Ce service expose les méthodes pour gérer les articles. 
 *
 */

namespace Payutc\Service;

class GESARTICLE extends \ServiceBase {

	/**
	* Retourne les categories
    * @param $fun_ids = array de fun_id (a passer en json), ou null
    * Si $fun_ids == NULL renvoit toutes les catégories (ou l'on a les droits)
    * Sinon renvoit les catégories des fundations demandés.
	* @return array $categories
	*/
    public function getCategories($fun_ids = null) {
        //Desormais la logique se fait dans ServiceBase puisque cette logique était écrite dans 2 fois dans 2 services différents
        //On passe en paramètres $user, $app, $fun_ids
        //Les deux premiers sont pour le checkRight qui sera appelé par getFundations lui même appelé par checkFundationIds si fun_ids est NULL
        $fun_ids = $this->checkFundationIds(true,true,$fun_ids);
		return \Payutc\Bom\Category::getAll($fun_ids);
	}

    /**
    * Retourne une categorie
    *
    * @param fun_id pour checker les droits, on doit donner la fun_id en plus de la categorie id
    */
    public function getCategory($obj_id, $fun_id = null) {
        $this->checkRight(true, true, true, $fun_id);
        return \Payutc\Bom\Category::getOne($obj_id, $fun_id);
    }

    /**
    * Ajoute (ou edite) une category
    */
    public function setCategory($obj_id = null, $name, $parent_id, $fun_id) {
        $this->checkRight(true, true, true, $fun_id);
        if($obj_id) {
            return \Payutc\Bom\Category::edit($obj_id, $name, $parent_id, $fun_id);
        } else {
            return \Payutc\Bom\Category::add($name, $parent_id, $fun_id);
        }
    }

    /**
    * Retire une categorie 
    */
    public function deleteCategory($obj_id, $fun_id) {
        $this->checkRight(true, true, true, $fun_id);
        return \Payutc\Bom\Category::delete($obj_id, $fun_id);
    }

	/**
	* Retourne les articles
    * @param $fun_ids = array de fun_id (a passer sous forme de json), ou null
    * Si $fun_ids == NULL renvoit tous les articles (ou l'on a les droits)
    * Sinon renvoit les catégories des fundations demandés.
	* @return array $products
	*/
    public function getProducts($fun_ids = null) {
        //Desormais la logique se fait dans ServiceBase puisque cette logique était écrite dans 2 fois dans 2 services différents
        //On passe en paramètres $user, $app, $fun_ids
        //Les deux premiers sont pour le checkRight qui sera appelé par getFundations lui même appelé par checkFundationIds si fun_ids est NULL
        $fun_ids = $this->checkFundationIds(true,true,$fun_ids);
		return \Payutc\Bom\Product::getAll($fun_ids);
	}

    /**
    * Retourne un article
    *
    * @param fun_id pour checker les droits, on doit donner la fun_id en plus de l'objet id
    */
    public function getProduct($obj_id, $fun_id = null) {
        $this->checkRight(true, true, true, $fun_id);
        $p = \Payutc\Bom\Product::getOne($obj_id, $fun_id);
        if ($p === null) {
            return array("error"=>400, "error_msg"=>"Cet article ($obj_id, $fun_id) n'existe pas, ou vous n'avez pas les droits dessus.");
        }
        else {
            return array("success" => $p);
        }
    }

    /**
    * Ajoute (ou edite) un article
    */
    public function setProduct($obj_id = null, $name, $parent, $prix, $stock, $alcool, $image, $fun_id) {
        $this->checkRight(true, true, true, $fun_id);
        if($obj_id) {
            return \Payutc\Bom\Product::edit($obj_id, $name, $parent, $prix, $stock, $alcool, $image, $fun_id);
        } else {
            return \Payutc\Bom\Product::add($name, $parent, $prix, $stock, $alcool, $image, $fun_id);
        }
    }

    /**
    * Retire un article
    */
    public function deleteProduct($obj_id, $fun_id) {
        $this->checkRight(true, true, true, $fun_id);
        return \Payutc\Bom\Product::delete($obj_id, $fun_id);
    }

	/**
	* Ajouter l'image d'un article
	*
	* @param string $image
	* @return int $result
	*/
    public function uploadImage($image) {
        $this->checkRight(true, true, false, null); 

        $oldgd = imagecreatefromstring(base64_decode($image));

        ob_start();
        imagepng($oldgd);
        $imagedata = ob_get_contents();
        ob_end_clean();

        $img = new \Image(0, "image/png", imagesx($oldgd), imagesy($oldgd), $imagedata);

        if($img->getState() != 1){
          return $img->getState();
        }

        return $img->getId();
    }


}

?>
