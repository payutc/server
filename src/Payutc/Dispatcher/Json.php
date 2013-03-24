<?php 
/**
*	payutc
*	Copyright (C) 2013 payutc <payutc@assos.utc.fr>
*
*	This file is part of payutc
*	
*	payutc is free software: you can redistribute it and/or modify
*	it under the terms of the GNU General Public License as published by
*	the Free Software Foundation, either version 3 of the License, or
*	(at your option) any later version.
*
*	payutc is distributed in the hope that it will be useful,
*	but WITHOUT ANY WARRANTY; without even the implied warranty of
*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*	GNU General Public License for more details.
*
*	You should have received a copy of the GNU General Public License
*	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
* DispatcherJson.class
* 
* Dispatcher for JSON API
* @author payutc <payutc@assos.utc.fr>
* @version 1.0
*/

namespace Payutc\Dispatcher;

class Json
{
    public function handleService($service, $method) {
    	$app = \Slim\Slim::getInstance();
        $services = \Payutc\Mapping\Services::get();
        
    	$app->contentType('application/json; charset=utf-8');
    	if (array_key_exists($service, $services)) {
    		require_once $services[$service];
            session_start();
            if (!isset($_SESSION['services']))
                $_SESSION['services'] = array();
    		if (!array_key_exists($service, $_SESSION['services']))
    			$_SESSION['services'][$service] = new $service;
    		$obj = $_SESSION['services'][$service];
    		$a = \Payutc\Utils::call_user_func_named(array($obj, $method), $_REQUEST);
    		echo json_encode($a);
    	}
    	else {
    		throw new \Payutc\Exception\ServiceNotFound("Service $service does not exist");
    	}
    }
    
    public function handleError($e) {
        $app = \Slim\Slim::getInstance();
        $error_mapping = \Payutc\Mapping\Errors::get();
        
    	$cls = get_class($e);
    	$http_code = null;
    	if (array_key_exists($cls, $error_mapping)) {
    		$http_code = 400;
    		$aaa = $error_mapping[$cls];
    		if (is_callable($aaa)) {
    			$err_array = $aaa($e);
    		}
    		else if (is_int($aaa)) {
    			$err_array = array('type' => $cls, 'code' => $aaa, 'message' => $e->getMessage());
    		}
    		else if (is_array($aaa)) {
    			$err_array = $aaa;
    		}
    		else {
    			$http_code = null;
    		}
    	}
    	if ($http_code === null) {
    		$http_code = 500;
    		$err_array = array(
    			'type' => 'InternalServerError', 
    			'code' => 500,
    			'message' => $e->getMessage()
    		);
    	}
    	$app->contentType('application/json; charset=utf-8');
    	$app->response()->status($http_code);
    	echo json_encode(array('error' => $err_array));
    }
}
?>