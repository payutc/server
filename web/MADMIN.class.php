<?php 

// Include all dependencies
require_once '../vendor/autoload.php';

require_once 'config.inc.php';

$dispatcher = new \Payutc\Dispatcher\Soap();
$dispatcher->handle('MADMIN');

