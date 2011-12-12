<?php

set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/Buyer.class.php';
require_once 'class/Seller.class.php';

//$newPoint = new Point(0, 'Foyer');
//echo $newPoint->getName();

echo '<h2>Ok id etu</h2>';
$User = new Buyer('6362', 2, '', 1);
echo $User->getState();

echo $User->getCredit();

echo $User->hasDroit('Droit A', 1, 1);
echo $User->hasDroit('Droit A');
echo $User->hasDroit('Droit A', 3, 1);
echo $User->hasDroit('point_admin', 3);
echo $User->hasDroit('point_admin', 0, 2);
echo $User->hasDroit('point_admin', 1, 1);
echo $User->hasDroit('Droit B', 1, 1);

echo '<h2>groupes</h2>';
echo '<pre>';
print_r($User->getGroups());
echo '</pre>';

echo '<h2>identity</h2>';
echo '<pre>';
print_r($User->getIdentity());
echo '</pre>';

/*

echo '<h2>test Seller</h2>';
$User = new Seller('6362', 2, 'toto', 0, 'hioh', 3);
echo $User->getState();
echo $User->isAllowedOnPoint();

*/

/*
echo '<h2>Ok id buckutt</h2>';
$User = new User('1', 3, '', 1);
echo $User->getState();

echo '<h2>Ok login</h2>';
$User = new User('bernardx', 1, '', 1);
echo $User->getState();

echo '<h2>usr inconnu</h2>';
$User = new User('636462', 2, '', 1);
echo $User->getState();
echo $User->getFirstname();

echo '<h2>Avec mot de passe</h2>';
$User = new User('bernardx', 1, 'toto');
echo $User->getState().'<br />';
echo $User->getId().'<br />';
echo $User->getFirstname().'<br />';
echo $User->getLastname().'<br />';
echo $User->getNickname().'<br />';
echo $User->getMail().'<br />';
echo $User->getCredit().'<br />';
echo $User->getIp();

*/



/*
echo '<h2>Avec mot de passe faux</h2>';
$User = new User('6362', 2, 'pezfzev');
echo $User->getState();
echo $User->getLastname();
*/
?>