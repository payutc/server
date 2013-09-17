<?php

require_once 'bootstrap.php';

use \Payutc\Bom\User;

class UserRodbTest extends ReadOnlyDatabaseTest
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
	public function testConstruct()
	{
		$u = new User("trecouvr");
	}
	
    /**
     * @requires PHP 5.4
     */
	public function testRetrieve()
	{
		$u = new User("trecouvr");
		$this->assertEquals("trecouvr", $u->getNickname());
		$this->assertEquals("Thomas", $u->getFirstname());
		$this->assertEquals("Recouvreux", $u->getLastname());
		$this->assertEquals("thomas.recouvreux@etu.utc.fr", $u->getMail());
		$this->assertEquals(9000 , $u->getCredit());
	}
	
    /**
     * @requires PHP 5.4
     */
	public function testCheckUsrNotBlockedWithFreeUsr()
	{
		$u = new User("trecouvr");
		
		$u->checkNotBlocked();
		$u->checkNotBlocked(1);
	}
	
	
	/**
	 * Test the user is not blocked in all Payutc
	 * 
	 * @expectedException		 \Payutc\Exception\UserIsBlockedException
	 * @expectedExceptionMessage L'utilisateur à été bloqué pour le motif suivant: A fait pipi sur le mur, vilain pas beau !
     * @requires PHP 5.4
	 */
	public function testCheckUsrNotBlockedWithBlockedUsr_1()
	{
		$u = new User("mguffroy");
		$u->checkNotBlocked();
	}
	
	/**
	 * Test the user is not blocked in a fundation
	 * 
	 * @expectedException		 \Payutc\Exception\UserIsBlockedException
	 * @expectedExceptionMessage L'utilisateur à été bloqué pour le motif suivant: A fait pipi sur le mur, vilain pas beau !
     * @requires PHP 5.4
	 */
	public function testCheckUsrNotBlockedWithBlockedUsr_2()
	{
		$u = new User("mguffroy");
		$u->checkNotBlocked(1);
	}
	
    /**
     * @requires PHP 5.4
     */
	public function testUserExist()
	{
		$this->assertFalse(User::userExistById(99942));
		$u = new User("trecouvr");
		$this->assertTrue(User::userExistById($u->getId()));
	}
}

