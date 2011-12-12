<?php

$client = new SoapClient("http://buckutt.dyndns.org/server/PBUY.class.php?wsdl");
echo 1;
//include "PBUY.class.php";
echo 2;
//$client = new PBUY();

echo 3;
//echo $client->loadPreseller(1,1);
echo 4;
echo $client->login(6362, "5546", 2, 0, 1);
echo 5;
//$client->loadBuyer(1, 0);
//echo $client->getMyPropositions();
//echo $client->getObjectImage(7, 1);

echo $client->getSellerIdentity();

echo 6;
//echo $client->getHitsPropositions();
echo 7;





?>
