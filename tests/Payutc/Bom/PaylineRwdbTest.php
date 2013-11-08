<?php

require_once 'utils.php';

use \Payutc\Bom\User;
use \Payutc\Bom\Transaction;
use \Payutc\Log;

class PaylineRwdbTest extends DatabaseTest
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
    
    public function setUp()
    {
        parent::setUp();
        $this->fakeSdk = new FakePaylineSdk();
        $this->payline = new \Payutc\Bom\Payline(0, "TEST", $this->fakeSdk);
        Log::init(Log::TEST);
        $this->testHandler = Log::getStreamHandler();
    }
    
    /**
     * 
     * @requires PHP 5.4
     */
    public function testNoCrash()
    {
        $t = Transaction::getById(12);
        $u = User::getById(1);
        $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        $this->fakeSdk->validate($token);
        $this->payline->notification($token);
    }
    
    /**
     * 
     * @requires PHP 5.4
     */
    public function testNotificationBeforeValidate()
    {
        $t = Transaction::getById(12);
        $u = User::getById(1);
        $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        $this->payline->notification($token);
        $s = 'PAYLINE : Tentative de validation avant erreur ou succes !';
        $this->assertTrue($this->strIsInLogs($s));
    }
    
	/**
	 * Test payline failure of a web payment
	 * 
	 * @expectedException		 \Payutc\Exception\PaylineException
     * @requires PHP 5.4
	 */
    public function testDoWebPaymentFailure()
    {
        $t = Transaction::getById(12);
        $u = User::getById(1);
        $this->fakeSdk->nextWillFail();
        $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
    }
    
    public function testDoubleLoading()
    {
        $t = Transaction::getById(12);
        $u = User::getById(1);
        $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        $this->fakeSdk->validate($token);
        $this->payline->notification($token);
        $this->payline->notification($token);
        $s = 'PAYLINE : Tentative de double rechargement !';
        $this->assertTrue($this->strIsInLogs($s));
    }
    
    protected function strIsInLogs($s, $lvl=null)
    {
        $records = Log::getStreamHandler()->getRecords();
        foreach($records as $record) {
            // if (message startswith s)
            if ($lvl === null or $record['level'] == $lvl) {
                if (!strncmp($record['message'], $s, strlen($s))) {
                    return true;
                }
            }
        }
        return false;
    }
    

}

