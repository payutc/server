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
        return $this->computeDataset(array(
            'products.yml',
            'categories.yml',
            'fundations.yml'
        ));
	}
    
    public function testDecStockById()
    {
        Product::decStockById(1, 4);
        $r = Product::getOne(1, 1);
        $this->assertEquals(6, $r['stock']);
    }
    
    public function testIncStockById()
    {
        Product::incStockById(1, 4);
        $r = Product::getOne(1, 1);
        $this->assertEquals(14, $r['stock']);
    }
}



