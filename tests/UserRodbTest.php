<?php

require_once 'bootstrap.php';

use \User;

class UserRodbTest extends ReadOnlyDatabaseTest
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
	
	public function testConstruct()
	{
		$u = new User("trecouvr", 1, 0, 0, 1);
		$this->assertEquals(1, $u->getState());
	}
	
	public function testRetrieve()
	{
		$u = new User("trecouvr", 1, 0, 0, 1);
		$this->assertEquals(1, $u->getState());
		$this->assertEquals("trecouvr", $u->getNickname());
		$this->assertEquals("Thomas", $u->getFirstname());
		$this->assertEquals("Recouvreux", $u->getLastname());
		$this->assertEquals("thomas.recouvreux@etu.utc.fr", $u->getMail());
		$this->assertEquals(9000 , $u->getCredit());
	}
	
	public function testCheckUsrNotBlockedWithFreeUsr()
	{
		$u = new User("trecouvr", 1, 0, 0, 1);
		
		$u->checkNotBlocked();
		$u->checkNotBlocked(1);
	}
	
	
	/**
	 * Test the user is not blocked in all Payutc
	 * 
	 * @expectedException		 \Payutc\Exception\UserIsBlockedException
	 * @expectedExceptionMessage L'utilisateur à été bloqué pour le motif suivant: A fait pipi sur le mur, vilain pas beau !
	 */
	public function testCheckUsrNotBlockedWithBlockedUsr_1()
	{
		$u = new User("mguffroy", 1, 0, 0, 1);
		$u->checkNotBlocked();
	}
	
	/**
	 * Test the user is not blocked in a fundation
	 * 
	 * @expectedException		 \Payutc\Exception\UserIsBlockedException
	 * @expectedExceptionMessage L'utilisateur à été bloqué pour le motif suivant: A fait pipi sur le mur, vilain pas beau !
	 */
	public function testCheckUsrNotBlockedWithBlockedUsr_2()
	{
		$u = new User("mguffroy", 1, 0, 0, 1);
		$u->checkNotBlocked(1);
	}
}

