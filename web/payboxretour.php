<?php
// Include all dependencies
require_once '../vendor/autoload.php';
require_once '../config.inc.php';

require_once 'class/Paybox.class.php';
Paybox::PBXretour($_CONFIG['PBX_PUBPEM']);
