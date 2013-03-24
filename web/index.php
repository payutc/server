<?php


// Include all dependencies
require_once '../vendor/autoload.php';

require_once 'config.inc.php';


// register handler for fatal errors
register_shutdown_function( "\Payutc\Dispatcher\Json::fatal_handler" );


$app = new \Slim\Slim($_CONFIG['slim_config']);
$dispatcher = new \Payutc\Dispatcher\Json();
    
// error handler
$app->error(function (\Exception $e) use ($dispatcher) {
    $dispatcher->handleError($e);
});

// create app
$app->get('/:service/:method', function($service, $method) use ($dispatcher) {
	$dispatcher->handleService($service, $method);
});
$app->post('/:service/:method', function($service, $method) use ($dispatcher) {
	$dispatcher->handleService($service, $method);
});

// run app
$app->run();




