<?php

namespace Payutc\Service;

use \Payutc\Config;

/**
 * WEBSALE.php
 * 
 * Ce service permet à une application d'effectuer des ventes par internet 
 *
 */
 
class WEBSALE extends \ServiceBase {
     
	/**
	* Crée une transaction 
	* $objs = array( array($id_article => $qte), ... );
	* $fun_id = Fundation qui réalise la vente
	* $retour_url = URL ou l'on doit revenir à la fin de la transaction
	* $callback_url = URL de callback (à la fin de la transaction on vient dire coucou à l'application avec le tr_id)
	* @return array
	*/
    public function CreateTransaction($items, $funId, $returnUrl, $callbackUrl=null) {
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, $funId);
        
        // Create the transaction, get transaction ID, and token
        $transaction = \Payutc\Bom\Transaction::createTransaction(null, null, $this->application()->getId(), $this->getRemoteIp(), $items, $callbackUrl, $returnUrl)
        $tr_id = $transaction->getId();
        $token_id = $transaction->getToken();
        
        // Get the service url of application with WEBSALECONFIRM right
        $app = new \Application();
        $app->fromRight("WEBSALECONFIRM");
        $app_url = $app->getUrl();
        
		return array(
		    "tr_id" => $tr_id,
		    "url" => $app_url . "validation/" . $tr_id . "/" . $token_id
		);
	}

    /**
    * Fonction pour recupérer le statut d'une transaction
    * 
    * @param int $fun_id (check de la fundation)
    * @param int $tr_id (id de la transaction a checker)
    * @return array
    */
    public function GetTransactionInfo($fun_id, $tr_id) {
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, $fun_id);
        
        // Get info on this transaction
        $transaction = \Payutc\Bom\Transaction::getById($tr_id);
        
        // Check fun_id is correct
        if($fun_id != $transaction->getFunId()) {
            throw new \Payutc\Exception\TransactionNotFound("La transaction $idTrans n'existe pas");
        }
        
        return array(
            "id" => $tr_id,
            "status" => $transaction->getStatus(),
            "purchases" => $transaction->getPurchases(),
            "created" => $transaction->getDate()
        );
    }
	
 }