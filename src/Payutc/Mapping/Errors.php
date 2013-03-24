<?php

namespace Payutc\Mapping;

class Errors {
    public static function get(){
        return array(
        	'Payutc\Exception\ServiceNotFound' => 404,
        	'Payutc\Exception\ServiceMethodNotFound' => 404,
        	'Payutc\Exception\ServiceMethodForbidden' => 403,
        	'Payutc\Exception\ServiceMissingMethodArgument' => 400,
        	'PossException' => function(\PossException $e) {
        		return array(
        			'type' => 'PossException', 
        			'code' => $e->err_code, 
        			'message' => $e->getMessage()
        		);
        	}
        );
    }
}

