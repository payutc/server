<?php


/**
 * Base class that represents a query for the 't_sale_sal' table.
 *
 *
 *
 * @method TSaleSalQuery orderById($order = Criteria::ASC) Order by the sal_id column
 * @method TSaleSalQuery orderByName($order = Criteria::ASC) Order by the sal_name column
 * @method TSaleSalQuery orderByPerId($order = Criteria::ASC) Order by the per_id column
 * @method TSaleSalQuery orderByObjId($order = Criteria::ASC) Order by the obj_id column
 * @method TSaleSalQuery orderByRemoved($order = Criteria::ASC) Order by the sal_removed column
 *
 * @method TSaleSalQuery groupById() Group by the sal_id column
 * @method TSaleSalQuery groupByName() Group by the sal_name column
 * @method TSaleSalQuery groupByPerId() Group by the per_id column
 * @method TSaleSalQuery groupByObjId() Group by the obj_id column
 * @method TSaleSalQuery groupByRemoved() Group by the sal_removed column
 *
 * @method TSaleSalQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TSaleSalQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TSaleSalQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TSaleSalQuery leftJoinTObjectObj($relationAlias = null) Adds a LEFT JOIN clause to the query using the TObjectObj relation
 * @method TSaleSalQuery rightJoinTObjectObj($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TObjectObj relation
 * @method TSaleSalQuery innerJoinTObjectObj($relationAlias = null) Adds a INNER JOIN clause to the query using the TObjectObj relation
 *
 * @method TSaleSalQuery leftJoinTPeriodPer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TPeriodPer relation
 * @method TSaleSalQuery rightJoinTPeriodPer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TPeriodPer relation
 * @method TSaleSalQuery innerJoinTPeriodPer($relationAlias = null) Adds a INNER JOIN clause to the query using the TPeriodPer relation
 *
 * @method TSaleSal findOne(PropelPDO $con = null) Return the first TSaleSal matching the query
 * @method TSaleSal findOneOrCreate(PropelPDO $con = null) Return the first TSaleSal matching the query, or a new TSaleSal object populated from the query conditions when no match is found
 *
 * @method TSaleSal findOneByName(string $sal_name) Return the first TSaleSal filtered by the sal_name column
 * @method TSaleSal findOneByPerId(int $per_id) Return the first TSaleSal filtered by the per_id column
 * @method TSaleSal findOneByObjId(int $obj_id) Return the first TSaleSal filtered by the obj_id column
 * @method TSaleSal findOneByRemoved(boolean $sal_removed) Return the first TSaleSal filtered by the sal_removed column
 *
 * @method array findById(int $sal_id) Return TSaleSal objects filtered by the sal_id column
 * @method array findByName(string $sal_name) Return TSaleSal objects filtered by the sal_name column
 * @method array findByPerId(int $per_id) Return TSaleSal objects filtered by the per_id column
 * @method array findByObjId(int $obj_id) Return TSaleSal objects filtered by the obj_id column
 * @method array findByRemoved(boolean $sal_removed) Return TSaleSal objects filtered by the sal_removed column
 *
 * @package    propel.generator.payutc_server.om
 */
