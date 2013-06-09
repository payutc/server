<?php

require_once 'bootstrap.php';

use \Payutc\Bom\Item;

class ItemRodbTest extends ReadOnlyDatabaseTest
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
    
    public function testGetByIdsAndFunId()
    {
        $arr = array(
            array(
                'obj_id' => "3",
                'obj_name' => "coca",
                'obj_type' => "product",
                'obj_stock' => "10",
                'obj_single' => "0",
                'obj_tva' => "0",
                'obj_alcool' => "0",
                'img_id' => NULL,
                'fun_id' => "1",
                'obj_removed' => "0",
                'pri_id' => "1",
                'grp_id' => NULL,
                'per_id' => NULL,
                'pri_credit' => "70",
                'pri_removed' => "0"
            ),
            array(
                'obj_id' => "4",
                'obj_name' => "pampryl",
                'obj_type' => "product",
                'obj_stock' => "6",
                'obj_single' => "0",
                'obj_tva' => "0",
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
        $r = Item::getByIdsAndFunId(array(3, 4), 1);
        $this->assertEquals($arr , $r);
        // test avec un objet removed, il ne doit pas être récupéré
        $r = Item::getByIdsAndFunId(array(3, 4, 6), 1);
        $this->assertEquals($arr , $r);
        // test récupération des removed
        $arr = array(
            array(
                'obj_id' => "6",
                'obj_name' => "Barbar",
                'obj_type' => "product",
                'obj_stock' => "0",
                'obj_single' => "0",
                'obj_tva' => "0",
                'obj_alcool' => "0",
                'img_id' => NULL,
                'fun_id' => "1",
                'obj_removed' => "1",
                'pri_id' => "4",
                'grp_id' => NULL,
                'per_id' => NULL,
                'pri_credit' => "150",
                'pri_removed' => "0"
            )
        );
        // récupération de l'objet
        $r = Item::getByIdsAndFunId(array(6), 1, 1);
        $this->assertEquals($arr , $r);
        // les autres objets ne sont pas removed, on devrait donc se 
        // retrouver avec un seul objet
        $r = Item::getByIdsAndFunId(array(3,4,6), 1, 1);
        $this->assertEquals($arr , $r);
    }
}


