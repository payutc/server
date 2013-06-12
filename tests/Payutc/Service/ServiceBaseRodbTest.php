<?php

require_once "bootstrap.php";

use \Payutc\Config;


abstract class ServiceBaseRodbTest extends ReadOnlyDatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataset($this->getFixtures());
    }

    public function getFixtures()
    {
        return array(
            'users.yml',
            'fundations.yml',
            'applications.yml'
        );
    }
    
    public function loginCas(&$cookie='', &$r=null, $ticket='trecouvr@SERVICE', $service='SERVICE')
    {
        $r = httpSend('POSS3', 'loginCas', $cookie, array(
            'ticket' => $ticket,
            'service' => $service,
        ));
        return $r;
    }

    public function loginApp(&$cookie='', &$r, $key='app1')
    {
        $cookie = '';
        $r = httpSend('POSS3', 'loginApp', $cookie, array(
            'key' => $key,
        ));
        return $r;
    }

    /**
     * @requires PHP 5.4
     */
    public function testGetCasUrl()
    {
        $r = httpSend('POSS3', 'getCasUrl');
        $this->assertEquals(200, $r->code);
        $this->assertEquals(Config::get('cas_url'), $r->body);
    }

    /**
     * @requires PHP 5.4
     */
    public function testLoginCas()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'trecouvr@SERVICE', 'SERVICE');
        $this->assertEquals(200, $r->code);
    }

    /**
     * @requires PHP 5.4
     */
    public function testLoginApp()
    {
        $cookie = '';
        $r = null;
        $this->loginApp($cookie, $r, 'app1');
        $this->assertEquals(200, $r->code);
    }
}

