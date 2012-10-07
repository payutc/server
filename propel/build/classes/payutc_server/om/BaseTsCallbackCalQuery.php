<?php


/**
 * Base class that represents a query for the 'ts_callback_cal' table.
 *
 *
 *
 * @method TsCallbackCalQuery orderById($order = Criteria::ASC) Order by the cal_id column
 * @method TsCallbackCalQuery orderByProId($order = Criteria::ASC) Order by the pro_id column
 * @method TsCallbackCalQuery orderByRequest($order = Criteria::ASC) Order by the cal_request column
 * @method TsCallbackCalQuery orderByMolId($order = Criteria::ASC) Order by the mol_id column
 * @method TsCallbackCalQuery orderByRemoved($order = Criteria::ASC) Order by the cal_removed column
 *
 * @method TsCallbackCalQuery groupById() Group by the cal_id column
 * @method TsCallbackCalQuery groupByProId() Group by the pro_id column
 * @method TsCallbackCalQuery groupByRequest() Group by the cal_request column
 * @method TsCallbackCalQuery groupByMolId() Group by the mol_id column
 * @method TsCallbackCalQuery groupByRemoved() Group by the cal_removed column
 *
 * @method TsCallbackCalQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TsCallbackCalQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TsCallbackCalQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TsCallbackCalQuery leftJoinTsMeanOfLoginMol($relationAlias = null) Adds a LEFT JOIN clause to the query using the TsMeanOfLoginMol relation
 * @method TsCallbackCalQuery rightJoinTsMeanOfLoginMol($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TsMeanOfLoginMol relation
 * @method TsCallbackCalQuery innerJoinTsMeanOfLoginMol($relationAlias = null) Adds a INNER JOIN clause to the query using the TsMeanOfLoginMol relation
 *
 * @method TsCallbackCal findOne(PropelPDO $con = null) Return the first TsCallbackCal matching the query
 * @method TsCallbackCal findOneOrCreate(PropelPDO $con = null) Return the first TsCallbackCal matching the query, or a new TsCallbackCal object populated from the query conditions when no match is found
 *
 * @method TsCallbackCal findOneByProId(int $pro_id) Return the first TsCallbackCal filtered by the pro_id column
 * @method TsCallbackCal findOneByRequest(string $cal_request) Return the first TsCallbackCal filtered by the cal_request column
 * @method TsCallbackCal findOneByMolId(int $mol_id) Return the first TsCallbackCal filtered by the mol_id column
 * @method TsCallbackCal findOneByRemoved(boolean $cal_removed) Return the first TsCallbackCal filtered by the cal_removed column
 *
 * @method array findById(int $cal_id) Return TsCallbackCal objects filtered by the cal_id column
 * @method array findByProId(int $pro_id) Return TsCallbackCal objects filtered by the pro_id column
 * @method array findByRequest(string $cal_request) Return TsCallbackCal objects filtered by the cal_request column
 * @method array findByMolId(int $mol_id) Return TsCallbackCal objects filtered by the mol_id column
 * @method array findByRemoved(boolean $cal_removed) Return TsCallbackCal objects filtered by the cal_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTsCallbackCalQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTsCallbackCalQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TsCallbackCal', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TsCallbackCalQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TsCallbackCalQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TsCallbackCalQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TsCallbackCalQuery) {
            return $criteria;
        }
        $query = new TsCallbackCalQuery();
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
     * @return   TsCallbackCal|TsCallbackCal[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TsCallbackCalPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TsCallbackCalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TsCallbackCal A model object, or null if the key is not found
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
     * @return   TsCallbackCal A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `CAL_ID`, `PRO_ID`, `CAL_REQUEST`, `MOL_ID`, `CAL_REMOVED` FROM `ts_callback_cal` WHERE `CAL_ID` = :p0';
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
            $obj = new TsCallbackCal();
            $obj->hydrate($row);
            TsCallbackCalPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TsCallbackCal|TsCallbackCal[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TsCallbackCal[]|mixed the list of results, formatted by the current formatter
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
     * @return TsCallbackCalQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TsCallbackCalPeer::CAL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TsCallbackCalQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TsCallbackCalPeer::CAL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the cal_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE cal_id = 1234
     * $query->filterById(array(12, 34)); // WHERE cal_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE cal_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsCallbackCalQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TsCallbackCalPeer::CAL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the pro_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProId(1234); // WHERE pro_id = 1234
     * $query->filterByProId(array(12, 34)); // WHERE pro_id IN (12, 34)
     * $query->filterByProId(array('min' => 12)); // WHERE pro_id > 12
     * </code>
     *
     * @param     mixed $proId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsCallbackCalQuery The current query, for fluid interface
     */
    public function filterByProId($proId = null, $comparison = null)
    {
        if (is_array($proId)) {
            $useMinMax = false;
            if (isset($proId['min'])) {
                $this->addUsingAlias(TsCallbackCalPeer::PRO_ID, $proId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($proId['max'])) {
                $this->addUsingAlias(TsCallbackCalPeer::PRO_ID, $proId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TsCallbackCalPeer::PRO_ID, $proId, $comparison);
    }

    /**
     * Filter the query on the cal_request column
     *
     * Example usage:
     * <code>
     * $query->filterByRequest('fooValue');   // WHERE cal_request = 'fooValue'
     * $query->filterByRequest('%fooValue%'); // WHERE cal_request LIKE '%fooValue%'
     * </code>
     *
     * @param     string $request The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsCallbackCalQuery The current query, for fluid interface
     */
    public function filterByRequest($request = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($request)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $request)) {
                $request = str_replace('*', '%', $request);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TsCallbackCalPeer::CAL_REQUEST, $request, $comparison);
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
     * @return TsCallbackCalQuery The current query, for fluid interface
     */
    public function filterByMolId($molId = null, $comparison = null)
    {
        if (is_array($molId)) {
            $useMinMax = false;
            if (isset($molId['min'])) {
                $this->addUsingAlias(TsCallbackCalPeer::MOL_ID, $molId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($molId['max'])) {
                $this->addUsingAlias(TsCallbackCalPeer::MOL_ID, $molId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TsCallbackCalPeer::MOL_ID, $molId, $comparison);
    }

    /**
     * Filter the query on the cal_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE cal_removed = true
     * $query->filterByRemoved('yes'); // WHERE cal_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TsCallbackCalQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $cal_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TsCallbackCalPeer::CAL_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TsMeanOfLoginMol object
     *
     * @param   TsMeanOfLoginMol|PropelObjectCollection $tsMeanOfLoginMol The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TsCallbackCalQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTsMeanOfLoginMol($tsMeanOfLoginMol, $comparison = null)
    {
        if ($tsMeanOfLoginMol instanceof TsMeanOfLoginMol) {
            return $this
                ->addUsingAlias(TsCallbackCalPeer::MOL_ID, $tsMeanOfLoginMol->getId(), $comparison);
        } elseif ($tsMeanOfLoginMol instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TsCallbackCalPeer::MOL_ID, $tsMeanOfLoginMol->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TsCallbackCalQuery The current query, for fluid interface
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
     * @param   TsCallbackCal $tsCallbackCal Object to remove from the list of results
     *
     * @return TsCallbackCalQuery The current query, for fluid interface
     */
    public function prune($tsCallbackCal = null)
    {
        if ($tsCallbackCal) {
            $this->addUsingAlias(TsCallbackCalPeer::CAL_ID, $tsCallbackCal->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
