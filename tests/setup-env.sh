#!/bin/bash


pushd `dirname $0`


echo "Migrating database structure"
php db.php migrations:migrate --no-interaction --configuration=../migrations.xml
echo "If migrations failed, you should probably empty your test database"

PHPVER=`echo "<?php echo PHP_VERSION_ID;" | php`
if [ "$PHPVER" -lt 50400 ]
then
    echo "PHP version < 5.4.0, skipping"
    popd
    exit 0
fi

echo "Get faux-ginger"
if [ -d faux-ginger ]
then
    pushd faux-ginger
    git pull
    popd
else
    git clone git://github.com/simde-utc/faux-ginger.git
fi

echo "Get faux-cas"
if [ -d faux-cas ]
then
    pushd faux-cas
    git pull
    popd
else
    git clone git://github.com/payutc/faux-cas.git
fi


popd

