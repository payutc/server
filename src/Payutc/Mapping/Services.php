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
        'DATAADMIN',
        'PAYLINE',
        'RELOAD',
        'MYACCOUNT',
        'TRANSFER',
        'WEBSALE',
        'WEBSALECONFIRM'
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
    
    public static function getServices() {
        return static::$services;
    }
}

