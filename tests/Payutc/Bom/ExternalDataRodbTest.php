<?php

require_once 'bootstrap.php';

use \Payutc\Bom\ExternalData;
        use \Payutc\Db\Dbal;


class ExternalDataRodbTest extends ReadOnlyDatabaseTest {
    
    
	public function getDataSet()
	{
        return $this->computeDataset(array(
            'fundations.yml',
            'users.yml',
            'externaldata.yml'
        ));
	}
    
    /**
     * @requires PHP 5.4
     */
    public function testGetUserData()
    {
        $a = ExternalData::get(1, 'key-user', 1);
        $this->assertEquals('value1', $a);
    }
    
    public function testGetFunData()
    {
        $a = ExternalData::get(1, 'key-fun');
        $this->assertEquals('value2', $a);
    }
    
    public function testGetUsrDataCastArg()
    {
        $a = ExternalData::get(1, 'key-user', "1");
        $this->assertEquals('value1', $a);
    }
    
	/**
     * Test get throw an exception when the key does not exist
     * 
	 * @expectedException           \Payutc\Exception\ExternalDataException
	 * @expectedExceptionCode       404
	 */
    public function testGetUserDataWhichDoesNotExist()
    {
        ExternalData::get(1, 'key-no-exist', 1);
    }
    
	/**
     * Test get throw an exception when the key does not exist
     * 
	 * @expectedException           \Payutc\Exception\ExternalDataException
	 * @expectedExceptionCode       404
	 */
    public function testGetFunDataWhichDoesNotExist()
    {
        ExternalData::get(1, 'key-no-exist');
    }
    
    public function testGetFunDataWithSimilarKeyThanUser()
    {
        $a = ExternalData::get(1, 'key-user');
        $this->assertEquals('value3', $a);
    }
    
}




