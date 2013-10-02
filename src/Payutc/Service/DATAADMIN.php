<?php


namespace Payutc\Service;


use \Payutc\Config;
use \Payutc\Log;
use \Payutc\Bom\ExternalData;
use \Payutc\Bom\User;

class DATAADMIN extends \ServiceBase {
    
    /**
     * valid inputs:
     * $usr = array('login' => 'trecouvr');
     * $usr = array('badge' => 'ABCDEABCDE');
     * $usr = array('id' => 1);
     * $usr = null
     * 
     * output:
     * id : int or null
     */
    protected function convertUsrArg($usr) {
        if ($usr !== null) {
            if (isset($usr['badge'])) {
                $u = User::getUserFromBadge($usr['badge']);
                $usr = $u->getId();
            }
            else if (isset($usr['login'])) {
                $u = new User($usr['login']);
                $usr = $u->getId();
            }
            else if (isset($usr['id'])) {
                $usr = $usr['id'];

            }
        }
        return $usr;
    }
    
    protected function get($fun_id, $key, $usr = null) {
        $this->checkRight(true, true, true, $fun_id);
        $usr = $this->convertUsrArg($usr);
        return ExternalData::get($fun_id, $key, $usr);
    }
    
    protected function set($fun_id, $key, $val, $usr = null) {
        $this->checkRight(true, true, true, $fun_id);
        $usr = $this->convertUsrArg($usr);
        return ExternalData::set($fun_id, $key, $val, $usr);
    }
    
    public function getFunData($fun_id, $key) {
        return $this->get($fun_id, $key);
    }
    
    public function setFunData($fun_id, $key, $val) {
        return $this->set($fun_id, $key, $val);
    }
    
    public function getUsrDataByLogin($fun_id, $login, $key) {
        return $this->get($fun_id, $key, array('login'=>$login));
    }
    
    public function setUsrDataByLogin($fun_id, $login, $key, $val) {
        return $this->set($fun_id, $key, $val, array('login'=>$login));
    }
    
    public function getUsrDataByBadge($fun_id, $badge, $key) {
        return $this->get($fun_id, $key, array('badge'=>$badge));
    }
    
    public function setUsrDataByBadge($fun_id, $badge, $key, $val) {
        return $this->set($fun_id, $key, $val, array('badge'=>$badge));
    }
}


