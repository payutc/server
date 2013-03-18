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

/**
 * wsdl
 * 
 * Permet de générer le wsdl avec l'autodiscover de Zend si le paramètre wsdl est envoyé dans la requête,
 * sinon, il permet d'accéder à la classe PHP.
 * @author BuckUTT <buckutt@utt.fr>
 * @version 2.0
 * @package buckutt
 */

//TODO vérifier sur le serveur le réglage de cache wsdl

if ( isset ($_GET['wsdl']))
{
	$server = new \Zend\Soap\AutoDiscover();
	// This was the default value in Zend 1.*
	$server->setUri('http://' .$_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);
	$server->setClass($name_class);
	$server->handle();
} else
{
	$server = new SoapServer($_CONFIG['server_url'].$name_class.'.class.php?wsdl', Array('cache_wsdl'=>$_CONFIG['wsdl_cache'])); //TODO mettre WSDL_CACHE_BOTH sur le serveur
	$server->setClass($name_class);
	$server->setPersistence(SOAP_PERSISTENCE_SESSION);
	$server->handle();
}
?>
