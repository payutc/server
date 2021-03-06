<?php

require_once 'utils.php';

use \Payutc\Bom\User;
use \Payutc\Bom\Transaction;
use \Payutc\Log;
use \Payutc\Db\Dbal;

class PaylineRwdbTest extends DatabaseTest
{
    
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataset(array(
            'products',
            'users',
            'fundations',
            'purchase'
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
        $u = User::getById(9447);
        
        // do web payment
        $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        
        // test db record
        $r = $this->getLastDbTransaction($u->getId(), $t->getId());
        $this->assertEquals($token, $r['pay_token']);
        
        // validate payment on payline side
        $this->fakeSdk->validate($token);
        
        // notification
        $this->payline->notification($token);
        
        // test db record
        $r = $this->getLastDbTransaction($u->getId(), $t->getId());
        $this->assertEquals('V', $r['pay_step']);
    }
    
    /**
     * Test the user is credited after the transaction
     * 
     * usr_id != null
     * tra_id == null
     * 
     * @requires PHP 5.4
     */
    public function testReload()
    {
        $amount = 50;
        $u = User::getById(1);
        $credit = $u->getCredit();
        
        // do web payment
        $this->payline->doWebPayment($u, null, $amount, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        
        // validate payment on payline side
        $this->fakeSdk->validate($token);
        
        // notification
        $this->payline->notification($token);
        
        // test db record
        $u = User::getById(1);
        $this->assertEquals($credit + $amount, $u->getCredit());
    }
    
    
    /**
     * Test a web transaction, the user should be credited and 
     * then debited (his starting credit should be the same as the ending
     * one).
     * 
     * usr_id != null
     * tra_id != null
     * 
     * @requires PHP 5.4
     */
    public function testTransaction()
    {
        $t = Transaction::getById(12);
        $amount = $t->getMontantTotal();
        $u = User::getById(9447);
        $credit = $u->getCredit();
        
        // do web payment
        $this->payline->doWebPayment($u, $t, $amount, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        
        // validate payment on payline side
        $this->fakeSdk->validate($token);
        
        // notification
        $this->payline->notification($token);
        
        // test db record
        $this->assertEquals($credit, User::getCreditById($u->getId()));
    }
    
    /**
     * Test the transaction if the amount payed on payline is different 
     * than the total amount of the transaction.
     * Everything should pass.
     * 
     * usr_id != null
     * tra_id != null
     * 
     * @requires PHP 5.4
     */
    public function testTransactionWithUserOnUnMatchAmounts()
    {
        $diff = 3;
        $t = Transaction::getById(12);
        $amount = $t->getMontantTotal() + $diff;
        $u = User::getById(9447);
        $credit = $u->getCredit();
        
        // do web payment
        $this->payline->doWebPayment($u, $t, $amount, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        
        // validate payment on payline side
        $this->fakeSdk->validate($token);
        
        // notification
        $this->payline->notification($token);
        
        // test db record
        $this->assertEquals($credit + $diff, User::getCreditById($u->getId()));
    }
    
    /**
     * Test the transaction fails if the amount payed on payline is different 
     * than the total amount of the transaction.
     * 
     * usr_id == null
     * tra_id != null
     * 
     * @requires PHP 5.4
     */
    public function testTransactionWithNoUserFailsOnUnMatchAmounts()
    {
        $t = Transaction::getById(12);
        $amount = $t->getMontantTotal() + 2;
        
        // do web payment
        $this->payline->doWebPayment(null, $t, $amount, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        
        // validate payment on payline side
        $this->fakeSdk->validate($token);
        
        // notification
        $this->payline->notification($token);
        
        // test the log records
        $s = 'PAYLINE : Validation of transaction';
        $this->assertTrue($this->strIsInLogs($s));
    }
    
    /**
     * 
     * @requires PHP 5.4
     */
    public function testNotificationBeforeValidate()
    {
        $t = Transaction::getById(12);
        $u = User::getById(9447);
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
     * @requires PHP 5.4
     */
    public function testDoWebPaymentFailure()
    {
        $t = Transaction::getById(12);
        $u = User::getById(9447);
        $this->fakeSdk->nextWillFail();
        $e = null;
        try {
            $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
        }
        catch (Exception $a) {
            $e = $a;
        }
        // test the throwed exception
        $this->assertNotNull($e);
        $this->assertTrue($e instanceof \Payutc\Exception\PaylineException);
        $s = 'PAYLINE : Erreur au moment de créer le rechargement';
        $this->assertTrue($this->strIsInLogs($s));
        
        // test the database record
        $r = $this->getLastDbTransaction($u->getId(), $t->getId());
        $this->assertEquals('A', $r['pay_step']);
        $this->assertNotNull($r['pay_error']);
    }
    
    /**
     * Test payline critical failure of a web payment
     * 
     * @requires PHP 5.4
     */
    public function testDoWebPaymentCriticalFailure()
    {
        $t = Transaction::getById(12);
        $u = User::getById(9447);
        $this->fakeSdk->nextWillHardFail();
        $e = null;
        try {
            $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
        }
        catch (Exception $a) {
            $e = $a;
        }
        // test the throwed exception
        $this->assertNotNull($e);
        $this->assertTrue($e instanceof \Payutc\Exception\PaylineException);
        $this->assertContains("Payline erreur critique", $e->getMessage());
        
        // test the database record
        $r = $this->getLastDbTransaction($u->getId(), $t->getId());
        $this->assertEquals('A', $r['pay_step']);
    }
    
    /**
     * Test the notification method abort the transaction if the return
     * code of payline is bad
     * 
     * @requires PHP 5.4
     */
    public function testNotificationFailsOnBadReturnCode()
    {
        
        $t = Transaction::getById(12);
        $u = User::getById(9447);
        
        // do web payment
        $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        
        // cancel the payment on payline side
        $this->fakeSdk->cancel($token);
        
        // notification
        $this->payline->notification($token);
        
        // test db record
        $r = $this->getLastDbTransaction($u->getId(), $t->getId());
        $this->assertEquals('A', $r['pay_step']);
        
        // test the log records
        $s = 'PAYLINE : error';
        $this->assertTrue($this->strIsInLogs($s));
    }
    
    /**
     * @requires PHP 5.4
     */
    public function testDoubleLoading()
    {
        $t = Transaction::getById(12);
        $u = User::getById(9447);
        $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
        $token = $transaction['token'];
        $this->fakeSdk->validate($token);
        $this->payline->notification($token);
        $this->payline->notification($token);
        $s = "PAYLINE : Notification sur une transaction qui n'est pas en attente";
        $this->assertTrue($this->strIsInLogs($s));
    }
    
    /**
     * @requires PHP 5.4
     */
    public function testCheckUser()
    {
        $t = Transaction::getById(12);
        $u = User::getById(9447);
        
        // first clean all existing transactions
        $qb = Dbal::createQueryBuilder();
        $qb->update('t_paybox_pay', 'pay')
           ->set('pay.pay_step', ':pay_step')
           ->andWhere('pay.usr_id = :usr_id')
           ->andWhere('pay.pay_token IS NOT NULL')
           ->setParameters(array(
               'pay_step' => 'V',
               'usr_id' => $u->getId()
           ));
        $qb->execute();
        
        $N = 2;
        // add N transactions
        for ($i=0; $i<$N; ++$i) {
            $this->payline->doWebPayment($u, $t, 50, 'http://localhost/nowhere');
            $transaction = $this->fakeSdk->getLastTransaction();
            $token = $transaction['token'];
            $this->fakeSdk->validate($token);
        }
        
        // get the number of awainting transactions (should be N)
        $qb = Dbal::createQueryBuilder();
        $qb->select('count(*) as count')
           ->from('t_paybox_pay', 'pay')
           ->where('pay.pay_step = :pay_step')
           ->andWhere('pay.usr_id = :usr_id')
           ->andWhere('pay.pay_token IS NOT NULL')
           ->setParameters(array(
               'pay_step' => 'W',
               'usr_id' => $u->getId()
           ));
        $r = $qb->execute()->fetch();
        $c = $r['count'];
        $this->assertEquals($N, $c);
        
        // call check user function
        $this->payline->checkUser($u);
        
        // check the transaction is not anymore awaiting
        $r = $qb->execute()->fetch();
        $c = $r['count'];
        $this->assertEquals(0, $c);
    }
    
    /**
     * @expectedException           \Payutc\Exception\PaylineException
     * @expectedExceptionMessage    Le paiement sert a rien
     * @requires PHP 5.4
     */
    public function testUselessTransaction()
    {
        $this->payline->doWebPayment(null, null, 50, 'http://localhost/nowhere');
        $transaction = $this->fakeSdk->getLastTransaction();
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
    
    protected function getLastDbTransaction($usr_id = null, $tra_id = null)
    {
        $qb = Dbal::createQueryBuilder();
        $qb->select('*')
           ->from('t_paybox_pay', 'pay')
           ->orderBy('pay_id', 'DESC')
           ->setMaxResults(1);
        
        if ($usr_id !== null) {
            $qb->where('usr_id = :usr_id')
               ->setParameter('usr_id', $usr_id);
        }
        if ($tra_id !== null) {
            $qb->where('tra_id = :tra_id')
               ->setParameter('tra_id', $tra_id);
        }
        $r = $qb->execute()->fetch();
        return $r;
    }

}

