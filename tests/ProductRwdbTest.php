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

    public function testAdd() {
        $a = Product::add("Chouffe", 1000, 180, 10, 1, null, 1);
        $r = Product::getOne($a["success"], 1);

        $this->assertEquals("Chouffe", $r['name']);
        $this->assertEquals(10, $r['stock']);
        $this->assertEquals(180, $r['price']);
        $this->assertEquals(1, $r['alcool']);
        $this->assertEquals(null, $r['image']);
        $this->assertEquals(1000, $r['categorie_id']);
        $this->assertEquals(1, $r['fundation_id']);
        
        $a = Product::edit($r["id"], "MC Chouffe", 1001, 170, 10, 0, null, 1);
        $r = Product::getOne($a["success"]);

        $this->assertEquals("MC Chouffe", $r['name']);
        $this->assertEquals(10, $r['stock']);
        $this->assertEquals(170, $r['price']);
        $this->assertEquals(0, $r['alcool']);
        $this->assertEquals(null, $r['image']);
        $this->assertEquals(1001, $r['categorie_id']);
        $this->assertEquals(1, $r['fundation_id']);

        $a = Product::edit($r["id"], "MC Chouffe", 1001, 170, 10, 1, null, 1);
        $r = Product::getOne($a["success"]);
        $this->assertEquals(1, $r['alcool']);

        $a = Product::delete($r["id"], 1);
        $z = Product::getOne($r["id"]);
        $this->assertEquals(null, $z);

        $r = Product::getOne($r["id"], 1, 1);
        $this->assertEquals("MC Chouffe", $r['name']);
        $this->assertEquals(10, $r['stock']);
        $this->assertEquals(170, $r['price']);
        $this->assertEquals(0, $r['alcool']);
        $this->assertEquals(null, $r['image']);
        $this->assertEquals(1001, $r['categorie_id']);
        $this->assertEquals(1, $r['fundation_id']);
    }
}



