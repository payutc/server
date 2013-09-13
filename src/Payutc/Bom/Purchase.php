<?php

/**
 * Purchase
 * 
 * Functions related to purchase table
 * Table: t_purchase_pur
 */

namespace Payutc\Bom;

use \Payutc\Exception\NotImplemented;
use \Payutc\Db\Dbal;
use \Payutc\Bom\Item;
use \Payutc\Bom\User;

class Purchase
{
    /**
     * getNbSell() retourne le nombre de vente d'un objet 
     * (ou des objets de la categorie) // TODO
     * depuis $start jusqu'à $end
     * 
     * $tick permet de découper le resultat par tranche (pour afficher une courbe d'évolution)
     * il faut indiquer un nombre de secondes à $tick
     */
    public static function getNbSell($obj_id, $fun_id, $start=null, $end=null, $tick=null) 
    {
        $qb = Dbal::createQueryBuilder();
        $qb->select('sum(pur_qte) as nb', 'pur.pur_date')
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
    
    public static function getPurchaseById($pur_id)
    {
        $qb = Dbal::createQueryBuilder();
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
        $qb = Dbal::createQueryBuilder();
        $qb = $qb->update('t_purchase_pur', 'pur')
            ->set('pur_removed', $qb->expr()->literal(1))
            ->where('pur.pur_id = :pur_id')
            ->setParameter('pur_id', $pur_id);
        // wrap everything in a transaction
        Dbal::beginTransaction();
        try {
            // update purchase + buyer + stock, then commit
            $qb->execute();
            User::incCreditById($pur['usr_id_buyer'], $pur['pur_price']);
            Product::incStockById($pur['obj_id'], $pur['pur_qte']);
            Dbal::commit();
        }
        catch (Exception $e) {
            // rollback if failure
            Dbal::rollback();
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
            $price = $itm['price'] * $itm['qte'];
            $total_price += $price;
            $purchases[] = array(
            'pur_date' => date('Y-m-d H:i:s'),
            'pur_type' => 'product',
            'obj_id' => $itm['id'],
            'pur_qte' => $itm['qte'],
            'pur_price' => $price,
            'pur_unit_price' => $itm['price'],
            'usr_id_buyer' => $usr_id_buyer,
            'usr_id_seller' => $usr_id_seller,
            'poi_id' => $poi_id,
            'fun_id' => $fun_id,
            'pur_ip' => $pur_ip
            );
        }
        
        
        $conn = Dbal::conn();
        
        $conn->beginTransaction();
        try {
            User::decCreditById($usr_id_buyer, $total_price);
            
            foreach ($purchases as $pur) {
            $a = $conn->insert('t_purchase_pur', $pur);
            Product::decStockById($pur['obj_id'], $pur['pur_qte']);
            }
            $conn->commit();
        }
        catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
    }

    /**
     * getRank() retourne le classement des ventes d'un objet ou d'une fundation
     * (ou des objets de la categorie) // TODO
     * de $start à $end
     * $top permet de selectionner les X premiers
     * $sort_by permet de choisir si l'on veut trier par totalPrice ou par nbBuy
     */
    public static function getRank($fun_id, $obj_id, $start, $end, $top, $sort_by) {
        $qb = Dbal::createQueryBuilder();
        $qb->select('sum(pur.pur_price) as totalPrice', 'sum(pur_qte) as nbBuy', 'usr.usr_firstname', 'usr.usr_lastname', 'usr.usr_nickname')
           ->from('t_purchase_pur', 'pur')
           ->from('ts_user_usr', 'usr')
           ->where('usr.usr_id = pur.usr_id_buyer')
           ->andWhere('pur.fun_id = :fun_id')->setParameter('fun_id', $fun_id)
           ->andWhere('pur.pur_removed = 0');

        if($obj_id != null) {
           $qb->andWhere('pur.obj_id = :obj_id')
              ->setParameter('obj_id', $obj_id);
        }

        if($start != null) {
            $qb->andWhere('pur.pur_date >= :start')
               ->setParameter('start', $start);
        }

        if($end != null) {
            $qb->andWhere('pur.pur_date <= :end')
               ->setParameter('end', $end);
        }
 
        $qb->groupBy('pur.usr_id_buyer');

        if($sort_by == "totalPrice") {
            $qb->orderBy('sum(pur.pur_price)', 'DESC');
        } else {
            $qb->orderBy('count(*)', 'DESC');
        }
       
        if($top != null) {
            $qb->setFirstResult( 0 )
               ->setMaxResults( $top );
        }

        $result = array();
        $a = $qb->execute();
        while($r = $a->fetch()) { $result[] = $r; }
        return $result;
    }

    public static function getPurchasesForUser($usr_id, $time_limit=null)
    {
        $qb = Dbal::createQueryBuilder();
        $qb->select('pur_id', 'obj_id', 'pur_price', 'pur_qte', 'pur_date')
           ->from('t_purchase_pur', 'pur')
           ->Where('usr_id_buyer = :usr_id')
           ->andWhere('pur_removed = 0')
           ->setParameter('usr_id', $usr_id);
        if ($time_limit) {
            $qb->andWhere('TIME_TO_SEC(TIMEDIFF( NOW( ) , pur_date )) <= :time_limit')
               ->setParameter('time_limit', $time_limit);
        }
        return $qb->execute()->fetchAll();
    }
}
