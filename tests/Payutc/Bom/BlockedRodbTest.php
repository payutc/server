<?php

require_once 'utils.php';

use \Payutc\Bom\Blocked;

class BlockedRodbTest extends ReadOnlyDatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataSet(array(
            'users.yml',
            'blocked.yml',
            'fundations.yml',
        ));
    }
    
    public function testUserIsBlocked()
    {
        $arr_block = Array (
            'blo_id' => '1',
            'blo_raison' => 'A fait pipi sur le mur, vilain pas beau !',
            'blo_insert' => '2000-01-01 00:00:00',
            'blo_removed' => null,
            'fun_id' => '1',
        );
        $this->assertFalse(Blocked::userIsBlocked(1, 1));
        $this->assertFalse(Blocked::userIsBlocked(1, 2));
        $this->assertFalse(Blocked::userIsBlocked(1));
        $this->assertFalse(Blocked::userIsBlocked(9447, 2));
        
        $this->assertEquals($arr_block, Blocked::userIsBlocked(9447, 1));
        $this->assertEquals($arr_block, Blocked::userIsBlocked(9447));
    }
    
    /**
     * @depends testUserIsBlocked
     */
    public function testCheckUsrNotBlockedWithFreeUsr()
    {
        Blocked::checkUsrNotBlocked(1, 1);
        Blocked::checkUsrNotBlocked(1);
    }
    
    
    /**
     * Test the user is not blocked in all Payutc
     * 
     * @depends testUserIsBlocked
     * 
     * @expectedException         \Payutc\Exception\UserIsBlockedException
     * @expectedExceptionMessage L'utilisateur à été bloqué pour le motif suivant: A fait pipi sur le mur, vilain pas beau !
     */
    public function testCheckUsrNotBlockedWithBlockedUsr_1()
    {
        Blocked::checkUsrNotBlocked(9447);
    }
    
    /**
     * Test the user is not blocked in a fundation
     * 
     * @depends testUserIsBlocked
     * 
     * @expectedException         \Payutc\Exception\UserIsBlockedException
     * @expectedExceptionMessage L'utilisateur à été bloqué pour le motif suivant: A fait pipi sur le mur, vilain pas beau !
     */
    public function testCheckUsrNotBlockedWithBlockedUsr_2()
    {
        Blocked::checkUsrNotBlocked(9447, 1);
    }
    
}

