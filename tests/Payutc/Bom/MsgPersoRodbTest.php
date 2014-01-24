<?php

require_once 'utils.php';

use \Payutc\Bom\MsgPerso;
use \Payutc\Exception\MessageUpdateFailedException;

class MsgPersoRodbTest extends ReadOnlyDatabaseTest
{

    public function getDataSet()
    {
        return $this->computeDataset(array(
            'messages',
            'fundations',
        ));
    }

    /**
     * Tests whether an user having set a message in a fundation retrieves it
     */
    public function testGetMsgPersoUserFun()
    {
        $msg = MsgPerso::getMsgPerso(1, 1);
        $this->assertEquals($msg, 'Message de user 1 au pic');
    }

    /**
     * Tests whether an user without a message in a fundation gets the correct
     * message returned
     * 
     * @depends testGetMsgPersoUserFun
     */
    public function testGetMsgPersoUserFun2()
    {
        $msg = MsgPerso::getMsgPerso(2, 1);
        $this->assertEquals($msg, 'Il y a une vie apres les cours');
    }

    /**
     * Tests whether an user gets his general message
     * 
     * @depends testGetMsgPersoUserFun2
     */
    public function testGetMsgPersoUser()
    {
        $msg = MsgPerso::getMsgPerso(1, NULL);
        $this->assertEquals($msg, 'Message de user 1');
	}
}


