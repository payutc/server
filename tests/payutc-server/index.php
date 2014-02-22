<?php


// Include all dependencies
require_once '../../vendor/autoload.php';


$config = \Payutc\Config::jsonFileToArray(__DIR__ . '/../config-test.json');
$app = \Payutc\WebApp::createApplication($config);

// run app
$app->run();
