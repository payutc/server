<?php

namespace Payutc\Service;

use \Payutc\Log;
use \Payutc\Exception\MessageUpdateFailedException;

/**
* MESSAGES.services.php
*
* Ce service permet de changer le message perso d’une fundation par ses administrateurs
* ou celui d’un utilisateur si celui-ci est loggé par l’application appelante
* 
* Pour les deux fonctions (get et set),
* il y a quatres comportements possibles en fonction des arguments fournis :
* 
* (usr_id, fun_id)  défini ou récupère le message de l’usr dans la fun précisée
* (usr_id, NULL)    défini ou récupère le message de l’usr par défaut
* (NULL, fun_id)    défini ou récupère le message de la fun par défaut
* (NULL, NULL)      récupère le message par défaut de payutc (impossible de le définir à travers l’API)
*
*/

class MESSAGES extends \ServiceBase {

    public function __construct() {
        parent::__construct();
    }

    /**
    * Retourne le message perso actuel d’un utilisateur ou d’une fundation
    */
    public function getMsg($usr_id=NULL, $fun_id=NULL) {
        return \Payutc\Bom\MsgPerso::getMsgPerso($usr_id, $fun_id);
    }

    /**
     * Change le message perso de l'utilisateur connecté
     */

    public function changeMyMsg($message, $fun_id=NULL) {

        if(!$this->user()) {
            throw new MessageUpdateFailedException("Vous devez connecter un utilisateur ! (method loginCas)");
        }
        
        return \Payutc\Bom\MsgPerso::setMsgPerso($message, $this->user()->getId(), $fun_id);
    }

    /**
    * Change le message d’un utilisateur ou d’une fundation
    */
    public function changeMsg($usr_id=NULL, $fun_id, $message) {
        if ($usr_id == NULL && $fun_id == NULL) {
            throw new MessageUpdateFailedException("Impossible de changer le message par défaut global à travers l’API");
        }

        if ($usr_id == NULL && $fun_id != NULL) {
            $this->checkRight(true, true, true, $fun_id);
        } else {
            $this->checkRight(false, false);
            if ($this->user()->getId() != $usr_id) {
                throw new MessageUpdateFailedException("On ne peut changer que son message perso, pas celui des autres ...");
            }
        }
        
        return \Payutc\Bom\MsgPerso::setMsgPerso($message, $usr_id, $fun_id);
    }

}
