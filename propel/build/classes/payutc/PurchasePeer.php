<?php

namespace Payutc;

use Payutc\om\BasePurchasePeer;
use Payutc\User;
use Payutc\UserPeer;
use Payutc\UserQuery;
use Payutc\ItemPeer;
use Payutc\ItemQuery;
use Payutc\Purchase;
use Payutc\Point;
use Payutc\PointQuery;
use Payutc\Fundation;
use Payutc\FundationQuery;

use \Datetime;
use \Propel;
use \PropelPDO;

/**
 * Skeleton subclass for performing query and update operations on the 't_purchase_pur' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.payutc
 */
class PurchasePeer extends BasePurchasePeer
{
	public static function cancel_transaction($purchase) {
		$con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		try {
			$purchase->setRemoved(1);
			$purchase->save();
			UserPeer::incrementCreditById($purchase->getUsrIdBuyer(), $purchase->getPrice());
			ItemPeer::incrementStockById($purchase->getItemId(), 1);
			$con->commit();
		}
		catch (Exception $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Effectue des achats
	 * @param $buyer id ou User
	 * @param $seller id ou User
	 * @param $poi id ou Point
	 * @param $fun id ou Fundation
	 * @param ip string
	 * @param items array d'Item
	 *
	 * @raise Exception si la transaction échoue
	 */
	public static function make_transaction($buyer,$seller,$poi,$fun,$ip,$items) {
		if (!($buyer instanceof User)) $buyer = UserQuery::create()->findPk($buyer);
		if (!($seller instanceof User)) $seller = UserQuery::create()->findPk($seller);
		if (!($poi instanceof Point)) $poi = PointQuery::create()->findPk($poi);
		if (!($fun instanceof Fundation)) $fun = FundationQuery::create()->findPk($fun);
		$now = new Datetime();
		$con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		$con->beginTransaction();
		try {
			foreach($items as $item) {
				$pur = new Purchase();
				$pur->setDate($now)
					->setType('product')
					->setItem($item)
					->setPrice($item->getPrice())
					->setBuyer($buyer)
					->setSeller($seller)
					->setPoi($poi)
					->setFundation($fun)
					->setIp($ip);
				$pur->save();
				ItemPeer::decrementStockById($item->getId(), 1);
				UserPeer::decrementCreditById($buyer->getId(), $item->getPrice());
			}
			$con->commit();
		}
		catch (Exception $ex) {
			$con->rollback();
			throw $ex;
		}
	}
}
