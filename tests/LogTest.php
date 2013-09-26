<?php

require_once 'bootstrap.php';


class MyWriter
{
	protected $logs;
	protected $level_to_string = array(
		\Slim\Log::EMERGENCY => "emergency",
		\Slim\Log::ALERT => "alert",
		\Slim\Log::CRITICAL => "critical",
		\Slim\Log::ERROR => "error",
		\Slim\Log::WARN => "warn",
		\Slim\Log::NOTICE => "notice",
		\Slim\Log::INFO => "info",
		\Slim\Log::DEBUG => "debug"
	);
	
	public function write($m, $level)
	{
		$this->logs .= "[".$this->level_to_string[$level]."] $m\n";
	}
	
	public function clean()
	{
		$this->logs = "";
	}
	
	public function getLogs()
	{
		return $this->logs;
	}
}

use \Payutc\Config;
use \Payutc\Log;

class LogTest extends PHPUnit_Framework_TestCase
{
	
	public function __construct()
	{
		global $_CONFIG;
		global $_SERVER;
		$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
		
		Config::initFromArray($_CONFIG);
        
		$log = Log::getInstance();
		$log->setWriter(new MyWriter());
		$log->setLevel(\Slim\Log::DEBUG);
	}
	
	protected function setUp()
	{
		Log::getWriter()->clean();
	}
	
	protected function tearDown()
	{
		Log::getWriter()->clean();
	}
	
	public function testInitDontCrash()
	{
		Log::initLog();
	}
	
	/**
	 * @depends testInitDontCrash
	 */
	public function testGetInstance()
	{
		$this->assertTrue(Log::getInstance() !== null);
	}
	
	public function testGetWriter()
	{
		$this->assertTrue(Log::getWriter() !== null);
	}
	
	/**
	 * @depends testGetInstance
	 * @depends testGetWriter
	 */
	public function testLogDebug()
	{
		Log::debug("coucou");
		$this->assertEquals("[debug] coucou\n", Log::getWriter()->getLogs());
	}
	
	/**
	 * @depends testGetInstance
	 * @depends testGetWriter
	 */
	public function testLogInfo()
	{
		Log::info("coucou");
		$this->assertEquals("[info] coucou\n", Log::getWriter()->getLogs());
	}
	
	/**
	 * @depends testGetInstance
	 * @depends testGetWriter
	 */
	public function testLogWarn()
	{
		Log::warn("coucou");
		$this->assertEquals("[warn] coucou\n", Log::getWriter()->getLogs());
	}
	
	/**
	 * @depends testGetInstance
	 * @depends testGetWriter
	 */
	public function testLogError()
	{
		Log::error("coucou");
		$this->assertEquals("[error] coucou\n", Log::getWriter()->getLogs());
	}
	
	/**
	 * @depends testGetInstance
	 * @depends testGetWriter
	 */
	public function testLogCritical()
	{
		Log::critical("coucou");
		$this->assertEquals("[critical] coucou\n", Log::getWriter()->getLogs());
	}
}



