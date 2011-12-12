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
 * Proposition.class
 * 
 * Classe pour les propositions.
 * 1 proposition est un ensemble d'objets que peut acheter un user à un moment donné
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/ObjectWithPrice.class.php';
require_once 'class/User.class.php';
require_once 'class/ComplexData.class.php';

class Proposition {
        protected $Seller;
        protected $User;
	protected $Object;
	protected $Point;
	protected $ObjectList;
	protected $ObjectCsvLight;
	protected $ObjectCsv;
	protected $db;
	protected $state;
	protected $endPromo = 0; //1 si on est dans une promo
	
	/**
     * Constructeur des propositions.
     *
     * @param object $Seller
     * @param object $User
     * @param object $Point
     * @param object $ParentObject
     * @param int $step
     * @return int $state;
     */
	public function __construct(&$Seller, &$User, &$Point, &$ParentObject = 0, $step = 0) {
		
		$this->db = Db_buckutt::getInstance();
		
                $this->Seller = $Seller;
		$this->User = $User;
		$this->Point = $Point;
		
		//si c'est une catégorie
		if($ParentObject != 0 AND $ParentObject->getType() == 'category') {
			$condition = vsprintf("oli.obj_id_parent = '%u' AND oli.oli_step = '0' AND ", array($ParentObject->getId()));
		} 
		else if($ParentObject != 0 AND $ParentObject->getType() == 'promotion') {
			$DetailsPromo = $this->getDetailsPromo($ParentObject->getId(), $step);
			$condition = "(";
			if ($DetailsPromo != 0) {
				$this->promo = 0;
				foreach ($DetailsPromo as $key => $value) {
				    if ($value == 'product')
						$condition .= "obj.obj_id = '".$key."' OR ";
					else if ($value == 'category')
						$condition .= "oli.obj_id_parent = '".$key."' OR ";
				}
				//on supprime le OR de trop
				$condition = substr($condition, 0, -4);
				$condition .= ") AND";
			} else {
				//la promo est terminée
				$condition = "oli.oli_id IS NULL AND ";
				$ParentObject = 0;
				$this->endPromo = 1;
			}
		} else {
			$condition = "(oli.oli_id IS NULL OR obj.obj_type = 'category') AND";
		}
		
		//TODO gérer les produits en vente unique
		//TODO gérer le seller
		
		$res1 = $this->db->query("SET @SELLER_ID='%u',@BUYER_ID='%u',@POINT_ID='%u';",array($this->Seller->getId(), $this->User->getId(), $this->Point->getId()));
		
		$res = $this->db->query("
SELECT
obj.obj_id, obj.obj_name, obj.obj_type, obj.obj_stock, obj.obj_single, obj.img_id,
IF(obj.obj_type = 'category',0, MIN(pri.pri_credit)) AS credit

FROM
t_object_obj obj

   INNER JOIN tj_obj_poi_jop jop
         ON obj.obj_id = jop.obj_id

   INNER JOIN t_sale_sal sal
         ON (obj.obj_id = sal.obj_id AND sal.sal_removed = '0')
               LEFT JOIN t_period_per per1
                    ON sal.per_id = per1.per_id

   LEFT OUTER JOIN t_price_pri pri
         ON ((obj.obj_type = 'category') OR (obj.obj_id = pri.obj_id AND obj.obj_type != 'category' AND pri.pri_removed = '0'))
                LEFT JOIN t_period_per per2
                         ON pri.per_id = per2.per_id
                INNER JOIN tj_usr_grp_jug jug
                        ON (pri.grp_id = jug.grp_id AND jug.jug_removed = '0')
                             LEFT JOIN t_period_per per3
                                   ON jug.per_id = per3.per_id

   LEFT JOIN tj_object_link_oli oli
         ON (obj.obj_id = oli.obj_id_child AND oli.oli_removed = '0')

   INNER JOIN tj_usr_rig_jur jur
         ON (obj.fun_id = jur.fun_id AND jur.jur_removed = '0' AND jur.rig_id = '11' AND jur.usr_id = @SELLER_ID AND jur.poi_id = @POINT_ID)
                LEFT JOIN t_period_per per4
                      ON jur.per_id = per4.per_id

WHERE

".$condition."

obj.obj_removed = '0' AND
per1.per_date_start <= NOW() AND
per1.per_date_end >= NOW() AND
(per2.per_date_start <= NOW() OR per2.per_date_start IS NULL) AND
(per2.per_date_end >= NOW() OR per2.per_date_end IS NULL) AND
per3.per_date_start <= NOW() AND
per3.per_date_end >= NOW() AND
per4.per_date_start <= NOW() AND
per4.per_date_end >= NOW() AND
jug.usr_id = @BUYER_ID AND
jop.poi_id = @POINT_ID AND
(obj.obj_stock > '0' OR obj.obj_stock = '-1')

GROUP BY obj.obj_id

ORDER BY jop.jop_priority ASC, obj.obj_name ASC
;");
		
		$ObjectList = Array();
		$this->ObjectCsvLight = new ComplexData(array());
		$this->ObjectCsv = new ComplexData(array());
		if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				if($ParentObject != 0 AND $ParentObject->getType() == 'promotion')
					$temp_obj = new ObjectWithPrice($don['obj_id'], $don['obj_name'], $don['obj_type'], $don['obj_stock'], $don['fun_id'], $don['img_id'], 0, 0);
				else
					$temp_obj = new ObjectWithPrice($don['obj_id'], $don['obj_name'], $don['obj_type'], $don['obj_stock'], $don['fun_id'], $don['img_id'], 0, $don['credit']);
				$this->ObjectList[] = $temp_obj;
				$this->ObjectCsvLight->addLine($temp_obj->getDetailsLight());
				$this->ObjectCsv->addLine($temp_obj->getDetails());
			}
			$this->state = 1;
		} else {
			$this->state = 0;
		}

