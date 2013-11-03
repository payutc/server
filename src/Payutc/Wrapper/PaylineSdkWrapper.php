<?php

namespace Payutc\Wrapper;

use Payutc\Log;

/**
 * Overwrite log function to use payutc logger
 */
class PaylineSdkWrapper extends \paylineSDK
{
    /**
	* @method writeTrace
	* @desc write a trace in Payline log file
	* @param $trace : the string to add in the log file
	*/
	public function writeTrace($trace){
        Log::info($trace);
	}
}

