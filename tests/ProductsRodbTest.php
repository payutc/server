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
		//return return new MyApp_DbUnit_ArrayDataSet($this->dataset);
		$seeddir = dirname(__FILE__)."/seed/";
		$ds = new PHPUnit_Extensions_Database_DataSet_YamlDataSet($seeddir."products.yml");
		return $ds;
	}
    
    public function testGetAll()
    {
        $a = array(
            array(
                 "id" => "3",
                 "name" => "coca",
                 "categorie_id" => "2",
                 "fundation_id" => "1",
                 "stock" => null,
                 "price" => "100",
                 "alcool" => "0",
                 "image" => null
            ),
            array(
                 "id" => "4",
                 "name" => "pampryl",
                 "categorie_id" => "2",
                 "fundation_id" => "1",
                 "stock" => null,
                 "price" => "80",
                 "alcool" => "0",
                 "image" => null
            )
        );
        $r = Product::getAll();
        $this->assertEquals($a,$r);
        $r = Product::getAll(1);
        $this->assertEquals($a,$r);
    }
    
    public function testGetOne()
    {
        $a = array("success"=>array(
             "id" => "3",
             "name" => "coca",
             "categorie_id" => "2",
             "fundation_id" => "1",
             "stock" => null,
             "price" => "100",
             "alcool" => "0",
             "image" => null
        ));
        $r = Product::getOne(3,1);
        $this->assertEquals($a,$r);
        $a = array("success"=>array(
             "id" => "4",
             "name" => "pampryl",
             "categorie_id" => "2",
             "fundation_id" => "1",
             "stock" => null,
             "price" => "80",
             "alcool" => "0",
             "image" => null
        ));
        $r = Product::getOne(4,1);
        $this->assertEquals($a,$r);
    }
}



