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
use \Payutc\Bom\User;
use \Payutc\Bom\Transaction;
use \Payutc\Wrapper\PaylineSdkWrapper;

class Payline {
    
    protected $payline = null;
    protected $app_id = null;
    protected $service = null;  

    /*
     * Params:
     * $app_id => Permet de loguer l'id de l'application qui a effectué la requete
     * $service => Permet de loguer le service utilisé pour effectuer la requete (MADMIN / VENTEWEB ?)
    */
    public function __construct($app_id, $service, $paylineSdk = null) {
        // DEFINITION DES PARAMETRES DE CONFIG DE PAYLINE
	      define('PAYMENT_CURRENCY', 978); // Default payment currency (ex: 978 = EURO)
	      define('ORDER_CURRENCY', PAYMENT_CURRENCY);
	      define('SECURITY_MODE', ''); // Protocol (ex: SSL = HTTPS)
	      define('LANGUAGE_CODE', ''); // Payline pages language
	      define('PAYMENT_ACTION', 101); // Default payment method
	      define('PAYMENT_MODE', 'CPT'); // Default payment mode
	      define('CANCEL_URL', ''); // Default cancel URL
	      define('NOTIFICATION_URL',''); // Default notification URL
	      define('RETURN_URL', ''); // Default return URL
	      define('CUSTOM_PAYMENT_TEMPLATE_URL', ''); // Default payment template URL
	      define('CUSTOM_PAYMENT_PAGE_CODE', '');
	      define('CONTRACT_NUMBER', Config::get('payline_contract_number')); // Contract type default (ex: 001 = CB, 003 = American Express...)
	      define('CONTRACT_NUMBER_LIST', '' ); // Contract type multiple values (separator: ;)
	      define('SECOND_CONTRACT_NUMBER_LIST', ''); // Contract type multiple values (separator: ;)
	
	      // Durées du timeout d'appel des webservices
	      define('PRIMARY_CALL_TIMEOUT', 15);
	      define('SECONDARY_CALL_TIMEOUT', 15);
	
	      // Nombres de tentatives sur les chaines primaire et secondaire par transaction
	      define('PRIMARY_MAX_FAIL_RETRY', 1);
	      define('SECONDARY_MAX_FAIL_RETRY', 2);
	
	      // Durées d'attente avant le rejoue de la transaction
	      define('PRIMARY_REPLAY_TIMER', 15);
	      define('SECONDARY_REPLAY_TIMER', 15);
		
	      define('PAYLINE_ERR_CODE', '02101,02102,02103'); // Codes erreurs payline qui signifie l'échec de la transaction
	      define('PAYLINE_WS_SWITCH_ENABLE',  ''); // Nom des services web autorisés à basculer
	      define('PAYLINE_SWITCH_BACK_TIMER', 600); // Durées d'attente pour rebasculer en mode nominal
	      define('PRIMARY_TOKEN_PREFIX', '1'); // Préfixe du token sur le site primaire
	      define('SECONDARY_TOKEN_PREFIX', '2'); // Préfixe du token sur le site secondaire
	      define('INI_FILE' , __DIR__ . '/../../../vendor/payline/HighDefinition.ini'); // Chemin du fichier ini
	      define('PAYLINE_ERR_TOKEN', '02317,02318'); // Préfixe du token sur le site primaire

        if ($paylineSdk === null) {
            // Appel du constructeur de paylineSDK
            $this->payline = new PaylineSdkWrapper(
                                Config::get('payline_merchant_id'),
                                Config::get('payline_access_key'),
                                Config::get('proxy_host'),
                                Config::get('proxy_port'),
                                Config::get('proxy_login'),
                                Config::get('proxy_password'),
                                Config::get('payline_production')
                                );
        }
        else {
            $this->payline = $paylineSdk;
        }
        
        // Sauvegarde des parametres
        $this->$app_id = $app_id;
        $this->$service = $service; 
    }
    
