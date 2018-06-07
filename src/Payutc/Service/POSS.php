<?php

namespace Payutc\Service;

use \Payutc\Bom\Purchase;
use \Payutc\Bom\Product;
use \Payutc\Bom\Category;
use \Payutc\Bom\Transaction;
use \Payutc\Exception\PossException;
use \Payutc\Exception\UserNotFound;
use \Payutc\Exception\UserIsBlockedException;
use \Payutc\Bom\User;
use \Payutc\Config;
use \Payutc\Log;
use \Payutc\Db\Dbal;

class POSS extends \ServiceBase {

    protected function shouldICheckUser() {
        return true;
    }

    /**
     * Obtenir les infos d'un buyer
     *
     * @param String $badge_id
     * @return array $state
     */
    public function getBuyerInfo($buyer) {
        $this->checkRight($this->shouldICheckUser(), true);

        // Vérifier que la carte n'est pas bloquée
        try {
            $buyer->checkNotBlockedMe();
        }
        catch(UserIsBlockedException $ex) {
            Log::warn("getBuyerInfo(".$buyer->getId().") : Blocked card");
            throw new PossException("Ce badge à été bloqué : son propriétaire doit le débloquer sur son interface de gestion");
        }

        return array(
            "firstname"=>$buyer->getFirstname(),
            "lastname"=>$buyer->getLastname(),
            "solde"=>$buyer->getCredit(),
            "credit_ecocup"=>$buyer->getCreditEcocup(),
            "last_purchases"=>$buyer->getLastPurchases()
        );
    }

    public function getArticles($fun_id) {
        $this->checkRight($this->shouldICheckUser(), true, true, $fun_id);
        return Product::getAll(array('fun_ids'=>array($fun_id), 'service' => 'Mozart'));
    }

    public function getCategories($fun_id) {
        $this->checkRight($this->shouldICheckUser(), true, true, $fun_id);
        return Category::getAll(array('fun_ids'=>array($fun_id), 'service' => 'Mozart'));
    }

