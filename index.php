<?php


require_once 'config.inc.php';


// Include all dependencies
require_once 'vendor/autoload.php';


$services = array(
	'POSS' => 'services/POSS.service.php',
	'POSS2' => 'services/POSS2.service.php',
	'AADMIN' => 'services/AADMIN.service.php',
	'MADMIN' => 'services/MADMIN.service.php',
	'STATS' => 'services/STATS.service.php',
);

$error_mapping = array(
	'ServiceNotFound' => 404,
	'ServiceMethodNotFound' => 404,
	'ServiceMethodForbidden' => 403,
	'ServiceMissingMethodArgument' => 400,
);



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
			//trigger_error('call to unexisting function '.$function[1], E_USER_ERROR);
			//return NULL;
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
			//trigger_error('call to unexisting function '.$function, E_USER_ERROR);
			//return NULL;
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
			//trigger_error(sprintf('call to %s missing parameter nr. %d', $function, $i+1), E_USER_ERROR);
			//return NULL;
		}
	}
	return call_user_func_array($function_or_array, $real_params);
}



$app = new \Slim\Slim(array(
    'mode' => 'developement',
    'debug' => true
));

// error handler
$app->error(function (\Exception $e) use ($app, $error_mapping) {
	$cls = get_class($e);
	if (array_key_exists($cls, $error_mapping)) {
		$aaa = $error_mapping[$cls];
		if (is_callable($aaa)) {
			$code_n_data = $aaa($e);
		}
		else if (is_int($aaa)) {
			$code_n_data = array($aaa, $e->getMessage());
		}
		else if (is_array($aaa)) {
			$code_n_data = $aaa;
		}
	}
	else {
		$app->contentType('text/plain; charset=utf-8');
		$code_n_data = array(500, $e->getMessage());
	}
	$app->contentType('application/json; charset=utf-8');
	$app->response()->status($code_n_data[0]);
	echo json_encode(array('code'=>$code_n_data[0], 'data'=>$code_n_data[1]));
});

// service handler
function handler($services, $service, $method)
{
	$app = \Slim\Slim::getInstance();
	$app->contentType('application/json; charset=utf-8');
	if (array_key_exists($service, $services)) {
		require_once $services[$service];
		$obj = new $service;
		$a = call_user_func_named(array($obj, $method), $_REQUEST);
		echo json_encode($a);
	}
	else {
		throw new ServiceNotFound('Service $service does not exist');
	}
}
$app->get('/:service/:method', function($service, $method) use ($services) {
	handler($services, $service, $method);
});
$app->post('/:service/:method', function($service, $method) use ($services) {
	handler($services, $service, $method);
});


// run app
$app->run();




