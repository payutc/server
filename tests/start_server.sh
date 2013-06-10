#!/bin/bash

cd `dirname $0`

FAUX_CAS_PORT=33435
PAYUTC_PORT=33436

echo "Prepare integration"
if [ -f ../config.inc.php ]
then
    echo "Move config.inc.php to config.inc.php.bak"
    mv ../config.inc.php config.inc.php.bak
fi
echo "Copy test config"
cp config.inc.php ../

echo "Get faux-cas"
if [ -d faux-cas ]
then
    cd faux-cas
    git pull
    cd ..
else
    git clone git://github.com/payutc/faux-cas.git
fi
echo "Starting faux-cas server on port $FAUX_CAS_PORT"
php -S localhost:$FAUX_CAS_PORT -t faux-cas/ &
echo "Starting payutc server on port $PAYUTC_PORT"
php -S localhost:$PAYUTC_PORT -t ../web/ &
