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
 * FADMIN.class
 * 
 * Classe pour le WSDL utilisé sur les clients type Fantomette
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */
 
require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';

require_once 'class/WsdlBase.class.php';
require_once 'class/Group.class.php';
require_once 'class/Fundation.class.php';
require_once 'class/User.class.php';
require_once 'class/Object.class.php';
require_once 'class/Sale.class.php';
require_once 'class/Price.class.php';

class FADMIN extends WsdlBase {
    /* private $admin;
      private $droits = Array();
      private $objects = Array();
      private $groups = Array();
      private $categories = Array();
      private $images = Array();
      private $ventes = Array();
      private $prices = Array(); */

    protected $User;
    protected $Fundation;

    /**
     * Constructeur qui chope la conexion a la DB
     * @return
     */
    public function __construct() {
        $this->db = Db_buckutt::getInstance();
    }

    /**
     * Connecter le user.
     *
     * @param String $data
     * @param String $passwd
     * @param int $meanOfLogin
     * @param String $ip
     * @return int $state
     */
    public function login($data, $meanOfLogin, $pass, $ip) {
        unset($this->User);
        $this->User = new User($data, $meanOfLogin, $pass, $ip);
        return $this->User->getState();
    }

    /**
     * Charge la fondation
     * 
     * @param int $fun_id
     * @return int $state
     */
    public function setIdFundation($fun_id) {
        $this->Fundation = new Fundation($fun_id);
        return $this->Fundation->getState();
    }

    /**
     * donne l'id de la fundation
     *
     * @return int $fun_id
     */
    public function getIdFundation() {
        return $this->Fundation->getId();
    }

    /**
     * donne le nom de la fundation
     *
     * @return String $fun_name
     */
    public function getNameFundation() {
        return $this->Fundation->getName();
    }

    /**
     * Fonction qui renvoie les produits vendus entre 2 dates
     * 
     * @param int $date_start
     * @param int $date_end
     * @param int $fun_id
     * @return string $csv
     */
    public function getPurchasedObjects($date_start, $date_end, $fun_id) {
        if ($this->User->isFundTrezo($fun_id) != 1)
            return 400;

        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT COUNT(obj.obj_id) As count, obj.obj_name, SUM(pur.pur_price) AS price FROM t_purchase_pur pur, t_object_obj obj WHERE pur.obj_id = obj.obj_id AND obj.fun_id = '%u' AND pur.pur_removed = '0' AND UNIX_TIMESTAMP(pur.pur_date) >= '%u' AND UNIX_TIMESTAMP(pur.pur_date) < '%u' GROUP BY pur.obj_id ORDER BY obj.obj_name", Array($fun_id, $date_start, $date_end));
        if ($this->db->affectedRows() >= 1) {
            while ($don = $this->db->fetchArray($res)) {
                $txt->addLine(array($don['count'], $don['obj_name'], $don['price']));
            }
            return $txt->csvArrays();
        } else {
            return 400;
        }
    }

    /**
     * Fonction qui renvoie la dépense totale
     * 
     * @param int $date_start
     * @param int $date_end
     * @param int $fun_id
     * @return int $amount
     */
    public function getTotal($date_start, $date_end, $fun_id) {
        if ($this->User->isFundTrezo($fun_id) != 1)
            return 400;

        if ($this->db->numRows($amount = $this->db->query("SELECT sum(pur_price) AS total FROM t_purchase_pur pur WHERE pur.pur_removed = '0' AND pur.fun_id = '%u' AND UNIX_TIMESTAMP(pur.pur_date) >= '%u' AND UNIX_TIMESTAMP(pur.pur_date) < '%u';", Array($fun_id, $date_start, $date_end))) == 1) {
            return $this->db->result($amount);
        } else {
            return 400;
        }
    }

