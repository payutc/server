<?php


require_once 'utils.php';


use \Payutc\Cas;
use \Payutc\Log;
use \Payutc\Config;

class CasTest extends PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        include 'config-test.inc.php';
        Config::initFromArray($_CONFIG);
        Log::init();
    }
    
    public function testConstruct()
    {
        $cas = new Cas("http://cas.coucou.fr/");
    }
    
    public function setUp()
    {
        libxml_use_internal_errors(true);
    }
    
    public function tearDown()
    {
        libxml_use_internal_errors(false);
    }
    
    /**
     * @requires PHP 5.4
     */
    public function testAuthenticateSuccess()
    {
        $cas = new Cas(Config::get('cas_url'));
        $user = $cas->authenticate('trecouvr@coucou', 'coucou');
        $this->assertEquals('trecouvr', $user);
    }
    
    /**
     * Test cas can handle special chars like &, #
     * @requires PHP 5.4
     */
    public function testAuthenticateSuccessWithSpecialChar()
    {
        $cas = new Cas(Config::get('cas_url'));
        $user = $cas->authenticate('trecouvr@couc#u&', 'couc#u&');
        $this->assertEquals('trecouvr', $user);
    }
    
    /**
     * @requires PHP 5.4
     * @expectedException \Payutc\Exception\AuthenticationFailure
     */
    public function testAuthenticationFailure()
    {
        $cas = new Cas(Config::get('cas_url'));
        $cas->authenticate('trecouvr@coou', 'coucou');
    }
    
    /**
     * @expectedException \Httpful\Exception\ConnectionErrorException
     */
    public function testNetworkFailure()
    {
        $cas = new Cas('http://12345cas.coucou.fr/', 1);
        $cas->authenticate('trecouvr@coucou', 'coucou');
    }
    
    /**
     * @expectedException \Httpful\Exception\ConnectionErrorException
     */
    public function testNetworkFailure2()
    {
        $cas = new Cas('http://localhost:60904/', 1);
        $cas->authenticate('trecouvr@coucou', 'coucou');
    }
    
    /**
     * @requires PHP 5.4
     * @expectedException \UnexpectedValueException
     */
    public function testNoXmlResponse()
    {
        $cas = new Cas('http://google.fr/');
        $cas->authenticate('trecouvr@coucou', 'coucou');
    }
}

