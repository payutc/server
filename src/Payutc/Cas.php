<?php

namespace Payutc;

use \SimpleXMLElement;
use \Httpful\Request;

use \Payutc\Exception\CasAuthenticationFailed;
use \Payutc\Exception\CasFormatError;

class Cas
{
    public static function authenticate($ticket,$service)
    {
        $r = Request::get(self::getValidateUrl($ticket, $service))
          ->sendsXml()
          ->send();
        $r->body = str_replace("\n", "", $r->body);
        $xml = new SimpleXMLElement($r->body);
        $xml->registerXPathNamespace('cas', 'http://www.yale.edu/tp/cas');
        $result = $xml->xpath('//cas:serviceResponse/*');
        if (count($result) < 1) {
            Log::error("Cas return is weird : '{$r->body}'");
            throw new CasFormatError($r->body);
        }
        foreach ($result as $t) {
            if ($t->getName() == "authenticationSuccess") {
                $users = $t->xpath('//cas:user');
                $user = $users[0];
                return "".$user;
            }
            else {
                Log::warning("Authentication failed : ".$t->getName().":".$t['code']." ($ticket, $service)");
                throw new CasAuthenticationFailed("".$t->getName().":".$t['code']);
            }
        }
    }
	
	public static function getURl() {
		return Config::get('cas_url');
	}
    
    public static function getValidateUrl($ticket, $service)
    {
        return self::getURl()."serviceValidate?ticket=".$ticket."&service=".$service;
    }
}


