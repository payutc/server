<?php


require_once '../vendor/autoload.php';



use \Payutc\Config;

$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

Config::initFromJsonFile(__DIR__ . '/config-test.json');
Config::set('log_filename', __DIR__ . '/' . Config::get('log_filename'));

define('PAYUTC_TEST_SERVER_PORT', parse_url(Config::get('server_url'), PHP_URL_PORT));
define('PAYUTC_TEST_CAS_PORT', parse_url(Config::get('cas_url'), PHP_URL_PORT));
define('PAYUTC_TEST_GINGER_PORT', parse_url(Config::get('ginger_url'), PHP_URL_PORT));

function is_running($docroot)
{
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
    return (int)$return_code == 0;
}

if (PHP_VERSION_ID >= 50400) {
    if (!is_running('faux-cas') 
        or !is_running('faux-ginger') 
        or !is_running('payutc-server')) {
        
        echo "Servers have to be started" . PHP_EOL;
        
        $start_cmd = './servers.sh up';
        $output = array();
        $return_code = 0;
        exec($start_cmd, $output, $return_code);
        echo implode("\n", $output);
        
        register_shutdown_function(function() {
            exec('./servers.sh dw');
        });
    }
    else {
        echo "Servers already running" . PHP_EOL;
    }
}

