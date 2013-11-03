<?php
// Include all dependencies
require_once '../vendor/autoload.php';

require_once 'config.inc.php';

$app = \Payutc\WebApp::createApplication($_CONFIG, (isset($_HOST_PREFIX) ? $_HOST_PREFIX : null));

// run app
$app->run();




