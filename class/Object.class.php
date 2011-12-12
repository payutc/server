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
 * Object.class
 * 
 * Classe pour les objets.
 * 3 types : product, category (object avec des childs) et promotion (object avec des step, et un prix)
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */
require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';

class Object {

    protected $obj_id;
    protected $obj_name;
    protected $obj_type;
    protected $obj_stock; //-1 si pas de stock, donc %d dans les requetes
    protected $obj_single;
    protected $img_id;
    protected $fun_id;
    protected $Child;
    protected $Parent;
    protected $db;
    protected $state;

    //TODO réfléchir à l'utilité d'envoyer un objet Fundation et non seulement l'id. Idem pour l'image.
    /**
     * Constructeur du groupe.
     * 
     * @param int $obj_id
     * @param string $obj_name
     * @param string $obj_type
     * @param int $obj_stock
     * @param int $fun_id
     * @param int $img_id
     * @param int $obj_single
     * @param int $pre_load
     * @return int $state;
     */
    public function __construct($obj_id=0, $obj_name='', $obj_type='', $obj_stock=0, $fun_id=0, $img_id=0, $obj_single=0, $pre_load=0) {

        $this->db = Db_buckutt::getInstance();
        //Création d'object
        if ($obj_id == 0) {
            $this->db->query("INSERT INTO t_object_obj (obj_name, obj_type, obj_stock, obj_single, img_id, fun_id) VALUES('%s', '%s', '%d', '%u', '%u', '%u');", Array($obj_name, $obj_type, $obj_stock, $obj_single, $img_id, $fun_id));
            if ($this->db->affectedRows() == 1) {
                $this->obj_id = $this->db->insertId();
                $this->obj_name = $obj_name;
                $this->obj_type = $obj_type;
                $this->obj_stock = $obj_stock;
                $this->obj_single = $obj_single;
                $this->img_id = $img_id;
                $this->fun_id = $fun_id;
                $this->state = 1;
            } else {
                $this->state = 400;
            }
        }
        //Lecture d'object
        else {
            $this->obj_id = $obj_id;
            $don = $this->db->fetchArray($this->db->query("SELECT obj_name, obj_type, obj_stock, obj_single, img_id, fun_id FROM t_object_obj WHERE obj_id = '%u' AND obj_removed = '0';", Array($this->obj_id)));
            if ($this->db->affectedRows() == 1) {
                $this->obj_name = $don['obj_name'];
                $this->obj_type = $don['obj_type'];
                $this->obj_stock = $don['obj_stock'];
                $this->obj_single = $don['obj_single'];
                $this->img_id = $don['img_id'];
                $this->fun_id = $don['fun_id'];
                $this->state = 1;
            } else {
                $this->state = 465;
            }
        }
        $this->loadParent();
        $this->loadChild();

        return $this->state;
    }

    /**
     * Retourne quelques détails sur l'objet (nom, type, id_image)
     * (avant, retournait name / id_category, id_image)
     * 
     * @return array $Details
     */
    public function getDetailsLight() {
        if ($this->state == 1)
            return array($this->obj_name, $this->obj_type, $this->img_id);
        else
            return $this->state;
    }

    /**
     * Retourne tous les détails de l'objet
     * (avant : $arrayLight, array($this->isunique, $this->stock, $this->categorie->getNameFundation(), $this->date_end)
     * @return array $Details
     */
    public function getDetails() {
        if ($this->state == 1) {
            $array = array($this->obj_name, $this->obj_type, $this->obj_stock, $this->obj_single, $this->img_id, $this->fun_id);
            return $array;
        }
        else
            return $this->state;
    }

    /**
     * Retourne $obj_id.
     *
     * @return int $obj_id
     */
    public function getId() {
        return $this->obj_id;
    }

    /**
     * Retourne $obj_name.
     *
     * @return string $obj_name
     */
    public function getName() {
        return $this->obj_name;
    }

    /**
     * Retourne $obj_type.
     *
     * @return string $obj_type
     */
    public function getType() {
        return $this->obj_type;
    }

    /**
     * Retourne $obj_stock.
     *
     * @return int $obj_stock
     */
    public function getStock() {
        return $this->obj_stock;
    }

