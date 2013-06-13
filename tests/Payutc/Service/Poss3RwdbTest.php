<?php

require_once "bootstrap.php";

class Poss3RwdbTest extends DatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataset(array(
            'users.yml',
            'fundations.yml',
            'applications.yml',
            'products.yml',
            'applicationright.yml',
            'fundationrights.yml',
        ));
    }

    public function testTransaction()
    {
        $u = new User("trecouvr", 1, 0, 0, 1);
        $solde = $u->getCredit();
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
            'obj_ids' => '1,1,2'
        ));
        $o = array(
            'firstname' => 'Thomas',
            'lastname' => 'Recouvreux',
            'solde' => $solde-280,
            'msg_perso' => 'http://payutc.github.io'
        );
        $this->assertEquals($o, $r->body);
        $this->assertEquals(200, $r->code);
    }
}



