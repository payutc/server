<?php

require_once '../vendor/autoload.php';
require_once '../config.inc.php';


class MyWriter
{
	protected $logs;
	
	public function write($m, $level)
	{
		$this->logs .= "[$level] $m\n";
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


use \Payutc\Log;

class LogTest extends PHPUnit_Framework_TestCase
{
	
	public function __construct()
	{
		global $_CONFIG;
		
		$_CONFIG['slim_config']['log.writer'] = new MyWriter();
		$_CONFIG['slim_config']['log.level'] = \Slim\Log::DEBUG;
		$_CONFIG['slim_config']['log.enabled'] = true;
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
		$this->assertEquals("[4] coucou\n", Log::getWriter()->getLogs());
	}
	
	/**
	 * @depends testGetInstance
	 * @depends testGetWriter
	 */
	public function testLogInfo()
	{
		Log::info("coucou");
		$this->assertEquals("[3] coucou\n", Log::getWriter()->getLogs());
	}
	
	/**
	 * @depends testGetInstance
	 * @depends testGetWriter
	 */
	public function testLogWarn()
	{
		Log::warn("coucou");
		$this->assertEquals("[2] coucou\n", Log::getWriter()->getLogs());
	}
	
	/**
	 * @depends testGetInstance
	 * @depends testGetWriter
	 */
	public function testLogError()
	{
		Log::error("coucou");
		$this->assertEquals("[1] coucou\n", Log::getWriter()->getLogs());
	}
	
	/**
	 * @depends testGetInstance
	 * @depends testGetWriter
	 */
	public function testLogFatal()
	{
		Log::fatal("coucou");
		$this->assertEquals("[0] coucou\n", Log::getWriter()->getLogs());
	}
}



