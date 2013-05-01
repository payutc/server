<?php

require_once 'bootstrap.php';


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

use \Payutc\Config;
use \Payutc\Log;

class LogTest extends PHPUnit_Framework_TestCase
{
	
	public function __construct()
	{
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



