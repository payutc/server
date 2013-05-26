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
     * $tick permettra de découper le resultat (pour afficher une courbe d'évolution)
     * Pour l'instant son usage est non implémenté.
     */
	public static function getNbSell($obj_id, $fun_id, $start=null, $end=null, $tick=null) 
    {
        if($tick!=null) {
            throw new NotImplemented("tick are not implemented in getNbSell()");
        }
        $qb = Db::createQueryBuilder();
        $qb->select('count(*)')
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

        $result = $qb->execute()->fetch();
		return $result['count(*)'];
    }
}
