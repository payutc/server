<?php


/**
 * Base class that represents a query for the 't_plage_pla' table.
 *
 *
 *
 * @method TPlagePlaQuery orderById($order = Criteria::ASC) Order by the pla_id column
 * @method TPlagePlaQuery orderByFunId($order = Criteria::ASC) Order by the fun_id column
 * @method TPlagePlaQuery orderByPoiId($order = Criteria::ASC) Order by the poi_id column
 * @method TPlagePlaQuery orderByStart($order = Criteria::ASC) Order by the pla_start column
 * @method TPlagePlaQuery orderByEnd($order = Criteria::ASC) Order by the pla_end column
 * @method TPlagePlaQuery orderByName($order = Criteria::ASC) Order by the pla_name column
 *
 * @method TPlagePlaQuery groupById() Group by the pla_id column
 * @method TPlagePlaQuery groupByFunId() Group by the fun_id column
 * @method TPlagePlaQuery groupByPoiId() Group by the poi_id column
 * @method TPlagePlaQuery groupByStart() Group by the pla_start column
 * @method TPlagePlaQuery groupByEnd() Group by the pla_end column
 * @method TPlagePlaQuery groupByName() Group by the pla_name column
 *
 * @method TPlagePlaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TPlagePlaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TPlagePlaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TPlagePlaQuery leftJoinTPointPoi($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPointPoi relation
 * @method TPlagePlaQuery rightJoinTPointPoi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPointPoi relation
 * @method TPlagePlaQuery innerJoinTPointPoi($relationAlias = null) Adds a INNER JOIN clause to the query using the TPointPoi relation
 *
 * @method TPlagePlaQuery leftJoinTFundationFun($relationAlias = null) Adds a LEFT JOIN clause to the query using the TFundationFun relation
 * @method TPlagePlaQuery rightJoinTFundationFun($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TFundationFun relation
 * @method TPlagePlaQuery innerJoinTFundationFun($relationAlias = null) Adds a INNER JOIN clause to the query using the TFundationFun relation
 *
 * @method TPlagePla findOne(PropelPDO $con = null) Return the first TPlagePla matching the query
 * @method TPlagePla findOneOrCreate(PropelPDO $con = null) Return the first TPlagePla matching the query, or a new TPlagePla object populated from the query conditions when no match is found
 *
 * @method TPlagePla findOneByFunId(int $fun_id) Return the first TPlagePla filtered by the fun_id column
 * @method TPlagePla findOneByPoiId(int $poi_id) Return the first TPlagePla filtered by the poi_id column
 * @method TPlagePla findOneByStart(int $pla_start) Return the first TPlagePla filtered by the pla_start column
 * @method TPlagePla findOneByEnd(int $pla_end) Return the first TPlagePla filtered by the pla_end column
 * @method TPlagePla findOneByName(string $pla_name) Return the first TPlagePla filtered by the pla_name column
 *
 * @method array findById(int $pla_id) Return TPlagePla objects filtered by the pla_id column
 * @method array findByFunId(int $fun_id) Return TPlagePla objects filtered by the fun_id column
 * @method array findByPoiId(int $poi_id) Return TPlagePla objects filtered by the poi_id column
 * @method array findByStart(int $pla_start) Return TPlagePla objects filtered by the pla_start column
 * @method array findByEnd(int $pla_end) Return TPlagePla objects filtered by the pla_end column
 * @method array findByName(string $pla_name) Return TPlagePla objects filtered by the pla_name column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTPlagePlaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTPlagePlaQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TPlagePla', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TPlagePlaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TPlagePlaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TPlagePlaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TPlagePlaQuery) {
            return $criteria;
        }
        $query = new TPlagePlaQuery();
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
     * @return   TPlagePla|TPlagePla[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TPlagePlaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TPlagePlaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TPlagePla A model object, or null if the key is not found
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
     * @return   TPlagePla A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `PLA_ID`, `FUN_ID`, `POI_ID`, `PLA_START`, `PLA_END`, `PLA_NAME` FROM `t_plage_pla` WHERE `PLA_ID` = :p0';
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
            $obj = new TPlagePla();
            $obj->hydrate($row);
            TPlagePlaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TPlagePla|TPlagePla[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TPlagePla[]|mixed the list of results, formatted by the current formatter
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
     * @return TPlagePlaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TPlagePlaPeer::PLA_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TPlagePlaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TPlagePlaPeer::PLA_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pla_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE pla_id = 1234
     * $query->filterById(array(12, 34)); // WHERE pla_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE pla_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPlagePlaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TPlagePlaPeer::PLA_ID, $id, $comparison);
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
     * @return TPlagePlaQuery The current query, for fluid interface
     */
    public function filterByFunId($funId = null, $comparison = null)
    {
        if (is_array($funId)) {
            $useMinMax = false;
            if (isset($funId['min'])) {
                $this->addUsingAlias(TPlagePlaPeer::FUN_ID, $funId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($funId['max'])) {
                $this->addUsingAlias(TPlagePlaPeer::FUN_ID, $funId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPlagePlaPeer::FUN_ID, $funId, $comparison);
    }

    /**
     * Filter the query on the poi_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPoiId(1234); // WHERE poi_id = 1234
     * $query->filterByPoiId(array(12, 34)); // WHERE poi_id IN (12, 34)
     * $query->filterByPoiId(array('min' => 12)); // WHERE poi_id > 12
     * </code>
     *
     * @see       filterByTPointPoi()
     *
     * @param     mixed $poiId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPlagePlaQuery The current query, for fluid interface
     */
    public function filterByPoiId($poiId = null, $comparison = null)
    {
        if (is_array($poiId)) {
            $useMinMax = false;
            if (isset($poiId['min'])) {
                $this->addUsingAlias(TPlagePlaPeer::POI_ID, $poiId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($poiId['max'])) {
                $this->addUsingAlias(TPlagePlaPeer::POI_ID, $poiId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPlagePlaPeer::POI_ID, $poiId, $comparison);
    }

    /**
     * Filter the query on the pla_start column
     *
     * Example usage:
     * <code>
     * $query->filterByStart(1234); // WHERE pla_start = 1234
     * $query->filterByStart(array(12, 34)); // WHERE pla_start IN (12, 34)
     * $query->filterByStart(array('min' => 12)); // WHERE pla_start > 12
     * </code>
     *
     * @param     mixed $start The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPlagePlaQuery The current query, for fluid interface
     */
    public function filterByStart($start = null, $comparison = null)
    {
        if (is_array($start)) {
            $useMinMax = false;
            if (isset($start['min'])) {
                $this->addUsingAlias(TPlagePlaPeer::PLA_START, $start['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($start['max'])) {
                $this->addUsingAlias(TPlagePlaPeer::PLA_START, $start['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPlagePlaPeer::PLA_START, $start, $comparison);
    }

    /**
     * Filter the query on the pla_end column
     *
     * Example usage:
     * <code>
     * $query->filterByEnd(1234); // WHERE pla_end = 1234
     * $query->filterByEnd(array(12, 34)); // WHERE pla_end IN (12, 34)
     * $query->filterByEnd(array('min' => 12)); // WHERE pla_end > 12
     * </code>
     *
     * @param     mixed $end The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPlagePlaQuery The current query, for fluid interface
     */
    public function filterByEnd($end = null, $comparison = null)
    {
        if (is_array($end)) {
            $useMinMax = false;
            if (isset($end['min'])) {
                $this->addUsingAlias(TPlagePlaPeer::PLA_END, $end['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($end['max'])) {
                $this->addUsingAlias(TPlagePlaPeer::PLA_END, $end['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TPlagePlaPeer::PLA_END, $end, $comparison);
    }

    /**
     * Filter the query on the pla_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE pla_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE pla_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TPlagePlaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TPlagePlaPeer::PLA_NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related TPointPoi object
     *
     * @param   TPointPoi|PropelObjectCollection $tPointPoi The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPlagePlaQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPointPoi($tPointPoi, $comparison = null)
    {
        if ($tPointPoi instanceof TPointPoi) {
            return $this
                ->addUsingAlias(TPlagePlaPeer::POI_ID, $tPointPoi->getId(), $comparison);
        } elseif ($tPointPoi instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPlagePlaPeer::POI_ID, $tPointPoi->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTPointPoi() only accepts arguments of type TPointPoi or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TPointPoi relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TPlagePlaQuery The current query, for fluid interface
     */
    public function joinTPointPoi($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TPointPoi');

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
            $this->addJoinObject($join, 'TPointPoi');
        }

        return $this;
    }

    /**
     * Use the TPointPoi relation TPointPoi object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TPointPoiQuery A secondary query class using the current class as primary query
     */
    public function useTPointPoiQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTPointPoi($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TPointPoi', 'TPointPoiQuery');
    }

    /**
     * Filter the query by a related TFundationFun object
     *
     * @param   TFundationFun|PropelObjectCollection $tFundationFun The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TPlagePlaQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTFundationFun($tFundationFun, $comparison = null)
    {
        if ($tFundationFun instanceof TFundationFun) {
            return $this
                ->addUsingAlias(TPlagePlaPeer::FUN_ID, $tFundationFun->getId(), $comparison);
        } elseif ($tFundationFun instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TPlagePlaPeer::FUN_ID, $tFundationFun->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TPlagePlaQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   TPlagePla $tPlagePla Object to remove from the list of results
     *
     * @return TPlagePlaQuery The current query, for fluid interface
     */
    public function prune($tPlagePla = null)
    {
        if ($tPlagePla) {
            $this->addUsingAlias(TPlagePlaPeer::PLA_ID, $tPlagePla->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
