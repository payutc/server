<?php

class ServiceNotFound extends Exception {}
class ServiceMethodNotFound extends Exception {}
class ServiceMethodForbidden extends Exception {}
class ServiceMissingMethodArgument extends Exception {}

function call_user_func_named($function_or_array, $params)
{
	
	if (is_array($function_or_array)) {
		$class = $function_or_array[0];
		$function = $function_or_array[1];
		$reflection_class = new ReflectionClass($class);
		if (!$reflection_class->hasMethod($function)) {
			throw new ServiceMethodNotFound('La fonction '.$function.' n\'existe pas');
		}
		$reflect = $reflection_class->getMethod($function);
		if ($reflect->isPrivate() or $reflect->isProtected()) {
			throw new ServiceMethodForbidden('La fonction '.$function.' n\'est pas publique');
		}
	}
	else {
		$function = $function_or_array;
		if (!function_exists($function)) {
			throw new ServiceMethodNotFound('La fonction '.$function.'n\'existe pas');
		}
		$reflect = new ReflectionFunction($function);
	}
	$real_params = array();
	foreach ($reflect->getParameters() as $i => $param)
	{
		$pname = $param->getName();
		if ($param->isPassedByReference()) {
			/// @todo shall we raise some warning?
		}
		if (array_key_exists($pname, $params)) {
			$real_params[] = $params[$pname];
		}
		else if ($param->isDefaultValueAvailable()) {
			$real_params[] = $param->getDefaultValue();
		}
		else {
			// missing required parameter: mark an error and exit
			throw new ServiceMissingMethodArgument('Le parametre "'.$pname.'" est requis');
		}
	}
	return call_user_func_array($function_or_array, $real_params);
}

