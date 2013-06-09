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
		$ds = new PHPUnit_Extensions_Database_DataSet_YamlDataSet($seeddir.'items.yml');
		return $ds;
	}
    
    public function testDecStockById()
    {
        Product::decStockById(3, 4);
        $r = Product::getByIdsAndFunId(array(3,), 1);
        $this->assertEquals(1, count($r));
        $this->assertEquals(6, $r[0]['obj_stock']);
    }
    
    public function testIncStockById()
    {
        Product::incStockById(3, 4);
        $r = Product::getByIdsAndFunId(array(3,), 1);
        $this->assertEquals(1, count($r));
        $this->assertEquals(14, $r[0]['obj_stock']);
    }
}



