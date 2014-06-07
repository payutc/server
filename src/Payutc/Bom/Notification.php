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
        
        $conn = Dbal::conn();
        $conn->beginTransaction();
        $qb = $conn->createQueryBuilder()
            ->select('not_id', 'not_user')
            ->from('t_notification_not', 'n')
            ->where('not_type LIKE :type AND not_token LIKE :token')
            ->setParameter('type', $type)
            ->setParameter('token', $token);
        $query = $qb->execute();
        
        if ($query->rowCount() == 0) {
            $conn->insert('t_notification_not',
                array('not_user' => $user->getId(),
                      'not_type' => $type,
                      'not_token' => $token
                     ),
                array('integer', 'string', 'string'));
            $id = $conn->lastInsertId();
        } else {
            $data = $query->fetch();
            if ($data['not_user'] != $user->getId()) {
                $conn->update('t_notification_not',
                    array('not_user' => $user->getId()),
                    array('not_id' => $data['not_id']),
                    array('integer', 'integer'));
            }
            $id = $data['not_id'];
        }
        $conn->commit();
        return $id;
    }
}
