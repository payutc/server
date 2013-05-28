<?php
// Include all dependencies
require_once '../vendor/autoload.php';
require_once '../config.inc.php';

\Payutc\Config::initFromArray($_CONFIG);

require_once 'class/Paybox.class.php';
Paybox::PBXretour();
