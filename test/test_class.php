<?php
set_include_path(dirname( _FILE_ ).'/../');

require_once 'class/WsdlBase.class.php';

$actionGroup = new WsdlBase();

echo '<h2>Erreur connue</h2>';
echo $actionGroup->getErrorDetail(404);
echo '<h2>Erreur inconnue</h2>';
echo $actionGroup->getErrorDetail(490);
echo '<h2>Erreur texte</h2>';
echo $actionGroup->getErrorDetail("bkiokb");

echo '<h2>Point connu</h2>';
echo $actionGroup->getPoint(3);
echo '<h2>Point inconnu</h2>';
echo $actionGroup->getPoint(490);

echo '<h2>Liste des points</h2>';
echo $actionGroup->getAllPoints();

echo '<h2>Organisme connu</h2>';
echo $actionGroup->getFundation(2);
echo '<h2>Organisme inconnu</h2>';
echo $actionGroup->getFundation(490);
?>