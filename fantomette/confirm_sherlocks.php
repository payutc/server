<?php 

$client = new SoapClient("https://10.10.10.1:4430/SBUY.class.php?wsdl");
$client->transactionDecode(base64_encode($_POST['DATA']));

?>