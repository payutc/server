<?php

namespace Payutc\Service;

/**
* MESSAGE.services.php
*
* Ce service permet de changer le message perso d’une fundation par ses administrateurs
*
*/

class MESSAGE extends \ServiceBase {

    public function __construct() {
        parent::__construct();
    }

/**
* Retourne le message perso actuel de la fundation
*/
    public function getCurrentMsg($fun_id) {
        $this->checkRight(true, true, true, $fun_id);
        return \Payutc\Bom\MsgPerso::getMsgPerso(NULL, $fun_id);
    }

/**
* Change le message de la fundation
*/
    public function changeMsg($fun_id, $message) {
        $this->checkRight(true, true, true, $fun_id);
        return \Payutc\Bom\MsgPerso::setMsgPerso($message, NULL, $funId);
    }

}
