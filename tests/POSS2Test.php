<?php

require_once 'bootstrap.php';


use \Payutc\Service\POSS2WithExceptions;
use \Payutc\Config;

class POSS2WithExceptionsTest extends ReadOnlyDatabaseTest
{
	public function getDataSet()
	{
        return $this->computeDataset(array(
            'mols.yml',
            'users.yml'
        ));
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
		$url = $this->POSS->getCasUrl();
		$this->assertEquals(Config::get('cas_url'), $url);
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

