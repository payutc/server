<?php

namespace Payutc\Service;

use \Payutc\Bom\Purchase;
use \Payutc\Exeption\PossException;

class POSS3 extends \ServiceBase {
    
    /**
     * Charge le Seller sans mot de passe.
     * 
     * @param   int     poi_id
     * @param   int     fun_id
     * @return  bool    state
    */
    public function loadPos($poi_id, $fun_id) {
        $this->checkRight(true, true, true, $fun_id);
        unload();
        $this->setPoiId($poi_id);
        $this->setFunId($fun_id);
        
        Log::info("loadPos(login=${this->user()->getNickname()}, poi_id=$poi_id, fun_id=$fun_id) : OK");
        return true;
    }
    
    public function isLoaded() {
        return ($this->getPoiId() !== null and $this->getFunId() !== null);
    }
    
    public function checkIsLoaded() {
        if (!$this->isLoaded()) {
            throw new PayutcException('POSS n\'est pas chargé');
        }
    }
    
    public function unloadPos() {
        $this->setPoiId(null);
        $this->setFunId(null);
        Log::info("unloadPos : OK");
        return true;
    }
    
    public function getSellerIdentity() {
        $this->checkIsLoaded();
        $this->checkRight(true, true, true, $this->getFunId());
        $user = $this->user();
        return array(
            "id" => $user->getId(),
            "firstname" => $user->getFirstname(),
            "lastname" => $user->getLastname(),
            "nickname" => $user->getNickname();
        );
    }
    
