<?php


require_once '../vendor/autoload.php';

require_once './config.inc.php';

use \Payutc\Config;
use \Httpful\Request;

$SEED_DIR = dirname(__FILE__)."/seed/";
function filepathSeed($fixture)
{
	global $SEED_DIR;
	return $SEED_DIR.$fixture;
}

function httpSend($service, $meth, &$cookies='', $params=array())
{
	$url = "http://localhost:33436/$service/$meth?";
    foreach ($params as $k=>$v) {
        $url .= $k."=".urlencode($v)."&";
    }
    $r = Request::get($url)
      ->addHeader('Cookie', $cookies)
      ->sendsJson()
      ->parseWith(function($body) { return json_decode($body, true); })
      ->send();

    $headers = $r->headers->toArray();
    if (array_key_exists('set-cookie', $headers)) {
        $rcookie = $headers['set-cookie'];
        if (strpos($cookies, $rcookie) === false) $cookies .= $rcookie;
    }
	return $r;
}

function sort_by_key(&$arr, $key)
{
	usort($arr, function ($a,$b) use ($key) { return ($a[$key] < $b[$key]) ? -1 : 1; });
}


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
		$cascadeTruncates = false; // True if you want cascading truncates, false otherwise. If unsure choose false.
        return new TruncateOperation($cascadeTruncates);
    }
    
	function computeDataset($fixture)
	{
		if (!is_array($fixture)) {
			$fixture = array($fixture);
		}
		$ds = null;
		for ($i=0; $i<count($fixture); $i++) {
			$filepath = filepathSeed($fixture[$i]);
			if ($i == 0) {
				$ds = new PHPUnit_Extensions_Database_DataSet_YamlDataSet($filepath);
			}
			else {
				$ds->addYamlFile($filepath);
			}
		}
		return $ds;
	}
}




abstract class ReadOnlyDatabaseTest extends DatabaseTest
{
	protected static $alreadyInserted = null;
	
	protected function getSetUpOperation()
	{
		if (static::$alreadyInserted !== get_class($this)) {
            static::$alreadyInserted = get_class($this);
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


