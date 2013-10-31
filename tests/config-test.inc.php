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
$_CONFIG['sql_db'] = "payutc_test";
$_CONFIG['sql_user'] = "root";
$_CONFIG['sql_pass'] = "root";

// Chemin vers le serveur CAS (avec le / final)
$_CONFIG['cas_url'] = 'http://localhost:33434/';

// URL publique http(s) du serveur (avec le / final)
$_CONFIG['server_url'] = 'http://localhost:33435/';

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

/**
*   PAYLINE
*   Ces paramètres sont pré-configurés sur un compte de test, aucune garantie
*   n'est apporté quand au fait qu'il restera accessible dans la durée.
*   Vous pouvez ouvrir un compte de test sur le site www.payline.com
*/
$_CONFIG['payline_contract_number'] = "1234567";
$_CONFIG['payline_merchant_id'] = '70038023549152' ; // Merchant ID
$_CONFIG['payline_access_key'] = 'fAPFZ5vkg0K734953kKG' ; // Certificate key
$_CONFIG['payline_production'] = false ; // production mode

// Configuration de ginger (outil cotisant)
// En environnement de dev, utiliser https://github.com/simde-utc/faux-ginger
$_CONFIG['ginger_key'] = "fauxginger";
$_CONFIG['ginger_url'] = 'http://localhost:33436/v1/';

// Configuration de Slim, les plus importants sont les 3 premiers paramètres
$_CONFIG['slim_config'] = array(
    'mode' => 'production',
    'debug' => false,
);


// Configuration des logs
$_CONFIG['log_mode'] = 'TST';
$_CONFIG['log_filename'] = __DIR__.'/logs/log.txt';

