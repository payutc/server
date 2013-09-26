<?php

require_once "ServiceBaseRodbTest.php";

use \Payutc\Bom\User;

class Poss3RodbTest extends ServiceBaseRodbTest
{
    public function getFixtures()
    {
        return array_merge(parent::getFixtures(), array(
            'products.yml',
        ));
    }

    /**
     * @requires PHP 5.4
     */
    public function testGetBuyerInfo()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'trecouvr@POSS3', 'POSS3');
        $this->loginApp($cookie, $r, 'my_app');
        $r = httpSend('POSS3', 'getBuyerInfo', $cookie, array(
            'badge_id' => 'ABCDABCD'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals("Thomas", $r->body['firstname']);
        $this->assertEquals("Recouvreux", $r->body['lastname']);
        $this->assertEquals(9000, $r->body['solde']);

    }


    /**
     * @requires PHP 5.4
     */
    public function testTransactionWithNoSeller()
    {
        $cookie = '';
        $r = httpSend('POSS3', 'transaction', $cookie, array(
            'obj_ids' => '1,2',
            'fun_id' => 1,
            'badge_id' => 'ABCDABCD'
        ));
        $a = array('error' => array(
            'type' => 'Payutc\Exception\CheckRightException',
            'code' => 0,
            'message' => 'Vous devez connecter un utilisateur ! (method loginCas)'
        ));
        $this->assertEquals($a, $r->body);
        $this->assertEquals(400, $r->code);
    }

    /**
     * @requires PHP 5.4
     */
    public function testTransactionWithNotAuthorizedSeller()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'mguffroy@POSS3', 'POSS3');
        $this->assertEquals(200, $r->code);
        $r = httpSend('POSS3', 'transaction', $cookie, array(
            'obj_ids' => '1,2',
            'fun_id' => 1,
            'badge_id' => 'ABCDABCD'
        ));
        $a = array('error' => array(
            'type' => 'Payutc\Exception\CheckRightException',
            'code' => 0,
            'message' => 'Le user_id 9447 n\'a pas les droits POSS3 sur la fundation n°1'
        ));
        $this->assertEquals($a, $r->body);
        $this->assertEquals(400, $r->code);
    }

    /**
     * @requires PHP 5.4
     */
    public function testTransactionWithoutEnoughCredit()
    {
        $u = new User("trecouvr");
        $solde = $u->getCredit();
        $nb_purchase = count($u->getLastPurchases());
        $cookie = '';
        $r = httpSend('POSS3', 'loginCas', $cookie, array(
            'ticket' => 'trecouvr@POSS3',
            'service' => 'POSS3'
        ));
        $this->assertEquals(200, $r->code);
        $r = httpSend('POSS3', 'loginApp', $cookie, array(
            'key' => 'my_app'
        ));
        $this->assertEquals(200, $r->code);
        $r = httpSend('POSS3', 'transaction', $cookie, array(
            'fun_id' => 1,
            'badge_id' => '123456AB',
            'obj_ids' => '1 1 2'
        ));
        $a = array (
            'error' => array (
                'type' => 'Payutc\\Exception\\PossException',
                'code' => 0,
                'message' => 'puyouart n\'a pas assez d\'argent pour effectuer la transaction.',
            ));
        $this->assertEquals($a, $r->body);
    }
 
}



