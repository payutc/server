<?php
// Include all dependencies
require_once 'vendor/autoload.php';

// Include model
Propel::init('propel/build/conf/payutc-conf.php');
set_include_path('propel/build/classes' . PATH_SEPARATOR . get_include_path());

require_once 'config.inc.php';


