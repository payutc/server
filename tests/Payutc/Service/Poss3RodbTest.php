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

    public function testGetBuyerInfo()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'trecouvr@POSS3', 'POSS3');
        $this->loginApp($cookie, $r, 'app1');
    }
}



