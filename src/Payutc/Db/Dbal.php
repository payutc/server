<?php

namespace Payutc\Db;

use \Payutc\Config;

class Dbal
{
    private static $config = null;
    private static $conn = null;
    
    public static function createQueryBuilder()
    {
        return static::conn()->createQueryBuilder();
    }
    
    public static function conn()
    {
        if (static::$conn === null) {
            static::$config = new \Doctrine\DBAL\Configuration();
            $connectionParams = array(
                'host' => 'localhost',
                'driver'   => 'pdo_mysql',
                'user'     => Config::get('sql_user'),
                'password' => Config::get('sql_pass'),
                'dbname'   => Config::get('sql_db'),
                'charset'  => 'utf8',
            );
            static::$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, static::$config);
            static::$conn->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        }
        return static::$conn;
    }
    
    public static function beginTransaction()
    {
        static::$conn->beginTransaction();
    }
    
    public static function commit()
    {
        static::conn()->commit();
    }
    
    public static function rollback()
    {
        static::conn()->rollback();
    }
}


