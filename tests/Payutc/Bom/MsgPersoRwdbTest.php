<?php

require_once 'utils.php';

use \Payutc\Bom\MsgPerso;
use \Payutc\Exception\MessageUpdateFailedException;

class MsgPersoRwdbTest extends DatabaseTest
{

    public function getDataSet()
    {
        return $this->computeDataset(array(
            'messages',
            'fundations',
        ));
    }

    /**
     * Tests whether an user can create his message in a fundation
     * 
     */
    public function testSetMsgPersoUsrFunInsert()
    {
        MsgPerso::setMsgPerso('Message de user 2 au pic', 2, 1);
        $res = MsgPerso::getMsgPerso(2, 1);
        $this->assertEquals($res, 'Message de user 2 au pic');

    }

    /**
     * Tests whether an user can modify his message in a fundation
     * 
     * @depends testSetMsgPersoUsrFunInsert
     */
    public function testSetMsgPersoUsrFunUpdate()
    {
        MsgPerso::setMsgPerso('Message de user 2 au pic 2', 2, 1);
        $res = MsgPerso::getMsgPerso(2, 1);
        $this->assertEquals($res, 'Message de user 2 au pic 2');
    }

    /**
     * Tests whether an user can create his general message
     * 
     * @depends testSetMsgPersoUsrFunUpdate
     */
    public function testSetMsgPersoUsrInsert()
    {
        MsgPerso::setMsgPerso('Message de user 3', 3, 1);
        $res = MsgPerso::getMsgPerso(3, 1);
        $this->assertEquals($res, 'Message de user 3');
    }

    /**
     * Tests whether an user can update his general message
     * 
     * @depends testSetMsgPersoUsrInsert
     */
    public function testSetMsgPersoUsrUpdate()
    {
        MsgPerso::setMsgPerso('Message de user 1 (2)', 1, NULL);
        $res = MsgPerso::getMsgPerso(1, NULL);
        $this->assertEquals($res, 'Message de user 1 (2)');

	}

    /**
     * Tests whether an user can set a message for a fundation
     * 
     * @depends testSetMsgPersoUsrUpdate
     */
    public function testSetMsgPersoFunInsert()
    {
        MsgPerso::setMsgPerso('pic', NULL, 1);
        $res = MsgPerso::getMsgPerso(NULL, 1);
        $this->assertEquals($res, 'pic');
	}

    /**
     * Tests whether an user can modify a message for a fundation
     * 
     * @depends testSetMsgPersoFunInsert
     */
    public function testSetMsgPersoFunUpdate()
    {
        MsgPerso::setMsgPerso('pic2', NULL, 1);
        $res = MsgPerso::getMsgPerso(NULL, 1);
        $this->assertEquals($res, 'pic2');
	}

    /**
     * Tests whether it’s impossible to set a message for an inexisting fundation
     * 
     * @depends testSetMsgPersoFunUpdate
     *
     * @expectedException         \Payutc\Exception\MessageUpdateFailedException
     * @expectedExceptionMessage Fundation non existante
     */
    public function testSetMsgPersoInexistingFun()
    {
        $res = MsgPerso::setMsgPerso("test", NULL, 2);
	}
}

