<?php 
/**
*	payutc
*	Copyright (C) 2013 payutc <payutc@assos.utc.fr>
*
*	This file is part of payutc
*	
*	payutc is free software: you can redistribute it and/or modify
*	it under the terms of the GNU General Public License as published by
*	the Free Software Foundation, either version 3 of the License, or
*	(at your option) any later version.
*
*	payutc is distributed in the hope that it will be useful,
*	but WITHOUT ANY WARRANTY; without even the implied warranty of
*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*	GNU General Public License for more details.
*
*	You should have received a copy of the GNU General Public License
*	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
* Utils.class
* 
* Some utilities
* @author payutc <payutc@assos.utc.fr>
* @version 1.0
*/

namespace Payutc;

class Utils
{
    public static function call_user_func_named($function_or_array, $params)
    {
    	if (is_array($function_or_array)) {
    		$class = $function_or_array[0];
    		$function = $function_or_array[1];
    		$reflection_class = new \ReflectionClass($class);
    		if (!$reflection_class->hasMethod($function)) {
    			throw new \Payutc\Exception\ServiceMethodNotFound('La fonction '.$function.' n\'existe pas');
    		}
    		$reflect = $reflection_class->getMethod($function);
    		if ($reflect->isPrivate() or $reflect->isProtected()) {
    			throw new \Payutc\Exception\ServiceMethodForbidden('La fonction '.$function.' n\'est pas publique');
    		}
    	}
    	else {
    		$function = $function_or_array;
    		if (!function_exists($function)) {
    			throw new \Payutc\Exception\ServiceMethodNotFound('La fonction '.$function.'n\'existe pas');
    		}
    		$reflect = new \ReflectionFunction($function);
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
    			throw new \Payutc\Exception\ServiceMissingMethodArgument('Le parametre "'.$pname.'" est requis');
    		}
    	}
    	return call_user_func_array($function_or_array, $real_params);
    }
    
    public static function getRandomString($length = 32, $chars = null){
        if($chars == null){
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        }
        
        $output = "";
        $count = mb_strlen($chars);
        for($i = 0; $i<$length; $i++) {
            $output .= mb_substr($chars, rand(0, $count - 1), 1);
        }
        
        return $output;
    }
    
    public static function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}
?>