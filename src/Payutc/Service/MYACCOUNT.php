<?php

namespace Payutc\Service;

use \Payutc\Exception\UserNotFound;
use \Payutc\Exception\PayutcException;
use \Payutc\Bom\User;
use \Payutc\Log;

/**
 * MYACCOUNT.php
 * 
 * Ce service permet la gestion du compte d'un utilisateur
 * (Visualisation de l'historique, Blocage/Déblocage de sa carte)
 */
 
class MYACCOUNT extends \ServiceBase {
     
    /**
	 * Connecter le user avec un ticket CAS.
	 * 
	 * @param String $ticket
	 * @param String $service
	 * @return bool $success
	 */
    public function loginCas($ticket, $service) {
        try {
            return parent::loginCas($ticket,$service);
        } catch (UserNotFound $ex) {
            $this->sessionSet('login_to_register', $ex->login);
            throw $ex;
        }
    }

    /**
    * Enregistre un nouvel utilisateur (signifie qu'il a signé la charte sur CASPER)
    */
    public function register() {
        $login = $this->sessionGet('login_to_register', null);
        if(!empty($login)) {
            throw new PayutcException("Pas de login à enregistrer");
        }

        try {
            $user = new User($login);
            throw new PayutcException("Le user existe déjà");
        }
        catch(UserNotFound $ex){
            // This is normal, it's even what we want
        }

        // On créé le user et on lui ajoute son crédit
        try {
            $user = User::createAndGetNewUser($login);
        }
        catch (\Exception $ex){
            Log::error("Impossible de créer le user $login: ".$ex->getMessage());
            throw new PayutcException("Le user n'a pas pu être chargé");
        }
        
        // Save user in session for all service
        $_SESSION['ServiceBase']['user'] = $user;
        return $user->getNickname();
    }

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
