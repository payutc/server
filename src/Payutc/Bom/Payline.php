<?php

/**
 * MsgPerso.class
 * 
 * Personnal messages' manager
 * Table: t_message_msg
 */

namespace Payutc\Bom;
use \Payutc\Log;
use \Payutc\Config;

class Payline {
    
    protected $payline = null;    

    public function __construct() {
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
	    DEFINE( 'CONTRACT_NUMBER', Config::get('PAYLINE_CONTRACT_NUMBER') ); // Contract type default (ex: 001 = CB, 003 = American Express...)
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
	    DEFINE( 'INI_FILE' , '../../../HighDefinition.ini'); // Chemin du fichier ini
	    DEFINE( 'PAYLINE_ERR_TOKEN', '02317,02318' ); // Préfixe du token sur le site primaire

        /*
            Appel du constructeur de paylineSDK
        */
        echo("merchant_id:" . Config::get('PAYLINE_MERCHANT_ID'));
        $this->payline = new \paylineSDK(
                            Config::get('PAYLINE_MERCHANT_ID'),
                            Config::get('PAYLINE_ACCESS_KEY'),
                            Config::get('proxy_host'),
                            Config::get('proxy_port'),
                            Config::get('proxy_login'),
                            Config::get('proxy_password'),
                            Config::get('PAYLINE_PRODUCTION')
                            ); 
    }
    

}
