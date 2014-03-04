<?php

require_once 'utils.php';

use \Payutc\Bom\Category;

class CategoryRodbTest extends ReadOnlyDatabaseTest
{
	/**
	 * get db dataset
	 */
	public function getDataSet()
	{
        return $this->computeDataset(array(
            'categories',
            'fundations'
        ));
	}
    
    public function testGetAll()
    {
        $a = array(
            array(
                "id" => 1000,
                "name" => "biere",
                "parent_id" => null,
                "fundation_id" => 1
            ),
            array(
                "id" => 1001,
                "name" => "soft",
                "parent_id" => null,
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
             "id" => "1000",
             "name" => "biere",
             "parent_id" => null,
             "fundation_id" => "1",
        ));
        $r = Category::getOne(1000,1);
        $this->assertEquals($a,$r);
        $a = array("success"=>array(
             "id" => "1001",
             "name" => "soft",
             "parent_id" => null,
             "fundation_id" => "1",
        ));
        $r = Category::getOne(1001,1);
        $this->assertEquals($a,$r);
    }
}


