<?php

namespace Payutc\Service;

/**
 * MYACCOUNT.php
 * 
 * Ce service permet la gestion du compte d'un utilisateur
 * (Visualisation de l'historique, Blocage/Déblocage de sa carte)
 */
 
class MYACCOUNT extends \ServiceBase {
     
	/**
	* Recupere l'historique d'un utilisateur (+ son solde pour éviter une requete a casper)
	* @return array historique de l'utilisateur (+ son solde)
	*/
	public function historique() {
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, null);
        // On a un user ?
        if(!$this->user()) {
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur ! (method loginCas)");
        }
        
        // Verification de rechargement en cours (utile surout quand les notifications ne marchent pas (genre en dev))
        $pl = new \Payutc\Bom\Payline($this->application()->getId(), $this->service_name);
        $pl->checkUser($this->user());
        
        return array(
            "historique" => $this->user()->getHistorique(),
            "credit" => $this->user()->getCredit());
	}
	
	/**
	* Definit le blocage de la carte de l'utilisateur (par lui même, en cas de perte par exemple)
	* @param int (0/1)
	*/
	public function setSelfBlock($blocage) {
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, null);
        // On a un user ?
        if(!$this->user()) {
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur ! (method loginCas)");
        }
        
        $this->user()->setSelfBlock($blocage);
        
        return $this->isBlockedMe();
    }
    
    /**
    * Self-blocked ?
    * 
    * @return isBlocked ?
    */
    public function isBlockedMe() {
        // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, null);
        // On a un user ?
        if(!$this->user()) {
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur ! (method loginCas)");
        }
        
        return $this->user()->isBlockedMe();
    }
	
	
 }
