<?php

/**
 * Notification.class
 * 
 * Gestion des appareils à notifier
 * Table: t_notification_not
 */

namespace Payutc\Bom;
use \Payutc\Exception\NotImplemented;
use \Payutc\Exception\MissingConfiguration;
use \Payutc\Exception\NotificationInvalidDeviceType;
use \Payutc\Db\Dbal;
use \Payutc\Config;
use \Httpful\Request;

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
    
    public static function send($user_id, $message) {
        $qb = Dbal::conn()->createQueryBuilder()
            ->select('not_token', 'not_type')
            ->from('t_notification_not', 'n')
            ->where('not_user = :user')
            ->setParameter('user', $user_id)
            ->execute();

        while ($device = $qb->fetch()) {        
            switch($device['not_type']) {
            case 'Android':
                return Notification::sendToAndroid($device['not_token'], $message);
                break;
            default:
                throw new NotImplement("DeviceType : " . $device['not_type']);
            }
        }
    }
    
    protected static function sendToAndroid($token, $message) {
        $key = Config::get('google_api_key');
        if ($key === null) {
            throw new MissingConfiguration('google_api_key');
        }
        
        $res = Request::post('https://android.googleapis.com/gcm/send')
            ->useProxy(Config::get('proxy_host'), Config::get('proxy_port'), null,
                       Config::get('proxy_login'), Config::get('proxy_password'))
            ->addHeader('Authorization', 'key=' . $key)
            ->addHeader('Content-Type', 'application/json')
            ->body(json_encode(array('data' => array('message' => $message),
                                     'registration_ids' => array($token))))
            ->expectsJson()
            ->send();

        return $res;
    }
}