    /**
     * retourne la liste de tous les groupes sans detail de la fundation et les groupes publics
     * @return String $groups
     */
    public function getAllFundationGroupsLight() {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT grp_id, grp_name FROM t_group_grp grp WHERE fun_id = '%u' AND grp_removed = '0';", Array($this->Fundation->getId()));
        while ($don = $this->db->fetchArray($res)) {
            $txt->addLine(array($don['grp_id'], $don['grp_name']));
        }
        return $txt->csvArrays();
    }

    /**
     * retourne la liste de tous les groupes de la fundation
     *
     * @return String $groups
     */
    public function getAllFundationGroups() {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT grp_id, grp_name, grp_open, grp_public FROM t_group_grp grp WHERE fun_id = '%u' AND grp_removed = '0';", Array($this->Fundation->getId()));
        while ($don = $this->db->fetchArray($res)) {
            $txt->addLine(array($don['grp_id'], $don['grp_name'], $don['grp_open'], $don['grp_public']));
        }
        return $txt->csvArrays();
    }

    /**
     * retourne la liste de tous les groupes sans detail de la fundation et les groupes publics
     *
     * @return String $groups
     */
    public function getAllGroups() {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT grp_id, grp_name FROM t_group_grp grp WHERE grp_removed = '0' AND (fun_id='%u' OR grp_public = 1)", Array($this->Fundation->getId()));
        while ($don = $this->db->fetchArray($res)) {
            $txt->addLine(array($don['grp_id'], $don['grp_name']));
        }
        return $txt->csvArrays();
    }

    /**
     * Ajoute un groupe dont la fondation seras proprio
     * @return int $id_group
     * @param String $name_group
     * @param bool $alone[optional]
     * @param bool $public[optional]
     */
    public function addGroup($name_group, $open=0, $public=0) {
        $Group = new Group(0, $this->Fundation, html_entity_decode($name_group), $open, $public);
        return $Group->getId();
    }

    /**
     * Edite le nom d'un groupe
     * @return int $state
     * @param int $id_group
     * @param String $name
     */
    public function editGroupName($id_group, $name_group) {
        $Group = new Group($id_group);

        if ($Group->getState() == 1) {
            $Group->setName(html_entity_decode($name_group));
        }
        return $Group->getState();
    }

    /**
     * Edite la méthode d'inscription à un groupe
     * @return int $state
     * @param int $id_group
     * @param int $alone
     */
    public function editGroupAlone($id_group, $alone) {
        $Group = new Group($id_group);

        if ($Group->getState() == 1) {
            $Group->setOpen($alone);
        }
        return $Group->getState();
    }

    /**
     * Edite la publication d'un groupe
     * @return int $state
     * @param int $id_group
     * @param int $public
     */
    public function editGroupPublic($id_group, $public) {
        $Group = new Group($id_group);

        if ($Group->getState() == 1) {
            $Group->setIsPublic($public);
        }
        return $Group->getState();
    }

    /**
     * Supprime un organisme
     * @return int $state
     * @param int $id_group
     */
    public function deleteGroup($id_group) {
        $Group = new Group($id_group);
        $Group->remove();
        return $Group->getState();
    }

    /**
     * donne tout les objets d'une fundation depuis toujours et même si ya jamais eu de prix/group associé ou de point associé
     * @return string $txt
     */
    public function getAllObjects() {
        $txt = new ComplexData(array());
        $res = $this->db->query("SELECT obj_id, obj_name, obj_type, obj_single, obj_stock FROM t_object_obj WHERE obj_removed = 0 AND fun_id = '%u' ORDER BY obj_name;", Array($this->Fundation->getId()));
        while ($don = $this->db->fetchArray($res)) {
            $txt->addLine(array($don['obj_id'], $don['obj_name'], $don['obj_type'], $don['obj_single'], $don['obj_stock']));
        }
        return $txt->csvArrays();
    }

    /**
     * Supprime un objet
     * @return int $state
     * @param int $id_object
     */
    public function deleteObject($id_object) {
        $Object = new Object($id_object);
        $Object->remove();
        return $Object->getState();
    }

