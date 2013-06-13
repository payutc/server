<?php

/**
 * Payline.class
 * 
 * Connection au SDK payline pour effectuer les rechargements.
 * Table: t_paybox_pay (a changer)
 */

namespace Payutc\Bom;
use \Payutc\Log;
use \Payutc\Config;
use \Payutc\Db;

class Payline {
    
    protected $payline = null;
    protected $app_id = null;
    protected $service = null;  

    /*
     * Params:
     * $app_id => Permet de loguer l'id de l'application qui a effectué la requete
     * $service => Permet de loguer le service utilisé pour effectuer la requete (MADMIN / VENTEWEB ?)
    */
    public function __construct($app_id, $service) {
        /* 
            DEFINITION DES PARAMETRES DE CONFIG DE PAYLINE
        */
	    DEFINE( 'PAYMENT_CURRENCY', 978 ); // Default payment currency (ex: 978 = EURO)
	    DEFINE( 'ORDER_CURRENCY', PAYMENT_CURRENCY );
	    DEFINE( 'SECURITY_MODE', '' ); // Protocol (ex: SSL = HTTPS)
	    DEFINE( 'LANGUAGE_CODE', '' ); // Payline pages language
	    DEFINE( 'PAYMENT_ACTION', 101 ); // Default payment method
	    DEFINE( 'PAYMENT_MODE', 'CPT' ); // Default payment mode
	    DEFINE( 'CANCEL_URL', ''); // Default cancel URL
	    DEFINE( 'NOTIFICATION_URL',''); // Default notification URL
	    DEFINE( 'RETURN_URL', ''); // Default return URL
	    DEFINE( 'CUSTOM_PAYMENT_TEMPLATE_URL', ''); // Default payment template URL
	    DEFINE( 'CUSTOM_PAYMENT_PAGE_CODE', '' );
	    DEFINE( 'CONTRACT_NUMBER', '0'.Config::get('PAYLINE_CONTRACT_NUMBER') ); // Contract type default (ex: 001 = CB, 003 = American Express...)
	    DEFINE( 'CONTRACT_NUMBER_LIST', '' ); // Contract type multiple values (separator: ;)
	    DEFINE( 'SECOND_CONTRACT_NUMBER_LIST', '' ); // Contract type multiple values (separator: ;)
	
	    // Durées du timeout d'appel des webservices
	    DEFINE( 'PRIMARY_CALL_TIMEOUT', 15);
	    DEFINE( 'SECONDARY_CALL_TIMEOUT', 15 );
	
	    // Nombres de tentatives sur les chaines primaire et secondaire par transaction
	    DEFINE( 'PRIMARY_MAX_FAIL_RETRY', 1 );
	    DEFINE( 'SECONDARY_MAX_FAIL_RETRY', 2 );
	
	    // Durées d'attente avant le rejoue de la transaction
	    DEFINE( 'PRIMARY_REPLAY_TIMER', 15 );
	    DEFINE( 'SECONDARY_REPLAY_TIMER', 15 );
		
	    DEFINE( 'PAYLINE_ERR_CODE', '02101,02102,02103' ); // Codes erreurs payline qui signifie l'échec de la transaction
	    DEFINE( 'PAYLINE_WS_SWITCH_ENABLE',  ''); // Nom des services web autorisés à basculer
	    DEFINE( 'PAYLINE_SWITCH_BACK_TIMER', 600 ); // Durées d'attente pour rebasculer en mode nominal
	    DEFINE( 'PRIMARY_TOKEN_PREFIX', '1' ); // Préfixe du token sur le site primaire
	    DEFINE( 'SECONDARY_TOKEN_PREFIX', '2' ); // Préfixe du token sur le site secondaire
	    DEFINE( 'INI_FILE' , __DIR__ . '/../../../HighDefinition.ini'); // Chemin du fichier ini
	    DEFINE( 'PAYLINE_ERR_TOKEN', '02317,02318' ); // Préfixe du token sur le site primaire

        /*
            Appel du constructeur de paylineSDK
        */
        $this->payline = new \paylineSDK(
                            Config::get('PAYLINE_MERCHANT_ID'),
                            Config::get('PAYLINE_ACCESS_KEY'),
                            Config::get('proxy_host'),
                            Config::get('proxy_port'),
                            Config::get('proxy_login'),
                            Config::get('proxy_password'),
                            Config::get('PAYLINE_PRODUCTION')
                            );

        // Sauvegarde des parametres
        $this->$app_id = $app_id;
        $this->$service = $service; 
    }
    
    public function doWebPayment($usr_id, $amount, $returnURL, $cancelURL=null) {
        $this->payline->returnURL = $returnURL;
        if($cancelURL) {
            $this->payline->cancelURL = $cancelURL;
        } else {
            $this->payline->cancelURL = $returnURL;
        }
        $this->payline->notificationURL = null;

        // Insert a payline row in db and get the payment ref
        $conn = Db::getConnection();
        $conn->insert('t_paybox_pay',
            array(
                "usr_id" => $usr_id,
                "pay_step" => "W",  // Etat de la transaction (W: Wait, V: Valide, A: Annule/Aborted)
                "pay_amount" => $amount,
                "pay_date_create" => new \DateTime(), 
                "pay_callback_url" => $returnURL
            ),
            array(
                "integer", "string", "integer", "datetime", "string"
            ));
        $ref = $conn->lastInsertId();

        $array = array();
        // PAYMENT
        $array['payment']['amount'] = $amount;
        $array['payment']['currency'] = PAYMENT_CURRENCY;
        $array['payment']['action'] = PAYMENT_ACTION;
        $array['payment']['mode'] = PAYMENT_MODE;

        // ORDER
        $array['order']['ref'] = $ref;
        $array['order']['amount'] = $amount;
        $array['order']['currency'] = PAYMENT_CURRENCY;

        // CONTRACT NUMBERS
        $array['payment']['contractNumber'] = CONTRACT_NUMBER;
        $contracts = explode(";",CONTRACT_NUMBER_LIST);
        $array['contracts'] = $contracts;
        $secondContracts = explode(";",SECOND_CONTRACT_NUMBER_LIST);
        $array['secondContracts'] = $secondContracts;

        // Payline do your job !
        $result = $this->payline->doWebPayment($array);

        // Check Result
        if(isset($result) && $result['result']['code'] == '00000') {
            // That's OK, You can go pay on this url
		    return $result['redirectURL'];
	    } else if(isset($result)) {
            $conn->update('t_paybox_pay', array("pay_step" => 'A', "pay_date_retour" => new \DateTime()), array('pay_id' => $ref), array("string", "datetime"));
	        throw new \Payutc\Exception\PaylineException($result['result']['longMessage'], $result['result']['code']);
	    } else {
            $conn->update('t_paybox_pay', array("pay_step" => 'A', "pay_date_retour" => new \DateTime()), array('pay_id' => $ref), array("string", "datetime"));
            throw new \Payutc\Exception\PaylineException("Payline erreur critique");
        }
 
        
    }

}
