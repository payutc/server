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
                 "stock" => "10",
                 "price" => "100",
                 "alcool" => "0",
                 "image" => null
            ),
            array(
                 "id" => "4",
                 "name" => "pampryl",
                 "categorie_id" => "2",
                 "fundation_id" => "1",
                 "stock" => "6",
                 "price" => "80",
                 "alcool" => "0",
                 "image" => null
            ),
        );
        $r = Product::getAll();
        usort($r, function ($a,$b) { return ($a['id'] < $b['id']) ? -1 : 1; });
        $this->assertEquals($a,$r);
        $r = Product::getAll(1);
        usort($r, function ($a,$b) { return ($a['id'] < $b['id']) ? -1 : 1; });
        $this->assertEquals($a,$r);
    }
    
    public function testGetOne()
    {
        $a = array("success"=>array(
             "id" => "3",
             "name" => "coca",
             "categorie_id" => "2",
             "fundation_id" => "1",
             "stock" => "10",
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
             "stock" => "6",
             "price" => "80",
             "alcool" => "0",
             "image" => null
        ));
        $r = Product::getOne(4,1);
        $this->assertEquals($a,$r);
    }
    
    
    public function testGetByIdsAndFunId()
    {
        $arr = array(
            array(
                'obj_id' => "3",
                'obj_name' => "coca",
                'obj_type' => "product",
                'obj_stock' => "10",
                'obj_single' => "0",
                'obj_tva' => "20",
                'obj_alcool' => "0",
                'img_id' => NULL,
                'fun_id' => "1",
                'obj_removed' => "0",
                'pri_id' => "1",
                'grp_id' => NULL,
                'per_id' => NULL,
                'pri_credit' => "100",
                'pri_removed' => "0"
            ),
            array(
                'obj_id' => "4",
                'obj_name' => "pampryl",
                'obj_type' => "product",
                'obj_stock' => "6",
                'obj_single' => "0",
                'obj_tva' => "20",
                'obj_alcool' => "0",
                'img_id' => NULL,
                'fun_id' => "1",
                'obj_removed' => "0",
                'pri_id' => "2",
                'grp_id' => NULL,
                'per_id' => NULL,
                'pri_credit' => "80",
                'pri_removed' => "0"
            )
        );
        $r = Product::getByIdsAndFunId(array(3, 4), 1);
        $this->assertEquals($arr , $r);
        // test avec un objet removed, il ne doit pas être récupéré
        $r = Product::getByIdsAndFunId(array(3, 4, 5), 1);
        $this->assertEquals($arr , $r);
        // test récupération des removed
        $arr = array(
            array(
                'obj_id' => "5",
                'obj_name' => "Barbar",
                'obj_type' => "product",
                'obj_stock' => "0",
                'obj_single' => "0",
                'obj_tva' => "20",
                'obj_alcool' => "0",
                'img_id' => NULL,
                'fun_id' => "1",
                'obj_removed' => "1",
                'pri_id' => "3",
                'grp_id' => NULL,
                'per_id' => NULL,
                'pri_credit' => "170",
                'pri_removed' => "0"
            )
        );
        // récupération de l'objet
        $r = Product::getByIdsAndFunId(array(5), 1, 1);
        $this->assertEquals($arr , $r);
        // les autres objets ne sont pas removed, on devrait donc se 
        // retrouver avec un seul objet
        $r = Product::getByIdsAndFunId(array(3,4,5), 1, 1);
        $this->assertEquals($arr , $r);
    }
    
}



