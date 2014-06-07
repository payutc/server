<?php
//
// OBJECTS DEFINITIONS
//

class util{

	/**
	 * make an array from a payline server response object.
	 * @params : $response : Objet response from payline
	 * @return : Object convert in an array
	 **/
	static function responseToArray($response){

		$array = array();
		foreach($response as $k=>$v){
			if (is_object($v))  {
				$array[$k] = util::responseToArray($v);
			}
			else { $array[$k] = $v;
			}
		}
		return $array;

		return $response;
	}

	static function responseToArrayForGetCards($response){

		$array = array();
		foreach($response as $k=>$v){

			if (is_object($v) && ($k != 'cards' ) )  {
				$array[$k] = util::responseToArrayForGetCards($v);
			}
			else {
				if($k == 'cards' && count($v) == 1 ){
					$array[$k][0] = $v;
				}else{
					$array[$k] = $v;
				}
			}
		}
		return $array;

		return $response;
	}
}

//
// PL_PAYMENT OBJECT DEFINITION
//
class pl_payment{

	// ATTRIBUTES LISTING
	public $amount;
	public $currency;
	public $action;
	public $mode;
	public $contractNumber;
	public $differedActionDate;
}

//
// PL_ORDER OBJECT DEFINITION
//
class pl_order{

	// ATTRIBUTES LISTING
	public $ref;
	public $origin;
	public $country;
	public $taxes;
	public $amount;
	public $currency;
	public $date;
	public $quantity;
	public $comment;
	public $details;
	public $deliveryTime;
	public $deliveryMode;

	function __construct() {
		$this->date = date('d/m/Y H:i', time());
		$this->details = array();
	}
}

//
// PL_PRIVATEDATA OBJECT DEFINITION
//
class pl_privateData{

	// ATTRIBUTES LISTING
	public $key ;
	public $value;
}

//
// PL_AUTHORIZATION OBJECT DEFINITION
//
class  pl_authorization{

	// ATTRIBUTES LISTING
	public $number;
	public $date;
}

//
// PL_ADDRESS OBJECT DEFINITION
//
class  pl_address{

	// ATTRIBUTES LISTING
	public $name;
	public $street1;
	public $street2;
	public $cityName;
	public $zipCode;
	public $country;
	public $phone;
}

//
// PL_OWNERADDRESS OBJECT DEFINITION
//
class  pl_ownerAddress{

	// ATTRIBUTES LISTING
	public $street;
	public $cityName;
	public $zipCode;
	public $country;
	public $phone;
}

//
// PL_BUYER OBJECT DEFINITION
//
class pl_buyer{

	// ATTRIBUTES LISTING
	public $lastName;
	public $firstName;
	public $email;
	public $customerId;
	public $walletId;
	public $walletDisplayed;
	public $walletSecured;
	public $walletCardInd;
	public $shippingAdress;
	public $billingAddress;
	public $accountCreateDate;
	public $accountAverageAmount;
	public $accountOrderCount;
	public $ip;
	public $mobilePhone;

	function __construct() {
		$this->accountCreateDate = date('d/m/y', time());
	}
}

//
// PL_OWNER OBJECT DEFINITION
//
class pl_owner{

	// ATTRIBUTES LISTING
	public $lastName;
	public $firstName;
	public $billingAddress;
	public $issueCardDate;
}

//
// PL_ORDERDETAIL OBJECT DEFINITION
//
class pl_orderDetail{

	// ATTRIBUTES LISTING
	public $ref;
	public $price;
	public $quantity;
	public $comment;
}

//
// PL_CARD OBJECT DEFINITION
//
class pl_card{

	// ATTRIBUTES LISTING
	public $number;
	public $type;
	public $expirationDate;
	public $cvx;
	public $ownerBirthdayDate;
	public $password;
	public $cardPresent;
	public $cardholder;
	public $token;

	function __construct($type) {
		$this->accountCreateDate = date('d/m/y', time());
	}
}

//
// PL_TRANSACTION OBJECT DEFINITION
//
class pl_transaction{

	// ATTRIBUTES LISTING
	public $id;
	public $isPossibleFraud;
	public $isDuplicated;
	public $date;
}


//
// PL_RESULT OBJECT DEFINITION
//
class pl_result{

	// ATTRIBUTES LISTING
	public $code;
	public $shortMessage;
	public $longMessage;
}

//
// PL_CAPTURE OBJECT DEFINITION
//
class pl_capture{

	// ATTRIBUTES LISTING
	public $transactionID;
	public $payment;
	public $sequenceNumber;

	function __construct() {
		$this->payment = new pl_payment();
	}
}

//
// PL_REFUND OBJECT DEFINITION
//
class pl_refund extends pl_capture {
	function __construct() {
		parent::__construct();
	}
}

//
// PL_WALLET OBJECT DEFINITION
//
class pl_wallet{

	// ATTRIBUTES LISTING
	public $walletId;
	public $lastName;
	public $firstName;
	public $email;
	public $shippingAddress;
	public $card;
	public $comment;

	function __construct() {
	}
}

//
// PL_RECURRING OBJECT DEFINITION
//
class pl_recurring{

	// ATTRIBUTES LISTING
	public $firstAmount;
	public $amount;
	public $billingCycle;
	public $billingLeft;
	public $billingDay;
	public $startDate;

	function __construct() {
	}
}

//
// PL_AUTHENTIFICATION 3D SECURE
//
class pl_authentication3DSecure{

	// ATTRIBUTES LISTING
	public $md ;
	public $pares ;
	public $xid ;
	public $eci ;
	public $cavv ;
	public $cavvAlgorithm ;
	public $vadsResult ;
	public $typeSecurisation;

	function __construct() {
	}
}

//
// PL_BANKACCOUNTDATA
//
class pl_bankAccountData{


	// ATTRIBUTES LISTING
	public $countryCode ;
	public $bankCode ;
	public $accountNumber ;
	public $key ;


	function __construct() {
	}
}

//
// PL_CHEQUE
//
class pl_cheque{

	// ATTRIBUTES LISTING
	public $number ;

	function __construct() {
	}
}

final class Log {
	private $filename;
	private $path;

	public function __construct($filename) {
		$this->filename = $filename;
		$tmp = explode(DIRECTORY_SEPARATOR ,dirname(__FILE__));
		
		// up one level from the current directory
		for($i=0,$s = sizeof($tmp)-1; $i<$s; $i++){
			$this->path .= $tmp[$i].DIRECTORY_SEPARATOR;
		}
		$this->path .= 'logs'.DIRECTORY_SEPARATOR;
	}

