<?php

/**
 * Purchase
 * 
 * Functions related to purchase table
 * Table: t_purchase_pur
 */

namespace Payutc\Bom;

use \Payutc\Exception\NotImplemented;
use \Payutc\Db;
use \Payutc\Bom\Item;
use \User;

class Purchase
{
    /**
     * getNbSell() retourne le nombre de vente d'un objet 
     * (ou des objets de la categorie) // TODO
     * depuis $start jusqu'à $end
     * 
     * $tick permettra de découper le resultat (pour afficher une courbe d'évolution)
     * Pour l'instant son usage est non implémenté.
     */
    public static function getNbSell($obj_id, $fun_id, $start=null, $end=null, $tick=null) 
    {
        $qb = Db::createQueryBuilder();
        $qb->select('count(*) as nb', 'pur.pur_date')
           ->from('t_purchase_pur', 'pur')
           ->where('pur.obj_id = :obj_id')->setParameter('obj_id', $obj_id)
           ->andWhere('pur.fun_id = :fun_id')->setParameter('fun_id', $fun_id)
           ->andWhere('pur.pur_removed = 0');
        
        if($start != null) {
            $qb->andWhere('pur.pur_date >= :start')
               ->setParameter('start', $start);
        }

        if($end != null) {
            $qb->andWhere('pur.pur_date <= :end')
               ->setParameter('end', $end);
        }

        if($tick != null) {
            $qb->groupBy('UNIX_TIMESTAMP( pur.pur_date ) DIV :tick')
               ->setParameter('tick', $tick);
            $result = array();
            $a = $qb->execute();
            while($r = $a->fetch(3)) { $result[] = $r; }
            return $result;
        } else {
            $result = $qb->execute()->fetch();
            return $result['nb'];
        }
    }
    
    public function getPurchaseById($pur_id)
    {
	$qb = Db::createQueryBuilder();
        $qb->select('*', 'pur.pur_date')
           ->from('t_purchase_pur', 'pur')
           ->where('pur.pur_id = :pur_id')
	   ->setParameter('pur_id', $pur_id);
	return $qb->execute()->fetch();
    }
    
    public static function cancelById($pur_id)
    {
	// get the purchase
	$pur = static::getPurchaseById($pur_id);
	// create the update statement for the purchase
	$qb = Db::createQueryBuilder();
	$qb = $qb->update('t_purchase_pur', 'pur')
	    ->set('pur_removed', $qb->expr()->literal(1))
	    ->where('pur.pur_id = :pur_id')
	    ->setParameter('pur_id', $pur_id);
	// wrap everything in a transaction
	Db::beginTransaction();
	try {
	    // update purchase + buyer + stock, then commit
	    $qb->execute();
	    User::incCreditById($pur['usr_id_buyer'], $pur['pur_price']);
	    Product::incStockById($pur['obj_id'], 1);
	    Db::commit();
	}
	catch (Exception $e) {
	    // rollback if failure
	    Db::rollback();
	    throw $e;
	}
    }
    
    /**
     * @param $usr_id id du buyer
     * @param array $itm_ids array des articles à acheter
     * @param int $total_price prix total de la transaction
     */
    public static function transaction($usr_id_buyer, $items, $poi_id, $fun_id, $usr_id_seller, $pur_ip)
    {
	$total_price = 0;
	$purchases = array();
	foreach ($items as $itm) {
	    $total_price += $itm['price'];
	    $purchases[] = array(
		'pur_date' => 'NOW()',
		'pur_type' => 'product',
		'obj_id' => $itm['id'],
		'pur_price' => $itm['price'],
		'usr_id_buyer' => $usr_id_buyer,
		'usr_id_seller' => $usr_id_seller,
		'poi_id' => $poi_id,
		'fun_id' => $fun_id,
		'pur_ip' => $pur_ip
	    );
	}
	
	
	$conn = Db::conn();
	
	$conn->beginTransaction();
	try {
	    //User::decCredit($usr_id, $total_price);
	    
	    foreach ($purchases as $pur) {
		$a = $conn->insert('t_purchase_pur', $pur);
		Product::decStockById($pur['obj_id'], 1);
	    }
	    $conn->commit();
	}
	catch (Exception $e) {
	    $conn->rollback();
	    throw $e;
	}
    }
}
