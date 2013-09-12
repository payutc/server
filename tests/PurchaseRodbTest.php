<?php

require_once "bootstrap.php";

use \Payutc\Bom\Purchase;

class PurchaseRodbTest extends ReadOnlyDatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet() {
        return $this->computeDataset(array(
            'products.yml',
            'users.yml',
            'fundations.yml',
            'purchase.yml'
        ));
    }
    
    public function testGetNbSell() {
        // Pour les category ça renvoit 0 pour le moment car la reucrsion n'est pas encore implémenté
        $r = Purchase::getNbSell(1, 1);
        $this->assertEquals(0,$r);
        $r = Purchase::getNbSell(9447, 1);
        $this->assertEquals(0,$r);

        // Pour les articles
        // Le premier test verifie qu'on ignore bien les lignes removed = 1
        $r = Purchase::getNbSell(3, 1);
        $this->assertEquals(1,$r);
        // Un test simple
        $r = Purchase::getNbSell(4, 1);
        $this->assertEquals(8,$r);
        // tests avec une date de debut
        $r = Purchase::getNbSell(4, 1, "NOW()");
        $this->assertEquals(0,$r);

        $r = Purchase::getNbSell(4, 1, "2013-04-08 18:30:00");
        $this->assertEquals(4,$r);

        // Un test avec une date de debut et une date de fin
        $r = Purchase::getNbSell(4, 1, "2013-04-08 18:30:00", "2013-04-08 18:40:00");
        $this->assertEquals(1,$r); 
        // Un test avec seulement une date de fin (risque de n'être jamais utilisé, mais bon on test)
        $r = Purchase::getNbSell(4, 1, null, "2013-04-07 22:30:00");
        $this->assertEquals(3,$r); 

        // Un test avec les ticks (tick de 2h)
        $r = Purchase::getNbSell(4, 1, null, null, 7200);
        $this->assertEquals(5,count($r));
    }

    public function testGetRank() {
        $r = Purchase::GetRank(1, null, "2012-04-08 18:30:00", "2014-04-08 18:40:00", 1, "totalPrice");
        $waited = array(array(
            "totalPrice" => "630",
            "nbBuy" => "9",
            "usr_firstname" => "Matthieu",
            "usr_lastname" => "Guffroy",
            "usr_nickname" => "mguffroy"
            ));
        $this->assertEquals($waited,$r);

        $r = Purchase::GetRank(1, 3, "2012-04-08 18:30:00", "2014-04-08 18:40:00", 1, "totalPrice");
        $waited = array(array(
            "totalPrice" => "70",
            "nbBuy" => "1",
            "usr_firstname" => "Matthieu",
            "usr_lastname" => "Guffroy",
            "usr_nickname" => "mguffroy"
            ));
        $this->assertEquals($waited,$r);

    }
    
    public function testGetPurchasesForUser() {
        $purchases = Purchase::getPurchasesForUser(9447);
        $this->assertTrue(count($purchases) > 0);
        $pur = $purchases[0];
        $this->assertArrayHasKey('pur_id', $pur);
        $this->assertArrayHasKey('obj_id', $pur);
        $this->assertArrayHasKey('pur_price', $pur);
        $this->assertArrayHasKey('pur_qte', $pur);
        $this->assertArrayHasKey('pur_date', $pur);
    }
}


