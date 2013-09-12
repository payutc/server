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

namespace Payutc\Service;

use \Cas;
use \Image;
use \Payutc\Db\DbBuckutt;
use \CheckRight;
use \Payutc\Exception\UserIsBlockedException;
use \Payutc\Exception\UserNotFound;
use \Payutc\Config;
use \Payutc\Log;
use \Payutc\Bom\User;

/**
 * POSS2.class
 * 
 * Classe pour le WSDL utilisé sur les clients type Peggy
 * @author payutc <payutc@asso.utc.fr>
 * @version 2.0
 * @package buckutt
 */


define('MEAN_OF_LOGIN_BADGE', 5);
define('MEAN_OF_LOGIN_NICKNAME', 1);

class POSS2 {

	protected $Seller;
	protected $Point_id;
	protected $Fun_id;

	protected function getRemoteIp() {
		return $_SERVER['REMOTE_ADDR'];
	}

	/**
	 * Retourne l'url du CAS
	 * @return array $url
	 */
	public function getCasUrl() {
	 return array("success"=>Cas::getUrl());
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
		unset($this->Seller);
		$ip = $this->getRemoteIp();
        
        try {
            $user = User::getUserFromCas($ticket, $service);
        }
        catch(LoginError $ex) {
			Log::warn("loadPos(ticket=$ticket, service=$service, poi_id=$poi_id, fun_id=$fun_id) : Error Cas");
			return array("error"=>-1, "error_msg"=>"Impossible de se connecter: ".$ex->getMessage());
        }
        catch(UserNotFound $ex) {
			Log::warn("loadPos(login=$login, poi_id=$poi_id, fun_id=$fun_id) : Error load seller ($r)");
			return array("error"=>$r, "error_msg"=>"Le seller n'a pas pu être chargé.");            
        }
        $login = $user->getNickname();
		$this->Point_id = $poi_id;
		$this->Fun_id = $fun_id;
		$right = new CheckRight($user->getId(), $this->Point_id, $this->Fun_id);
		if(!$right->check("VENDRE")) {
			Log::warn("loadPos(login=$login, poi_id=$poi_id, fun_id=$fun_id) : No right VENDRE");
            return array("error"=>400, "error_msg"=>"Vous n'avez pas le droit VENDRE sur cette fundation.");
		}
        if(!$right->check("POI-FUNDATION")) {
			Log::warn("loadPos(login=$login, poi_id=$poi_id, fun_id=$fun_id) : No right POI-FUN");
            return array("error"=>400, "error_msg"=>"La fundation n'a pas le droit d'utiliser ce POI.");
		}

        // TOUT VA BIEN ON CHARGE LE SELLER
        $this->Seller = $user;
		
		Log::info("loadPos(login=$login, poi_id=$poi_id, fun_id=$fun_id) : OK");
		return array("success"=>"ok");
	}
	

