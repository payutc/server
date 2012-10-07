<?php


/**
 * Base class that represents a query for the 'tj_usr_grp_jug' table.
 *
 *
 *
 * @method TjUsrGrpJugQuery orderById($order = Criteria::ASC) Order by the jug_id column
 * @method TjUsrGrpJugQuery orderByUsrId($order = Criteria::ASC) Order by the usr_id column
 * @method TjUsrGrpJugQuery orderByGrpId($order = Criteria::ASC) Order by the grp_id column
 * @method TjUsrGrpJugQuery orderByPerId($order = Criteria::ASC) Order by the per_id column
 * @method TjUsrGrpJugQuery orderByRemoved($order = Criteria::ASC) Order by the jug_removed column
 *
 * @method TjUsrGrpJugQuery groupById() Group by the jug_id column
 * @method TjUsrGrpJugQuery groupByUsrId() Group by the usr_id column
 * @method TjUsrGrpJugQuery groupByGrpId() Group by the grp_id column
 * @method TjUsrGrpJugQuery groupByPerId() Group by the per_id column
 * @method TjUsrGrpJugQuery groupByRemoved() Group by the jug_removed column
 *
 * @method TjUsrGrpJugQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TjUsrGrpJugQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TjUsrGrpJugQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TjUsrGrpJugQuery leftJoinTPeriodPer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPeriodPer relation
 * @method TjUsrGrpJugQuery rightJoinTPeriodPer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPeriodPer relation
 * @method TjUsrGrpJugQuery innerJoinTPeriodPer($relationAlias = null) Adds a INNER JOIN clause to the query using the TPeriodPer relation
 *
 * @method TjUsrGrpJugQuery leftJoinTsUserUsr($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsUserUsr relation
 * @method TjUsrGrpJugQuery rightJoinTsUserUsr($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsUserUsr relation
 * @method TjUsrGrpJugQuery innerJoinTsUserUsr($relationAlias = null) Adds a INNER JOIN clause to the query using the TsUserUsr relation
 *
 * @method TjUsrGrpJugQuery leftJoinTGroupGrp($relationAlias = null) Adds a LEFT JOIN clause to the query using the TGroupGrp relation
 * @method TjUsrGrpJugQuery rightJoinTGroupGrp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TGroupGrp relation
 * @method TjUsrGrpJugQuery innerJoinTGroupGrp($relationAlias = null) Adds a INNER JOIN clause to the query using the TGroupGrp relation
 *
 * @method TjUsrGrpJug findOne(PropelPDO $con = null) Return the first TjUsrGrpJug matching the query
 * @method TjUsrGrpJug findOneOrCreate(PropelPDO $con = null) Return the first TjUsrGrpJug matching the query, or a new TjUsrGrpJug object populated from the query conditions when no match is found
 *
 * @method TjUsrGrpJug findOneByUsrId(int $usr_id) Return the first TjUsrGrpJug filtered by the usr_id column
 * @method TjUsrGrpJug findOneByGrpId(int $grp_id) Return the first TjUsrGrpJug filtered by the grp_id column
 * @method TjUsrGrpJug findOneByPerId(int $per_id) Return the first TjUsrGrpJug filtered by the per_id column
 * @method TjUsrGrpJug findOneByRemoved(int $jug_removed) Return the first TjUsrGrpJug filtered by the jug_removed column
 *
 * @method array findById(int $jug_id) Return TjUsrGrpJug objects filtered by the jug_id column
 * @method array findByUsrId(int $usr_id) Return TjUsrGrpJug objects filtered by the usr_id column
 * @method array findByGrpId(int $grp_id) Return TjUsrGrpJug objects filtered by the grp_id column
 * @method array findByPerId(int $per_id) Return TjUsrGrpJug objects filtered by the per_id column
 * @method array findByRemoved(int $jug_removed) Return TjUsrGrpJug objects filtered by the jug_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTjUsrGrpJugQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTjUsrGrpJugQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TjUsrGrpJug', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TjUsrGrpJugQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TjUsrGrpJugQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TjUsrGrpJugQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TjUsrGrpJugQuery) {
            return $criteria;
        }
        $query = new TjUsrGrpJugQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   TjUsrGrpJug|TjUsrGrpJug[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TjUsrGrpJugPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TjUsrGrpJugPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   TjUsrGrpJug A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   TjUsrGrpJug A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `JUG_ID`, `USR_ID`, `GRP_ID`, `PER_ID`, `JUG_REMOVED` FROM `tj_usr_grp_jug` WHERE `JUG_ID` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new TjUsrGrpJug();
            $obj->hydrate($row);
            TjUsrGrpJugPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TjUsrGrpJug|TjUsrGrpJug[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|TjUsrGrpJug[]|mixed the list of results, formatted by the current formatter
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
     * @return TjUsrGrpJugQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TjUsrGrpJugPeer::JUG_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TjUsrGrpJugQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TjUsrGrpJugPeer::JUG_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the jug_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE jug_id = 1234
     * $query->filterById(array(12, 34)); // WHERE jug_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE jug_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrGrpJugQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TjUsrGrpJugPeer::JUG_ID, $id, $comparison);
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
     * @return TjUsrGrpJugQuery The current query, for fluid interface
     */
    public function filterByUsrId($usrId = null, $comparison = null)
    {
        if (is_array($usrId)) {
            $useMinMax = false;
            if (isset($usrId['min'])) {
                $this->addUsingAlias(TjUsrGrpJugPeer::USR_ID, $usrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrId['max'])) {
                $this->addUsingAlias(TjUsrGrpJugPeer::USR_ID, $usrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjUsrGrpJugPeer::USR_ID, $usrId, $comparison);
    }

    /**
     * Filter the query on the grp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGrpId(1234); // WHERE grp_id = 1234
     * $query->filterByGrpId(array(12, 34)); // WHERE grp_id IN (12, 34)
     * $query->filterByGrpId(array('min' => 12)); // WHERE grp_id > 12
     * </code>
     *
     * @see       filterByTGroupGrp()
     *
     * @param     mixed $grpId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrGrpJugQuery The current query, for fluid interface
     */
    public function filterByGrpId($grpId = null, $comparison = null)
    {
        if (is_array($grpId)) {
            $useMinMax = false;
            if (isset($grpId['min'])) {
                $this->addUsingAlias(TjUsrGrpJugPeer::GRP_ID, $grpId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($grpId['max'])) {
                $this->addUsingAlias(TjUsrGrpJugPeer::GRP_ID, $grpId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjUsrGrpJugPeer::GRP_ID, $grpId, $comparison);
    }

    /**
     * Filter the query on the per_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPerId(1234); // WHERE per_id = 1234
     * $query->filterByPerId(array(12, 34)); // WHERE per_id IN (12, 34)
     * $query->filterByPerId(array('min' => 12)); // WHERE per_id > 12
     * </code>
     *
     * @see       filterByTPeriodPer()
     *
     * @param     mixed $perId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrGrpJugQuery The current query, for fluid interface
     */
    public function filterByPerId($perId = null, $comparison = null)
    {
        if (is_array($perId)) {
            $useMinMax = false;
            if (isset($perId['min'])) {
                $this->addUsingAlias(TjUsrGrpJugPeer::PER_ID, $perId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($perId['max'])) {
                $this->addUsingAlias(TjUsrGrpJugPeer::PER_ID, $perId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjUsrGrpJugPeer::PER_ID, $perId, $comparison);
    }

    /**
     * Filter the query on the jug_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(1234); // WHERE jug_removed = 1234
     * $query->filterByRemoved(array(12, 34)); // WHERE jug_removed IN (12, 34)
     * $query->filterByRemoved(array('min' => 12)); // WHERE jug_removed > 12
     * </code>
     *
     * @param     mixed $removed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TjUsrGrpJugQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_array($removed)) {
            $useMinMax = false;
            if (isset($removed['min'])) {
                $this->addUsingAlias(TjUsrGrpJugPeer::JUG_REMOVED, $removed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($removed['max'])) {
                $this->addUsingAlias(TjUsrGrpJugPeer::JUG_REMOVED, $removed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TjUsrGrpJugPeer::JUG_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TPeriodPer object
     *
     * @param   TPeriodPer|PropelObjectCollection $tPeriodPer The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjUsrGrpJugQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPeriodPer($tPeriodPer, $comparison = null)
    {
        if ($tPeriodPer instanceof TPeriodPer) {
            return $this
                ->addUsingAlias(TjUsrGrpJugPeer::PER_ID, $tPeriodPer->getId(), $comparison);
        } elseif ($tPeriodPer instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjUsrGrpJugPeer::PER_ID, $tPeriodPer->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTPeriodPer() only accepts arguments of type TPeriodPer or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPeriodPer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TjUsrGrpJugQuery The current query, for fluid interface
     */
    public function joinTPeriodPer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPeriodPer');

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
            $this->addJoinObject($join, 'TPeriodPer');
        }

        return $this;
    }

    /**
     * Use the TPeriodPer relation TPeriodPer object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPeriodPerQuery A secondary query class using the current class as primary query
     */
    public function useTPeriodPerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPeriodPer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPeriodPer', 'TPeriodPerQuery');
    }

    /**
     * Filter the query by a related TsUserUsr object
     *
     * @param   TsUserUsr|PropelObjectCollection $tsUserUsr The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjUsrGrpJugQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsUserUsr($tsUserUsr, $comparison = null)
    {
        if ($tsUserUsr instanceof TsUserUsr) {
            return $this
                ->addUsingAlias(TjUsrGrpJugPeer::USR_ID, $tsUserUsr->getId(), $comparison);
        } elseif ($tsUserUsr instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjUsrGrpJugPeer::USR_ID, $tsUserUsr->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TjUsrGrpJugQuery The current query, for fluid interface
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
     * Filter the query by a related TGroupGrp object
     *
     * @param   TGroupGrp|PropelObjectCollection $tGroupGrp The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TjUsrGrpJugQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTGroupGrp($tGroupGrp, $comparison = null)
    {
        if ($tGroupGrp instanceof TGroupGrp) {
            return $this
                ->addUsingAlias(TjUsrGrpJugPeer::GRP_ID, $tGroupGrp->getId(), $comparison);
        } elseif ($tGroupGrp instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TjUsrGrpJugPeer::GRP_ID, $tGroupGrp->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTGroupGrp() only accepts arguments of type TGroupGrp or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TGroupGrp relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TjUsrGrpJugQuery The current query, for fluid interface
     */
    public function joinTGroupGrp($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TGroupGrp');

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
            $this->addJoinObject($join, 'TGroupGrp');
        }

        return $this;
    }

    /**
     * Use the TGroupGrp relation TGroupGrp object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TGroupGrpQuery A secondary query class using the current class as primary query
     */
    public function useTGroupGrpQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTGroupGrp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TGroupGrp', 'TGroupGrpQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TjUsrGrpJug $tjUsrGrpJug Object to remove from the list of results
     *
     * @return TjUsrGrpJugQuery The current query, for fluid interface
     */
    public function prune($tjUsrGrpJug = null)
    {
        if ($tjUsrGrpJug) {
            $this->addUsingAlias(TjUsrGrpJugPeer::JUG_ID, $tjUsrGrpJug->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
