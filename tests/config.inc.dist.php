<?php 
/**
    BuckUTT - Buckutt est un système de paiement avec porte-monnaie électronique.
    Copyright (C) 2011 BuckUTT <buckutt@utt.fr>

	This file is part of BuckUTT
	
    BuckUTT is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    BuckUTT is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// Paramètres de BDD
$_CONFIG['sql_host'] = "localhost";
$_CONFIG['sql_db'] = "buckutt_test";
$_CONFIG['sql_user'] = "root";
$_CONFIG['sql_pass'] = "";


// Chemin vers le serveur CAS (avec le / final)
$_CONFIG['cas_url'] = "http://localhost:33435/";

// URL publique http(s) du serveur (avec le / final)
$_CONFIG['server_url'] = "http://localhost/buckutt/";
$_CONFIG['http_server_url'] = "http://localhost/buckutt/";

// Méthode de cache côté serveur pour les wsdl (mettre WSDL_CACHE_BOTH en prod)
$_CONFIG['wsdl_cache'] = WSDL_CACHE_NONE;

// Montant maximum à autoriser sur un compte (en cts)
$_CONFIG['credit_max'] = 10000;

// Montant minimum d'un rechargement
$_CONFIG['rechargement_min'] = 1000;

// Adresse du proxy
$_CONFIG['proxy_host'] = null;
$_CONFIG['proxy_port'] = null;
$_CONFIG['proxy_login'] = "";
$_CONFIG['proxy_password'] = "";
$_CONFIG['proxy'] = $_CONFIG['proxy_host'] . ":" . $_CONFIG['proxy_port'];

/** 
    PAYBOX
    Parametres de paybox par défaut pour le mode dévellopeur
    A modifier par ces propres paramétres.
*/
$_CONFIG['PBX_SITE'] = "1999888";
$_CONFIG['PBX_RANG'] = "82";
$_CONFIG['PBX_IDENTIFIANT'] = "110532808";
// Ou se trouve l'executable paybox ?
$_CONFIG['PBX_EXE'] = "/usr/share/buckutt/modulev3.cgi";
// CLEF PUBLIQUE PAYBOX
$_CONFIG['PBX_PUBPEM'] = "somewhere/pubkey.pem";

/**
    PAYLINE
    Parametres de payline
    Ces parametres sont preconfigures sur un compte de test, aucune garantie
    n'est apporté quand au fait qu'il restera accessible dans la durée.
    Vous pouvez ouvrir un compte de test sur le site www.payline.com
*/
$_CONFIG['PAYLINE_CONTRACT_NUMBER'] = "123456";
$_CONFIG['PAYLINE_MERCHANT_ID'] = '70038023549152' ; // Merchant ID
$_CONFIG['PAYLINE_ACCESS_KEY'] = 'fAPFZ5vkg0K734953kKG' ; // Certificate key
$_CONFIG['PAYLINE_PRODUCTION'] = false ; // production mode

// Configuration de ginger (outil cotisant)
$_CONFIG['ginger_key'] = "fauxginger";
$_CONFIG['ginger_url'] = "http://localhost:33434/index.php/v1/";

// Configuration de Slim
$_CONFIG['slim_config'] = array(
    'mode' => 'production',
    'debug' => false,
    'log.level' => \Slim\Log::DEBUG,
    'log.enabled' => true,
    'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
        'path' => __DIR__.'/logs',
        'name_format' => 'Y-m-d',
        'message_format' => '%label% - %date% - %message%'
    ))
);

