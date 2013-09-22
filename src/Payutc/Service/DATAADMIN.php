<?php


namespace Payutc\Service;


use \Payutc\Config;
use \Payutc\Log;
use \Payutc\Bom\ExternalData;

class DATAADMIN extends \ServiceBase {
    
    public function get($fun_id, $key, $usr_id = null) {
        $this->checkRight(true, true, true, $fun_id);
        return ExternalData::get($fun_id, $key, $usr_id);
    }
    
    public function set($fun_id, $key, $val, $usr_id = null) {
        $this->checkRight(true, true, true, $fun_id);
        return ExternalData::set($fun_id, $key, $val, $usr_id);
    }
}


