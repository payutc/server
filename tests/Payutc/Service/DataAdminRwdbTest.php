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
    
    
    /*
     * requires PHP 5.4
     */
    public function testSet()
    {
        $orig_fun = ExternalData::get(1, 'key-fun');
        $orig_usr = ExternalData::get(1, 'key-user', 1);
        
        $cookie = '';
        $r = null;
        $this->loginCas($cookie, $r, 'trecouvr@DATAADMIN', 'DATAADMIN');
        $this->loginApp($cookie, $r, 'my_app');
        $r = httpSend('DATAADMIN', 'set', $cookie, array(
            'fun_id' => '1',
            'usr_id' => '1',
            'key' => 'key-user',
            'val' => $orig_usr.'n'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals($orig_usr.'n', ExternalData::get(1, 'key-user', 1));
        $r = httpSend('DATAADMIN', 'set', $cookie, array(
            'fun_id' => '1',
            'key' => 'key-fun',
            'val' => $orig_fun.'n'
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals($orig_fun.'n', ExternalData::get(1, 'key-fun'));
    }
}

