<?php

require_once "ServiceBaseRodbTest.php";

use \Payutc\Bom\User;

class ReloadRodbTest extends ServiceBaseRodbTest
{
    public function getFixtures()
    {
        return array_merge(parent::getFixtures(), array());
    }


    /* ========== TEST DE info =============================== */
    /**
     * @requires PHP 5.4
     */
    public function testInfo()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'mguffroy@POSS3', 'POSS3');
        $this->loginApp($cookie, $r, 'app_reload');
        $r = httpSend('RELOAD', 'info', $cookie, array());      
        $this->assertEquals(200, $r->code);
        $this->assertEquals(array(
		    "min" => 1000,
		    "max_credit" => 10000,
		    "max_reload" => 5000,
		    "can" => true), $r->body);
    }

    /**
     * PAs d'app connecté, verifie l'erreur
     * @requires PHP 5.4
     */    
    public function testInfo2()
    {
        $cookie = '';
        $r = null;
        $r = httpSend('RELOAD', 'info', $cookie, array());
        $this->assertEquals(400, $r->code);
    }  
    
    /**
     * PAs d'user connecté, verifie l'erreur
     * @requires PHP 5.4
     */    
    public function testInfo3()
    {
        $cookie = '';
        $r = null;
        $this->loginApp($cookie, $r, 'app_reload');
        $r = httpSend('RELOAD', 'info', $cookie, array());
        $this->assertEquals(400, $r->code);
    }  
    
    /* ========== TEST DE reload =============================== */
    /**
     * @requires PHP 5.4
     */
    public function testReload()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'mguffroy@POSS3', 'POSS3');
        $this->loginApp($cookie, $r, 'app_reload');
        $r = httpSend('RELOAD', 'reload', $cookie, array("amount" => 5300, "callbackUrl" => ""));      
        $this->assertEquals(400, $r->code);
    }

    /**
     * PAs d'app connecté, verifie l'erreur
     * @requires PHP 5.4
     */    
    public function testReload2()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'mguffroy@POSS3', 'POSS3');
        $r = httpSend('RELOAD', 'reload', $cookie, array("amount" => 2000, "callbackUrl" => "")); 
        $this->assertEquals(400, $r->code);
    }  
    
    /**
     * PAs d'user connecté, verifie l'erreur
     * @requires PHP 5.4
     */    
    public function testReload3()
    {
        $cookie = '';
        $r = null;
        $this->loginApp($cookie, $r, 'app_reload');
        $r = httpSend('RELOAD', 'reload', $cookie, array("amount" => 2000, "callbackUrl" => "")); 
        $this->assertEquals(400, $r->code);
    }

}



