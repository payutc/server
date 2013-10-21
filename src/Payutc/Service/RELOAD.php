<?php

namespace Payutc\Service;

use \Payutc\Config;

/**
 * RELOAD.php
 * 
 * Ce service expose les méthodes pour permettre d'effectuer le rechargement d'un compte utilisateur. 
 *
 */
 
class RELOAD extends \ServiceBase {
     
	/**
	* Retourne les infos utiles pour recharger (Min recharge, Max recharge, Can reload (true/false) 
	* @return array
	*/
    public function info() {
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, null);
        // on a un user ?
        if(!$this->user()) {
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur ! (method loginCas)");
        }
        
        // Check that the user can reload
        $this->user()->checkReload();
        
		return array(
		    "min" => Config::get('rechargement_min', 1000),
		    "max_credit" => Config::get('credit_max', 10000),
		    "max_reload" => Config::get('credit_max', 10000) - $this->user()->getCredit()
        );
	}

    /**
    * Fonction pour recharger un client.
    * 
    * @param int $amount (en centimes)
    * @param String $callbackUrl
    * @return String $url
    */
    public function reload($amount, $callbackUrl) {
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, null);
        // On a un user ?
        if(!$this->user()) {
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur !");
        }
        // Verification de la possiblité de recharger
        $this->user()->checkReload($amount);

        $pl = new \Payutc\Bom\Payline($this->application()->getId(), $this->service_name);
        return $pl->doWebPayment($this->user(), $amount, $callbackUrl);
    }
	
 }
