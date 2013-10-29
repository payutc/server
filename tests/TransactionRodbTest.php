<?php

require_once 'bootstrap.php';

use \Payutc\Bom\User;
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
    
	/**
	 * Test validating an already validated transaction
	 * 
	 * @expectedException		 \Payutc\Exception\TransactionAlreadyValidated
     * @requires PHP 5.4
	 */
	public function testAlreadyValidatedTransaction()
	{
        $transaction = Transaction::getById(1);
        $transaction->validate();
	}
    
	/**
	 * Test validating an aborted transaction
	 * 
	 * @expectedException		 \Payutc\Exception\TransactionAborted
     * @requires PHP 5.4
	 */
	public function testAbortedTransaction()
	{
        $transaction = Transaction::getById(13);
        $transaction->validate();
	}
    
	/**
	 * Test creating a validated transaction with not enough credit
	 * 
	 * @expectedException		 \Payutc\Exception\NotEnoughMoney
     * @requires PHP 5.4
	 */
    public function testNotEnoughCredit(){
        $seller = new User("trecouvr");
        $buyer = new User("puyouart");
        
        $items = array(
            array(1, 1),
            array(1, 1),
            array(2, 1)
        );

        $transaction = Transaction::createAndValidate($buyer, $seller, 51, 1, $items, null, null);
    }
    
	/**
	 * Test creating a transaction and validating it with not enough credit
	 * 
	 * @expectedException		 \Payutc\Exception\NotEnoughMoney
     * @requires PHP 5.4
	 */
    public function testNotEnoughCreditDelayed(){
        $seller = new User("trecouvr");
        $buyer = new User("puyouart");
        
        $items = array(
            array(1, 1),
            array(1, 1),
            array(2, 1)
        );

        $transaction = Transaction::create($buyer, $seller, 51, 1, $items, null, null);

        $this->assertEquals(280, $transaction->getMontantTotal());
        
        $transaction->validate();
    }
    
	/**
	 * Test buying an article that does not exist
	 * 
	 * @expectedException		 \Payutc\Exception\PossException
     * @expectedExceptionMessage L'article 142 n'est pas disponible à la vente.
     * @requires PHP 5.4
	 */
    public function testWrongArticle(){
        $seller = new User("trecouvr");
        $buyer = new User("puyouart");
        
        $items = array(
            array(142, 1)
        );

        $transaction = Transaction::create($buyer, $seller, 51, 1, $items, null, null);
    }
}

