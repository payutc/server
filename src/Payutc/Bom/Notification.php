<?php

/**
 * Notification.class
 * 
 * Gestion des appareils à notifier
 * Table: t_notification_not
 */

namespace Payutc\Bom;
use \Payutc\Db\DbBuckutt;
use \Payutc\Db\Dbal;
use \Payutc\Exception\NotificationInvalidDeviceType;

class Notification {
    public static function addDevice($type, $token, $user) {
        if (!in_array($type, array("iOS", "Android"))) {
            throw new NotificationInvalidDeviceType("Choose between 'iOS' or 'Android'.");
        }
        
        try {
            Dbal::conn()->insert('t_notification_not',
                array('not_user' => 1,
                      'not_type' => $type,
                      'not_token' => $token
                     ),
                array('integer', 'string', 'string'));
            return Dbal::conn()->lastInsertId();
        } catch (\Doctrine\DBAL\DBALException $e) {
            if (strpos($e->getPrevious()->getMessage(), "Integrity constraint violation: 1062")) {
                return false;
            } else {
                throw $e;
            }
        }
    }
}