    /**
     * Ajoute un mec a un groupe entre 2 dates !
     * @return bool $sate
     * @param int  $id_group
     * @param int  $id_user
     * @param int  $date_start
     * @param int  $date_end
     */
    public function addUserToGroup($id_group, $id_user, $date_start, $date_end) {
        if (!isset($this->groups[$id_group])) {
            $this->groups[$id_group] = new Group($id_group);
        }
        $state = $this->groups[$id_group]->addUserToGroup($id_user, $date_start, $date_end);
        return $state;
    }

    /**
     * Detruit les inscription d'un user a un groupe si celle ci termine apres now
     * Renvoi le nombre d'inscription ainssi detrouite (des inscription a des groupes peuvent se chevaucher)
     * @return int $affected
     * @param int $id_group
     * @param int $id_link
     */
    public function deleteUserFromGroup($id_group, $id_link) {
        if (!isset($this->groups[$id_group])) {
            $this->groups[$id_group] = new Group($id_group);
        }
        $state = $this->groups[$id_group]->removeUserFromGroup($id_link);
        return $state;
    }

    /**
     * Ajouter une image
     * @param String $mime
     * @param int $width
     * @param int $length
     * @param String $content
     * @return int $id
     */
    public function addImage($mime, $width, $length, $content) {
        $image = new Image(0, $mime, $width, $length, base64_decode($content));
        $this->images[$image->getId()] = $image;
//TODO yaura de l'erreur à gerer ici en cas d'echec !
        return $image->getId();
    }

    /**
     * Ajouter un objet
     * @param string $name_object
     * @param int $unique
     * @param int $stock
     * @param int $id_categorie
     * @param int $id_image
     * @param int $ispromo
     * @return int $id
     */
    /*  public function addObject($name_object, $unique, $stock, $id_categorie, $id_image, $ispromo) {
      if (!isset($this->categories[$id_categorie])) {
      $this->categories[$id_categorie] = new Categorie($id_categorie);
      }
      if (!isset($this->images[$id_image])) {
      $this->images[$id_image] = new Image($id_image);
      }
      $object = new Object(0, html_entity_decode($name_object), $unique, $stock, $this->categories[$id_categorie], $this->images[$id_image], $ispromo);
      $this->objects[$object->getId()] = $object;
      //TODO yaura de l'erreur à gerer ici en cas d'echec !
      return $object->getId();
      }
     */
    /**
     * Edite le nom d'un objet
     * @return bool $state
     * @param int $id_object
     * @param String $name
     */
    /*  public function editObjectName($id_object, $name_object) {
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      $state = $this->objects[$id_object]->setName(html_entity_decode($name_object));
      return $state;
      } */

    /**
     * Edite la singularité d'un objet
     * @return bool $state
     * @param int $id_object
     * @param bool $isunique
     */
    /*  public function editObjectIsUnique($id_object, $isunique) {
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      $state = $this->objects[$id_object]->setIsUnique($isunique);
      return $state;
      }
     */
    /**
     * Edite le stock d'un objet
     * @return bool $state
     * @param int $id_object
     * @param int $stock
     */
    /*   public function editObjectStock($id_object, $stock) {
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      $state = $this->objects[$id_object]->setStock($stock);
      return $state;
      }
     */
    /**
     * Edite la catégorie d'un objet
     * @return bool $state
     * @param int $id_object
     * @param int $id_categorie
     */
    /*  public function editObjectCategorie($id_object, $id_categorie) {
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      if (!isset($this->categories[$id_categorie])) {
      $this->categories[$id_categorie] = new Categorie($id_categorie, $this->admin->fundation);
      }
      $state = $this->objects[$id_object]->setCategorie($this->categories[$id_categorie]);
      return $state;
      }
     */
    /**
     * Edite l'image d'un objet
     * @return bool $state
     * @param int $id_object
     * @param int $id_image
     */
    /*  public function editObjectImage($id_object, $id_image) {
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      if (!isset($this->images[$id_image])) {
      $this->images[$id_image] = new Image($id_image);
      }
      $state = $this->objects[$id_object]->setImage($this->images[$id_image]);
      return $state;
      }
     */
    /**
     * Edite un objet en promotion ou non
     * @return bool $state
     * @param int $id_object
     * @param bool $ispromo
     */
    /*  public function editObjectIsPromo($id_object, $ispromo) {
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      $state = $this->objects[$id_object]->setIsPromo($ispromo);
      return $state;
      }
     */

