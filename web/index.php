<?php
// Include all dependencies
require_once '../vendor/autoload.php';

require_once 'config.inc.php';

$app = new \Slim\Slim($_CONFIG['slim_config']);

// JSON route
$app->map('/:service/:method', function($service, $method) use ($app) {
    // JSON Error handler
    $app->error(function (\Exception $e) {
        $dispatcher = new \Payutc\Dispatcher\Json();
        $dispatcher->handleError($e);
    });
    
    $dispatcher = new \Payutc\Dispatcher\Json();
    $dispatcher->handleService($service, $method);
})->via('GET', 'POST');

// SOAP route
$app->map('/:service.class.php', function($service) {
    $dispatcher = new \Payutc\Dispatcher\Soap();
    $dispatcher->handle($service);
})->via('GET', 'POST');

// run app
$app->run();




