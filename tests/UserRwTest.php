<?php

require_once 'bootstrap.php';

use \User;

class UserDatabaseTest extends DatabaseTest
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
        
    public function testBlockMe()
    {
        $u = new User("trecouvr", 1, 0, 0, 1);
        $this->assertFalse($u->isBlockedMe());
        $u->blockMe();
        $this->assertTrue($u->isBlockedMe());
	}
    
    public function testIncCredit()
    {
        $u = new User("trecouvr", 1, 0, 0, 1);
        $u->incCredit(100);
        $this->assertEquals(9100, $u->getCredit());
        $u = new User("trecouvr", 1, 0, 0, 1);
        $this->assertEquals(9100, $u->getCredit());
    }
    
    public function testDecCredit()
    {
        $u = new User("trecouvr", 1, 0, 0, 1);
        $u->decCredit(100);
        $this->assertEquals(8900, $u->getCredit());
        $u = new User("trecouvr", 1, 0, 0, 1);
        $this->assertEquals(8900, $u->getCredit());
    }
}

