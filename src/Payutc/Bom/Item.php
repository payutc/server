<?php

namespace Payutc\Bom;
use \Payutc\Db;

class Item
{
    protected static function _baseUpdateQueryById($itm_id)
    {
		$qb = Db::createQueryBuilder();
		$qb->update('t_object_obj', 'itm')
			->where('obj_id = :itm_id')
			->setParameter('itm_id', $itm_id);
		return $qb;
	}
    
    public static function incStockById($itm_id, $val)
    {
		$qb = static::_baseUpdateQueryById($itm_id);
		$qb->set('obj_stock', 'obj_stock + :val')
			->setParameter('val', $val);
		$qb->execute();
	}
	
	public static function decStockById($itm_id, $val)
    {
		$qb = static::_baseUpdateQueryById($itm_id);
		$qb->set('obj_stock', 'obj_stock - :val')
			->setParameter('val', $val);
		$qb->execute();
	}
    
    /**
     * Mettre null à removed pour avoir tous les articles
     */
    public function getByIdsAndFunId($ids, $fun_id, $removed=0)
    {
        $qb = Db::createQueryBuilder();
        $qb->select('*')
           ->from('t_object_obj', 'itm')
           ->leftjoin('itm', 't_price_pri', 'pri', 'pri.obj_id = itm.obj_id')
           ->where('itm.obj_id IN (:ids)')
           ->andWhere('itm.fun_id = :fun_id')
           ->setParameter('ids', $ids, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
           ->setParameter('fun_id', $fun_id);
        if ($removed !== null) {
            $qb->andWhere('itm.obj_removed = :removed');
            $qb->setParameter('removed', ($removed) ? 1 : 0);
        }
        return $qb->execute()->fetchall();
    }
}
