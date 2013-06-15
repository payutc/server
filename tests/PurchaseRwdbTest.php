<?php

require_once "bootstrap.php";

use \Payutc\Bom\Purchase;
use \Payutc\Bom\Product;

class PurchaseRwdbTest extends DatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataset(array(
            'products.yml',
            'users.yml',
            'fundations.yml',
            'purchase.yml'
        ));
    }
    
    public function testTransaction()
    {
        $date = date('Y-m-d H:i:s');
		$items = array(
			array(
				'id' => 4,
				'price' => 150,
			),
			array(
				'id' => 4,
				'price' => 150,
			),
		);
		Purchase::transaction(1, $items, 51, 1, 9447, "localhost");
		$u = new User("trecouvr", 1, 0, 0, 1);
		$this->assertEquals(8700, $u->getCredit());
		$p = Product::getOne(4,1);
		$this->assertEquals(21, $p['stock']);
		$r = Purchase::getNbSell(4, 1, $date);
		$this->assertEquals(2, $r);
	}

}

