<?php


require_once '../vendor/autoload.php';


include 'config-test.inc.php';

use \Payutc\Config;

$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

Config::initFromArray($_CONFIG);

define('PAYUTC_TEST_SERVER_PORT', parse_url(Config::get('server_url'), PHP_URL_PORT));
define('PAYUTC_TEST_CAS_PORT', parse_url(Config::get('cas_url'), PHP_URL_PORT));
define('PAYUTC_TEST_GINGER_PORT', parse_url(Config::get('ginger_url'), PHP_URL_PORT));

function start_server($docroot, $port, $logfile)
{
    $host = 'localhost';
    
    // Command that starts the built-in web server
    $command_start = sprintf(
        'php -S %s:%d -t %s >%s 2>&1 & echo $!',
        $host,
        $port,
        $docroot,
        $logfile
    );
    
    // Command to check if the server is running
    $command_check_running = sprintf(
        '
        if [ -f %s/server.pid ]
        then
            PID=`cat %s/server.pid`
            echo c1
            ps -p $PID > /dev/null
            R=$?
            echo $R
            exit $R
        else
            echo c2
            exit 1
        fi
        '
        ,
        $docroot,
        $docroot
    );
    
    $output = array();
    $return_code = 0;
    // Execute the check command
    exec($command_check_running, $output, $return_code);
    if ((int)$return_code == 0) {
        echo "Server $docroot is already running" . PHP_EOL;
        return;
    }
    
    // Execute the start command and store the process ID
    $output = array();
    $return_code = 0;
    exec($command_start, $output);
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
