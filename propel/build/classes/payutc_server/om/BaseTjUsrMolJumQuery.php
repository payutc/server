<?php


/**
 * Base class that represents a query for the 'tj_usr_mol_jum' table.
 *
 *
 *
 * @method TjUsrMolJumQuery orderByUsrId($order = Criteria::ASC) Order by the usr_id column
 * @method TjUsrMolJumQuery orderByMolId($order = Criteria::ASC) Order by the mol_id column
 * @method TjUsrMolJumQuery orderByData($order = Criteria::ASC) Order by the jum_data column
 *
 * @method TjUsrMolJumQuery groupByUsrId() Group by the usr_id column
 * @method TjUsrMolJumQuery groupByMolId() Group by the mol_id column
 * @method TjUsrMolJumQuery groupByData() Group by the jum_data column
 *
 * @method TjUsrMolJumQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TjUsrMolJumQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TjUsrMolJumQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TjUsrMolJumQuery leftJoinTsUserUsr($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsUserUsr relation
 * @method TjUsrMolJumQuery rightJoinTsUserUsr($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsUserUsr relation
 * @method TjUsrMolJumQuery innerJoinTsUserUsr($relationAlias = null) Adds a INNER JOIN clause to the query using the TsUserUsr relation
 *
 * @method TjUsrMolJumQuery leftJoinTsMeanOfLoginMol($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsMeanOfLoginMol relation
 * @method TjUsrMolJumQuery rightJoinTsMeanOfLoginMol($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsMeanOfLoginMol relation
 * @method TjUsrMolJumQuery innerJoinTsMeanOfLoginMol($relationAlias = null) Adds a INNER JOIN clause to the query using the TsMeanOfLoginMol relation
 *
 * @method TjUsrMolJum findOne(PropelPDO $con = null) Return the first TjUsrMolJum matching the query
 * @method TjUsrMolJum findOneOrCreate(PropelPDO $con = null) Return the first TjUsrMolJum matching the query, or a new TjUsrMolJum object populated from the query conditions when no match is found
 *
 * @method TjUsrMolJum findOneByUsrId(int $usr_id) Return the first TjUsrMolJum filtered by the usr_id column
 * @method TjUsrMolJum findOneByMolId(int $mol_id) Return the first TjUsrMolJum filtered by the mol_id column
 * @method TjUsrMolJum findOneByData(string $jum_data) Return the first TjUsrMolJum filtered by the jum_data column
 *
 * @method array findByUsrId(int $usr_id) Return TjUsrMolJum objects filtered by the usr_id column
 * @method array findByMolId(int $mol_id) Return TjUsrMolJum objects filtered by the mol_id column
 * @method array findByData(string $jum_data) Return TjUsrMolJum objects filtered by the jum_data column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTjUsrMolJumQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTjUsrMolJumQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TjUsrMolJum', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TjUsrMolJumQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TjUsrMolJumQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TjUsrMolJumQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TjUsrMolJumQuery) {
            return $criteria;
        }
        $query = new TjUsrMolJumQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$usr_id, $mol_id, $jum_data]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   TjUsrMolJum|TjUsrMolJum[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TjUsrMolJumPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TjUsrMolJumPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   TjUsrMolJum A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `USR_ID`, `MOL_ID`, `JUM_DATA` FROM `tj_usr_mol_jum` WHERE `USR_ID` = :p0 AND `MOL_ID` = :p1 AND `JUM_DATA` = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new TjUsrMolJum();
            $obj->hydrate($row);
            TjUsrMolJumPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2])));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return TjUsrMolJum|TjUsrMolJum[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|TjUsrMolJum[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return TjUsrMolJumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TjUsrMolJumPeer::USR_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TjUsrMolJumPeer::MOL_ID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(TjUsrMolJumPeer::JUM_DATA, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TjUsrMolJumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TjUsrMolJumPeer::USR_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TjUsrMolJumPeer::MOL_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(TjUsrMolJumPeer::JUM_DATA, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the usr_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrId(1234); // WHERE usr_id = 1234
     * $query->filterByUsrId(array(12, 34)); // WHERE usr_id IN (12, 34)
     * $query->filterByUsrId(array('min' => 12)); // WHERE usr_id > 12
     * </code>
     *
     * @see       filterByTsUserUsr()
     *
     * @param     mixed $usrId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrMolJumQuery The current query, for fluid interface
     */
    public function filterByUsrId($usrId = null, $comparison = null)
    {
        if (is_array($usrId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TjUsrMolJumPeer::USR_ID, $usrId, $comparison);
    }

    /**
     * Filter the query on the mol_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMolId(1234); // WHERE mol_id = 1234
     * $query->filterByMolId(array(12, 34)); // WHERE mol_id IN (12, 34)
     * $query->filterByMolId(array('min' => 12)); // WHERE mol_id > 12
     * </code>
     *
     * @see       filterByTsMeanOfLoginMol()
     *
     * @param     mixed $molId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrMolJumQuery The current query, for fluid interface
     */
    public function filterByMolId($molId = null, $comparison = null)
    {
        if (is_array($molId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TjUsrMolJumPeer::MOL_ID, $molId, $comparison);
    }

    /**
     * Filter the query on the jum_data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('fooValue');   // WHERE jum_data = 'fooValue'
     * $query->filterByData('%fooValue%'); // WHERE jum_data LIKE '%fooValue%'
     * </code>
     *
     * @param     string $data The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrMolJumQuery The current query, for fluid interface
     */
    public function filterByData($data = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($data)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $data)) {
                $data = str_replace('*', '%', $data);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TjUsrMolJumPeer::JUM_DATA, $data, $comparison);
    }

    /**
     * Filter the query by a related TsUserUsr object
     *
     * @param   TsUserUsr|PropelObjectCollection $tsUserUsr The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjUsrMolJumQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsUserUsr($tsUserUsr, $comparison = null)
    {
        if ($tsUserUsr instanceof TsUserUsr) {
            return $this
                ->addUsingAlias(TjUsrMolJumPeer::USR_ID, $tsUserUsr->getId(), $comparison);
        } elseif ($tsUserUsr instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjUsrMolJumPeer::USR_ID, $tsUserUsr->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTsUserUsr() only accepts arguments of type TsUserUsr or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TsUserUsr relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TjUsrMolJumQuery The current query, for fluid interface
     */
    public function joinTsUserUsr($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TsUserUsr');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TsUserUsr');
        }

        return $this;
    }

    /**
     * Use the TsUserUsr relation TsUserUsr object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TsUserUsrQuery A secondary query class using the current class as primary query
     */
    public function useTsUserUsrQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTsUserUsr($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TsUserUsr', 'TsUserUsrQuery');
    }

    /**
     * Filter the query by a related TsMeanOfLoginMol object
     *
     * @param   TsMeanOfLoginMol|PropelObjectCollection $tsMeanOfLoginMol The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjUsrMolJumQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsMeanOfLoginMol($tsMeanOfLoginMol, $comparison = null)
    {
        if ($tsMeanOfLoginMol instanceof TsMeanOfLoginMol) {
            return $this
                ->addUsingAlias(TjUsrMolJumPeer::MOL_ID, $tsMeanOfLoginMol->getId(), $comparison);
        } elseif ($tsMeanOfLoginMol instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjUsrMolJumPeer::MOL_ID, $tsMeanOfLoginMol->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTsMeanOfLoginMol() only accepts arguments of type TsMeanOfLoginMol or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TsMeanOfLoginMol relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TjUsrMolJumQuery The current query, for fluid interface
     */
    public function joinTsMeanOfLoginMol($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TsMeanOfLoginMol');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TsMeanOfLoginMol');
        }

        return $this;
    }

    /**
     * Use the TsMeanOfLoginMol relation TsMeanOfLoginMol object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TsMeanOfLoginMolQuery A secondary query class using the current class as primary query
     */
    public function useTsMeanOfLoginMolQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTsMeanOfLoginMol($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TsMeanOfLoginMol', 'TsMeanOfLoginMolQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TjUsrMolJum $tjUsrMolJum Object to remove from the list of results
     *
     * @return TjUsrMolJumQuery The current query, for fluid interface
     */
    public function prune($tjUsrMolJum = null)
    {
        if ($tjUsrMolJum) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TjUsrMolJumPeer::USR_ID), $tjUsrMolJum->getUsrId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TjUsrMolJumPeer::MOL_ID), $tjUsrMolJum->getMolId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(TjUsrMolJumPeer::JUM_DATA), $tjUsrMolJum->getData(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
