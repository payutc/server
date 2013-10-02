<?php


require_once "bootstrap.php";
          
use \Payutc\Bom\User;

class TransferRwdbTest extends DatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataset(array(
            'users.yml',
            'applications.yml'
        ));
    }

    /**
     * @requires PHP 5.4
     */
    public function testTransfer()
    {
        $cookie = '';
        $r = httpSend('TRANSFER', 'loginCas', $cookie, array(
            'ticket' => 'trecouvr@TRANSFER',
            'service' => 'TRANSFER'
        ));
        $this->assertEquals(200, $r->code);
        $r = httpSend('TRANSFER', 'loginApp', $cookie, array(
            'key' => "app_transfer",
        ));
        $this->assertEquals(200, $r->code);

        $r = httpSend('TRANSFER', 'transfer', $cookie, array("amount" => 1100, "userID" => 9447, "message" => "coucou"));
        $this->assertEquals(200, $r->code);
    
        $u = new User("mguffroy");
        $this->assertEquals($u->getCredit(), 6100);
    }
}



