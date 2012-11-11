<?php

namespace Payutc;

use Payutc\om\BaseItemPeer;


/**
 * Skeleton subclass for performing query and update operations on the 't_object_obj' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.payutc
 */
class ItemPeer extends BaseItemPeer
{
	public static function incrementStock($id, $value)
	{
		$con = Propel::getConnection(AdsPeer::DATABASE_NAME);
		$query = 'UPDATE '.ItemPeer::TABLE_NAME.
					' SET '.ItemPeer::OBJ_STOCK.' = '.ItemPeer::OBJ_STOCK.' + '.$value
					' WHERE '.ItemPeer::OBJ_ID.' = '.$id;
		sfContext::getInstance()->getLogger()->crit($query);
		$stmt = $con->prepare($query);
		return $stmt->execute();
	}

	public static function decrementStock($id, $value)
	{
		return UserPeer::incrementCredit($id, -$value);
	}
}