    /**
     * Retourne $obj_single.
     *
     * @return int $obj_single
     */
    public function getSingle() {
        return $this->obj_single;
    }

    /**
     * Retourne $img_id.
     *
     * @return int $img_id
     */
    public function getImgId() {
        return $this->img_id;
    }

    /**
     * Retourne $fun_id.
     *
     * @return int $fun_id
     */
    public function getFunId() {
        return $this->fun_id;
    }

    /**
     * Retourne $Parent.
     *
     * @return array $Parent
     */
    public function getParent() {
        return $this->Parent;
    }

    /**
     * Retourne $Child.
     *
     * @return array $Child
     */
    public function getChild() {
        return $this->Child;
    }

    /**
     * Retourne $state.
     *
     * @return int $state
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Change le $obj_name.
     * 
     * @param string $obj_name
     * @return int $state
     */
    public function setName($obj_name) {
        $this->db->query("UPDATE t_object_obj SET obj_name='%s' WHERE obj_id='%u';", Array($obj_name, $this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->obj_name = $obj_name;
            $this->state = 1;
        } else {
            $this->state = 400;
        }
    }

    /**
     * Change le $obj_type.
     *
     * @param string $obj_type
     * @return int $state
     */
    public function setType($obj_type) {
        $this->db->query("UPDATE t_object_obj SET obj_type='%s' WHERE obj_id='%u';", Array($obj_type, $this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->obj_type = $obj_type;
            $this->state = 1;
        } else {
            $this->state = 400;
        }
    }

    /**
     * Change le $obj_stock.
     * 
     * @param int $obj_stock
     * @return int $state
     */
    public function setStock($obj_stock) {
        $this->db->query("UPDATE t_object_obj SET obj_stock='%d' WHERE obj_id='%u';", Array($obj_stock, $this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->obj_stock = $obj_stock;
            $this->state = 1;
        } else {
            $this->state = 400;
        }
    }

    /**
     * Décremente le $obj_stock.
     *
     * @return int $state
     */
    public function decStock() {
        if ($this->obj_stock != -1) {
            $this->db->query("UPDATE t_object_obj SET obj_stock= (obj_stock - 1) WHERE obj_id='%u';", Array($this->obj_id));
            if ($this->db->affectedRows() == 1) {
                $this->obj_stock = $obj_stock;
                return 1;
            } else {
                return 0;
            }
        } else
            return 1;
    }

    /**
     * Change le $obj_single.
     *
     * @param int $obj_single
     * @return int $state
     */
    public function setSingle($obj_single) {
        $this->db->query("UPDATE t_object_obj SET obj_single='%u' WHERE obj_id='%u';", Array($obj_single, $this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->obj_single = $obj_single;
            $this->state = 1;
        } else {
            $this->state = 400;
        }
    }

    /**
     * Change le $img_id.
     * 
     * @param int $img_id
     * @return int $state
     */
    public function setImgId($img_id) {
        $this->db->query("UPDATE t_object_obj SET img_id='%u' WHERE obj_id='%u';", Array($img_id, $this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->img_id = $img_id;
            $this->state = 1;
        } else {
            $this->state = 400;
        }
    }

    /**
     * Change le $fun_id.
     *
     * @param int $fun_id
     * @return int $state
     */
    public function setFunID($fun_id) {
        $this->db->query("UPDATE t_object_obj SET fun_id='%u' WHERE obj_id='%u';", Array($fun_id, $this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->fun_id = $fun_id;
            $this->state = 1;
        } else {
            $this->state = 400;
        }
    }

    /**
     * Supprimer l'objet
     * 
     * @return int $state
     */
    public function remove() {
        $this->db->query("UPDATE t_object_obj SET obj_removed='1' WHERE obj_id='%u';", Array($this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->state = 1;
        } else {
            $this->state = 400;
        }
        return $this->state;
    }

    /**
     * Charge les parents.
     *
     * @return int $state
     */
    public function loadParent() {
        $this->Parent = Array();
        $res = $this->db->query("SELECT obj_id_parent FROM tj_object_link_oli WHERE obj_id_child = '%u' AND oli_step = '0';", array($this->obj_id));
        if ($this->db->affectedRows() >= 1) {
            while ($don = $this->db->fetchArray($res)) {
                $this->Parent[] = $don['obj_id_parent'];
            }
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Charge les enfants.
     *
     * @return int $state
     */
    public function loadChild() {
        $this->Child = Array();
        $res = $this->db->query("SELECT obj_id_child FROM tj_object_link_oli WHERE obj_id_parent = '%u' AND oli_step = '0';", array($this->obj_id));
        if ($this->db->affectedRows() >= 1) {
            while ($don = $this->db->fetchArray($res)) {
                $this->Child[] = $don['obj_id_child'];
            }
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Ajoute un enfant.
     * 
     * @param int $obj_child_id
     * @return int $state
     */
    public function addChild($obj_child_id) {
        $this->db->query("INSERT INTO tj_object_link_oli (obj_id_parent, obj_id_child) VALUES('%u', '%u');", Array($this->obj_id, $obj_child_id));
        if ($this->db->affectedRows() == 1) {
            $this->loadChild();
            return 1;
        } else
            return 0;
    }

    /**
     * Ajoute un parent.
     * 
     * @param int $obj_parent_id
     * @return int $state
     */
    public function addParent($obj_parent_id) {
        $this->db->query("INSERT INTO tj_object_link_oli (obj_id_parent, obj_id_child) VALUES('%u', '%u');", Array($obj_parent_id, $this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->loadParent();
            return 1;
        } else
            return 0;
    }

    /**
     * Ajoute un enfant à une promo.
     * 
     * @param int $obj_child_id
     * @param int $step
     * @return int $state
     */
    public function addPromoChild($obj_child_id, $step) {
        $this->db->query("INSERT INTO tj_object_link_oli (obj_id_parent, obj_id_child, oli_step) VALUES('%u', '%u', '%u');", Array($this->obj_id, $obj_child_id, $step));
        if ($this->db->affectedRows() == 1) {
            return 1;
        } else
            return 0;
    }

    /**
     * Retire un enfant.
     *
     * @param int $obj_child_id
     * @return int $state
     */
    public function removeChild($obj_child_id) {
        $this->db->query("DELETE FROM tj_object_link_oli WHERE obj_id_parent = '%u' AND obj_id_child = '%u' AND oli_step = '0';", Array($this->obj_id, $obj_child_id));
        if ($this->db->affectedRows() == 1) {
            $this->loadChild();
            return 1;
        } else
            return 0;
    }

    /**
     * Retire un parent.
     *
     * @param int $obj_parent_id
     * @return int $state
     */
    public function removeParent($obj_parent_id) {
        $this->db->query("DELETE FROM tj_object_link_oli WHERE obj_id_parent = '%u' AND obj_id_child = '%u' AND oli_step = '0';", Array($obj_parent_id, $this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->loadParent();
            return 1;
        } else
            return 0;
    }

    /**
     * Retire tous les enfants.
     *
     * @return int $state
     */
    public function clearChild() {
        $this->db->query("DELETE FROM tj_object_link_oli WHERE obj_id_parent = '%u' AND oli_step = '0';", Array($this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->loadChild();
            return 1;
        } else
            return 0;
    }

    /**
     * Retire tous les parents.
     *
     * @return int $state
     */
    public function clearParent() {
        $this->db->query("DELETE FROM tj_object_link_oli WHERE obj_id_child = '%u' AND oli_step = '0';", Array($this->obj_id));
        if ($this->db->affectedRows() == 1) {
            $this->loadParent();
            return 1;
        } else
            return 0;
    }

    /**
     * Dit si l'objet est une promotion
     * @return Boolean check
     */
    public function isPromotion() {
        if ($this->obj_type == "promotion") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Dit si l'objet est un objet classique
     * @return Boolean check
     */
    public function isObject() {
        if ($this->obj_type == "object") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Dit si l'objet est une category
     * @return Boolean check
     */
    public function isCategory() {
        if ($this->obj_type == "category") {
            return true;
        } else {
            return false;
        }
    }
    /**
     * donne le nombre de steps qui existent dans la bdd sur une promotion
     * @return int nbSteps
     */
    public function getPromotionStepCount(){
        $req = $this->db->query("SELECT obj_id_parent, obj_id_child, oli_step FROM tj_object_link_oli WHERE obj_id_parent = '%u' GROUP BY oli_step;", Array($this->obj_id));
        return $this->db->numRows($req);
    }


}

?>