	/**
	* Deconnexion
	*
	* @return array $state
	*/
	public function logout() {
		if($this->isLoadedSeller())
		{
			unset($this->Seller);
			session_destroy();
			Log::info("logout() : OK");
			return array("success"=>"ok", "url"=>Cas::getUrl()."/logout");
		} else {
			Log::warn("logout() : No seller loaded");
			return array("error"=>"1401", "error_msg"=>"Aucun seller n'est logué.");
		}
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
			return array("success"=>$identity);
		} else {
			Log::warn("getSellerIdentity() : No Seller loaded");
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
			$res = DbBuckutt::getInstance()->query("SELECT o.obj_id, o.obj_name, obj_id_parent, o.obj_stock, o.obj_type, p.pri_credit, o.img_id
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
	        while ($don = DbBuckutt::getInstance()->fetchArray($res)) {
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
		            	"price"=>$don['pri_credit'],
		            	"image"=>$don['img_id']);
	        }

        	return array("success"=>array("categories"=>$cats, "articles"=>$articles));


		} else {
			Log::warn("getArticles() : No Seller loaded");
			return array("error"=>400, "error_msg"=>"Il n'y a pas de seller chargé.");
		}
	}
	

	/**
	 * Obtenir les infos d'un buyer 
	 *
	 * @param String $badge_id
	 * @return array $state
	 */
	public function getBuyerInfo($badge_id) {
		if ($this->isLoadedSeller()) {
            
            // Verifier que le buyer existe
            try {
                $buyer = User::getUserFromBadge($badge_id);
            }
            catch(UserNotFound $ex) {
                Log::warn("getBuyerInfo($badge_id) : User not found");
				return array("error"=>400, "error_msg"=>"Le Badge n'a pas été reconnu...");
            }

			// vérifier que l'utilisateur n'est pas bloqué sur cette fondation
			try {
				$buyer->checkNotBlockedFun($this->Fun_id);
			}
			catch (UserIsBlockedException $e) {
				return array("error"=>402, "error_msg"=> $e->getMessage());
			}
			return array("success"=>array(
										"firstname"=>$buyer->getFirstname(), 
										"lastname"=>$buyer->getLastname(), 
										"solde"=>$buyer->getCredit(),
										"last_purchase"=>$buyer->getLastPurchases()
								));
		} else {
			Log::warn("getBuyerInfo() : No Seller loaded");
			return array("error"=>400, "error_msg"=>"Il n'y a pas de seller chargé.");
		}
	}

	/** Annulation d'un achat
	 * 1. Récupére l'achat
	 * 2. Vérifie que le vendeur est le bon, ainsi que la vente à été réalisé il y'a moins de X temps
	 * 3. Annule la vente et recrédite
	 * @param int $purchase_id
	 * @return array $state
	 */
	public function cancel($purchase_id)
	{
		if ($this->isLoadedSeller()) {

			// ANNULATION
			$req = DbBuckutt::getInstance()->query("SELECT pur_price, usr_id_buyer, usr_id_seller, pur_date, pur_removed, obj_id FROM t_purchase_pur WHERE pur_id = %u",array($purchase_id));
			$res = DbBuckutt::getInstance()->fetchArray($req);
			$seller = $this->Seller->getIdentity();
			if($res["usr_id_seller"] != $seller[0]) {
				Log::warn("cancel($purchase_id) : No right to cancel this");
				return array("error"=>400, "error_msg"=>"Tu ne peux pas annuler la vente d'un autre vendeur.");
			}
			if($res["pur_removed"] == 1) {
				Log::warn("cancel($purchase_id) : Already cancelled");
				return array("error"=>400, "error_msg"=>"Cette vente à déjà été annulé...");
			}
			// TODO CHECK TIME
			DbBuckutt::getInstance()->query("UPDATE t_purchase_pur SET pur_removed='1' WHERE pur_id='%u';", Array($purchase_id));
			DbBuckutt::getInstance()->query("UPDATE ts_user_usr SET usr_credit = (usr_credit + '%u') WHERE usr_id='%u';", Array($res["pur_price"], $res["usr_id_buyer"]));
			DbBuckutt::getInstance()->query("UPDATE t_object_obj SET obj_stock = (obj_stock + 1) WHERE obj_id='%u';", Array($res["obj_id"]));

		} else {
			Log::warn("cancel($purchase_id) : No Seller loaded");
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
            try {
                $buyer = User::getUserFromBadge($badge_id);
            }
            catch(UserNotFound $ex) {
                Log::warn("transaction($fun_id, $badge_id, $obj_ids) : User not found");
				return array("error"=>400, "error_msg"=>"Le Badge n'a pas été reconnu..."); 
            }

            // Vérifier que la carte n'est pas bloquée
            try {
                $buyer->checkNotBlockedMe();
            }
            catch(UserIsBlockedException $ex) {
                Log::warn("transaction($fun_id, $badge_id, $obj_ids) : Blocked card");
				return array("error"=>403, "error_msg"=>"Ce badge à été bloqué. Il faut que l'utilisateur aille le débloquer sur internet.");
            }
            			
			// vérifier que l'utilisateur n'est pas bloqué sur cette fondation
			try {
				$buyer->checkNotBlockedFun($this->Fun_id);
			}
			catch (UserIsBlockedException $e) {
				Log::warn("transaction($badge_id, $obj_ids) : Blocked user ({$e->getMessage()})");
				return array("error"=>402, "error_msg"=> $e->getMessage());
			}

			// Verifier que les objets sont en vente (+ leurs prix)
			// ON a déjà vérifier la liaison POI <=> Fundation <=> USER
			// On vérifie que le produit fait bien partie de la fundation
			// TODO : Vérifier la plage_horaire, le groupe alcool etc...
			$objects_ids = explode(" ", trim($obj_ids));
			$obj_ids = array_unique($objects_ids);
			$req = "SELECT o.obj_id, o.obj_name, o.obj_stock, o.obj_type, o.obj_alcool, p.pri_credit
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
			$res = DbBuckutt::getInstance()->query($req, array_merge(array($this->Fun_id),$obj_ids));
			$articles = array();
			$alcool = false;
	        while ($don = DbBuckutt::getInstance()->fetchArray($res)) 
	        	{ 
	        		if($don['obj_alcool'] > 0) { $alcool = true; }
	        		$articles[$don['obj_id']] = $don;
	        	}

	        $total = 0;
	        foreach($objects_ids as $obj_id)
	        {
	        	if(isset($articles[$obj_id]))
	        	{
	        		$total += $articles[$obj_id]['pri_credit'];
	        	} else {
					Log::warn("transaction($badge_id, $obj_ids) : $obj_id is unavailable");
	        		return array("error"=>400, "error_msg"=>"L'article $obj_id n'est pas disponible à la vente.");
	        	}
	        }

	        // Si alcool, vérifier que le buyer est majeur
	        if($alcool) 
	        {
	        	if($buyer->isAdult() == 0) {
					Log::warn("transaction($badge_id, $obj_ids) : Under-18 users can't buy alcohol");
					return array("error"=>400, "error_msg"=>":".$buyer->isAdult().":L'utilisateur est mineur il ne peut pas acheter d'alcool !", "usr_info"=>array("firstname"=>$buyer->getFirstname(), "lastname"=>$buyer->getLastname(), "solde"=>$buyer->getCredit()));
				}
	        }

			// Verifier que le buyer a assez d'argent
	        if($buyer->getCredit() < $total) {
				Log::warn("transaction($badge_id, $obj_ids) : Buyer have not enough money");
	        	return array("error"=>400, "error_msg"=>"L'utilisateur n'a pas assez d'argent pour effectuer la transaction.", "usr_info"=>array("firstname"=>$buyer->getFirstname(), "lastname"=>$buyer->getLastname(), "solde"=>$buyer->getCredit()));
			}

			// Effectuer les achats
	        DbBuckutt::getInstance()->query("UPDATE ts_user_usr SET usr_credit = (usr_credit - '%u') WHERE usr_id='%u';", Array($total, $buyer->getId())); // TODO AJOUTER LA METHODE DANS LA CLASSE USER.
			
			foreach($objects_ids as $obj_id)
	        {
	        	// TODO FACTORISER L'INSERT
	        	DbBuckutt::getInstance()->query(("INSERT INTO t_purchase_pur (pur_date, pur_type, obj_id, pur_price, usr_id_buyer, usr_id_seller, poi_id, fun_id, pur_ip) VALUES (NOW(), '%s', '%u', '%u', '%u', '%u', '%u', '%u', '%s')"), 
	        		array("product", $obj_id, $articles[$obj_id]['pri_credit'], $buyer->getId(), $this->Seller->getId(), $this->Point_id, $this->Fun_id, $this->getRemoteIp()));
	        	DbBuckutt::getInstance()->query("UPDATE t_object_obj SET obj_stock= (obj_stock - 1) WHERE obj_id='%u';", Array($obj_id));
	        }

	        // REtourner les infos sur l'utilisateur
	        $msg = $buyer->getMsgPerso($this->Fun_id);
            
	        return array("success"=>array("firstname"=>$buyer->getFirstname(), 
	        							  "lastname"=>$buyer->getLastname(), 
	        							  "solde"=>$buyer->getCredit(),
	        							  "msg_perso"=>$msg));


		}
		else {
			Log::warn("transaction($badge_id, $obj_ids) : No Seller loaded");
			return array("error"=>400, "error_msg"=>"Il n'y a pas de seller chargé.");
		}
	}
	
	/**
	 * Récupérer les infos sur une image.
	 * 
	 * @param int $img_id
	 * @param int $outw Largeur de l'image
	 * @param int $outh Hauteur de l'image
	 * @return array $csv
	 */
	public function getImage64($img_id, $outw = 0, $outh = 0) {
		// Récupération de l'objet image
		$image = new Image($img_id);

        // Vérifie que l'image existe bien
        if($image->getState() != 1) {
			Log::warn("getImage64($img_id, $outw, $outh) : No image found");
            return array("error"=>400, "error_msg"=>"Image non trouvée.");
        }
		
		// Création de l'image GD originale
		$oldgd = imagecreatefromstring($image->getContent());
		
		// Handle no resize
		if($outw == 0)
			$outw = imagesx($oldgd);
		if($outh == 0)
			$outh = imagesy($oldgd);
		
		// Création de l'image GD à sortir
		$newgd = imagecreatetruecolor($outw, $outh);
		
		// Redimensionnement
		imagecopyresampled($newgd, $oldgd, 0, 0, 0, 0, $outw, $outh, imagesx($oldgd), imagesy($oldgd));
		
		// Récupération et encodage en base64
		ob_start();
		imagepng($newgd);
		$output = base64_encode(ob_get_contents());
		ob_end_clean();
		
		// Retour s'il y a une image correcte
		if($output != false)
			return array("success"=> $output);
		else {
			Log::warn("getImage64($img_id, $outw, $outh) : No image found");
			return array("error"=>400, "error_msg"=>"Image non trouvée.");
		}
	}
}

