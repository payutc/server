<?php


require_once "bootstrap.php";

use \Payutc\Config;

class KeyRodbTest extends ReadOnlyDatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataset(array(
            'users.yml'
        ));
    }
    
    /**
     * @requires PHP 5.4
     */
    public function testGetCasUrl()
    {
        $r = httpSend('KEY', 'getCasUrl');
        $this->assertEquals(200, $r->code);
        $this->assertEquals(Config::get('cas_url'), $r->body);
    }
}



