<?php

require_once "bootstrap.php";

use \Payutc\Bom\Product;

class ProductRodbTest extends ReadOnlyDatabaseTest
{
	/**
	 * get db dataset
	 */
	public function getDataSet()
	{
        return $this->computeDataset(array(
            'products.yml',
            'categories.yml',
            'fundations.yml',
        ));
	}
    
    public function testGetAll()
    {
        $a = array(
            array(
                 "id" => "1",
                 "name" => "Coca",
                 "categorie_id" => "1000",
                 "fundation_id" => "1",
                 "stock" => "10",
                 "price" => "100",
                 "alcool" => "0",
                 "image" => null
            ),
            array(
                 "id" => "2",
                 "name" => "Pampryl",
                 "categorie_id" => "1000",
                 "fundation_id" => "1",
                 "stock" => "6",
                 "price" => "80",
                 "alcool" => "0",
                 "image" => null
            ),
            array(
                 "id" => "3",
                 "name" => "Chimay",
                 "categorie_id" => "1001",
                 "fundation_id" => "1",
                 "stock" => "0",
                 "price" => "170",
                 "alcool" => "0",
                 "image" => null
            ),
            array(
                 "id" => "4",
                 "name" => "Barbar",
                 "categorie_id" => "1001",
                 "fundation_id" => "1",
                 "stock" => "0",
                 "price" => null,
                 "alcool" => "0",
                 "image" => null
            ),
        );
        $r = Product::getAll();
        sort_by_key($r, 'id');
        $this->assertEquals($a,$r);
        $r = Product::getAll(array('fun_ids'=>array(1,)));
        sort_by_key($r, 'id');
        $this->assertEquals($a,$r);
    }
    
    public function testGetOne()
    {
        $a = array(
             "id" => "1",
             "name" => "Coca",
             "categorie_id" => "1000",
             "fundation_id" => "1",
             "stock" => "10",
             "price" => "100",
             "alcool" => "0",
             "image" => null
        );
        $r = Product::getOne(1,1);
        $this->assertEquals($a,$r);
        $a = array(
             "id" => "2",
             "name" => "Pampryl",
             "categorie_id" => "1000",
             "fundation_id" => "1",
             "stock" => "6",
             "price" => "80",
             "alcool" => "0",
             "image" => null
        );
        $r = Product::getOne(2,1);
        $this->assertEquals($a,$r);
    }
    
    
}