    /**
     * Ajoute une categorie
     * @return int id_categorie
     * @param String $name_categorie
     */
    public function addCategorie($name_categorie, $priorite) {
        $categorie = new Categorie(0, $this->admin->fundation, html_entity_decode($name_categorie), $priorite);
        $this->categories[$categorie->getId()] = $categorie;
//TODO yaura de l'erreur à gerer ici en cas d'echec !
        return $categorie->getId();
    }

    /**
     * Edite le nom d'une categorie
     * @return bool $state
     * @param int $id_categorie
     * @param String $name
     */
    /*   public function editCategorieName($id_categorie, $name_categorie) {
      if (!isset($this->categories[$id_categorie])) {
      $this->categories[$id_categorie] = new Categorie($id_categorie, $this->admin->fundation);
      }
      $state = $this->categories[$id_categorie]->setName(html_entity_decode($name_categorie));
      return $state;
      }
     */
    /**
     * Edite la priorite d'une categorie
     * @return bool $state
     * @param int $id_categorie
     * @param int $priorite
     */
    /*  public function editCategoriePriorite($id_categorie, $priorite) {
      if (!isset($this->categories[$id_categorie])) {
      $this->categories[$id_categorie] = new Categorie($id_categorie, $this->admin->fundation);
      }
      $state = $this->categories[$id_categorie]->setPriorite($priorite);
      return $state;
      }
     */
    /**
     * Supprime une categorie
     * @return bool $state
     * @param int $id_categorie
     */
    /*  public function deleteCategorie($id_categorie) {
      if (!isset($this->categories[$id_categorie])) {
      $this->categories[$id_categorie] = new Categorie($id_categorie, $this->admin->fundation);
      }
      $state = $this->categories[$id_categorie]->remove();
      return $state;
      }
     */
    /**
     * Ajoute une vente dont la fondation seras proprio
     * @return int $id_vente
     * @param int $date_start
     * @param int $date_end
     * @param int $id_object
     * @param String $name [optional]
     */
    /*
      public function addVente($date_start, $date_end, $id_object, $name=0) {
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      $vente = new Vente(0, $date_start, $date_end, $this->objects[$id_object], html_entity_decode($name));
      $this->ventes[$vente->getId()] = $vente;
      //TODO yaura de l'erreur à gerer ici en cas d'echec !
      return $vente->getId();
      }
     */
    /**
     * Edite la date de début de la vente
     * @return bool $state
     * @param int $id_vente
     * @param int $date_start
     */
    /*  public function editVenteDateStart($id_vente, $date_start) {
      if (!isset($this->ventes[$id_vente])) {
      $this->ventes[$id_vente] = new Vente($id_vente);
      }
      $state = $this->ventes[$id_vente]->setDateStart($date_start);
      return $state;
      }
     */
    /**
     * Edite la date de fin de la vente
     * @return bool $state
     * @param int $id_vente
     * @param int $date_end
     */
    /*  public function editVenteDateEnd($id_vente, $date_end) {
      if (!isset($this->ventes[$id_vente])) {
      $this->ventes[$id_vente] = new Vente($id_vente);
      }
      $state = $this->ventes[$id_vente]->setDateEnd($date_end);
      return $state;
      }
     */
    /**
     * Edite l'objet de la vente
     * @return bool $state
     * @param int $id_vente
     * @param int $id_object
     */
    /*  public function editVenteObject($id_vente, $id_object) {
      if (!isset($this->ventes[$id_vente])) {
      $this->ventes[$id_vente] = new Vente($id_vente);
      }
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      $state = $this->ventes[$id_vente]->setObject($this->objects[$id_object]);
      return $state;
      }
     */
    /**
     * Edite le nom de la vente
     * @return bool $state
     * @param int $id_vente
     * @param String $name
     */
    /*  public function editVenteName($id_vente, $name) {
      if (!isset($this->ventes[$id_vente])) {
      $this->ventes[$id_vente] = new Vente($id_vente);
      }
      $state = $this->ventes[$id_vente]->setName(html_entity_decode($name));
      return $state;
      }
     */
    /**
     * Supprime une vente
     * @return bool $state
     * @param int $id_vente
     */
    /*  public function deleteVente($id_vente) {
      if (!isset($this->ventes[$id_vente])) {
      $this->ventes[$id_vente] = new Vente($id_vente);
      }
      $state = $this->ventes[$id_vente]->remove();
      return $state;
      }
     */

