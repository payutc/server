<?php

set_include_path(dirname( _FILE_ ).'/../');
//echo '<h1>Test PBUY</h1>';
require_once 'PBUY.class.php';

$WsdlBase = new PBUY();
//echo '<h2>Un mec se logue sans mdp</h2>';
echo $WsdlBase->loadSeller('22000000063625', 4, 'test', 3);
//echo '<h2>On affiche son nom & Co</h2>';
//echo $WsdlBase->getSellerIdentity();


echo '<h2>Un client arrive...</h2>';
echo $WsdlBase->loadBuyer('6362', 2, 'test client');
//echo '<h2>On affiche son nom & Co</h2>';
//echo $WsdlBase->getBuyerIdentity();
echo '<h2>Proposition</h2>';


echo $WsdlBase->isLoadedSeller();


echo $WsdlBase->getProposition();


//echo $WsdlBase->reload(100, 2, 'toto', 267);

/*
echo $WsdlBase->getProposition();
echo $WsdlBase->select(256, 0, 'tt');
echo $WsdlBase->getProposition();
echo $WsdlBase->select(12, 60, 'tt');
echo $WsdlBase->getProposition();
*/


$client = new SoapClient("http://buckutt.dyndns.org/server/PBUY.class.php?wsdl");
//echo $client->loadSeller('22000000063625', 4, 'test', 3);
//echo $client->isLoadedSeller();

//$client = new SoapClient("http://10.10.10.1:8080/PBUY.class.php?wsdl");
//echo $client->loadSeller('22000000063625', 4, 'test', 3);
//echo $client->isLoadedSeller();

/*
echo '<h2>On affiche le nom du point</h2>';
echo $client->getPointName(2);
echo '<h2>Un mec se logue sans mdp</h2>';
echo $client->loadSeller('22000000063624', 4, 'test', 3);
echo '<h2>On affiche son nom & Co</h2>';
echo $client->getSellerIdentity();
echo '<h2>Eventuellement sa photo si on l\'a pas en mémoire</h2>';
//echo $client->getImage(2);
echo '<h2>On envoie son mot de passe</h2>';
echo $client->checkPasswordSeller('toto');
echo '<h2>On teste ses droits (point_man, mode_manuel, reloader, seller</h2>';
echo $client->isPointMan();
echo $client->isModeManuel();
echo $client->isReloader();
echo $client->isSeller();*/
?>
