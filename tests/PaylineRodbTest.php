<?php

require_once 'bootstrap.php';

use \Payutc\Config;

class paylineRodbTest extends ReadOnlyDatabaseTest
{
	
    /**
     * get db dataset
     */
    public function getDataSet() {
        return $this->computeDataset(array(
        ));
    }
	
	public function testInitDontCrash()
	{  
        $payline = new \Payutc\Bom\Payline();
	}
	

}



