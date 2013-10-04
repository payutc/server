<?php

namespace Payutc\Db\Dbal;


class Connection extends \Doctrine\DBAL\Connection
{
    public function createQueryBuilder()
    {
        return new QueryBuilder($this);
    }
}

