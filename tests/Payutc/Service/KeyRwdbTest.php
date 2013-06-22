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
            'ticket' => 'trecouvr@KEY',
            'service' => 'KEY'
        ));
        $this->assertEquals(200, $r->code);

        $r = httpSend('KEY', 'getCurrentUserApplications', $cookie, array());
        $this->assertEquals(200, $r->code);
        $nb_apps = count($r->body);

        $r = httpSend('KEY', 'registerApplication', $cookie, array(
            'app_url' => "https://localhost/",
            'app_name' => "Test app",
            'app_desc' => "App desc"
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals("https://localhost/", $r->body['app_url']);
        $this->assertEquals("Test app", $r->body['app_name']);
        $this->assertEquals("App desc", $r->body['app_desc']);
        $this->assertEquals("trecouvr", $r->body['app_creator']);
        $id = $r->body['app_id'];
        $key = $r->body['app_key'];

        $r = httpSend('KEY', 'getCurrentUserApplications', $cookie, array());
        $this->assertEquals(200, $r->code);
        $this->assertEquals($nb_apps + 1, count($r->body));
        $app_lastuse = null;
        foreach($r->body as $app) {
            if($app['app_id'] == $id) {
                $app_lastuse = $app['app_lastuse'];
            }
        }
        $this->assertTrue($app_lastuse !== null);

        $r = httpSend('KEY', 'loginApp', $cookie, array(
            'key' => $key
        ));
        $this->assertEquals(200, $r->code);
        $this->assertEquals(true, $r->body);

        $r = httpSend('KEY', 'getCurrentUserApplications', $cookie, array());
        $this->assertEquals(200, $r->code);
        foreach($r->body as $app) {
            if($app['app_id'] == $id) {
                $this->assertTrue($app_lastuse !=  $app['app_lastuse']);
            }
        }
              
        
    }
}



