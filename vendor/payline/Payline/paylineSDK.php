<?php
//
// Payline Class
// Copyright Monext
//
require_once('jIniFileModifier.php');
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
	const KIT_VERSION		= 'kit PHP version 1.2.2';
	
	// trace log
	var $paylineTrace;

	// SOAP URL's
	const PAYLINE_NAMESPACE	= 'http://obj.ws.payline.experian.com';
	const WSDL				= 'Payline.wsdl';
	const PROD_ENDPOINT		= 'https://services.payline.com/V4/services/';
	const PROD_ENDPOINT_HD	= 'https://services.payline.com/V4/services/';
	const HOMO_ENDPOINT		= 'https://homologation.payline.com/V4/services/';
	const HOMO_ENDPOINT_HD	= 'https://homologation.payline.com/V4/services/';
	
	const DIRECT_API 		= 'DirectPaymentAPI';
	const EXTENDED_API 		= 'ExtendedAPI';
	const WEB_API 			= 'WebPaymentAPI';

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
	const soap_address = 'address';
	const soap_capture = 'capture';
	const soap_refund = 'refund';
	const soap_refund_auth = 'refundAuthorization';
	const soap_authentication3DSecure = 'authentication3DSecure';
	const soap_bankAccountData = 'bankAccountData';
	const soap_cheque = 'cheque';

	// Target environment
	public $production;

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

	// SWITCHING VAR
	public $NMAX_TENTATIVE = PRIMARY_MAX_FAIL_RETRY;
	public $CALL_TIMEOUT = PRIMARY_CALL_TIMEOUT;
	public $RETRY_TIMEOUT = PRIMARY_REPLAY_TIMER;
	public $PRIMARY = true ;
	public $CURRENT_NUMBER_CALL = 0;
	public $DEFAULT_SOCKET_TIMEOUT = 0;

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
		$this->production = $production;
		$this->header_soap['style'] = SOAP_DOCUMENT;
		$this->header_soap['use'] = SOAP_LITERAL;
		$this->header_soap['version'] = paylineSDK::KIT_VERSION;
		$this->header_soap['connection_timeout'] = $this->CALL_TIMEOUT;
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
	 * function buyer
	 * @params : $array : array. the array keys are listed in pl_buyer CLASS.
	 * @params : $address : array. the array keys are listed in pl_address CLASS.
	 * @return : SoapVar : object
	 * @description : build pl_buyer instance from $array and $address and make SoapVar object for buyer.
	 **/
	protected function buyer($array,$address) {
		$buyer = new pl_buyer();
		if($array && is_array($array)){
			foreach($array as $k=>$v){
				if(array_key_exists($k, $buyer)&&(strlen($v)))$buyer->$k = $v;
			}
		}
		$buyer->shippingAdress = $this->address($address);
		return new SoapVar($buyer, SOAP_ENC_OBJECT, paylineSDK::soap_buyer, paylineSDK::PAYLINE_NAMESPACE);
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
		return array(CONTRACT_NUMBER);
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
		return new SoapVar(null, SOAP_ENC_OBJECT, paylineSDK::soap_bankAccountData, paylineSDK::PAYLINE_NAMESPACE);
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

	private function IsSwitchingEnabled($Method){
		$Enabled = false;
		$ListeWS = PAYLINE_WS_SWITCH_ENABLE;
		$ArrayWS = explode(",",$ListeWS);
		foreach($ArrayWS as $Key => $Value){
			if($Method === $Value){
				$Enabled = true;
			}
		}
		return $Enabled;
	}

	// Param\E9trage Switch Primary
	private function SwitchToPrimary(){
		$this->NMAX_TENTATIVE = PRIMARY_MAX_FAIL_RETRY;
		$this->CALL_TIMEOUT = PRIMARY_CALL_TIMEOUT;
		$this->RETRY_TIMEOUT = PRIMARY_REPLAY_TIMER;
		$this->PRIMARY = true;
		$this->CURRENT_NUMBER_CALL = 0;
		$this->header_soap['connection_timeout'] = $this->CALL_TIMEOUT;
		if($this->production){
			$this->webServicesEndpoint = paylineSDK::PROD_ENDPOINT;
		}else{
			$this->webServicesEndpoint = paylineSDK::HOMO_ENDPOINT;
		}
	}

	// Param\E9trage Switch Secondary
	private function SwitchToSecondary(){
		$this->NMAX_TENTATIVE = SECONDARY_MAX_FAIL_RETRY;
		$this->CALL_TIMEOUT = SECONDARY_CALL_TIMEOUT;
		$this->RETRY_TIMEOUT = SECONDARY_REPLAY_TIMER;
		$this->PRIMARY = false;
		$this->CURRENT_NUMBER_CALL = 0;
		$this->header_soap['connection_timeout'] = $this->CALL_TIMEOUT;
		if(PRODUCTION){
			$this->webServicesEndpoint = paylineSDK::PROD_ENDPOINT_HD;
		}else{
			$this->webServicesEndpoint = paylineSDK::HOMO_ENDPOINT_HD;
		}
	}

	private function IsForceSwitch($Force){
		$bool = false;
		if(isset($Force) && !empty($Force)){
			$bool = true;
		}else{
			$bool = false;
		}
		return $bool;
	}

	private function CheckForSwitching(){
		$bool = false ;
		$ini_array = parse_ini_file(INI_FILE);
		$TimeEndSwitch = $ini_array['TimeEndSwitch'];
		$CurrentTime = time();
		if(isset($TimeEndSwitch) && !empty($TimeEndSwitch)){
			if($TimeEndSwitch > $CurrentTime){
				$bool = true;
				return $bool;
			}else{
				$bool = false;
				return $bool;
			}
		}else{
			$bool = false;
			return $bool;
		}
	}
	private function CheckForError($response){
		$ErrCheck = false;
		$ErrList = PAYLINE_ERR_CODE;
		$ArrayErr = explode(",",$ErrList);
		foreach($ArrayErr as $Key => $Value){
			if($response['result']['code'] === $Value){
				$ErrCheck = true;
			}
		}
		return $ErrCheck;
	}

	private function CheckForTokenError($response){
		$ErrCheck = false;
		$ErrList = PAYLINE_ERR_TOKEN;
		$ArrayErr = explode(",",$ErrList);
		foreach($ArrayErr as $Key => $Value){
			if($response['result']['code'] === $Value){
				$ErrCheck = true;
			}
		}
		return $ErrCheck;
	}

	private function init_config($Method,$ForceSwitch,$ForceValue){
		if($this->IsSwitchingEnabled($Method)){
			if(isset($ForceSwitch) && $this->IsForceSwitch($ForceSwitch)){
				if(isset($ForceValue) && $ForceValue == "Primaire"){
					$this->SwitchToPrimary();
				}else if(isset($ForceValue) && $ForceValue == "Secondaire"){
					$this->SwitchToSecondary();
				}
			}else{
				if($this->CheckForSwitching()){
					$this->SwitchToSecondary();
				}else{
					$this->SwitchToPrimary();
				}
			}
		}else{
			if(isset($ForceSwitch) && $this->IsForceSwitch($ForceSwitch)){
				if(isset($ForceValue) && $ForceValue == "Primaire"){
					$this->SwitchToPrimary();
				}else if(isset($ForceValue) && $ForceValue == "Secondaire"){
					$this->SwitchToSecondary();
				}
			}else{
				$this->SwitchToPrimary();
			}
		}
	}

	private function CheckEndSwitch(){
		$bool = false ;
		$ini_array = parse_ini_file(INI_FILE);
		$TimeEndSwitch = $ini_array['TimeEndSwitch'];
		$EndSwitch = $ini_array['EndSwitchTry'];
		$CurrentTime = time();
		if(isset($TimeEndSwitch) && !empty($TimeEndSwitch)){
			if(($CurrentTime > $TimeEndSwitch) && $EndSwitch == 1 && $this->PRIMARY){
				$bool = true;
			}
		}
		return $bool;
	}


	private function SetCallSocketTimeOut(){
		$this->DEFAULT_SOCKET_TIMEOUT = ini_get('default_socket_timeout');
		ini_set('default_socket_timeout', $this->CALL_TIMEOUT);
	}
	
	private function SetDefaultSocketTimeOut(){
		ini_set('default_socket_timeout', $this->DEFAULT_SOCKET_TIMEOUT);
	}
	
	private function VerifyIfAnotherWShasSwitch($Method){
		if($this->IsSwitchingEnabled($Method) && $this->CheckForSwitching() && $this->PRIMARY){
			$this->SwitchToSecondary();
		}
	}
	private function AddResponseSwitchingChain($Method,$response){
		if($this->IsSwitchingEnabled($Method)){
			$response['Switch']['Wsdl File'] = "$this->WSDL_DIRECT_SOAP";
		}
		return $response;
	}

	private function CheckIniValue($key,$value){
		$bool = false ;
		$ini_array = parse_ini_file(INI_FILE);
		$EndSwitch = $ini_array[$key];
		if(isset($EndSwitch) && !empty($EndSwitch) && $EndSwitch == $value){
			$bool = true;
		}

		return $bool;
	}

	private function Switcher($DateDebut,$Method,$WS,$WSRequest,$WDSL){
		$DateFin = time();
		$this->SetDefaultSocketTimeOut();
		$response = array();
		while($this->NMAX_TENTATIVE >= $this->CURRENT_NUMBER_CALL){
			if($this->PRIMARY){
				if(($this->RETRY_TIMEOUT - ($DateDebut-$DateFin)) >= 0){
					sleep(($this->RETRY_TIMEOUT - ($DateDebut-$DateFin)));
					$DateDebut = 0;
					$DateFin = 0;
				}
			}else{
				sleep($this->RETRY_TIMEOUT);
			}
			try{
				$this->SetCallSocketTimeOut();
				$this->VerifyIfAnotherWShasSwitch($Method);
				$client = new SoapClient($WDSL, $this->header_soap);
				$DateDebut = time();
				$WSresponse = $this->WSCall("$WS",$WSRequest,$client);
				$this->SetDefaultSocketTimeOut();
				$response = util::responseToArray($WSresponse);
				$response = $this->AddResponseSwitchingChain($Method,$response);
				if($this->CheckForError($response)){
					throw new Exception('Technical Error : '+$response['result']['code']+' : '+$response['result']['shortMessage']+' : '+$response['result']['longMessage']);
				}else{
					if($this->CheckEndSwitch() && $this->IsSwitchingEnabled($Method) && !(isset($array['Switch']['Forced']) && $this->IsForceSwitch($array['Switch']['Forced']))){
						if(!$this->CheckIniValue('EndSwitchTry',0)){
							$jIniFileModifier = new jIniFileModifier(INI_FILE);
							$jIniFileModifier->setValue('EndSwitchTry', 0, 'Switcher', null);
							$jIniFileModifier->save();
						}
					}
					return $response;
				}
			}catch (Exception $e){
				$DateFin = time();
				$this->CURRENT_NUMBER_CALL++;
				if(!($this->NMAX_TENTATIVE >= $this->CURRENT_NUMBER_CALL) && $this->PRIMARY){
					$this->SwitchToSecondary();
					$this->CURRENT_NUMBER_CALL = 0;
					$jIniFileModifier = new jIniFileModifier(INI_FILE);
					$jIniFileModifier->setValue('TimeEndSwitch', time()+PAYLINE_SWITCH_BACK_TIMER, 'Switcher', null);
					$jIniFileModifier->save();
					if(!$this->CheckIniValue('EndSwitchTry',1)){
						$jIniFileModifier = new jIniFileModifier(INI_FILE);
						$jIniFileModifier->setValue('EndSwitchTry', 1, 'Switcher', null);
						$jIniFileModifier->save();
					}
				}

			}

		}
		return $response;
	}

	// Fonction qui permet l'utilisation de la plateforme HD et qui corrige le bug de formatage des donn\E9es pour le WS getCards
	private function SwitcherFormatResponse($DateDebut,$Method,$WS,$WSRequest,$WDSL){
		$DateFin = time();
		$this->SetDefaultSocketTimeOut();
		$response = array();
		while($this->NMAX_TENTATIVE >= $this->CURRENT_NUMBER_CALL){
			if($this->PRIMARY){
				if(($this->RETRY_TIMEOUT - ($DateDebut-$DateFin)) >= 0){
					sleep(($this->RETRY_TIMEOUT - ($DateDebut-$DateFin)));
					$DateDebut = 0;
					$DateFin = 0;
				}
			}else{
				sleep($this->RETRY_TIMEOUT);
			}
			try{
				$this->SetCallSocketTimeOut();
				$this->VerifyIfAnotherWShasSwitch($Method);
				$client = new SoapClient($WDSL, $this->header_soap);
				$DateDebut = time();
				$WSresponse = $this->WSCall("$WS",$WSRequest,$client);
				$this->SetDefaultSocketTimeOut();
				$response = util::responseToArrayForGetCards($WSresponse);
				$response = $this->AddResponseSwitchingChain($Method,$response);
				if($this->CheckForError($response)){
					throw new Exception('Technical Error : '+$response['result']['code']+' : '+$response['result']['shortMessage']+' : '+$response['result']['longMessage']);
				}else{
					if($this->CheckEndSwitch() && $this->IsSwitchingEnabled($Method) && !(isset($array['Switch']['Forced']) && $this->IsForceSwitch($array['Switch']['Forced']))){
						if(!$this->CheckIniValue('EndSwitchTry',0)){
							$jIniFileModifier = new jIniFileModifier(INI_FILE);
							$jIniFileModifier->setValue('EndSwitchTry', 0, 'Switcher', null);
							$jIniFileModifier->save();
						}
					}
					return $response;
				}
			}catch (Exception $e){
				$DateFin = time();
				$this->CURRENT_NUMBER_CALL++;
				if(!($this->NMAX_TENTATIVE >= $this->CURRENT_NUMBER_CALL) && $this->PRIMARY){
					$this->SwitchToSecondary();
					$this->CURRENT_NUMBER_CALL = 0;
					$jIniFileModifier = new jIniFileModifier(INI_FILE);
					$jIniFileModifier->setValue('TimeEndSwitch', time()+PAYLINE_SWITCH_BACK_TIMER, 'Switcher', null);
					$jIniFileModifier->save();
					if(!$this->CheckIniValue('EndSwitchTry',1)){
						$jIniFileModifier = new jIniFileModifier(INI_FILE);
						$jIniFileModifier->setValue('EndSwitchTry', 1, 'Switcher', null);
						$jIniFileModifier->save();
					}
				}
			}
		}
		return $response;
	}

	private function WSCall($Method,$WSRequest,$client){
		$response = null ;
		switch ($Method) {
			case "doWebPayment":
				$response = $client->doWebPayment($WSRequest);
				break;
			case "doAuthorization":
				$response = $client->doAuthorization($WSRequest);
				break;
			case "doCapture":
				$response = $client->doCapture($WSRequest);
				break;
			case "doRefund":
				$response = $client->doRefund($WSRequest);
				break;
			case "doCredit":
				$response = $client->doCredit($WSRequest);
				break;
			case "verifyEnrollment":
				$response = $client->verifyEnrollment($WSRequest);
				break;
			case "doDebit":
				$response = $client->doDebit($WSRequest);
				break;
			case "doReset":
				$response = $client->doReset($WSRequest);
				break;
			case "createWallet":
				$response = $client->createWallet($WSRequest);
				break;
			case "getWallet":
				$response = $client->getWallet($WSRequest);
				break;
			case "updateWallet":
				$response = $client->updateWallet($WSRequest);
				break;
			case "createWebWallet":
				$response = $client->createWebWallet($WSRequest);
				break;
			case "updateWebWallet":
				$response = $client->updateWebWallet($WSRequest);
				break;
			case "disableWallet":
				$response = $client->disableWallet($WSRequest);
				break;
			case "enableWallet":
				$response = $client->enableWallet($WSRequest);
				break;
			case "doImmediateWalletPayment":
				$response = $client->doImmediateWalletPayment($WSRequest);
				break;
			case "doScheduledWalletPayment":
				$response = $client->doScheduledWalletPayment($WSRequest);
				break;
			case "doRecurrentWalletPayment":
				$response = $client->doRecurrentWalletPayment($WSRequest);
				break;
			case "getPaymentRecord":
				$response = $client->getPaymentRecord($WSRequest);
				break;
			case "disablePaymentRecord":
				$response = $client->disablePaymentRecord($WSRequest);
				break;
			case "getTransactionDetails":
				$response = $client->getTransactionDetails($WSRequest);
				break;
			case "transactionsSearch":
				$response = $client->transactionsSearch($WSRequest);
				break;
			case "verifyAuthentication":
				$response = $client->verifyAuthentication($WSRequest);
				break;
			case "getEncryptionKey":
				$response = $client->getEncryptionKey($WSRequest);
				break;
			case "getCards":
				$response = $client->getCards($WSRequest);
				break;
			case "doScoringCheque":
				$response = $client->doScoringCheque($WSRequest);
				break;
			case "doReAuthorization":
				$response = $client->doReAuthorization($WSRequest);
				break;
		}
		return $response;
	}

	private function TokenSwitch($token){
		$Check = substr($token,0,1);
		if($Check == PRIMARY_TOKEN_PREFIX){
			$this->SwitchToPrimary();
		}else if($Check == SECONDARY_TOKEN_PREFIX){
			$this->SwitchToSecondary();
		}
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
	
	private function webServiceRequest($array,$WSRequest,$PaylineAPI,$Method){
		try{
			if(isset($array['Switch']['Forced'])){
				$this->init_config($Method,$array['Switch']['Forced'],$array['Switch']['Choice']);
			}else{
				$this->init_config($Method,'','');
			}
			if($this->CheckEndSwitch() && $this->IsSwitchingEnabled($Method) && !(isset($array['Switch']['Forced']) && $this->IsForceSwitch($array['Switch']['Forced']))){
				$this->NMAX_TENTATIVE = 1;
			}
			set_time_limit(0);
			$this->SetCallSocketTimeOut();
			$DateDebut = time();
			$this->VerifyIfAnotherWShasSwitch($Method);
			$client = new SoapClient(dirname(__FILE__).'/'.paylineSDK::WSDL, $this->header_soap);
			$client->__setLocation ($this->webServicesEndpoint.$PaylineAPI);
			$this->writeTrace("webServiceRequest($Method) - Location : ".$this->webServicesEndpoint.$PaylineAPI);
			
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
			$this->CURRENT_NUMBER_CALL++;
			$this->SetDefaultSocketTimeOut();
			if($Method == 'getCards'){
				$response = util::responseToArrayForGetCards($WSresponse);
				
			}else{
				$response = util::responseToArray($WSresponse);
			}
			$response = $this->AddResponseSwitchingChain($Method,$response);

			if($this->CheckForError($response)){
				throw new Exception('Technical Error : '+$response['result']['code']+' : '+$response['result']['shortMessage']+' : '+$response['result']['longMessage']);
			}else{
				if($this->CheckEndSwitch() && $this->IsSwitchingEnabled($Method) && !(isset($array['Switch']['Forced']) && $this->IsForceSwitch($array['Switch']['Forced']))){
					if(!$this->CheckIniValue('EndSwitchTry',0)){
						$jIniFileModifier = new jIniFileModifier(INI_FILE);
						$jIniFileModifier->setValue('EndSwitchTry', 0, 'Switcher', null);
						$jIniFileModifier->save();
					}
				}
				$this->writeTrace("response return (code ".$response['result']['code'].")");
				return $response;
			}
		}catch ( Exception $e ) {
			$this->writeTrace("Exception : ".$e->getMessage());
			if($this->IsSwitchingEnabled($Method) && !(isset($array['Switch']['Forced']) && $this->IsForceSwitch($array['Switch']['Forced']))){
				$WS = $Method;
				return $this->Switcher($DateDebut,$Method,$WS,$WSRequest,$this->WSDL_DIRECT_SOAP);
			}
			return $e->getMessage();
		}
	}

	public function createWallet($array){
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'privateDataList' => $this->privates,
			'authentication3DSecure' =>$this->authentication3DSecure($array['3DSecure']),
			'wallet' =>  $this->wallet($array['wallet'],$array['address'],$array['card']),
			'version' => $array['version']
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
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'selectedContractList' => $this->contracts($array['contracts']),
			'updatePersonalDetails' => $array['updatePersonalDetails'],
			'buyer' => $this->buyer($array['buyer'],$array['address']),
			'returnURL' => $this->returnURL,
			'cancelURL' => $this->cancelURL,
			'notificationURL' => $this->notificationURL,
			'languageCode' => $this->languageCode,
			'customPaymentPageCode' => $this->customPaymentPageCode,
			'customPaymentTemplateURL' => $this->customPaymentTemplateURL,
			'securityMode' => $this->securityMode);
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
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'card' =>  $this->card($array['card']),
			'order' => $this->order($array['order']),
			'buyer' => $this->buyer($array['buyer'],$array['address']),
			'privateDataList' =>  $this->privates,
			'authentication3DSecure' =>$this->authentication3DSecure($array['3DSecure']),
			'bankAccountData' => $this->bankAccountData($array['BankAccountData']),
			'version' => $array['version']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doAuthorization');
	}
	
	public function doCapture($array){
		$WSRequest = array (
			'transactionID' =>$array['transactionID'],
			'payment' =>  $this->payment($array['payment']),
			'privateDataList' =>  $this->privates,
			'sequenceNumber'=>$array['sequenceNumber']);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doCapture');
	}
	
	public function doCredit($array){
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'card' =>  $this->card($array['card']),
			'buyer' => $this->buyer($array['buyer'],$array['address']),
			'privateDataList' => $this->privates,
			'order' => $this->order($array['order']),
			'comment' =>$array['comment'],
			'version' => $array['version']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doCredit');
	}
	
	public function doDebit($array){
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'card' =>  $this->card($array['card']),
			'order' => $this->order($array['order']),
			'privateDataList' =>  $this->privates,
			'buyer' => $this->buyer($array['buyer'],$array['address']),
			'authentication3DSecure' =>$this->authentication3DSecure($array['3DSecure']),
			'authorization' =>$this->authorization($array['authorization']),
			'version' => $array['version']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doDebit');
	}
	
	public function doImmediateWalletPayment($array){
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'order' =>  $this->order($array['order']),
			'walletId' =>  $array['walletId'],
			'privateDataList' => $this->privates,
			'cardInd' => $array['cardInd']
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
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'orderRef' => $array['orderRef'],
			'orderDate' => $array['orderDate'],
			'order' => $this->order($array['order']),
			'privateDataList' =>  $this->privates,
			'walletId' =>  $array['walletId'],
			'scheduledDate' => $array['scheduled'],
			'recurring' =>  $this->recurring($array['recurring']),
			'cardInd' => $array['cardInd']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doRecurrentWalletPayment');
	}
	
	public function doRefund($array){
		$WSRequest = array (
			'transactionID' =>$array['transactionID'],
			'payment' =>$this->payment($array['payment']),
			'comment' =>$array['comment'],
			'privateDataList' =>  $this->privates,
			'sequenceNumber'=>$array['sequenceNumber']);	
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doRefund');
	}
	
	public function doReset($array){
		$WSRequest = array (
			'transactionID' =>$array['transactionID'],
			'comment' =>$array['comment']);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doReset');
	}
	
	public function doScheduledWalletPayment($array){
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'orderRef' => $array['orderRef'],
			'orderDate' => $array['orderDate'],
			'order' =>  $this->order($array['order']),
			'walletId' =>  $array['walletId'],
			'scheduledDate' => $array['scheduled'],
			'cardInd' => $array['cardInd']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'doScheduledWalletPayment');
	}
	
	public function doScoringCheque($array){
		$WSRequest = array (
			'cheque' => $this->cheque($array['cheque']),
			'payment' => $this->payment($array['payment']),
			'order' => $this->order($array['order']),
			'privateDataList' =>  $this->privates
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
		if(!isset($array['buyer']))$array['buyer'] = null;
		if(!isset($array['address']))$array['address'] = null;
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
							'buyer' => $this->buyer($array['buyer'],$array['address']),
							'securityMode' => $this->securityMode);
			
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
	public function getTransactionDetails($array){
		$WSRequest = array (
			'transactionId' => $array['transactionId'],
			'orderRef' =>  $array['orderRef'],
			'startDate' => $array['startDate'],
			'transactionHistory' => $array['transactionHistory'],
			'endDate' => $array['endDate'],
			'version' => $array['version']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::EXTENDED_API,'getTransactionDetails');
	}
	public function getWallet($array){
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'walletId' =>  $array['walletId'],
			'cardInd' => $array['cardInd'],
			'version' => $array['version']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'getWallet');
	}
	
	public function getWebPaymentDetails($array){
		$this->TokenSwitch($array['token']);
		return $this->webServiceRequest($array,$array,paylineSDK::WEB_API,'getWebPaymentDetails');
	}
	
	public function getWebWallet($array){
		$this->TokenSwitch($array['token']);
		return $this->webServiceRequest($array,$array,paylineSDK::WEB_API,'getWebWallet');
	}
	
	public function transactionsSearch($array){
		$WSRequest = array (
			'transactionId' => $array['transactionId'],
			'orderRef' => $array['orderRef'],
			'startDate' =>  $array['startDate'],
			'endDate' =>  $array['endDate'],
			'authorizationNumber' =>  $array['authorizationNumber'],
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
			'contractNumber' => $array['contractNumber'],
			'returnCode'  => $array['returnCode']
		);
		return $this->webServiceRequest($array,$array,paylineSDK::EXTENDED_API,'transactionsSearch');
	}
	
	public function updateWallet($array){
		$WSRequest = array (
			'contractNumber' => $array['contractNumber'],
			'privateDataList' => $this->privates,
			'authentication3DSecure' =>$this->authentication3DSecure($array['3DSecure']),
			'wallet' => $this->wallet($array['wallet'],$array['address'],$array['card']),
			'cardInd' => $array['cardInd'],
			'version' => $array['version']
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
		$WSRequest = array (
						'contractNumber' => $array['contractNumber'],
						'walletId' => $array['walletId'],
						'updatePersonalDetails' => $array['updatePersonalDetails'],
						'updatePaymentDetails' => $array['updatePaymentDetails'],
						'languageCode' => $this->languageCode,
						'customPaymentPageCode' => $this->customPaymentPageCode,
						'securityMode' => $this->securityMode,
						'returnURL' => $this->returnURL,
						'cancelURL' => $this->cancelURL,
						'notificationURL' => $this->notificationURL,
						'privateDataList' => $this->privates,
						'customPaymentTemplateURL' => $this->customPaymentTemplateURL,
						'cardInd' => $array['cardInd']
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
		$WSRequest = array (
			'payment' => $this->payment($array['payment']),
			'card' =>  $this->card($array['card']),
			'orderRef' => $array['orderRef'],
			'userAgent' => $array['userAgent']
		);
		return $this->webServiceRequest($array,$WSRequest,paylineSDK::DIRECT_API,'verifyEnrollment');
	}
}

?>