    /**
     * Ajoute un prix dont la fondation seras proprio
     * @return int $id_price
     * @param int $id_group
     * @param int $id_object
     * @param int $credit
     */
    /*  public function addPrice($id_group, $id_object, $credit) {
      if (!isset($this->groups[$id_group])) {
      $this->groups[$id_group] = new Group($id_group);
      }
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      $price = new Price(0, $this->groups[$id_group], $this->objects[$id_object], $credit);
      $this->prices[$price->getId()] = $price;
      //TODO yaura de l'erreur à gerer ici en cas d'echec !
      return $price->getId();
      }
     */
    /**
     * Edite le groupe du prix
     * @return bool $state
     * @param int $id_price
     * @param int $id_group
     */
    /*  public function editPriceGroup($id_price, $id_group) {
      if (!isset($this->prices[$id_price])) {
      $this->prices[$id_price] = new Price($id_price);
      }
      if (!isset($this->groups[$id_group])) {
      $this->groups[$id_group] = new Group($id_group);
      }
      $state = $this->prices[$id_price]->setGroup($this->groups[$id_group]);
      return $state;
      }
     */
    /**
     * Edite l'objet du prix
     * @return bool $state
     * @param int $id_price
     * @param int $id_object
     */
    /*  public function editPriceObject($id_price, $id_object) {
      if (!isset($this->prices[$id_price])) {
      $this->prices[$id_price] = new Price($id_price);
      }
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      $state = $this->prices[$id_price]->setObject($this->objects[$id_object]);
      return $state;
      }
     */
    /**
     * Edite le credit du prix
     * @return bool $state
     * @param int $id_price
     * @param int $credit
     */
    /*  public function editPriceCredit($id_price, $credit) {
      if (!isset($this->prices[$id_price])) {
      $this->prices[$id_price] = new Price($id_price);
      }
      $state = $this->prices[$id_price]->setCredit($credit);
      return $state;
      }
     */
    /**
     * Supprime un prix
     * @return bool $state
     * @param int $id_price
     */
    /*  public function deletePrice($id_price) {
      if (!isset($this->prices[$id_price])) {
      $this->prices[$id_price] = new Price($id_price);
      }
      $state = $this->prices[$id_price]->remove();
      return $state;
      }
     */

    /**
     * Ajouter un object à point de vente
     * @return int $state
     * @param int $id_object
     * @param int $id_point
     */
    /* public function addObjectToPoint($id_object, $id_point) {
      if (!isset($this->points[$id_point])) {
      $this->points[$id_point] = new Point($id_point);
      }
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      $state = $this->points[$id_point]->addObject($this->objects[$id_object]);
      return $state;
      }
     */
    /**
     * Supprime un object d'un point de vente
     * @return int $state
     * @param int $id_object
     * @param int $id_point
     */
    /*  public function deleteObjectFromPoint($id_object, $id_point) {
      if (!isset($this->points[$id_point])) {
      $this->points[$id_point] = new Point($id_point);
      }
      if (!isset($this->objects[$id_object])) {
      $this->objects[$id_object] = new Object($id_object);
      }
      $state = $this->points[$id_point]->deleteObject($this->objects[$id_object]);
      return $state;
      }
     */

