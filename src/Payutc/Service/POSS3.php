<?php

namespace Payutc\Service;

use \Payutc\Bom\Purchase;
use \Payutc\Bom\Product;
use \Payutc\Exception\PossException;
use \User;
use \Payutc\Config;
use \Payutc\Log;

define('MEAN_OF_LOGIN_BADGE', 5);
define('MEAN_OF_LOGIN_NICKNAME', 1);

class POSS3 extends \ServiceBase {
    
    /**
     * Obtenir les infos d'un buyer 
     *
     * @param String $badge_id
     * @return array $state
     */
    public function getBuyerInfo($badge_id) {
        $this->checkRight(true, true);
        
        $buyer = new User($badge_id, MEAN_OF_LOGIN_BADGE, "", 0, 1, 1);
        $state = $buyer->getState();
        if($state == 403)
            throw new PossException("Ce badge à été bloqué. Il faut que l'utilisateur aille le débloquer sur internet.");
        if($state != 1)
            throw new PossException("Le Badge n'a pas été reconnu...");
        return array(
            "firstname"=>$buyer->getFirstname(), 
            "lastname"=>$buyer->getLastname(), 
            "solde"=>$buyer->getCredit(),
            "last_purchases"=>Purchase::getPurchasesForUser($buyer->getId(), 60*16)
        );
    }
    
    public function getArticles($fun_id)
    {
        $this->checkRight(true, true, true, $fun_id);
        return Product::getAll(array('fun_ids'=>array($fun_id,)));
    }
    
    
    /** Annulation d'un achat
     * 1. Récupére l'achat
     * 2. Vérifie que le vendeur est le bon, ainsi que la vente à été réalisé il y'a moins de X temps
     * 3. Annule la vente et recrédite
     * @param int $pur_id
     * @return bool
     */
    public function cancel($fun_id, $pur_id)
    {
        $this->checkRight(true, true, true, $fun_id);
        
        // ANNULATION
        $pur = Purchase::getPurchaseById($pur_id);
        $seller_id = $this->user()->getId();
        if($pur["usr_id_seller"] != $seller_id) {
            Log::warn("cancel($pur_id) : No right to cancel this");
            throw new PossException("Tu ne peux pas annuler la vente d'un autre vendeur.");
        }
        if($pur["pur_removed"] == 1) {
            Log::warn("cancel($pur_id) : Already cancelled");
            throw new PossException("Cette vente à déjà été annulé...");
        }
        Purchase::cancelById($pur_id);
        return true;
    }
    
    
    /**
     * Transaction complète,
     *         1. load le buyer
     *         2. multiselect
     *         3. endTransaction
     * @param String $badge_id
     * @param String $obj_ids
     * @return array $state
     */
    public function transaction($fun_id, $badge_id, $obj_ids) {
        $this->checkRight(true, true, true, $fun_id);

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
                throw new PossException("Badge introuvable");
            }
            if($user->login) {
                $buyer = new User($user->login, MEAN_OF_LOGIN_NICKNAME, "", 0, 1, 1);
                $state = $buyer->getState();
                if($state == 1) {
                    // UPDATE BADGE_ID
                    Db_buckutt::getInstance()->query("UPDATE tj_usr_mol_jum SET jum_data = '%s' WHERE usr_id='%u' AND mol_id='%u'", array($badge_id, $buyer->getId(), MEAN_OF_LOGIN_BADGE));
                } else {
                    Log::warn("transaction($badge_id, $obj_ids) : Ginger knows this card but Payutc does not");
                    throw new PossException("Le Badge n'a pas été reconnu...");
                }
            } else {
                Log::warn("transaction($badge_id, $obj_ids) : Unknown card");
                throw new PossException("Le Badge n'a pas été reconnu..."); 
            }
        }
    
        if($state == 403) {
            Log::warn("transaction($badge_id, $obj_ids) : Blocked card");
            throw new PossException("Ce badge à été bloqué. Il faut que l'utilisateur aille le débloquer sur internet.");
        }
        
        // vérifier que l'utilisateur n'est pas bloqué sur cette fondation
        try {
            $buyer->checkNotBlockedFun($fun_id);
        }
        catch (UserIsBlockedException $e) {
            Log::warn("transaction($badge_id, $obj_ids) : Blocked user ({$e->getMessage()})");
            throw new PossException($e->getMessage());
        }

        // récupérer les objets dans la db (note: pas de doublon)
        $objects_ids = explode(" ", trim($obj_ids));
        $r = Product::getAll(array('obj_ids'=>array_unique($objects_ids), 'fun_ids'=>array($fun_id)));
        $items = [];
        foreach($r as $itm) {
            $items[$itm['id']] = $itm;
        }
        
        // y'a t il de l'alcool ?
        $alcool = false;
        foreach($items as $itm) {
            if ($itm['alcool'] > 0) {
                $alcool = true;
                break;
            }
        }
        
        // calcul le prix total
        $total = 0;
        foreach($objects_ids as $obj_id)
        {
            if(isset($items[$obj_id]))
            {
                $total += $items[$obj_id]['price'];
            } else {
                Log::warn("transaction($badge_id, ...) : $obj_id is unavailable");
                throw new PossException("L'article $obj_id n'est pas disponible à la vente.");
            }
        }
        
        // création de la liste des items à acheter (note: il peut y avoir des doublons)
        $items_to_buy = array();
        foreach($objects_ids as $id) {
            $items_to_buy[] = $items[$id];
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
        Purchase::transaction($buyer->getId(), $items_to_buy,
                              $this->application()->getId(), $fun_id,
                              $this->user()->getId(), $this->getRemoteIp());

        // Retourner les infos sur l'utilisateur
        $msg = $buyer->getMsgPerso($fun_id);

        return array("firstname"=>$buyer->getFirstname(), 
                      "lastname"=>$buyer->getLastname(), 
                      "solde"=>$buyer->getCredit(),
                      "msg_perso"=>$msg);
    }

    public function getImage64($img_id, $outw = 0, $outh = 0)
    {
        $r = parent::getImage64($img_id, $outw, $outh);
        if (array_key_exists('error_msg', $r)) {
            throw new Exception($r['error_msg']);
        }
        return $r['success'];
    }
}


