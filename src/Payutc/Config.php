<?php namespace Payutc;

class Config
{
    protected static $config = array();
    
    public static function initFromArray($arr)
    {
        static::$config = $arr;
    }
    
    public static function get($name, $default = null)
    {
        if (array_key_exists($name, static::$config)) {
            return static::$config[$name];
        }
        else {
            return $default;
        }
    }
    
    public static function set($name, $value)
    {
        static::$config[$name] = $value;
    }
}