		return $this->state;
	}

	/**
	* Retourne $User.
	*
	* @return object $User
	*/
	public function getUser() {
		return $this->User;
	}

	/**
	* Retourne $Point.
	*
	* @return object $Point
	*/
	public function getPoint() {
		return $this->Point;
	}
	
	/**
	* Retourne $promo.
	*
	* @return object $Point
	*/
	public function getEndPromo() {
		return $this->endPromo;
	}
	
	/**
	* Retourne $ObjectList.
	*
	* @return object $ObjectList
	*/
	public function getObjectList() {
		return $this->ObjectList;
	}
	
	/**
	* Retourne $ObjectCsv.
	*
	* @return String $csv
	*/
	public function getObjectCsv() {
		return $this->ObjectCsv->csvArrays();
	}	
	
	/**
	* Retourne $ObjectCsvLight.
	*
	* @return String $csv
	*/
	public function getObjectCsvLight() {
		return $this->ObjectCsvLight->csvArrays();
	}
	
	/**
	 * Sort un array avec les types des différents éléments constituant une promo.
	 * 
	 * @param int $obj_id
	 * @param int $step
	 * @return array @DetailsPromo
	 */
	public function getDetailsPromo($obj_id, $step) {
		$DetailsPromo = Array();
		$res = $this->db->query("
SELECT obj_id, obj_type FROM tj_object_link_oli oli, t_object_obj obj 
WHERE 
obj.obj_id = obj_id_child AND 
oli.obj_id_parent = '%u' AND 
oli.oli_step = '%u' AND 
obj.obj_removed = '0';
		",array($obj_id, $step));
		if ($this->db->affectedRows() >= 1) {
			while ($don = $this->db->fetchArray($res)) {
				$DetailsPromo[$don['obj_id']] = $don['obj_type'];
			}
			return $DetailsPromo;
		} else {
			return 0;
		}		
	}


		
/*
SELECT 
obj.obj_id AS obj_id,
obj.obj_name AS obj_name,
obj.obj_type AS obj_type,
obj.obj_stock AS obj_stock,
obj.fun_id AS fun_id,
obj.img_id AS img_id,
MIN(pri.pri_credit) AS credit 

FROM
tj_obj_poi_jop jop,
tj_usr_grp_jug jug,
t_sale_sal sal,
t_period_per per1,
t_period_per per2,
t_period_per per3, 

t_object_obj obj 
LEFT JOIN tj_object_link_oli oli ON obj.obj_id=oli.obj_id_child 
LEFT JOIN t_price_pri pri ON obj.obj_id=pri.obj_id  

WHERE 

oli.oli_id IS NULL AND 

obj.obj_removed = '0' AND 
jug.jug_removed = '0' AND 
(pri.pri_removed = '0' OR pri.pri_removed IS NULL) AND 
sal.sal_removed = '0' AND 

(obj.obj_stock > '0' OR obj.obj_stock = '-1') AND 

jug.usr_id = '1' AND 
(jug.grp_id = pri.grp_id OR pri.grp_id IS NULL) AND 
jop.poi_id = '2' AND 
jop.obj_id = obj.obj_id AND 
(pri.obj_id = obj.obj_id OR pri.obj_id IS NULL) AND 
sal.obj_id = obj.obj_id AND 

per1.per_id = jug.per_id AND 
(per2.per_id = pri.per_id OR pri.per_id IS NULL)AND 
per3.per_id = sal.per_id AND 

per1.per_date_start <= NOW() AND 
per1.per_date_end >= NOW() AND 
(per2.per_date_start <= NOW() OR per2.per_date_start IS NULL) AND 
(per2.per_date_end >= NOW() OR per2.per_date_end IS NULL) AND 
per3.per_date_start <= NOW() AND 
per3.per_date_end >= NOW() 

GROUP BY obj.obj_id;



suppression du rmeoved de oli : chopper tout
SELECT * FROM t_object_obj obj LEFT JOIN tj_object_link_oli oli ON obj.obj_id=oli.obj_id_child WHERE oli.oli_id IS NULL AND obj.obj_removed = 0








SELECT 
obj.obj_id, obj.obj_name, obj.obj_type, obj.obj_stock, obj.obj_single, obj.img_id, 
IF(obj.obj_type = "category",0, MIN(pri.pri_credit)) AS credit 

FROM 
t_object_obj obj 

   INNER JOIN tj_obj_poi_jop jop 
         ON obj.obj_id = jop.obj_id 

   INNER JOIN t_sale_sal sal 
         ON (obj.obj_id = sal.obj_id AND sal.sal_removed = '0') 
               LEFT JOIN t_period_per per1
                    ON sal.per_id = per1.per_id

   LEFT OUTER JOIN t_price_pri pri 
         ON ((obj.obj_type = 'category') OR (obj.obj_id = pri.obj_id AND obj.obj_type != 'category' AND pri.pri_removed = '0')) 
                LEFT JOIN t_period_per per2
                         ON pri.per_id = per2.per_id
                INNER JOIN tj_usr_grp_jug jug 
                        ON (pri.grp_id = jug.grp_id AND jug.jug_removed = '0') 
                             LEFT JOIN t_period_per per3
                                   ON jug.per_id = per3.per_id

   LEFT JOIN tj_object_link_oli oli 
         ON (obj.obj_id = oli.obj_id_child AND oli.oli_removed = '0') 

WHERE 
oli.oli_id IS NULL AND 
obj.obj_removed = '0' AND 
per1.per_date_start <= NOW() AND 
per1.per_date_end >= NOW() AND 
(per2.per_date_start <= NOW() OR per2.per_date_start IS NULL) AND 
(per2.per_date_end >= NOW() OR per2.per_date_end IS NULL) AND 
per3.per_date_start <= NOW() AND 
per3.per_date_end >= NOW() AND 
jug.usr_id = '267' AND 
jop.poi_id = '3' AND 
(obj.obj_stock > '0' OR obj.obj_stock = '-1') 

GROUP BY obj.obj_id 

ORDER BY jop.jop_priority ASC



SELECT 
obj.obj_id, obj.obj_name, obj.obj_type, obj.obj_stock, obj.obj_single, obj.img_id, IF(obj.obj_type = "category",0, MIN(pri.pri_credit)) AS credit 

FROM 

t_object_obj obj 

  INNER JOIN tj_obj_poi_jop jop 
    ON obj.obj_id = jop.obj_id 
    
  INNER JOIN t_sale_sal sal 
    ON (obj.obj_id = sal.obj_id AND sal.sal_removed = '0') 
      LEFT JOIN t_period_per per1 
        ON sal.per_id = per1.per_id 
        
  LEFT OUTER JOIN t_price_pri pri 
    ON ((obj.obj_type = 'category') OR (obj.obj_id = pri.obj_id AND obj.obj_type != 'category' AND pri.pri_removed = '0')) 
      LEFT JOIN t_period_per per2 
        ON pri.per_id = per2.per_id 
      INNER JOIN tj_usr_grp_jug jug 
        ON (pri.grp_id = jug.grp_id AND jug.jug_removed = '0') 
          LEFT JOIN t_period_per per3 ON jug.per_id = per3.per_id 
          
  LEFT JOIN tj_object_link_oli oli 
    ON (obj.obj_id = oli.obj_id_child AND oli.oli_removed = '0') 
    
WHERE 
oli.oli_id IS NULL AND 
obj.obj_removed = '0' AND 
per1.per_date_start <= NOW() AND 
per1.per_date_end >= NOW() AND 
(per2.per_date_start <= NOW() OR per2.per_date_start IS NULL) AND 
(per2.per_date_end >= NOW() OR per2.per_date_end IS NULL) AND 
per3.per_date_start <= NOW() AND per3.per_date_end >= NOW() AND 
jug.usr_id = '267' AND 
jop.poi_id = '3' AND 
(obj.obj_stock > '0' OR obj.obj_stock = '-1') 

GROUP BY obj.obj_id 

ORDER BY jop.jop_priority ASC ;
*/
}
?>