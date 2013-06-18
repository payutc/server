<?php


require_once "bootstrap.php";


class KeyRwdbTest extends DatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataset(array(
            'users.yml',
            'applications.yml'
        ));
    }

    /**
     * @requires PHP 5.4
     */
    public function testRegisterApplication()
    {
        $cookie = '';
        $r = httpSend('KEY', 'loginCas', $cookie, array(
            'ticket' => 'trecouvr@POSS3',
            'service' => 'KEY'
        ));
        $this->assertEquals(200, $r->code);
        $r = httpSend('KEY', 'getCurrentUserApplications', $cookie, array());
        $this->assertEquals(200, $r->code);
        $nb_apps = count($r->body);
        $apps = $r->body;
        $r = httpSend('KEY', 'registerApplication', $cookie, array(
            'app_url' => "https://localhost/",
            'app_name' => "Test app",
            'app_desc' => "App desc"
        ));
        $this->assertEquals($nb_apps + 1, count($r->body));
        $this->assertEquals(200, $r->code);
    }
}



