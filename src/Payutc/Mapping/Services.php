<?php

namespace Payutc\Mapping;

class Services {
    public static function get($name) {
        switch ($name) {
            case 'POSS':
                return new \Payutc\Service\POSS();
            case 'POSS2':
                return new \Payutc\Service\POSS2();
            case 'POSS2WithExceptions':
                return new \Payutc\Service\POSS2WithExceptions();
            case 'AADMIN':
                return new \Payutc\Service\AADMIN();
            case 'MADMIN':
                return new \Payutc\Service\MADMIN();
            case 'STATS':
                return new \Payutc\Service\STATS();
            case 'KEY':
                return new \Payutc\Service\KEY();
            case 'ADMINRIGHT':
                return new \Payutc\Service\ADMINRIGHT();
            default:
                throw new \Payutc\Exception\ServiceNotFound("Service $name does not exist");
        }
    }
}