	public function write($message) {
		$file = $this->path.$this->filename;
		$handle = fopen($file, 'a+');
		fwrite($handle, date('Y-m-d G:i:s') . ' - ' . $message . "\n");
		fclose($handle);
	}
}

//
// PAYLINESDK CLASS
//
class paylineSDK{

	// kit version
	const KIT_VERSION	= 'kit PHP v1.4';
	
	// trace log
	var $paylineTrace;

	// SOAP URL's
	const PAYLINE_NAMESPACE			= 'http://obj.ws.payline.experian.com';
	const WSDL						= 'v4.35.3.wsdl';
	const PROD_ENDPOINT				= 'https://services.payline.com/V4/services/';
	const HOMO_ENDPOINT				= 'https://homologation.payline.com/V4/services/';
	const HOMO_GET_TOKEN_SERVLET	= "https://homologation-webpayment.payline.com/webpayment/getToken";
	const PROD_GET_TOKEN_SERVLET	= "https://webpayment.payline.com/webpayment/getToken";
	
	const DIRECT_API 	= 'DirectPaymentAPI';
	const EXTENDED_API 	= 'ExtendedAPI';
	const WEB_API 		= 'WebPaymentAPI';

	// current endpoint
	private $webServicesEndpoint;
	
	// SOAP ACTIONS CONSTANTS
	const soap_result = 'result';
	const soap_authorization = 'authorization';
	const soap_card = 'card';
	const soap_order = 'order';
	const soap_orderDetail = 'orderDetail';
	const soap_payment = 'payment';
	const soap_transaction = 'transaction';
	const soap_privateData = 'privateData';
	const soap_buyer = 'buyer';
	const soap_owner = 'owner';
	const soap_address = 'address';
	const soap_ownerAddress = 'addressOwner';
	const soap_capture = 'capture';
	const soap_refund = 'refund';
	const soap_refund_auth = 'refundAuthorization';
	const soap_authentication3DSecure = 'authentication3DSecure';
	const soap_bankAccountData = 'bankAccountData';
	const soap_cheque = 'cheque';
	
	const ERR_CODE = 'XXXXX';

	// ARRAY
	public $header_soap;
	public $items;
	public $privates;

	// OPTIONS
	public $cancelURL;
	public $securityMode;
	public $notificationURL;
	public $returnURL;
	public $customPaymentTemplateURL;
	public $customPaymentPageCode;
	public $languageCode;

	// WALLET
	public $walletIdList;

	/**
	 * contructor of PAYLINESDK CLASS
	 **/
	function __construct($merchant_id, $acess_key, $proxy_host, $proxy_port, $proxy_login, $proxy_password, $production) {
		$this->writeTrace('----------------------------------------------------------');
		$this->writeTrace("paylineSDK::__construct($merchant_id, ".$this->maskAccessKey($acess_key).", $proxy_host, $proxy_port, $proxy_login, $proxy_password, $production)");
		$this->header_soap = array();
		$this->header_soap['login'] = $merchant_id;
		$this->header_soap['password'] = $acess_key;
		if($proxy_host != ''){
			$this->header_soap['proxy_host'] = $proxy_host;
			$this->header_soap['proxy_port'] = $proxy_port;
			$this->header_soap['proxy_login'] = $proxy_login;
			$this->header_soap['proxy_password'] = $proxy_password;
		}
		if($production){
			$this->webServicesEndpoint = paylineSDK::PROD_ENDPOINT;
		}else{
			$this->webServicesEndpoint = paylineSDK::HOMO_ENDPOINT;
		}
		$this->header_soap['style'] = SOAP_DOCUMENT;
		$this->header_soap['use'] = SOAP_LITERAL;
		$this->items = array();
		$this->privates = array();
		$this->walletIdList = array();
		
		ini_set('user_agent', "PHP\r\nversion: ".paylineSDK::KIT_VERSION);
	}

