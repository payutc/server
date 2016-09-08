<?php


namespace Payutc\Service;

/**
 * RELOAD.php
 * 
 * Ce service expose les méthodes pour permettre d'effectuer le rechargement d'un compte utilisateur. 
 *
 */
class RELOADPAPERCUT extends \ServiceBase {
    /**
    * Fonction pour recharger un client.
    * 
    * @param int $amount (en centimes)
    * @return int $amount en centimes
    */
    public function reload_papercut($amount) {
        // On a une appli qui a les droits ?
       
        $this->checkRight(false, true, true, null);
        // On a un user ?
        if(!$this->user()) {
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur !");
        } 

        // Verification de la possiblité de recharger
        if(!is_numeric($amount))
            throw new \Payutc\Exception\TransferException("Mauvais montant entré");
        else
            $amount *= 1;

        return $this->user()->reloadPapercut($amount);
    }
	
 }  
