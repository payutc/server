<?php 
/**
*    payutc
*    Copyright (C) 2013 payutc <payutc@assos.utc.fr>
*
*    This file is part of payutc
*    
*    payutc is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    payutc is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
* DispatcherJson.class
* 
* Dispatcher for JSON API
* @author payutc <payutc@assos.utc.fr>
* @version 1.0
*/

namespace Payutc\Dispatcher;

use \Payutc\Exception\PayutcException;
use \Payutc\Log;

class Json
{
    public function handleService($service, $method) {
        $app = \Slim\Slim::getInstance();
        
        $app->contentType('application/json; charset=utf-8');
        session_start();
        if (!isset($_SESSION['services']))
            $_SESSION['services'] = array();
        if (!array_key_exists($service, $_SESSION['services']))
                $_SESSION['services'][$service] = \Payutc\Mapping\Services::get($service);
        $obj = $_SESSION['services'][$service];
        $a = \Payutc\Utils::call_user_func_named(array($obj, $method), $_REQUEST);
        echo json_encode($a);
    }
    
    public function handleError($e) {
        $app = \Slim\Slim::getInstance();
        
        Log::error(get_class($e)."({$e->getCode()}) {$e->getMessage()} at {$e->getFile()}:{$e->getLine()}", array('e'=>$e, 'trace'=>$e->getTrace()));
        
        $err_array = array(
            'type' => get_class($e), 
            'code' => $e->getCode(),
            'message' => $e->getMessage()
        );
        if ($e instanceof PayutcException) {
            $http_code = 400;
        }
        else {
            $http_code = 500;
        }
        $app->contentType('application/json; charset=utf-8');
        $app->response()->status($http_code);
        echo json_encode(array('error' => $err_array));
    }
}