	/**
	 * function payment
	 * @params : $array : array. the array keys are listed in pl_payment CLASS.
	 * @return : SoapVar : object
	 * @description : build pl_payment instance from $array and make SoapVar object for payment.
	 **/
	protected function payment($array) {
		$payment = new pl_payment();
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $payment)&&(strlen($v))){
					$payment->$k = $v;
				}
			}
		}
		return new SoapVar($payment, SOAP_ENC_OBJECT, paylineSDK::soap_payment, paylineSDK::PAYLINE_NAMESPACE);
	}

	/**
	 * function order
	 * @params : $array : array. the array keys are listed in pl_order CLASS.
	 * @return : SoapVar : object
	 * @description : build pl_order instance from $array and make SoapVar object for order.
	 **/
	protected function order($array) {
		$order = new pl_order();
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $order)&&(strlen($v))){
					$order->$k = $v;
				}
			}
		}
		$allDetails = array();
		// insert orderDetails
		$order->details = $this->items;
		return new SoapVar($order, SOAP_ENC_OBJECT, paylineSDK::soap_order, paylineSDK::PAYLINE_NAMESPACE);
	}

	/**
	 * function address
	 * @params : $address : array. the array keys are listed in pl_address CLASS.
	 * @return : SoapVar : object
	 * @description : build pl_address instance from $array and make SoapVar object for address.
	 **/
	protected function address($array) {
		$address = new pl_address();
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $address)&&(strlen($v)))$address->$k = $v;
			}
		}
		return new SoapVar($address, SOAP_ENC_OBJECT, paylineSDK::soap_address, paylineSDK::PAYLINE_NAMESPACE);
	}
	
	/**
	* function ownerAddress
	* @params : $address : array. the array keys are listed in pl_address CLASS.
	* @return : SoapVar : object
	* @description : build pl_ownerAddress instance from $array and make SoapVar object for address.
	**/
	protected function ownerAddress($array) {
		$address = new pl_ownerAddress();
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $address)&&(strlen($v)))$address->$k = $v;
			}
		}
		return new SoapVar($address, SOAP_ENC_OBJECT, paylineSDK::soap_ownerAddress, paylineSDK::PAYLINE_NAMESPACE);
	}

	/**
	 * function buyer
	 * @params : $array : array. the array keys are listed in pl_buyer CLASS.
	 * @params : $shippingAdress : array. the array keys are listed in pl_address CLASS.
	 * @params : $billingAddress : array. the array keys are listed in pl_address CLASS.
	 * @return : SoapVar : object
	 * @description : build pl_buyer instance from $array and $address and make SoapVar object for buyer.
	 **/
	protected function buyer($array,$shippingAdress,$billingAddress) {
		$buyer = new pl_buyer();
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $buyer)&&(strlen($v)))$buyer->$k = $v;
			}
		}
		$buyer->shippingAdress = $this->address($shippingAdress);
		$buyer->billingAddress = $this->address($billingAddress);
		return new SoapVar($buyer, SOAP_ENC_OBJECT, paylineSDK::soap_buyer, paylineSDK::PAYLINE_NAMESPACE);
	}
	
	/**
	* function owner
	* @params : $array : array. the array keys are listed in pl_buyer CLASS.
	* @params : $shippingAdress : array. the array keys are listed in pl_address CLASS.
	* @params : $billingAddress : array. the array keys are listed in pl_address CLASS.
	* @return : SoapVar : object
	* @description : build pl_buyer instance from $array and $address and make SoapVar object for buyer.
	**/
	protected function owner($array,$Address) {
		if($array != null){
			$owner = new pl_owner();
			if($array && is_array($array)){
				foreach($array as $k=>$v){
					if(array_key_exists($k, $owner)&&(strlen($v)))$owner->$k = $v;
				}
			}
			$owner->billingAddress = $this->ownerAddress($Address);
			return new SoapVar($owner, SOAP_ENC_OBJECT, paylineSDK::soap_owner, paylineSDK::PAYLINE_NAMESPACE);
		}else{
			return null;
		}
	}

	/**
	 * function contracts
	 * @params : $contracts : array. array of contracts
	 * @return : $contracts : array. the same as params if exist, or an array with default contract defined in
	 * configuration
	 * @description : Add datas to contract array
	 **/
	protected function contracts($contracts) {
		if($contracts && is_array($contracts)){
			return $contracts;
		}
		return null;
	}

	/**
	 * function secondContracts
	 * @params : $secondContracts : array. array of contracts
	 * @return : $secondContracts : array. the same as params if exist, null otherwise
	 * @description : Add datas to contract array
	 **/
	protected function secondContracts($secondContracts) {
		if($secondContracts && is_array($secondContracts)){
			return $secondContracts;
		}
		return null;
	}

	/**
	 * function authentification 3Dsecure
	 * @params : $array : array. the array keys are listed in pl_card CLASS.
	 * @return : SoapVar : object
	 * @description : build pl_authentication3DSecure instance from $array and make SoapVar object for authentication3DSecure.
	 **/
	protected function authentication3DSecure($array) {
		$authentication3DSecure = new pl_authentication3DSecure($array);
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $authentication3DSecure)&&(strlen($v))){
					$authentication3DSecure->$k = $v;
				}
			}
		}
		return new SoapVar($authentication3DSecure, SOAP_ENC_OBJECT, paylineSDK::soap_authentication3DSecure, paylineSDK::PAYLINE_NAMESPACE);
	}

	/**
	 * function authorization
	 * @params : $array : array. the array keys are listed in pl_card CLASS.
	 * @return : SoapVar : object
	 * @description : build pl_authentication3DSecure instance from $array and make SoapVar object for authentication3DSecure.
	 **/
	protected function authorization($array) {
		$authorization = new pl_authorization($array);
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $authorization)&&(strlen($v))){
					$authorization->$k = $v;
				}
			}
		}
		return new SoapVar($authorization, SOAP_ENC_OBJECT, paylineSDK::soap_authorization, paylineSDK::PAYLINE_NAMESPACE);
	}

	/**
	 * function card
	 * @params : $array : array. the array keys are listed in pl_card CLASS.
	 * @return : SoapVar : object
	 * @description : build pl_card instance from $array and make SoapVar object for card.
	 **/
	protected function card($array) {
		$card = new pl_card($array['type']);
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $card)&&(strlen($v))){
					$card->$k = $v;
				}
			}
		}
		return new SoapVar($card, SOAP_ENC_OBJECT, paylineSDK::soap_card, paylineSDK::PAYLINE_NAMESPACE);
	}

	

	/**
	 * function bankAccountData
	 * @params : $array : array. the array keys are listed in pl_bankAccountData CLASS.
	 * @return : SoapVar : object
	 * @description : build pl_bankAccountData instance from $array and make SoapVar object for bankAccountData.
	 **/
	protected function bankAccountData($array) {
		$bankAccountData = new pl_bankAccountData($array);
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $bankAccountData)&&(strlen($v))){
					$bankAccountData->$k = $v;
				}
			}
		}
		return new SoapVar($bankAccountData, SOAP_ENC_OBJECT, paylineSDK::soap_bankAccountData, paylineSDK::PAYLINE_NAMESPACE);
	}

	/**
	 * function cheque
	 * @params : $array : array. the array keys are listed in pl_cheque CLASS.
	 * @return : SoapVar : object
	 * @description : build pl_authentication3DSecure instance from $array and make SoapVar object for cheque.
	 **/
	protected function cheque($array) {
		$cheque = new pl_cheque($array);
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $cheque)&&(strlen($v))){
					$cheque->$k = $v;
				}
			}
		}
		return new SoapVar($cheque, SOAP_ENC_OBJECT, paylineSDK::soap_cheque, paylineSDK::PAYLINE_NAMESPACE);
	}

	/****************************************************/
	// 						WALLET						//
	/****************************************************/

	/**
	 * function wallet
	 * @params : array : array.  the array keys are listed in pl_wallet CLASS.
	 * @params : address : array.  the array keys are listed in pl_address CLASS.
	 * @params : card : array.  the array keys are listed in pl_card CLASS.
	 * @return : wallet: pl_wallet Object.
	 * @description : build a wallet object.
	 **/
	protected function wallet($array,$address,$card) {
		$wallet = new pl_wallet();
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $wallet)&&(strlen($v)))$wallet->$k = $v;
			}
		}

		$wallet->shippingAddress = $this->address($address);
		$wallet->card = $this->card($card);

		return $wallet;
	}

	/**
	 * function recurring
	 * @params : array : array. the array keys are listed in pl_recurring CLASS.
	 * @return : recurring object.
	 * @description : build a recurring object.
	 **/
	protected function recurring($array) {
		if($array){
			$recurring = new pl_recurring();
			if($array && is_array($array)){
				foreach($array as $k=>$v){
					if(array_key_exists($k, $recurring)&&(strlen($v)))$recurring->$k = $v;
				}
			}
			return $recurring;
		}
		else return null;
	}

	/**
	 * function setItem
	 * @params : $item : array. the array keys are listed in PL_ORDERDETAIL CLASS.
	 * @description : Make $item SoapVar object and insert in items array
	 **/
	public function setItem($item) {
		$orderDetail = new pl_orderDetail();
		if($item && is_array($item)){
			foreach($item as $k=>$v){
				if(array_key_exists($k, $orderDetail)&&(strlen($v)))$orderDetail->$k = $v;
			}
		}
		$this->items[] = new SoapVar($orderDetail, SOAP_ENC_OBJECT, paylineSDK::soap_orderDetail, paylineSDK::PAYLINE_NAMESPACE);
	}

	/**
	 * function setPrivate
	 * @params : $private : array.  the array keys are listed in PRIVATE CLASS.
	 * @description : Make $setPrivate SoapVar object  and insert in privates array
	 **/
	public function setPrivate($array) {
		$private = new pl_privateData();
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $private)&&(strlen($v)))$private->$k = $v;
			}
		}
		$this->privates[] = new SoapVar($private, SOAP_ENC_OBJECT, paylineSDK::soap_privateData, paylineSDK::PAYLINE_NAMESPACE);
	}
	
	/**
	* function setWalletIdList
	* @params : sting : string if wallet id separated by ';'.
	* @return :
	* @description : make an array of wallet id .
	**/
	public function setWalletIdList($walletIdList) {
		if ($walletIdList) $this->walletIdList = explode(";", $walletIdList);
		if(empty($walletIdList))$this->walletIdList = array(0) ;
	}
	
	private function maskAccessKey($accessKey){
		$maskedAccessKey = substr($accessKey,0,2);
		$maskedAccessKey .= substr("********************",0,strlen($accessKey)-4);
		$maskedAccessKey .= substr($accessKey,-2);
		return $maskedAccessKey;
	}

	/**
	* @method writeTrace
	* @desc write a trace in Payline log file
	* @param $trace : the string to add in the log file
	*/
	public function writeTrace($trace){
		if(!isset($this->paylineTrace)){
			$this->paylineTrace = new Log(date('Y-m-d',time()).'.log');
		}
		$this->paylineTrace->write($trace);
	}
	
	/**
	* Custom base64 url encoding. Replace unsafe url chars
	*
	* @param string $input
	* @return string
	*/
	public function base64_url_encode($input)
	{
		return strtr(base64_encode($input), '+/=', '-_,');
	}
	
	/**
	 * Custom base64 url decode. Replace custom url safe values with normal
	 * base64 characters before decoding.
	 *
	 * @param string $input
	 * @return string
	 */
	public function base64_url_decode($input)
	{
		return base64_decode(strtr($input, '-_,', '+/='));
	}
	
	// MCRYPT_RIJNDAEL_128 : AES compliant
	public function getEncrypt($message, $accessKey){
		$block = mcrypt_get_block_size('rijndael_128', 'ecb');
		$pad = $block - (strlen($message) % $block);
		$message .= str_repeat(chr($pad), $pad);
		return $this->base64_url_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $accessKey, $message, MCRYPT_MODE_ECB));
	}
	
	public function getDecrypt($message, $accessKey){
		$message = $this->base64_url_decode($message);
		$message = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $accessKey, $message, MCRYPT_MODE_ECB);
		$block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
		$pad = ord($message[($len = strlen($message)) - 1]);
		$len = strlen($message);
		$pad = ord($message[$len-1]);
		$return = substr($message, 0, strlen($message) - $pad);
		$this->writeTrace("getDecrypt($message, $accessKey) = $return");
		return $return; 
	}
	
	public function gzdecode($data,&$filename='',&$error='',$maxlength=null)
	{
		$this->writeTrace("gzdecode($data,$filename,$error,$maxlength)");
		$len = strlen($data);
		if ($len < 18 || strcmp(substr($data,0,2),"\x1f\x8b")) {
			$error = "Not in GZIP format.";
			return null;  // Not GZIP format (See RFC 1952)
		}
		$method = ord(substr($data,2,1));  // Compression method
		$flags  = ord(substr($data,3,1));  // Flags
		if ($flags & 31 != $flags) {
			$error = "Reserved bits not allowed.";
			return null;
		}
		// NOTE: $mtime may be negative (PHP integer limitations)
		$mtime = unpack("V", substr($data,4,4));
		$mtime = $mtime[1];
		$xfl   = substr($data,8,1);
		$os    = substr($data,8,1);
		$headerlen = 10;
		$extralen  = 0;
		$extra     = "";
		if ($flags & 4) {
			// 2-byte length prefixed EXTRA data in header
			if ($len - $headerlen - 2 < 8) {
				return false;  // invalid
			}
			$extralen = unpack("v",substr($data,8,2));
			$extralen = $extralen[1];
			if ($len - $headerlen - 2 - $extralen < 8) {
				return false;  // invalid
			}
			$extra = substr($data,10,$extralen);
			$headerlen += 2 + $extralen;
		}
		$filenamelen = 0;
		$filename = "";
		if ($flags & 8) {
			// C-style string
			if ($len - $headerlen - 1 < 8) {
				return false; // invalid
			}
			$filenamelen = strpos(substr($data,$headerlen),chr(0));
			if ($filenamelen === false || $len - $headerlen - $filenamelen - 1 < 8) {
				return false; // invalid
			}
			$filename = substr($data,$headerlen,$filenamelen);
			$headerlen += $filenamelen + 1;
		}
		$commentlen = 0;
		$comment = "";
		if ($flags & 16) {
			// C-style string COMMENT data in header
			if ($len - $headerlen - 1 < 8) {
				return false;    // invalid
			}
			$commentlen = strpos(substr($data,$headerlen),chr(0));
			if ($commentlen === false || $len - $headerlen - $commentlen - 1 < 8) {
				return false;    // Invalid header format
			}
			$comment = substr($data,$headerlen,$commentlen);
			$headerlen += $commentlen + 1;
		}
		$headercrc = "";
		if ($flags & 2) {
			// 2-bytes (lowest order) of CRC32 on header present
			if ($len - $headerlen - 2 < 8) {
				return false;    // invalid
			}
			$calccrc = crc32(substr($data,0,$headerlen)) & 0xffff;
			$headercrc = unpack("v", substr($data,$headerlen,2));
			$headercrc = $headercrc[1];
			if ($headercrc != $calccrc) {
				$error = "Header checksum failed.";
				return false;    // Bad header CRC
			}
			$headerlen += 2;
		}
		// GZIP FOOTER
		$datacrc = unpack("V",substr($data,-8,4));
		$datacrc = sprintf('%u',$datacrc[1] & 0xFFFFFFFF);
		$isize = unpack("V",substr($data,-4));
		$isize = $isize[1];
		// decompression:
		$bodylen = $len-$headerlen-8;
		if ($bodylen < 1) {
			// IMPLEMENTATION BUG!
			return null;
		}
		$body = substr($data,$headerlen,$bodylen);
		$data = "";
		if ($bodylen > 0) {
			switch ($method) {
				case 8:
					// Currently the only supported compression method:
					$data = gzinflate($body,$maxlength);
					break;
				default:
					$error = "Unknown compression method.";
				return false;
			}
		}  // zero-byte body content is allowed
		// Verifiy CRC32
		$crc   = sprintf("%u",crc32($data));
		$crcOK = $crc == $datacrc;
		$lenOK = $isize == strlen($data);
		if (!$lenOK || !$crcOK) {
			$error = ( $lenOK ? '' : 'Length check FAILED. ') . ( $crcOK ? '' : 'Checksum FAILED.');
			return false;
		}
		return $data;
	}
	
	private function webServiceRequest($array,$WSRequest,$PaylineAPI,$Method){
		try{
			$client = new SoapClient(dirname(__FILE__).'/'.paylineSDK::WSDL, $this->header_soap);
			$client->__setLocation ($this->webServicesEndpoint.$PaylineAPI);
			$this->writeTrace("webServiceRequest($Method) - Location : ".$this->webServicesEndpoint.$PaylineAPI);
			if(isset($array['version'])&& strlen($array['version']))
				$WSRequest['version'] = $array['version'];
			else
				$WSRequest['version'] = '';
			if(isset($array['media'])&& strlen($array['media']))
				$WSRequest['media'] = $array['media'];
			else
				$WSRequest['media'] = '';
			
			switch($Method){
				case 'createMerchant':
					$WSresponse = $client->createMerchant($WSRequest);
					break;
				case 'createWallet':
					$WSresponse = $client->createWallet($WSRequest);
					break;
				case 'createWebWallet':
					$WSresponse = $client->createWebWallet($WSRequest);
					break;
				case 'disablePaymentRecord':
					$WSresponse = $client->disablePaymentRecord($WSRequest);
					break;
				case 'disableWallet':
					$WSresponse = $client->disableWallet($WSRequest);
					break;
				case 'doAuthorization':
					$WSresponse = $client->doAuthorization($WSRequest);
					break;
				case 'doCapture':
					$WSresponse = $client->doCapture($WSRequest);
					break;
				case 'doCredit':
					$WSresponse = $client->doCredit($WSRequest);
					break;
				case 'doDebit':
					$WSresponse = $client->doDebit($WSRequest);
					break;
				case 'doImmediateWalletPayment':
					$WSresponse = $client->doImmediateWalletPayment($WSRequest);
					break;
				case 'doReAuthorization':
					$WSresponse = $client->doReAuthorization($WSRequest);
					break;
				case 'doRecurrentWalletPayment':
					$WSresponse = $client->doRecurrentWalletPayment($WSRequest);
					break;
				case 'doRefund':
					$WSresponse = $client->doRefund($WSRequest);
					break;
				case 'doReset':
					$WSresponse = $client->doReset($WSRequest);
					break;
				case 'doScheduledWalletPayment':
					$WSresponse = $client->doScheduledWalletPayment($WSRequest);
					break;
				case 'doScoringCheque':
					$WSresponse = $client->doScoringCheque($WSRequest);
					break;
				case 'doWebPayment':
					$WSresponse = $client->doWebPayment($WSRequest);
					break;
				case 'enableWallet':
					$WSresponse = $client->enableWallet($WSRequest);
					break;
				case 'getAlertDetails':
					$WSresponse = $client->getAlertDetails($WSRequest);
					break;
				case 'getBalance':
					$WSresponse = $client->getBalance($WSRequest);
					break;
				case 'getCards':
					$WSresponse = $client->getCards($WSRequest);
					break;
				case 'getEncryptionKey':
					$WSresponse = $client->getEncryptionKey($WSRequest);
					break;
				case 'getMerchantSettings':
					$WSresponse = $client->getMerchantSettings($WSRequest);
					break;
				case 'getPaymentRecord':
					$WSresponse = $client->getPaymentRecord($WSRequest);
					break;
				case 'getToken':
					$WSresponse = $client->getToken($WSRequest);
					break;
				case 'getTransactionDetails':
					$WSresponse = $client->getTransactionDetails($WSRequest);
					break;
				case 'getWallet':
					$WSresponse = $client->getWallet($WSRequest);
					break;
				case 'getWebPaymentDetails':
					$WSresponse = $client->getWebPaymentDetails($WSRequest);
					break;
				case 'getWebWallet':
					$WSresponse = $client->getWebWallet($WSRequest);
					break;
				case 'manageWebWallet' :
					$WSresponse = $client->manageWebWallet($WSRequest);
					break;
				case 'transactionsSearch':
					$WSresponse = $client->transactionsSearch($WSRequest);
					break;
				case 'updateWallet':
					$WSresponse = $client->updateWallet($WSRequest);
					break;
				case 'updateWebWallet':
					$WSresponse = $client->updateWebWallet($WSRequest);
					break;
				case 'verifyAuthentication':
					$WSresponse = $client->verifyAuthentication($WSRequest);
					break;
				case 'verifyEnrollment':
					$WSresponse = $client->verifyEnrollment($WSRequest);
					break;
			}
			if($Method == 'getCards'){
				$response = util::responseToArrayForGetCards($WSresponse);
				
			}else{
				$response = util::responseToArray($WSresponse);
			}
			return $response;
		}catch ( Exception $e ) {
			$this->writeTrace("Exception : ".$e->getMessage());
			$ERROR = new pl_result();
			$ERROR->code = paylineSDK::ERR_CODE;
			$ERROR->longMessage = $e->getMessage();
			$ERROR->shortMessage = $e->getMessage();
			return $ERROR;
		}
	}

	public function createWallet($array){
		if(!isset($array['walletContracts'])||!strlen($array['walletContracts'][0]))$array['walletContracts'] = '';
		if(!isset($array['buyer']))$array['buyer'] = null;
		if(!isset($array['billingAddress']))$array['billingAddress'] = null;
		if(!isset($array['shippingAddress']))$array['shippingAddress'] = null;
		if(!isset($array['owner']))$array['owner'] = null;
		if(!isset($array['ownerAddress']))$array['ownerAddress'] = null;
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'wallet' =>  $this->wallet($array['wallet'],$array['address'],$array['card']),
			'buyer' => $this->buyer($array['buyer'],$array['shippingAddress'],$array['billingAddress']),
			'owner' => $this->owner($array['owner'],$array['ownerAddress']),
			'privateDataList' => $this->privates,
			'authentication3DSecure' =>$this->authentication3DSecure($array['3DSecure']),
			'contractNumberWalletList' => $this->secondContracts($array['walletContracts'])
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'createWallet');
	}
	
	public function createWebWallet($array){
		if(isset($array['customPaymentPageCode'])&& strlen($array['customPaymentPageCode'])) $this->customPaymentPageCode = $array['customPaymentPageCode'];
		if(isset($array['cancelURL'])&& strlen($array['cancelURL'])) $this->cancelURL = $array['cancelURL'];
		if(isset($array['notificationURL']) && strlen($array['notificationURL'])) $this->notificationURL = $array['notificationURL'];
		if(isset($array['returnURL'])&& strlen($array['returnURL'])) $this->returnURL = $array['returnURL'];
		if(isset($array['customPaymentTemplateURL'])&& strlen($array['customPaymentTemplateURL'])) $this->customPaymentTemplateURL = $array['customPaymentTemplateURL'];
		if(isset($array['customPaymentPageCode'])&& strlen($array['customPaymentPageCode'])) $this->customPaymentPageCode = $array['customPaymentPageCode'];
		if(isset($array['languageCode'])&& strlen($array['languageCode'])) $this->languageCode = $array['languageCode'];
		if(isset($array['securityMode'])&& strlen($array['securityMode'])) $this->securityMode = $array['securityMode'];
		if(!isset($array['contracts'])||!strlen($array['contracts'][0]))$array['contracts'] = '';
		if(!isset($array['walletContracts'])||!strlen($array['walletContracts'][0]))$array['walletContracts'] = '';
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'selectedContractList' => $this->contracts($array['contracts']),
			'updatePersonalDetails' => $array['updatePersonalDetails'],
			'buyer' => $this->buyer($array['buyer'],$array['shippingAddress'],$array['billingAddress']),
			'languageCode' => $this->languageCode,
			'customPaymentPageCode' => $this->customPaymentPageCode,
			'securityMode' => $this->securityMode,
			'returnURL' => $this->returnURL,
			'cancelURL' => $this->cancelURL,
			'notificationURL' => $this->notificationURL,
			'privateDataList' => $this->privates,
			'customPaymentTemplateURL' => $this->customPaymentTemplateURL,
			'contractNumberWalletList' => $this->secondContracts($array['walletContracts'])
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::WEB_API,'createWebWallet');
	}
	
	public function disablePaymentRecord($array){
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'paymentRecordId' =>  $array['paymentRecordId']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'disablePaymentRecord');
	}
	
	public function disableWallet($array){
		$WSRequest = array (
						'contractNumber' => $array['contractNumber'],
						'walletIdList' =>  $this->walletIdList,
						'cardInd' => $array['cardInd']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'disableWallet');
	}
	
	public function doAuthorization($array){
		if(!isset($array['buyer']))$array['buyer'] = null;
		if(!isset($array['owner']))$array['owner'] = null;
		if(!isset($array['billingAddress']))$array['billingAddress'] = null;
		if(!isset($array['shippingAddress']))$array['shippingAddress'] = null;
		if(!isset($array['ownerAddress']))$array['ownerAddress'] = null;
		if(!isset($array['3DSecure']))$array['3DSecure'] = null;
		if(!isset($array['bankAccountData']))$array['bankAccountData'] = null;
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'card' =>  $this->card($array['card']),
			'order' => $this->order($array['order']),
			'buyer' => $this->buyer($array['buyer'],$array['shippingAddress'],$array['billingAddress']),
			'owner' => $this->owner($array['owner'],$array['ownerAddress']),
			'privateDataList' =>  $this->privates,
			'authentication3DSecure' =>$this->authentication3DSecure($array['3DSecure']),
			'bankAccountData' => $this->bankAccountData($array['bankAccountData'])
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doAuthorization');
	}
	
	public function doCapture($array){
		$WSRequest = array (
			'transactionID' =>$array['transactionID'],
			'payment' =>  $this->payment($array['payment']),
			'privateDataList' =>  $this->privates,
			'sequenceNumber'=>$array['sequenceNumber']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doCapture');
	}
	
	public function doCredit($array){
		if(!isset($array['buyer']))$array['buyer'] = null;
		if(!isset($array['billingAddress']))$array['billingAddress'] = null;
		if(!isset($array['shippingAddress']))$array['shippingAddress'] = null;
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'card' =>  $this->card($array['card']),
			'buyer' => $this->buyer($array['buyer'],$array['shippingAddress'],$array['billingAddress']),
			'privateDataList' => $this->privates,
			'order' => $this->order($array['order']),
			'comment' =>$array['comment']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doCredit');
	}
	
	public function doDebit($array){
		if(!isset($array['buyer']))$array['buyer'] = null;
		if(!isset($array['billingAddress']))$array['billingAddress'] = null;
		if(!isset($array['shippingAddress']))$array['shippingAddress'] = null;
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'card' =>  $this->card($array['card']),
			'order' => $this->order($array['order']),
			'privateDataList' =>  $this->privates,
			'buyer' => $this->buyer($array['buyer'],$array['shippingAddress'],$array['billingAddress']),
			'authentication3DSecure' =>$this->authentication3DSecure($array['3DSecure']),
			'authorization' =>$this->authorization($array['authorization'])
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doDebit');
	}
	
	public function doImmediateWalletPayment($array){
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'order' =>  $this->order($array['order']),
			'walletId' =>  $array['walletId'],
			'cardInd' => $array['cardInd'],
			'cvx' => $array['walletCvx'],
			'privateDataList' => $this->privates
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doImmediateWalletPayment');
	}
	
	public function doReAuthorization($array){
		$WSRequest = array (
			'transactionID' => $array['transactionID'],
			'payment' => $this->payment($array['payment']),
			'order' => $this->order($array['order']),
			'privateDataList' =>  $this->privates
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doReAuthorization');
	}
	
	public function doRecurrentWalletPayment($array){
		if(!isset($array['orderRef']))$array['orderRef'] = null;
		if(!isset($array['orderDate']))$array['orderDate'] = null;
		if(!isset($array['scheduledDate']))$array['scheduledDate'] = null;
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'orderRef' => $array['orderRef'],
			'orderDate' => $array['orderDate'],
			'scheduledDate' => $array['scheduledDate'],
			'walletId' =>  $array['walletId'],
			'cardInd' => $array['cardInd'],
			'recurring' =>  $this->recurring($array['recurring']),
			'privateDataList' =>  $this->privates,
			'order' => $this->order($array['order'])
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doRecurrentWalletPayment');
	}
	
	public function doRefund($array){
		$WSRequest = array (
			'transactionID' =>$array['transactionID'],
			'payment' =>$this->payment($array['payment']),
			'comment' =>$array['comment'],
			'privateDataList' =>  $this->privates,
			'sequenceNumber'=>$array['sequenceNumber']
		);	
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doRefund');
	}
	
	public function doReset($array){
		$WSRequest = array (
			'transactionID' => $array['transactionID'],
			'comment' => $array['comment']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doReset');
	}
	
	public function doScheduledWalletPayment($array){
		if(!isset($array['orderRef']))$array['orderRef'] = null;
		if(!isset($array['orderDate']))$array['orderDate'] = null;
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'orderRef' => $array['orderRef'],
			'orderDate' => $array['orderDate'],
			'scheduledDate' => $array['scheduledDate'],
			'walletId' =>  $array['walletId'],
			'cardInd' => $array['cardInd'],
			'order' =>  $this->order($array['order']),
			'privateDataList' => $this->privates
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doScheduledWalletPayment');
	}
	
	public function doScoringCheque($array){
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'cheque' => $this->cheque($array['cheque']),
			'order' => $this->order($array['order']),
			'privateDataList' => $this->privates
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doScoringCheque');
	}
	
	public function doWebPayment($array){
		if(isset($array['cancelURL'])&& strlen($array['cancelURL'])) $this->cancelURL = $array['cancelURL'];
		if(isset($array['notificationURL']) && strlen($array['notificationURL'])) $this->notificationURL = $array['notificationURL'];
		if(isset($array['returnURL'])&& strlen($array['returnURL'])) $this->returnURL = $array['returnURL'];
		if(isset($array['customPaymentTemplateURL'])&& strlen($array['customPaymentTemplateURL'])) $this->customPaymentTemplateURL = $array['customPaymentTemplateURL'];
		if(isset($array['customPaymentPageCode'])&& strlen($array['customPaymentPageCode'])) $this->customPaymentPageCode = $array['customPaymentPageCode'];
		if(isset($array['languageCode'])&& strlen($array['languageCode'])) $this->languageCode = $array['languageCode'];
		if(isset($array['securityMode'])&& strlen($array['securityMode'])) $this->securityMode = $array['securityMode'];
		if(!isset($array['payment']))$array['payment'] = null;
		if(!isset($array['contracts'])||!strlen($array['contracts'][0]))$array['contracts'] = '';
		if(!isset($array['secondContracts'])||!strlen($array['secondContracts'][0]))$array['secondContracts'] = '';
		if(!isset($array['walletContracts'])||!strlen($array['walletContracts'][0]))$array['walletContracts'] = '';
		if(!isset($array['buyer']))$array['buyer'] = null;
		if(!isset($array['billingAddress']))$array['billingAddress'] = null;
		if(!isset($array['shippingAddress']))$array['shippingAddress'] = null;
		if(!isset($array['recurring']))$array['recurring'] = null;
		$WSRequest = array (
				'payment' => $this->payment($array['payment']),
				'returnURL' => $this->returnURL,
				'cancelURL' => $this->cancelURL,
				'order' => $this->order($array['order']),
				'notificationURL' => $this->notificationURL,
				'customPaymentTemplateURL' => $this->customPaymentTemplateURL,
				'selectedContractList' => $this->contracts($array['contracts']),
				'secondSelectedContractList' => $this->secondContracts($array['secondContracts']),
				'privateDataList' => $this->privates,
				'languageCode' => $this->languageCode,
				'customPaymentPageCode' => $this->customPaymentPageCode,
				'buyer' => $this->buyer($array['buyer'],$array['shippingAddress'],$array['billingAddress']),
				'securityMode' => $this->securityMode,
				'contractNumberWalletList' => $this->secondContracts($array['walletContracts'])
		);
			
		if(isset($array['payment']['mode'])){
			if(($array['payment']['mode'] == "REC") || ($array['payment']['mode'] == "NX")) {
				$WSRequest['recurring'] = $this->recurring($array['recurring']);
			}
		}
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::WEB_API,'doWebPayment');
	}
	
	public function enableWallet($array){
	 	$WSRequest = array (
	 		'contractNumber' => $array['contractNumber'],
	 		'walletId' =>  $array['walletId'],
	 		'cardInd' => $array['cardInd']
	 	);
	 	return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'enableWallet');
	}
	
	public function getAlertDetails($array){
		$WSRequest = array(
			'AlertId' => $array['AlertId'],
			'TransactionId' => $array['TransactionId']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::EXTENDED_API,'getAlertDetails');
	}
	
	public function getBalance($array){
		$WSRequest = array(
			'contractNumber' => $array['contractNumber'],
			'cardID' => $array['cardID']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'getBalance');
	}
	
	public function getCards($array){
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'walletId' =>  $array['walletId'],
			'cardInd' => $array['cardInd']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'getCards');
	}

	public function getEncryptionKey($array){
		$WSRequest = array();
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'getEncryptionKey');
	}
	
	public function getMerchantSettings($array){
		$WSRequest = array();
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'getMerchantSettings');
	}
	
	public function getPaymentRecord($array){
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'paymentRecordId' =>  $array['paymentRecordId']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'getPaymentRecord');
	}
	
	public function getToken($array){
		$WSRequest = array (
			'cardNumber' => $array['cardNumber'],
			'expirationDate' =>  $array['expirationDate'],
			'contractNumber' =>  $array['contractNumber']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'getToken');
	}
	
	public function getTransactionDetails($array){
		$WSRequest = array (
			'transactionId' => $array['transactionId'],
			'orderRef' =>  $array['orderRef'],
			'startDate' => $array['startDate'],
			'endDate' => $array['endDate'],
			'transactionHistory' => $array['transactionHistory'],
			'archiveSearch' => $array['archiveSearch']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::EXTENDED_API,'getTransactionDetails');
	}
	public function getWallet($array){
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'walletId' =>  $array['walletId'],
			'cardInd' => $array['cardInd']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'getWallet');
	}
	
	public function getWebPaymentDetails($array){
		return $this->webServiceRequest($array,$array,paylineSDK::WEB_API,'getWebPaymentDetails');
	}
	
	public function getWebWallet($array){
		return $this->webServiceRequest($array,$array,paylineSDK::WEB_API,'getWebWallet');
	}
	
	public function manageWebWallet($array){
		if(isset($array['cancelURL'])&& strlen($array['cancelURL'])) $this->cancelURL = $array['cancelURL'];
		if(isset($array['notificationURL']) && strlen($array['notificationURL'])) $this->notificationURL = $array['notificationURL'];
		if(isset($array['returnURL'])&& strlen($array['returnURL'])) $this->returnURL = $array['returnURL'];
		if(!isset($array['buyer']))$array['buyer'] = null;
		if(!isset($array['billingAddress']))$array['billingAddress'] = null;
		if(!isset($array['shippingAddress']))$array['shippingAddress'] = null;
		if(!isset($array['owner']))$array['owner'] = null;
		if(!isset($array['ownerAddress']))$array['ownerAddress'] = null;
		if(!isset($array['contracts'])||!strlen($array['contracts'][0]))$array['contracts'] = '';
		if(!isset($array['walletContracts'])||!strlen($array['walletContracts'][0]))$array['walletContracts'] = '';
		if(isset($array['customPaymentPageCode'])&& strlen($array['customPaymentPageCode'])) $this->customPaymentPageCode = $array['customPaymentPageCode'];
		if(isset($array['customPaymentTemplateURL'])&& strlen($array['customPaymentTemplateURL'])) $this->customPaymentTemplateURL = $array['customPaymentTemplateURL'];
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'selectedContractList' => $this->contracts($array['contracts']),
			'updatePersonalDetails' => $array['updatePersonalDetails'],
			'buyer' => $this->buyer($array['buyer'],$array['shippingAddress'],$array['billingAddress']),
			'owner' => $this->owner($array['owner'],$array['ownerAddress']),
			'languageCode' => $array['languageCode'],
			'customPaymentPageCode' => $array['customPaymentPageCode'],
			'securityMode' => $array['securityMode'],
			'returnURL' => $this->returnURL,
			'cancelURL' => $this->cancelURL,
			'notificationURL' => $this->notificationURL,
			'privateDataList' => $this->privates,
			'customPaymentTemplateURL' => $array['customPaymentTemplateURL'],
			'contractNumberWalletList' => $this->secondContracts($array['walletContracts']) 
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::WEB_API,'manageWebWallet');
	}
	
	public function transactionsSearch($array){
		$WSRequest = array (
			'transactionId' => $array['transactionId'],
			'orderRef' => $array['orderRef'],
			'startDate' =>  $array['startDate'],
			'endDate' =>  $array['endDate'],
			'contractNumber' => $array['contractNumber'],
			'authorizationNumber' =>  $array['authorizationNumber'],
			'returnCode'  => $array['returnCode'],
			'paymentMean' =>  $array['paymentMean'],
			'transactionType' =>  $array['transactionType'],
			'name' =>  $array['name'],
			'firstName' =>  $array['firstName'],
			'email' =>  $array['email'],
			'cardNumber' =>  $array['cardNumber'],
			'currency' =>  $array['currency'],
			'minAmount' =>  $array['minAmount'],
			'maxAmount' =>  $array['maxAmount'],
			'walletId' =>  $array['walletId'],
			'sequenceNumber' => $array['sequenceNumber'],
			'token' => $array['token']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::EXTENDED_API,'transactionsSearch');
	}
	
	public function updateWallet($array){
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'cardInd' => $array['cardInd'],
			'wallet' => $this->wallet($array['wallet'],$array['address'],$array['card']),
			'buyer' => $this->buyer($array['buyer'], $array['shippingAddress'],$array['billingAddress']),
			'owner' => $this->owner($array['owner'],$array['ownerAddress']),
			'privateDataList' => $this->privates,
			'authentication3DSecure' =>$this->authentication3DSecure($array['3DSecure']),
			'contractNumberWalletList' => $this->secondContracts($array['walletContracts'])
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'updateWallet');
	}
	
	public function updateWebWallet($array){
		if(isset($array['cancelURL'])&& strlen($array['cancelURL'])) $this->cancelURL = $array['cancelURL'];
		if(isset($array['notificationURL']) && strlen($array['notificationURL'])) $this->notificationURL = $array['notificationURL'];
		if(isset($array['returnURL'])&& strlen($array['returnURL'])) $this->returnURL = $array['returnURL'];
		if(isset($array['customPaymentTemplateURL'])&& strlen($array['customPaymentTemplateURL'])) $this->customPaymentTemplateURL = $array['customPaymentTemplateURL'];
		if(isset($array['customPaymentPageCode'])&& strlen($array['customPaymentPageCode'])) $this->customPaymentPageCode = $array['customPaymentPageCode'];
		if(isset($array['languageCode'])&& strlen($array['languageCode'])) $this->languageCode = $array['languageCode'];
		if(isset($array['securityMode'])&& strlen($array['securityMode'])) $this->securityMode = $array['securityMode'];
		if(!isset($array['walletContracts'])||!strlen($array['walletContracts'][0]))$array['walletContracts'] = '';
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'cardInd' => $array['cardInd'],
			'walletId' => $array['walletId'],
			'updatePersonalDetails' => $array['updatePersonalDetails'],
			'updateOwnerDetails' => $array['updateOwnerDetails'],
			'updatePaymentDetails' => $array['updatePaymentDetails'],
			'buyer' => $this->buyer($array['buyer'],$array['shippingAddress'],$array['billingAddress']),
			'languageCode' => $this->languageCode,
			'customPaymentPageCode' => $this->customPaymentPageCode,
			'securityMode' => $this->securityMode,
			'returnURL' => $this->returnURL,
			'cancelURL' => $this->cancelURL,
			'notificationURL' => $this->notificationURL,
			'privateDataList' => $this->privates,
			'customPaymentTemplateURL' => $this->customPaymentTemplateURL,
			'contractNumberWalletList' => $this->secondContracts($array['walletContracts'])
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::WEB_API,'updateWebWallet');
	}
	
	public function verifyAuthentication($array){
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'pares' =>  $array['pares'],
			'md' =>  $array['md'],
			'card' =>  $this->card($array['card'])
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'verifyAuthentication');
	}
	
	public function verifyEnrollment($array){
		if(!isset($array['orderRef']))$array['orderRef'] = null;
		if(!isset($array['userAgent']))$array['userAgent'] = null;
		if(!isset($array['mdFieldValue']))$array['mdFieldValue'] = null;
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'card' =>  $this->card($array['card']),
			'orderRef' => $array['orderRef'],
			'userAgent' => $array['userAgent'],
			'mdFieldValue' => $array['mdFieldValue']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'verifyEnrollment');
	}
}

?>