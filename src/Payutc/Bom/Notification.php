<?php

/**
 * Blocked.class
 * 
 * Gestion des blocages
 * Table: tj_usr_fun_blocked_blo
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
        
        $qb = Dbal::conn()->createQueryBuilder()
            ->select('not_id')
            ->from('t_notification_not', 'n')
            ->where('not_user = :usr AND not_type LIKE :type AND not_token LIKE :token')
            ->setParameter('usr', $user->getId())
            ->setParameter('type', $type)
            ->setParameter('token', $token);
        $query = $qb->execute();
        
        if ($query->rowCount() == 0) {
            Dbal::conn()->insert('t_notification_not',
                array('not_user' => $user->getId(),
                      'not_type' => $type,
                      'not_token' => $token
                     ),
                array('integer', 'string', 'string'));
            return Dbal::conn()->lastInsertId();
        } else {
            $data = $query->fetch();
            return $data['not_id'];
        }
    }
}
