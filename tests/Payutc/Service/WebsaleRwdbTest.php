<?php

require_once 'utils.php';

use \Payutc\Bom\User;
use \Payutc\Bom\Transaction;

class WebsaleRwdbTest extends DatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataset(array(
            'users.yml',
            'fundations.yml',
            'applications.yml',
            'products.yml',
            'applicationright.yml',
            'fundationrights.yml',
            'purchase.yml'
        ));
    }

    /**
     * @requires PHP 5.4
     */
    public function testTransaction()
    {
        $cookie = '';
        $r = httpSend('WEBSALE', 'loginApp', $cookie, array(
            'key' => 'app_websale'
        ));
        $this->assertEquals(200, $r->code);
        $articles = array(
           array(4, 1),
           array(4, 3) 
        );
        $r = httpSend('WEBSALE', 'createTransaction', $cookie, array(
            'items' => json_encode($articles),
            'fun_id' => 1,
            'mail' => 'mguffroy@etu.utc.fr',
            'return_url' => 'http://localhost/websale/'
        ));

        $transactionId = $r->body['tra_id'];
        $transaction = Transaction::GetById($transactionId);
        $token = $transaction->getToken();
        $mail = $transaction->getEmail();
        $this->assertEquals('mguffroy@etu.utc.fr', $mail);

        $o = array(
            'tra_id' => $transactionId,
            'url' => 'http://localhost/websaleconfirm/validation?tra_id='.$transactionId.'&token='.$token
        );        
        $this->assertEquals($o, $r->body);
        $this->assertEquals(200, $r->code);

        $r = httpSend('WEBSALE', 'getTransactionInfo', $cookie, array(
            'fun_id' => 1,
            'tra_id' => $transactionId
        ));
        $o = array(
            'id' => $transactionId,
            'status' => 'W',
            'purchases' => array(
                array(
                    'pur_id' => '16',
                    'obj_id' => '4',
                    'pur_qte' => '1',
                    'pur_unit_price' => '150',
                    'pur_price' => '150',
                    'pur_removed' => '0'),
                array(
                    'pur_id' => '17',
                    'obj_id' => '4',
                    'pur_qte' => '3',
                    'pur_unit_price' => '150',
                    'pur_price' => '450',
                    'pur_removed' => '0')
        ));
        
        $this->assertEquals($o['id'], $r->body['id']);
        $this->assertEquals($o['status'], $r->body['status']);
        $this->assertEquals($o['purchases'], $r->body['purchases']);
        $this->assertEquals(200, $r->code);
    }
}



