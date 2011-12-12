<?php

set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/Point.class.php';
require_once 'class/User.class.php';
require_once 'class/Proposition.class.php';
require_once 'class/Object.class.php';
require_once 'class/Price.class.php';

//Pour créer une proposition, on a besoin d'un user et d'un point
$User = new User('6362', 2, '', 1);
echo $User->getId();
$Point = new Point(2);
echo $Point->getId();

echo '<h2>Création</h2>';
$Proposition = new Proposition($User, $Point);
echo $Proposition->getUser()->getFirstname();
echo $Proposition->getPoint()->getName();

$Propo = &$Proposition->getObjectList();
echo '<pre>';
echo $Propo[0]->getName();
echo '</pre>';

$Object = new Object(2);

echo Price::checkPrice($User, $Point, $Object, 150);
echo Price::checkPrice($User, $Point, $Object, 50);
?>