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
use \Payutc\Db\Dbal;

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
    
    public function doWebPayment($usr, $amount, $returnURL, $cancelURL=null) {
        $this->payline->returnURL = $returnURL;
        if($cancelURL) {
            $this->payline->cancelURL = $cancelURL;
        } else {
            $this->payline->cancelURL = $returnURL;
        }
        $this->payline->notificationURL = Config::get('server_url') . "PAYLINE/notification"; 

        // Insert a payline row in db and get the payment ref
        $conn = Dbal::conn();
        $conn->insert('t_paybox_pay',
            array(
                "usr_id" => $usr->getId(),
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

        // BUYER INFO
        $array['buyer']['email'] = $usr->getMail();

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
            // That's OK
            // Save the token
            $conn->update('t_paybox_pay', array("pay_token" => $result['token']), array('pay_id' => $ref));    

            // You can go pay on this url
            return $result['redirectURL'];
        } else if(isset($result)) {
            $conn->update('t_paybox_pay', array("pay_step" => 'A', "pay_date_retour" => new \DateTime()), array('pay_id' => $ref), array("string", "datetime"));
            throw new \Payutc\Exception\PaylineException($result['result']['longMessage'], $result['result']['code']);
        } else {
            $conn->update('t_paybox_pay', array("pay_step" => 'A', "pay_date_retour" => new \DateTime()), array('pay_id' => $ref), array("string", "datetime"));
            throw new \Payutc\Exception\PaylineException("Payline erreur critique");
        }
    }

    /*
        Recoit une notification de payline
    */
    public function notification($token) {
        $array = array();
        $array['token'] = $token;
        $array['version'] = '';

        $response = $this->payline->getWebPaymentDetails($array);
        if(isset($response)){
            // Paiement valide
            if($response["result"]["code"] == "00000") {
                $conn = Dbal::conn();
                // Recuperation du rechargement
                $qb = Dbal::createQueryBuilder();
                $qb->select('pay_step', 'pay_id', 'usr_id')
                   ->from('t_paybox_pay', 'pay')
                   ->where('pay.pay_token = :token')->setParameter('token', $token);

                $result = $qb->execute()->fetch();
		        if($result['pay_step'] != "W") {
                    // ERROR ! Ce rechargement n'est pas en attente.
                    // Tentative de double rechargement ?
                    Log::warning("PAYLINE : Tentative de double rechargement ! $token \n".print_r($response, true),10);
                    return;
                }
                
                // insertion du rechargement
                $conn->insert('t_recharge_rec',
                array(
                    "rty_id" => 3, // Type de rechargement => Rechargement en ligne
                    "usr_id_buyer" => $result['usr_id'], 
                    "usr_id_operator" => $result['usr_id'],
                    "poi_id" => 1, // Historique... useless maintenant TODO mettre l'id d'app
                    "rec_date" =>  new \DateTime(),
                    "rec_credit" => $response["payment"]["amount"],
                    "rec_trace" => $result['pay_id'],
                    "rec_removed" => 0
                ),
                array(
                    "integer", "integer", "integer", "integer", "datetime", "integer", "string", "integer"
                ));

                // Recharge user maintenant
                $conn->executeQuery('UPDATE ts_user_usr SET usr_credit = (usr_credit + ?) WHERE usr_id = ?', array($response["payment"]["amount"], $result['usr_id']));

                $conn->update('t_paybox_pay', 
                                array("pay_step" => 'V', 
                                      "pay_date_retour" => new \DateTime(),
                                      "pay_amount" => $response["payment"]["amount"],
                                      "pay_auto" => $response["authorization"]["number"],
                                      "pay_trans" => $response["transaction"]["id"],
                                      "pay_error" => $response["result"]["code"]),
                                array("pay_token" => $token),
                                array("string", "datetime", "integer", "string", "string", "string"));
                Log::info("PAYLINE : succes ! $token \n".print_r($response, true),1);

            // Paiement en cours, l'utilisateur n'a pas annulé ni validé...
            } else if ($response["result"]["code"] == "02306") {
                // Log this, peut etre que le petit malin essaie de nous rouler ^^
                Log::warning("PAYLINE : Tentative de validation avant erreur ou succes ! $token \n".print_r($response, true),10);
                return;

            } else {
                // Indique le rechargement comme aborted
                $conn = Dbal::conn();
                $conn->update('t_paybox_pay', 
                                array("pay_step" => 'A', 
                                      "pay_date_retour" => new \DateTime(),
                                      "pay_amount" => $response["payment"]["amount"],
                                      "pay_auto" => $response["authorization"]["number"],
                                      "pay_trans" => $response["transaction"]["id"],
                                      "pay_error" => $response["result"]["code"]),
                                array("pay_token" => $token),
                                array("string", "datetime", "integer", "string", "string", "string"));
                Log::info("PAYLINE : error ! $token \n".print_r($response, true),5);
                return;
            }
        }
    }

}
