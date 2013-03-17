<?php
// Include all dependencies
require_once '../vendor/autoload.php';

require_once 'config.inc.php';

// Include error mapping
require_once 'inc/error_mapping.inc.php';

// include services list
require_once 'inc/services.inc.php';

class ServiceNotFound extends Exception {}
class ServiceMethodNotFound extends Exception {}
class ServiceMethodForbidden extends Exception {}
class ServiceMissingMethodArgument extends Exception {}

function call_user_func_named($function_or_array, $params)
{
	if (is_array($function_or_array)) {
		$class = $function_or_array[0];
		$function = $function_or_array[1];
		$reflection_class = new ReflectionClass($class);
		if (!$reflection_class->hasMethod($function)) {
			throw new ServiceMethodNotFound('La fonction '.$function.' n\'existe pas');
		}
		$reflect = $reflection_class->getMethod($function);
		if ($reflect->isPrivate() or $reflect->isProtected()) {
			throw new ServiceMethodForbidden('La fonction '.$function.' n\'est pas publique');
		}
	}
	else {
		$function = $function_or_array;
		if (!function_exists($function)) {
			throw new ServiceMethodNotFound('La fonction '.$function.'n\'existe pas');
		}
		$reflect = new ReflectionFunction($function);
	}
	$real_params = array();
	foreach ($reflect->getParameters() as $i => $param)
	{
		$pname = $param->getName();
		if ($param->isPassedByReference()) {
			/// @todo shall we raise some warning?
		}
		if (array_key_exists($pname, $params)) {
			$real_params[] = $params[$pname];
		}
		else if ($param->isDefaultValueAvailable()) {
			$real_params[] = $param->getDefaultValue();
		}
		else {
			// missing required parameter: mark an error and exit
			throw new ServiceMissingMethodArgument('Le parametre "'.$pname.'" est requis');
		}
	}
	return call_user_func_array($function_or_array, $real_params);
}

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
        session_start();
        if (!isset($_SESSION['services']))
            $_SESSION['services'] = array();
		if (!array_key_exists($service, $_SESSION['services']))
			$_SESSION['services'][$service] = new $service;
		$obj = $_SESSION['services'][$service];
		$a = call_user_func_named(array($obj, $method), $_REQUEST);
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


// run app
$app->run();