    /**
     * Ajoute un droit à un mec entre 2 dates à un point si nécessaire
     * @return bool $sate
     * @param int  $id_droit
     * @param int  $id_user
     * @param int  $date_start
     * @param int  $date_end
     * @param int $id_point[optionnal]
     */
    public function addUserToDroit($id_droit, $id_user, $date_start, $date_end, $id_point = 0) {
        if (!isset($this->droits[$id_droit])) {
            $this->droits[$id_droit] = new Droit($id_droit);
        }
        $state = $this->droits[$id_droit]->addUserToDroit($id_user, $date_start, $date_end, $this->admin->fundation->getId(), $id_point);
        return $state;
    }

    /**
     * Detruit les inscription d'un user a un droit si celle ci termine apres now
     * Renvoi le nombre d'inscription ainssi detrouite (des inscription a des groupes peuvent se chevaucher)
     * @return int $affected
     * @param int $id_droit
     * @param int $id_link
     */
    public function deleteUserFromDroit($id_droit, $id_link) {
        if (!isset($this->droits[$id_droit])) {
            $this->droits[$id_droit] = new Droit($id_droit);
        }
        $state = $this->droits[$id_droit]->removeUserFromDroit($id_link);
        return $state;
    }

    /**
     * Permet d'ajouter un objet en :
     * precisant dans $type son type "object", "category" ou "promotion"
     * dans $id_parent l'identifiant de la categorie ou l'identifiant de la promotion au dessus (c'est independant du type)
     * dans $step le numero de l'etape dans la promotion (ça commence à 1), pas applicable pour category ou object
     * en retour on a un CSV contenant case 0, l'etat de l'ajout (1 si ok, le numero de l'erreur si echec), case 1 l'id de l'ajout (0 si echec)
     *
     * la methode suppose que le stock est illimité
     * l'objet n'est pas unique
     * l'image est l'image par defaut
     * que la fundation est celle de fadmin
     *
     * @return String $retour
     * @param String $name
     * @param String $type
     * @param int $id_parent
     * @param int $step
     */
    public function addObject($name, $type, $id_parent = NULL, $step = NULL) {
        $rtn = new ComplexData();
        if ($type == "product") {
            $obj = new Object(0, $name, $type, -1, $this->Fundation->getId(), 1, 0, 0);
            $err = $obj->getState();

            if (!is_null($id_parent) && $err == 1) {
                if (!is_null($step)) {
                    $obj_promo = new Object($id_parent);
                    if ($obj_promo->getState() != 1) {
                        $err = 471;
                    } else {
                        $rtn_promo = $obj_promo->addPromoChild($obj->getId(), $step);
                        if ($rtn_promo != 1) {
                            $err = 400;
                        }
                    }
                } else {
                    $rtn_parent = $obj->addParent($id_parent);

                    if ($rtn_parent == 0) {
                        $err = 471;
                    }
                }
            }
            $rtn->addLine(array($err, $obj->getId()));
        } else if ($type == "category") {
            $obj = new Object(0, $name, $type, -1, $this->Fundation->getId(), 1, 0, 0);
            $err = $obj->getState();
            if (!is_null($id_parent) && $err == 1) {
                if (!is_null($step)) {
                    $obj_promo = new Object($id_parent);
                    if ($obj_promo->getState() != 1) {
                        $err = 471;
                    } else {
                        $rtn_promo = $obj_promo->addPromoChild($obj->getId(), $step);
                        if ($rtn_promo != 1) {
                            $err = 400;
                        }
                    }
                } else {
                    $rtn_parent = $obj->addParent($id_parent);

                    if ($rtn_parent == 0) {
                        $err = 471;
                    }
                }
            }
            $rtn->addLine(array($err, $obj->getId()));
        } else if ($type == "promotion") {
            $obj = new Object(0, $name, $type, -1, $this->Fundation->getId(), 1, 0, 0);
            $err = $obj->getState();
            if (!is_null($id_parent) && $err == 1) {
                if (!is_null($step)) {
                    $obj_promo = new Object($id_parent);
                    if ($obj_promo->getState() != 1) {
                        $err = 471;
                    } else {
                        $rtn_promo = $obj_promo->addPromoChild($obj->getId(), $step);
                        if ($rtn_promo != 1) {
                            $err = 400;
                        }
                    }
                } else {
                    $rtn_parent = $obj->addParent($id_parent);

                    if ($rtn_parent == 0) {
                        $err = 471;
                    }
                }
            }
            $rtn->addLine(array($err, $obj->getId()));
        } else {
            $rtn->addLine(array("470", "0"));
        }
        return $rtn->csvArrays();
    }

