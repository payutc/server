<?php

namespace Payutc\Service;

use \Payutc\Config;
use \Payutc\Exception\PayutcException;
use \Payutc\Bom\Transaction;
use \Payutc\Bom\Product;
use \Payutc\Bom\Fundation;

/**
 * WEBSALECONFIRM.php
 * 
 * Ce service permet à un client (normalement casper) de venir valider un achat en ligne
 * A partir de websale, un site peut créer une transaction et inviter un utilisateur à payer en ligne 
 * Ce service va permettre au site sur lequel sera redirigé l'utilisateur de valider la transaction (et donc de la payer)
 */
 
class WEBSALECONFIRM extends \ServiceBase {
     
    /**
    * Fonction pour recupérer le statut d'une transaction
    * 
    * @param int $tra_id (id de la transaction a checker)
    * @return array
    */
    public function getTransactionInfo($tra_id, $token) {       
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, null);
        
        // Get info on this transaction
        $transaction = Transaction::getById($tra_id);
        
        if($transaction->getToken() != $token) {
            throw new PayutcException("Token non valide");
        }
        
        // Récupérer le nom de la fundation pour qu'on puisse afficher à qui l'utilisateur va payer.
        $fun = Fundation::getById($transaction->getFunId());
        $fun_name = $fun->getName();
        
        // Récupération du noms des articles
        $purchases = $transaction->getPurchases();
        $objects_ids = array();
        foreach($purchases as $purchase) {
            $objects_ids[] = $purchase['obj_id'];
        }
        
        $products = Product::getAll(array('itm_ids' => array_unique($objects_ids)));
        
        return array(
            "id" => $tra_id,
            "status" => $transaction->getStatus(),
            "purchases" => $purchases,
            "products" => $products,
            "created" => $transaction->getDate(),
            "total" => $transaction->getMontantTotal(),
            "fun_name" => $fun_name
        );
    }
    
    /**
    * Réalise la transaction, correspondante a la transaction id $tr_id
    *
    * Si un user est logged:
    *  - Si $montant_reload == 0
    *     - On valide la transaction
    *  - Sinon
    *     - On crée un rechargement payline, lié à cet user et à cette transaction
    * Sinon:
    *  - On crée un rechargement payline, qu'on associe uniquement à cette transaction.
    *  On utilise $mail pour indiquer le mail de l'achteur à payline
    */
    public function doTransaction($tra_id, $token, $montant_reload) {
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, null);
        
        $transaction = \Payutc\Bom\Transaction::getById($tra_id);
        
        if($transaction->getToken() != $token) {
            throw new PayutcException("Token non valide");
        }
        
        if($this->user()) {
            if($montant_reload == 0) {
                $transaction->validate();
                return $transaction->getReturnUrl();
            } else {
                // Verification de la possiblité de recharger
                $credit_max = Config::get('credit_max') + $transaction->getMontantTotal();
                
                $this->user()->checkReload($montant_reload, $credit_max);
                $pl = new \Payutc\Bom\Payline($this->application()->getId(), $this->service_name);
                return $pl->doWebPayment(
                    $this->user(), 
                    $transaction, 
                    $montant_reload, 
                    $transaction->getReturnUrl());
            }
        } else {
            $pl = new \Payutc\Bom\Payline($this->application()->getId(), $this->service_name);
            return $pl->doWebPayment(
                null, 
                $transaction, 
                $transaction->getMontantTotal(), 
                $transaction->getReturnUrl(),
                null,
                $mail);
        }
    }

	
 }
