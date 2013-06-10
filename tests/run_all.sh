#!/bin/bash

cd `dirname $0`

./start_server.sh
./phpunit --coverage-text .
CODE=$?
./stop_server.sh
exit $CODE