    /**
     * donne les categories disponibles, ça tient compte de la fundation et du removed=0, pas du point ni de la presence d'un prix pour celle ci
     * @return String $listeDispoCategories
     */
    public function getAvailableCategory() {
        $rtn = new ComplexData();
        $req = $this->db->query("SELECT obj_id, obj_name FROM t_object_obj WHERE obj_type = 'category' AND fun_id = '%u' AND obj_removed = '0';", Array($this->Fundation->getId()));
        while ($don = $this->db->fetchArray($req)) {
            $cat = new Object($don['obj_id']);
            $rtn->addLine(array($don['obj_id'], $cat->getName()));
        }
        return $rtn->csvArrays();
    }

    /**
     * donne les promotions disponibles, ça tient compte de la fundation et du removed=0, pas du point ni de la presence d'un prix pour celle ci
     * @return String $listeDispoPromotion
     */
    public function getAvailablePromotion() {
        $rtn = new ComplexData();
        $req = $this->db->query("SELECT obj_id, obj_name FROM t_object_obj WHERE obj_type = 'promotion' AND fun_id = '%u' AND obj_removed = '0';", Array($this->Fundation->getId()));
        while ($don = $this->db->fetchArray($req)) {
            $promo = new Object($don['obj_id']);
            $rtn->addLine(array($don['obj_id'], $promo->getName()));
        }
        return $rtn->csvArrays();
    }

    /**
     * donne le nombre de steps existant dans l'objet, si la promo est neuve ou si c'est pas une promo ça retourne 0
     * @param int $id_promotion
     * @return int $nbSteps
     */
    public function getExistingPromotionSteps($id_promotion) {
        $promo = new Object($id_promotion);
        if ($promo->isPromotion()) {
            return $promo->getPromotionStepCount();
        } else {
            return 0;
        }
    }

    /**
     * donne les periodes utilisables par une fundation pour faire sa tambouille
     * @return String $csvPeriods
     */
    public function getAvailablePeriods() {
        $rtn = new ComplexData();
        $req = $this->db->query("SELECT per_id FROM t_period_per WHERE (fun_id = '%u' OR fun_id = 0) AND per_removed = '0' AND per_date_end > NOW() AND per_name != '';", Array($this->Fundation->getId()));
        while ($don = $this->db->fetchArray($req)) {
            $per = new Period($don['per_id']);
            $rtn->addLine(array($don['per_id'], $per->getName(), $per->getDateStart(), $per->getDateEnd()));
        }
        return $rtn->csvArrays();
    }

