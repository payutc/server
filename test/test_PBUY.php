<?php

set_include_path(dirname( _FILE_ ).'/../');

echo '<h1>Test PBUY</h1>';
require_once 'PBUY.class.php';

$WsdlBase = new PBUY();
//echo '<h2>Erreur</h2>';
//echo $WsdlBase->getErrorDetail(404);
//echo $WsdlBase->getImage(2);
//echo '<h2>AllPoints</h2>';
//echo $WsdlBase->getAllPoints();

echo '<h2>On affiche le nom du point</h2>';
echo $WsdlBase->getPointName(2);
echo '<h2>Un mec se logue sans mdp</h2>';
echo $WsdlBase->loadSeller('6362', 2, 'test', 2);
echo '<h2>On affiche son nom & Co</h2>';
echo $WsdlBase->getSellerIdentity();
echo '<h2>Eventuellement sa photo si on l\'a pas en mémoire</h2>';
//echo $client->getImage(2);
//echo '<h2>On envoie son mot de passe</h2>';
//echo $WsdlBase->checkPasswordSeller('toto');
echo '<h2>On teste ses droits (point_man, mode_manuel, reloader, seller</h2>';
echo $WsdlBase->isPointMan();
echo $WsdlBase->isModeManuel();
echo $WsdlBase->isReloader();
echo $WsdlBase->isSeller();

//echo '<h2>Si point_man, il peut afficher la liste des points...</h2>';
//echo $WsdlBase->getAllPoints();
//echo '<h2>... et en sélectionner un</h2>';
//echo $WsdlBase->setPoint(1);
//echo '<h2>On teste ses droits (point_man, mode_manuel, reloader, seller</h2>';
//echo $WsdlBase->isPointMan();
//echo $WsdlBase->isModeManuel();
//echo $WsdlBase->isReloader();
//echo $WsdlBase->isSeller();


/*
echo '<h2>Un client arrive...</h2>';
echo $WsdlBase->loadBuyer('6362', 2, 'test client');
echo '<h2>On affiche son nom & Co</h2>';
echo $WsdlBase->getBuyerIdentity();
*/
/*
echo '<h2>Et veut recharger. Liste des points dispos</h2>';
echo $WsdlBase->getTypeRecharge();
echo '<h2>Et il recharge de 5 euros</h2>';
echo $WsdlBase->reload('500', 2, 'test');
*/

/*
echo '<h2>Que peut-il acheter ?</h2>';
echo $WsdlBase->getProposition();
echo $WsdlBase->select(8, 100, 'test promo');
echo '<h2>Quoi dans la promo ?</h2>';
echo $WsdlBase->getProposition();
echo $WsdlBase->select(3, -1, 'test promo');
echo $WsdlBase->getProposition();
echo $WsdlBase->select(4, -1, 'test promo');
echo '<h2>Retour normal</h2>';
echo $WsdlBase->getProposition();
echo $WsdlBase->select(1, 200, 'test');
echo $WsdlBase->getProposition();
echo $WsdlBase->select(1, 250, 'test');
echo '<h2>Panier</h2>';
echo $WsdlBase->getCartCsv();
echo $WsdlBase->getProposition();
echo $WsdlBase->select(2, 0, 'test');
echo $WsdlBase->getProposition();
echo $WsdlBase->select(3, 60, 'test');
echo $WsdlBase->getProposition();
echo '<h2>Panier</h2>';
echo $WsdlBase->getCartCsv();
*/

//echo $WsdlBase->cancelCart();
//echo $WsdlBase->endTransaction();

//echo '<h1>Test WSDL</h1>';

//include_once 'nusoap.php';

//$client = new SoapClient("http://buckutt.dyndns.org/server/PBUY.class.php?wsdl");

//$client = new nusoap_client("http://buckutt.dyndns.org/server/PBUY.class.php?wsdl", true);
//echo $client;
//echo '<h2>Erreur</h2>';
//echo $client->getErrorDetail(404);

//echo '<h2>AllPoints</h2>';
//echo $client->getAllPoints();
//echo '<h2>BUG NamePoint</h2>';
//echo $client->getPointName(2);

/*
echo '<h2>On affiche le nom du point</h2>';
echo $client->getPointName(2);
echo '<h2>Un mec se logue sans mdp</h2>';
echo $client->loadSeller('6362', 2, 'test', 2);
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
echo $client->isSeller();
*/
//echo '<h2>Si point_man, il peut afficher la liste des points...</h2>';
//echo $client->getAllPoints();
//echo '<h2>... et en sélectionner un</h2>';
//echo $client->setPoint(1);
//echo '<h2>On teste ses droits (point_man, mode_manuel, reloader, seller</h2>';
//echo $client->isPointMan();
//echo $client->isModeManuel();
//echo $client->isReloader();
//echo $client->isSeller();

/*
echo '<h2>Un client arrive...</h2>';
echo $client->loadBuyer('6362', 2, 'test client');
echo '<h2>On affiche son nom & Co</h2>';
echo $client->getBuyerIdentity();
*/
/*
echo '<h2>Et veut recharger. Liste des points dispos</h2>';
echo $client->getTypeRecharge();
echo '<h2>Et il recharge de 5 euros</h2>';
echo $client->reload('500', 2, 'test');
*/
/*
echo '<h2>Que peut-il acheter ?</h2>';
echo $client->getProposition();
echo $client->select(8, 100, 'test promo');
echo '<h2>Quoi dans la promo ?</h2>';
echo $client->getProposition();
echo $client->select(3, -1, 'test promo');
echo $client->getProposition();
echo $client->select(4, -1, 'test promo');
echo '<h2>Retour normal</h2>';
echo $client->getProposition();
echo $client->select(1, 200, 'test');
echo $client->getProposition();
echo $client->select(1, 250, 'test');
echo $client->getProposition();
*/
?>
