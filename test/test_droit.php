<?php

set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/Right.class.php';

/*
$Right = new Right(0, 'Droit A', 'test de droit');
echo '<h2>Droit pas admin</h2>';
echo $Right->getId();
echo $Right->getName();
echo $Right->getDescription();
echo $Right->getAdmin();

$Right = new Right(0, 'Droit Admin A', 'test de droit admin', 1);
echo '<h2>Droit admin</h2>';
echo $Right->getId();
echo $Right->getName();
echo $Right->getDescription();
echo $Right->getAdmin();
*/

echo '<h2>Tests</h2>';
/*
$Right = new Right(2);
echo $Right->getId();
echo $Right->getName();
echo $Right->getDescription();
echo $Right->getAdmin();
echo $Right->setDescription('pouet');
echo $Right->setAdmin(0);
echo $Right->getDescription();
echo $Right->getAdmin();
//echo $Right->remove();
echo '<h2>Ajout droits</h2>';
echo $Right->addUserToDroit(1, 16545452, 41275786, 2);
echo $Right->addUserToDroit(1, 16545452, 141275786, 0, 3);
$Right = new Right(1);
echo $Right->addUserToDroit(1, 19545452, 412757865);
echo $Right->addUserToDroit(1, 16545452, 141275786, 1, 3);
*/

$Right = new Right(2);
$Right->removeUserFromDroit(6);

?>