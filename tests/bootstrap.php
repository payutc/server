<?php


require_once '../vendor/autoload.php';

require_once 'config.inc.php';

use \Payutc\Config;

class TruncateOperation extends \PHPUnit_Extensions_Database_Operation_Truncate
{
	public function execute(\PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection, \PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet) {
		$connection->getConnection()->query("SET foreign_key_checks = 0");
		parent::execute($connection, $dataSet);
		$connection->getConnection()->query("SET foreign_key_checks = 1");
	}
}

class InsertOperation extends \PHPUnit_Extensions_Database_Operation_Insert
{
	public function execute(\PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection, \PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet) {
		$connection->getConnection()->query("SET foreign_key_checks = 0");
		parent::execute($connection, $dataSet);
		$connection->getConnection()->query("SET foreign_key_checks = 1");
	}
}

abstract class DatabaseTest extends \PHPUnit_Extensions_Database_TestCase
{
	protected $pdo;

    public function __construct()
    {
		global $_CONFIG;
		global $_SERVER;
		$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
		
		Config::initFromArray($_CONFIG);
		
		$this->pdo = new PDO('mysql:dbname='.Config::get('sql_db').';host='.Config::get('sql_host'),
			Config::get('sql_user'),
			Config::get('sql_pass')
		);
    }
    
	/**
	 * get db connection
	 */
	protected function getConnection()
	{
		return $this->createDefaultDBConnection($this->pdo);
	}
	
	/**
	 * setupd db
	 * called in setUp()
	 */
	protected function getSetUpOperation()
	{
		$cascadeTruncates = false; // True if you want cascading truncates, false otherwise. If unsure choose false.
		return new \PHPUnit_Extensions_Database_Operation_Composite(array(
			new TruncateOperation($cascadeTruncates),
			new InsertOperation()
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
}




abstract class ReadOnlyDatabaseTest extends DatabaseTest
{
	protected $alreadyInserted = false;
	
	protected function getSetUpOperation()
	{
		if (!$this->alreadyInserted) {
			return parent::getSetUpOperation();
		}
		return new PHPUnit_Extensions_Database_Operation_Null();
	}

	/**
	 * clear db
	 * called in tearDown()
	 */
	protected function getTearDownOperation()
	{
		return new PHPUnit_Extensions_Database_Operation_Null();
    }
}


