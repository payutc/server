<?php

namespace Payutc\Mapping;

class Services {
    protected static $services = array(
        'POSS3',
        'STATS',
        'KEY',
        'ADMINRIGHT',
        'BLOCKED',
        'GESARTICLE',
        'PAYLINE',
        'RELOAD',
        'MYACCOUNT',
        'CATALOG',
        'TRANSFER',
        'WEBSALE',
        'WEBSALECONFIRM',
        'MESSAGES',
        'TRESO',
        'NOTIFICATIONS'
    );
    
    protected static $servicesGET = array(
        'PAYLINE' => array(
            'notification',
        ),
        'POSS3' => array(
            'getImage64',
        ),
    );
    
    public static function get($name) {
        static::checkExist($name);
        $name = "Payutc\\Service\\$name";
        return new $name();
    }
    
    public static function checkExist($name) {
        if (!in_array($name, static::$services)) {
            throw new \Payutc\Exception\ServiceNotFound("Service $name does not exist");
        }
    }
    
    public static function checkGetAuthorized($service, $method)
    {
        static::checkExist($service);
        if (!isset(static::$servicesGET[$service]) || !in_array($method, static::$servicesGET[$service])) {
            throw new \Payutc\Exception\ServiceMethodForbidden("Can't access $service::$method with GET");
        }
    }
    
    public static function getServices() {
        return static::$services;
    }
}

