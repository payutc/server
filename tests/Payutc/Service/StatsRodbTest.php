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
            'obj_id' => '4', 
            'fun_id' => '1'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals(8, $r->body);
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
        $this->assertEquals(array(array(
                'totalPrice' => 630,
                'nbBuy' => 9,
                'usr_firstname' => 'Matthieu',
                'usr_lastname' => 'Guffroy',
                'usr_nickname' => 'mguffroy'
                )), $r->body);
    }

    /* ========== TEST DE GETRECETTE =============================== */
    /**
     * @requires PHP 5.4
     */
    public function testGetRecette()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'mguffroy@POSS3', 'POSS3');
        $this->loginApp($cookie, $r, 'app_stats');
        $r = httpSend('STATS', 'getRecette', $cookie, array(
                                                            'fun_id' => '1',
                                                            'app_id' => '51'
                                                            ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals(630, $r->body);
    }

}



