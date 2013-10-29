<?php

require_once 'bootstrap.php';

use \Payutc\Bom\User;
use \Payutc\Bom\Product;
use \Payutc\Bom\Purchase;
use \Payutc\Bom\Transaction;

class TransactionRwdbTest extends DatabaseTest
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
	
    public function testCreate(){
        $items = array(
        	array(
        		'id' => 4,
        		'qte' => 1,
        		'price' => 150,
        	),
        	array(
        		'id' => 4,
        		'qte' => 3,
        		'price' => 150,
        	),
        );
        $transaction = Transaction::create(9447, 9447, 51, 1, $items, null, null);

        $this->assertEquals(600, $transaction->getMontantTotal());
    }
    
    public function testCreateWithNoBuyer(){
        $items = array(
        	array(
        		'id' => 4,
        		'qte' => 1,
        		'price' => 150,
        	),
        	array(
        		'id' => 4,
        		'qte' => 3,
        		'price' => 150,
        	),
        );
        $transaction = Transaction::create(null, null, 51, 1, $items, null, null);

        $this->assertEquals(600, $transaction->getMontantTotal());
    }
    
    public function testValidate(){
        $transaction = Transaction::getById(12);
        $transaction->validate();

        $this->assertEquals('V', $transaction->getStatus());

        $u = new User("mguffroy");
        $this->assertEquals(4660, $u->getCredit());

        $p = Product::getOne(5, 1);
        $this->assertEquals(40, $p['stock']);

        $r = Purchase::getNbSell(5, 1);
        $this->assertEquals(4, $r);
    }
    
    public function testCreateAndValidate(){
        $items = array(
        	array(
        		'id' => 5,
        		'qte' => 1,
        		'price' => 170,
        	),
        	array(
        		'id' => 5,
        		'qte' => 1,
        		'price' => 170,
        	),
        );

        $transaction = Transaction::createAndValidate(9447, 9447, 51, 1, $items, null, null);

        $this->assertEquals('V', $transaction->getStatus());

        $u = new User("mguffroy");
        $this->assertEquals(4660, $u->getCredit());

        $p = Product::getOne(5,1);
        $this->assertEquals(40, $p['stock']);

        $r = Purchase::getNbSell(5, 1);
        $this->assertEquals(4, $r);
    }
    
    public function testCreateToken(){
        $items = array(
        	array(
        		'id' => 4,
        		'qte' => 1,
        		'price' => 150,
        	),
        	array(
        		'id' => 4,
        		'qte' => 3,
        		'price' => 150,
        	),
        );
        $transaction = Transaction::create(9447, 9447, 51, 1, $items, null, null);
        
        $token = $transaction->getToken();
        
        $transaction2 = Transaction::getByToken($token);

        $this->assertEquals(600, $transaction2->getMontantTotal());
    }
    
    public function testCreateEmail(){
        $items = array(
        	array(
        		'id' => 4,
        		'qte' => 1,
        		'price' => 150,
        	),
        	array(
        		'id' => 4,
        		'qte' => 3,
        		'price' => 150,
        	),
        );
        $transaction = Transaction::create(9447, 9447, 51, 1, $items, null, null);
        $transaction->setEmail("arthur@puyou.fr");
        
        $this->assertEquals("arthur@puyou.fr", $transaction->getEmail());
        
        $transaction2 = Transaction::getById($transaction->getId());
        $this->assertEquals("arthur@puyou.fr", $transaction2->getEmail());
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
    
    // TODO try buying with not enough credit, validating with not enough credit, adding wrong articles
}

