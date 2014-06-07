<?php

namespace Payutc\Service;

use \Payutc\Bom\Notification;
use \Payutc\Config;
use \Payutc\Log;

class NOTIFICATIONS extends \ServiceBase {
    /**
     * Associe un nouvel appareil à l'utilisateur connecté
     * Il faut connecter un utilisateur avec loginCAS avant d'appeler cette méthode
     * string $type : type de l'appareil ('iOS' ou 'Android' pour le moment)
     * string $token : jeton d'authentification spécifique à l'appareil
     */
    public function addDevice($type, $token) {
        $this->checkRight(false, false, false);
        Notification::addDevice($type, $token, $this->user());
    }
}

