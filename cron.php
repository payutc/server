#!/usr/bin/env php
<?php
// Include all dependencies
require_once 'vendor/autoload.php';

// Load config
require_once 'config.inc.php';
\Payutc\Config::initFromArray($_CONFIG);

/*
This file must be called every minutes
*/
use \Payutc\Bom\Task;

$start = time();
$continue = True;

while($continue) {
	$action = Task::doOne();
	if(!$action) {
		sleep(5);
	}
	if((time() - $start) > 55) {
		$continue = false;
	}
}