<?php
// Include all dependencies
require_once '../vendor/autoload.php';

require_once 'config.inc.php';

\Payutc\Config::initFromArray($_CONFIG);

$app = new \Slim\Slim(\Payutc\Config::get('slim_config'));

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
$app->map('/:service.class.php', function($service) {
    $dispatcher = new \Payutc\Dispatcher\Soap();
    $dispatcher->handle($service);
})->via('GET', 'POST');

// run app
$app->run();




