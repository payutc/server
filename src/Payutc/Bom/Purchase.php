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
	public static function getNbSell($obj_id, $fun_id, $start=null, $end=null, $tick=null) {
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

    /**
     * getRank() retourne le classement des ventes d'un objet ou d'une fundation
     * (ou des objets de la categorie) // TODO
     * de $start à $end
     * $top permet de selectionner les X premiers
     * $sort_by permet de choisir si l'on veut trier par totalPrice ou par nbBuy
     */
    public static function getRank($fun_id, $obj_id, $start, $end, $top, $sort_by) {
        $qb = Db::createQueryBuilder();
        $qb->select('sum(pur.pur_price) as totalPrice', 'count(*) as nbBuy', 'usr.usr_firstname', 'usr.usr_lastname', 'usr.usr_nickname')
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

}
