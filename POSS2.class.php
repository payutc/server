<?php 
/**
	BuckUTT - Buckutt est un système de paiement avec porte-monnaie électronique.
	Copyright (C) 2011 BuckUTT <buckutt@utt.fr>
	Copyright (C) 2012 payutc <payutc@asso.utc.fr>

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
 * POSS2.class
 * 
 * Classe pour le WSDL utilisé sur les clients type Peggy
 * @author payutc <payutc@asso.utc.fr>
 * @version 2.0
 * @package buckutt
 */

require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
require_once 'class/Buy.class.php';
require_once 'class/Point.class.php';
require_once 'class/Seller.class.php';
require_once 'class/Buyer.class.php';
require_once 'class/Log.class.php';
require_once 'class/Cas.class.php';
require_once 'class/CheckRight.class.php';

define('MEAN_OF_LOGIN_BADGE', 5);

class POSS2 {

	protected $Seller;
	protected $Point_id;
	protected $Fun_id;



	protected function getRemoteIp() {
		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	 * Charge le Seller sans mot de passe.
	 * 
	 * @param String $ticket
	 * @param String $service
	 * @param int poi_id
	 * @param int fun_id
	 * @return array $state
	*/
	public function loadPos($ticket, $service, $poi_id, $fun_id) {
		// TOUTE TENTATIVE DE LOADING, SUPPRIME UNE EVENTUELLE ANCIENNE SESSION
		unset($this->Seller);
		$ip = $this->getRemoteIp();
		if($ticket == 42 && $service == 24)
			$login = "trecouvr";
		else
			$login = Cas::authenticate($ticket, $service);
		if ($login < 0) {
			return array("error"=>-1, "error_msg"=>"Erreur de login CAS.");
		}
		$user = new User($login, 1, "", 0, 1, 0);
		$r = $user->getState();
		if ($r != 1) {
			return array("error"=>$r, "error_msg"=>"Le seller n'a pas pu être chargé.");
		}
		$this->Point_id = $poi_id;
		$this->Fun_id = $fun_id;
		$right = new CheckRight($user->getId(), $this->Point_id, $this->Fun_id);
		if(!$right->check("VENDRE"))
            return array("error"=>400, "error_msg"=>"Vous n'avez pas le droit VENDRE sur cette fundation.");
        if(!$right->check("POI-FUNDATION"))
            return array("error"=>400, "error_msg"=>"La fundation n'a pas le droit d'utiliser ce POI.");

        // TOUT VA BIEN ON CHARGE LE SELLER
        $this->Seller = $user;
		return array("success"=>"ok");
	}
	
	/**
	 * Check si le user est loggué
	 * 
	 * @return bool $state
	 */
	public function isLoadedSeller() {
		if (isset($this->Seller))
			return True;
		else
			return False;
	}
	
	/**
	* Récupérer les infos sur le Seller
	* 
	* @return array $csv
	*/
	public function getSellerIdentity() {
		if ($this->isLoadedSeller()) {
			$identity = $this->Seller->getIdentity();
			return array("success"=>array(
				"id" => $identity[0],
				"firstname" => $identity[1],
				"lastname" => $identity[2],
				"nickname" => $identity[3]
				// Inutiles de renvoyer le solde et la photo du seller...
				//"id_photo" => $identity[4],
				//"solde" => $identity[5]
				));
		} else {
			return array("error"=>400, "error_msg"=>"Il n'y a pas de seller chargé.");
		}
	}
	
	/**
	 * Récupérer un cvs avec les produits disponibles
	 * 
	 * @return array $csv
	 */
	public function getArticles() {
		$isSeller = $this->isLoadedSeller();
		if ($isSeller == 1) {
			//Proposition2::getAll($this->Seller, $this->Point_id, $this->Fun_id); <<-- Faudra copier coller la function dans une classe qui va bien et juste l'appeler...
			$right_POI_FUNDATION = 7; // A IMPORTER DE JE NE SAIS OU.

			$propositions = array();
			$articles = array();
			$cats = array();
			$res = Db_buckutt::getInstance()->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.obj_stock, o.obj_type, p.pri_credit
FROM tj_usr_rig_jur jur, t_object_obj o
LEFT JOIN tj_object_link_oli ON o.obj_id = obj_id_child 
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id 
WHERE 
jur.fun_id = o.fun_id
AND obj_removed = '0'
AND jur.rig_id = '%u'
AND jur.poi_id = '%u'
AND o.fun_id = '%u'
ORDER BY obj_name;", array($right_POI_FUNDATION, $this->Point_id, $this->Fun_id));
	        while ($don = Db_buckutt::getInstance()->fetchArray($res)) {
	        	if($don['obj_type']=='category')
	        		$cats[$don['obj_id']] = array(
	            	"id"=>$don['obj_id'], 
	            	"name"=>$don['obj_name'],
	            	"parent_id"=>$don['obj_id_parent']);
	        	else
	            	$articles[$don['obj_id']]=array(
		            	"id"=>$don['obj_id'], 
		            	"name"=>$don['obj_name'], 
		            	"categorie_id"=>$don['obj_id_parent'],
		            	"stock"=>$don['obj_stock'],
		            	"price"=>$don['pri_credit']);
	        }

        	return array("success"=>array("categories"=>$cats, "articles"=>$articles));


		} else {
			return array("error"=>400, "error_msg"=>"Il n'y a pas de seller chargé.");
		}
	}
	

	/**
	 * Transaction complète,
	 * 		1. load le buyer
	 * 		2. multiselect
	 * 		3. endTransaction
	 * @param String $badge_id
	 * @param String $obj_ids
	 * @return array $state
	 */
	public function transaction($badge_id, $obj_ids) {
		if ($this->isLoadedSeller()) {
			$right_POI_FUNDATION = 7; // TODO IMPORTER D'AILLEURS

			// Verifier que le buyer existe
			$buyer = new User($badge_id, MEAN_OF_LOGIN_BADGE, "", 0, 1, 1);
			$state = $buyer->getState();
			if($state == 403)
				return array("error"=>403, "error_msg"=>"Ce badge à été bloqué. Il faut que l'utilisateur aille le débloquer sur internet.");
			if($state != 1)
				return array("error"=>400, "error_msg"=>"Le Badge n'a pas été reconnu..."); // Enfait y'a pas que le badge qui peut entrer la mais bon c'est le plus fréquent...
			
			// Verifier que les objets sont en vente (+ leurs prix)
			// ON a déjà vérifier la liaison POI <=> Fundation <=> USER
			// On vérifie que le produit fait bien partie de la fundation
			// TODO : Vérifier la plage_horaire, le groupe alcool etc...
			$objects_ids = explode(" ", $obj_ids);
			$obj_ids = array_unique($objects_ids);
			$req = "SELECT o.obj_id, o.obj_name, o.obj_stock, o.obj_type, p.pri_credit
FROM t_object_obj o
LEFT JOIN t_price_pri p ON p.obj_id = o.obj_id 
WHERE 
obj_removed = '0'
AND o.fun_id = '%u' AND (";
			foreach($obj_ids as $id) {
				$req .= " o.obj_id = '%u' OR";
			}
			$req = substr($req, 0, -2);
			$req .= ")";
			$res = Db_buckutt::getInstance()->query($req, array_merge(array($this->Fun_id),$obj_ids));
			$articles = array();
	        while ($don = Db_buckutt::getInstance()->fetchArray($res)) { $articles[$don['obj_id']] = $don;}

	        $total = 0;
	        foreach($objects_ids as $obj_id)
	        {
	        	if(isset($articles[$obj_id]))
	        	{
	        		$total += $articles[$obj_id]['pri_credit'];
	        	} else {
	        		return array("error"=>400, "error_msg"=>"L'article $obj_id n'est pas disponible à la vente.");
	        	}
	        }

			// Verifier que le buyer a assez d'argent
	        if($buyer->getCredit() < $total)
	        	return array("error"=>400, "error_msg"=>"L'utilisateur n'a pas assez d'argent pour effectuer la transaction.", "usr_info"=>array("firstname"=>$buyer->getFirstname(), "lastname"=>$buyer->getLastname(), "solde"=>$buyer->getCredit()));

			// Effectuer les achats
	        Db_buckutt::getInstance()->query("UPDATE ts_user_usr SET usr_credit = (usr_credit - '%u') WHERE usr_id='%u';", Array($total, $buyer->getId())); // TODO AJOUTER LA METHODE DANS LA CLASSE USER.
			
			foreach($objects_ids as $obj_id)
	        {
	        	Db_buckutt::getInstance()->query(("INSERT INTO t_purchase_pur (pur_date, pur_type, obj_id, pur_price, usr_id_buyer, usr_id_seller, poi_id, fun_id, pur_ip) VALUES (NOW(), '%s', '%u', '%u', '%u', '%u', '%u', '%u', '%s')"), 
	        		array("product", $obj_id, $articles[$obj_id]['pri_credit'], $buyer->getId(), $this->Seller->getId(), $this->Point_id, $this->Fun_id, $this->getRemoteIp()));
	        }

	        // REtourner les infos sur l'utilisateur
	        return array("success"=>array("firstname"=>$buyer->getFirstname(), "lastname"=>$buyer->getLastname(), "solde"=>$buyer->getCredit()));


		}
		else 
			return array("error"=>400, "error_msg"=>"Il n'y a pas de seller chargé.");
	}
}

/*SOAP-ISATION PAR CLASSE*/
$name_class = 'POSS2';
require ('inc/wsdl.inc.php');

?>
