<?php

require_once "bootstrap.php";

use \Payutc\Bom\Category;

class CategoryRodbTest extends ReadOnlyDatabaseTest
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
                "id" => 1,
                "name" => "picasso",
                "parent_id" => null,
                "fundation_id" => 1
            ),
            array(
                "id" => 2,
                "name" => "soft",
                "parent_id" => 1,
                "fundation_id" => 1
            )
        );
        $r = Category::getAll();
        $this->assertEquals($a,$r);
        $r = Category::getAll(1);
        $this->assertEquals($a,$r);
    }
    
    public function testGetOne()
    {
        $a = array("success"=>array(
             "id" => "1",
             "name" => "picasso",
             "parent_id" => null,
             "fundation_id" => "1",
        ));
        $r = Category::getOne(1,1);
        $this->assertEquals($a,$r);
        $a = array("success"=>array(
             "id" => "2",
             "name" => "soft",
             "parent_id" => "1",
             "fundation_id" => "1",
        ));
        $r = Category::getOne(2,1);
        $this->assertEquals($a,$r);
    }
}