    public function doWebPayment($usr, $transaction, $amount, $returnURL, $cancelURL=null, $mail=null) {
        $this->payline->returnURL = $returnURL;
        if($cancelURL) {
            $this->payline->cancelURL = $cancelURL;
        } else {
            $this->payline->cancelURL = $returnURL;
        }
        $this->payline->notificationURL = Config::get('server_url') . "PAYLINE/notification"; 
        Log::debug("Payline notificationURL = ".$this->payline->notificationURL);

        // Get usr_id and tra_id
        if($usr) {
            $usr_id = $usr->getId();
        } else {
            $usr_id = null;
        }
        
        if($transaction) {
            $tra_id = $transaction->getId();
        } else {
            $tra_id = null;
        }   

        if($usr_id == null and $tra_id == null) {
            throw new \Payutc\Exception\PaylineException("Le paiement sert a rien");
        }

        // Insert a payline row in db and get the payment ref
        $conn = Dbal::conn();
        $conn->insert('t_paybox_pay',
            array(
                "usr_id" => $usr_id,
                "tra_id" => $tra_id,
                "pay_step" => "W",  // Etat de la transaction (W: Wait, V: Valide, A: Annule/Aborted)
                "pay_amount" => $amount,
                "pay_date_create" => new \DateTime(), 
                "pay_callback_url" => $this->payline->notificationURL
            ),
            array(
                "integer", "integer", "string", "integer", "datetime", "string"
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
        if($usr) {    
            $array['buyer']['email'] = $usr->getMail();
        } else {
            $array['buyer']['email'] = $mail;
        }

        // CONTRACT NUMBERS
        $array['payment']['contractNumber'] = CONTRACT_NUMBER;
        $contracts = explode(";",CONTRACT_NUMBER_LIST);
        $array['contracts'] = $contracts;
        $secondContracts = explode(";",SECOND_CONTRACT_NUMBER_LIST);
        $array['secondContracts'] = $secondContracts;

        // Payline do your job !
        $result = $this->payline->doWebPayment($array);

        // Check Result
        if(isset($result) && is_array($result) && $result['result']['code'] == '00000') {
            // That's OK
            // Save the token
            $conn->update('t_paybox_pay', array("pay_token" => $result['token']), array('pay_id' => $ref));    

            // You can go pay on this url
            return $result['redirectURL'];
        } else if(isset($result) && is_array($result)) {
            $conn->update(
                't_paybox_pay', 
                array(
                    "pay_step" => 'A', 
                    "pay_date_retour" => new \DateTime(), 
                    "pay_error" => $result["result"]["code"]), 
                array('pay_id' => $ref), 
                array("string", "datetime", "string"));
            Log::warn("PAYLINE : Erreur au moment de créer le rechargement. \n".print_r($result, true));
            throw new \Payutc\Exception\PaylineException($result['result']['longMessage'], $result['result']['code']);
        } else {
            $conn->update('t_paybox_pay', array("pay_step" => 'A', "pay_date_retour" => new \DateTime()), array('pay_id' => $ref), array("string", "datetime"));
            Log::warn("PAYLINE : Erreur critique au moment de créer le rechargement. \n \$result => $result");
            throw new \Payutc\Exception\PaylineException("Payline erreur critique");
        }
    }

    /*
        Recoit une notification de payline
    */
    public function notification($token, $want_return=False) {
        $array = array();
        $array['token'] = $token;
        $array['version'] = '';

        Log::debug("step in notification($token)");
        
        // Recuperation du rechargement
        $qb = Dbal::createQueryBuilder();
        $qb->select('pay_step', 'pay_id', 'usr_id', 'tra_id')
           ->from('t_paybox_pay', 'pay')
           ->where('pay.pay_token = :token')
           ->setParameter('token', $token);

        $result = $qb->execute()->fetch();
        
        // On recupere la transaction associé s'il y'en a une
        $transaction = null;
        $return_url = null;
        if($result['tra_id']) {
            $transaction = Transaction::getById($result['tra_id']);
            $return_url = $transaction->getReturnUrl();
        }
        if(!$want_return) {
            $return_url = "";
        }
        
        $response = $this->payline->getWebPaymentDetails($array);
        if(isset($response)){
            // Paiement valide
            if($response["result"]["code"] == "00000") {
                $conn = Dbal::conn();

                if($result['pay_step'] != "W") {
                    // ERROR ! Ce rechargement n'est pas en attente.
                    // Tentative de double rechargement ?
                    Log::warn("PAYLINE : Tentative de double rechargement ! $token \n".print_r($response, true));
                    return $return_url;
                }
                
                $conn->beginTransaction();
                try {
                    // On update la transaction payline
                    // Passe uniquement les 'W' à 'V' impossible de passer une transaction déjà à 'V'
                    $numrows = $conn->update('t_paybox_pay', 
                    array("pay_step" => 'V', 
                          "pay_date_retour" => new \DateTime(),
                          "pay_amount" => $response["payment"]["amount"],
                          "pay_auto" => $response["authorization"]["number"],
                          "pay_trans" => $response["transaction"]["id"],
                          "pay_error" => $response["result"]["code"]),
                    array("pay_token" => $token, "pay_step" => 'W'),
                    array("string", "datetime", "integer", "string", "string", "string"));
                
                    if($numrows != 1) {
                        Log::warn("PAYLINE : Tentative de double rechargement ! $token (ou token inexistant) \n".print_r($response, true));
                        throw new \Exception("Tentative double rechargement.");
                    }
                
                    // insertion du rechargement
                    if($result['usr_id']) {
                        $conn->insert('t_recharge_rec',
                        array(
                            "rec_type" => 'Internet', // Type de rechargement => Rechargement en ligne
                            "usr_id_buyer" => $result['usr_id'], 
                            "usr_id_operator" => $result['usr_id'],
                            "poi_id" => 1, // Historique... useless maintenant TODO mettre l'id d'app
                            "rec_date" =>  new \DateTime(),
                            "rec_credit" => $response["payment"]["amount"],
                            "rec_trace" => $result['pay_id'],
                            "rec_removed" => 0
                        ),
                        array(
                            "string", "integer", "integer", "integer", "datetime", "integer", "string", "integer"
                        ));

                        // Recharge user maintenant
                        User::incCreditById($result['usr_id'], $response["payment"]["amount"]);
                    }

                    $conn->commit();
                    
                    // validation de la transaction
                    try {
                        if($result['tra_id']) {
                            if(!$result['usr_id'] && $response["payment"]["amount"] != $transaction->getMontantTotal()) {
                                $transaction->abort();
                                throw new \Exception("Le montant payé et le montant de la transaction ne correspondent pas");
                            }
                            $transaction->validate();
                        }
                    } catch (\Exception $e) {
                        Log::error("PAYLINE : Validation of transaction (tra_id)".$result['tra_id']." has failed... Token: $token \nException : \n".print_r($e, true));
                    }
                    
                    Log::debug("PAYLINE : succes ! $token \n".print_r($response, true));
                    return $return_url;
                } catch (\Exception $e) {
                    $conn->rollback();
                    Log::error("PAYLINE : Error during notification of $token \n Exception : \n".print_r($e, true));
                }
            // Paiement en cours, l'utilisateur n'a pas annulé ni validé...
            } else if ($response["result"]["code"] == "02306") {
                // Log this, peut etre que le petit malin essaie de nous rouler ^^
                Log::warn("PAYLINE : Tentative de validation avant erreur ou succes ! $token \n".print_r($response, true));

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
                Log::info("PAYLINE : error ! $token \n".print_r($response, true));
                
                // annulation de la transaction
                try {
                    $qb = Dbal::createQueryBuilder();
                    $qb->select('pay_step', 'pay_id', 'usr_id', 'tra_id')
                       ->from('t_paybox_pay', 'pay')
                       ->where('pay.pay_token = :token')
                       ->setParameter('token', $token);

                    $result = $qb->execute()->fetch();
                    
                    if($result['tra_id']) {
                        $transaction = Transaction::getById($result['tra_id']);
                        $transaction->abort();
                    }
                } catch (\Exception $e) {
                    Log::error("PAYLINE : Aborting of transaction (tra_id)".$result['tra_id']." failed... Token: $token \nException : \n".print_r($e, true));
                }
            }
        }
        return $return_url;
    }

    /*
        On verifie les rechargement d'un utilisateur donné (failover au cas ou l'on aurait pas reçu la notification)
    */
    public function checkUser($user) {
        $qb = Dbal::createQueryBuilder();
        $qb->select('pay.pay_token')
           ->from('t_paybox_pay', 'pay')
           ->where('pay.pay_step = :pay_step')
           ->andWhere('pay.usr_id = :usr_id')
           ->andWhere('pay.pay_token IS NOT NULL')
           ->setParameters(array(
               'pay_step' => 'W',
               'usr_id' => $user->getId()
           ));

        $res = $qb->execute();
        while($don = $res->fetch()) {
            $this->notification($don['pay_token']);
        }
    }

}
