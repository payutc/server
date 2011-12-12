<?php

set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/Object.class.php';
require_once 'class/Period.class.php';
require_once 'class/Sale.class.php';
/*
//Pour créer une vente, on a besoin d'un objet et d'une période
$Objet = new Object(2);
$Period = new Period(11);

echo '<h2>Création</h2>';
$Sale = new Sale(0, $Objet, $Period, 'vente 2');

echo $Sale->getState();
echo $Sale->getId();
echo $Sale->getName();
echo $Sale->getObject()->getName();
echo $Sale->getPeriod()->getDateEnd();
*/

echo '<h2>Lecture</h2>';
$Sale = new Sale(1);
//echo $Sale->setPeriod(new Period(2));
echo $Sale->setName('toto');
echo $Sale->getState();
echo $Sale->getId();
echo $Sale->getName();
echo $Sale->getObject()->getName();
echo $Sale->getPeriod()->getDateEnd();

?>