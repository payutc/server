<?php

namespace Payutc;

use \SimpleXMLElement;
use \Httpful\Request;

use \Payutc\Exception\AuthenticationFailure;

class Cas {
    protected $url;
    protected $timeout;
    
    public function __construct($url, $timeout=10) {
        $this->url = $url;
        $this->timeout = $timeout;
    }
    
    public function authenticate($ticket, $service) {
        $r = Request::get($this->getValidateUrl($ticket, $service))
          ->sendsXml()
          ->timeoutIn($this->timeout)
          ->send();
        $user = trim(str_replace("\n", "", $r->raw_body));
        // Log::warning("AuthenticationFailure : ($ticket, $service)".$r->raw_body."\n".$r->body);
        try {
            $xml = new SimpleXMLElement(trim(str_replace("\n", "", $r->raw_body)));
            $namespaces = $xml->getNamespaces();
            $serviceResponse = $xml->children($namespaces['cas']);
            $user = $serviceResponse->authenticationSuccess->user;
            $authFailed = $serviceResponse->authenticationFailure;
            if ($authFailed) {
                $attributes = $authFailed->attributes();
                Log::warning("AuthenticationFailure : ".$attributes['code']." ($ticket, $service)");
                throw new AuthenticationFailure((string)$attributes['code']);
            }
        } catch (\Exception $e) {
            $user = trim(str_replace("\n", "", $r->raw_body));
        }
        if ($user) {
            return (string)$user; // cast simplexmlelement to string
        } else {
                Log::error("\n Cas return is weird : '{$user}'\n");
                throw new \UnexpectedValueException($user);
        }
    }
    
    public function getValidateUrl($ticket, $service) {
        return $this->url."serviceValidate?ticket=".urlencode($ticket)."&service=".urlencode($service);
    }
}


