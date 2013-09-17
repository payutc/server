<?php

require_once 'bootstrap.php';


class UserRightRodbTest extends ReadOnlyDatabaseTest
{
	/**
	 * get db dataset
	 */
	public function getDataSet()
	{
        return $this->computeDataset(array(
            'users.yml'
        ));
	}
	
    /**
	 * @expectedException		 \Payutc\Exception\SetRightException
	 * @expectedExceptionMessage User #99942 does not exist
     */
    public function testSetRightOnNoExistingUserThrowException()
    {
        UserRight::setRight(99942, 0, 0);
    }
}