abstract class BaseTSaleSalQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTSaleSalQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'payutc_server', $modelName = 'TSaleSal', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TSaleSalQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TSaleSalQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TSaleSalQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TSaleSalQuery) {
            return $criteria;
        }
        $query = new TSaleSalQuery();
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
     * @return   TSaleSal|TSaleSal[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TSaleSalPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TSaleSalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TSaleSal A model object, or null if the key is not found
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
     * @return   TSaleSal A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `SAL_ID`, `SAL_NAME`, `PER_ID`, `OBJ_ID`, `SAL_REMOVED` FROM `t_sale_sal` WHERE `SAL_ID` = :p0';
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
            $obj = new TSaleSal();
            $obj->hydrate($row);
            TSaleSalPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TSaleSal|TSaleSal[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TSaleSal[]|mixed the list of results, formatted by the current formatter
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
     * @return TSaleSalQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TSaleSalPeer::SAL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TSaleSalQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TSaleSalPeer::SAL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the sal_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE sal_id = 1234
     * $query->filterById(array(12, 34)); // WHERE sal_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE sal_id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSaleSalQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TSaleSalPeer::SAL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the sal_name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE sal_name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE sal_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSaleSalQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TSaleSalPeer::SAL_NAME, $name, $comparison);
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
     * @return TSaleSalQuery The current query, for fluid interface
     */
    public function filterByPerId($perId = null, $comparison = null)
    {
        if (is_array($perId)) {
            $useMinMax = false;
            if (isset($perId['min'])) {
                $this->addUsingAlias(TSaleSalPeer::PER_ID, $perId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($perId['max'])) {
                $this->addUsingAlias(TSaleSalPeer::PER_ID, $perId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TSaleSalPeer::PER_ID, $perId, $comparison);
    }

    /**
     * Filter the query on the obj_id column
     *
     * Example usage:
     * <code>
     * $query->filterByObjId(1234); // WHERE obj_id = 1234
     * $query->filterByObjId(array(12, 34)); // WHERE obj_id IN (12, 34)
     * $query->filterByObjId(array('min' => 12)); // WHERE obj_id > 12
     * </code>
     *
     * @see       filterByTObjectObj()
     *
     * @param     mixed $objId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSaleSalQuery The current query, for fluid interface
     */
    public function filterByObjId($objId = null, $comparison = null)
    {
        if (is_array($objId)) {
            $useMinMax = false;
            if (isset($objId['min'])) {
                $this->addUsingAlias(TSaleSalPeer::OBJ_ID, $objId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objId['max'])) {
                $this->addUsingAlias(TSaleSalPeer::OBJ_ID, $objId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TSaleSalPeer::OBJ_ID, $objId, $comparison);
    }

    /**
     * Filter the query on the sal_removed column
     *
     * Example usage:
     * <code>
     * $query->filterByRemoved(true); // WHERE sal_removed = true
     * $query->filterByRemoved('yes'); // WHERE sal_removed = true
     * </code>
     *
     * @param     boolean|string $removed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TSaleSalQuery The current query, for fluid interface
     */
    public function filterByRemoved($removed = null, $comparison = null)
    {
        if (is_string($removed)) {
            $sal_removed = in_array(strtolower($removed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TSaleSalPeer::SAL_REMOVED, $removed, $comparison);
    }

    /**
     * Filter the query by a related TObjectObj object
     *
     * @param   TObjectObj|PropelObjectCollection $tObjectObj The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TSaleSalQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTObjectObj($tObjectObj, $comparison = null)
    {
        if ($tObjectObj instanceof TObjectObj) {
            return $this
                ->addUsingAlias(TSaleSalPeer::OBJ_ID, $tObjectObj->getId(), $comparison);
        } elseif ($tObjectObj instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TSaleSalPeer::OBJ_ID, $tObjectObj->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTObjectObj() only accepts arguments of type TObjectObj or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TObjectObj relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TSaleSalQuery The current query, for fluid interface
     */
    public function joinTObjectObj($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TObjectObj');

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
            $this->addJoinObject($join, 'TObjectObj');
        }

        return $this;
    }

    /**
     * Use the TObjectObj relation TObjectObj object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TObjectObjQuery A secondary query class using the current class as primary query
     */
    public function useTObjectObjQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTObjectObj($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TObjectObj', 'TObjectObjQuery');
    }

    /**
     * Filter the query by a related TPeriodPer object
     *
     * @param   TPeriodPer|PropelObjectCollection $tPeriodPer The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TSaleSalQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTPeriodPer($tPeriodPer, $comparison = null)
    {
        if ($tPeriodPer instanceof TPeriodPer) {
            return $this
                ->addUsingAlias(TSaleSalPeer::PER_ID, $tPeriodPer->getId(), $comparison);
        } elseif ($tPeriodPer instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TSaleSalPeer::PER_ID, $tPeriodPer->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TSaleSalQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   TSaleSal $tSaleSal Object to remove from the list of results
     *
     * @return TSaleSalQuery The current query, for fluid interface
     */
    public function prune($tSaleSal = null)
    {
        if ($tSaleSal) {
            $this->addUsingAlias(TSaleSalPeer::SAL_ID, $tSaleSal->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
