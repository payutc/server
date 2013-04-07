<?php


require_once '../vendor/autoload.php';
require_once '../config.inc.php';

class TruncateOperation extends \PHPUnit_Extensions_Database_Operation_Truncate
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
}




abstract class ReadOnlyDatabaseTest extends DatabaseTest
{
	protected $alreadyInserted = false;
	
	protected function getSetUpOperation()
	{
		if (!$this->alreadyInserted) {
			return parent::getSetUpOperation();
		}
		return NULL;
	}

	/**
	 * clear db
	 * called in tearDown()
	 */
	protected function getTearDownOperation()
	{
		// dont clean the db after each tests
    }
}


