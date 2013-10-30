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
	
	/**
     * @requires PHP 5.4
	 */    
    public function testCreate(){
        $items = array(
            array(4, 1),
            array(4, 3)
        );
        $matthieu = new User("mguffroy");
        $transaction = Transaction::create($matthieu, $matthieu, 51, 1, $items, null, null);

        $this->assertEquals(600, $transaction->getMontantTotal());
    }
    
	/**
     * @requires PHP 5.4
	 */
    public function testCreateWithNoBuyer(){
        $items = array(
            array(4, 1),
            array(4, 3)
        );
        $transaction = Transaction::create(null, null, 51, 1, $items, null, null);

        $this->assertEquals(600, $transaction->getMontantTotal());
        
        $u = new User("mguffroy");
        $transaction->setBuyer($u);        
        $this->assertEquals(9447, $transaction->getBuyerId());
        
        $u = new User("trecouvr");
        $transaction->setSeller($u);
        $this->assertEquals(1, $transaction->getSellerId());
    }
    
	/**
     * @requires PHP 5.4
	 */
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
    
	/**
     * @requires PHP 5.4
	 */
    public function testCreateAndValidate(){
        $items = array(
            array(5, 1),
            array(5, 1)
        );

        $matthieu = new User("mguffroy");
        $transaction = Transaction::createAndValidate($matthieu, $matthieu, 51, 1, $items, null, null);

        $this->assertEquals('V', $transaction->getStatus());

        $u = new User("mguffroy");
        $this->assertEquals(4660, $u->getCredit());

        $p = Product::getOne(5,1);
        $this->assertEquals(40, $p['stock']);

        $r = Purchase::getNbSell(5, 1);
        $this->assertEquals(4, $r);
    }
    
	/**
     * @requires PHP 5.4
	 */
    public function testCreateToken(){
        $items = array(
            array(4, 1),
            array(4, 3)
        );
        $matthieu = new User("mguffroy");
        $transaction = Transaction::create($matthieu, $matthieu, 51, 1, $items, null, null);
        
        $token = $transaction->getToken();
        
        $transaction2 = Transaction::getByToken($token);

        $this->assertEquals(600, $transaction2->getMontantTotal());
    }
    
	/**
     * @requires PHP 5.4
	 */
    public function testCreateEmail(){
        $items = array(
            array(4, 1),
            array(4, 3)
        );
        $matthieu = new User("mguffroy");
        $transaction = Transaction::create($matthieu, $matthieu, 51, 1, $items, null, null);
        $transaction->setEmail("arthur@puyou.fr");
        
        $this->assertEquals("arthur@puyou.fr", $transaction->getEmail());
        
        $transaction2 = Transaction::getById($transaction->getId());
        $this->assertEquals("arthur@puyou.fr", $transaction2->getEmail());
    }
}

