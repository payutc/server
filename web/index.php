<?php
// Include all dependencies
require_once '../vendor/autoload.php';

require_once 'config.inc.php';

$app = new \Slim\Slim($_CONFIG['slim_config']);

// error handler
$app->error(function (\Exception $e) {
    $dispatcher = new \Payutc\Dispatcher\Json();
    $dispatcher->handleError($e);
});

// JSON route
$app->map('/:service/:method', function($service, $method) {
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




