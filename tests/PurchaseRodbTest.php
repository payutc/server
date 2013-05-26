<?php

require_once "bootstrap.php";

use \Payutc\Bom\Purchase;

class PurchaseRodbTest extends ReadOnlyDatabaseTest
{
	/**
	 * get db dataset
	 */
	public function getDataSet()
	{
		//return return new MyApp_DbUnit_ArrayDataSet($this->dataset);
		$seeddir = dirname(__FILE__)."/seed/";
		$ds = new PHPUnit_Extensions_Database_DataSet_YamlDataSet($seeddir."purchase.yml");
		return $ds;
	}
    
    public function testGetNbSell()
    {
        // Pour les category ça renvoit 0 pour le moment car la reucrsion n'est pas encore implémenté
        $r = Purchase::getNbSell(1, 1);
        $this->assertEquals(0,$r);
        $r = Purchase::getNbSell(2, 1);
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
    }
}


