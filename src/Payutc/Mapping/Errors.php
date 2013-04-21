<?php

namespace Payutc\Mapping;

class Errors {
    public static function get(){
        return array(
            'Payutc\Exception\ServiceNotFound' => 404,
            'Payutc\Exception\ServiceMethodNotFound' => 404,
            'Payutc\Exception\ServiceMethodForbidden' => 403,
            'Payutc\Exception\ServiceMissingMethodArgument' => 400,
            'PossException' => '\Payutc\Mapping\Errors::defaultHandler',
            'Payutc\Exception\UserIsBlockedException' => '\Payutc\Mapping\Errors::defaultHandler',
            'Payutc\Exception\CheckRightException' => '\Payutc\Mapping\Errors::defaultHandler'
        );
    }
    
    public static function defaultHandler(\Exception $e)
    {
		return array(
        			'type' => 'PayutcException', 
        			'code' => $e->getCode(), 
        			'message' => $e->getMessage()
        );
	}
}

