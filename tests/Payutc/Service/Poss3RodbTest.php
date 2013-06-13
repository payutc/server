<?php

require_once "ServiceBaseRodbTest.php";

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
}



