<?php

require_once 'bootstrap.php';

use \Payutc\Bom\Transaction;

class TransactionRodbTest extends ReadOnlyDatabaseTest
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
		$transaction = new Transaction();
	}
    
    public function testRetrieve(){
        $transaction = Transaction::getById(11);
        $purchases = array(
            array(
                'pur_id' => 11,
                'obj_id' => 5,
                'pur_qte' => 1,
                'pur_unit_price' => 170,
                'pur_price' => 170,
                'pur_removed' => 0
            ),
            array(
                'pur_id' => 12,
                'obj_id' => 5,
                'pur_qte' => 1,
                'pur_unit_price' => 170,
                'pur_price' => 170,
                'pur_removed' => 0
            )
        );
        $this->assertEquals($purchases, $transaction->getPurchases());
        $this->assertEquals(340, $transaction->getMontantTotal());
    }
	
	/**
	 * Test retrieving an unknown transaction
	 * 
	 * @expectedException		 \Payutc\Exception\TransactionNotFound
	 * @expectedExceptionMessage La transaction n'existe pas
     * @requires PHP 5.4
	 */
	public function testRetrieveUnknown()
	{
		$transaction = Transaction::getById(742);
	}
}

