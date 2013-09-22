<?php


require_once "ServiceBaseRodbTest.php";


class DataAdminRodbTest extends ServiceBaseRodbTest
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
    
    /*
     * requires PHP 5.4
     */
    public function testGet()
    {
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'trecouvr@DATAADMIN', 'DATAADMIN');
        $this->loginApp($cookie, $r, 'my_app');
        $r = httpSend('DATAADMIN', 'get', $cookie, array(
            'fun_id' => '1',
            'usr_id' => '1',
            'key' => 'key-user'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals('value1', $r->body);
        $r = httpSend('DATAADMIN', 'get', $cookie, array(
            'fun_id' => '1',
            'key' => 'key-user'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals('value3', $r->body);
    }
}

