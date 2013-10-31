<?php

require_once 'utils.php';


class ApplicationRightRodbTest extends ReadOnlyDatabaseTest
{
    /**
     * get db dataset
     */
    public function getDataSet()
    {
        return $this->computeDataSet(array(
            'applications.yml',
            'applicationright.yml'
        ));
    }
    
    public function setUp()
    {
        parent::setUp();
        $this->ar = new ApplicationRight();
    }
    
    /**
     * Check triplet (app,service,fun)
     */
    public function testCheck()
    {
        $this->ar->check(1, "a_service", true, 1);
    }
    
    /**
     * Check triplet (app,service,fun)
     * Case: app does not have right for service on this fundation
     * 
     * @expectedException         \Payutc\Exception\CheckRightException
     * @expectedExceptionMessage L'application_id 1 n'a pas les droits an_other_service sur la fundation n°1
     */
    public function testCheckWithNoRightOnService()
    {
        $this->ar->check(1, "an_other_service", true, 1);
    }
    
    /**
     * Check triplet (app,service,fun)
     * Case: app does not have right for service on this fundation
     * 
     * @expectedException         \Payutc\Exception\CheckRightException
     * @expectedExceptionMessage L'application_id 1 n'a pas les droits a_service sur la fundation n°2
     */
    public function testCheckWithNoRightOnService2()
    {
        $this->ar->check(1, "a_service", true, 2);
    }
    
    /**
     * Check tuple (app,service)
     */
    public function testCheckOnlyApp()
    {
        $this->ar->check(1, "a_service");
    }
    
    /**
     * Check tuple (app,service)
     * Case: app does not have right on service for all fundations
     * 
     * @expectedException         \Payutc\Exception\CheckRightException
     * @expectedExceptionMessage L'application_id 1 n'a les droits an_other_service sur aucune fundation
     */
    public function testCheckOnlyAppNoRightOnService()
    {
        $this->ar->check(1, "an_other_service");
    }
    
    /**
     * Check the application can access all services
     */
    public function testCheckAppAllRights()
    {
        $this->ar->check(2);
    }
    
    /**
     * Check the application can access all services
     * Case: app does not have access to all services
     * 
     * @expectedException         \Payutc\Exception\CheckRightException
     * @expectedExceptionMessage L'application_id 1 n'a les droits  sur aucune fundation
     */
    public function testCheckAppAllRightsWithNoAllRights()
    {
        $this->ar->check(1);
    }
}

