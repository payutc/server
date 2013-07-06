#!/bin/bash

PHPVER=`echo "<?php echo PHP_VERSION_ID;" | php`
if [ "$PHPVER" -lt 50400 ]
then
    echo "PHP version < 5.4.0, skipping"
    exit 0
fi

cd `dirname $0`

FAUX_GINGER_PORT=33434
FAUX_CAS_PORT=33435
PAYUTC_PORT=33436

if [ -f ../config.inc.php ]
then
    echo "Move config.inc.php to config.inc.php.bak"
    mv ../config.inc.php config.inc.php.bak
fi
echo "Copy test config"
cp config.inc.php ../

echo "Get faux-ginger"
if [ -d faux-ginger ]
then
    cd faux-ginger
    git pull
    cd ..
else
    git clone git://github.com/simde-utc/faux-ginger.git
fi

echo "Get faux-cas"
if [ -d faux-cas ]
then
    cd faux-cas
    git pull
    cd ..
else
    git clone git://github.com/payutc/faux-cas.git
fi

echo "Starting faux-ginger server on port $FAUX_GINGER_PORT"
php -S localhost:$FAUX_GINGER_PORT -t faux-ginger/ &

echo "Starting faux-cas server on port $FAUX_CAS_PORT"
php -S localhost:$FAUX_CAS_PORT -t faux-cas/ &

echo "Starting payutc server on port $PAYUTC_PORT"
php -S localhost:$PAYUTC_PORT -t ../web/ &
