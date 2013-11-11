<?php

require_once 'utils.php';


class PaylineRodbTest extends ReadOnlyDatabaseTest
{
	
    /**
     * get db dataset
     */
    public function getDataSet() {
        return $this->computeDataset(array(
            'users.yml'
        ));
    }
	
	public function testInitDontCrash()
	{  
        $payline = new \Payutc\Bom\Payline(0, "TEST");
	}
	

}



