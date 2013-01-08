<?php

namespace Payutc;

use Payutc\om\BaseItemPeer;
use \Criteria;
use \Propel;
use \PropelPDO;

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
	public static function incrementStock($selectCriteria, $value, PropelPDO $con = null)
	{
		$value = (int) $value;
		
		if ($con === null) {
		    $con = Propel::getConnection(self::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria->add(self::OBJ_STOCK, array('raw' => self::OBJ_STOCK . ' + ?', 'value' => $value), Criteria::CUSTOM_EQUAL);
		
		return self::doUpdate($selectCriteria,$con);
	}

	public static function decrementStock($selectCriteria, $value, PropelPDO $conn = null)
	{
		return self::incrementStock($selectCriteria, -$value, $conn);
	}

	public static function incrementStockById($id, $value, PropelPDO $con = null)
	{
        $c = new Criteria(self::DATABASE_NAME);
        $c->add(self::OBJ_ID, $id);
        return self::incrementStock($c, $value, $con);
	}

	public static function decrementStockById($id, $value, PropelPDO $con = null)
	{
        return self::incrementStockById($id, -$value, $con);
	}
}