    /**
     * cree une nouvelle periode
     * @param String $per_name
     * @param int $per_start
     * @param int $per_end
     * @return String $csvResult
     */
    public function addPeriod($per_name, $per_start, $per_end) {
        $rtn = new ComplexData();
        $per = new Period(0, $this->Fundation->getId(), $per_name, $per_start, $per_end);
        $rtn->addLine(array($per->getState(), $per->getId()));
        return $rtn->csvArrays();
    }

    /**
     * ajoute une nouvelle vente en reprennant le nom de la periode pour simplifier
     * @param int $obj_id
     * @param int $per_id
     * @return String $csvResult
     */
    public function addSale($obj_id, $per_id) {
        $rtn = new ComplexData();
        $obj = new Object($obj_id);
        if ($obj->getState() != 1) {
            $rtn->addLine(array($obj->getState(), 0));
            return $rtn->csvArrays();
        }
        $per = new Period($per_id);
        if ($per->getState() != 1) {
            $rtn->addLine(array($per->getState(), 0));
            return $rtn->csvArrays();
        }
        $sale = new Sale(0, $obj, $per, $per->getName());

        $rtn->addLine(array($sale->getState(), $sale->getId()));
        return $rtn->csvArrays();
    }

    /**
     * ajoute un prix
     * @param int $obj_id
     * @param int $grp_id
     * @param int $per_id
     * @param int $pri_credit
     * @return String $csvResult
     */
    public function addPrice($obj_id, $grp_id, $per_id, $pri_credit) {
        $rtn = new ComplexData();
        $obj = new Object($obj_id);
        if ($obj->getState() != 1) {
            $rtn->addLine(array($obj->getState(), 0));
            return $rtn->csvArrays();
        }
        $grp = new Group($grp_id);
        if ($grp->getState() != 1) {
            $rtn->addLine(array($grp->getState(), 0));
            return $rtn->csvArrays();
        }
        $per = new Period($per_id);
        if ($per->getState() != 1) {
            $rtn->addLine(array($per->getState(), 0));
            return $rtn->csvArrays();
        }
        $price = new Price(0, $obj, $grp, $per, $pri_credit);

        $rtn->addLine(array($price->getState(), $price->getId()));
        return $rtn->csvArrays();
    }

    /**
     * donne les groupes d'utilisateurs utilisables par une fundation pour faire sa tambouille
     * @return String $csvGroups
     */
    public function getAvailableGroups() {
        $rtn = new ComplexData();
        $req = $this->db->query("SELECT grp_id, grp_name FROM t_group_grp WHERE (fun_id = '%u' OR grp_public = '1') AND grp_removed = '0';", Array($this->Fundation->getId()));
        while ($don = $this->db->fetchArray($req)) {
            $grp = new Group($don['grp_id']);
            $rtn->addLine(array($don['grp_id'], $grp->getName()));
        }
        return $rtn->csvArrays();
    }

    /**
     * lie un objet à un point
     * @param int $obj_id
     * @param int $poi_id
     * @return int $retour
     */
    public function addObjectToPoint($obj_id, $poi_id) {
        $obj = new Object($obj_id);
        if ($obj->getState() != 1) {
            return $obj->getState();
        }
        $poi = new Point($poi_id);
        if ($poi->getState() != 1) {
            return $poi->getState();
        }
        return $poi->addObject($obj);
    }

    /**
     * donne les points utilisables par une fundation pour faire sa tambouille
     * @return String $csvGroups
     */
    public function getAvailablePoints() {
        $rtn = new ComplexData();
        $req = $this->db->query("SELECT poi_id, poi_name FROM t_point_poi WHERE poi_removed = '0';");
        while ($don = $this->db->fetchArray($req)) {
            $poi = new Point($don['poi_id']);
            $rtn->addLine(array($don['poi_id'], $poi->getName()));
        }
        return $rtn->csvArrays();
    }

}

$_GET['localmode'] = true;

/* SOAP-ISATION PAR CLASSE */
$name_class = 'FADMIN';
require ('inc/wsdl.inc.php');
?>
