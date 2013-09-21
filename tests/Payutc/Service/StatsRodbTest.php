<?php

require_once "ServiceBaseRodbTest.php";

use \Payutc\Bom\User;

class StatsRodbTest extends ServiceBaseRodbTest
{
    public function getFixtures()
    {
        return array_merge(parent::getFixtures(), array(
            'products.yml', 'purchase.yml'
        ));
    }


    /* ========== TEST DE GET NB SELL =============================== */

    /**
     * @requires PHP 5.4
     */
    public function testGetNbSell()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'mguffroy@POSS3', 'POSS3');
        $this->loginApp($cookie, $r, 'app_stats');
        $r = httpSend('STATS', 'getNbSell', $cookie, array(
            'obj_id' => '3', 
            'fun_id' => '1'
        ));
        $this->assertEquals(200, $r->code);
        print_r($r->body);
    }


    /* ========== TEST DE GETRANK =============================== */
    /**
     * @requires PHP 5.4
     */
    public function testGetRank()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'mguffroy@POSS3', 'POSS3');
        $this->loginApp($cookie, $r, 'app_stats');
        $r = httpSend('STATS', 'getRank', $cookie, array(
            'fun_id' => '1',
            'semestre' => 'P13'
        ));
        $this->assertEquals(200, $r->code);
        print_r($r->body);
    }

    /**
     * @requires PHP 5.4
     */
    public function testGetRankErrorOnSemester()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'mguffroy@POSS3', 'POSS3');
        $this->loginApp($cookie, $r, 'app_stats');
        $r = httpSend('STATS', 'getRank', $cookie, array(
            'fun_id' => '1',
            'semester' => 'Automne 2013'
        ));
        //$this->assertEquals(200, $r->code);
        print($r->code);
    }


 
}



