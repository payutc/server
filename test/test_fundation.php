<?php

set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/Fundation.class.php';

//$Fundation = new Fundation(0, 'BDE UTT');
//echo '<h2>Création</h2>';
//echo $Fundation->getName();

$Fundation = new Fundation(4);
echo '<h2>Id</h2>';
echo $Fundation->getId();
echo '<h2>Nom</h2>';
echo $Fundation->getName();
echo '<h2>Etat</h2>';
echo $Fundation->getState();
echo '<h2>Changer le nom</h2>';
echo $Fundation->setName('BDE UTT 2');
echo '<h2>Nom</h2>';
echo $Fundation->getName();
echo '<h2>Removed</h2>';
echo $Fundation->remove();
?>