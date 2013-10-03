<?php
// Include all dependencies
require_once '../vendor/autoload.php';

require_once 'config.inc.php';

use \Payutc\Config;
use \Payutc\Log;

Config::initFromArray($_CONFIG);

Log::init(Config::get('log_mode'), Config::get('log_filename'));

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




