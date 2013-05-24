<?php

require_once 'bootstrap.php';

use \User;

class UserDatabaseTest extends ReadOnlyDatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        //return return new MyApp_DbUnit_ArrayDataSet($this->dataset);
        $seeddir = dirname(__FILE__).'/seed/';
        $ds = new PHPUnit_Extensions_Database_DataSet_YamlDataSet($seeddir.'users.yml');
        return $ds;
    }
    
    public function testSetIdPhoto()
    {
        $u = new User("trecouvr", 1, 0, 0, 1);
        $u->setIdPhoto(42);
        $u = new User("trecouvr", 1, 0, 0, 1);
        $this->assertEquals(42, $u->getIdPhoto());
    }
    
    public function testBlockMe()
    {
        $u = new User("trecouvr", 1, 0, 0, 1);
        $this->assertFalse($u->isBlockedMe());
        $u->blockMe();
        $this->assertTrue($u->isBlockedMe());
	}
}

