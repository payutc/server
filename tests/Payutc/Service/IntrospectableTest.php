<?php

require_once 'utils.php';

use \Payutc\Utils;

class IntrospectionTestClass {
    public function __construct() {

    }

    /**
     * Some documentation :
     *  Very Indentation
 Bad Formating
     */
    public function coucou($a, $b=3) {

    }

    public function noDoc() {

    }

    public static function instance() {

    }
}

class IntrospectableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @requires PHP 5.4
     */
    public function testIntrospectMethods() {
        $expected = array(array('name' => 'coucou',
                                'comment' => "Some documentation :\n Very Indentation\n Bad Formating",
                                'parameters' => array(array('name' => 'a'),
                                                      array('name' => 'b',
                                                            'default' => 3))),
                          array('name' => 'noDoc',
                                'comment' => '',
                                'parameters' => array()));
        $c = new IntrospectionTestClass();
        $this->assertEquals($expected,
                            Utils::introspectMethods($c, array('__construct')));
    }
}
