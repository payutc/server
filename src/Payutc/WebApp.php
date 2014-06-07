<?php

namespace Payutc;

use \Payutc\Config;
use \Payutc\Log;

class WebApp {
    
    public static function createApplication($config)
    {
        Config::initFromArray($config);
        Log::init(Config::get('log_mode'), Config::get('log_filename'));
        
        $app = new \Slim\Slim(\Payutc\Config::get('slim_config'));
        // JSON route
        $app->map('/:service/:method', function($service, $method) use ($app) {
            $dispatcher = new \Payutc\Dispatcher\Json();

            // JSON Error handler
            $app->error(function (\Exception $e) use ($dispatcher) {
                $dispatcher->handleError($e);
            });
            
            if (Config::get('maintenance')) {
                throw new \Payutc\Exception\MaintenanceException("payutc est en cours de maintenance.");
            }
    
            $dispatcher->handleService($service, $method);
        })->via('GET', 'POST');

        return $app;
    }
}





