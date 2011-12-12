<?php
//$url = 'http://buckutt.dyndns.org/server/';
$url = 'http://10.10.10.1:8080/';

$wsdlBADMIN = $url.'BADMIN.class.php?wsdl';

if(isset($_POST['queryString'])) {
	$client = new SoapClient($wsdlBADMIN);
	echo $client->getRpcUser($_POST['queryString']);
}
?>