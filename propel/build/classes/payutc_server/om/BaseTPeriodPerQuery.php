<?php


/**
 * Base class that represents a query for the 't_period_per' table.
 *
 *
 *
 * @method TPeriodPerQuery orderById($order = Criteria::ASC) Order by the per_id column
 * @method TPeriodPerQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method TPeriodPerQuery orderByName($order = Criteria::ASC) Order by the per_name column
 * @method TPeriodPerQuery orderByDateStart($order = Criteria::ASC) Order by the per_date_start column
 * @method TPeriodPerQuery orderByDateEnd($order = Criteria::ASC) Order by the per_date_end column
 * @method TPeriodPerQuery orderByRemoved($order = Criteria::ASC) Order by the per_removed column
 *
 * @method TPeriodPerQuery groupById() Group by the per_id column
 * @method TPeriodPerQuery groupByFunId() Group by the fun_id column
 * @method TPeriodPerQuery groupByName() Group by the per_name column
 * @method TPeriodPerQuery groupByDateStart() Group by the per_date_start column
 * @method TPeriodPerQuery groupByDateEnd() Group by the per_date_end column
 * @method TPeriodPerQuery groupByRemoved() Group by the per_removed column
 *
 * @method TPeriodPerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TPeriodPerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TPeriodPerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TPeriodPerQuery leftJoinTFundationFun($relationAlias = null) Adds a LEFT JOIN clause to the query using the TFundationFun relation
 * @method TPeriodPerQuery rightJoinTFundationFun($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TFundationFun relation
 * @method TPeriodPerQuery innerJoinTFundationFun($relationAlias = null) Adds a INNER JOIN clause to the query using the TFundationFun relation
 *
 * @method TPeriodPerQuery leftJoinTPricePri($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPricePri relation
 * @method TPeriodPerQuery rightJoinTPricePri($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPricePri relation
 * @method TPeriodPerQuery innerJoinTPricePri($relationAlias = null) Adds a INNER JOIN clause to the query using the TPricePri relation
 *
 * @method TPeriodPerQuery leftJoinTSaleSal($relationAlias = null) Adds a LEFT JOIN clause to the query using the TSaleSal relation
 * @method TPeriodPerQuery rightJoinTSaleSal($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TSaleSal relation
 * @method TPeriodPerQuery innerJoinTSaleSal($relationAlias = null) Adds a INNER JOIN clause to the query using the TSaleSal relation
 *
 * @method TPeriodPerQuery leftJoinTjUsrGrpJug($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjUsrGrpJug relation
 * @method TPeriodPerQuery rightJoinTjUsrGrpJug($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjUsrGrpJug relation
 * @method TPeriodPerQuery innerJoinTjUsrGrpJug($relationAlias = null) Adds a INNER JOIN clause to the query using the TjUsrGrpJug relation
 *
 * @method TPeriodPerQuery leftJoinTjUsrRigJur($relationAlias = null) Adds a LEFT JOIN clause to the query using the TjUsrRigJur relation
 * @method TPeriodPerQuery rightJoinTjUsrRigJur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TjUsrRigJur relation
 * @method TPeriodPerQuery innerJoinTjUsrRigJur($relationAlias = null) Adds a INNER JOIN clause to the query using the TjUsrRigJur relation
 *
 * @method TPeriodPer findOne(PropelPDO $con = null) Return the first TPeriodPer matching the query
 * @method TPeriodPer findOneOrCreate(PropelPDO $con = null) Return the first TPeriodPer matching the query, or a new TPeriodPer object populated from the query conditions when no match is found
 *
 * @method TPeriodPer findOneByFunId(int $fun_id) Return the first TPeriodPer filtered by the fun_id column
 * @method TPeriodPer findOneByName(string $per_name) Return the first TPeriodPer filtered by the per_name column
 * @method TPeriodPer findOneByDateStart(string $per_date_start) Return the first TPeriodPer filtered by the per_date_start column
 * @method TPeriodPer findOneByDateEnd(string $per_date_end) Return the first TPeriodPer filtered by the per_date_end column
 * @method TPeriodPer findOneByRemoved(boolean $per_removed) Return the first TPeriodPer filtered by the per_removed column
 *
 * @method array findById(int $per_id) Return TPeriodPer objects filtered by the per_id column
 * @method array findByFunId(int $fun_id) Return TPeriodPer objects filtered by the fun_id column
 * @method array findByName(string $per_name) Return TPeriodPer objects filtered by the per_name column
 * @method array findByDateStart(string $per_date_start) Return TPeriodPer objects filtered by the per_date_start column
 * @method array findByDateEnd(string $per_date_end) Return TPeriodPer objects filtered by the per_date_end column
 * @method array findByRemoved(boolean $per_removed) Return TPeriodPer objects filtered by the per_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTPeriodPerQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTPeriodPerQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TPeriodPer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TPeriodPerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TPeriodPerQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TPeriodPerQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TPeriodPerQuery) {
            return $criteria;
        }
        $query = new TPeriodPerQuery();
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
     * @return   TPeriodPer|TPeriodPer[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TPeriodPerPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TPeriodPerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TPeriodPer A model object, or null if the key is not found
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
     * @return   TPeriodPer A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `PER_ID`, `FUN_ID`, `PER_NAME`, `PER_DATE_START`, `PER_DATE_END`, `PER_REMOVED` FROM `t_period_per` WHERE `PER_ID` = :p0';
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
            $obj = new TPeriodPer();
            $obj->hydrate($row);
            TPeriodPerPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TPeriodPer|TPeriodPer[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TPeriodPer[]|mixed the list of results, formatted by the current formatter
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
     * @return TPeriodPerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TPeriodPerPeer::PER_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TPeriodPerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TPeriodPerPeer::PER_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the per_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE per_id = 1234
     * $query->filterById(array(12, 34)); // WHERE per_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE per_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPeriodPerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TPeriodPerPeer::PER_ID, $id, $comparison);
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
     * @return TPeriodPerQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(TPeriodPerPeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(TPeriodPerPeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPeriodPerPeer::FUN_ID, $funId, $comparison);
    }

    /**
     * Filter the query on the per_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE per_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE per_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPeriodPerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TPeriodPerPeer::PER_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the per_date_start column
     *
     * Example usage:
     * <code>
     * $query->filterByDateStart('2011-03-14'); // WHERE per_date_start = '2011-03-14'
     * $query->filterByDateStart('now'); // WHERE per_date_start = '2011-03-14'
     * $query->filterByDateStart(array('max' => 'yesterday')); // WHERE per_date_start > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateStart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPeriodPerQuery The current query, for fluid interface
     */
    public function filterByDateStart($dateStart = null, $comparison = null)
    {
        if (is_array($dateStart)) {
            $useMinMax = false;
            if (isset($dateStart['min'])) {
                $this->addUsingAlias(TPeriodPerPeer::PER_DATE_START, $dateStart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateStart['max'])) {
                $this->addUsingAlias(TPeriodPerPeer::PER_DATE_START, $dateStart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPeriodPerPeer::PER_DATE_START, $dateStart, $comparison);
    }

    /**
     * Filter the query on the per_date_end column
     *
     * Example usage:
     * <code>
     * $query->filterByDateEnd('2011-03-14'); // WHERE per_date_end = '2011-03-14'
     * $query->filterByDateEnd('now'); // WHERE per_date_end = '2011-03-14'
     * $query->filterByDateEnd(array('max' => 'yesterday')); // WHERE per_date_end > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateEnd The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPeriodPerQuery The current query, for fluid interface
     */
    public function filterByDateEnd($dateEnd = null, $comparison = null)
    {
        if (is_array($dateEnd)) {
            $useMinMax = false;
            if (isset($dateEnd['min'])) {
                $this->addUsingAlias(TPeriodPerPeer::PER_DATE_END, $dateEnd['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateEnd['max'])) {
                $this->addUsingAlias(TPeriodPerPeer::PER_DATE_END, $dateEnd['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPeriodPerPeer::PER_DATE_END, $dateEnd, $comparison);
    }

    /**
     * Filter the query on the per_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE per_removed = true
     * $query->filterByRemoved('yes'); // WHERE per_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPeriodPerQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $per_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TPeriodPerPeer::PER_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TFundationFun object
     *
     * @param   TFundationFun|PropelObjectCollection $tFundationFun The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPeriodPerQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTFundationFun($tFundationFun, $comparison = null)
    {
        if ($tFundationFun instanceof TFundationFun) {
            return $this
                ->addUsingAlias(TPeriodPerPeer::FUN_ID, $tFundationFun->getId(), $comparison);
        } elseif ($tFundationFun instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPeriodPerPeer::FUN_ID, $tFundationFun->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TPeriodPerQuery The current query, for fluid interface
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
     * @return   TPeriodPerQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPricePri($tPricePri, $comparison = null)
    {
        if ($tPricePri instanceof TPricePri) {
            return $this
                ->addUsingAlias(TPeriodPerPeer::PER_ID, $tPricePri->getPerId(), $comparison);
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
     * @return TPeriodPerQuery The current query, for fluid interface
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
     * Filter the query by a related TSaleSal object
     *
     * @param   TSaleSal|PropelObjectCollection $tSaleSal  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPeriodPerQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTSaleSal($tSaleSal, $comparison = null)
    {
        if ($tSaleSal instanceof TSaleSal) {
            return $this
                ->addUsingAlias(TPeriodPerPeer::PER_ID, $tSaleSal->getPerId(), $comparison);
        } elseif ($tSaleSal instanceof PropelObjectCollection) {
            return $this
                ->useTSaleSalQuery()
                ->filterByPrimaryKeys($tSaleSal->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTSaleSal() only accepts arguments of type TSaleSal or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TSaleSal relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TPeriodPerQuery The current query, for fluid interface
     */
    public function joinTSaleSal($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TSaleSal');

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
            $this->addJoinObject($join, 'TSaleSal');
        }

        return $this;
    }

    /**
     * Use the TSaleSal relation TSaleSal object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TSaleSalQuery A secondary query class using the current class as primary query
     */
    public function useTSaleSalQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTSaleSal($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TSaleSal', 'TSaleSalQuery');
    }

    /**
     * Filter the query by a related TjUsrGrpJug object
     *
     * @param   TjUsrGrpJug|PropelObjectCollection $tjUsrGrpJug  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPeriodPerQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjUsrGrpJug($tjUsrGrpJug, $comparison = null)
    {
        if ($tjUsrGrpJug instanceof TjUsrGrpJug) {
            return $this
                ->addUsingAlias(TPeriodPerPeer::PER_ID, $tjUsrGrpJug->getPerId(), $comparison);
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
     * @return TPeriodPerQuery The current query, for fluid interface
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
     * Filter the query by a related TjUsrRigJur object
     *
     * @param   TjUsrRigJur|PropelObjectCollection $tjUsrRigJur  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPeriodPerQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTjUsrRigJur($tjUsrRigJur, $comparison = null)
    {
        if ($tjUsrRigJur instanceof TjUsrRigJur) {
            return $this
                ->addUsingAlias(TPeriodPerPeer::PER_ID, $tjUsrRigJur->getPerId(), $comparison);
        } elseif ($tjUsrRigJur instanceof PropelObjectCollection) {
            return $this
                ->useTjUsrRigJurQuery()
                ->filterByPrimaryKeys($tjUsrRigJur->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTjUsrRigJur() only accepts arguments of type TjUsrRigJur or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TjUsrRigJur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TPeriodPerQuery The current query, for fluid interface
     */
    public function joinTjUsrRigJur($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TjUsrRigJur');

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
            $this->addJoinObject($join, 'TjUsrRigJur');
        }

        return $this;
    }

    /**
     * Use the TjUsrRigJur relation TjUsrRigJur object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TjUsrRigJurQuery A secondary query class using the current class as primary query
     */
    public function useTjUsrRigJurQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTjUsrRigJur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TjUsrRigJur', 'TjUsrRigJurQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TPeriodPer $tPeriodPer Object to remove from the list of results
     *
     * @return TPeriodPerQuery The current query, for fluid interface
     */
    public function prune($tPeriodPer = null)
    {
        if ($tPeriodPer) {
            $this->addUsingAlias(TPeriodPerPeer::PER_ID, $tPeriodPer->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
