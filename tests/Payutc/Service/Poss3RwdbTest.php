<?php

require_once 'utils.php';

use \Payutc\Bom\User;

class Poss3RwdbTest extends DatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataset(array(
            'users',
            'fundations',
            'applications',
            'products',
            'applicationright',
            'fundationrights',
            'purchase'
        ));
    }

    /**
     * @requires PHP 5.4
     */
    public function testTransaction()
    {
        $u = new User("trecouvr");
        $solde = $u->getCredit();
        $nb_purchase = count($u->getLastPurchases());
        $cookie = '';
        $r = httpSend('POSS3', 'loginCas', $cookie, array(
            'ticket' => 'trecouvr@POSS3',
            'service' => 'POSS3'
        ));
        $this->assertEquals(200, $r->code);
        $r = httpSend('POSS3', 'loginApp', $cookie, array(
            'key' => 'my_app'
        ));
        $this->assertEquals(200, $r->code);
        $r = httpSend('POSS3', 'transaction', $cookie, array(
            'fun_id' => 1,
            'badge_id' => 'ABCDABCD',
            'obj_ids' => '1 1 2'
        ));
        $o = array(
            'firstname' => 'Thomas',
            'lastname' => 'Recouvreux',
            'solde' => $solde-280,
            'msg_perso' => 'http://payutc.github.io'
        );
        $this->assertEquals($o, $r->body);
        $this->assertEquals(200, $r->code);
        $u = new User("trecouvr");
        $this->assertEquals($solde-280, $u->getCredit());
        $purchases = $u->getLastPurchases();
        sort_by_key($purchases, 'pur_id');
        $this->assertEquals($nb_purchase+3, count($purchases));
        $purchases = array_slice($purchases, count($purchases)-3);
        $this->assertEquals(1, $purchases[0]['obj_id']);
        $this->assertEquals(1, $purchases[1]['obj_id']);
        $this->assertEquals(2, $purchases[2]['obj_id']);
        $this->assertEquals(100, $purchases[0]['pur_price']);
        $this->assertEquals(100, $purchases[1]['pur_price']);
        $this->assertEquals(80, $purchases[2]['pur_price']);
    }

    /**
     * @requires PHP 5.4
     */
    public function testTransactionWithQuanityAndReductions()
    {
        $u = new User("trecouvr");
        $solde = $u->getCredit();
        $nb_purchase = count($u->getLastPurchases());
        $cookie = '';
        $r = httpSend('POSS3', 'loginCas', $cookie, array(
            'ticket' => 'trecouvr@POSS3',
            'service' => 'POSS3'
        ));
        $this->assertEquals(200, $r->code);
        $r = httpSend('POSS3', 'loginApp', $cookie, array(
                                                          'key' => 'my_app'
                                                          ));
        $this->assertEquals(200, $r->code);

        $objects = array(array(1, 1, null), // pas de réduction
                         array(2, 2), // réduction non précisée
                         array(1, 2, 0.1), // 10% de reduction
                         );
        // soit un prix de 1€ + 1,6€ + 2€ * (1-0,1) = 4,4€

        $r = httpSend('POSS3', 'transaction', $cookie, array(
            'fun_id' => 1,
            'badge_id' => 'ABCDABCD',
            'obj_ids' => json_encode($objects)
            ));
        $o = array(
                   'firstname' => 'Thomas',
                   'lastname' => 'Recouvreux',
                   'solde' => $solde-280,
                   'msg_perso' => 'http://payutc.github.io'
                   );
        $this->assertEquals($o, $r->body);
        $this->assertEquals(200, $r->code);
        $u = new User("trecouvr");
        $this->assertEquals($solde-538, $u->getCredit());
        $purchases = $u->getLastPurchases();
        sort_by_key($purchases, 'pur_id');
        $this->assertEquals($nb_purchase+3, count($purchases));
        $purchases = array_slice($purchases, count($purchases)-3);
        // obj ids
        $this->assertEquals(1, $purchases[0]['obj_id']);
        $this->assertEquals(2, $purchases[1]['obj_id']);
        $this->assertEquals(1, $purchases[2]['obj_id']);
        // unit price
        $this->assertEquals(100, $purchases[0]['pur_unit_price']);
        $this->assertEquals(80, $purchases[1]['pur_unit_price']);
        $this->assertEquals(100, $purchases[2]['pur_unit_price']);
        // reduction
        $this->assertEquals(null, $purchases[0]['pur_reduction']);
        $this->assertEquals(null, $purchases[1]['pur_reduction']);
        $this->assertEquals(0.1, $purchases[2]['pur_reduction']);
        // total price
        $this->assertEquals(100, $purchases[0]['pur_price']);
        $this->assertEquals(160, $purchases[1]['pur_price']);
        $this->assertEquals(180, $purchases[2]['pur_price']);
    }

    /**
     * @requires PHP 5.4
     */
    public function testCancel()
    {
        $u = new User("trecouvr");
        $solde = $u->getCredit();
        $nb_purchase = count($u->getLastPurchases());
        $cookie = '';
        $r = httpSend('POSS3', 'loginCas', $cookie, array(
            'ticket' => 'trecouvr@POSS3',
            'service' => 'POSS3'
        ));
        $this->assertEquals(200, $r->code);
        $r = httpSend('POSS3', 'loginApp', $cookie, array(
            'key' => 'my_app'
        ));
        $this->assertEquals(200, $r->code);
        $r = httpSend('POSS3', 'cancel', $cookie, array(
            'fun_id' => 1,
            'pur_id' => 1,
        ));
        $this->assertEquals(true, $r->body);
        $this->assertEquals(200, $r->code);
    }
}



