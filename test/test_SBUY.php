<?php

set_include_path(dirname( _FILE_ ).'/../');


echo '<h1>Test FADMIN</h1>';
require_once 'SADMIN.class.php';
require_once 'BADMIN.class.php';
require_once 'FADMIN.class.php';

$FADMIN = new FADMIN();
echo $FADMIN->login('bernardx', 1, '5546', 'ttt');


//$BADMIN = new BADMIN();
//echo $BADMIN->login('bernardx', 1, '5546', 'ttt');
//echo '<pre>';
//print_r($BADMIN->getUserDroits());
//echo '</pre>';
//echo $BADMIN->addFundation('toto');

//echo '<h2>client</h2>';
//$client = new SoapClient("http://buckutt.dyndns.org/server/SADMIN.class.php?wsdl");
//echo $client->login('bernardx', 1, '5546', 'ttt');
//echo $client->getEpargne();
//echo $client->hasDroitsInFundations();



//echo '<h2>Un mec se logue avec mdp</h2>';
//echo $SADMIN->login('bernardx', 1, '5546', 'ttt');

//echo '<pre>';
//print_r($SADMIN->getUserDroits());
//echo '</pre>';

//echo $SADMIN->hasDroitsInFundations();

//echo $SADMIN->resetKey('bernardx', 'xavier.bernard@utt.fr');

//echo $BADMIN->getAllFundations();

//echo $BADMIN->getAllRightsAdminLight();

//echo $BADMIN->getAllUsersFromRight(7);

//echo $SADMIN->changeKeySecure('5546', '5547', '5547');

//echo $SADMIN->getHistoriqueAchats(time() - (5 * 24 * 60 * 60), time());

/*
$client = new SoapClient("http://buckutt.dyndns.org/server/PBUY.class.php?wsdl");

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
