<?php

require_once 'utils.php';

use \Payutc\Bom\Purchase;
use \Payutc\Bom\Product;
use \Payutc\Db\Dbal;
use \Payutc\Bom\User;

class PurchaseRwdbTest extends DatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataset(array(
            'products',
            'users',
            'fundations',
            'purchase'
        ));
    }
    
    /**
     * @requires PHP 5.4
     */
    public function testTransaction()
    {
        $date = date('Y-m-d H:i:s');
        $nbSells = Purchase::getNbSell(4, 1, $date);
		$items = array(
			array(
				'id' => 4,
				'qte' => 1,
				'price' => 150,
			),
			array(
				'id' => 4,
				'qte' => 3,
				'price' => 150,
			),
		);
		Purchase::transaction(1, $items, 51, 1, 9447, "localhost");
		$u = new User("trecouvr");
		$this->assertEquals(8400, $u->getCredit());
		$p = Product::getOne(4,1);
		$this->assertEquals(19, $p['stock']);
		$r = Purchase::getNbSell(4, 1, $date);
		$this->assertEquals($nbSells+4, $r);
    }

    public function testGetPurchasesForUser()
    {
        $conn = Dbal::conn();
        $nb_purchases = count(Purchase::getPurchasesForUser(1), 200);
        $conn->insert('t_transaction_tra', array(
                     'tra_id' => 43,
                     'tra_date' => date('Y-m-d H:i:s'),
                     'usr_id_buyer' => 1,
                     'usr_id_seller' => 1,
                     'app_id' => 42,
                     'fun_id' => 1,
                     'tra_ip' => ''
        ));
        $conn->insert('t_purchase_pur', array(
                     'tra_id' => 43,
                     'obj_id' => 1,
                     'pur_qte' => 1,
                     'pur_unit_price' => 70,
                     'pur_price' => 70
        ));
        $r = count(Purchase::getPurchasesForUser(1), 200);
        $this->assertEquals($nb_purchases+1, count($r));
    }
}

