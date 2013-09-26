<?php

namespace Payutc;

use \Payutc\Config;

class Log
{
    public static function initLog()
    {
        global $_SERVER;
        
        if (!isset($_SERVER['REQUEST_METHOD'])) $_SERVER['REQUEST_METHOD'] = null;
        if (!isset($_SERVER['REMOTE_ADDR'])) $_SERVER['REMOTE_ADDR'] = null;
        if (!isset($_SERVER['REQUEST_URI'])) $_SERVER['REQUEST_URI'] = null;
        if (!isset($_SERVER['SERVER_NAME'])) $_SERVER['SERVER_NAME'] = null;
        if (!isset($_SERVER['SERVER_PORT'])) $_SERVER['SERVER_PORT'] = null;
        
        if (static::isInit()) return;
        
        $app = \Slim\Slim::getInstance();
        if ($app === null) {
            $userSettings = Config::get('slim_config');
            $app = new \Slim\Slim($userSettings);
        }
    }
    
    public static function isInit() 
    {
        $app = \Slim\Slim::getInstance();
        if ($app === null) {
            return false;
        }
        return $app->getLog() != NULL;
    }
    
    public static function getInstance()
    {
        static::initLog();
        $app = \Slim\Slim::getInstance();
        return $app->getLog();
    }
    
    public static function __callstatic($name, $args)
    {
        if (array_key_exists($name, get_class_methods('Payutc\Log'))) {
            return call_user_func_array("static::$name", $args);
        }
        else {
            return call_user_func_array(array(static::getInstance(),$name), $args);
        }
    }
}


