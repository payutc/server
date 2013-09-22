<?php


require_once "ServiceBaseRodbTest.php";


class DataAdminRodbTest extends ServiceBaseRodbTest
{
    protected $cookie;
    
    public function getDataSet()
    {
        return $this->computeDataset(array(
            'users.yml',
            'fundations.yml',
            'applications.yml',
            'fundationrights.yml',
            'applicationright.yml',
            'externaldata.yml'
        ));
    }
    
    public function setUp()
    {
        parent::setUp();
        if (PHP_VERSION_ID >= 50400) {
            $this->cookie = '';
            $this->loginCas($this->cookie, $r, 'trecouvr@DATAADMIN', 'DATAADMIN');
            $this->assertEquals(200, $r->code);
            $this->loginApp($this->cookie, $r, 'my_app');
            $this->assertEquals(200, $r->code);
        }
    }
    
    public function tearDown()
    {
        $this->cookie = '';
    }
    
    /**
     * @requires PHP 5.4
     */
    public function testGetUsrDataByLogin()
    {
        $r = httpSend('DATAADMIN', 'getUsrDataByLogin', $this->cookie, array(
            'fun_id' => '1',
            'login' => 'trecouvr',
            'key' => 'key-user'
        ));
        print_r($r->body);
        $this->assertEquals(200, $r->code);
        $this->assertEquals('value1', $r->body);
    }
    
    /**
     * @requires PHP 5.4
     */
    public function testGetUsrDataByBadge()
    {
        $r = httpSend('DATAADMIN', 'getUsrDataByBadge', $this->cookie, array(
            'fun_id' => '1',
            'badge' => 'ABCDABCD',
            'key' => 'key-user'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals('value1', $r->body);
    }
    
    /**
     * @requires PHP 5.4
     */
    public function testGetFunData()
    {
        $r = httpSend('DATAADMIN', 'getFunData', $this->cookie, array(
            'fun_id' => '1',
            'key' => 'key-user'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals('value3', $r->body);
    }
}

