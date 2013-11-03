<?php

use Payutc\Log;

/**
 * Overwrite log function to use payutc logger
 */
class PayutcPaylineSDK extends \PaylineSDK
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

