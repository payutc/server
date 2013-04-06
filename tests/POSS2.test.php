<?php

require_once '../vendor/autoload.php';
require_once '../config.inc.php';
require_once '../services/POSS2-with-exceptions.service.php';


class TruncateOperation extends \PHPUnit_Extensions_Database_Operation_Truncate
{
	public function execute(\PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection, \PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet) {
		$connection->getConnection()->query("SET foreign_key_checks = 0");
		parent::execute($connection, $dataSet);
		$connection->getConnection()->query("SET foreign_key_checks = 1");
	}
}

class POSS2WithExceptionsTest extends \PHPUnit_Extensions_Database_TestCase
{
	protected $pdo;

    public function __construct()
    {
		global $_CONFIG;
		global $_SERVER;
		$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
				
		$_CONFIG['sql_host'] = $_CONFIG['sql_host_test'];
		$_CONFIG['sql_db'] = $_CONFIG['sql_db_test'];
		$_CONFIG['sql_user'] = $_CONFIG['sql_user_test'];
		$_CONFIG['sql_pass'] = $_CONFIG['sql_pass_test'];
		
		$this->pdo = new PDO('mysql:dbname='.$_CONFIG['sql_db'].';host='.$_CONFIG['sql_host'],
			$_CONFIG['sql_user'],
			$_CONFIG['sql_pass']
		);
    }
    
	/**
	 * setupd db
	 * called in setUp()
	 */
	public function getSetUpOperation()
	{
		$cascadeTruncates = false; // True if you want cascading truncates, false otherwise. If unsure choose false.
		return new \PHPUnit_Extensions_Database_Operation_Composite(array(
			new TruncateOperation($cascadeTruncates),
			\PHPUnit_Extensions_Database_Operation_Factory::INSERT()
		));
	}

	/**
	 * clear db
	 * called in tearDown()
	 */
	protected function getTearDownOperation()
	{
        return $this->getOperations()->DELETE_ALL();
    }

	/**
	 * get db connection
	 */
	public function getConnection()
	{
		return $this->createDefaultDBConnection($this->pdo);
	}

	/**
	 * get db dataset
	 */
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
	 * @expectedException		 \PossException
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
	 * @expectedException		 \PossException
	 * @expectedExceptionCode	 1401
	 * @expectedExceptionMessage Aucun seller n'est logué.
	 */
	public function testLogoutWhenNoSeller()
	{
		$this->POSS->logout();
	}
	
	/**
	 * @expectedException		 \PossException
	 * @expectedExceptionCode	 -1
	 * @expectedExceptionMessage Erreur de login CAS.
	 */
	public function testLoadPos()
	{
		$this->POSS->loadPos(1234, 4321, 3, NULL);
	}
	
	/**
	 * @expectedException		 \PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Il n'y a pas de seller chargé.
	 */
	public function testGetArticlesWhenNoSeller()
	{
		$this->POSS->getArticles();
	}
	
	/**
	 * @expectedException		 \PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Il n'y a pas de seller chargé.
	 */
	public function testGetBuyerInfoWhenNoSeller()
	{
		$this->POSS->getBuyerInfo("1234");
	}
	
	/**
	 * @expectedException		 \PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Il n'y a pas de seller chargé.
	 */
	public function testCancelWhenNoSeller()
	{
		$this->POSS->cancel("1234");
	}
	
	/**
	 * @expectedException		 \PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Il n'y a pas de seller chargé.
	 */
	public function testTransactionWhenNoSeller()
	{
		$this->POSS->transaction("1234", "1234");
	}
	
	/**
	 * @expectedException		 \PossException
	 * @expectedExceptionCode	 400
	 * @expectedExceptionMessage Image non trouvée.
	 */
	public function testGetImage64WhenInvalidId()
	{
		$this->POSS->getImage64(-1);
	}
	
	
	
	
}

