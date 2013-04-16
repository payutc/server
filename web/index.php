<?php
// Include all dependencies
require_once '../vendor/autoload.php';

require_once 'config.inc.php';

$app = new \Slim\Slim($_CONFIG['slim_config']);

// JSON route
$app->map('/:service/:method', function($service, $method) use ($app) {
    $dispatcher = new \Payutc\Dispatcher\Json();

    // JSON Error handler
    $app->error(function (\Exception $e) use ($dispatcher) {
        $dispatcher->handleError($e);
    });
    
    $dispatcher->handleService($service, $method);
})->via('GET', 'POST');

// SOAP route
$server_url = $_CONFIG['server_url'];
$app->map('/:service.class.php', function($service) use $server_url{
    $dispatcher = new \Payutc\Dispatcher\Soap($server_url);
    $dispatcher->handle($service);
})->via('GET', 'POST');

// run app
$app->run();




