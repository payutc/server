#!/bin/bash

PHPVER=`echo "<?php echo PHP_VERSION_ID;" | php`
if [ "$PHPVER" -lt 50400 ]
then
    echo "PHP version < 5.4.0, skipping"
    exit 0
fi

cd `dirname $0`

echo "Put back initial environment"
if [ -f config.inc.php.bak ]
then
    rm ../config.inc.php
    mv config.inc.php.bak ../config.inc.php
fi
echo "Killing php servers"
ps x | grep -v grep | grep "php -S localhost:" | awk '{print $1}' | xargs kill
