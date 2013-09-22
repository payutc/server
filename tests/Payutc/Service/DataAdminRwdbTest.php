<?php


require_once "ServiceBaseRodbTest.php";

use \Payutc\Bom\ExternalData;

class DataAdminRwdbTest extends ServiceBaseRodbTest
{
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
    public function testSetFunData()
    {
        $orig_fun = ExternalData::get(1, 'key-fun');
        
        $r = httpSend('DATAADMIN', 'setFunData', $this->cookie, array(
            'fun_id' => '1',
            'key' => 'key-fun',
            'val' => $orig_fun.'n'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals($orig_fun.'n', ExternalData::get(1, 'key-fun'));
    }
    
    
    /**
     * @requires PHP 5.4
     */
    public function testSetUsrDataByLogin()
    {
        $orig_usr = ExternalData::get(1, 'key-user', 1);
        
        $r = httpSend('DATAADMIN', 'setUsrDataByLogin', $this->cookie, array(
            'fun_id' => '1',
            'login' => 'trecouvr',
            'key' => 'key-user',
            'val' => $orig_usr.'n'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals($orig_usr.'n', ExternalData::get(1, 'key-user', 1));
    }
    
    
    /**
     * @requires PHP 5.4
     */
    public function testSetUsrDataByBadge()
    {
        $orig_usr = ExternalData::get(1, 'key-user', 1);
        
        $r = httpSend('DATAADMIN', 'setUsrDataByBadge', $this->cookie, array(
            'fun_id' => '1',
            'badge' => 'ABCDABCD',
            'key' => 'key-user',
            'val' => $orig_usr.'n'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals($orig_usr.'n', ExternalData::get(1, 'key-user', 1));
    }
}

