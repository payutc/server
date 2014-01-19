<?php

require_once 'utils.php';

use \Payutc\Config;
use \IntrospectableBase;

class IntrospectionTestClass extends \IntrospectableBase {
    public function __construct() {

    }

    public function __wakeup() {

    }

    /**
     * Some documentation :
     *  Very Indentation
 Bad Formating
     */
    public function coucou($a, $b=3) {

    }

    public static function instance() {

    }
}

class IntrospectableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @requires PHP 5.4
     */
    public function testGetmethods() {
        $expected = array(array('name' => 'coucou',
                                'comment' => "Some documentation :\n Very Indentation\n Bad Formating",
                                'parameters' => array(array('name' => 'a'),
                                                      array('name' => 'b',
                                                            'default' => 3))),
                          array('name' => 'getMethods',
                                'comment' => 'Renvoie la liste des méthodes utilisables sur ce service',
                                'parameters' => array()));
        $c = new IntrospectionTestClass();
        $this->assertEquals($expected, $c->getMethods());
    }
}
