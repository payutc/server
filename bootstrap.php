<?php
// Include the main Propel script, initialize it and add classes to inc path
require_once 'lib/propel/runtime/lib/Propel.php';
Propel::init('propel/build/conf/payutc-conf.php');
set_include_path('propel/build/classes' . PATH_SEPARATOR . get_include_path());

require_once 'config.inc.php';


