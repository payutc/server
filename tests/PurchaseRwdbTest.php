<?php

require_once "bootstrap.php";

use \Payutc\Bom\Purchase;
use \Payutc\Bom\Product;

class PurchaseRwdbTest extends DatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        //return return new MyApp_DbUnit_ArrayDataSet($this->dataset);
        $seeddir = dirname(__FILE__)."/seed/";
        $ds = new PHPUnit_Extensions_Database_DataSet_YamlDataSet($seeddir."purchase.yml");
        return $ds;
    }
    
    public function testTransaction()
    {
		$items = array(
			array(
				'id' => 6,
				'price' => 150,
			),
			array(
				'id' => 6,
				'price' => 150,
			),
		);
		Purchase::transaction(1, $items, 51, 1, 2, "localhost");
		$u = new User("trecouvr", 1, 0, 0, 1);
		$this->assertEquals(400, $u->getCredit());
		$p = Product::getOne(6,1);
		$this->assertEquals(8, $p['stock']);
		$r = Purchase::getNbSell(6, 1);
		$this->assertEquals(2, $r);
	}

}

