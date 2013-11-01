#!/bin/bash



usage()
{
cat << EOF
usage: $0 [start|stop]

This script run the php built-in servers for payutc-server, faux-cas and faux-ginger.

OPTIONS:
   help     Show this message
   start    Start the servers
   stop     Stop the servers
   status   Get the status
EOF
}

function extract_port
{
    grep $1 config-test.inc.php | cut -d/ -f3 | cut -d: -f2
}

# $1 docroot
# $2 port
function start_server
{
    stop_server $1
    echo -n "Starting server for $1 on http://localhost:$2/ ... "
    if php -S localhost:$2 -t $1 >$1/server.log 2>&1 & echo $! > $1/server.pid
    then
        echo "OK"
    else
        echo "FAIL"
    fi
}

# $1 docroot
function stop_server
{
    if [ -f $1/server.pid ]
    then
        PID=`cat $1/server.pid`
        if ps -p $PID > /dev/null
        then
            echo -n "Killing server for $1, pid:$PID ... "
            if kill $PID
            then
                echo "OK"
            else
                echo "FAIL"
            fi
        fi
    fi
}

function start_servers
{
    pushd `dirname $0` > /dev/null

    echo "Start all servers"
    
    PORT=`extract_port server_url`
    start_server 'payutc-server' $PORT
    PORT=`extract_port cas_url`
    start_server 'faux-cas' $PORT
    PORT=`extract_port ginger_url`
    start_server 'faux-ginger' $PORT
    
    echo "done"
    
    popd > /dev/null
}

function stop_servers
{
    pushd `dirname $0` > /dev/null
    
    echo "Stop all servers"
    
    stop_server 'payutc-server'
    stop_server 'faux-cas'
    stop_server 'faux-ginger'
    
    echo "done"
    
    popd > /dev/null
}

case "$1" in
"help")
    usage
    exit 0
    ;;
"start" | "up")
    start_servers
    ;;
"stop" | "dw")
    stop_servers
    ;;
"status" | "st")
    ps x | grep -v grep | grep "php -S localhost"
    ;;
*)
    usage
    exit 1
    ;;
esac






