<?php

namespace Payutc\Bom;
use \Payutc\Db\Dbal;
use \Payutc\Bom\User;
use \Payutc\Exception\ExternalDataException;


class ExternalData {
    
    protected static function addConditions($qb, $fun_id, $usr=null) {
        $qb->from('t_external_data_exd', 'exd')
            ->where('fun_id = :fun_id')
            ->setParameter('fun_id', $fun_id);
        // user id
        if (is_int($usr) or $usr === "0" or (is_string($usr) and intval($usr) != 0)) {
            $qb->andWhere('usr_id = :usr_id')
                ->setParameter('usr_id', $usr);
        }
        // user is NULL
        else if ($usr === null) {
            $qb->andWhere('usr_id is NULL');
        }
        // user login
        else {
            $qb->leftjoin('exd', 'ts_user_usr', 'usr', 'exd.usr_id = usr.usr_id')
                ->andWhere('usr.usr_nickname = :login')
                ->setParameter('login', $usr);
        }
    }
    
    protected static function insert($fun_id, $key, $val, $usr_id = null) {
        $conn = Dbal::conn();
        $a = $conn->insert('t_external_data_exd', array(
            'fun_id' => $fun_id,
            'usr_id' => $usr_id,
            'exd_key' => $key,
            'exd_val' => $val,
            'exd_inserted' => date('Y-m-d H:i:s')));
    }
    
    public static function get($fun_id, $key, $usr = null, $full = false) {
        static::checkKey($key);
        $qb = Dbal::createQueryBuilder();
        $qb->select($full ? '*' : 'exd_val');
        static::addConditions($qb, $fun_id, $usr);
        $qb->andWhere('exd_key = :exd_key')
            ->setParameter('exd_key', $key);
        $res = $qb->execute()->fetch();
        if ($res === false) {
            throw new ExternalDataException("Not found : fun=$fun_id, key=$key, usr=$usr", 404);
        }
        return $full ? $res : $res['exd_val'];
    }
    
    public static function set($fun_id, $key, $val, $usr = null) {
        static::checkKey($key);
        $data = null;
        try {
            $data = static::get($fun_id, $key, $usr, true);
        }
        catch (ExternalDataException $e) {
            // data does not exist, let's create it !
            if ($e->getCode() == 404) {
                if (!is_int($usr) and $usr !== null) {
                    // we got the login
                    $u = new User($usr);
                    $usr = $u->getId();
                }
                static::insert($fun_id, $key, $val, $usr);
                $this_is_an_insert = true;
            }
        }
        if ($data !== null) {
            $qb = Dbal::createQueryBuilder();
            $qb->update('t_external_data_exd', 'exd')
                ->where('exd_id = :id')
                ->setParameter('id', $data['exd_id'])
                ->set('exd_val', "'$val'");
            $res = $qb->execute();
        }
    }
    
    protected static function checkKey($key) {
        $pattern = '/^[a-zA-Z0-9_-]+$/';
        if(preg_match($pattern, $key) === 0) {
            throw new ExternalDataException("Invalid key, allowed char are [a-zA-Z0-9_-]", 442);
        }
    }
}

