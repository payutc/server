<?php


require_once '../vendor/autoload.php';


include 'config-test.inc.php';

use \Payutc\Config;

$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

Config::initFromArray($_CONFIG);

define('PAYUTC_TEST_SERVER_PORT', parse_url(Config::get('server_url'), PHP_URL_PORT));
define('PAYUTC_TEST_CAS_PORT', parse_url(Config::get('cas_url'), PHP_URL_PORT));
define('PAYUTC_TEST_GINGER_PORT', parse_url(Config::get('ginger_url'), PHP_URL_PORT));

//echo PAYUTC_TEST_SERVER_PORT."\n";
//echo PAYUTC_TEST_CAS_PORT."\n";
//echo PAYUTC_TEST_GINGER_PORT."\n";

function start_server($docroot, $port, $logfile)
{
    $host = 'localhost';
    // Command that starts the built-in web server
    $command = sprintf(
        'php -S %s:%d -t %s >%s 2>&1 & echo $!',
        $host,
        $port,
        $docroot,
        $logfile
    );
    
    // Execute the command and store the process ID
    $output = array(); 
    exec($command, $output);
    $pid = (int) $output[0];
 
    echo sprintf(
        '%s - Web server started on %s:%d with PID %d', 
        date('r'),
        $host, 
        $port, 
        $pid
    ) . PHP_EOL;

    //* Kill the web server when the process ends
    register_shutdown_function(function() use ($pid) {
        echo sprintf('%s - Killing process with ID %d', date('r'), $pid) . PHP_EOL;
        exec('kill ' . $pid);
    });//*/
}

if (PHP_VERSION_ID >= 50400) {
    start_server(__DIR__ . '/faux-cas/', PAYUTC_TEST_CAS_PORT, 'logs/cas.log');
    start_server(__DIR__ . '/faux-ginger/', PAYUTC_TEST_GINGER_PORT, 'logs/ginger.log');
    start_server(__DIR__ . '/payutc-server/', PAYUTC_TEST_SERVER_PORT, 'logs/server.log');
}
