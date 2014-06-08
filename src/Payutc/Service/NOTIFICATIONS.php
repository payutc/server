<?php

namespace Payutc\Service;

use \Payutc\Bom\Notification;
use \Payutc\Bom\Task;
use \Payutc\Exception\UserError;
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
        $this->checkRight(false, true, false);

        if ($this->user() === null) {
            throw new UserError('No user connected');
        }

        $id = Notification::addDevice($type, $token, $this->user());
        if ($id) {
            Task::addNotification("Votre appareil recevra maintenant des notifications", $this->user());
        }
        return true;
    }
}