    /** Annulation d'un achat
     * 1. Récupére l'achat
     * 2. Vérifie que le vendeur est le bon, ainsi que la vente à été réalisé il y'a moins de X temps
     * 3. Annule la vente et recrédite
     * @param int $pur_id
     * @return bool
     */
    public function cancel($fun_id, $pur_id) {
        $this->checkRight($this->shouldICheckUser(), true, true, $fun_id);

        // ANNULATION
        // pur_id, tra_id, obj_id, pur_qte, pur_unit_price, pur_reduction, ...
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

        global $_CONFIG;
        if ($pur['obj_id']*1 == $_CONFIG["ecocup"]['return']*1) {
            // On annule un retour: on retire les ecocup en réserver pour le gars !
            $userCredit = User::getCreditEcocupById($pur["usr_id_buyer"]);
            User::updateCreditEcocupById($userCredit-$pur["pur_qte"], $pur["usr_id_buyer"]);
        } else if ($pur['obj_id']*1 == $_CONFIG["ecocup"]['buy']*1 && $pur['pur_reduction']*1 == 1) {
            // On annule un retrait d'écocups de la réserve, faqu'on les remet en réserve
            $userCredit = User::getCreditEcocupById($pur["usr_id_buyer"]);
            User::updateCreditEcocupById(min(4, $userCredit+$pur["pur_qte"]), $pur["usr_id_buyer"]);
        }

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
    public function transaction($fun_id, $buyer, $obj_ids) {
        $this->checkRight($this->shouldICheckUser(), true, true, $fun_id);

        // Vérifier que la carte n'est pas bloquée
        try {
            $buyer->checkNotBlockedMe();
        } catch(UserIsBlockedException $ex) {
            Log::warn("transaction($fun_id, $buyer, $obj_ids) : Blocked card");
            throw new PossException("Ce badge à été bloqué : son propriétaire doit le débloquer sur son interface de gestion");
        }

        // vérifier que l'utilisateur n'est pas bloqué sur cette fondation
        try {
            $buyer->checkNotBlockedFun($fun_id);
        } catch (UserIsBlockedException $e) {
            Log::warn("transaction($fun_id, $buyer, $obj_ids) : Blocked user ({$e->getMessage()})");
            throw new PossException($e->getMessage());
        }

        // tranformer la chaine passee en un array exploitable
        // il y a deux formats : ids séparés par des espaces (pas de quantités) ou json array d'arrays (id_product, qte, %reduction)
        // $objects est un array de array($idProduct, $qte, $reduc)
        $objects = json_decode($obj_ids);
        Log::debug('decoded objects', array('objects' => $objects));

        if (!is_array($objects)) {
            $objects_ids = explode(" ", trim($obj_ids));
            $objects = array();
            foreach ($objects_ids as $id)
                $objects[] = array($id, 1, null);
        }

        //////////////////////////////////
        // Fonction Bar Icam - eco cups //
        //////////////////////////////////
        global $_CONFIG;
        // $_CONFIG["ecocup"] = [ 'fun_id' => 2, 'buy' => 279, 'return' => 280, ];
        $ecocup = [ 'buy' => 0, 'return' => 0 ];

        foreach ($objects as $obj) {
            if ($fun_id == $_CONFIG["ecocup"]['fun_id']) {
                if ($obj[0] == $_CONFIG["ecocup"]['buy'])
                    $ecocup['buy'] += $obj[1];
                else if ($obj[0] == $_CONFIG["ecocup"]['return'])
                    $ecocup['return'] += $obj[1];
            }
        }

        if (!empty($ecocup['buy']) || !empty($ecocup['return'])) {
            function removeFromArray($objects, $objIDs) {
                $temp = [];
                foreach ($objects as $obj) {
                    if (!in_array($obj[0], $objIDs))
                        $temp[] = $obj;
                }
                return $temp;
            }
            $cur_ecocup = $buyer->getCreditEcocup();
            if ($ecocup['return'] + $cur_ecocup > 4)
                throw new PossException("Inutile, tu ne peux pas retourner plus de 4 écocup");
            if ($ecocup['buy'] > 0) {
                if ($ecocup['return'] > 0) { // faire la différence dans les écocup achetées & rendues !
                    $ecocup['return'] -= $ecocup['buy'];
                    if ($ecocup['return'] == 0) { // On achete pas d'écocup rien !
                        $objects = removeFromArray($objects, [$_CONFIG["ecocup"]['buy'], $_CONFIG["ecocup"]['return']]);
                        throw new PossException("Inutile, tu achètes autant d'écocup que tu en retournes");
                    } else if ($ecocup['return'] < 0) {
                        $ecocup['buy'] = abs($ecocup['return']);
                        $objects = removeFromArray($objects, [$_CONFIG["ecocup"]['return']]);
                    } else { // pas d'achat d'écocup !
                        $ecocup['buy'] = 0;
                        $objects = removeFromArray($objects, [$_CONFIG["ecocup"]['buy']]);
                    }
                }
                if ($ecocup['buy'] > 0) { // return est vide !
                    if ($cur_ecocup > 0) {
                        $new_count_ecocup = $cur_ecocup - $ecocup['buy'];
                        if ($new_count_ecocup == 0) { // On achete pas d'écocup rien !
                            $objects = removeFromArray($objects, [$_CONFIG["ecocup"]['buy']]);
                            // On retire l'achat d'ecocup plein prix & on achette des ecocup à 100% de réduction
                            $objects[] = array($_CONFIG["ecocup"]['buy'], $ecocup['buy'], 1);
                            $buyer->updateCreditEcocup(0);
                        } else if ($new_count_ecocup < 0) {
                            // On a vidé notre réserve écocup, et en plus on a racheté des écocup plein tarif
                            $objects = removeFromArray($objects, [$_CONFIG["ecocup"]['buy']]);
                            $objects[] = array($_CONFIG["ecocup"]['buy'], $ecocup['buy']+$new_count_ecocup, 1);
                            $objects[] = array($_CONFIG["ecocup"]['buy'], abs($new_count_ecocup), null);
                            $ecocup['buy'] = abs($new_count_ecocup);
                            $buyer->updateCreditEcocup(0);
                        } else { // On avait suffisament d'écocup en stock
                            $objects = removeFromArray($objects, [$_CONFIG["ecocup"]['buy']]);
                            $objects[] = array($_CONFIG["ecocup"]['buy'], $ecocup['buy'], 1);
                            $buyer->updateCreditEcocup($new_count_ecocup);
                            $ecocup['buy'] = 0;
                        }
                    }
                }
            }
            if ($ecocup['return'] > 0) {
                // On en retourne !
                $objects = removeFromArray($objects, [$_CONFIG["ecocup"]['return']]);
                $objects[] = array($_CONFIG["ecocup"]['return'], $ecocup['return'], null);
                $buyer->updateCreditEcocup($ecocup['return'] + $cur_ecocup);
            }
        }

        // Création de la transaction, validée immédiatement
        $tr = Transaction::createAndValidate($buyer, $this->user(),
                                             $this->application()->getId(),
                                             $fun_id, $objects);

        // Retourner les infos sur l'utilisateur
        $msg = $buyer->getMsgPerso($fun_id);

        return array("firstname"=>$buyer->getFirstname(),
                     "lastname"=>$buyer->getLastname(),
                     "solde"=>$buyer->getCredit(),
                     "msg_perso"=>$msg,
                     "transaction_id"=>$tr->getId(),
                     "purchases"=>$tr->getPurchases());
    }

    public function getImage64($img_id, $outw = 0, $outh = 0, $encode=true) {
        $r = parent::getImage64($img_id, $outw, $outh, $encode);
        if (array_key_exists('error_msg', $r)) {
            throw new Exception($r['error_msg']);
        }
        return $r['success'];
    }
}


