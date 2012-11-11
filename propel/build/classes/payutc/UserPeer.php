<?php

namespace Payutc;

use Payutc\om\BaseUserPeer;


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
	public static function incrementCredit($id, $value)
	{
		$con = Propel::getConnection(AdsPeer::DATABASE_NAME);
		$query = 'UPDATE '.UserPeer::TABLE_NAME.
					' SET '.UserPeer::USR_CREDIT.' = '.UserPeer::USR_CREDIT.' + '.$value
					' WHERE '.UserPeer::USR_ID.' = '.$id;
		sfContext::getInstance()->getLogger()->crit($query);
		$stmt = $con->prepare($query);
		return $stmt->execute();
	}

	public static function decrementCredit($id, $value)
	{
		return UserPeer::incrementCredit($id, -$value);
	}
}
