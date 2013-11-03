<?php

require_once 'utils.php';

use \Payutc\Bom\User;

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
    
    /**
     * @requires PHP 5.4
     */
    public function testBlockMe()
    {
        $u = new User("trecouvr");
        $this->assertFalse($u->isBlockedMe());
        $u->setSelfBlock(1);
        $this->assertTrue($u->isBlockedMe());
        $u->setSelfBlock(0);
        $this->assertFalse($u->isBlockedMe());
	}
    
    /**
     * @requires PHP 5.4
     */
    public function testIncCredit()
    {
        $u = new User("trecouvr");
        $u->incCredit(100);
        $this->assertEquals(9100, $u->getCredit());
        $u = new User("trecouvr");
        $this->assertEquals(9100, $u->getCredit());
    }
    
    /**
     * @requires PHP 5.4
     */
    public function testDecCredit()
    {
        $u = new User("trecouvr");
        $u->decCredit(100);
        $this->assertEquals(8900, $u->getCredit());
        $u = new User("trecouvr");
        $this->assertEquals(8900, $u->getCredit());
    }
}

