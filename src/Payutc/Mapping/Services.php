<?php

namespace Payutc\Mapping;

class Services {
    protected static $services = array(
        'POSS3' => array(),
        'STATS' => array(),
        'KEY' => array(),
        'ADMINRIGHT' => array(),
        'BLOCKED' => array(),
        'GESARTICLE' => array(),
        'PAYLINE' => array(),
        'RELOAD' => array(),
        'MYACCOUNT' => array(),
        'TRANSFER' => array(),
        'WEBSALE' => array(),
        'WEBSALECONFIRM' => array(
            'access' => array(
                'notificationPayline' => array(
                    'get' => 'allow'
                )
            )
        )
    );
    
    public static function get($name) {
        static::checkExist($name);
        $name = "Payutc\\Service\\$name";
        return new $name();
    }
    
    public static function checkExist($name) {
        if (!array_key_exists($name, static::$services)) {
            throw new \Payutc\Exception\ServiceNotFound("Service $name does not exist");
        }
    }
    
    public static function checkGetAuthorized($name, $meth)
    {
        static::checkExist($name);
        $a = isset(static::$services[$name]['access'][$meth]['get']) ?
                static::$services[$name]['access'][$meth]['get']
                : 'deny';
        if ($a != 'allow') {
            throw new \Payutc\Exception\ServiceMethodForbidden("Can't access $name::$meth with GET");
        }
    }
    
    public static function getServices() {
        return static::$services;
    }
}

