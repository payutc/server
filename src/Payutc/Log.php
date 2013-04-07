<?php

namespace Payutc;



class Log
{
    public static function initLog()
    {
        global $_SERVER;
        require_once 'config.inc.php';
        
        if (!isset($_SERVER['REQUEST_METHOD'])) $_SERVER['REQUEST_METHOD'] = null;
        if (!isset($_SERVER['REMOTE_ADDR'])) $_SERVER['REMOTE_ADDR'] = null;
        if (!isset($_SERVER['REQUEST_URI'])) $_SERVER['REQUEST_URI'] = null;
        if (!isset($_SERVER['SERVER_NAME'])) $_SERVER['SERVER_NAME'] = null;
        if (!isset($_SERVER['SERVER_PORT'])) $_SERVER['SERVER_PORT'] = null;
        
        if (static::isInit()) return;
        
        $app = \Slim\Slim::getInstance();
        if ($app === null) {
            $userSettings = $_CONFIG['slim_config'];
            $app = new \Slim\Slim($userSettings);
        }
    }
    
    public static function isInit() 
    {
        $environment = \Slim\Environment::getInstance();
        return isset($environment['slim.log']);
    }
    
    public static function getInstance()
    {
        static::initLog();
        $environment = \Slim\Environment::getInstance();
        return $environment['slim.log'];
    }
    
    public static function __callstatic($name, $args)
    {
        if (array_key_exists($name, get_class_methods('Log'))) {
            return call_user_func_array("static::$name", $args);
        }
        else {
            return call_user_func_array(array(static::getInstance(),$name), $args);
        }
    }
}


