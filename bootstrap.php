<?php
// Include all dependencies
require_once dirname(__FILE__).'/vendor/autoload.php';

// Include model
Propel::init(dirname(__FILE__).'/propel/build/conf/payutc-conf.php');
set_include_path(dirname(__FILE__).'/propel/build/classes' . PATH_SEPARATOR . get_include_path());

require_once dirname(__FILE__).'/config.inc.php';


