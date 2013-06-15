<?php namespace Payutc;

use \Payutc\Config;

class Db
{
    private static $config = null;
    private static $conn = null;
    
    public static function getConnection() {
        if (static::$conn === null) {
            static::$config = new \Doctrine\DBAL\Configuration();
            $connectionParams = array(
                'host' => 'localhost',
                'driver'   => 'pdo_mysql',
                'user'     => Config::get('sql_user'),
                'password' => Config::get('sql_pass'),
                'dbname'   => Config::get('sql_db'),
            );
            static::$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, static::$config);
        }
        return static::$conn;
    }

    public static function createQueryBuilder()
    {
        return static::getConnection()->createQueryBuilder();
    }
}


