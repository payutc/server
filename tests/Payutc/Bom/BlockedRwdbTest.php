<?php

require_once 'utils.php';

use \Payutc\Bom\Blocked;

class BlockedRwdbTest extends DatabaseTest
{

    public function getDataSet()
    {
        return $this->computeDataSet(array(
            'blocked',           
        ));
    }


    /**
	 * Test whether a user can be blocked with start and end dates
	 * 
	 * @expectedException		 \Payutc\Exception\UserIsBlockedException
	 * @expectedExceptionMessage L'utilisateur à été bloqué pour le motif suivant: A piqué dans la caisse
	 */
    public function testCreateBlo()
    {
        Blocked::block(5, 1, "A piqué dans la caisse", new \DateTime("2050-01-01 00:00:00"), new \DateTime("2000-01-01 00:00:00"));
        Blocked::checkUsrNotBlocked(5, 1);
    }

    /**
	 * Test whether a block can be edited
	 * 
	 * @expectedException		 \Payutc\Exception\UserIsBlockedException
	 * @expectedExceptionMessage L'utilisateur à été bloqué pour le motif suivant: Changement de message
	 */
    public function testEditBlo()
    {
        Blocked::edit(2, 2, "Changement de message", new \DateTime("2050-01-01 00:00:00"));
        Blocked::checkUsrNotBlocked(5, 2);
    }
}

