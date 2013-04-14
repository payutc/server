<?php

require_once 'bootstrap.php';


use \Payutc\Service\POSS2WithExceptions;

class POSS2WithExceptionsTest extends ReadOnlyDatabaseTest
{
	public function getDataSet()
	{
		//return return new MyApp_DbUnit_ArrayDataSet($this->dataset);
		$seeddir = dirname(__FILE__).'/seed/';
		$ds = new PHPUnit_Extensions_Database_DataSet_YamlDataSet($seeddir.'mols.yml');
		$ds->addYamlFile($seeddir.'users.yml');
		return $ds;
	}

	/**
	 * setup before each tests
	 */
	public function setUp()
	{
		parent::setUp();
		$this->POSS = new POSS2WithExceptions;
	}
	
	/**
	 * tearDown after each tests
	 */
	public function tearDown()
	{
		parent::tearDown();
	}
	
	public function testGetCasUrl()
	{
		global $_CONFIG;
		$url = $this->POSS->getCasUrl();
		$this->assertEquals($_CONFIG['cas_url'], $url);
	}
	
	/**
	 * @expectedException		 \Payutc\Exception\PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Il n'y a pas de seller chargé.
	 */
	public function testGetSellerIdentityWhenNoSeller()
	{
		$this->POSS->getSellerIdentity();
	}
	
	public function testIsLoadedSellerWhenNoSeller()
	{
		$id = $this->POSS->isLoadedSeller();
		$this->assertEquals(false, $id);
	}
	
	/**
	 * @expectedException		 \Payutc\Exception\PossException
	 * @expectedExceptionCode	 1401
	 * @expectedExceptionMessage Aucun seller n'est logué.
	 */
	public function testLogoutWhenNoSeller()
	{
		$this->POSS->logout();
	}
	
	/**
	 * @expectedException		 \Payutc\Exception\PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Il n'y a pas de seller chargé.
	 */
	public function testGetArticlesWhenNoSeller()
	{
		$this->POSS->getArticles();
	}
	
	/**
	 * @expectedException		 \Payutc\Exception\PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Il n'y a pas de seller chargé.
	 */
	public function testGetBuyerInfoWhenNoSeller()
	{
		$this->POSS->getBuyerInfo("1234");
	}
	
	/**
	 * @expectedException		 \Payutc\Exception\PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Il n'y a pas de seller chargé.
	 */
	public function testCancelWhenNoSeller()
	{
		$this->POSS->cancel("1234");
	}
	
	/**
	 * @expectedException		 \Payutc\Exception\PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Il n'y a pas de seller chargé.
	 */
	public function testTransactionWhenNoSeller()
	{
		$this->POSS->transaction("1234", "1234");
	}
	
	/**
	 * @expectedException		 \Payutc\Exception\PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Image non trouvée.
	 */
	public function testGetImage64WhenInvalidId()
	{
		$this->POSS->getImage64(-1);
	}
	
	
	
	
}

