<?php

namespace Payutc\Service;

use \Payutc\Config;
use \Payutc\Bom\Transaction;
use \Payutc\Exception\PayutcException;
use \Payutc\Exception\TransactionNotFound;

/**
 * WEBSALE.php
 * 
 * Ce service permet à une application d'effectuer des ventes par internet 
 *
 */
 
class WEBSALE extends \ServiceBase {
     
	/**
	* Crée une transaction 
	* $objs = [[id, qte], ...]
	* $fun_id = Fundation qui réalise la vente
	* $mail = mail de l'acheteur
	* $retour_url = URL ou l'on doit revenir à la fin de la transaction
	* $callback_url = URL de callback (à la fin de la transaction on vient dire coucou à l'application avec le tr_id)
	* @return array
	*/
    public function createTransaction($items, $fun_id, $mail, $return_url, $callback_url=null) {
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, $fun_id);
        
        // Verifions que les parametres sont a peu pres cohérents
        $objects = json_decode($items);
        if(!is_array($objects)) {
            throw new PayutcException("Erreur de parametre");
        }
                
        // Get the service url of application with WEBSALECONFIRM right
        $app = new \Application();
        $app->fromRight("WEBSALECONFIRM");
        $app_url = $app->getUrl();
        
        // Create the transaction, get transaction ID, and token
        $transaction = Transaction::create(
            null, // Buyer
            null, // Seller
            $this->application()->getId(), // appId
            $fun_id, // funId
            $objects, // objects
            $callback_url, // callbackUrl
            $return_url); // returnUrl

        $transaction->setEmail($mail);
        $tra_id = $transaction->getId();
        $token_id = $transaction->getToken();
        
		return array(
		    "tra_id" => $tra_id,
		    "url" => $app_url . "validation?tra_id=" . $tra_id . "&token=" . $token_id
		);
	}

    /**
    * Fonction pour recupérer le statut d'une transaction
    * 
    * @param int $fun_id (check de la fundation)
    * @param int $tra_id (id de la transaction a checker)
    * @return array
    */
    public function getTransactionInfo($fun_id, $tra_id) {
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, $fun_id);
        
        // Get info on this transaction
        $transaction = Transaction::getById($tra_id);
        
        // Check fun_id is correct
        if($fun_id != $transaction->getFunId()) {
            throw new TransactionNotFound("La transaction $tra_id n'existe pas");
        }
        
        return array(
            "id" => $tra_id,
            "status" => $transaction->getStatus(),
            "purchases" => $transaction->getPurchases(),
            "created" => $transaction->getDate()
        );
    }
	
 }
