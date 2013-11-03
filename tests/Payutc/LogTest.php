<?php

require_once 'utils.php';


use \Payutc\Config;
use \Payutc\Log;

class LogTest extends PHPUnit_Framework_TestCase
{
	protected $testHandler = null;
	public function __construct()
	{
		global $_CONFIG;
		//global $_SERVER;
		//$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
		
		Config::initFromArray($_CONFIG);
	}
	
	protected function setUp()
	{
		Log::init(Log::TEST);
        $this->testHandler = Log::getStreamHandler();
	}
	
	protected function tearDown()
	{
	}
	
	public function testInitDontCrash()
	{
		Log::init(Log::DEV);
		Log::init(Log::PRD);
	}
	
	public function testLogDebug()
	{
		Log::debug("coucou");
        $this->assertTrue($this->testHandler->hasDebug(array('message'=>'coucou')));
	}
	
	public function testLogInfo()
	{
		Log::info("coucou");
        $this->assertTrue($this->testHandler->hasInfo(array('message'=>'coucou')));
	}
	
	public function testLogWarn()
	{
		Log::warn("coucou");
        $this->assertTrue($this->testHandler->hasWarning(array('message'=>'coucou')));
	}
	
	public function testLogWarning()
	{
		Log::warning("coucou");
        $this->assertTrue($this->testHandler->hasWarning(array('message'=>'coucou')));
	}
	
	public function testLogError()
	{
		Log::error("coucou");
        $this->assertTrue($this->testHandler->hasError(array('message'=>'coucou')));
	}
	
	public function testLogCritical()
	{
		Log::critical("coucou");
        $this->assertTrue($this->testHandler->hasCritical(array('message'=>'coucou')));
	}
    
    public function testLogApplication()
    {
        
        $_SESSION['ServiceBase']['user'] = 'trecouvr';
        $_SESSION['ServiceBase']['application'] = 'myapp';
		
        Log::warn("coucou");
        
        $records = Log::getStreamHandler()->getRecords();
        $record = end($records);
        
		$this->assertEquals('trecouvr', $record['extra']['user']);
		$this->assertEquals('myapp', $record['extra']['application']);
    }
}