    /**
     * Obtenir les infos d'un buyer 
     *
     * @param String $badge_id
     * @return array $state
     */
    public function getBuyerInfo($badge_id) {
        $this->checkIsLoaded();
        $this->checkRight(true, true, true, $this->getFunId());
        
        $buyer = new User($badge_id, MEAN_OF_LOGIN_BADGE, "", 0, 1, 1);
        $state = $buyer->getState();
        if($state == 403)
            return array("error"=>403, "error_msg"=>"Ce badge à été bloqué. Il faut que l'utilisateur aille le débloquer sur internet.");
        if($state != 1)
            return array("error"=>400, "error_msg"=>"Le Badge n'a pas été reconnu...");
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
                                    "last_purchase"=>$buyer->getLastPurchase()
                            ));
    }
    
    
    /** Annulation d'un achat
     * 1. Récupére l'achat
     * 2. Vérifie que le vendeur est le bon, ainsi que la vente à été réalisé il y'a moins de X temps
     * 3. Annule la vente et recrédite
     * @param int $pur_id
     * @return bool
     */
    public function cancel($pur_id)
    {
        $this->checkIsLoaded();
        $this->checkRight(true, true, true, $this->getFunId());
        
        // ANNULATION
        $pur = Purchase::getPurchaseById($pur_id);
        $seller_id = $this->user()->getId();
        if($pur["usr_id_seller"] != $seller_id) {
            Log::warn("cancel($pur_id) : No right to cancel this");
            return array("error"=>400, "error_msg"=>"Tu ne peux pas annuler la vente d'un autre vendeur.");
        }
        if($pur["pur_removed"] == 1) {
            Log::warn("cancel($pur_id) : Already cancelled");
            return array("error"=>400, "error_msg"=>"Cette vente à déjà été annulé...");
        }
        Purchase::cancelById($pur_id);
        return true;
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
        $this->checkIsLoaded();
        $this->checkRight(true, true, true, $this->getFunId());
    
        $right_POI_FUNDATION = 7; // TODO IMPORTER D'AILLEURS

        // Verifier que le buyer existe
        $buyer = new User($badge_id, MEAN_OF_LOGIN_BADGE, "", 0, 1, 1);
        $state = $buyer->getState();
        $ginger_key = Config::get('ginger_key');
        if($state != 1 && !empty($ginger_key)) {
            // CHECK BADGE ID IN API
            $ginger = new \Ginger\Client\GingerClient(Config::get('ginger_key'));
            try {
                $user = $ginger->getCard($badge_id);
            }
            catch (\Exception $ex) {
                Log::warn("transaction($badge_id, $obj_ids) : Can't find card");
                return array("error"=>$ex->getCode(), "error_msg"=>"Badge introuvable");
            }
            if($user->login) {
                $buyer = new User($user->login, MEAN_OF_LOGIN_NICKNAME, "", 0, 1, 1);
                $state = $buyer->getState();
                if($state == 1) {
                    // UPDATE BADGE_ID
                    Db_buckutt::getInstance()->query("UPDATE tj_usr_mol_jum SET jum_data = '%s' WHERE usr_id='%u' AND mol_id='%u'", array($badge_id, $buyer->getId(), MEAN_OF_LOGIN_BADGE));
                } else {
                    Log::warn("transaction($badge_id, $obj_ids) : Ginger knows this card but Payutc does not");
                    return array("error"=>400, "error_msg"=>"Le Badge n'a pas été reconnu...");
                }
            } else {
                Log::warn("transaction($badge_id, $obj_ids) : Unknown card");
                return array("error"=>400, "error_msg"=>"Le Badge n'a pas été reconnu..."); 
            }
        }
    
        if($state == 403) {
            Log::warn("transaction($badge_id, $obj_ids) : Blocked card");
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

        // récupérer les objets dans la db (note: pas de doublon)
        $objects_ids = explode(" ", trim($obj_ids));
        $obj_ids = array_unique($objects_ids);
        $items = Product::getAll(array('obj_ids'=>$obj_ids, 'fun_ids'=>$fun_ids));
        
        // y'a t il de l'alcool ?
        $alcool = false;
        foreach($items as $itm) {
            if ($itm['obj_alcool'] > 0) {
                $alcool = true;
                break;
            }
        }
        
        // création de la liste des items à acheter (note: il peut y avoir des doublons)
        $items_to_buy = array();
        foreach($objects_ids as $id) {
            $items_to_buy[] = $items[$id];
        }
        
        // calcul le prix total
        $total = 0;
        foreach($objects_ids as $obj_id)
        {
            if(isset($articles[$obj_id]))
            {
                $total += $articles[$obj_id]['pri_credit'];
            } else {
                Log::warn("transaction($badge_id, $obj_ids) : $obj_id is unavailable");
                throw new PossException("L'article $obj_id n'est pas disponible à la vente.");
            }
        }
        
        // si alcool, vérifier que le buyer est majeur
        if($alcool) 
        {
            if($buyer->isAdult() == 0) {
                Log::warn("transaction($badge_id, $obj_ids) : Under-18 users can't buy alcohol");
                throw new PossException($buyer->getNickname()." est mineur il ne peut pas acheter d'alcool !");
            }
        }

        // vérifier que le buyer a assez d'argent
        if($buyer->getCredit() < $total) {
            Log::warn("transaction($badge_id, $obj_ids) : Buyer have not enough money");
            throw new PossException($buyer->getNickname()." n'a pas assez d'argent pour effectuer la transaction.");
        }
        
        // effectuer les achats
        Purchase::transaction($buyer->getId(), $items_to_buy, $this->getFunId(),
                            $this->user()->getId(), $this->getRemoteIp());

        // Retourner les infos sur l'utilisateur
        $msg = $buyer->getMsgPerso($this->getFunId());
        if($msg == "") {
            $msg = "PICASSO-P13 ::: Dis Coucou aux Poissons !";
        }

        return array("firstname"=>$buyer->getFirstname(), 
                      "lastname"=>$buyer->getLastname(), 
                      "solde"=>$buyer->getCredit(),
                      "msg_perso"=>$msg);
	}
    
    public function getPoiId() {
        return $this->sessionGet('poi_id');
    }
    
    public function setPoiId($val) {
        $this->sessionSet('poi_id', $val);
    }
    
    public function getFunId() {
        return $this->sessionGet('fun_id');
    }
    
    public function setFunId($val) {
        $this->sessonSet('fun_id', $val);
    }
}


