<?php


/**
 * Base class that represents a query for the 't_sherlocks_she' table.
 *
 *
 *
 * @method TSherlocksSheQuery orderById($order = Criteria::ASC) Order by the she_id column
 * @method TSherlocksSheQuery orderByUsrId($order = Criteria::ASC) Order by the usr_id column
 * @method TSherlocksSheQuery orderByStep($order = Criteria::ASC) Order by the she_step column
 * @method TSherlocksSheQuery orderByAmount($order = Criteria::ASC) Order by the she_amount column
 * @method TSherlocksSheQuery orderByDate($order = Criteria::ASC) Order by the she_date column
 * @method TSherlocksSheQuery orderByParentId($order = Criteria::ASC) Order by the she_parent_id column
 * @method TSherlocksSheQuery orderByState($order = Criteria::ASC) Order by the she_state column
 * @method TSherlocksSheQuery orderByTrace($order = Criteria::ASC) Order by the she_trace column
 *
 * @method TSherlocksSheQuery groupById() Group by the she_id column
 * @method TSherlocksSheQuery groupByUsrId() Group by the usr_id column
 * @method TSherlocksSheQuery groupByStep() Group by the she_step column
 * @method TSherlocksSheQuery groupByAmount() Group by the she_amount column
 * @method TSherlocksSheQuery groupByDate() Group by the she_date column
 * @method TSherlocksSheQuery groupByParentId() Group by the she_parent_id column
 * @method TSherlocksSheQuery groupByState() Group by the she_state column
 * @method TSherlocksSheQuery groupByTrace() Group by the she_trace column
 *
 * @method TSherlocksSheQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TSherlocksSheQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TSherlocksSheQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TSherlocksSheQuery leftJoinTsUserUsr($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsUserUsr relation
 * @method TSherlocksSheQuery rightJoinTsUserUsr($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsUserUsr relation
 * @method TSherlocksSheQuery innerJoinTsUserUsr($relationAlias = null) Adds a INNER JOIN clause to the query using the TsUserUsr relation
 *
 * @method TSherlocksShe findOne(PropelPDO $con = null) Return the first TSherlocksShe matching the query
 * @method TSherlocksShe findOneOrCreate(PropelPDO $con = null) Return the first TSherlocksShe matching the query, or a new TSherlocksShe object populated from the query conditions when no match is found
 *
 * @method TSherlocksShe findOneByUsrId(int $usr_id) Return the first TSherlocksShe filtered by the usr_id column
 * @method TSherlocksShe findOneByStep(boolean $she_step) Return the first TSherlocksShe filtered by the she_step column
 * @method TSherlocksShe findOneByAmount(int $she_amount) Return the first TSherlocksShe filtered by the she_amount column
 * @method TSherlocksShe findOneByDate(string $she_date) Return the first TSherlocksShe filtered by the she_date column
 * @method TSherlocksShe findOneByParentId(int $she_parent_id) Return the first TSherlocksShe filtered by the she_parent_id column
 * @method TSherlocksShe findOneByState(int $she_state) Return the first TSherlocksShe filtered by the she_state column
 * @method TSherlocksShe findOneByTrace(string $she_trace) Return the first TSherlocksShe filtered by the she_trace column
 *
 * @method array findById(int $she_id) Return TSherlocksShe objects filtered by the she_id column
 * @method array findByUsrId(int $usr_id) Return TSherlocksShe objects filtered by the usr_id column
 * @method array findByStep(boolean $she_step) Return TSherlocksShe objects filtered by the she_step column
 * @method array findByAmount(int $she_amount) Return TSherlocksShe objects filtered by the she_amount column
 * @method array findByDate(string $she_date) Return TSherlocksShe objects filtered by the she_date column
 * @method array findByParentId(int $she_parent_id) Return TSherlocksShe objects filtered by the she_parent_id column
 * @method array findByState(int $she_state) Return TSherlocksShe objects filtered by the she_state column
 * @method array findByTrace(string $she_trace) Return TSherlocksShe objects filtered by the she_trace column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTSherlocksSheQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTSherlocksSheQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TSherlocksShe', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TSherlocksSheQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TSherlocksSheQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TSherlocksSheQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TSherlocksSheQuery) {
            return $criteria;
        }
        $query = new TSherlocksSheQuery();
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
     * @return   TSherlocksShe|TSherlocksShe[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TSherlocksShePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TSherlocksShePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TSherlocksShe A model object, or null if the key is not found
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
     * @return   TSherlocksShe A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `SHE_ID`, `USR_ID`, `SHE_STEP`, `SHE_AMOUNT`, `SHE_DATE`, `SHE_PARENT_ID`, `SHE_STATE`, `SHE_TRACE` FROM `t_sherlocks_she` WHERE `SHE_ID` = :p0';
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
            $obj = new TSherlocksShe();
            $obj->hydrate($row);
            TSherlocksShePeer::addInstanceToPool($obj, (string) $key);
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
     * @return TSherlocksShe|TSherlocksShe[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TSherlocksShe[]|mixed the list of results, formatted by the current formatter
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
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TSherlocksShePeer::SHE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TSherlocksShePeer::SHE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the she_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE she_id = 1234
     * $query->filterById(array(12, 34)); // WHERE she_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE she_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TSherlocksShePeer::SHE_ID, $id, $comparison);
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
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function filterByUsrId($usrId = null, $comparison = null)
    {
        if (is_array($usrId)) {
            $useMinMax = false;
            if (isset($usrId['min'])) {
                $this->addUsingAlias(TSherlocksShePeer::USR_ID, $usrId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrId['max'])) {
                $this->addUsingAlias(TSherlocksShePeer::USR_ID, $usrId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TSherlocksShePeer::USR_ID, $usrId, $comparison);
    }

    /**
     * Filter the query on the she_step column
     *
     * Example usage:
     * <code>
     * $query->filterByStep(true); // WHERE she_step = true
     * $query->filterByStep('yes'); // WHERE she_step = true
     * </code>
     *
     * @param     boolean|string $step The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function filterByStep($step = null, $comparison = null)
    {
        if (is_string($step)) {
            $she_step = in_array(strtolower($step), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TSherlocksShePeer::SHE_STEP, $step, $comparison);
    }

    /**
     * Filter the query on the she_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE she_amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE she_amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE she_amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(TSherlocksShePeer::SHE_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(TSherlocksShePeer::SHE_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TSherlocksShePeer::SHE_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the she_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE she_date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE she_date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE she_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(TSherlocksShePeer::SHE_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(TSherlocksShePeer::SHE_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TSherlocksShePeer::SHE_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the she_parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParentId(1234); // WHERE she_parent_id = 1234
     * $query->filterByParentId(array(12, 34)); // WHERE she_parent_id IN (12, 34)
     * $query->filterByParentId(array('min' => 12)); // WHERE she_parent_id > 12
     * </code>
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(TSherlocksShePeer::SHE_PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(TSherlocksShePeer::SHE_PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TSherlocksShePeer::SHE_PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query on the she_state column
     *
     * Example usage:
     * <code>
     * $query->filterByState(1234); // WHERE she_state = 1234
     * $query->filterByState(array(12, 34)); // WHERE she_state IN (12, 34)
     * $query->filterByState(array('min' => 12)); // WHERE she_state > 12
     * </code>
     *
     * @param     mixed $state The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (is_array($state)) {
            $useMinMax = false;
            if (isset($state['min'])) {
                $this->addUsingAlias(TSherlocksShePeer::SHE_STATE, $state['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($state['max'])) {
                $this->addUsingAlias(TSherlocksShePeer::SHE_STATE, $state['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TSherlocksShePeer::SHE_STATE, $state, $comparison);
    }

    /**
     * Filter the query on the she_trace column
     *
     * Example usage:
     * <code>
     * $query->filterByTrace('fooValue');   // WHERE she_trace = 'fooValue'
     * $query->filterByTrace('%fooValue%'); // WHERE she_trace LIKE '%fooValue%'
     * </code>
     *
     * @param     string $trace The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function filterByTrace($trace = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($trace)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $trace)) {
                $trace = str_replace('*', '%', $trace);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TSherlocksShePeer::SHE_TRACE, $trace, $comparison);
    }

    /**
     * Filter the query by a related TsUserUsr object
     *
     * @param   TsUserUsr|PropelObjectCollection $tsUserUsr The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TSherlocksSheQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsUserUsr($tsUserUsr, $comparison = null)
    {
        if ($tsUserUsr instanceof TsUserUsr) {
            return $this
                ->addUsingAlias(TSherlocksShePeer::USR_ID, $tsUserUsr->getId(), $comparison);
        } elseif ($tsUserUsr instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TSherlocksShePeer::USR_ID, $tsUserUsr->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TSherlocksSheQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   TSherlocksShe $tSherlocksShe Object to remove from the list of results
     *
     * @return TSherlocksSheQuery The current query, for fluid interface
     */
    public function prune($tSherlocksShe = null)
    {
        if ($tSherlocksShe) {
            $this->addUsingAlias(TSherlocksShePeer::SHE_ID, $tSherlocksShe->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
