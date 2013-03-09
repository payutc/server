<?php


$error_mapping = array(
	'ServiceNotFound' => 404,
	'ServiceMethodNotFound' => 404,
	'ServiceMethodForbidden' => 403,
	'ServiceMissingMethodArgument' => 400,
	'PossException' => function(PossException $e) {
		return array('err_code' => $e->err_code, 'err_msg' => $e->getMessage());
	}
);


