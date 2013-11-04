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
    
    public function testNotificationBeforeValidate()
    {
        $t = Transaction::getById(12);
        $u = User::getById(1);
        $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        $this->payline->notification($token);
        $records = Log::getStreamHandler()->getRecords();
        $s = 'PAYLINE : Tentative de validation avant erreur ou succes !';
        $found = false;
        foreach($records as $record) {
            // if (message startswith s)
            if (!strncmp($record['message'], $s, strlen($s))) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found);
    }
    

}

