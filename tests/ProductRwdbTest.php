<?php

require_once 'bootstrap.php';

use \Payutc\Bom\Product;

class ProductRwdbTest extends DatabaseTest
{
	/**
	 * get db dataset
	 */
	public function getDataSet()
	{
		//return return new MyApp_DbUnit_ArrayDataSet($this->dataset);
		$seeddir = dirname(__FILE__).'/seed/';
		$ds = new PHPUnit_Extensions_Database_DataSet_YamlDataSet($seeddir.'products.yml');
		return $ds;
	}
    
    public function testDecStockById()
    {
        Product::decStockById(3, 4);
        $r = Product::getOne(3, 1);
        $this->assertEquals(6, $r['stock']);
    }
    
    public function testIncStockById()
    {
        Product::incStockById(3, 4);
        $r = Product::getOne(3, 1);
        $this->assertEquals(14, $r['stock']);
    }
}



