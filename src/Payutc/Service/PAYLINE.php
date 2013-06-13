<?php

namespace Payutc\Service;

/**
 * PAYLINE
 * 
 * Ce service expose une methode pour gérer la notification de payline
 *
 */
 
 class PAYLINE {

	/**
	* Declenchement d'une notification de payline
	*/
	public function Notification() {
        global $_GET;
        if(isset($_GET['token'])) {
            $pl = new \Payutc\Bom\Payline(0, "PAYLINE");
            $pl->Notification($_GET['token']);
        }
	}
	
 }
