<?php

require_once "ServiceBaseRodbTest.php";

class MyAccountRodbTest extends ServiceBaseRodbTest
{
    public function getFixtures()
    {
        return array_merge(parent::getFixtures(), array('products.yml', 'purchase.yml'));
    }


    /* ========== TEST DE historique =============================== */
    /**
     * @requires PHP 5.4
     */
    public function testHistorique()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'mguffroy@MYACCOUNT', 'MYACCOUNT');
        $this->loginApp($cookie, $r, 'app_myaccount');
        $r = httpSend('MYACCOUNT', 'historique', $cookie, array());    
        $this->assertEquals(200, $r->code);
        $this->assertEquals(5000, $r->body['credit']);
    }

    /**
     * Pas d'app connecté, verifie l'erreur
     * @requires PHP 5.4
     */    
    public function testHistorique2()
    {
        $cookie = '';
        $r = null;
        $r = httpSend('MYACCOUNT', 'historique', $cookie, array());
        $this->assertEquals(400, $r->code);
    }  
    
    /**
     * Pas d'user connecté, verifie l'erreur
     * @requires PHP 5.4
     */    
    public function testHistorique3()
    {
        $cookie = '';
        $r = null;
        $this->loginApp($cookie, $r, 'app_myaccount');
        $r = httpSend('MYACCOUNT', 'historique', $cookie, array());
        $this->assertEquals(400, $r->code);
    }  
}



