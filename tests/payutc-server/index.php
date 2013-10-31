<?php


// Include all dependencies
require_once '../../vendor/autoload.php';

require_once '../config-test.inc.php';

$app = \Payutc\Application::createApplication($_CONFIG);

// run app
$app->run();
