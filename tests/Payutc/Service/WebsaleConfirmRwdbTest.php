<?php

require_once "bootstrap.php";

use \Payutc\Bom\User;
use \Payutc\Bom\Transaction;

class WebsaleConfirmRwdbTest extends DatabaseTest
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
    public function testGetTransactionInfo()
    {
        $cookie = '';
        $r = httpSend('WEBSALECONFIRM', 'loginApp', $cookie, array(
            'key' => 'app_websaleconfirm'
        ));
        $this->assertEquals(200, $r->code);
        
        $r = httpSend('WEBSALECONFIRM', 'getTransactionInfo', $cookie, array(
            'tra_id' => 12,
            'token' => "token_12"
        ));

        $this->assertEquals(200, $r->code);
        $o = array(
            "id" => "12",
            "status" => 'W',
            "purchases" => array(
                    array(
                            "pur_id" => 13,
                            "obj_id" => 5,
                            "pur_qte" => 1,
                            "pur_unit_price" => 170,
                            "pur_price" => 170,
                            "pur_removed" => 0
                        ),
                    array(
                            "pur_id" => 14,
                            "obj_id" => 5,
                            "pur_qte" => 1,
                            "pur_unit_price" => 170,
                            "pur_price" => 170,
                            "pur_removed" => 0
                        )

                ),
            "products" => array(
                    array(
                            "id" => 5,
                            "name" => "Cuvee",
                            "categorie_id" => 1001,
                            "fundation_id" => 1,
                            "stock" => 42,
                            "price" => 170,
                            "alcool" => 0,
                            "image" => "",
                        )

                ),
            "created" => "2013-04-07 18:32:25"
        );
        
        print_r($r->body);
        
        $this->assertEquals(12, $r->body['id']);
        $this->assertEquals('W', $r->body['status']);
        $this->assertEquals($o, $r->body);
        

        /*$transactionId = $r->body['tra_id'];
        $transaction = Transaction::GetById($transactionId);
        $token = $transaction->getToken();

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
        $this->assertEquals(200, $r->code); */
    }
}



