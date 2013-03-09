<?php
session_start();
if (!isset($_SESSION['services'])) {
	$_SESSION['services'] = array();
}


require_once 'config.inc.php';


// Include all dependencies
require_once 'vendor/autoload.php';

// Include call_user_func_named
require_once 'call_user_func_named.func.php';

// Include error mapping
require_once 'error_mapping.inc.php';

// include services list
require_once 'services.inc.php';






$app = new \Slim\Slim($_CONFIG['slim_config']);

// error handler
$app->error(function (\Exception $e) use ($app, $error_mapping) {
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
});

// service handler
function handler($services, $service, $method)
{
	$app = \Slim\Slim::getInstance();
	$app->contentType('application/json; charset=utf-8');
	if (array_key_exists($service, $services)) {
		require_once $services[$service];
		if (!isset($_SESSION[$service])) {
			$obj = new $service;
		}
		else {
			$obj = unserialize($_SESSION[$service]);
		}
		//var_dump($obj);
		$a = call_user_func_named(array($obj, $method), $_REQUEST);
		$_SESSION[$service] = serialize($obj);
		echo json_encode($a);
	}
	else {
		throw new ServiceNotFound("Service $service does not exist");
	}
}

// create app
$app->get('/:service/:method', function($service, $method) use ($services) {
	handler($services, $service, $method);
});
$app->post('/:service/:method', function($service, $method) use ($services) {
	handler($services, $service, $method);
});




