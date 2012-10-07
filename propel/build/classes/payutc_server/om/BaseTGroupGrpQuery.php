<?php


/**
 * Base class that represents a query for the 't_group_grp' table.
 *
 *
 *
 * @method TGroupGrpQuery orderById($order = Criteria::ASC) Order by the grp_id column
 * @method TGroupGrpQuery orderByName($order = Criteria::ASC) Order by the grp_name column
 * @method TGroupGrpQuery orderByOpen($order = Criteria::ASC) Order by the grp_open column
 * @method TGroupGrpQuery orderByPublic($order = Criteria::ASC) Order by the grp_public column
 * @method TGroupGrpQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method TGroupGrpQuery orderByRemoved($order = Criteria::ASC) Order by the grp_removed column
 *
 * @method TGroupGrpQuery groupById() Group by the grp_id column
 * @method TGroupGrpQuery groupByName() Group by the grp_name column
 * @method TGroupGrpQuery groupByOpen() Group by the grp_open column
 * @method TGroupGrpQuery groupByPublic() Group by the grp_public column
 * @method TGroupGrpQuery groupByFunId() Group by the fun_id column
 * @method TGroupGrpQuery groupByRemoved() Group by the grp_removed column
 *
 * @method TGroupGrpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TGroupGrpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TGroupGrpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TGroupGrpQuery leftJoinTFundationFun($relationAlias = null) Adds a LEFT JOIN clause to the query using the TFundationFun relation
 * @method TGroupGrpQuery rightJoinTFundationFun($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TFundationFun relation
 * @method TGroupGrpQuery innerJoinTFundationFun($relationAlias = null) Adds a INNER JOIN clause to the query using the TFundationFun relation
 *
 * @method TGroupGrpQuery leftJoinTPricePri($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPricePri relation
 * @method TGroupGrpQuery rightJoinTPricePri($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPricePri relation
 * @method TGroupGrpQuery innerJoinTPricePri($relationAlias = null) Adds a INNER JOIN clause to the query using the TPricePri relation
 *
 * @method TGroupGrpQuery leftJoinTjUsrGrpJug($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjUsrGrpJug relation
 * @method TGroupGrpQuery rightJoinTjUsrGrpJug($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjUsrGrpJug relation
 * @method TGroupGrpQuery innerJoinTjUsrGrpJug($relationAlias = null) Adds a INNER JOIN clause to the query using the TjUsrGrpJug relation
 *
 * @method TGroupGrp findOne(PropelPDO $con = null) Return the first TGroupGrp matching the query
 * @method TGroupGrp findOneOrCreate(PropelPDO $con = null) Return the first TGroupGrp matching the query, or a new TGroupGrp object populated from the query conditions when no match is found
 *
 * @method TGroupGrp findOneByName(string $grp_name) Return the first TGroupGrp filtered by the grp_name column
 * @method TGroupGrp findOneByOpen(boolean $grp_open) Return the first TGroupGrp filtered by the grp_open column
 * @method TGroupGrp findOneByPublic(boolean $grp_public) Return the first TGroupGrp filtered by the grp_public column
 * @method TGroupGrp findOneByFunId(int $fun_id) Return the first TGroupGrp filtered by the fun_id column
 * @method TGroupGrp findOneByRemoved(boolean $grp_removed) Return the first TGroupGrp filtered by the grp_removed column
 *
 * @method array findById(int $grp_id) Return TGroupGrp objects filtered by the grp_id column
 * @method array findByName(string $grp_name) Return TGroupGrp objects filtered by the grp_name column
 * @method array findByOpen(boolean $grp_open) Return TGroupGrp objects filtered by the grp_open column
 * @method array findByPublic(boolean $grp_public) Return TGroupGrp objects filtered by the grp_public column
 * @method array findByFunId(int $fun_id) Return TGroupGrp objects filtered by the fun_id column
 * @method array findByRemoved(boolean $grp_removed) Return TGroupGrp objects filtered by the grp_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTGroupGrpQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTGroupGrpQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TGroupGrp', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TGroupGrpQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TGroupGrpQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TGroupGrpQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TGroupGrpQuery) {
            return $criteria;
        }
        $query = new TGroupGrpQuery();
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
     * @return   TGroupGrp|TGroupGrp[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TGroupGrpPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TGroupGrpPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TGroupGrp A model object, or null if the key is not found
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
     * @return   TGroupGrp A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `GRP_ID`, `GRP_NAME`, `GRP_OPEN`, `GRP_PUBLIC`, `FUN_ID`, `GRP_REMOVED` FROM `t_group_grp` WHERE `GRP_ID` = :p0';
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
            $obj = new TGroupGrp();
            $obj->hydrate($row);
            TGroupGrpPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TGroupGrp|TGroupGrp[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TGroupGrp[]|mixed the list of results, formatted by the current formatter
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
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TGroupGrpPeer::GRP_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TGroupGrpPeer::GRP_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the grp_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE grp_id = 1234
     * $query->filterById(array(12, 34)); // WHERE grp_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE grp_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TGroupGrpPeer::GRP_ID, $id, $comparison);
    }

    /**
     * Filter the query on the grp_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE grp_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE grp_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TGroupGrpPeer::GRP_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the grp_open column
     *
     * Example usage:
     * <code>
     * $query->filterByOpen(true); // WHERE grp_open = true
     * $query->filterByOpen('yes'); // WHERE grp_open = true
     * </code>
     *
     * @param     boolean|string $open The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function filterByOpen($open = null, $comparison = null)
    {
        if (is_string($open)) {
            $grp_open = in_array(strtolower($open), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TGroupGrpPeer::GRP_OPEN, $open, $comparison);
    }

    /**
     * Filter the query on the grp_public column
     *
     * Example usage:
     * <code>
     * $query->filterByPublic(true); // WHERE grp_public = true
     * $query->filterByPublic('yes'); // WHERE grp_public = true
     * </code>
     *
     * @param     boolean|string $public The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function filterByPublic($public = null, $comparison = null)
    {
        if (is_string($public)) {
            $grp_public = in_array(strtolower($public), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TGroupGrpPeer::GRP_PUBLIC, $public, $comparison);
    }

    /**
     * Filter the query on the fun_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFunId(1234); // WHERE fun_id = 1234
     * $query->filterByFunId(array(12, 34)); // WHERE fun_id IN (12, 34)
     * $query->filterByFunId(array('min' => 12)); // WHERE fun_id > 12
     * </code>
     *
     * @see       filterByTFundationFun()
     *
     * @param     mixed $funId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(TGroupGrpPeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(TGroupGrpPeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TGroupGrpPeer::FUN_ID, $funId, $comparison);
    }

    /**
     * Filter the query on the grp_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE grp_removed = true
     * $query->filterByRemoved('yes'); // WHERE grp_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $grp_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TGroupGrpPeer::GRP_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TFundationFun object
     *
     * @param   TFundationFun|PropelObjectCollection $tFundationFun The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TGroupGrpQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTFundationFun($tFundationFun, $comparison = null)
    {
        if ($tFundationFun instanceof TFundationFun) {
            return $this
                ->addUsingAlias(TGroupGrpPeer::FUN_ID, $tFundationFun->getId(), $comparison);
        } elseif ($tFundationFun instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TGroupGrpPeer::FUN_ID, $tFundationFun->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTFundationFun() only accepts arguments of type TFundationFun or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TFundationFun relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function joinTFundationFun($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TFundationFun');

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
            $this->addJoinObject($join, 'TFundationFun');
        }

        return $this;
    }

    /**
     * Use the TFundationFun relation TFundationFun object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TFundationFunQuery A secondary query class using the current class as primary query
     */
    public function useTFundationFunQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTFundationFun($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TFundationFun', 'TFundationFunQuery');
    }

    /**
     * Filter the query by a related TPricePri object
     *
     * @param   TPricePri|PropelObjectCollection $tPricePri  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TGroupGrpQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPricePri($tPricePri, $comparison = null)
    {
        if ($tPricePri instanceof TPricePri) {
            return $this
                ->addUsingAlias(TGroupGrpPeer::GRP_ID, $tPricePri->getGrpId(), $comparison);
        } elseif ($tPricePri instanceof PropelObjectCollection) {
            return $this
                ->useTPricePriQuery()
                ->filterByPrimaryKeys($tPricePri->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTPricePri() only accepts arguments of type TPricePri or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPricePri relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function joinTPricePri($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPricePri');

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
            $this->addJoinObject($join, 'TPricePri');
        }

        return $this;
    }

    /**
     * Use the TPricePri relation TPricePri object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPricePriQuery A secondary query class using the current class as primary query
     */
    public function useTPricePriQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTPricePri($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPricePri', 'TPricePriQuery');
    }

    /**
     * Filter the query by a related TjUsrGrpJug object
     *
     * @param   TjUsrGrpJug|PropelObjectCollection $tjUsrGrpJug  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TGroupGrpQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjUsrGrpJug($tjUsrGrpJug, $comparison = null)
    {
        if ($tjUsrGrpJug instanceof TjUsrGrpJug) {
            return $this
                ->addUsingAlias(TGroupGrpPeer::GRP_ID, $tjUsrGrpJug->getGrpId(), $comparison);
        } elseif ($tjUsrGrpJug instanceof PropelObjectCollection) {
            return $this
                ->useTjUsrGrpJugQuery()
                ->filterByPrimaryKeys($tjUsrGrpJug->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTjUsrGrpJug() only accepts arguments of type TjUsrGrpJug or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TjUsrGrpJug relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function joinTjUsrGrpJug($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TjUsrGrpJug');

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
            $this->addJoinObject($join, 'TjUsrGrpJug');
        }

        return $this;
    }

    /**
     * Use the TjUsrGrpJug relation TjUsrGrpJug object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TjUsrGrpJugQuery A secondary query class using the current class as primary query
     */
    public function useTjUsrGrpJugQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTjUsrGrpJug($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjUsrGrpJug', 'TjUsrGrpJugQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TGroupGrp $tGroupGrp Object to remove from the list of results
     *
     * @return TGroupGrpQuery The current query, for fluid interface
     */
    public function prune($tGroupGrp = null)
    {
        if ($tGroupGrp) {
            $this->addUsingAlias(TGroupGrpPeer::GRP_ID, $tGroupGrp->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
