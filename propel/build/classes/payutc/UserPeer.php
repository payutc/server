<?php

namespace Payutc;

use Payutc\om\BaseUserPeer;
use \Criteria;
use \Propel;
use \PropelPDO;

/**
 * Skeleton subclass for performing query and update operations on the 'ts_user_usr' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.payutc
 */
class UserPeer extends BaseUserPeer
{
	public static function incrementCredit($selectCriteria, $value, PropelPDO $con = null)
	{
		$value = (int) $value;
		
		if ($con === null) {
		    $con = Propel::getConnection(self::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$selectCriteria->add(self::USR_CREDIT, array('raw' => self::USR_CREDIT . ' + ?', 'value' => $value), Criteria::CUSTOM_EQUAL);

		return self::doUpdate($selectCriteria,$con);
	}

	public static function decrementCredit($selectCriteria, $value, PropelPDO $conn = null)
	{
		return UserPeer::incrementCredit($selectCriteria, -$value, $conn);
	}

	public static function incrementCreditById($id, $value, PropelPDO $con = null)
	{
        $c = new Criteria(self::DATABASE_NAME);
        $c->add(self::USR_ID, $id);
        return self::incrementCredit($c, $value, $con);
	}

	public static function decrementCreditById($id, $value, PropelPDO $con = null)
	{
        return self::incrementCreditById($id, -$value, $con);
	}
}
