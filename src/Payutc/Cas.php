<?php

namespace Payutc;

use \SimpleXMLElement;
use \Httpful\Request;

use \Payutc\Exception\AuthenticationFailure;

class Cas
{
    public static function authenticate($ticket,$service)
    {
        $r = Request::get(self::getValidateUrl($ticket, $service))
          ->sendsXml()
          ->send();
        $r->body = str_replace("\n", "", $r->body);
        $xml = new SimpleXMLElement($r->body);
        $namespaces = $xml->getNamespaces();
        
        $serviceResponse = $xml->children($namespaces['cas']);
        $user = $serviceResponse->authenticationSuccess->user;
        
        if ($user) {
            return "".$user; // cast simplexmlelement to string
        }
        else {
            $authFailed = $serviceResponse->authenticationFailure;
            if ($authFailed) {
                $attributes = $authFailed->attributes();
                Log::warning("AuthenticationFailure : ".$attributes['code']." ($ticket, $service)");
                throw new AuthenticationFailure("AuthenticationFailure: ".$attributes['code']);
            }
            else {
                Log::error("Cas return is weird : '{$r->body}'");
                throw new UnexpectedValueException($r->body);
            }
        }
        // never reach there
    }
	
	public static function getURl() {
		return Config::get('cas_url');
	}
    
    public static function getValidateUrl($ticket, $service)
    {
        return self::getURl()."serviceValidate?ticket=".$ticket."&service=".$service;
    }
}


