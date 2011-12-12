<?php

set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/Fundation.class.php';
require_once 'class/Group.class.php';

/*
$Fundation = new Fundation(1);
$Group = new Group(0, $Fundation, 'groupe 1', 0, 1);
echo '<h2>1</h2>';
echo $Group->getId();
echo $Group->getName();
echo $Group->getOpen();
echo $Group->getIsPublic();

$Fundation = new Fundation(2);
$Group = new Group(0, $Fundation, 'groupe 2');
echo '<h2>2</h2>';
echo $Group->getId();
echo $Group->getName();
echo $Group->getOpen();
echo $Group->getIsPublic();
*/

echo '<h2>ajout dans groupe</h2>';

/*
$Group = new Group(1);
echo $Group->getId();
echo $Group->getName();
echo $Group->getOpen();
echo $Group->getIsPublic();
echo $Group->addUserToGroup(1, 16545452, 141275786);
$Group = new Group(2);
echo $Group->addUserToGroup(2, 16545452, 341275786);
*/
$Group = new Group(1);
echo $Group->remove();
echo $Group->removeUserFromGroup(7);

?>