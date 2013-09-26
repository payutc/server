<?php

namespace Payutc\Service;

use \Payutc\Bom\Purchase;
use \Payutc\Bom\Product;
use \Payutc\Exception\PossException;
use \Payutc\Exception\UserNotFound;
use \Payutc\Exception\UserIsBlockedException;
use \Payutc\Bom\User;
use \Payutc\Config;
use \Payutc\Log;

class POSS3 extends \ServiceBase {
    
    /**
     * Obtenir les infos d'un buyer 
     *
     * @param String $badge_id
     * @return array $state
     */
    public function getBuyerInfo($badge_id) {
        $this->checkRight(true, true);

        // Verifier que le buyer existe
        try {
            $buyer = User::getUserFromBadge($badge_id);
        }
        catch(UserNotFound $ex) {
            Log::warn("getBuyerInfo($badge_id) : User not found");
            throw new PossException("Ce badge n'a pas été reconnu");
        }

        // Vérifier que la carte n'est pas bloquée
        try {
            $buyer->checkNotBlockedMe();
        }
        catch(UserIsBlockedException $ex) {
            Log::warn("getBuyerInfo($badge_id) : Blocked card");
            throw new PossException("Ce badge à été bloqué : son propriétaire doit le débloquer sur son interface de gestion");
        }

        return array(
            "firstname"=>$buyer->getFirstname(), 
            "lastname"=>$buyer->getLastname(), 
            "solde"=>$buyer->getCredit(),
            "last_purchases"=>$buyer->getLastPurchases()
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
     * @param String $obj_ids list of ids separated by a space or json : [[id1, qte1], [id2, qt2], ...]
     * @return array $state
     */
    public function transaction($fun_id, $badge_id, $obj_ids) {
        $this->checkRight(true, true, true, $fun_id);

        // Verifier que le buyer existe
        try {
            $buyer = User::getUserFromBadge($badge_id);
        }
        catch(UserNotFound $ex) {
            Log::warn("transaction($fun_id, $badge_id, $obj_ids) : User not found");
            throw new PossException("Ce badge n'a pas été reconnu");
        }

        // Vérifier que la carte n'est pas bloquée
        try {
            $buyer->checkNotBlockedMe();
        }
        catch(UserIsBlockedException $ex) {
            Log::warn("transaction($fun_id, $badge_id, $obj_ids) : Blocked card");
            throw new PossException("Ce badge à été bloqué : son propriétaire doit le débloquer sur son interface de gestion");
        }
        
        // vérifier que l'utilisateur n'est pas bloqué sur cette fondation
        try {
            $buyer->checkNotBlockedFun($fun_id);
        }
        catch (UserIsBlockedException $e) {
            Log::warn("transaction($fund_id, $badge_id, $obj_ids) : Blocked user ({$e->getMessage()})");
            throw new PossException($e->getMessage());
        }

        // tranformer la chaine passee en un array exploitable
        // il y a deux formats : ids séparés par des espaces (pas de quantités) ou json
        $objects = json_decode($obj_ids);
        if (is_null($objects)) { // espaces
            $objects_ids = explode(" ", trim($obj_ids));

            $objects = array();
            foreach ($objects_ids as $id) {
                $objects[] = array($id, 1);
            }
        } else {
            $objects_ids = array();
            foreach($objects as $object) {
                $objects_ids[] = $object[0];
            }
        }

        // récupérer les objets dans la db (note: pas de doublon)
        $r = Product::getAll(array('obj_ids'=>array_unique($objects_ids), 'fun_ids'=>array($fun_id)));
        $items = array();
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
        // si alcool, vérifier que le buyer est majeur
        if($alcool)
            {
                if($buyer->isAdult() == 0) {
                    Log::warn("transaction($badge_id, $obj_ids) : Under-18 users can't buy alcohol");
                    throw new PossException($buyer->getNickname()." est mineur il ne peut pas acheter d'alcool !");
                }
            }

        // calcul le prix total et création de la liste des items à acheter (note: il peut y avoir des doublons)
        $total = 0;
        $items_to_buy = array();
        foreach($objects as $object)
            {
                if(isset($items[$object[0]]))
                    {
                        if (count($object) > 1 && !empty($object[1]) && $object[1] > 0) {
                            $item = $items[$object[0]];
                            $item['qte'] = $object[1];
                            $items_to_buy[] = $item;
                        } else {
                            Log::warn("transaction($fun_id, $badge_id, $obj_ids) : Null quantity for article $object[0]");
                            throw new PossException("La quantité pour l'article est $object[0] nulle.");
                        }
                        $total += $item['price'] * $item['qte'];
                    } else {
                    Log::warn("transaction($badge_id, ...) : ${object[0]} is unavailable");
                    throw new PossException("L'article ${object[0]} n'est pas disponible à la vente.");
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


