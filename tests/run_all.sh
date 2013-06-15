#!/bin/bash

cd `dirname $0`

./start_server.sh
./phpunit -c phpunit.xml --coverage-text .
CODE=$?
./stop_server.sh
exit $CODE
