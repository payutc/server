#!/bin/bash

cd `dirname $0`

./setup-env.sh

exec ./phpunit -c phpunit.xml --coverage-text
