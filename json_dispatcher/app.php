<?php


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
        session_start();
        if(!array_key_exists('services', $_SESSION))
            $_SESSION["services"] = array();
        if(!array_key_exists($service, $_SESSION['services']))
            $_SESSION["services"][$service] = new $service;
        $a = call_user_func_named(array($_SESSION["services"][$service], $method), $_REQUEST);
		echo json_encode($a);
	}
	else {
		throw new ServiceNotFound("Service $service does not exist");
	}
}
$app->get('/:service/:method', function($service, $method) use ($services) {
	handler($services, $service, $method);
});
$app->post('/:service/:method', function($service, $method) use ($services) {
	handler($services, $service, $method);
});
