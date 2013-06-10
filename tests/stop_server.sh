#!/bin/bash

cd `dirname $0`

echo "Put back initial environment"
if [ -f config.inc.php.bak ]
then
    rm ../config.inc.php
    mv config.inc.php.bak ../config.inc.php
fi
echo "Killing php servers"
#ps x | grep "php -S localhost:"
ps x | grep "php -S localhost:" | awk '{print $1}' | xargs kill
