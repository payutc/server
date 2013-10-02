<?php

namespace Payutc\Db\Dbal;


class QueryBuilder extends \Doctrine\DBAL\Query\QueryBuilder
{
    protected $for_update = false;
    protected $type = null;
    
    public function getSQL()
    {
        $sql = parent::getSQL();
        if ($this->type == self::SELECT) {
            if ($this->for_update) {
                $sql .= ' FOR UPDATE';
            }
        }
        return $sql;
    }
    
    public function forUpdate($v = true)
    {
        $this->for_update = $v;
        return $this;
    }
}
