<?php

require_once 'utils.php';

use \Payutc\Bom\User;
use \Payutc\Bom\Fundation;

class FundationRodbTest extends ReadOnlyDatabaseTest
{
	/**
	 * get db dataset
	 */
	public function getDataSet()
	{
        return $this->computeDataset(array(
            'products.yml',
            'users.yml',
            'fundations.yml',
            'purchase.yml'
        ));
	}
	
	public function testConstruct()
	{
		$fundation = new Fundation();
	}
    
    public function testRetrieve(){
        $fundation = Fundation::getById(1);
        $this->assertEquals($fundation->getName(), "Picasso");
    }
	
	/**
	 * Test retrieving an unknown transaction
	 * 
	 * @expectedException		 \Payutc\Exception\FundationNotFound
	 * @expectedExceptionMessage La fundation n'existe pas
     * @requires PHP 5.4
	 */
	public function testRetrieveUnknown()
	{
		$fundation = Fundation::getById(742);
	}
    

}

