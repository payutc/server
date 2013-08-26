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
            'applications.yml',
            'applicationright.yml',
            'fundationrights.yml',
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

    public function loginApp(&$cookie='', &$r, $key='my_app')
    {
        $r = httpSend('POSS3', 'loginApp', $cookie, array(
            'key' => $key,
        ));
        return $r;
    }

    public function getUserId(&$cookie='', &$r, $login='trecouvr')
    {
        $r = httpSend('ADMINRIGHT', 'getUserId', $cookie, array(
                                                          'login' => $login,
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
        $this->loginApp($cookie, $r, 'my_app');
        $this->assertEquals(200, $r->code);
    }

    /**
     * @requires PHP 5.4
     */
    public function testGetUserId()
    {
        $cookie = '';
        $r = null;
        $this->loginApp($cookie, $r, 'my_app');
        $this->loginCas($cookie);
        $this->getUserId($cookie, $r, 'trecouvr');
        $this->assertEquals('1', $r->body);
    }
}

