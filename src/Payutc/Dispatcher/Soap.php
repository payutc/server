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

namespace Payutc\Dispatcher;

class Soap {
    public function handle($name_class){
        global $_CONFIG;
        $app = \Slim\Slim::getInstance();
        
        $services = \Payutc\Mapping\Services::get();
        if (!array_key_exists($name_class, $services)) {
            throw new \Payutc\Exception\ServiceNotFound("Service $name_class does not exist");
        }
        
        $res = $app->response();
        $res['Content-Type'] = 'text/xml';
        
        if (isset($_GET['wsdl'])) {
            $server = new \Zend\Soap\AutoDiscover();
            $server->setUri($_CONFIG['server_url'].$name_class.'.class.php');
            $server->setClass($name_class);
            $server->handle();
        } else {
            $server = new \SoapServer($_CONFIG['server_url'].$name_class.'.class.php?wsdl', array('cache_wsdl' => $_CONFIG['wsdl_cache']));
            $server->setClass($name_class);
            $server->setPersistence(SOAP_PERSISTENCE_SESSION);
            $server->handle();
        }
    }
}
?>
