<?php

namespace Payutc\Service;

/**
 * TRANSFER.php
 * 
 * Ce service permet d'effectuer des virements. 
 *
 */
 
class TRANSFER extends \ServiceBase {
     
	/**
	* Faire un virement à quelqu'un
	* @param int $amount en centimes
	* @param int $userID userID a qui on vire l'argent
	* @param string $message message a mettre avec le virement
	* @return 1 or exception
	*/
	public function transfer($amount, $userID, $message="") {
	    // On a une appli qui a les droits ?
        $this->checkRight(false, true, true, null);
        // on a un user ?
        if(!$this->user()) {
            throw new \Payutc\Exception\CheckRightException("Vous devez connecter un utilisateur ! (method loginCas)");
        }
        
        return $this->user()->transfer($amount, $userID, $message);
	}
 }
