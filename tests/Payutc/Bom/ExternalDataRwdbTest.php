<?php


require_once 'bootstrap.php';

use \Payutc\Bom\ExternalData;
use \Payutc\Db\Dbal;

class ExternalDataRwdbTest extends ReadOnlyDatabaseTest {
    
    
	public function getDataSet()
	{
        return $this->computeDataset(array(
            'fundations.yml',
            'users.yml',
            'externaldata.yml'
        ));
	}
    
    
    public function testSetUsrData()
    {
        $a = ExternalData::get(1, 'key-user', 1);
        ExternalData::set(1, 'key-user', $a.'-newvalue', 1);
        $b = ExternalData::get(1, 'key-user', 1);
        $this->assertEquals($a.'-newvalue', $b);
    }
    
    public function testSetFunData()
    {
        $orig_user = ExternalData::get(1, 'key-user', 1);
        $orig_fun = ExternalData::get(1, 'key-user', 1);
        $a = ExternalData::get(1, 'key-fun');
        ExternalData::set(1, 'key-fun', $a.'-newvalue');
        $b = ExternalData::get(1, 'key-fun');
        $this->assertEquals($a.'-newvalue', $b);
        
        // check that this does not affect the others
        $this->assertEquals($orig_user, ExternalData::get(1, 'key-user', 1));
        $this->assertEquals($orig_fun, ExternalData::get(1, 'key-user', 1));
    }
    
    public function testSetFunData2()
    {
        $orig_user = ExternalData::get(1, 'key-user', 1);
        $orig_fun = ExternalData::get(1, 'key-user', 1);
        $a = ExternalData::get(1, 'key-user');
        ExternalData::set(1, 'key-user', $a.'-newvalue');
        $b = ExternalData::get(1, 'key-user');
        $this->assertEquals($a.'-newvalue', $b);
        // check that this does not affect the others
        $this->assertEquals($orig_user, ExternalData::get(1, 'key-user', 1));
        $this->assertEquals($orig_fun, ExternalData::get(1, 'key-user', 1));
    }
    
    public function testSetUsrDataInsert()
    {
        ExternalData::set(1, 'key-user-2', 'myvalue', 1);
        $a = ExternalData::get(1, 'key-user-2', 1);
        $this->assertEquals('myvalue', $a);
    }
    
    public function testSetFunDataInsert()
    {
        ExternalData::set(1, 'key-fun-2', 'myvalue-fun');
        $a = ExternalData::get(1, 'key-fun-2');
        $this->assertEquals('myvalue-fun', $a);
    }
    
	/**
     * Test set throw an exception when the key is invalide
     * 
	 * @expectedException           \Payutc\Exception\ExternalDataException
	 * @expectedExceptionCode       442
	 */
    public function testSetDataOnInvalidKey()
    {
        ExternalData::set(1, 'key fun 2', 'myvalue-fun');
    }
    
	/**
     * Test set throw an exception when the key is invalide
     * 
	 * @expectedException           \Payutc\Exception\ExternalDataException
	 * @expectedExceptionCode       442
	 */
    public function testSetDataOnInvalidKey2()
    {
        ExternalData::set(1, 'key\'', 'myvalue-fun');
    }
    
	/**
     * Test get throw an exception when the key is invalide
     * 
	 * @expectedException           \Payutc\Exception\ExternalDataException
	 * @expectedExceptionCode       442
	 */
    public function testGetDataOnInvalidKey()
    {
        ExternalData::get(1, 'key fun 2');
    }
    
	/**
     * Test get throw an exception when the key is invalide
     * 
	 * @expectedException           \Payutc\Exception\ExternalDataException
	 * @expectedExceptionCode       442
	 */
    public function testGetDataOnInvalidKey2()
    {
        ExternalData::get(1, 'key\'');
    }
    
    /**
     * Test delete
     */
    public function testDelUsrData()
    {
        // create new data
        ExternalData::set(1, 'key-usr-to-delete', 'blabla', 1);
        
        // count rows
        $qb = Dbal::createQueryBuilder();
        $qb->select('count(*) as c')
            ->from('t_external_data_exd', 'exd')
            ->where('exd_removed is NULL');
        $c = $qb->execute()->fetch()['c'];
        
        // delete
        ExternalData::del(1, 'key-usr-to-delete', 1);
        
        // count rows
        $qb = Dbal::createQueryBuilder();
        $qb->select('count(*) as c')
            ->from('t_external_data_exd', 'exd')
            ->where('exd_removed is NULL');
        $c2 = $qb->execute()->fetch()['c'];
        
        $this->assertEquals($c - 1, $c2);
     }
    
    /**
     * Test delete
     */
    public function testDelFunData()
    {
        // create new data
        ExternalData::set(1, 'key-fun-to-delete', 'blabla');
        
        // count rows
        $qb = Dbal::createQueryBuilder();
        $qb->select('count(*) as c')
            ->from('t_external_data_exd', 'exd')
            ->where('exd_removed is NULL');
        $res = $qb->execute()->fetch();
        $c = $res['c'];
        
        // delete
        ExternalData::del(1, 'key-fun-to-delete');
        
        // count rows
        $qb = Dbal::createQueryBuilder();
        $qb->select('count(*) as c')
            ->from('t_external_data_exd', 'exd')
            ->where('exd_removed is NULL');
        $res = $qb->execute()->fetch();
        $c2 = $res['c'];
        
        $this->assertEquals($c - 1, $c2);
     }
}

