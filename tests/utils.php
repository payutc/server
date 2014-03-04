<?php

require_once '../vendor/autoload.php';

require_once __DIR__ . '/config-test.inc.php';

use \Payutc\Config;
use \Httpful\Request;
use \Payutc\Log;
use \Test\Dataset\DatasetFactory;

$SEED_DIR = __DIR__ . "/seed/";
function filepathSeed($fixture)
{
	global $SEED_DIR;
	return $SEED_DIR.$fixture;
}

function httpSend($service, $meth, &$cookies='', $params=array())
{
	$url = "http://localhost:" . PAYUTC_TEST_SERVER_PORT . "/$service/$meth";
    $payload = "";
    foreach ($params as $k=>$v) {
        $payload .= $k."=".urlencode($v)."&";
    }
    $payload = rtrim($payload, "&");
    $r = Request::post($url)
      ->addHeader('Cookie', $cookies)
      ->body($payload)
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

function setupConfig()
{
    global $_CONFIG;
    global $_SERVER;
    $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    
    Config::initFromArray($_CONFIG);
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
		// add a transaction to speed up the insert
		$conn = $connection->getConnection();
		$conn->beginTransaction();
		// disable foreignkeys
		$connection->getConnection()->query("SET foreign_key_checks = 0");
		parent::execute($connection, $dataSet);
		// enable foreignkeys
		$connection->getConnection()->query("SET foreign_key_checks = 1");
		$conn->commit();
	}
}



abstract class DatabaseTest extends \PHPUnit_Extensions_Database_TestCase
{
	protected $pdo;

    public function __construct()
    {
		setupConfig();
        
        Log::init(Config::get('log_mode'), Config::get('log_filename'));
		
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
        $cascadeTruncates = false;
        return new TruncateOperation($cascadeTruncates);
    }
    
	function computeDataset($fixtures)
	{
		if (!is_array($fixtures)) {
			$fixture = array($fixtures);
		}
		$a = $fixtures;
		$ds = DatasetFactory::computeDataset($fixtures);
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


/**
 * Fake payline sdk
 */
class FakePaylineSdk
{
    public $returnURL = '';
    public $cancelURL = '';
    public $notificationURL = '';
    public $transactions = array();
    
    const NO_FAILURE = 0;
    const FAILURE_CODE = 1;
    const FAILURE_HARD = 2;
    
    protected $next_will_fail = self::NO_FAILURE;
    
    /*
     * next doWebPayment return will have a failure code
     */
    public function nextWillFail()
    {
        $this->next_will_fail = self::FAILURE_CODE;
    }
    
    /*
     * next doWebPayment return will be invalid (not even an array)
     */
    public function nextWillHardFail()
    {
        $this->next_will_fail = self::FAILURE_HARD;
    }
    
    public function doWebPayment($arr)
    {
        $token = $this->addTransaction($arr['payment']['amount']);
        
        $r = array(
            'result' => array(
                'code' => '00000',
            ),
            'token' => $token,
            'redirectURL' => 'http://localhost/fakePayline'
        );
        
        if ($this->next_will_fail == self::FAILURE_CODE) {
            $this->next_will_fail = self::NO_FAILURE;
            $r['result']['code'] = '1111';
            $r['result']['longMessage'] = 'Failure !!';
        }
        else if ($this->next_will_fail == self::FAILURE_HARD) {
            $this->next_will_fail = self::NO_FAILURE;
            $r = "failure";
        }
        return $r;
    }
    
    public function getWebPaymentDetails($arr)
    {
        $token = $arr['token'];
        
        $transaction = $this->transactions[$token];
        
        $r = array(
            'payment' => array(
                'amount' => $transaction['amount']
            ),
            'authorization' => array(
                'number' => 1
            ),
            'transaction' => array(
                'id' => 1
            ),
            'result' => array(
                'code' => $transaction['code']
            )
        );
        return $r;
    }
    
    public function validate($token)
    {
        $this->transactions[$token]['code'] = '00000';
    }
    
    public function cancel($token)
    {
        $this->transactions[$token]['code'] = '11111';
    }
    
    public function getLastTransaction()
    {
        return end($this->transactions);
    }
    
    protected function createTransaction($amount, $token = null)
    {
        if ($token === null) {
            $token = uniqid(true);
        }
        $t = array(
            'amount' => $amount,
            'code' => '02306', // en attente
            'token' => $token,
        );
        return $t;
    }
    
    protected function addTransaction($amount, $token = null)
    {
        $t = $this->createTransaction($amount, $token);
        $token = $t['token'];
        $this->transactions[$token] = $t;
        return $token;
    }
}


