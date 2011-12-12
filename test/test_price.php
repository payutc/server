<?php

set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/Object.class.php';
require_once 'class/Group.class.php';
require_once 'class/Price.class.php';

//Pour créer un prix, on a besoin d'un objet et d'un groupe
$Objet = new Object(2);
$Group = new Group(2);
$Group1 = new Group(1);

/*
echo '<h2>Création</h2>';
$Price = new Price(0, $Objet, $Group, 150);

echo $Price->getState();
echo $Price->getId();
echo $Price->getObject()->getName();
echo $Price->getGroup()->getName();
*/

echo '<h2>Lecture</h2>';
$Price = new Price(1);
echo $Price->getState();
echo $Price->getId();
echo $Price->getObject()->getName();
echo $Price->getGroup()->getName();
//echo $Price->setCredit(50);
//echo $Price->setGroup($Group);
echo $Price->remove();

?>