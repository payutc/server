<?php

set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/Point.class.php';
require_once 'class/Object.class.php';

//$newPoint = new Point(0, 'Foyer');
//echo $newPoint->getName();

$Point = new Point(2);
echo '<h2>Id</h2>';
echo $Point->getId();
echo '<h2>Nom</h2>';
echo $Point->getName();
echo '<h2>Etat</h2>';
echo $Point->getState();
//echo '<h2>Changer le nom</h2>';
//echo $Point->setName('Foyer2');
//echo '<h2>Nom</h2>';
//echo $Point->getName();
//echo '<h2>Removed</h2>';
//echo $Point->remove();

echo $Point->addObject(new Object(1));
echo $Point->addObject(new Object(2));
echo $Point->addObject(new Object(3));
echo $Point->addObject(new Object(4));




?>