<?php

namespace Payutc\Bom;
use \Payutc\Db\Dbal;
use \Payutc\Bom\User;
use \Payutc\Exception\ExternalDataException;
use \Payutc\Log;

class ExternalData {
    
    protected static function addSelectConditions($qb, $fun_id, $usr_id = null) {
        $qb->from('t_external_data_exd', 'exd')
            ->where('fun_id = :fun_id')
            ->andWhere('exd_removed is NULL')
            ->setParameter('fun_id', $fun_id);
        
        if ($usr_id === null) {
            $qb->andWhere('usr_id is NULL');
        }
        else {
            $qb->andWhere('usr_id = :usr_id')
                ->setParameter('usr_id', $usr_id);
        }
    }
    
    protected static function insert($fun_id, $key, $val, $usr_id = null) {
        $conn = Dbal::conn();
        $a = $conn->insert('t_external_data_exd', array(
            'fun_id' => $fun_id,
            'usr_id' => $usr_id,
            'exd_key' => $key,
            'exd_val' => $val,
            'exd_inserted' => 'NOW()'));
    }
    
    /**
     * @param $fun_id
     * @param $key
     * @param $usr_id
     * @param $full true to get full record, false to get only the value
     * @param $for_update true to do a SELECT ... FOR UPDATE statement
     */
    public static function get($fun_id, $key, $usr_id = null, $full = false, $for_update = false) {
        static::checkKey($key);
        $qb = Dbal::createQueryBuilder();
        $qb->select($full ? '*' : 'exd_val');
        if ($for_update) {
            $qb->forUpdate();
        }
        static::addSelectConditions($qb, $fun_id, $usr_id);
        $qb->andWhere('exd_key = :exd_key')
            ->setParameter('exd_key', $key);
        $res = $qb->execute()->fetch();
        if ($res === false) {
            throw new ExternalDataException("Not found : fun=$fun_id, key=$key, usr_id=$usr_id", 404);
        }
        return $full ? $res : $res['exd_val'];
    }
    
    /**
     * 
     * @param $fun_id
     * @param $key
     * @param $val
     * @param $usr_id
     */
    public static function set($fun_id, $key, $val, $usr_id = null) {
        static::checkKey($key);
        $conn = Dbal::conn();
        
        $conn->beginTransaction();
        try {
            
            $affected_rows = static::del($fun_id, $key, $usr_id);
            
            if ($affected_rows == 0) {
                Log::info("create new external data ($fun_id, $key, $val, $usr_id)");
            }
            
            // insert the new record
            static::insert($fun_id, $key, $val, $usr_id);
            
            $conn->commit();
        }
        catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
    }
    
    /**
     * @param $fun_id
     * @param $key
     * @param $usr_id
     */
    public static function del($fun_id, $key, $usr_id = null) {
        static::checkKey($key);
        
        $qb = Dbal::createQueryBuilder();
        $qb->update('t_external_data_exd', 'exd')
            ->where('fun_id = :fun_id')
            ->setParameter('fun_id', $fun_id)
            ->where('exd_key = :key')
            ->setParameter('key', $key)
            ->andWhere('exd_removed is NULL')
            ->set('exd_removed', 'NOW()');
        
        if ($usr_id === null) {
            $qb->andWhere('usr_id is NULL');
        }
        else {
            $qb->andWhere('usr_id = :usr_id')
                ->setParameter('usr_id', $usr_id);
        }
        
        $affected_rows = $qb->execute();
        
        if ($affected_rows > 1) {
            Log::warning("multiple rows has been deleted ($fun_id, $key, $usr_id)"); // TODO
        }
        // one row affected, the record was already existing
        else if ($affected_rows == 1) {
            
        }
        // 0 row affected, the record does not exist
        else {
            
        }
        
        return $affected_rows;
    }
    
    
    /**
     * Available transformations ($func):
     * array('$inc'=> (int))
     * array('$dec'=> (int))
     * 
     * @param $fun_id
     * @param $key
     * @param $fun the transformation to apply
     * @param $usr_id
     * @return the new value
     */
    public static function transform($fun_id, $key, array $func, $usr_id = null) {
        static::checkKey($key);
        $conn = Dbal::conn();
        
        $conn->beginTransaction();
        try {
            $full = false;
            $res = self::get($fun_id, $key, $usr_id, $full, true);
            $transform = key($func);
            $value = reset($func);
            switch ($transform) {
                case '$dec':
                    $value = -(int)$value;
                break;
                case '$inc':
                    $res = (int)$res + (int)$value;
                break;
                default:
                    throw new ExternalDataException('Invalid transformation');
                break;
            }
            self::set($fun_id, $key, $res, $usr_id);
            $conn->commit();
        }
        catch (Exception $e) {
            $conn->rollback();
            Log::error("Impossible d\'effectuer la transformation ($fun_id, $key, $func, $usr_id) ".$e->getMessage());
        }
        
        return $res;
    }
    
    protected static function checkKey($key) {
        $pattern = '/^[a-zA-Z0-9_-]+$/';
        if(preg_match($pattern, $key) === 0) {
            throw new ExternalDataException("Invalid key, allowed char are [a-zA-Z0-9_-]", 442);
        }
    }
}

