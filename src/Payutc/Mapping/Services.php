<?php

namespace Payutc\Mapping;

class Services {
    protected static $services = array(
        'POSS2',
        'POSS2WithExceptions',
        'AADMIN',
        'MADMIN',
        'STATS',
        'KEY',
        'ADMINRIGHT'
    );
    
    public static function get($name) {
        Services::checkExist($name);
        $name = "Payutc\\Service\\$name";
        return new $name();
    }
    
    public static function checkExist($name) {
        if (!in_array($name, Services::$services)) {
            throw new \Payutc\Exception\ServiceNotFound("Service $name does not exist");
        }
    }
}

